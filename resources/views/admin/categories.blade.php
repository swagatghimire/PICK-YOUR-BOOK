<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
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

    <div class="container mx-auto py-8">
        <!-- Display Success or Error Messages -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex space-x-6 fade-in">
            <!-- Add Category Form -->
            <div class="bg-white p-8 border border-gray-300 rounded-lg shadow-lg w-1/3">
                <h3 class="text-xl font-semibold mb-4 slide-in">Add Category</h3>
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="categoryName" class="block text-gray-700 mb-2">Category Name:</label>
                        <input type="text" id="categoryName" name="categoryName" placeholder="Enter category name"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="text-center">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 transform hover:scale-105">Add
                            Category</button>
                    </div>
                </form>
            </div>

            <!-- Add Subcategory Form -->
            <div class="bg-white p-8 border border-gray-300 rounded-lg shadow-lg w-1/3">
                <h3 class="text-xl font-semibold mb-4 slide-in">Add Subcategory</h3>
                <form method="POST" action="{{ route('admin.subcategories.store') }}">
                    @csrf
                    <div class="mb-4 slide-in">
                        <label for="categorySelect" class="block text-gray-700 mb-2">Select Category:</label>
                        <select id="categorySelect" name="selectedCategory"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 slide-in">
                        <label for="subcategoryName" class="block text-gray-700 mb-2">Subcategory Name:</label>
                        <input type="text" id="subcategoryName" name="subcategoryName"
                            placeholder="Enter subcategory name"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="text-center slide-in">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 transform hover:scale-105">Add
                            Subcategory</button>
                    </div>
                </form>
            </div>

            <!-- Add Sub-subcategory Form -->
            <div class="bg-white p-8 border border-gray-300 rounded-lg shadow-lg w-1/3">
                <h3 class="text-xl font-semibold mb-4 slide-in">Add Sub-subcategory</h3>
                <form method="POST" action="{{ route('admin.subsubcategories.store') }}">
                    @csrf
                    <div class="mb-4 slide-in">
                        <label for="categorySelect2" class="block text-gray-700 mb-2">Select Category:</label>
                        <select id="categorySelect2" name="selectedCategory"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 slide-in">
                        <label for="subcategorySelect" class="block text-gray-700 mb-2">Select Subcategory:</label>
                        <select id="subcategorySelect" name="selectedSubcategory"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select a subcategory</option>
                        </select>
                    </div>
                    <div class="mb-4 slide-in">
                        <label for="subsubcategoryName" class="block text-gray-700 mb-2">Sub-subcategory Name:</label>
                        <input type="text" id="subsubcategoryName" name="subsubcategoryName"
                            placeholder="Enter sub-subcategory name"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="text-center slide-in">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 transform hover:scale-105">Add
                            Sub-subcategory</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Category Table -->
        <div class="mt-8">
            <h3 class="text-2xl font-semibold mb-6 text-gray-700">Categories</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 text-left text-gray-600 font-medium">Category Name</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-6 text-gray-800">{{ $category->category_name }}</td>
                                <td class="py-3 px-6">
                                    <div class="flex space-x-4">
                                        <!-- Update Form -->
                                        <form method="POST"
                                            action="{{ route('admin.categories.update', $category->id) }}"
                                            class="w-full">
                                            @csrf
                                            @method('POST')
                                            <div class="flex items-center space-x-2">
                                                <input type="text" name="categoryName"
                                                    value="{{ $category->category_name }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                                                <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                        <!-- Delete Form -->
                                        <form method="POST"
                                            action="{{ route('admin.categories.destroy', $category->id) }}"
                                            class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Subcategory Table -->
        <div class="mt-8">
            <h3 class="text-2xl font-semibold mb-6 text-gray-700">Subcategories</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 text-left text-gray-600 font-medium">Subcategory Name</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-medium">Category</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-6 text-gray-800">{{ $subcategory->subcategory_name }}</td>
                                <td class="py-3 px-6 text-gray-800">{{ $subcategory->category->category_name }}</td>
                                <td class="py-3 px-6">
                                    <div class="flex space-x-4">
                                        <!-- Update Form -->
                                        <form method="POST"
                                            action="{{ route('admin.subcategories.update', $subcategory->id) }}"
                                            class="w-full">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex items-center space-x-2">
                                                <input type="text" name="subcategoryName"
                                                    value="{{ $subcategory->subcategory_name }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                                                <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                        <!-- Delete Form -->
                                        <form method="POST"
                                            action="{{ route('admin.subcategories.destroy', $subcategory->id) }}"
                                            class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Sub-subcategory Table -->
        <div class="mt-8">
            <h3 class="text-2xl font-semibold mb-6 text-gray-700">Sub-subcategories</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 text-left text-gray-600 font-medium">Sub-subcategory Name</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-medium">Subcategory</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-medium">Category</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subsubcategories as $subsubcategory)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-6 text-gray-800">{{ $subsubcategory->subsubcategory_name }}</td>
                                <td class="py-3 px-6 text-gray-800">
                                    {{ $subsubcategory->subcategory->subcategory_name }}</td>
                                <td class="py-3 px-6 text-gray-800">
                                    {{ $subsubcategory->subcategory->category->category_name }}</td>
                                <td class="py-3 px-6">
                                    <div class="flex space-x-4">
                                        <!-- Update Form -->
                                        <form method="POST"
                                            action="{{ route('admin.subsubcategories.update', $subsubcategory->id) }}"
                                            class="w-full">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex items-center space-x-2">
                                                <input type="text" name="subsubcategoryName"
                                                    value="{{ $subsubcategory->subsubcategory_name }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                                                <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                        <!-- Delete Form -->
                                        <form method="POST"
                                            action="{{ route('admin.subsubcategories.destroy', $subsubcategory->id) }}"
                                            class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('categorySelect');
            const subcategorySelect = document.getElementById('subcategorySelect');
            const categorySelect2 = document.getElementById('categorySelect2');
            const subcategorySelect2 = document.getElementById('subcategorySelect');

            // Handle category change in the subcategory form
            categorySelect.addEventListener('change', function() {
                fetch(`/admin/categories/${this.value}/subcategories`)
                    .then(response => response.json())
                    .then(data => {
                        subcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';
                        data.subcategories.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.subcategory_name;
                            subcategorySelect.appendChild(option);
                        });
                    });
            });

            // Handle category change in the sub-subcategory form
            categorySelect2.addEventListener('change', function() {
                fetch(`/admin/categories/${this.value}/subcategories`)
                    .then(response => response.json())
                    .then(data => {
                        subcategorySelect2.innerHTML = '<option value="">Select a subcategory</option>';
                        data.subcategories.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.subcategory_name;
                            subcategorySelect2.appendChild(option);
                        });
                    });
            });

            // Handle subcategory change in the sub-subcategory form
            subcategorySelect2.addEventListener('change', function() {
                // Add similar fetch request for sub-subcategories if needed
            });
        });

        function toggleForm(formId) {
            const form = document.getElementById(formId);
            form.classList.toggle('hidden');
        }
    </script>

</body>

</html>
