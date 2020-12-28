<?php

namespace Parkright\Reviews\Actions;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Parkright\Reviews\Models\Review;

class CreateReviewAction
{

    /**
     * @param Review $review
     * @param Model $model
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function execute(Review $review, Model $model)
    {
        $this->validate($review->toArray());

        $model->reviews()->save($review);

        return $model->refresh();
    }

    /**
     * @param $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validate($data)
    {
        $validator = Validator::make($data, $this->rules(), $this->errorMessages());

        return $validator->validate();
    }


    protected function rules()
    {
        return [
            'body' => 'required',
            'rating' => 'in:1,2,3,4,5'
        ];

    }

    protected function errorMessages()
    {
        return [
            'required' => 'A :attribute is required.',
            'rating.in' => 'Rating must be between 1-5.'
        ];
    }

}
