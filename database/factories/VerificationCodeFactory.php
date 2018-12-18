<?php
use Faker\Generator as Faker;

$factory->define(App\Models\VerificationCode::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'channel' => 'sms',
        'account' => $faker->phoneNumber,
        'code' => $faker->numberBetween(1000, 999999),
        'state' => 0,
    ];
});
