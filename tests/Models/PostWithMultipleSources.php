<?php

namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithMultipleSources.
 */
class PostWithMultipleSources extends Post
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
                'source' => array('title', 'subtitle'),
            ),
        );
    }
}
