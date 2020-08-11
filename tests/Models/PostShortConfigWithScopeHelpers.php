<?php namespace codicastudio\sluggable\Tests\Models;

use codicastudio\sluggable\SluggableScopeHelpers;

/**
 * Class PostShortConfigWithScopeHelpers
 *
 * @package codicastudio\sluggable\Tests\Models
 */
class PostShortConfigWithScopeHelpers extends Post
{

    use SluggableScopeHelpers;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug_field'
        ];
    }
}
