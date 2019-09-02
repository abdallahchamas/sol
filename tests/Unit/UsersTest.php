<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use App\Post;

class UsersTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        User::executeSchema();
    }

    public function tearDown(): void
    {
        User::truncate();
        Post::truncate();
    }

    /** @test **/
    public function main_page_is_working ()
    {
        $this->get('/')->assertStatus(200);
    }

    /** @test **/
    public function the_admin_can_have_a_post ()
    {
    	$user = factory('App\User')->create();

    	$attributes = ['title' => 'UnitTestTitle', 'description' => 'UnitTestDescription'];
    	\App\Post::create($attributes + ['owner_id' => $user->id]);

        $this->assertEquals('UnitTestTitle', $user->posts[0]->title);
    }

    /** @test **/
    public function only_one_user_can_register ()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            'name' => 'TestUser1',
            'email' => 'TestUser1@example.org',
            'password' => 'aPassword',
            'password_confirmation' => 'aPassword'
        ];

        $this->post('/register', $attributes);

        $attributes = [
            'name' => 'TestUser2',
            'email' => 'TestUser2@example.org',
            'password' => 'aPassword2',
            'password_confirmation' => 'aPassword2'
        ];

        $this->post('/register', $attributes);
        $this->assertEquals(1, \App\User::all()->count());
    }

    /** @test **/
    public function a_created_post_is_displayed_on_the_main_page ()
    {
        $user = factory('App\User')->create();

        $attributes = [
            'title' => 'UnitTestTitle',
            'description' => 'UnitTestDescription'
        ];
        \App\Post::create($attributes + ['owner_id' => $user->id]);

        $this->assertEquals('UnitTestTitle', $user->posts[0]->title);

        $response = $this->get('/');
        $response->assertSee($attributes["title"]);
        $response->assertSee($attributes["description"]);
    }
}
