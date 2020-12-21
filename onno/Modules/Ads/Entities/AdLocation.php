<?php

namespace Modules\Ads\Entities;

use Illuminate\Database\Eloquent\Model;

class AdLocation extends Model
{
    protected $fillable = [];
    
    public function ad(){
        return $this->belongsTo('Modules\Ads\Entities\Ad');
    }
}
