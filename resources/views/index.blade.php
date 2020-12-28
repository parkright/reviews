@extends(config('reviews.layout'))
@section('title', 'Reviews - ')

@section('content')
    <div class="clearfix" id="header">
    </div>
    <div class="container mx-auto table animated fadeIn">
        <h1 class="font-bold text-center md:text-left text-3xl py-2">Reviews</h1>

        <p class="text-center md:text-left text-base py-2 text-gray-600">
            We've had some amazing feedback from our customers, giving us a total rating of
            <strong>{{ number_format($rating, 1) }} out of 5</strong>.
        </p>

        <x-review::review.display :reviews="$reviews"/>
    </div>
@endsection
