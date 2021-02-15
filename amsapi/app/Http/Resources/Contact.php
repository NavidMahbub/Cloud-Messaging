<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
         return [
            'id' => $this->id,
            'type' => $this->user->type,
            'name' => $this->user->name,
            'designation' => $this->designation,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'spouse_name' => $this->spouse_name,
            'area_code' => $this->area_code,
            'mobile_number' => $this->mobile_number,
            'contact_number' => $this->contact_number,
            'email' => $this->user->email,
            'occupation' => $this->occupation,
            'nid' => $this->nid,
            'birthday' => $this->birthday,
            'ward_union' => $this->ward_union,
            'area_village' => $this->area_village,
            'street_para' => $this->street_para,
            'post_ofiice' => $this->post_ofiice,
            'company_name' => $this->company_name,
            'agent_id' => $this->agent_id,
            'district_name' => $this->district->name,
            'district_id' => $this->district->id,
            'subdistrict_name' => $this->upazila->name,
            'subdistrict_id' => $this->upazila->id,
            'agent' => $this->agent,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->createdBy->name,  
            'updated_by' => $this->updatedBy->name, 
      
            
        ];
    }
}

