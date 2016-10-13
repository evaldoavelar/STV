<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }


    public function setUp()
    {
        parent::setUp();

        $this->prepareForTests();
    }

    //o banco de dados de teste está na memória,
    //então toda as vezes que executar os testes é nescessário chamar o migrate
    private function prepareForTests()
    {
        Artisan::call('migrate');
    }
}
