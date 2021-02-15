<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
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
            'id'=>$this->id,
            'project_category_id'=>$this->project_category_id,
            'category'=>$this->projectCategory ? $this->projectCategory->name : "" ,
            'status'=>$this->status,
            'name'=>$this->name,
            'type'=>$this->type,
            'block_no'=>$this->block_no,
            'road_no'=>$this->road_no,
            'plot_size'=>$this->plot_size,
            'sales_price'=>$this->sales_price,
            'purchase_price'=>$this->purchase_price,
            'location'=>$this->location,
            'image'=>$this->image,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : "" ,
            'created_by' => $this->createdBy ? $this->createdBy->name : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
