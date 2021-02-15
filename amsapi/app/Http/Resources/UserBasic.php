<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MoneyIn\Invoice;
use App\Models\MoneyIn\PaymentReceive;
use App\Http\Resources\Recruiting\VisaBasic as VisaResources;
use App\Models\Recruiting\Visa;
use DB;
use App\Models\Journal\JournalEntry;

class UserBasic extends JsonResource
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
                ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')->where('journal_entries.contact_id',$this->id)->sum('journal_entries.amount');
        $total_receive = JournalEntry::where('jurnal_type','payment_receive')->where('contact_id',$this->id)->sum('amount');
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'total_receive'=>$total_receive,
            'total_invoice'=>$total_invoice,
            'type'=>$this->type,
            'contact_id' => $this->contact->id,
            'updated_by' => $this->contact->updatedBy ? $this->contact->updatedBy->name : "" ,
            'created_by' => $this->contact->createdBy ? $this->contact->createdBy->name : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'role_id' => $this->roleUser ? $this->roleUser->role->id:null,
            'role_name' => $this->roleUser ? $this->roleUser->role->name:"",
            
        ];
    }
}
