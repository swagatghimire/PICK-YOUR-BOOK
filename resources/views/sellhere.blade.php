@extends('layouts.app')

@section('title', 'Sell Here')

@section('content')

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-attachment: fixed;
            overflow-y: scroll;
        }
        /* Shadow and hover animation for book cards */
        .book-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 5px 15px rgba(173, 216, 230, 0.5); /* Soft light blue shadow */
        }

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 12px 24px rgba(30, 144, 255, 0.5); /* Blue shadow on hover */
            border-color: rgba(30, 144, 255, 0.7); /* Blue border on hover */
        }
    </style>

    <div class="w-full px-4 mt-16">
        <div class="flex justify-end mb-6">
            <button id="makeVisible" class="w-36 h-12 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition-colors">Sell Book</button>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-4xl font-extrabold mb-8 text-gray-900">Your Books</h2>

            @if (isset($books) && $books->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach ($books as $book)
                    <a href="{{ route('books.show', $book->id) }}" class="bg-white rounded-xl shadow-lg overflow-hidden w-full book-card">
                        <div class="relative">
                            <div class="h-64 bg-cover bg-center"
                                style="background-image: url('{{ $book->book_pic ? asset('storage/' . $book->book_pic) : 'https://via.placeholder.com/300' }}');">
                            </div>
                           
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 uppercase">{{ $book->book_name }}</h3>
                            <p class="text-gray-600 mb-4">by {{ $book->book_author ?? 'Unknown Author' }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            
            @else
                <p class="text-gray-600 text-lg">No books available at the moment. Please check back later.</p>
            @endif

            <!-- Sell Book Form -->
            <div id="sellHere" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-70 z-50 hidden">
                <div class="bg-white p-8 border border-gray-300 shadow-lg rounded-lg w-full max-w-lg relative">
                    <button id="cross" class="absolute top-4 right-4 text-red-600 text-2xl hover:text-red-700">&times;</button>
                    <h3 class="text-xl font-semibold mb-4">Add New Book</h3>
                    <form action="{{ route('sellhere.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <!-- Hidden input for owner_email -->
                            <input type="hidden" name="owner_email" value="{{ Auth::user()->email }}">

                            <div>
                                <label for="book_isbn" class="block text-sm font-medium text-gray-700">Book ISBN</label>
                                <input type="text" id="book_isbn" name="book_isbn"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_isbn') border-red-500 @enderror"
                                    placeholder="Book ISBN" value="{{ old('book_isbn') }}" required>
                                @error('book_isbn')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="book_name" class="block text-sm font-medium text-gray-700">Book Name</label>
                                <input type="text" id="book_name" name="book_name"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_name') border-red-500 @enderror"
                                    placeholder="Book Name" value="{{ old('book_name') }}">
                                @error('book_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="book_price" class="block text-sm font-medium text-gray-700">Book Price</label>
                                <input type="text" id="book_price" name="book_price"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_price') border-red-500 @enderror"
                                    placeholder="Book Price" value="{{ old('book_price') }}">
                                @error('book_price')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="book_publication" class="block text-sm font-medium text-gray-700">Book Publication</label>
                                <input type="text" id="book_publication" name="book_publication"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_publication') border-red-500 @enderror"
                                    placeholder="Book Publication" value="{{ old('book_publication') }}">
                                @error('book_publication')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="book_author" class="block text-sm font-medium text-gray-700">Book Author</label>
                                <input type="text" id="book_author" name="book_author"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_author') border-red-500 @enderror"
                                    placeholder="Book Author" value="{{ old('book_author') }}">
                                @error('book_author')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="book_condition" class="block text-sm font-medium text-gray-700">Book Condition</label>
                                <select id="book_condition" name="book_condition"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_condition') border-red-500 @enderror">
                                    <option value="" disabled selected>Select Condition</option>
                                    <option value="used" {{ old('book_condition') == 'used' ? 'selected' : '' }}>Used</option>
                                    <option value="brand_new" {{ old('book_condition') == 'brand_new' ? 'selected' : '' }}>Brand New</option>
                                </select>
                                @error('book_condition')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="book_quantity" class="block text-sm font-medium text-gray-700">Book Quantity</label>
                                <input type="number" id="book_quantity" name="book_quantity"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_quantity') border-red-500 @enderror"
                                    value="{{ old('book_quantity', 1) }}">
                                @error('book_quantity')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Book Categories</label>
                                <select id="category_id" name="category_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('category_id') border-red-500 @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Subcategories -->
                            <div>
                                <label for="subcategory_id" class="block text-sm font-medium text-gray-700">Book Subcategories</label>
                                <select id="subcategory_id" name="subcategory_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('subcategory_id') border-red-500 @enderror">
                                    <option value="">Select Subcategory</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Sub-Subcategories -->
                            <div>
                                <label for="subsubcategory_id" class="block text-sm font-medium text-gray-700">Book Sub-Subcategories</label>
                                <select id="subsubcategory_id" name="subsubcategory_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('subsubcategory_id') border-red-500 @enderror">
                                    <option value="">Select Sub-Subcategory</option>
                                    @foreach ($subsubcategories as $subsubcategory)
                                        <option value="{{ $subsubcategory->id }}">{{ $subsubcategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('subsubcategory_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="book_picture" class="block text-sm font-medium text-gray-700">Book Picture</label>
                                <input type="file" id="book_pic" name="book_pic"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_picture') border-red-500 @enderror">
                                @error('book_picture')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Add Book</button>
                    </form>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Handle the visibility of the sell form
                    document.getElementById('makeVisible').addEventListener('click', function() {
                        document.getElementById('sellHere').classList.remove('hidden');
                    });

                    document.getElementById('cross').addEventListener('click', function() {
                        document.getElementById('sellHere').classList.add('hidden');
                    });

                    // Fetch and update subcategories
                    document.getElementById('category_id').addEventListener('change', function() {
                        var categoryId = this.value;
                        var subcategorySelect = document.getElementById('subcategory_id');
                        var subsubcategorySelect = document.getElementById('subsubcategory_id');

                        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                        subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';

                        if (categoryId) {
                            fetch(`/admin/categories/${categoryId}/subcategories`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.subcategories && data.subcategories.length > 0) {
                                        data.subcategories.forEach(function(subcategory) {
                                            subcategorySelect.innerHTML +=
                                                `<option value="${subcategory.id}">${subcategory.subcategory_name}</option>`;
                                        });
                                    } else {
                                        subcategorySelect.innerHTML =
                                            '<option value="">No subcategories available</option>';
                                    }
                                })
                                .catch(error => console.error('Error fetching subcategories:', error));
                        }
                    });

                    // Fetch and update sub-subcategories
                    document.getElementById('subcategory_id').addEventListener('change', function() {
                        var subcategoryId = this.value;
                        var subsubcategorySelect = document.getElementById('subsubcategory_id');

                        subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';

                        if (subcategoryId) {
                            fetch(`/admin/subcategories/${subcategoryId}/subsubcategories`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.subsubcategories && data.subsubcategories.length > 0) {
                                        data.subsubcategories.forEach(function(subsubcategory) {
                                            subsubcategorySelect.innerHTML +=
                                                `<option value="${subsubcategory.id}">${subsubcategory.subsubcategory_name}</option>`;
                                        });
                                    } else {
                                        subsubcategorySelect.innerHTML =
                                            '<option value="">No sub-subcategories available</option>';
                                    }
                                })
                                .catch(error => console.error('Error fetching sub-subcategories:', error));
                        }
                    });
                });
            </script>
        </div>
    </div>

@endsection


