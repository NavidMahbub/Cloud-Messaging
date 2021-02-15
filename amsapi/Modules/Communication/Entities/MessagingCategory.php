<?php

namespace Modules\Communication\Entities;

use Illuminate\Database\Eloquent\Model;

class MessagingCategory extends Model
{
    protected $table = 'messaging_categories';

    protected $fillable = [
        'id',
        'category_name',
    ];
}
