<?php

use Illuminate\Support\Facades\Route as Route;

Route::prefix('reviews')->group(function () {
    Route::get('/', [Parkright\Reviews\Http\Controllers\ReviewController::class, 'index'])->name('reviews.index');


    Route::get('/import/lcs', function () {
        $authors = collect(json_decode(file_get_contents(public_path('files/test_authors.json'))));
        $reviews = collect(json_decode(file_get_contents(public_path('files/test_reviews.json'))));

        $product = \App\ParkRight\Product::first();

        $reviews->each(function ($review) use ($authors, $product) {
            $newReview = \Parkright\Reviews\Models\Review::make([
                'title' => 'lcs-legacy-review',
                'body' => $review->comment_text,
                'author' => $authors->where('id', $review->member_id)->first()->name ?? 'Anonymous',
                'published' => $review->rating >= 3,
                'rating' => $review->rating,
                'ip_address' => $review->ip,
                'created_at' => $review->created,

            ]);
            $product->reviews()->save($newReview);

            $product->save();
        });
    });
});
