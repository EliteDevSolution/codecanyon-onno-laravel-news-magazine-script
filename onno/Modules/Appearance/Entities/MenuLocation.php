<?php

namespace Modules\Appearance\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuLocation extends Model
{
    protected $fillable = ['title', 'unique_name', 'menu_id'];

    public function menu()
    {
        return $this->hasOne('Modules\Appearance\Entities\Menu', 'id', 'menu_id');
    }

    public function menuItem()
    {
        return $this->hasMany('Modules\Appearance\Entities\MenuItem', 'menu_id', 'menu_id')->orderBy('order', 'asc');
    }

}
