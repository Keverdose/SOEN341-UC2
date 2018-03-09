<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Post;
use App\User;
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

    /**
     * Testing for Post creation
     *
     * @return void
     */
    public function test_post_creation(){
        factory(Post::class)->create([
            'title' => 'test title',
            'body' => 'test body',
            'category_id' => 1,
            'solved' => FALSE
        ]);

        $this->assertDatabaseHas('posts', ['body' => 'test body']);
    }

    /**
     * Testing for votes
     *
     * @return void
     */
    public function test_votes(){

        // Create a user
        // Create a post
        // Link user with post by voting
        factory(Post::class)->create([
            'title' => 'test title',
            'body' => 'test body',
            'category_id' => 1,
            'solved' => FALSE
        ]);
        $this->assertDatabaseHas('posts', ['body' => 'test body']);
    }



}
