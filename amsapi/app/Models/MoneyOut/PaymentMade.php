<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class PaymentMade extends Model
{
    public function vendor()
    {
        return $this->belongsTo('App\User','vendor_id');
    }
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function paymentMode()
    {
        return $this->belongsTo('App\Models\Account\PaymentMode','payment_mode_id');
    }
    

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
