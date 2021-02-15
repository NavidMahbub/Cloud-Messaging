<?php

namespace App\Lib;

use Illuminate\Support\Facades\File;
use Auth;
use Carbon\Carbon;
use App\Models\Journal\JournalEntry;
use App\Models\Recruiting\Visa;
use App\Models\MoneyIn\Invoice;
use App\Models\MoneyOut\Bill;
class Helper
{
    
    public function ManualJournalEntries($id,$visa_id,$account_id,$amount,$contact_id,$note,$jurnal_type)
    {
        $user_id = Auth::user()->id;
        if($jurnal_type=='invoice'){
          $journal_entry = JournalEntry::where('invoice_id',$id)->first();
        }elseif($jurnal_type=='payment_receive'){
            $journal_entry = JournalEntry::where('payment_receive_id',$data->id)->first();
        }elseif($jurnal_type=='expense'){
            $journal_entry = JournalEntry::where('expense_id',$id)->first();
        }elseif($jurnal_type=='bill'){
            $journal_entry = JournalEntry::where('bill_id',$id)->first();
        }elseif($jurnal_type=='payment_made'){
            $journal_entry = JournalEntry::where('payment_made_id',$id)->first();
        }
        
        $new_entry = 0;
        if(empty($journal_entry))
        {
            $new_entry = 1;
            $journal_entry = new JournalEntry;
        }
       
        $journal_entry->note                    = $note;
        $journal_entry->debit_credit            = 1;
        $journal_entry->account_id              = $account_id;
        $journal_entry->jurnal_type             = $jurnal_type;
        $journal_entry->amount                  = $amount;
        $journal_entry->contact_id              = $contact_id;
        if($jurnal_type=='invoice'){
            $journal_entry->invoice_id          = $id;
        }elseif($jurnal_type=='payment_receive'){
            $journal_entry->payment_receive_id  = $id;
        }elseif($jurnal_type=='expense'){
            $journal_entry->expense_id          = $id;
        }elseif($jurnal_type=='bill'){
            $journal_entry->bill_id          = $id;
        }elseif($jurnal_type=='payment_made'){
            $journal_entry->payment_made_id     = $id;
        }
        $journal_entry->visa_id                 = $visa_id;
        if($new_entry==1){
            $journal_entry->created_by          = $user_id;
        }
        $journal_entry->updated_by              = $user_id;

        if($journal_entry->save())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function Invoice($date,$customer_id,$visa_id,$agent_id,$account_id,$total,$due_amount){
        $user_id = Auth::user()->id;
        $invoice = new Invoice();
        $invoice ->date = $date;
        $invoice ->customer_id = $customer_id;
        $invoice ->visa_id = $visa_id;
        $invoice ->agent_id = $agent_id;
        $invoice ->account_id = $account_id;
        $invoice ->total = $total;
        $invoice ->due_amount = $due_amount;
        $invoice ->invoice_number = "INV-1455-".sprintf('%07d',$this->igetlastid());
        $invoice ->created_by = $user_id;
        $invoice ->updated_by = $user_id;
        $invoice->save();
        return $invoice;
    }
    public function  igetlastid(){
        $lastid = Invoice::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }
    public function Bill($bill_date,$vendor_id,$visa_id,$amount,$due_amount,$company_id){
        $user_id = Auth::user()->id;
        $bill = new Bill();
        $bill ->bill_date = $bill_date;
        $bill ->vendor_id = $vendor_id;
        $bill ->visa_id = $visa_id;
        $bill ->amount = $amount;
        $bill ->due_amount = $due_amount;
        $bill ->bill_number = "BIL-1455-".sprintf('%07d',$this->bgetlastid());
        $bill ->company_id = $company_id;
        $bill ->created_by = $user_id;
        $bill ->updated_by = $user_id;
        $bill->save();
        return $bill;
    }
    public function  bgetlastid(){
        $lastid = Bill::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }
}