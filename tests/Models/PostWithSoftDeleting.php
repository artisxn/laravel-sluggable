<?php namespace codicastudio\sluggable\Tests\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PostWithSoftDeleting
 *
 * A test model that uses the Sluggable package and uses Laravel's SoftDeleting trait.
 *
 * @package codicastudio\sluggable\Tests\Models
 */
class PostWithSoftDeleting extends Post
{

    use SoftDeletes;
}
