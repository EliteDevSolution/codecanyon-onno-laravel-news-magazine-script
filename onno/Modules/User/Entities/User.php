<?php

namespace Modules\User\Entities;

use Illuminate\Auth\Authenticatable;
use Modules\User\Repositories\Permission;
use Cartalyst\Sentinel\Users\EloquentUser;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Tymon\JWTAuth\Contracts\JWTSubject;
use JWTAuth;


use Illuminate\Database\Eloquent\Model;


use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends EloquentUser implements JWTSubject
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'newsletter_enable'
    ];
    use Authenticatable;

	public function withRoles() {
		return $this -> belongsToMany( static::$rolesModel , 'role_users' , 'user_id' , 'role_id' ) -> withTimestamps() ;
	}

	public function withActivation() {

        return $this->hasOne('Modules\User\Entities\Activation');
    }

    public static function byEmail($email){
        return static::whereEmail($email)->first();

    }
    public function image(){
    //   return $this->hasOne('Modules\Gallery\Entities\Image' ,'id', 'image_id');
    return $this->belongsTo('Modules\Gallery\Entities\Image');
    }


        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'email'           => $this->email,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];
    }

    protected $casts = [
        "social_media" => "array"
    ];

}
