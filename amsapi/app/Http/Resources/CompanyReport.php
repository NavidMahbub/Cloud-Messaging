<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Journal\JournalEntry;
use App\User;
class CompanyReport extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
                 ->whereNotNull('visas.okala_date')->where('visas.status',1)
                ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')->where('journal_entries.contact_id',$this->company_id)->sum('journal_entries.amount');
        $total_bill  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
                 ->whereNotNull('visas.okala_date')->where('visas.status',1)
                ->select('journal_entries.*')->where('journal_entries.jurnal_type','bill')->where('journal_entries.contact_id',$this->company_id)->sum('journal_entries.amount');
        $total_receive = JournalEntry::where('jurnal_type','payment_receive')->where('contact_id',$this->company_id)->sum('amount');
        $total_payment_made = JournalEntry::where('jurnal_type','payment_made')->where('contact_id',$this->company_id)->sum('amount');
        //$customer_name = User::find($this->user_id)->name;
        return [
            'customer_name'      => $this->company->name,
            'company_id'         => $this->company_id,
            'total_worker'       => $this->total,
            'total_invoice'      => $total_invoice,
            'total_bill'         => $total_bill,
            'total_receive'      => $total_receive,
            'total_payment_made' => $total_payment_made,
            'account_status'                => ($total_invoice+$total_payment_made)-($total_bill+$total_receive),
        ];
    }
}
