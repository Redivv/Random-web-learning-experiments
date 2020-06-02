<?php

namespace Tests\Integration;

use App\Article;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ArticleTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function can_fetch_most_popular_articles()
    {
        factory(Article::class, 3)->create();
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);
        
        $popularArticles = Article::trending()->get();

        $this->assertEquals($popularArticles->first()->id, $mostPopular->id);
        $this->assertCount(2, $popularArticles);
    }
}
