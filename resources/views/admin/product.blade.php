<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="w-full bg-indigo-600 text-white flex justify-between items-center p-4">
        <div class="logo">
            <img src="{{ asset('icons/logo.png') }}" alt="Logo" class="h-10">
        </div>
        <nav class="navbar flex space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-200">Home</a>
            <a href="{{ route('admin.users.index') }}" class="hover:text-gray-200">Manage Users</a>
            <a href="{{ route('admin.products.index') }}" class="hover:text-gray-200">Manage Products</a>
            <a href="{{ route('admin.categories.index') }}" class="hover:text-gray-200">Manage Categories</a>
        </nav>
        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit"
                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md relative overflow-hidden btn">
                Logout
            </button>
        </form>
    </header>
    
    <div class="container mx-auto py-8 flex-grow">
        <h1
            class="text-4xl font-bold text-center mb-8 bg-gradient-to-r from-blue-400 to-blue-800 text-white py-4 rounded-lg shadow-lg">
            Books Details</h1>
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <p class="text-center text-gray-600 mb-6">This table displays the details of all books.</p>
            <hr class="mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border">Book Name</th>
                            <th class="py-2 px-4 border">Book ISBN</th>
                            <th class="py-2 px-4 border">Author</th>
                            <th class="py-2 px-4 border">Price</th>
                            <th class="py-2 px-4 border">Publisher</th>
                            <th class="py-2 px-4 border">Categories</th>
                            <th class="py-2 px-4 border">Sub Categories</th>
                            <th class="py-2 px-4 border">Sub Sub Categories</th>
                            <th class="py-2 px-4 border">Book Pic</th>
                            <th class="py-2 px-4 border">Owner Email</th>
                            <th class="py-2 px-4 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-2 px-4 border">{{ $book->book_name }}</td>
                                <td class="py-2 px-4 border">{{ $book->book_isbn }}</td>
                                <td class="py-2 px-4 border">{{ $book->book_author }}</td>
                                <td class="py-2 px-4 border">{{ $book->book_price }}</td>
                                <td class="py-2 px-4 border">{{ $book->book_publication }}</td>
                                <td class="py-2 px-4 border">{{ $book->category->category_name ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border">{{ $book->subcategory->subcategory_name ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border">{{ $book->subsubcategory->subsubcategory_name ?? 'N/A' }}
                                </td>
                                <td class="py-2 px-4 border">
                                    <img src="{{ asset('storage/' . $book->book_pic) }}" alt="Book Pic" class="h-16 mx-auto">
                                </td>
                                <td class="py-2 px-4 border">{{ $book->owner_email }}</td>
                                <td class="py-2 px-4 border">
                                    <form class="inline-block" method="POST"
                                        action="{{ route('admin.products.destroy', $book->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this book?')">
                                        @csrf
                                        @method('DELETE')
                                        <input
                                            class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded cursor-pointer"
                                            type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto text-center">
            &copy; 2024 Your Company. All rights reserved.
        </div>
    </footer>
</body>

</html>
