<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchVideoTest extends TestCase
{
    use DatabaseTransactions;

    public function testThatASearchKeywordReturnAResult()
    {
        $video = factory('App\Video', 5)->create();

        $this->visit('/search')
        ->type($video->first()->title, 'q')
        ->press('search')
        ->see($video->first()->title)
        ->see($video->first()->description);
    }

    public function testThatASearchKeywordReturnRecordNotFound()
    {
        $video = factory('App\Video')->create();

        $this->visit('/search')
        ->type('php', 'q')
        ->press('search')
        ->see('0 results found for:');
    }
}

