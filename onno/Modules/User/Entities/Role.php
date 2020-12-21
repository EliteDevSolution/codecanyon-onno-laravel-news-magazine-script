<?php

namespace Modules\User\Entities;

use Modules\User\Repositories\Permission;
use Cartalyst\Sentinel\Roles\EloquentRole;

class Role extends EloquentRole
{
	public function withUsers() {
		return $this -> belongsToMany( static::$usersModel , 'role_users' , 'role_id' , 'user_id' ) -> withTimestamps() ;
	}

    public static function allRole(){
        return Static::all();
    }

    public function scopeWithoutSuperadmin($query)
    {
        return $query->where('id', '!=', 1);
    }
}
