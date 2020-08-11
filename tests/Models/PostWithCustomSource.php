<?php namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithCustomSource
 *
 * A test model that uses a custom suffix generation method.
 *
 * @package codicastudio\sluggable\Tests\Models
 */
class PostWithCustomSource extends Post
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
                'source' => 'subtitle'
            ]
        ];
    }
}
