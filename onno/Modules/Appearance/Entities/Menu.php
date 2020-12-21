<?php

namespace Modules\Appearance\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menu';
    protected $fillable = [];

    public function menu_items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
