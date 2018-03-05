<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_post_creation(){
        factory(Post::class)->create([
            'title' => 'test title',
            'body' => 'test body',
            'category_id' => 1,
            'solved' => FALSE
        ]);

        $this->assertDatabaseHas('posts', ['body' => 'test body']);
    }

}
