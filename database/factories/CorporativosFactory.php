<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tw_corporativos;
use Faker\Generator as Faker;

$factory->define(tw_corporativos::class, function (Faker $faker) {
    return [
        'S_NombreCorto' => $this->faker->firstname,
        'S_NombreCompleto' => $this->faker->name,
        'S_LogoURL' => $this->faker->url(),
        'S_DBName' => $this->faker->name,
        'S_DBUsuarios' => $this->faker->userName,
        'S_DBPassword' => $this->faker->password(8, 16),
        'S_SystemUrl' => $this->faker->url(),
        'S_activo' => $this->faker->numberBetween(0, 1),
        'users_id' => $this->faker->numberBetween(1,10),
    ];
});
