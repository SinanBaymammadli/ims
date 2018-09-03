<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $purchase_price = $faker->numberBetween($min = 100, $max = 10000);

    return [
        'user_id' => 3,
        'name' => $faker->unique()->word(),
        'amount' => $faker->numberBetween($min = 100, $max = 1000),
        'min_required_amount' => $faker->numberBetween($min = 5, $max = 50),
        'purchase_price' => $purchase_price,
        'sale_price' => $faker->numberBetween($min = $purchase_price, $max = $purchase_price + $purchase_price * 0.4),
    ];
});
