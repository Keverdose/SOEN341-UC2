<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
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
}
