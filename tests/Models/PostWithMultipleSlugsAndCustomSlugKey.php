<?php

namespace codicastudio\sluggable\Tests\Models;

/**
 * Class PostWithMultipleSlugsAndCustomSlugKey.
 */
class PostWithMultipleSlugsAndCustomSlugKey extends PostWithMultipleSlugsAndHelperTrait
{
    protected $slugKeyName = 'dummy';
}
