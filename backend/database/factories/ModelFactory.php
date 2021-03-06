<?php

use App\Models\Exif;
use App\Models\Photo;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\Thumbnail;
use App\Models\User;
use Faker\Generator;

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

$factory->define(Exif::class, function (Generator $faker) {
    return [
        'photo_id' => Photo::inRandomOrder()->first()->id,
        'data' => [],
    ];
});

$factory->define(Photo::class, function (Generator $faker) {
    return [
        'created_by_user_id' => User::inRandomOrder()->first()->id,
        'description' => $faker->realText(),
        'path' => sprintf('/%s/%s.%s', str_random(12), str_random(5), str_random(3)),
        'avg_color' => $faker->hexColor,
        'published_at' => $faker->boolean(75) ? \Carbon\Carbon::now() : null,
    ];
});

$factory->define(Subscription::class, function (Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'token' => str_random(64),
    ];
});

$factory->define(Tag::class, function (Generator $faker) {
    return [
        'value' => strtolower($faker->word),
    ];
});

$factory->define(Thumbnail::class, function (Generator $faker) {
    return [
        'path' => sprintf('/%s/%s.%s', str_random(12), str_random(5), str_random(3)),
        'width' => $faker->randomNumber(4),
        'height' => $faker->randomNumber(3),
    ];
});

$factory->define(User::class, function (Generator $faker) {
    static $password;
    return [
        'role_id' => Role::inRandomOrder()->first()->id,
        'name' => $faker->userName,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
