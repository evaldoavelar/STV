<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPodeRealizarLogin()
    {
        $admin = factory(App\User::class)->create(['admin'=>true]);
        $user = factory(App\User::class)->create(['admin'=>false]);
        //autenticar
        $this->be($user);

        //ação
        $this->visit('/login')
            ->submitForm('Login',[
                'password'=>$user->password,
                'email'=>$user->email,
            ])
            ->seePageIs('/home');

    }
}
