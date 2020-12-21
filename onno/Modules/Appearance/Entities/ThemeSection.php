<?php

namespace Modules\Appearance\Entities;

use Illuminate\Database\Eloquent\Model;

class ThemeSection extends Model
{
    protected $fillable = [
        'theme_id',
        'label',
        'order',
        'category_id',
        'post_amount',
        'section_style',
        'is_primary',
    ];

    public function category()
    {
        return $this->belongsTo('Modules\Post\Entities\Category', 'category_id', 'id');
    }

    public function ad()
    {
        return $this->belongsTo('Modules\Ads\Entities\Ad');
    }
}

