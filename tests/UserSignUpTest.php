<?php 

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserSignUpTest extends TestCase
{
    use DatabaseTransactions;

    public function testCheckAllFieldsEmpty()
    {
        $this->WithoutMiddleware();

        $user = factory('App\User')->create([
            'username' => 'lytopze', 
            'email'    => 'lytopze@gmail.com', 
            'password' => 'tope0852', 
            'role_id'  => 1, 
        ]);

        $response = $this->actingAs($user)
           ->call('POST', 'auth/register', [
               'username'    => 'lytopze',
               'email'       => 'lytopze@gmail.com', 
               'password'    => 'tope0852',
           ]);

        var_dump($response->getContent());
    }

}