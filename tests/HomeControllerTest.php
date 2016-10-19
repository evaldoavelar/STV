<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPodeRedirecionarParaLogin()
    {
        $this->visit('/curso-novo/')
            ->seePageIs('/login');
    }


    public function testPodeAcessarLogin()
    {
        $this->visit('/home')
            ->click('Login')
            ->click('Login')
            ->seePageIs('/login');
    }

}
