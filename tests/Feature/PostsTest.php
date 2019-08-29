<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    use RefreshDatabase;


    /** @test **/
    public function a_guest_can_not_create_a_post () {
        $this->post('/posts')->assertForbidden();
    }

    /** @test **/
    public function the_admin_can_create_a_post () {
        $user = factory('App\User')->create();

        $attributes = ['title' => 'FeatureTestTitle', 'description' => 'FeatureTestDescription'];
        \App\Post::create($attributes + ['owner_id' => $user->id]);

        $this->assertDatabaseHas('posts', $attributes);
    }

    /** @test **/
    public function the_admin_can_edit_a_post () {
        $user = factory('App\User')->create();

        $attributes = ['title' => 'FeatureTestTitle', 'description' => 'FeatureTestDescription'];

        $this->actingAs($user);

        $post = new \App\Post();

        $post->title = $attributes['title'];
        $post->description = $attributes['description'];
        $post->owner_id = $user->id;
        $post->save();

        $this->assertDatabaseHas('posts', $attributes);

        $attributesUpdated = ['title' => 'FeatureTestTitleUpdated', 'description' => 'FeatureTestDescriptionUpdated'];
        // $post->update($attributes + ['owner_id' => $user->id]);
        $post->title = $attributesUpdated['title'];
        $post->description = $attributesUpdated['description'];
        $post->save();

        $this->assertDatabaseHas('posts', $attributesUpdated);
    }

    /** @test **/
    public function the_admin_can_delete_a_post () {
        $user = factory('App\User')->create();

        $attributes = ['title' => 'FeatureTestTitle', 'description' => 'FeatureTestDescription'];

        $this->actingAs($user);

        $post = new \App\Post();

        $post->title = $attributes['title'];
        $post->description = $attributes['description'];
        $post->owner_id = $user->id;
        $post->save();

        $this->assertDatabaseHas('posts', $attributes);

        $post->delete();
        $this->assertDatabaseMissing('posts', $attributes);
    }
}
