<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'date',
        'amount',
        'tax_total',
        'note',
        'reference',
        'account_id',
        'vendor_id',
        'bank_info'
    ];

    protected $table = 'expenses';

    public function vendor()
    {
        return $this->belongsTo('App\User','vendor_id');
    }

    public function purpose()
    {
        return $this->belongsTo('App\Models\Account\Account','account_id');
    }
}

