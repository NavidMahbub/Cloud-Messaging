<?php

namespace App\Http\Resources\PaymentMade;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMade extends JsonResource
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
            'date'        => $this->payment_date,
            'customer_id' => $this->vendor_id,
            'vendor'      => $this->vendor ? $this->vendor->name : "" ,
            'payment_mode_id'      => $this->payment_mode_id,
            'amount'      => $this->amount,
            'pm_number' => $this->pm_number,
            'paymentMode' => $this->paymentMode->name,
            'reference' => $this->reference,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : "" ,
            'created_by' => $this->createdBy ? $this->createdBy->name : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
