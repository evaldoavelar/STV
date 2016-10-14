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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Curso::class, function (Faker\Generator $faker) {
    return [
        'titulo' => $faker->title,
        'descricao' => $faker->text,
        'instrutor' => $faker->name,
        'categoria_id' => str_random(1,5),
        'palavras_chaves' =>  $faker->words('curso','teste','laravel'),
        'publicado' => str_random(0,1)
    ];
});

$factory->defineAs(App\Unidade::class, function (Faker\Generator $faker) use ($factory) {

   // $curso_id = factory(App\Curso::class)->create()->id;

    return [
        'curso_id' =>   $faker->uuid,
        'descricao' => $faker->text
    ];
});


