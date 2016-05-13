<?php

use Laravel\Socialite\Facades\Socialite; 
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

    public function testThatUserSignUpUsingOauth()
    {
        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('redirect')->andReturn('Redirected');
        $providerName = class_basename($provider);
        $socialAccount = factory('LearnCast\User')->create(['provider' => $providerName]);
        
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser->shouldReceive('getId')
            ->andReturn($socialAccount->provider_user_id)
            ->shouldReceive('getEmail')
            ->andReturn(str_random(10).'@noemail.app')
            ->shouldReceive('getNickname')
            ->andReturn('Olotin Temitope')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);
       
        Socialite::shouldReceive('driver')->with('facebook')->andReturn($provider);

        $this->visit('/auth/facebook/callback')
        ->seePageIs('/');
    }
}
