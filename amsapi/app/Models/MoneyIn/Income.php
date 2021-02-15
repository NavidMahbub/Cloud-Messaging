<?php

namespace App\Models\MoneyIn;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'date',
        'amount',
        'utility',
        'car_parking',
        'registration_cost',
        'other_cost',
        'gift',
        'discount',
        'note',
        'reference',
        'account_id',
        'agent_id',
        'customer_id',
        'bank_info',
        'created_by',
        'updated_by'
    ];

    protected $table = 'incomes';

    public function agent()
    {
        return $this->belongsTo('App\User','agent_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\User','customer_id');
    }
    public function purpose()
    {
        return $this->belongsTo('App\Models\Account\Account','account_id');
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
