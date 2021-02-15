<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Income extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'date' => $this->date,
            'amount' => $this->amount,
            'mode' => $this->mode_id,
            'utility' => $this->utility,
            'discount' => $this->discount,
            'car_parking' => $this->car_parking,
            'registration_cost' => $this->registration_cost,
            // 'tax_total' => $this->tax_total,
            'other_cost' => $this->other_cost,
            'gift' => $this->gift,
            'note' => $this->note,
            'reference' => $this->reference,
            'account_id' => $this->account_id,
            'account' => $this->purpose->name,
            'agent_id' => $this->agent_id,
            'agent' => $this->agent ? $this->agent->name : "" ,
            'customer_id' => $this->customer_id,
            'customer' => $this->customer ? $this->customer->name : "" ,
            'bank_info' => $this->bank_info,
            'parent_account_id' => $this->purpose->accountType->parent_account_id,
            'parent_account' => $this->purpose->accountType->parentaccount->name,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : "" ,
            'created_by' => $this->createdBy ? $this->createdBy->name : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

