<?php namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithMultipleSources
 *
 * @package codicastudio\sluggable\Tests\Models
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
        return [
            'slug' => [
                'source' => ['title', 'subtitle'],
            ]
        ];
    }
}
