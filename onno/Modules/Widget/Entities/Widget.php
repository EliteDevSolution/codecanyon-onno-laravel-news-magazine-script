<?php

namespace Modules\Widget\Entities;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = [
        'title',
        'language',
        'location',
        'content_type',
        'content',
        'order',
        'status',
    ];

    public function ad()
    {
        return $this->belongsTo('Modules\Ads\Entities\Ad');
    }
}
