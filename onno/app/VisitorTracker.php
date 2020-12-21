<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorTracker extends Model
{
    public function post(){
        //   return $this->hasOne(Media::class ,'id', 'avatar_id');
        return $this->belongsTo('Modules\Post\Entities\Post', 'slug', 'slug');
    }
}
