@extends('layouts.app')

@section('title', 'Book Details')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div class="w-full p-6">

        {{-- Book Details --}}
        <div class="bg-white p-6 rounded-lg shadow-lg w-full mx-auto">
            <div class="flex">
                <!-- Book Image -->
                <div class="flex-shrink-0">
                    <img src="{{ $book->book_pic ? asset('storage/' . $book->book_pic) : 'https://via.placeholder.com/300' }}"
                        alt="{{ $book->book_name }}"
                        class="w-70 h-96 object-cover rounded-lg shadow-md transition-transform duration-300 hover:scale-105 cursor-pointer"
                        onclick="openModal('{{ $book->book_pic ? asset('storage/' . $book->book_pic) : 'https://via.placeholder.com/300' }}')">
                </div>

                <!-- Book Details -->
                <div class="ml-8 flex-1">
                    <h1 class="text-5xl font-bold text-gray-800 mb-2">{{ $book->book_name }}</h1>
                    <p class="text-gray-600 text-lg"><strong>Author:</strong> {{ $book->book_author }}</p>
                    <p class="text-gray-800 text-lg"><strong>Publication:</strong> {{ $book->book_publication }}</p>
                    <p class="text-gray-800 text-lg"><strong>ISBN:</strong> {{ $book->book_isbn }}</p>

                    <!-- Genre Display -->
                    <p class="text-gray-800 text-lg mb-2">
                        <strong>Genre:</strong>
                        <span class="text-gray-600">
                            {{ $book->category->category_name ?? '' }},
                            {{ $book->subcategory->subcategory_name ?? '' }},
                            {{ $book->subsubcategory->subsubcategory_name ?? '' }}
                        </span>
                    </p>

                    <p class="text-gray-900 text-2xl font-bold mb-4">Price: <span
                            class="text-green-600">Rs.{{ number_format($book->book_price, 2) }}</span></p>

                    <!-- Contact Owner -->
                    <div class="mt-6 p-4 bg-gray-100 rounded-md shadow-md">
                        <p class="text-gray-600 mb-2">Contact the owner:</p>
                        <p class="text-gray-600">
                            <strong>Email:</strong> <a href="mailto:{{ $book->owner_email }}"
                                class="text-blue-600 hover:underline">{{ $book->owner_email }}</a>
                        </p>
                        <p class="text-gray-600">
                            <strong>Phone:</strong> {{ $book->owner->phone ?? 'Phone number not available' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-3xl font-semibold mb-6 text-red-500 text-center">Recommended Books</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
                @foreach ($recommendedBooks as $recommendedBook)
                    <div class="bg-[#FFF1E6] p-2 rounded-lg shadow-lg transition-transform duration-300 hover:shadow-xl hover:scale-105 max-w-xs mx-auto">
                        <a href="{{ route('book.details', $recommendedBook['book']->id) }}">
                            <img src="{{ $recommendedBook['book']->book_pic ? asset('storage/' . $recommendedBook['book']->book_pic) : 'https://via.placeholder.com/150' }}"
                                alt="{{ $recommendedBook['book']->book_name }}" class="w-70 h-96 object-cover rounded-md mb-4 transition-transform duration-300 transform hover:scale-105">
                        </a>
                        <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $recommendedBook['book']->book_name }}</h3>
                        <p class="text-gray-600 mb-2">by {{ $recommendedBook['book']->book_author }}</p>
                        <p class="text-gray-900 font-bold">Rs. {{ number_format($recommendedBook['book']->book_price, 2) }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Modal -->
        <div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden">
            <span class="absolute top-4 right-4 text-white cursor-pointer" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Full Image" class="max-w-full max-h-full p-4 rounded-lg">
        </div>
        <script>
            function openModal(imageSrc) {
                document.getElementById('modalImage').src = imageSrc;
                document.getElementById('imageModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('imageModal').classList.add('hidden');
            }
        </script>
    </div>
@endsection
