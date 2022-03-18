<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $this->faker->userName,
        'email' => $this->faker->email(),
        'password' => bcrypt('12345'),
        'S_Nombre' => $this->faker->firstname,
        'S_Apellidos' => $this->faker->lastname,
        'S_FotoPerfilUrl' => $this->faker->url(),
        'S_Activo' => $this->faker->numberBetween(0, 1),
    ];
});
