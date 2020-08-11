<?php

namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithMultipleSlugs.
 */
class PostWithMultipleSlugs extends Post
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
            ),
            'dummy' => array(
                'source' => 'subtitle',
                'separator' => '.',
            ),
        );
    }
}
