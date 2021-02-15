<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class ParentAccount extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $table = 'parent_accounts';

    public function accountType()
    {
        return $this->hasMany('App\Models\Account\AccountType');
    }
}
