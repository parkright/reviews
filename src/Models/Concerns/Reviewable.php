<?php
namespace Parkright\Reviews\Models\Concerns;


use App\Models\User;
use Parkright\Reviews\Actions\CreateReviewAction;
use Parkright\Reviews\Models\Review;

trait Reviewable
{
    /**
     * @return mixed
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'model');
    }

    /**
     * @param $review
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addReview($review)
    {
        if (! $review instanceof Review) {

            $review = Review::make($review);
        }

        return $action = (new CreateReviewAction)->execute($review, $this);
    }

    public function rating()
    {
        return $this->reviews()->avg('rating');
    }

    public function reviewCount()
    {
        return $this->reviews()->count();
    }


}
