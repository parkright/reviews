@foreach($reviews as $review)
    <div class="border border-gray-100 rounded p-4 flex my-4 grid grid-cols-6 gap-6">
        <div class="col-span-3">
            <div class="font-semibold text-gray-600 ">{{ $review->author }}</div>
            <div class="text-sm text-gray-400">{{ $review->created_at->toFormattedDateString() }}</div>
        </div>
        <div class="col-span-3 flex justify-end">
            @for($i = 1; $i <= $review->rating; $i++)
                <svg class="w-6 h-6 text-yellow-300 text-right" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            @endfor
            @if($review->rating < 5)
                @for($i = $review->rating; $i < 5; $i++)
                    <svg class="w-6 h-6 text-gray-300 text-right" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                @endfor

            @endif
        </div>
        <div class="col-span-6 text-gray-400 text-sm">
            {{ $review->body }}
        </div>

    </div>
@endforeach

<nav class="bg-white py-3 flex items-center justify-between border-t border-gray-100" aria-label="Pagination">
    <div class="hidden sm:block">
        <p class="text-sm text-gray-600">
            Showing
            <span class="font-medium">{{ $reviews->firstItem() }}</span>
            to
            <span class="font-medium">{{ $reviews->lastItem() }}</span>
            of
            <span class="font-medium">{{ $reviews->total() }}</span>
            results
        </p>
    </div>
    <div class="flex-1 flex justify-between sm:justify-end">
        @if(! $reviews->onFirstPage())
            <a href="{{ $reviews->previousPageUrl() }}"
               class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </a>
        @endif
        @if($reviews->currentPage() !== $reviews->lastPage())
            <a href="{{ $reviews->nextPageUrl() }}"
               class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </a>
        @endif
    </div>
</nav>



