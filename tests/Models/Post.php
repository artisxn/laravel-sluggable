<?php

namespace codicastudio\sluggable\Tests\Models;

use codicastudio\sluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post.
 *
 *
 * @property int id
 * @property string title
 * @property string|null subtitle
 * @property string|null slug
 * @property string|null dummy
 * @property int author_id
 */
class Post extends Model
{
    use Sluggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('title', 'subtitle', 'slug', 'dummy', 'author_id');

    /**
     * Convert the model to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }

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
            ),
        );
    }
}
