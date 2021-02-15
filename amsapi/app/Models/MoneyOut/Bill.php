<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    
    public function vendor()
    {
        return $this->belongsTo('App\User','vendor_id');
    }

    public function company()
    {
        return $this->belongsTo('App\User','company_id');
    }
    public function visa()
    {
        return $this->belongsTo('App\Models\Recruiting\Visa','
            visa_id');
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
