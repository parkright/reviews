<?php
namespace Parkright\Reviews\Http\Controllers;


use App\Http\Controllers\Controller;
use Parkright\Reviews\Models\Review;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        $reviews = Review::where('rating', '>=', 3)
            ->orderByDesc('created_at');

        $rating = $reviews->get()->avg('rating');

        return view('review::index', ['reviews' => $reviews->paginate(30), 'rating' => $rating]);
    }

}
