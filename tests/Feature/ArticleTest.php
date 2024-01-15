<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Article;

class ArticleTest extends TestCase
{

    use RefreshDatabase;

    public function test(): void
    {
        // $articles = Article::factory()->count(3)->create();

        // $response = $this
        //     ->jsonApi()
        //     ->expects('articles')
        //     ->get('/clients/foo/articles');

        // $response->assertFetchedMany($articles);
    }
}
