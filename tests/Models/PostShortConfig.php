<?php namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostShortConfig
 *
 * @package codicastudio\sluggable\Tests\Models
 */
class PostShortConfig extends Post
{

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug'
        ];
    }
}
