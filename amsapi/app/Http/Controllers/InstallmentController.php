<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyIn\Invoice;
use App\Models\MoneyIn\PaymentReceive;

use App\Http\Resources\Invoice as InvoiceResource;
use App\Http\Resources\PaymentReceive as PaymentReceiveResource;

class InstallmentController extends Controller
{
    public function intstallmentInvoice(Request $request)
    {
        $invoice  = Invoice::where('mode',3)->paginate(10);
        // $invoice  = Invoice::paginate(10);
        return InvoiceResource::collection($invoice);
    }

    public function intstallmentPaymentInvoice(Request $request)
    {
        $payment  = PaymentReceive::where('payment_mode_id',3)->get();
        // $invoice  = Invoice::paginate(10);
        return PaymentReceiveResource::collection($payment);
    }

    public function intstallmentPayment(Request $request)
    {
    	// return $request->all();

    	$invoices = $request->input('invoices');

    	$total_istallment = $request->input('total_installment');

    	$payments  = PaymentReceive::where('payment_mode_id',3)->get();
    	$paid = 0;
    	$payment_id = array();
    	foreach ($payments as $key => $payment) {
    		foreach (json_decode($payment->invoices) as $invo) {
    			if($invoices['id'] == $invo->id){
    				$paid++;
    			}
    		}
    		array_push($payment_id,$payment->id);
    	}

    	$submit = 0;



    	foreach ($request->input('installments') as $key => $installment) {
    		if($installment['pay'] == true){
    			$submit++;
    		}
    	}

    	if($total_istallment != $paid){
    		if($submit>$paid){
    			$diff = abs($submit - $paid);
    			for($i=0;$i<$diff;$i++){

    				$paymentReceive = new PaymentReceive;
			        $paymentReceive -> date = "11-12-2018";
			        $paymentReceive -> customer_id = $request->input('customer_id');
			        $paymentReceive -> payment_mode_id = 3;
			        $paymentReceive -> amount = $request->input('per_installment_amount');
			        $request -> isMethod('post') ? $paymentReceive-> pr_number = "PRN-".time() : '' ;
			        $paymentReceive -> invoices = json_encode(array($request->input('invoices')));
			        
			        $invoice =  Invoice::find($invoices['id']);
			        $invoice->due_amount = $invoice->due_amount-$paymentReceive -> amount;
			        $invoice->save();  

			        $log_user = Auth()->user();
			        $request->isMethod('put') ?  $paymentReceive ->updated_by = $log_user->id : '' ;
			        $request->isMethod('post') ? $paymentReceive ->created_by = $log_user->id : '' ;
			        $request->isMethod('post') ? $paymentReceive ->updated_by = $log_user->id : '' ;

			        $paymentReceive->save();

    			}

    		}
    	}

    	if($submit < $paid){
			$diff = abs($paid - $submit);
			for($i=0;$i<$diff;$i++){
				$invoice =  Invoice::find($invoices['id']);
		        $invoice->due_amount = $invoice->due_amount + $request->input('per_installment_amount');
		        $invoice->save();
		        $payment =  PaymentReceive::find($payment_id[$i]); 
		        $payment->delete();
			}
			
		}

    	return "ok";
    }

}
