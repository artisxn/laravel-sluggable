<?php namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithMaxLength
 *
 * @package codicastudio\sluggable\Tests\Models
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
        return [
            'slug' => [
                'source' => 'title',
                'maxLength' => 10,
            ]
        ];
    }
}
