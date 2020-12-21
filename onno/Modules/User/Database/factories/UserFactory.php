<?php

use Faker\Generator as Faker;

$factory->define(Modules\User\Entities\User::class, function (Faker $faker) {
    static $password;
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
    ];
});
