<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ArticleTest extends TestCase
{
	use DatabaseTransactions;
     /** @test */
     public function it_has_most_popular()
     {
     	$article = factory(Article::class, 2)->create();
     	$popular = factory(Article::class)->create(['reads' => 10]);
     	$mostpopular = factory(Article::class)->create([ 'reads' => 20 ]);

     	$articles = Article::trending(2);

     	$this->assertEquals($mostpopular->id, $articles->first()->id);
     	$this->assertCount(2, $articles);

     }
}
