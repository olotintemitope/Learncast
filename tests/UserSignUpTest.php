<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserSignUpTest extends TestCase
{
    use DatabaseTransactions;

    public function testThatUserSignUpWasSuccessful()
    {
        Session::start();

        $user = factory('LearnCast\User')->create();

        $response = $this->actingAs($user)
        ->call('POST', 'auth/register', [
            'username'       => 'laztopaz',
            'email'          => 'laztopaz@phptesting.unit',
            'password'       => bcrypt(str_random(10)),
            'profile_bio'    => 'I am a cool dude',
            'role_id'        => 1,
            'picture_url'    => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);

        $output = (array) json_decode($response->getContent());

        $this->assertEquals($output['message'], 'User created successful');
        $this->assertEquals($output['statuscode'], 201);
    }

    public function testThatUserAlreadyExists()
    {
        Session::start();

        $user = factory('LearnCast\User')->create([
            'username'       => 'laztopaz',
            'email'          => 'laztopaz@phptesting.unit',
            'password'       => bcrypt(str_random(10)),
            'profile_bio'    => 'I am a cool dude',
            'role_id'        => 1,
            'picture_url'    => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);

        $response = $this->actingAs($user)
        ->call('POST', 'auth/register', [
            'username'       => 'laztopaz',
            'email'          => 'laztopaz@phptesting.unit',
            'password'       => bcrypt(str_random(10)),
            'profile_bio'    => 'I am a cool dude',
            'role_id'        => 1,
            'picture_url'    => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',

        ]);

        $output = (array) json_decode($response->getContent());

        $this->assertEquals($output['message'], 'User already exist');
        $this->assertEquals($output['statuscode'], 400);
    }
}
