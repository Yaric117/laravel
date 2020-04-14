<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(News::class, function (Faker $faker) {

    $title = $faker->sentence(rand(5, 9));

    return [
        'title' => $title,
        'title_alias' => Str::slug($title, '-'),
        'category_id' => rand(1, 3),
        'text' => $faker->realText(rand(300, 600)),
        'isPrivate' => (bool) rand(0, 1)
    ];
});
