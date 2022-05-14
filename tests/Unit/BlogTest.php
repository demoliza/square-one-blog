<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(Tests\TestCase::class, RefreshDatabase::class);

it('user can login', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user, 'web');
    $this->assertAuthenticatedAs($user, 'web');
});

it('can create a blog post', function () {
    $data = [
        'title' => "New Post",
        'description' => "This is a post",
        'publication_date' => '2022-05-12 12:00',
    ];
    $user = User::factory()->create();
    $response = $this->actingAs($user, 'web')->post('/posts', $data);
    $this->assertDatabaseHas('posts', $data);
});

it('can fetch user blog posts', function () {
    $data = [
        'title' => "New Post",
        'description' => "This is a post",
        'publication_date' => '2022-05-12 12:00',
    ];
    $user = User::factory()->create();
    $response = $this->actingAs($user, 'web')->post('/posts', $data);
    $response = $this->actingAs($user, 'web')->get('/posts');
    $response->assertSeeText($data['title']);
});

it('can fetch & create posts from external feed', function () {
    $user = User::factory()->count(1)->create(['name' => 'Admin']);
    $this->artisan('fetch:posts')->assertSuccessful();
});