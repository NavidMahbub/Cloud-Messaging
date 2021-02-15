<?php

namespace App\Http\Controllers;

use App\Models\MoneyIn\PaymentReceive;
use Illuminate\Http\Request;
use App\Models\MoneyIn\Invoice;
use Sentinel;
use App\RoleUser;
use App\Http\Resources\Invoice as InvoiceResource;
use App\Http\Resources\PaymentReceive as PaymentReceiveResource;
use App\Models\Journal\JournalEntry;
use App\Models\MoneyIn\PaymentReceiveEntry;
use DB;
use Auth;
class PaymentReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
      $limit     = ($request->has('limit'))?$request['limit']:20;
      $customer_id     = ($request->has('customer_id'))?$request['customer_id']:null;
      $PaymentReceive = PaymentReceive::when($customer_id, function($q) use($customer_id){return $q->where('customer_id',$customer_id);})
          ->orderBy('id', 'desc')->paginate($limit);
        return PaymentReceiveResource::collection($PaymentReceive);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function  pgetlastid(){
        $lastid = PaymentReceive::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $paymentReceive = $request->isMethod('put') ? PaymentReceive::findOrFail($request->payment_id) : new PaymentReceive;
        // return response()->json(['value'=>$paymentReceive],401);
        $paymentReceive -> date = $request->input('date');
        $paymentReceive -> customer_id = $request->input('customer_id');
        $paymentReceive -> account_id = 8;
        $paymentReceive -> payment_mode_id = $request->input('payment_mode_id');
        $paymentReceive -> amount = $request->input('amount');
        $paymentReceive -> due = $request->input('due');
        $paymentReceive -> reference = $request->input('reference');
        $paymentReceive -> customer_note = $request->input('customer_note');
        $paymentReceive->installment_type = 1;
        $request -> isMethod('post') ? $paymentReceive-> pr_number = "PRN-1455-".sprintf('%07d',$this->pgetlastid()):'';
        $paymentReceive -> invoices = json_encode($request->input('invoices'));
        
    
            
        // if($request->isMethod('post')){
        //     foreach ($request->input('invoices') as $key => $value){
        //          $invoice =  Invoice::find($value['invoice_id']);
        //         $due_amount = $invoice->due_amount-$value['amount'];
        //         if($due_amount>=0){
        //             $invoice->due_amount = $due_amount;
        //         }else{
        //             $invoice->due_amount=0;
        //         }
        //         //$invoice;
        //         $invoice->save();  
        //     }
        // }
        
        // if($request->isMethod('put')){
        //     $old_invoices = json_decode(PaymentReceive::where('id',$request->payment_id)->first()->invoices);
        //     foreach ($request->input('invoices') as $key => $value){
        //         $invoice =  Invoice::find($value['invoice_id']);
        //         foreach ($old_invoices as $old_invoice) {
        //             if($old_invoice->invoice_id == $invoice->id ){
        //                 $due_amount = $invoice->due_amount-$value['amount'];
        //                 $due_amount = floatval($due_amount) + floatval($old_invoice->amount);
        //             }
        //             else{
        //                 $due_amount = $invoice->due_amount-$value['amount'];
        //             }
        //         }
        //         if($due_amount>=0){
        //             $invoice->due_amount = $due_amount;
        //         }else{
        //             $invoice->due_amount=0;
        //         }
        //         $invoice->save();  
        //     }
        // }

        $log_user = Auth()->user();
        $request->isMethod('put') ?  $paymentReceive ->updated_by = $log_user->id : '' ;
        $request->isMethod('post') ? $paymentReceive ->created_by = $log_user->id : '' ;
        $request->isMethod('post') ? $paymentReceive ->updated_by = $log_user->id : '' ;


        if($paymentReceive->save()){
            // $payment_receive_entry_delete = PaymentReceiveEntry::where('payment_receive_id',$paymentReceive->id)->get();
            // if(!empty($payment_receive_entry_delete))
            // {
            //     $payment_receive_entry_delete->each->delete();
            // }
            
            // $payment_receive_entry = [];
            // foreach ($request->input('invoices') as $key => $value){
            //     $payment_receive_entry[] = [
            //         'amount'                => $value['amount'],
            //         'payment_receive_id'   => $paymentReceive->id,
            //         'invoice_id'            => $value['invoice_id'],
            //         'created_by'            => $log_user->id,
            //         'updated_by'            => $log_user->id,
            //         'created_at'            => \Carbon\Carbon::now()->toDateTimeString(),
            //         'updated_at'            => \Carbon\Carbon::now()->toDateTimeString(),
            //     ]; 
            // }
            //return $payment_receive_entry;
            
            
           
            //DB::table('payment_receive_entries')->insert($payment_receive_entry);
            
           
            $journal_entry = JournalEntry::where('payment_receive_id',$paymentReceive->id)->first();
            if( $journal_entry){
                
            }else{
                $journal_entry = new JournalEntry;
            }
            
            $journal_entry->note                = $data['customer_note'];
            $journal_entry->debit_credit        = 1;
            $journal_entry->amount              = $data['amount'];
            $journal_entry->account_id          = 8;
            $journal_entry->jurnal_type         = "payment_receive";
            $journal_entry->payment_receive_id  = $paymentReceive->id;
            $journal_entry->contact_id          = $request->input('customer_id');
            $journal_entry->created_by          = $log_user->id;
            $journal_entry->updated_by          = $log_user->id;
            $journal_entry->save();
            return new PaymentReceiveResource($paymentReceive);
        }
    }


   
    public function destroy($id)
    {
        $payment_receive = PaymentReceive::find($id);
        //return response()->json(['error'=>"'$payment_receive'"],401);
        // foreach (json_decode($payment_receive->invoices) as $invo){
        //     $invoice =  Invoice::find($invo->invoice_id);
        //     $invoice->due_amount = $invoice->due_amount + $invo->amount;
        //     $invoice->save();
        // }
        $entries_delete = JournalEntry::where('payment_receive_id',$payment_receive->id)->get();
        if(!empty($entries_delete))
        {
            $entries_delete->each->delete();
        }
        if($payment_receive->delete()){
            return new PaymentReceiveResource($payment_receive);
        }
    }
}
