<?php

namespace codicastudio\sluggable\Tests;

use codicastudio\sluggable\Tests\Models\PostWithIncludeTrashed;
use codicastudio\sluggable\Tests\Models\PostWithSoftDeleting;
use codicastudio\sluggable\Tests\Models\PostWithSoftDeletingIncludeTrashed;

/**
 * Class SoftDeleteTests.
 */
class SoftDeleteTests extends TestCase
{
    /**
     * Test uniqueness with soft deletes when we ignore trashed models.
     */
    public function testSoftDeletesWithoutTrashed()
    {
        $post1 = PostWithSoftDeleting::create(array(
            'title' => 'A Post Title',
        ));
        $this->assertEquals('a-post-title', $post1->slug);

        $post1->delete();

        $post2 = PostWithSoftDeleting::create(array(
            'title' => 'A Post Title',
        ));
        $this->assertEquals('a-post-title', $post2->slug);
    }

    /**
     * Test uniqueness with soft deletes when we include trashed models.
     */
    public function testSoftDeletesWithTrashed()
    {
        $post1 = PostWithSoftDeletingIncludeTrashed::create(array(
            'title' => 'A Post Title',
        ));
        $this->assertEquals('a-post-title', $post1->slug);

        $post1->delete();

        $post2 = PostWithSoftDeletingIncludeTrashed::create(array(
            'title' => 'A Post Title',
        ));
        $this->assertEquals('a-post-title-1', $post2->slug);
    }

    /**
     * Test that include_trashed is ignored if the model doesn't use the softDelete trait.
     */
    public function testSoftDeletesWithNonSoftDeleteModel()
    {
        $post1 = PostWithIncludeTrashed::create(array(
            'title' => 'A Post Title',
        ));
        $this->assertEquals('a-post-title', $post1->slug);
    }
}
