<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserLoginTest extends TestCase
{
    use DatabaseTransactions;

    public function testThatUserDoesNotSuppliedLoginDetails()
    {
        $this->visit('/login')
            ->type('', 'username')
            ->type('', 'password')
            ->press('Log In')
            ->see('Whoops! Something went wrong!')
            ->see('The username field is required.')
            ->see('The password field is required.');
    }

    public function testThatUserLoginWasSuccessful()
    {
        $user = factory('LearnCast\User')->create([
            'username'       => 'laztopaz',
            'email'          => 'laztopaz@phptesting.unit',
            'password'       => bcrypt('tope0852'),
            'profile_bio'    => 'I am a cool dude',
            'role_id'        => 1,
            'picture_url'    => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',

        ]);

        $this->actingAs($user)
           ->visit('/login')
           ->type('laztopaz', 'username')
           ->type('tope0852', 'password')
           ->press('Log In')
           ->see('Laztopaz\'s profile');
    }

    public function testThatUserLoginWasNotSuccessful()
    {
        $this->visit('/login')
            ->type('olabode', 'username')
            ->type('lanreshittu', 'password')
            ->press('Log In')
            ->see('Oops! Login attempt failed!');
    }
}
