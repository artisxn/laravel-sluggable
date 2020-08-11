<?php

namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithReservedSlug.
 *
 * A test model that uses custom reserved slug names.
 */
class PostWithReservedSlug extends Post
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
                'source' => 'title',
                'reserved' => array('add', 'add-1'),
            ),
        );
    }
}
