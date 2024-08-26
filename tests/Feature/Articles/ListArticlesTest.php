<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListArticlesTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_fetch_a_single_article()
    {
      $this->withoutExceptionHandling();

      $article = Article::factory()->create();

      $response =  $this->getJson(route('api.ve.articles.show', $article));

      $response->assertExactJson([
        'data' => [
            'type' => 'articles',
            'id' => (string)$article->getRouteKey(),
            'attributes' => [
                'title' => $article->title,
                'slug' => $article->slug,
                'content' => $article->content
            ],
        'linls' => [
            'self' =>route('api.ve.articles.show', $article)
        ]
        ]
      ]);
    }
}
