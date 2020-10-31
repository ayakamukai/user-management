<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Bookmark;

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

$factory->define(Bookmark::class, function (Faker $faker) {
    $users = User::pluck('id')->all();
    $createdAt = $faker->dateTimeBetween($startDate = '-6 months', $endDate = '-1 months');
    $updatedAt = $faker->dateTimeBetween($createdAt->format('Y-m-d H:i:s').' +7 days', $createdAt->format('Y-m-d H:i:s').' +90 days');
    return [
        'site_name' => $faker->domainWord,
        'url' => $faker->url,
        'user_id' => $faker->randomElement($users),
        'created_at' => $createdAt,
        'updated_at' => $updatedAt,
    ];
});
