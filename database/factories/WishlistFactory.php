<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\User;
use App\Wishlist;
use Faker\Generator as Faker;

$factory->define(Wishlist::class, function (Faker $faker) {

    $user = User::has('categories')->get()->random();
    
    return [
        'user_id' => $user->id, 
        'category_id' => $user->categories()->get()->random()->id, 
        'priority' => mt_rand(1, 50), 
        'name' => $faker->sentence(4), 
        'url' => $faker->url(), 
        'price' => $faker->randomFloat(2, 1, 300),
        'purchased' => mt_rand(0,1), 
    ];

});
