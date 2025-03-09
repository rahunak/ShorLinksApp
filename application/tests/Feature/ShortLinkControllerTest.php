<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Support\Str;

class ShortLinkControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function testIndex()
    {
        ShortLink::create([
            'original_url' => 'https://example.com',
            'short_url' => Str::random(6),
            'title' => 'Example Site',
        ]);

        $response = $this->get(route('short_links.index'));

        $response->assertStatus(200);
        $response->assertSee('Example Site');
    }

    public function testCreate()
    {
        $response = $this->get(route('short_links.create'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post(route('short_links.store'), [
            'original_url' => 'https://example.com',
            'title' => 'Example Site',
        ]);

        $response->assertRedirect(route('short_links.index'));

        $this->assertDatabaseHas('short_links', [
            'original_url' => 'https://example.com',
            'title' => 'Example Site',
        ]);
    }

    public function testEdit()
    {
        $shortLink = ShortLink::create([
            'original_url' => 'https://example.com',
            'short_url' => Str::random(6),
            'title' => 'Example Site',
        ]);

        $response = $this->get(route('short_links.edit', $shortLink));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $shortLink = ShortLink::create([
            'original_url' => 'https://example.com',
            'short_url' => Str::random(6),
            'title' => 'Example Site',
        ]);

        $response = $this->put(route('short_links.update', $shortLink), [
            'original_url' => 'https://updated-example.com',
            'title' => 'Updated Example Site',
        ]);

        $response->assertRedirect(route('short_links.index'));

        $this->assertDatabaseHas('short_links', [
            'original_url' => 'https://updated-example.com',
            'title' => 'Updated Example Site',
        ]);
    }

    public function testRedirect()
    {
        $shortLink = ShortLink::create([
            'original_url' => 'https://example.com',
            'short_url' => 'short123',
            'title' => 'Example Site',
        ]);

        $response = $this->get(route('short_links.redirect', $shortLink->short_url));

        $response->assertRedirect($shortLink->original_url);

        $this->assertDatabaseHas('short_links', [
            'id' => $shortLink->id,
            'clicks' => 1,
        ]);
    }

    public function testStoreValidation()
    {
        $response = $this->post(route('short_links.store'), [
            'original_url' => 'invalid-url',
            'title' => 'Example Site',
        ]);

        $response->assertSessionHasErrors(['original_url']);
    }

    public function testStoreUniqueShortUrl()
    {
        $shortLink = ShortLink::create([
            'original_url' => 'https://example.com',
            'short_url' => 'short123',
            'title' => 'Example Site',
        ]);

        $response = $this->post(route('short_links.store'), [
            'original_url' => 'https://another-example.com',
            'short_url' => 'short123',
            'title' => 'Another Example Site',
        ]);

        $response->assertSessionHasErrors(['short_url']);
    }

    public function testUpdateValidation()
    {
        $shortLink = ShortLink::create([
            'original_url' => 'https://example.com',
            'short_url' => Str::random(6),
            'title' => 'Example Site',
        ]);

        $response = $this->put(route('short_links.update', $shortLink), [
            'original_url' => 'invalid-url',
            'title' => 'Updated Example Site',
        ]);

        $response->assertSessionHasErrors(['original_url']);
    }

    public function testDestroy()
    {
        $shortLink = ShortLink::create([
            'original_url' => 'https://example.com',
            'short_url' => Str::random(6),
            'title' => 'Example Site',
        ]);

        $response = $this->delete(route('short_links.destroy', $shortLink));

        $response->assertRedirect(route('short_links.index'));
        $this->assertDatabaseMissing('short_links', [
            'id' => $shortLink->id,
        ]);
    }

    public function testRedirectToNonExistentShortLink()
    {
        $response = $this->get(route('short_links.redirect', 'nonexistent'));

        $response->assertStatus(404);
    }
}
