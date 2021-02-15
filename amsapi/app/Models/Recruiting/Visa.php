<?php

namespace App\Models\Recruiting;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    public function created_by_o(){
        return $this->belongsTo('App\User','created_by');
    }
    public function company(){
        return $this->belongsTo('App\User','company_id');
    }
    public function updated_by_o(){
        return $this->belongsTo('App\User','updated_by');
    }
    public function diving_licence_by_o(){
        return $this->belongsTo('App\User','diving_licence_by');
    }
    public function police_clearence_by_o(){
        return $this->belongsTo('App\User','police_clearence_by');
    }
    public function medical_by_o(){
        return $this->belongsTo('App\User','medical_by');
    }
    public function musaned_date_by_o(){
        return $this->belongsTo('App\User','musaned_date_by');
    }
    public function okala_date_by_o(){
        return $this->belongsTo('App\User','okala_date_by');
    }
    public function mofa_date_by_o(){
        return $this->belongsTo('App\User','mofa_date_by');
    }
    public function stamping_by_o(){
        return $this->belongsTo('App\User','stamping_by');
    }
    public function finger_training_by_o(){
        return $this->belongsTo('App\User','finger_training_by');
    }
    public function manpowe_date_by_o(){
        return $this->belongsTo('App\User','manpowe_date_by');
    }
    public function flight_date_by_o(){
        return $this->belongsTo('App\User','flight_date_by');
    }
    public function agent_id_o(){
        return $this->belongsTo('App\User','agent_id');
    }
    public function client(){
        return $this->belongsTo('App\User','user_id');
    }
    public function user_id_o(){
        return $this->belongsTo('App\User','user_id');
    }
}
