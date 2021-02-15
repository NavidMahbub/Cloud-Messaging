<?php

namespace Modules\Communication\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class MessagesCategory extends Resource
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
            'category_name' => $this->category_name,       
        ];


        
    }
}
