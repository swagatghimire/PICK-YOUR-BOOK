<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    
    public function adminIndex()
    {
        $books = Book::with(['category', 'subcategory', 'subsubcategory'])->get();
        return view('admin.product', compact('books'));
    }
    public function userIndex(Request $request)
    {
        $categories = Category::with('subcategories.subsubcategories')->get();
        $booksQuery = Book::query();

        // Check for filtering by category, subcategory, or subsubcategory
        if ($request->filled('category_id')) {
            $booksQuery->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('subcategory_id')) {
            $booksQuery->where('subcategory_id', $request->input('subcategory_id'));
        }

        if ($request->filled('subsubcategory_id')) {
            $booksQuery->where('subsubcategory_id', $request->input('subsubcategory_id'));
        }

        // Exclude books owned by the logged-in user
        if (Auth::check()) {
            $booksQuery->where('owner_email', '!=', Auth::user()->email);
        }

        // Retrieve the filtered books
        $books = $booksQuery->orderBy('created_at', 'desc')->get();

        return view('allbooks', compact('categories', 'books'));
    }
    public function adminDestroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.products.index')->with('success', 'Book deleted successfully');
    }
    
    public function store(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'book_isbn' => 'required|digits:13|unique:books',
        'book_name' => 'required|string|max:255',
        'book_price' => 'required|numeric',
        'book_publication' => 'required|string|max:255',
        'book_author' => 'required|string|max:255',
        'book_condition' => 'required|string',
        'book_quantity' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:subcategories,id',
        'subsubcategory_id' => 'nullable|exists:subsubcategories,id',
        'book_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'owner_email' => 'required|email',
    ]);

    // Handle file upload
    $picPath = null; 
    if ($request->hasFile('book_pic')) {
        $originalFileName = $request->file('book_pic')->getClientOriginalName();
        
        // Store in public/storage/pictures
        $request->file('book_pic')->storeAs('pictures', $originalFileName, 'public');

        // Also store in public/pictures
        $request->file('book_pic')->move(public_path('pictures'), $originalFileName);

        // Store relative path in database
        $picPath = 'pictures/' . $originalFileName;
    }

    // Save the book data to the database
    Book::create([
        'book_isbn' => $validatedData['book_isbn'],
        'book_name' => $validatedData['book_name'],
        'book_price' => $validatedData['book_price'],
        'book_publication' => $validatedData['book_publication'],
        'book_author' => $validatedData['book_author'],
        'book_condition' => $validatedData['book_condition'],
        'book_quantity' => $validatedData['book_quantity'],
        'category_id' => $validatedData['category_id'],
        'subcategory_id' => $validatedData['subcategory_id'] ?? null,
        'subsubcategory_id' => $validatedData['subsubcategory_id'] ?? null,
        'book_pic' => $picPath, // This will store as 'pictures/<original_image_name>'
        'owner_email' => $validatedData['owner_email'],
    ]);

    return redirect()->route('sellhere')->with('success', 'Book added successfully.');
}


    


    public function showSellForm()
    {
        $user = Auth::user();
        $books = Book::where('owner_email', $user->email)->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $subsubcategories = Subsubcategory::all();

        return view('sellhere', compact('books', 'categories', 'subcategories', 'subsubcategories'));
    }
    public function home()
    {
        if (Auth::check()) {
            // Fetch the latest books excluding the authenticated user's own books
            $latestBooks = Book::where('owner_email', '!=', Auth::user()->email)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        } else {
            // Fetch the latest books without filtering
            $latestBooks = Book::orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        // Return the view with the latestBooks variable
        return view('home', compact('latestBooks'));
    }






// app/Http/Controllers/BookController.php

public function show($id)
{
    $book = Book::findOrFail($id); // Fetch the book by ID
    $categories = Category::all(); // Fetch all categories
    $subcategories = Subcategory::all(); // Fetch all subcategories
    $subsubcategories = Subsubcategory::all(); // Fetch all subsubcategories

    return view('books.show', compact('book', 'categories', 'subcategories', 'subsubcategories')); // Pass variables to the view
}

public function showd($id)
{
    // Retrieve the book with its related owner, category, subcategory, and subsubcategory
    $book = Book::with('owner', 'category', 'subcategory', 'subsubcategory')->findOrFail($id);

    // Combine features: category_name, subcategory_name, subsubcategory_name, book_author, book_name
    $bookFeatures = strtolower(
        ($book->category->category_name ?? '') . ' ' . 
        ($book->subcategory->subcategory_name ?? '') . ' ' . 
        ($book->subsubcategory->subsubcategory_name ?? '') . ' ' . 
        $book->book_author . ' ' . 
        $book->book_name
    );

    // Fetch all books to compare
    $allBooks = Book::with('category', 'subcategory', 'subsubcategory')->get();

    // Store similarity scores
    $similarBooks = [];

    foreach ($allBooks as $otherBook) {
        // Skip if it's the same book
        if ($otherBook->id == $book->id) {
            continue;
        }

        // Combine features for the other book, including category_name, subcategory_name, and subsubcategory_name
        $otherBookFeatures = strtolower(
            ($otherBook->category->category_name ?? '') . ' ' . 
            ($otherBook->subcategory->subcategory_name ?? '') . ' ' . 
            ($otherBook->subsubcategory->subsubcategory_name ?? '') . ' ' . 
            $otherBook->book_author . ' ' . 
            $otherBook->book_name
        );

        // Calculate cosine similarity
        $similarity = $this->calculateCosineSimilarity($bookFeatures, $otherBookFeatures);

        // Store the book and its similarity score
        $similarBooks[] = [
            'book' => $otherBook,
            'similarity' => $similarity,
        ];
    }

    // Sort by similarity score in descending order
    usort($similarBooks, function ($a, $b) {
        return $b['similarity'] <=> $a['similarity'];
    });

    // Pass the top similar books (e.g., top 5) to the view
    $recommendedBooks = array_slice($similarBooks, 0, 5);

    return view('bookdetails', compact('book', 'recommendedBooks'));
}

private function calculateCosineSimilarity($string1, $string2)
{
    // Full list of NLTK English stop words
    $stopWords = [
        'i', 'me', 'my', 'myself', 'we', 'our', 'ours', 'ourselves', 'you', 'your', 'yours', 
        'yourself', 'yourselves', 'he', 'him', 'his', 'himself', 'she', 'her', 'hers', 'herself', 
        'it', 'its', 'itself', 'they', 'them', 'their', 'theirs', 'themselves', 'what', 'which', 
        'who', 'whom', 'this', 'that', 'these', 'those', 'am', 'is', 'are', 'was', 'were', 'be', 
        'been', 'being', 'have', 'has', 'had', 'having', 'do', 'does', 'did', 'doing', 'a', 'an', 
        'the', 'and', 'but', 'if', 'or', 'because', 'as', 'until', 'while', 'of', 'at', 'by', 'for', 
        'with', 'about', 'against', 'between', 'into', 'through', 'during', 'before', 'after', 'above', 
        'below', 'to', 'from', 'up', 'down', 'in', 'out', 'on', 'off', 'over', 'under', 'again', 
        'further', 'then', 'once', 'here', 'there', 'when', 'where', 'why', 'how', 'all', 'any', 'both', 
        'each', 'few', 'more', 'most', 'other', 'some', 'such', 'no', 'nor', 'not', 'only', 'own', 'same', 
        'so', 'than', 'too', 'very', 's', 't', 'can', 'will', 'just', 'don', 'should', 'now'
    ];

    // Tokenize and filter out stop words for each string
    $words1 = array_filter(str_word_count($string1, 1), function ($word) use ($stopWords) {
        return !in_array($word, $stopWords);
    });
    $words2 = array_filter(str_word_count($string2, 1), function ($word) use ($stopWords) {
        return !in_array($word, $stopWords);
    });

    // Count word frequencies after filtering stop words
    $words1 = array_count_values($words1);
    $words2 = array_count_values($words2);

    // Combine the two sets of words
    $allWords = array_unique(array_merge(array_keys($words1), array_keys($words2)));

    // Create vectors
    $vec1 = [];
    $vec2 = [];

    foreach ($allWords as $word) {
        $vec1[] = isset($words1[$word]) ? $words1[$word] : 0;
        $vec2[] = isset($words2[$word]) ? $words2[$word] : 0;
    }

    // Calculate dot product and magnitudes
    $dotProduct = array_sum(array_map(function ($v1, $v2) {
        return $v1 * $v2;
    }, $vec1, $vec2));

    $magnitude1 = sqrt(array_sum(array_map(function ($v) {
        return $v * $v;
    }, $vec1)));

    $magnitude2 = sqrt(array_sum(array_map(function ($v) {
        return $v * $v;
    }, $vec2)));

    // Avoid division by zero
    if ($magnitude1 * $magnitude2 == 0) {
        return 0;
    }

    return $dotProduct / ($magnitude1 * $magnitude2);
}




    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'book_isbn' => 'required|digits:13|numeric',
            'book_name' => 'required|string|max:255',
            'book_price' => 'required|numeric|min:0',
            'book_publication' => 'required|string|max:255',
            'book_author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'subsubcategory_id' => 'nullable|exists:subsubcategories,id',
            'book_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('book_pic')) {
            $picPath = $request->file('book_pic')->store('pictures', 'public');
            $book->book_pic = $picPath;
        }

        $book->update([
            'book_isbn' => $validatedData['book_isbn'],
            'book_name' => $validatedData['book_name'],
            'book_author' => $validatedData['book_author'],
            'book_price' => $validatedData['book_price'],
            'book_publication' => $validatedData['book_publication'],
            'category_id' => $validatedData['category_id'],
            'subcategory_id' => $validatedData['subcategory_id'] ?? null,
            'subsubcategory_id' => $validatedData['subsubcategory_id'] ?? null,
        ]);

        return redirect()->route('books.show', $book->id)->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('sellhere')->with('success', 'Book deleted successfully');
    }

    public function search(Request $request)
{
    $searchTerm = $request->input('searchTerm');

    $books = Book::where(function ($query) use ($searchTerm) {
            $query->where('book_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('book_author', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('book_publication', 'LIKE', "%{$searchTerm}%");
        })
        ->where('owner_email', '!=', Auth::user()->email)
        ->get();

    return view('books.search_results', compact('books', 'searchTerm'));
}

    
    
}
