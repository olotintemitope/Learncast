<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileUpdateTest extends TestCase
{
    use DatabaseTransactions;

    public function testThatUserBackgroundDetailsWasUpdated()
    {
        $user = factory('LearnCast\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->type('Im a cool and God fearing man.', 'profile_bio')
            ->press('Update')
            ->see('Sucessfully updated!');
    }

    public function testThatOnlyAuthenticatedUserCanUpdateTheirProfile()
    {
        $user = factory('LearnCast\User')->create();

        $this->visit('/dashboard/profile')
            ->seePageIs('/login');
    }

    public function testThatUserProfileWasNotUpdated()
    {
        $user = factory('LearnCast\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->type('lytopz', 'username')
            ->type('lytopz@gmail.com', 'email')
            ->type('', 'profile_bio')
            ->press('Update')
            ->see('The profile bio field is required.');
    }

    public function testThatSomeFieldsAreMissing()
    {
        $user = factory('LearnCast\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->type('', 'username')
            ->type('', 'email')
            ->type('', 'profile_bio')
            ->press('Update')
            ->see('The username field is required.')
            ->see('The email field is required.')
            ->see('The profile bio field is required.');
    }

    public function testThatImageWasNotSelected()
    {
        $user = factory('LearnCast\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->press('Upload')
            ->see('File accepted must be a jpg and not more 10MB!');
    }

    public function testThatTheUserUploadProfilePicture()
    {
        $user = factory('LearnCast\User')->create();

        $this->actingAs($user)
            ->visit('/dashboard/profile')
            ->attach(storage_path('laz.jpg'), 'picture_url')
            ->press('Upload')
            ->see('Profile picture update successfully!');
    }
}
