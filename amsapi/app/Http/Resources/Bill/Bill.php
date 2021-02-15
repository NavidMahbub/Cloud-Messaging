<?php

namespace App\Http\Resources\Bill;

use Illuminate\Http\Resources\Json\JsonResource;

class Bill extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'date'   => $this->bill_date,
            'due_date'    => $this->due_date,
            'customer_id'   =>   $this->vendor_id,
            'visa_id'     => $this->visa_id,
            'vendor'    => $this->vendor ? $this->vendor->name : "" ,
            'company'     => $this->company ? $this->company->name : "" ,
            'amount'      => $this->amount,
            'due_amount'  =>$this->due_amount,
            'note'        => $this->note,
            'bill_number' => $this->bill_number,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : "" ,
            'created_by' => $this->createdBy ? $this->createdBy->name : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
