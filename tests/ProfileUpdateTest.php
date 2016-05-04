<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileUpdateTest extends TestCase
{
    use DatabaseTransactions;

    public function testThatUserBackgroundDetailsWasUpdated()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->type('Im a cool and God fearing man.', 'profile_bio')
            ->press('Update')
            ->see('Sucessfully updated!');
    }

    public function testThatUserBackgroundDetailsIsMissing()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->type('lytopz', 'username')
            ->type('lytopz@gmail.com', 'email')
            ->press('Update')
            ->see('The profile bio field is required.');
    }

    public function testThatSomeFieldsAreMissing()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->press('Update')
            ->see('The profile bio field is required.');
    }

    public function testThatImageWasNotSelected()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->press('Upload')
            ->see('File accepted must be a jpg and not more 10MB!');
    }

    public function testThatTheUserUploadProfilePicture()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->attach(storage_path('laz.jpg'), 'picture_url')
            ->press('Upload')
            ->see('Profile picture update successfully!');
    }
}