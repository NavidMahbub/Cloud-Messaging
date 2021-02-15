<?php

namespace App\Http\Resources\Recruiting;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Models\MoneyIn\Invoice;
use App\Models\MoneyIn\PaymentReceive;
use App\Models\Journal\JournalEntry;
class VisaBasic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
         $processing_rate_i = Invoice::where('account_id',1)->where('visa_id',$this->id)->sum('total');
         $update = Invoice::where('account_id',2)->where('visa_id',$this->id)->sum('total');
         $others = Invoice::where('account_id',3)->where('visa_id',$this->id)->sum('total');
         $total_invoice  = JournalEntry::where('jurnal_type','invoice')->where('visa_id',$this->id)->sum('amount');
         $total_bill  = JournalEntry::where('jurnal_type','bill')->where('visa_id',$this->id)->sum('amount');

         return [
            'id'                              =>$this->id,
            'worker_number'                   =>$this->worker_number,
            'passport_number'                 =>$this->passport_number,
            'passport_name'                   =>$this->passport_name,
            'processing_rate_i'               =>$processing_rate_i,
            'processing_rate'                 =>$this->processing_rate_i,
            'update'                          =>$update,
            'others'                          =>$others,
            'total_bill'                      =>$total_bill,
            'total_invoice'                   =>$total_invoice,
            'visa_number'                     =>$this->visa_number,
            'company_id_number'               =>$this->company_id_number,
            'occupation'                      =>$this->occupation,
            'type'                            =>$this->type,
            'agent_id'                        =>$this->agent_id,
            'user'                            =>$this->user_id_o->name,
            'user_id'                         =>$this->user_id,
            'company_id'                      =>$this->company_id,
             'company'      =>$this->company?$this->company->name: "" ,
            'status'                          =>$this->status?true:false,
            'updated_by'                       =>$this->updated_by_o->name,
            'created_at'                      =>$this->created_at->format('d M Y'),
            'updated_at'                      =>$this->updated_at->diffForHumans(),
        ];
    }
}
