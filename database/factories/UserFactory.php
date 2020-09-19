<?php

use Faker\Generator as Faker;
use App\Models\User;

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
    $prefectures = array_values(config('pref'));
    $createdAt = $faker->dateTimeBetween($startDate = '-6 months', $endDate = '-1 months');
    $updatedAt = $faker->dateTimeBetween($createdAt->format('Y-m-d H:i:s').' +7 days', $createdAt->format('Y-m-d H:i:s').' +90 days');
    return [
        'name'       => $faker->name,
        'login_id'   => $faker->unique()->userName,
        'email'      => $faker->unique()->safeEmail,
        'password'   => 'hogehoge',
        'sex'        => $faker->randomElement(['男', '女']),
        'zip'        => $faker->postcode,
        'prefecture' => $faker->randomElement($prefectures),
        'address'    => $faker->city . $faker->streetAddress,
        'note'       => $faker->realText($faker->numberBetween(10, 20)),
        'created_at' => $createdAt,
        'updated_at' => $updatedAt,
    ];
});
