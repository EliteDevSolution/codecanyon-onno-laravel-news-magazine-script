<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','slug','description'];

    public static function allPermission(){
        return Static::all();
    }
}
