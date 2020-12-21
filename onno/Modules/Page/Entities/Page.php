<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [];

    public function image(){
        return $this->belongsTo('Modules\Gallery\Entities\Image');
    }

    public function menuItem()
    {
        return $this->hasMany('Modules\Appearance\Entities\MenuItem');
    }
}
