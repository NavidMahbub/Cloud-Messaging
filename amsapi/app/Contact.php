<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'designation',
        'father_name',
        'mother_name',
        'spouse_name',
        'area_code',
        'mobile_number',
        'contact_number',
        'occupation',
        'nid',
        'birthday',
        'district_id',
        'subdistrict_id',
        'ward_union',
        'area_village',
        'street_para',
        'post_ofiice',
        'company_name',
        'agent_id',
        'image',
        'created_by',
        'updated_by'
    ];

    protected $table = 'contacts';

    public function district()
    {
        return $this->belongsTo('App\District','district_id');
    }

    public function upazila()
    {
        return $this->belongsTo('App\Upazila','subdistrict_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Contact','agent_id');
    }

    public function land(){
        return $this->hasMany('App\LandInfo');
    }
    
   

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
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
