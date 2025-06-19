@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Search Results for "{{ $searchTerm }}"</h1>

        @if($books->isEmpty())
            <p class="text-lg text-gray-600">No books found.</p>
        @else
            <div id="book-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($books as $book)
                    <div class="bg-white p-4 rounded-lg shadow-lg transition-transform duration-300 transform hover:scale-105 hover:shadow-2xl">
                        <a href="{{ route('book.details', $book->id) }}">
                            <img src="{{ $book->book_pic ? asset('storage/' . $book->book_pic) : 'https://via.placeholder.com/150' }}"
                                 alt="{{ $book->book_name }}"
                                 class="w-full h-90 object-cover rounded-lg mb-4 transition-transform duration-300 hover:scale-105">
                        </a>
                        <h2 class="text-xl font-semibold text-gray-800 mb-1">{{ $book->book_name }}</h2>
                        <p class="text-gray-600 mb-2">{{ $book->book_author }}</p>
                        <p class="text-gray-900 font-bold">Rs. {{ number_format($book->book_price, 2) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
