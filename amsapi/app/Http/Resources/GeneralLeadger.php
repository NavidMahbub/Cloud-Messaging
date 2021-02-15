<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralLeadger extends JsonResource
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
        if($this->jurnal_type=='invoice'){
            $number  = $this->invoice->invoice_number;
        }elseif ($this->jurnal_type=='payment_receive') {
            $number  = $this->paymentReceive->pr_number;
        }elseif ($this->jurnal_type=='expense') {
            $number  = $this->expense->id;
        }elseif ($this->jurnal_type=='income') {
           $number  = $this->income->id; 
        }elseif ($this->jurnal_type=='bill') {
           $number  = $this->bill->bill_number; 
        }elseif ($this->jurnal_type=='payment_made') {
           $number  = $this->PaymentMade->pm_number; 
        }else{
            $number = '';
        }
         
        return [
            'date' => \Carbon\Carbon::parse($this->updated_at)->format('d/m/Y'),
            'number' => $number,
            'jurnal_type' => $this->jurnal_type,
            'amount' => $this->amount,
            'contact' => $this->contact ? $this->contact->name:'',
            'account' => $this->account->name,
        ];
    }
}
