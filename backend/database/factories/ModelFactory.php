<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\Core\DAL\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'api_token' => str_random(64),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Core\DAL\Models\Photo::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomDigit,
        'description' => $faker->realText(),
        'path' => sprintf('/%s/%s.%s', str_random(12), str_random(5), str_random(3)),
        'relative_url' => sprintf('/%s/%s/%s.%s', str_random(12), str_random(12), str_random(5), str_random(3)),
        'is_published' => true,
    ];
});


$factory->define(\Core\DAL\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'text' => $faker->word,
    ];
});


$factory->define(\Core\DAL\Models\Thumbnail::class, function (Faker\Generator $faker) {
    return [
        'path' => sprintf('/%s/%s.%s', str_random(12), str_random(5), str_random(3)),
        'relative_url' => sprintf('/%s/%s/%s.%s', str_random(12), str_random(12), str_random(5), str_random(3)),
        'width' => $faker->randomNumber(4),
        'height' => $faker->randomNumber(3),
    ];
});
