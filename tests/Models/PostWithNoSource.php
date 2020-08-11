<?php

namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithNoSource.
 *
 * A test model with no source field defined.
 */
class PostWithNoSource extends Post
{
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return array(
            'slug' => array(
                'source' => null,
            ),
        );
    }
}
