<?php

namespace Modules\Ads\Entities;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    // protected $fillable = [];
    protected $guarded = array();

    public function adImage(){
        return $this->belongsTo('Modules\Gallery\Entities\Image', 'ad_image_id','id');
    }
}
