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
        'admin' => rand (1,0),
        'ativo'=> rand (1,0),
    ];
});

$factory->define(App\Categoria::class, function (Faker\Generator $faker) {
    return [
        'descricao' => $faker->text,
    ];
});

$factory->define(App\Curso::class, function (Faker\Generator $faker) {

    $categoria_id = factory(App\Categoria::class)->create()->id;

    $curso = [
        'titulo' => $faker->title. $faker->uuid,
        'descricao' => $faker->text,
        'instrutor' => $faker->name,
        'categoria_id' => $categoria_id,
        'palavras_chaves' =>  $faker->streetName,  // $faker->words($nb = 3, $asText = false),
        'publicado' => rand (0,1)
    ];

    return $curso;
});

$factory->defineAs(App\Unidade::class,'unidades', function (Faker\Generator $faker) use ($factory) {

  // $curso_id = factory(App\Curso::class)->create()->id;
    return [
        'curso_id' =>   $faker->uuid,
        'descricao' => $faker->text
    ];
});

$factory->defineAs(App\Video::class,'videos', function (Faker\Generator $faker) use ($factory) {

    return [
        'titulo' => $faker->title.$faker->uuid,
        'unidade_id' =>   $faker->uuid,
        'descricao' => $faker->text,
        'url' => $faker->text,

    ];
});

$factory->defineAs(App\Material::class,'materiais', function (Faker\Generator $faker) use ($factory) {

    return [
        'titulo' => $faker->title.$faker->uuid,
        'unidade_id' =>   $faker->uuid,
        'descricao' => $faker->text,
        'arquivo' => $faker->text,

    ];
});

$factory->defineAs(App\Atividade::class,'atividades', function (Faker\Generator $faker) use ($factory) {

    return [
        'titulo' => $faker->title.$faker->uuid,
        'unidade_id' =>   $faker->uuid,
        'descricao' => $faker->text,
    ];
});

$factory->defineAs(App\Questao::class,'questoes', function (Faker\Generator $faker) use ($factory) {

    return [
        'atividade_id' =>   $faker->uuid,
        'enunciado' => $faker->text,
    ];
});

$factory->defineAs(App\Resposta::class,'respostas', function (Faker\Generator $faker) use ($factory) {

    return [
        'questao_id' =>   $faker->uuid,
        'enunciado' => $faker->text,
        'correta' => rand(0,1),
    ];
});
