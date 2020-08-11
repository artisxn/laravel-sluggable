<?php

namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithIncludeTrashed.
 *
 * A test model that uses the Sluggable package and "includeTrashed",
 * but does not use Laravel's SoftDeleting trait.
 */
class PostWithIncludeTrashed extends Post
{
    public function sluggable()
    {
        return array(
            'slug' => array(
                'source' => 'title',
                'includeTrashed' => true,
            ),
        );
    }
}
