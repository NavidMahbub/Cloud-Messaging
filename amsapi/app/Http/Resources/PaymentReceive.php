<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentReceive extends JsonResource
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
            'id' => $this->id,
            'date' => $this->date,
            'customer_id' => $this->customer_id,
            'due' => $this->due,
            'customer' => $this->customer ? $this->customer->name : "" ,
            'customer_email' => $this->customer ? $this->customer->email : "" ,
            'amount' => $this->amount,
            'payment_mode' => $this->payment_mode_id,
            'reference' => $this->reference,
            'customer_note' => $this->customer_note,
            'pr_number' => $this->pr_number,
            'invoices' => json_decode($this->invoices),
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : "" ,
            'created_by' => $this->createdBy ? $this->createdBy->name : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
