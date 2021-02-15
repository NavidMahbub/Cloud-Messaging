<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'permissions',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected function contact(){
        return $this->hasOne('App\Contact');
    }

    public function district()
    {
        return $this->belongsTo('App\District','district_id');
    }

    public function upazila()
    {
        return $this->belongsTo('App\Upazila','subdistrict_id');
    }
    public function visasall(){
        return $this->hasMany('App\Models\Recruiting\Visa','user_id')->whereNotNull('okala_date');
    }
    public function cvisasall(){
        return $this->hasMany('App\Models\Recruiting\Visa','company_id')->whereNotNull('okala_date');
    }
    
     public function income(){
        return $this->hasMany('App\Models\MoneyIn\Income','customer_id');
    }
    public function expense(){
        return $this->hasMany('App\Models\MoneyOut\Expense','vendor_id');
    }
    public function userinfo(){
        return $this->belongsTo('App\Contact','user_id');
    }
     public function invoice(){
        return $this->hasMany('App\Models\MoneyIn\Invoice','customer_id');
    }
    public function roleUser()
    {
        return $this->hasOne('App\RoleUser','user_id');
    }
}
