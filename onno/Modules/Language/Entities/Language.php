<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['name', 'icon_class','code', 'status', 'text_direction'];
    
}
