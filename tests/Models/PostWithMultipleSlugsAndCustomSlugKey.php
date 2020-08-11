<?php namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithMultipleSlugsAndCustomSlugKey
 *
 * @package codicastudio\sluggable\Tests\Models
 */
class PostWithMultipleSlugsAndCustomSlugKey extends PostWithMultipleSlugsAndHelperTrait
{

    protected $slugKeyName = 'dummy';
    
}
