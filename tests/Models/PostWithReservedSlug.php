<?php namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithReservedSlug
 *
 * A test model that uses custom reserved slug names.
 *
 * @package codicastudio\sluggable\Tests\Models
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
        return [
            'slug' => [
                'source' => 'title',
                'reserved' => ['add','add-1']
            ]
        ];
    }
}