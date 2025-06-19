<section class="mb-12">
    <h2 class="text-3xl font-semibold mb-8 text-gray-900 text-center">Latest Books</h2>
    <div class="flex flex-wrap gap-4 justify-center">
        @forelse ($latestBooks as $book)
            <div class="w-full sm:w-1/3 md:w-1/4 lg:w-1/6 p-2">
                <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden relative">
                    @if ($book->book_pic)
                        <img src="{{ asset('storage/' . $book->book_pic) }}" alt="{{ $book->title }}"
                            class="w-full h-52 object-cover">
                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded absolute top-2 left-2">New</span>
                    @else
                        <img src="https://via.placeholder.com/150" alt="No image available"
                            class="w-full h-52 object-cover">
                    @endif
                    <div class="p-3">
                        <h3 class="text-sm font-semibold text-gray-800">{{ $book->title }}</h3>
                        <p class="text-gray-600 text-xs">{{ $book->author }}</p>
                        <a href="{{ route('books.show', $book->id) }}" class="text-blue-600 text-xs hover:underline">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600 text-center">No books available at the moment.</p>
        @endforelse
    </div>
</section>
