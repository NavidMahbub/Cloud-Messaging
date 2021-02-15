<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Account\AccountType::class, function (Faker $faker) {
    $name = $faker->randomElement(['Income','Other Income']);
    return [
        'name' => $name,
        'parent_account_id'=> $faker->numberBetween(1,2)
    ];
});
