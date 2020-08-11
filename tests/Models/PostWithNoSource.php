<?php namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithNoSource
 *
 * A test model with no source field defined.
 *
 * @package codicastudio\sluggable\Tests\Models
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
        return [
            'slug' => [
                'source' => null
            ]
        ];
    }
}
