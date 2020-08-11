<?php namespace codicastudio\sluggable\Tests;

use codicastudio\sluggable\Services\SlugService;
use codicastudio\sluggable\Tests\Models\Post;

/**
 * Class StaticTests
 *
 * @package Tests
 */
class StaticTests extends TestCase
{

    /**
     * Test that we can generate a slug statically.
     */
    public function testStaticSlugGenerator()
    {
        $slug = SlugService::createSlug(Post::class, 'slug', 'My Test Post');
        $this->assertEquals('my-test-post', $slug);
    }

    /**
     * Test that we generate unique slugs in a static context.
     */
    public function testStaticSlugGeneratorWhenEntriesExist()
    {
        $post = Post::create(['title' => 'My Test Post']);
        $this->assertEquals('my-test-post', $post->slug);

        $slug = SlugService::createSlug(Post::class, 'slug', 'My Test Post');
        $this->assertEquals('my-test-post-1', $slug);
    }

    /**
     * Test that we can generate a slug statically with different configuration.
     */
    public function testStaticSlugGeneratorWithConfig()
    {
        $config = [
            'separator' => '.'
        ];
        $slug = SlugService::createSlug(Post::class, 'slug', 'My Test Post', $config);
        $this->assertEquals('my.test.post', $slug);
    }

    /**
     * Test passing an invalid attribute to static method
     */
    public function testStaticSlugWithInvalidAttribute()
    {
        $this->expectException(\InvalidArgumentException::class);
        $slug = SlugService::createSlug(Post::class, 'foo', 'My Test Post');
    }
}
