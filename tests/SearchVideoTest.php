<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchVideoTest extends TestCase
{
    use DatabaseTransactions;

    public function testThatASearchKeywordReturnAResult()
    {
        $video = factory('LearnCast\Video', 5)->create();

        $this->visit('/search')
        ->type($video->first()->title, 'q')
        ->press('search')
        ->see($video->first()->title)
        ->see($video->first()->description);
    }

    public function testThatASearchKeywordReturnRecordNotFound()
    {
        $video = factory('LearnCast\Video')->create();

        $this->visit('/search')
        ->type('php', 'q')
        ->press('search')
        ->see('0 results found for:');
    }
}
