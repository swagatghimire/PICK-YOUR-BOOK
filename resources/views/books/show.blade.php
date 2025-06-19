@extends('layouts.app')

@section('title', $book->book_name)

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            {{-- Book Image and Details Container --}}
            <div class="flex flex-col md:flex-row bg-gray-100 p-4 rounded-lg shadow-inner">
                {{-- Book Image --}}
                <div class="flex-shrink-0 md:w-1/3 mb-4 md:mb-0">
                    <img src="{{ $book->book_pic ? asset('storage/' . $book->book_pic) : 'https://via.placeholder.com/350x500' }}"
                        alt="{{ $book->book_name }}" class="w-72 h-90 ml-12 object-cover rounded-lg shadow-md">
                    {{-- Actions Buttons Container (directly below the image) --}}
                    <div class="mt-2 flex flex-row gap-4 w-full">
                        <button id="editButton"
                            class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 w-full transition duration-300">Edit</button>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this book?');" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 w-full transition duration-300">Delete</button>
                        </form>
                    </div>
                </div>

                {{-- Book Details --}}
                <div class="md:ml-8 md:w-2/3">
                    <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $book->book_name }}</h1>
                    <p class="text-gray-800 text-lg mb-2"><strong>Author:</strong> {{ $book->book_author }}</p>
                    <p class="text-gray-800 text-lg mb-2"><strong>Price:</strong> Rs.
                        {{ number_format($book->book_price, 2) }}</p>
                    <p class="text-gray-800 text-lg mb-2"><strong>Publication:</strong> {{ $book->book_publication }}</p>
                    <p class="text-gray-800 text-lg mb-2"><strong>ISBN:</strong> {{ $book->book_isbn }}</p>
                    <p class="text-gray-800 text-lg mb-2"><strong>Category ID:</strong> {{ $book->category_id }}</p>
                    <p class="text-gray-800 text-lg mb-2"><strong>Subcategory ID:</strong> {{ $book->subcategory_id }}</p>
                    <p class="text-gray-800 text-lg mb-2"><strong>Sub-Subcategory ID:</strong>
                        {{ $book->subsubcategory_id }}</p>
                    <p class="text-gray-800 text-lg mb-2"><strong>Owner Email:</strong> {{ $book->owner_email }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Book Modal --}}
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-70 z-50 hidden">
        <div class="bg-white p-8 border border-gray-300 shadow-lg rounded-lg w-full max-w-lg relative">
            <button id="closeModal" class="absolute top-4 right-4 text-red-600 text-2xl hover:text-red-700">&times;</button>
            <h3 class="text-xl font-semibold mb-4">Edit Book</h3>
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                            placeholder="Book ISBN" value="{{ old('book_isbn', $book->book_isbn) }}" required>
                        @error('book_isbn')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="book_name" class="block text-sm font-medium text-gray-700">Book Name</label>
                        <input type="text" id="book_name" name="book_name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_name') border-red-500 @enderror"
                            placeholder="Book Name" value="{{ old('book_name', $book->book_name) }}">
                        @error('book_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="book_price" class="block text-sm font-medium text-gray-700">Book Price</label>
                        <input type="text" id="book_price" name="book_price"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_price') border-red-500 @enderror"
                            placeholder="Book Price" value="{{ old('book_price', $book->book_price) }}">
                        @error('book_price')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="book_publication" class="block text-sm font-medium text-gray-700">Book
                            Publication</label>
                        <input type="text" id="book_publication" name="book_publication"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_publication') border-red-500 @enderror"
                            placeholder="Book Publication" value="{{ old('book_publication', $book->book_publication) }}">
                        @error('book_publication')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="book_author" class="block text-sm font-medium text-gray-700">Book Author</label>
                        <input type="text" id="book_author" name="book_author"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_author') border-red-500 @enderror"
                            placeholder="Book Author" value="{{ old('book_author', $book->book_author) }}">
                        @error('book_author')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="book_condition" class="block text-sm font-medium text-gray-700">Book
                            Condition</label>
                        <select id="book_condition" name="book_condition"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_condition') border-red-500 @enderror">
                            <option value="" disabled>Select Condition</option>
                            <option value="used"
                                {{ old('book_condition', $book->book_condition) == 'used' ? 'selected' : '' }}>Used
                            </option>
                            <option value="brand_new"
                                {{ old('book_condition', $book->book_condition) == 'brand_new' ? 'selected' : '' }}>
                                Brand New</option>
                        </select>
                        @error('book_condition')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="book_quantity" class="block text-sm font-medium text-gray-700">Book
                            Quantity</label>
                        <input type="number" id="book_quantity" name="book_quantity"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_quantity') border-red-500 @enderror"
                            value="{{ old('book_quantity', $book->book_quantity) }}" min="1" required>
                        @error('book_quantity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="book_pic" class="block text-sm font-medium text-gray-700">Book Picture</label>
                        <input type="file" id="book_pic" name="book_pic"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('book_pic') border-red-500 @enderror">
                        @error('book_pic')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category_id" name="category_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('category_id') border-red-500 @enderror"
                            required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="book_subcategories"
                            class="block text-sm font-medium text-gray-700">Subcategory</label>
                        <select id="book_subcategories" name="subcategory_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('subcategory_id') border-red-500 @enderror">
                            <option value="">Select Subcategory</option>
                        </select>
                        @error('subcategory_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="book_subsubcategories"
                            class="block text-sm font-medium text-gray-700">Sub-Subcategory</label>
                        <select id="book_subsubcategories" name="subsubcategory_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('subsubcategory_id') border-red-500 @enderror">
                            <option value="">Select Sub-Subcategory</option>
                        </select>
                        @error('subsubcategory_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show the modal when Edit button is clicked
            document.getElementById('editButton').addEventListener('click', function() {
                document.getElementById('editModal').classList.remove('hidden');
            });

            // Hide the modal when close button is clicked
            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('editModal').classList.add('hidden');
            });

            // Fetch subcategories based on selected category
            document.getElementById('category_id').addEventListener('change', function() {
                var categoryId = this.value;
                var subcategorySelect = document.getElementById('book_subcategories');
                var subsubcategorySelect = document.getElementById('book_subsubcategories');

                subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';

                if (categoryId) {
                    fetch(`/admin/categories/${categoryId}/subcategories`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.subcategories.length > 0) {
                                data.subcategories.forEach(function(subcategory) {
                                    subcategorySelect.innerHTML +=
                                        `<option value="${subcategory.id}">${subcategory.subcategory_name}</option>`;
                                });
                            } else {
                                subcategorySelect.innerHTML =
                                    '<option value="">No subcategories available</option>';
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });

            // Fetch sub-subcategories based on selected subcategory
            document.getElementById('book_subcategories').addEventListener('change', function() {
                var subcategoryId = this.value;
                var subsubcategorySelect = document.getElementById('book_subsubcategories');

                subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';

                if (subcategoryId) {
                    fetch(`/admin/subcategories/${subcategoryId}/subsubcategories`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.subsubcategories.length > 0) {
                                data.subsubcategories.forEach(function(subsubcategory) {
                                    subsubcategorySelect.innerHTML +=
                                        `<option value="${subsubcategory.id}">${subsubcategory.subsubcategory_name}</option>`;
                                });
                            } else {
                                subsubcategorySelect.innerHTML =
                                    '<option value="">No sub-subcategories available</option>';
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

@endsection
