<?php

namespace Modules\Appearance\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [];
    protected $table='menu_item';

    public function menu()
    {
        return $this->hasOne('Modules\Appearance\Entities\Menu','id','menu_id');
    }
    public function parent()
    {
        return $this->belongsToOne(static::class, 'parent');
    }

    //each menu might have multiple children
    public function children()
    {
        return $this->hasMany(static::class, 'parent')
                    ->with('children')
                    ->orderBy('order', 'asc');
    }
   public function category()
    {
        return $this->belongsTo('Modules\Post\Entities\Category');
    }
   public function page()
    {
        return $this->belongsTo('Modules\Page\Entities\Page');
    }
    public function Post()
    {
        return $this->belongsTo('Modules\Post\Entities\Post');
    }

    public function postByCategory()
    {
        return $this->hasMany('Modules\Post\Entities\Post', 'category_id', 'category_id')
                    ->orderBy('id', 'desc')
                    ->take(4);
    }
}
