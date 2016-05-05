<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserSignUpTest extends TestCase
{
    use DatabaseTransactions;

    public function testCheckAllFieldsEmpty()
    {
        $this->WithoutMiddleware();

        $user = factory('App\User')->create();

        $response = $this->actingAs($user)
           ->call('POST', 'auth/register', [
               'username'    => 'lytopze',
               'email'       => 'lytopze@gmail.com',
               'password'    => 'tope0852',
           ]);
    }
}
