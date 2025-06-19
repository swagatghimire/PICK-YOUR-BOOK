@extends('layouts.app')

@section('title', 'All Books')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for hover effects */
        .hover-bg-animation {
            background-size: 200% auto;
            transition: background-position 0.5s ease;
        }

        .hover-bg-animation:hover {
            background-position: right center;
        }

        /* Shadow and hover animation for book cards */
        .book-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05); /* Subtle border to make cards distinct */
            box-shadow: 0 5px 15px rgba(173, 216, 230, 0.5); /* Soft light blue shadow */
            margin-bottom: 20px; /* Extra margin to separate cards */
        }

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 12px 24px rgba(30, 144, 255, 0.5); /* Blue shadow on hover */
            border-color: rgba(30, 144, 255, 0.7); /* Blue border on hover */
        }
    </style>

    <div class="flex min-h-screen bg-[#F0F8FF] text-gray-800">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#FFF1E6] text-gray-800 p-4 shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Categories</h2>
            <ul>
                @foreach ($categories as $category)
                    <li class="mb-2">
                        <button 
                            class="w-full text-left px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md hover-bg-animation"
                            onclick="filterBooks({{ $category->id }}, null, null)">
                            {{ $category->category_name }}
                        </button>
                        @if ($category->subcategories->count() > 0)
                            <ul class="pl-4 mt-2">
                                @foreach ($category->subcategories as $subcategory)
                                    <li class="mb-2">
                                        <button 
                                            class="w-full text-left px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md hover-bg-animation"
                                            onclick="filterBooks({{ $category->id }}, {{ $subcategory->id }}, null)">
                                            {{ $subcategory->subcategory_name }}
                                        </button>
                                        @if ($subcategory->subsubcategories->count() > 0)
                                            <ul class="pl-4 mt-2">
                                                @foreach ($subcategory->subsubcategories as $subsubcategory)
                                                    <li>
                                                        <button 
                                                            class="w-full text-left px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-800 rounded-md hover-bg-animation"
                                                            onclick="filterBooks({{ $category->id }}, {{ $subcategory->id }}, {{ $subsubcategory->id }})">
                                                            {{ $subsubcategory->subsubcategory_name }}
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-800">Books</h1>
            </div>

            <div id="book-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"> <!-- Increased gap for separation -->
                @foreach ($books as $book)
                    <a href="{{ route('book.details', $book->id) }}">
                        <div class="bg-white p-4 rounded-lg shadow-md book-card">
                            <img src="{{ $book->book_pic ? asset('storage/' . $book->book_pic) : 'https://via.placeholder.com/150' }}" alt="{{ $book->book_name }}" class="w-full h-72 object-cover mb-2 rounded-t-lg">
                            <h2 class="text-2xl font-semibold text-gray-900">{{ $book->book_name }}</h2>
                            <p class="text-gray-700">{{ $book->book_author }}</p>
                            <p class="text-gray-800 font-bold">Rs.{{ number_format($book->book_price, 2) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </main>
    </div>

    <script>
        function filterBooks(categoryId, subcategoryId, subsubcategoryId) {
            let url = new URL(window.location.href);
            url.searchParams.set('category_id', categoryId || '');
            url.searchParams.set('subcategory_id', subcategoryId || '');
            url.searchParams.set('subsubcategory_id', subsubcategoryId || '');
            window.location.href = url.toString();
        }
    </script>
@endsection
