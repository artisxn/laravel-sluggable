<?php

namespace codicastudio\sluggable\Tests\Listeners;

/**
 * Class AbortSlugging.
 */
class DoNotAbortSlugging
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $event
     * @return bool
     */
    public function handle($model, $event)
    {
        return true;
    }
}
