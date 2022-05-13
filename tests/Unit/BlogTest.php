<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(Tests\TestCase::class, RefreshDatabase::class);

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

#this requires autheentication
/* it('can fetch & create posts from external feed', function () {
    $url = config('app.blog_feed_url');
    $user = User::factory()->create();
    $response = $this->get($url);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                 'title',
                 'description',
                 'publication_date'
            ]
        ]
    ]);
}); */