<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RecurringPayment;
use App\User;
use Faker\Generator as Faker;

$factory->define(RecurringPayment::class, function (Faker $faker) {

    $user = User::has('categories')->get()->random();

    return [
        'user_id' => $user->id, 
        'category_id' => $user->categories()->get()->random()->id, 
        'date' => $faker->numberBetween(1, 25), 
        'name' => $faker->sentence(4), 
        'price' => $faker->randomFloat(2, 1, 300),
    ];
});
