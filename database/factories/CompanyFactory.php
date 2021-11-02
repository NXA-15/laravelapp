<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Employee;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->safeEmail,
        'website' => $faker->domainName,
        'address' => $faker->address,
        'phone_number' => $faker->phoneNumber, 
    ];
});

$factory->define(Employee::class, function (Faker $faker) {
    $faker->addProvider(new Bluemmb\Faker\PicsumPhotosProvider($faker));
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'photo' => $faker->imageUrl(500,500, true),
        'phone_number' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});

$factory->define(Users::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => Hash::make('password'),
    ];
});
