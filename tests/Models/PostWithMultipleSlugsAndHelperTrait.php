<?php

namespace codicastudio\sluggable\Tests\Models;

use codicastudio\sluggable\SluggableScopeHelpers;

/**
 * Class PostWithMultipleSlugsAndPrimary.
 */
class PostWithMultipleSlugsAndHelperTrait extends PostWithMultipleSlugs
{
    use SluggableScopeHelpers;
}
