<?php

namespace Modules\Communication\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class Meassages extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'body' => $this->body ,
            'parent_id'  => $this->parent_id ,
            'user_name'  => $this->user ? $this->user->name: "" ,
            'user_id'  => $this->user ? $this->user->id: null ,
            'image'  => $this->contact ? $this->contact->image:"" ,
            'created_at' => $this->created_at->toDayDateTimeString(),
            'created_at_ago' => $this->created_at->diffForHumans(),
        ];


        
    }
}
