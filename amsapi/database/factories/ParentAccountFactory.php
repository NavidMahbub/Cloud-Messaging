<?php

use Faker\Generator as Faker;



$factory->define(App\Models\Account\ParentAccount::class, function (Faker $faker) {
	// $list = ['Income','Expense','Asset','Liability'];
	// $name = $list[$faker->sequence(true, )->next];
	$name = $faker->randomElement(['Income','Expense','Asset','Equity','Liability']);
    return [
        'name' => $name
    ];
});
