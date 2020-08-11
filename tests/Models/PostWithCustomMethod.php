<?php

namespace codicastudio\sluggable\Tests\Models;

use Illuminate\Support\Str;

/**
 * Class PostWithCustomMethod.
 */
class PostWithCustomMethod extends Post
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
                'method' => function ($string, $separator) {
                    return strrev(Str::slug($string, $separator));
                },
            ),
        );
    }
}
