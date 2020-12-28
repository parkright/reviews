<?php
namespace Parkright\Reviews\Models\Concerns;


use App\Models\User;
use Parkright\Reviews\Models\Review;

trait Reviewable
{
    public function reviews()
    {
        return $this->morphMany(Review::class, 'model');
    }


    public function review($review)
    {

    }


}
