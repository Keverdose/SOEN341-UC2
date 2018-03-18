<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\User;
use App\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test for the user.
     *
     * @return void
     */
    public function test_full_name_of_user(){
        $user = factory(User::class)->create([
            'first_name' => 'Bob',
            'last_name' => 'Marley'
        ]);

        $this->assertEquals($user->fullName(), 'Bob Marley');
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
}
