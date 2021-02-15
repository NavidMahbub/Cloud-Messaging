<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Invoice extends JsonResource
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
            'date'        => $this->date,
            'due_date'    => $this->due_date,
            'customer_id' => $this->customer_id,
            'account_id'  => $this->account_id,
            'account'     => $this->AccountInfo,
            'visa_id'     => $this->visa_id,
            'customer'    => $this->customer ? $this->customer->name : "" ,
            'customer_email' => $this->customer ? $this->customer->email : "" ,
            'agent_id' => $this->agent_id,
            'agent' => $this->agent ? $this->agent->name : "" ,
            'commission_type' => $this->commission_type,
            'commission_amount' => $this->commission_amount,
            'adjustment' => $this->adjustment,
            'total' => $this->total,
            'amount' => $this->amount,
            'mode' => $this->mode,
            'down_payment' => $this->down_payment,
            'installment_type' => $this->installment_type,
            'total_installment' => $this->total_installment,
            'per_installment_amount' => $this->per_installment_amount,
            'payment_id' => $this->payment_id,
            'due_amount' => $this->due_amount,
            'personal_note' => $this->personal_note,
            'customer_note' => $this->customer_note,
            'invoice_number' => $this->invoice_number,
            'invoice_items' => json_decode($this->invoice_items),
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : "" ,
            'created_by' => $this->createdBy ? $this->createdBy->name : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

