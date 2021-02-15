<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'parent_account_id',
        'required'
    ];

    protected $table = 'account_types';

    public function parentAccount()
    {
        return $this->belongsTo('App\Models\Account\ParentAccount','parent_account_id');
    }

    public function account()
    {
        return $this->hasMany('App\Models\Account\Account');
    }
}

