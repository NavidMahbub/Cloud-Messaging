<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'dashboard_watchlist',
        'required',
        'account_type_id',
        'created_by',
        'updated_by'
    ];

    protected $table = 'accounts';

    public function accountType()
    {
        return $this->belongsTo('App\Models\Account\AccountType','account_type_id');
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

