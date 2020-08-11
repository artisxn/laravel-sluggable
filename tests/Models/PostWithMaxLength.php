<?php

namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithMaxLength.
 */
class PostWithMaxLength extends Post
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
                'maxLength' => 10,
            ),
        );
    }
}
