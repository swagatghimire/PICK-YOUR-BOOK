@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto px-4 py-6F">
        <!-- Welcome Card -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden mb-8 relative">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-100 to-gray-200 opacity-70"></div>
            <div class="p-8 relative z-10">
                <h1 class="text-4xl font-bold mb-4 text-center text-gray-800">Welcome to Pick Your Book</h1>
                <p class="mb-6 text-gray-700 text-center text-lg">Discover a world of books at Pick Your Book! Whether you're
                    looking to buy or sell, we offer a diverse selection of both new and used books. Connect with fellow
                    book lovers and find great deals on your favorite reads.</p>

                <section class="mt-12 flex flex-col lg:flex-row gap-6">
                    <!-- Sell Books Card -->
                    <div
                        class="flex-shrink-0 w-full lg:w-1/2 flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-400 text-white rounded-lg shadow-lg overflow-hidden relative">
                        <div class="p-8 flex items-center w-full">
                            <div class="flex-shrink-0 mr-6">
                                <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7h18M3 12h18m-9 5h9m-9 0H3m-1 4h20M3 4a1 1 0 00-1 1v14a1 1 0 001 1h20a1 1 0 001-1V5a1 1 0 00-1-1H3z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-3xl font-semibold mb-2">Sell Your Books</h3>
                                <p class="text-lg mb-4">Easily list your used or new books for sale. Set your price, upload
                                    a picture, and connect with buyers looking for great deals on books.</p>
                                <a href="{{ route('sellhere') }}"
                                    class="bg-white text-blue-600 hover:bg-gray-200 px-6 py-3 rounded-lg font-semibold">Start
                                    Selling</a>
                            </div>
                        </div>
                        <svg class="absolute top-0 right-0 w-24 h-24 text-blue-300 opacity-50 transform -translate-x-1/2 translate-y-1/2"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7m-7 0H4m-1 4h20M4 4a1 1 0 00-1 1v14a1 1 0 001 1h20a1 1 0 001-1V5a1 1 0 00-1-1H4z" />
                        </svg>
                    </div>

                    <!-- Buy Books Card -->
                    <div
                        class="flex-shrink-0 w-full lg:w-1/2 flex items-center justify-center bg-gradient-to-r from-green-600 to-green-400 text-white rounded-lg shadow-lg overflow-hidden relative">
                        <div class="p-8 flex items-center w-full">
                            <div class="flex-shrink-0 mr-6">
                                <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7h18M3 12h18m-9 5h9m-9 0H3m-1 4h20M3 4a1 1 0 00-1 1v14a1 1 0 001 1h20a1 1 0 001-1V5a1 1 0 00-1-1H4z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-3xl font-semibold mb-2">Buy Books</h3>
                                <p class="text-lg mb-4">Browse our collection of books listed by other users. Contact
                                    sellers directly to negotiate prices and get your hands on your next favorite book.</p>
                                <a href="{{ route('allbooks') }}"
                                    class="bg-white text-green-600 hover:bg-gray-200 px-6 py-3 rounded-lg font-semibold">Explore
                                    Books</a>
                            </div>
                        </div>
                        <svg class="absolute top-0 right-0 w-24 h-24 text-green-300 opacity-50 transform -translate-x-1/2 translate-y-1/2"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7m-7 0H4m-1 4h20M4 4a1 1 0 00-1 1v14a1 1 0 001 1h20a1 1 0 001-1V5a1 1 0 00-1-1H4z" />
                        </svg>
                    </div>
                </section>
            </div>
        </div>
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-8 text-gray-900 text-center">Latest Books</h2>
            <div class="flex flex-wrap gap-4 justify-center">
                @forelse ($latestBooks as $book)
                    <a href="{{ route('book.details', $book->id) }}"
                        class="w-full sm:w-1/2 md:w-1/4 lg:w-1/6 p-2 transition-transform transform hover:scale-105">
                        <div
                            class="bg-[#693c1a] border border-gray-300 rounded-lg shadow-md overflow-hidden hover:shadow-lg relative transition-shadow duration-300 p-3">
                            <!-- Book Image -->
                            @if ($book->book_pic)
                                <img src="{{ asset('storage/' . $book->book_pic) }}" alt="{{ $book->title }}"
                                    class="w-full h-52 object-cover">
                            @else
                                <img src="https://via.placeholder.com/150" alt="No image available"
                                    class="w-full h-52 object-cover">
                            @endif
                            <!-- New Badge -->
                            <span
                                class="bg-red-500 text-white text-xs px-2 py-1 rounded absolute top-2 left-2 uppercase font-semibold shadow-lg">New</span>
                            <!-- Book Details -->
                            <div class="pt-2 text-center">
                                <h3 class="text-base font-semibold text-gray-800 hover:text-blue-600 transition-colors">
                                    {{ $book->book_name }}</h3>
                                <p class="text-gray-600 text-sm hover:font-semibold transition-all">{{ $book->book_author }}
                                </p>
                                <p class="text-green-600 text-sm font-semibold mt-2">Rs. {{ $book->book_price }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-600 text-center">No books available at the moment.</p>
                @endforelse
            </div>
        </section>
    </div>
    </div>
@endsection
