<?php

namespace App\Http\Controllers\Invoice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\MoneyIn\Invoice;
use App\Models\MoneyIn\PaymentReceive;
use Sentinel;
use App\RoleUser;
use App\Http\Resources\Invoice as InvoiceResource;
use App\Models\Journal\JournalEntry;
use Auth;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        //return $request->all();
        $vendor_id     = ($request->has('vendor_id'))?$request['vendor_id']:null;
        $account_id     = ($request->has('account_id'))?$request['account_id']:null;
        $visa_id     = ($request->has('visa_id'))?$request['visa_id']:null;
        $contact_id     = ($request->has('customer_id'))?$request['customer_id']:null;
        $cstart_date     = ($request->has('strat_date'))?$request['strat_date']:null;
        $cend_date     = ($request->has('end_date'))?$request['end_date']:null;

        if($cstart_date == null && $cend_date == null)
        {
            $datearray = null;
            // $start_date = date('Y-m-d' . ' 00:00:00', time()); 
            // $end_date = date('Y-m-d' . ' 22:00:40', time());
        }elseif($cstart_date != null && $cend_date == null){
            $start_date = $cstart_date.' 00:00:00';
            $end_date =   $cstart_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }elseif($cstart_date != null && $cend_date != null){
            $start_date = $cstart_date.' 00:00:00';
            $end_date =   $cend_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }else{
            $start_date = $cend_date.' 00:00:00';
            $end_date =   $cend_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }
        $invoice  = Invoice::when($visa_id,function($q) use($visa_id){return $q->where('visa_id', $visa_id);})
        ->when($contact_id, function($q) use($contact_id){return $q->where('customer_id', $contact_id);})
        ->orderBy('id', 'desc')->paginate(50);
        return InvoiceResource::collection($invoice);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $invoice = $request->isMethod('put') ? Invoice::findOrFail($request->invoice_id) : new Invoice;
        $invoice ->date = $request->input('date');
        $invoice ->due_date = $request->input('due_date');
        $invoice ->customer_id = $request->input('customer_id');
        $invoice ->visa_id = $request->input('visa_id');
        $invoice ->agent_id = $request->input('agent_id');
        $invoice ->account_id = $request->input('account_id');
        $invoice ->commission_type = $request->input('commission_type');
        $invoice ->commission_amount = $request->input('commission_amount');
        $invoice ->adjustment = $request->input('adjustment');
        $invoice ->total = $request->input('total');
        // $invoice ->due_amount = $request->input('total')-$request->input('down_payment');
        $invoice ->mode = $request->input('mode');
        $invoice ->amount = $request->input('down_payment');
        $invoice ->down_payment = $request->input('down_payment');
        $invoice ->total_installment = $request->input('total_installment');
        $invoice ->per_installment_amount = $request->input('per_installment_amount');
        $invoice ->installment_type = $request->input('installment_type');
        $invoice ->personal_note = $request->input('personal_note');
        $invoice ->customer_note = $request->input('customer_note');
        $request -> isMethod('post') ? $invoice ->invoice_number = "INV-1455-".sprintf('%07d',$this->getlastid()):'';
        $request->invoice_type == 1 ?  $invoice ->invoice_items = null : $invoice ->invoice_items = json_encode($request->input('invoice_items'));
        $log_user = Auth()->user();
        $request->isMethod('put') ?  $invoice ->updated_by = $log_user->id : '' ;
        $request->isMethod('post') ? $invoice ->created_by = $log_user->id : '' ;
        $request->isMethod('post') ? $invoice ->updated_by = $log_user->id : '' ;

        
        if($invoice ->mode == 3){
            $paymentReceive = $request->isMethod('put') ? PaymentReceive::findOrFail($invoice->payment_id) : new PaymentReceive;
            // return response()->json(['value'=>$paymentReceive],401);
            $paymentReceive ->date = $invoice->date;
            $paymentReceive ->customer_id = $invoice->customer_id;
            // $paymentReceive -> payment_mode_id = $request->input('payment_mode_id');
            $paymentReceive ->amount = $request->input('down_payment');
            // $paymentReceive -> reference = $request->input('reference');
            // $paymentReceive -> customer_note = $request->input('customer_note');
            $request -> isMethod('post') ? $paymentReceive->pr_number = "PRN-1455-".sprintf('%07d',$this->pgetlastid()):'';
            $paymentReceive ->invoices = json_encode(array($invoice));
            
            

            $log_user = Auth()->user();
            $request->isMethod('put') ?  $paymentReceive ->updated_by = $log_user->id : '' ;
            $request->isMethod('post') ? $paymentReceive ->created_by = $log_user->id : '' ;
            $request->isMethod('post') ? $paymentReceive ->updated_by = $log_user->id : '' ;
            $paymentReceive->save();
            $invoice->payment_id = $paymentReceive->id;
        }

        if($invoice->save()){
            $agent_commission_amount = 0;
            $status = $this->insertManualJournalEntries($data,$invoice->id,$agent_commission_amount);
            return new InvoiceResource($invoice);
        }
    }
    public function  getlastid(){
        $lastid = Invoice::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }
    public function  pgetlastid(){
        $lastid = PaymentReceive::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        if($invoice->delete()){
            return new InvoiceResource($invoice);
        }
    }
    
    public function unpaidInvoice($id){
        // $invoices = Invoice::leftJoin('visas','invoices.visa_id','=','visas.id')
        //         ->select('invoices.*')->whereNotNull('visas.okala_date')->where('visas.status',1)
        //         ->where('invoices.customer_id', $id)->where('invoices.due_amount','>', 0)->get();
        // return InvoiceResource::collection($invoices);
        $total_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
                 ->whereNotNull('visas.okala_date')->where('visas.status',1)
                ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')->where('journal_entries.contact_id',$id)->sum('journal_entries.amount');
        $total_receive = JournalEntry::where('jurnal_type','payment_receive')->where('contact_id',$id)->sum('amount');
        $total_due  = $total_invoice-$total_receive;
        return $total_due; 
    }
    
    public function insertManualJournalEntries($data,$invoice_id,$agent_commission_amount)
    {
        $user_id = Auth::user()->id;
        $invoice_entries_delete = JournalEntry::where('invoice_id',$invoice_id)->get();
       
        if(!empty($invoice_entries_delete))
        {
            $invoice_entries_delete->each->delete();
        }
        // $i = 0;
        // $discount = 0;
        // $account_array = array_fill(1, 100, 0);
        // foreach ($data['item_id'] as $account)
        // {
        //     if($data['discount'][$i] == "")
        //     {

        //     }
        //     else
        //     {
        //         $amount = $data['quantity'][$i]*$data['rate'][$i];
        //         $discount = $discount + ($data['discount'][$i]*$amount)/100;
        //         //$discount1 = ($data['discount'][$i]*$amount)/100;
        //     }

        //     $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i]*$data['rate'][$i]);

        //     $i++;
        // }



        //return $account_array;

        //for agent commission manual journal entry
        // if($data['commission_type'] && $data['agent_id'] && $data['agentcommissionAmount'])
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['note'];
        //     $journal_entry->debit_credit    = 1;
        //     if($data['commission_type'] == 1)
        //     {
        //         $journal_entry->amount = $agent_commission_amount;
        //     }
        //     else
        //     {
        //         $journal_entry->amount = $data['agentcommissionAmount'];
        //     }

        //     $journal_entry->account_name_id = 30;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->agent_id        = $data['agent_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;
        //     $journal_entry->save();

        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['customer_note'];
        //     $journal_entry->debit_credit    = 0;
        //     if($data['commission_type'] == 1)
        //     {
        //         $journal_entry->amount = $agent_commission_amount;
        //     }
        //     else
        //     {
        //         $journal_entry->amount = $data['agentcommissionAmount'];
        //     }
        //     $journal_entry->account_name_id = 11;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->agent_id        = $data['agent_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;
        //     $journal_entry->save();
        // }
        //insert total amount as debit
        $journal_entry = new JournalEntry;
        $journal_entry->note            = $data['personal_note'];
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = $data['total'];
        $journal_entry->account_id = $data['account_id'];
        $journal_entry->jurnal_type     = "invoice";
        $journal_entry->invoice_id      = $invoice_id;
        $journal_entry->contact_id      = $data['customer_id'];
        if(isset($data['visa_id'])){
            $journal_entry->visa_id         = $data['visa_id'];
        }
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;

        if($journal_entry->save())
        {
            return true;
        }
        else
        {
            //delete all journal entry for this invoice...
            $invoice = Invoice::find($invoice_id);
            $invoice->delete();
            return false;
        }

        //insert discount as credit
        // if($discount>0)
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['customer_note'];
        //     $journal_entry->debit_credit    = 1;
        //     $journal_entry->amount          = $discount;
        //     $journal_entry->account_name_id = 21;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;

        //     if($journal_entry->save())
        //     {

        //     }
        //     else
        //     {
        //         //delete all journal entry for this invoice...
        //         $invoice = Invoice::find($invoice_id);
        //         $invoice->delete();
        //         return false;
        //     }
        // }


        // //insert tax total as credit
        // if($data['tax_total']>0)
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['customer_note'];
        //     $journal_entry->debit_credit    = 0;
        //     $journal_entry->amount          = $data['tax_total'];
        //     $journal_entry->account_name_id = 9;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;

        //     if($journal_entry->save())
        //     {

        //     }
        //     else
        //     {
        //         //delete all journal entry for this invoice...
        //         $invoice = Invoice::find($invoice_id);
        //         $invoice->delete();
        //         return false;
        //     }
        // }

        // //insert shipping charge as credit
        // if($data['shipping_charge']>0)
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['customer_note'];
        //     $journal_entry->debit_credit    = 0;
        //     $journal_entry->amount          = $data['shipping_charge'];
        //     $journal_entry->account_name_id = 20;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;

        //     if($journal_entry->save())
        //     {

        //     }
        //     else
        //     {
        //         //delete all journal entry for this invoice...
        //         $invoice = Invoice::find($invoice_id);
        //         $invoice->delete();
        //         return false;
        //     }
        // }


        // //insert adjustment as credit
        // if($data['adjustment'] != 0)
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note                = $data['customer_note'];
        //     if($data['adjustment']>0)
        //     {
        //         $journal_entry->debit_credit    = 0;
        //     }
        //     else
        //     {
        //         $journal_entry->debit_credit    = 1;
        //     }
        //     $journal_entry->amount              = abs($data['adjustment']);
        //     $journal_entry->account_name_id     = 18;
        //     $journal_entry->jurnal_type         = "invoice";
        //     $journal_entry->invoice_id          = $invoice_id;
        //     $journal_entry->contact_id          = $data['customer_id'];
        //     $journal_entry->created_by          = $user_id;
        //     $journal_entry->updated_by          = $user_id;

        //     if($journal_entry->save())
        //     {

        //     }
        //     else
        //     {
        //         //delete all journal entry for this invoice...
        //         $invoice = Invoice::find($invoice_id);
        //         $invoice->delete();
        //         return false;
        //     }
        // }


        // //return $account_array;
        // $invoice_entry = [];
        // for($j = 1; $j<count($account_array)-2; $j++)
        // {
        //     if ($account_array[$j] != 0)
        //     {
        //         $invoice_entry[] = [
        //             'note'              => $data['customer_note'],
        //             'debit_credit'      => 0,
        //             'amount'            => $account_array[$j],
        //             'account_name_id'   => $j,
        //             'jurnal_type'       => 'invoice',
        //             'invoice_id'        => $invoice_id,
        //             'contact_id'        => $data['customer_id'],
        //             'created_by'        => $user_id,
        //             'updated_by'        => $user_id,
        //             'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
        //             'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
        //         ];

        //     }
        // }

        // if (DB::table('journal_entries')->insert($invoice_entry))
        // {
        //     return true;
        // }
        // else
        // {
        //     //delete all journal entry for this invoice...
        //     $invoice = Invoice::find($invoice_id);
        //     $invoice->delete();
        //     return false;
        // }

        return false;

    }
}
