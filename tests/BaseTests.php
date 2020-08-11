<?php

namespace codicastudio\sluggable\Tests;

use codicastudio\sluggable\Tests\Models\Author;
use codicastudio\sluggable\Tests\Models\Post;
use codicastudio\sluggable\Tests\Models\PostNotSluggable;
use codicastudio\sluggable\Tests\Models\PostShortConfig;
use codicastudio\sluggable\Tests\Models\PostWithCustomCallableMethod;
use codicastudio\sluggable\Tests\Models\PostWithCustomEngine;
use codicastudio\sluggable\Tests\Models\PostWithCustomEngine2;
use codicastudio\sluggable\Tests\Models\PostWithCustomMethod;
use codicastudio\sluggable\Tests\Models\PostWithCustomSeparator;
use codicastudio\sluggable\Tests\Models\PostWithCustomSource;
use codicastudio\sluggable\Tests\Models\PostWithCustomSuffix;
use codicastudio\sluggable\Tests\Models\PostWithEmptySeparator;
use codicastudio\sluggable\Tests\Models\PostWithForeignRuleset;
use codicastudio\sluggable\Tests\Models\PostWithMaxLength;
use codicastudio\sluggable\Tests\Models\PostWithMaxLengthSplitWords;
use codicastudio\sluggable\Tests\Models\PostWithMultipleSlugs;
use codicastudio\sluggable\Tests\Models\PostWithMultipleSources;
use codicastudio\sluggable\Tests\Models\PostWithNoSource;
use codicastudio\sluggable\Tests\Models\PostWithRelation;
use codicastudio\sluggable\Tests\Models\PostWithReservedSlug;

/**
 * Class BaseTests.
 */
class BaseTests extends TestCase
{
    /**
     * Test basic slugging functionality.
     */
    public function testSimpleSlug()
    {
        $post = Post::create(array(
            'title' => 'My First Post',
        ));
        $this->assertEquals('my-first-post', $post->slug);
    }

    /**
     * Test basic slugging functionality using short configuration syntax.
     */
    public function testShortConfig()
    {
        $post = PostShortConfig::create(array(
            'title' => 'My First Post',
        ));
        $this->assertEquals('my-first-post', $post->slug);
    }

    /**
     * Test that accented characters and other stuff is "fixed".
     */
    public function testAccentedCharacters()
    {
        $post = Post::create(array(
            'title' => 'My Dinner With André & François',
        ));
        $this->assertEquals('my-dinner-with-andre-francois', $post->slug);
    }

    /**
     * Test building a slug from multiple attributes.
     */
    public function testMultipleSource()
    {
        $post = PostWithMultipleSources::create(array(
            'title' => 'A Post Title',
            'subtitle' => 'A Subtitle',
        ));
        $this->assertEquals('a-post-title-a-subtitle', $post->slug);
    }

    public function testLeadingTrailingSpaces()
    {
        $post = Post::create(array(
            'title' => "\tMy First Post \r\n",
        ));
        $this->assertEquals('my-first-post', $post->slug);
    }

    /**
     * Test building a slug using a custom method.
     */
    public function testCustomMethod()
    {
        $post = PostWithCustomMethod::create(array(
            'title' => 'A Post Title',
            'subtitle' => 'A Subtitle',
        ));
        $this->assertEquals('eltit-tsop-a', $post->slug);
    }

    /**
     * Test building a slug using a custom method.
     */
    public function testCustomCallableMethod()
    {
        $post = PostWithCustomCallableMethod::create(array(
            'title' => 'A Post Title',
            'subtitle' => 'A Subtitle',
        ));
        $this->assertEquals('eltit-tsop-a', $post->slug);
    }

    /**
     * Test building a slug using a custom suffix.
     */
    public function testCustomSuffix()
    {
        for ($i = 0; $i < 20; $i++) {
            $post = PostWithCustomSuffix::create(array(
                'title' => 'A Post Title',
                'subtitle' => 'A Subtitle',
            ));

            if ($i === 0) {
                $this->assertEquals('a-post-title', $post->slug);
            } else {
                $this->assertEquals('a-post-title-'.chr($i + 96), $post->slug);
            }
        }
    }

    /**
     * Test building a slug using the __toString method.
     */
    public function testToStringMethod()
    {
        $post = PostWithNoSource::create(array(
            'title' => 'A Post Title',
        ));
        $this->assertEquals('a-post-title', $post->slug);
    }

    /**
     * Test using a custom separator.
     */
    public function testCustomSeparator()
    {
        $post = PostWithCustomSeparator::create(array(
            'title' => 'A post title',
        ));
        $this->assertEquals('a.post.title', $post->slug);
    }

    /**
     * Test using reserved word blocking.
     */
    public function testReservedWord()
    {
        $post = PostWithReservedSlug::create(array(
            'title' => 'Add',
        ));
        $this->assertEquals('add-2', $post->slug);
    }

    /**
     * Test when reverting to a shorter version of a similar slug.
     *
     * @see https://github.com/codicastudio/sluggable/issues/5
     */
    public function testIssue5()
    {
        $post = Post::create(array(
            'title' => 'My first post',
        ));
        $this->assertEquals('my-first-post', $post->slug);

        $post->title = 'My first post rocks';
        $post->slug = null;
        $post->save();
        $this->assertEquals('my-first-post-rocks', $post->slug);

        $post->title = 'My first post';
        $post->slug = null;
        $post->save();
        $this->assertEquals('my-first-post', $post->slug);
    }

    /**
     * Test model replication.
     *
     * @see https://github.com/codicastudio/sluggable/issues/20
     */
    public function testIssue20()
    {
        $post1 = Post::create(array(
            'title' => 'My first post',
        ));
        $this->assertEquals('my-first-post', $post1->slug);

        $post2 = $post1->replicate();
        $this->assertEquals('my-first-post-1', $post2->slug);
    }

    /**
     * Test that we don't try and slug models that don't implement Sluggable.
     */
    public function testNonSluggableModels()
    {
        $post = new PostNotSluggable(array(
            'title' => 'My First Post',
        ));
        $post->save();
        $this->assertEquals(null, $post->slug);
    }

    /**
     * Test for max_length option.
     */
    public function testMaxLength()
    {
        $post = PostWithMaxLength::create(array(
            'title' => 'A post with a really long title',
        ));
        $this->assertEquals('a-post', $post->slug);
    }

    /**
     * Test for max_length option with word splitting.
     */
    public function testMaxLengthSplitWords()
    {
        $post = PostWithMaxLengthSplitWords::create(array(
            'title' => 'A post with a really long title',
        ));
        $this->assertEquals('a-post-wit', $post->slug);
    }

    /**
     * Test for max_length option with increments.
     */
    public function testMaxLengthWithIncrements()
    {
        for ($i = 0; $i < 20; $i++) {
            $post = PostWithMaxLength::create(array(
                'title' => 'A post with a really long title',
            ));
            if ($i == 0) {
                $this->assertEquals('a-post', $post->slug);
            } elseif ($i < 10) {
                $this->assertEquals('a-post-'.$i, $post->slug);
            }
        }
    }

    /**
     * Test for max_length option with increments and word splitting.
     */
    public function testMaxLengthSplitWordsWithIncrements()
    {
        for ($i = 0; $i < 20; $i++) {
            $post = PostWithMaxLengthSplitWords::create(array(
                'title' => 'A post with a really long title',
            ));
            if ($i == 0) {
                $this->assertEquals('a-post-wit', $post->slug);
            } elseif ($i < 10) {
                $this->assertEquals('a-post-wit-'.$i, $post->slug);
            }
        }
    }

    /**
     * Test for max_length option with a slug that might end in separator.
     */
    public function testMaxLengthDoesNotEndInSeparator()
    {
        $post = PostWithMaxLengthSplitWords::create(array(
            'title' => 'It should work',
        ));
        $this->assertEquals('it-should', $post->slug);
    }

    /**
     * Test that models aren't slugged if the slug field is defined.
     *
     * @see https://github.com/codicastudio/sluggable/issues/32
     */
    public function testDoesNotNeedSluggingWhenSlugIsSet()
    {
        $post = Post::create(array(
            'title' => 'My first post',
            'slug' => 'custom-slug',
        ));
        $this->assertEquals('custom-slug', $post->slug);
    }

    /**
     * Test that models aren't *re*slugged if the slug field is defined.
     *
     * @see https://github.com/codicastudio/sluggable/issues/32
     */
    public function testDoesNotNeedSluggingWithUpdateWhenSlugIsSet()
    {
        $post = Post::create(array(
            'title' => 'My first post',
            'slug' => 'custom-slug',
        ));
        $this->assertEquals('custom-slug', $post->slug);

        $post->title = 'A New Title';
        $post->save();
        $this->assertEquals('custom-slug', $post->slug);

        $post->title = 'A Another New Title';
        $post->slug = 'new-custom-slug';
        $post->save();
        $this->assertEquals('new-custom-slug', $post->slug);
    }

    /**
     * Test generating slug from related model field.
     */
    public function testSlugFromRelatedModel()
    {
        $author = Author::create(array(
            'name' => 'Arthur Conan Doyle',
        ));
        $post = new PostWithRelation(array(
            'title' => 'First',
        ));
        $post->author()->associate($author);
        $post->save();
        $this->assertEquals('arthur-conan-doyle-first', $post->slug);
    }

    /**
     * Test generating slug when related model doesn't exists.
     */
    public function testSlugFromRelatedModelNotExists()
    {
        $post = PostWithRelation::create(array(
            'title' => 'First',
        ));
        $this->assertEquals('first', $post->slug);
    }

    /**
     * Test that a null slug source creates a null slug.
     */
    public function testNullSourceGeneratesEmptySlug()
    {
        $post = PostWithCustomSource::create(array(
            'title' => 'My Test Post',
        ));
        $this->assertEquals(null, $post->slug);
    }

    /**
     * Test that a zero length slug source creates a null slug.
     */
    public function testZeroLengthSourceGeneratesEmptySlug()
    {
        $post = Post::create(array(
            'title' => '',
        ));
        $this->assertNull($post->slug);
    }

    /**
     * Test using custom Slugify rules.
     */
    public function testCustomEngineRules()
    {
        $post = new PostWithCustomEngine(array(
            'title' => 'The quick brown fox jumps over the lazy dog',
        ));
        $post->save();
        $this->assertEquals('tha-qaack-brawn-fax-jamps-avar-tha-lazy-dag', $post->slug);
    }

    /**
     * Test using additional custom Slugify rules.
     */
    public function testCustomEngineRules2()
    {
        $post = new PostWithCustomEngine2(array(
            'title' => 'The quick brown fox/jumps over/the lazy dog',
        ));
        $post->save();
        $this->assertEquals('the-quick-brown-fox/jumps-over/the-lazy-dog', $post->slug);
    }

    /**
     * Test using a custom Slugify ruleset.
     */
    public function testForeignRuleset()
    {
        $post = PostWithForeignRuleset::create(array(
            'title' => 'Mia unua poŝto',
        ));
        $this->assertEquals('mia-unua-posxto', $post->slug);
    }

    /**
     * Test if using an empty separator works.
     *
     * @see https://github.com/codicastudio/sluggable/issues/256
     */
    public function testEmptySeparator()
    {
        $post = new PostWithEmptySeparator(array(
            'title' => 'My Test Post',
        ));
        $post->save();
        $this->assertEquals('mytestpost', $post->slug);
    }

    /**
     * Test models with multiple slug fields.
     */
    public function testMultipleSlugs()
    {
        $post = new PostWithMultipleSlugs(array(
            'title' => 'My Test Post',
            'subtitle' => 'My Subtitle',
        ));
        $post->save();

        $this->assertEquals('my-test-post', $post->slug);
        $this->assertEquals('my.subtitle', $post->dummy);
    }

    /**
     * Test subscript characters in slug field.
     */
    public function testSubscriptCharacters()
    {
        $post = new Post(array(
            'title' => 'RDA-125-15/30/45m³/h CAV',
        ));
        $post->save();

        $this->assertEquals('rda-125-15-30-45m3-h-cav', $post->slug);
    }

    /**
     * Test that a false-y string slug source creates a slug.
     */
    public function testFalsyString()
    {
        $post = Post::create(array(
            'title' => '0',
        ));
        $this->assertEquals('0', $post->slug);
    }

    /**
     * Test that a false-y int slug source creates a slug.
     */
    public function testFalsyInt()
    {
        $post = Post::create(array(
            'title' => 0,
        ));
        $this->assertEquals('0', $post->slug);
    }

    /**
     * Test that a boolean true source creates a slug.
     */
    public function testTrueSource()
    {
        $post = Post::create(array(
            'title' => true,
        ));
        $this->assertEquals('1', $post->slug);
    }

    /**
     * Test that a boolean false slug source creates a slug.
     */
    public function testFalseSource()
    {
        $post = Post::create(array(
            'title' => false,
        ));
        $this->assertEquals('0', $post->slug);
    }
}
