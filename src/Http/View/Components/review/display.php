<?php

namespace Parkright\Http\View\Components\Review;

use Illuminate\Http\Request;
use Illuminate\View\Component;
use Parkright\Reviews\Models\Review;

class display extends Component
{
    public $reviews;

    /**
     * Create a new component instance.
     * @param $reviews
     */
    public function __construct($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('Reviews::components.review.display');
    }
}

