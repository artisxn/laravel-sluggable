<?php

namespace codicastudio\sluggable\Tests\Models;

use Illuminate\Support\Str;

/**
 * Class PostWithCustomCallableMethod.
 */
class PostWithCustomCallableMethod extends Post
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
                'method' => array(static::class, 'makeSlug'),
            ),
        );
    }

    public static function makeSlug($string, $separator)
    {
        return strrev(Str::slug($string, $separator));
    }
}
