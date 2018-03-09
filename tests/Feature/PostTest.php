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
     * Testing for login and registration
     *
     * @return void
     */
    public function test_login()
    {
        $user = factory(User::class)->create([
            'first_name' => 'testfirstname',
            'last_name' => 'testlastname',
            'email' => 'test@example.com',
            'password' => bcrypt('testpass123')
        ]);

        $this->visit(route('login'))
            ->type($user->email, 'email')
            ->type('testpass123', 'password')
            ->press('Login')
            ->see('Successfully logged in')
            ->onPage('/dashboard');
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
