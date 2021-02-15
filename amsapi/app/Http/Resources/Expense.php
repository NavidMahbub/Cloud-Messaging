<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Expense extends JsonResource
{
    
    public function toArray($request)
    {
        // return parent::toArray($request);
        
        return [
            'id' => $this->id,
            'date' => $this->date,
            'amount' => $this->amount,
            'tax_total' => $this->tax_total,
            'account_id' => $this->account_id,
            'account' => $this->purpose->name,
            'vendor_id' => $this->vendor_id,
            'vendor' => $this->vendor ? $this->vendor->name : "" ,
            'bank_info' => $this->bank_info,
            'reference' => $this->reference,
            'note' => $this->note,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : "" ,
            'created_by' => $this->createdBy ? $this->createdBy->name : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
