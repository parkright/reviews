<?php

namespace Parkright\Reviews;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Parkright\Reviews\Skeleton\SkeletonClass
 */
class ReviewFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'review';
    }
}
