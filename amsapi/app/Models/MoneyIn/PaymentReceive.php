<?php

namespace App\Models\MoneyIn;

use Illuminate\Database\Eloquent\Model;

class PaymentReceive extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\User','customer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
