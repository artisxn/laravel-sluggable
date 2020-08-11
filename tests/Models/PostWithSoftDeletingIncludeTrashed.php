<?php namespace codicastudio\sluggable\Tests\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PostWithSoftDeletingIncludeTrashed
 *
 * A test model that uses the Sluggable package and uses Laravel's SoftDeleting trait
 * but includes trashed models.
 *
 * @package codicastudio\sluggable\Tests\Models
 */
class PostWithSoftDeletingIncludeTrashed extends Post
{

    use SoftDeletes;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'includeTrashed' => true
            ]
        ];
    }
}
