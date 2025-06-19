<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::with('category')->get();
        $subsubcategories = Subsubcategory::with('subcategory.category')->get();

        return view('admin.categories', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'subsubcategories' => $subsubcategories
        ]);
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'categoryName' => 'required|string|max:255|unique:categories,category_name',
        ], [
            'categoryName.unique' => 'The category name already exists.',
        ]);

        $category = new Category();
        $category->category_name = $request->input('categoryName');
        $category->admin_id = Auth::user()->id;
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'categoryName' => 'required|string|max:255|unique:categories,category_name,' . $category->id,
        ], [
            'categoryName.unique' => 'The category name already exists.',
        ]);

        $category->update([
            'category_name' => $request->categoryName
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json(['subcategories' => $subcategories]);
    }

    public function storeSubcategory(Request $request)
    {
        // Ensure the admin is authenticated
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in as an admin to perform this action.');
        }

        // Validate the request data
        $request->validate([
            'selectedCategory' => 'required|exists:categories,id',
            'subcategoryName' => 'required|string|max:255|unique:subcategories,subcategory_name,NULL,id,category_id,' . $request->input('selectedCategory'),
        ], [
            'subcategoryName.unique' => 'The subcategory name already exists in the selected category.',
        ]);

        // Create a new subcategory
        $subcategory = new Subcategory();
        $subcategory->category_id = $request->input('selectedCategory');
        $subcategory->subcategory_name = $request->input('subcategoryName');
        $subcategory->admin_id = Auth::guard('admin')->user()->id; // Accessing the admin's ID
        $subcategory->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Subcategory created successfully.');
    }

    public function updateSubcategory(Request $request, Subcategory $subcategory)
    {
        // Validate the request data
        $request->validate([
            'subcategoryName' => 'required|string|max:255|unique:subcategories,subcategory_name,' . $subcategory->id . ',id,category_id,' . $subcategory->category_id,
        ], [
            'subcategoryName.unique' => 'The subcategory name already exists in the selected category.',
        ]);

        // Update the subcategory
        $subcategory->subcategory_name = $request->input('subcategoryName');
        $subcategory->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Subcategory updated successfully.');
    }

    public function deleteSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Subcategory deleted successfully');
    }

    public function getSubsubcategories($subcategoryId)
    {
        $subsubcategories = Subsubcategory::where('subcategory_id', $subcategoryId)->get();
        return response()->json(['subsubcategories' => $subsubcategories]);
    }

    public function storeSubsubcategory(Request $request)
    {
        // Ensure the admin is authenticated
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in as an admin to perform this action.');
        }

        // Validate the request data
        $request->validate([
            'selectedCategory' => 'required|exists:categories,id',
            'selectedSubcategory' => 'required|exists:subcategories,id',
            'subsubcategoryName' => 'required|string|max:255|unique:subsubcategories,subsubcategory_name,NULL,id,subcategory_id,' . $request->input('selectedSubcategory'),
        ], [
            'subsubcategoryName.unique' => 'The sub-subcategory name already exists in the selected subcategory.',
        ]);

        // Create a new sub-subcategory
        $subsubcategory = new Subsubcategory();
        $subsubcategory->subcategory_id = $request->input('selectedSubcategory');
        $subsubcategory->subsubcategory_name = $request->input('subsubcategoryName');
        $subsubcategory->admin_id = Auth::guard('admin')->user()->id; // Accessing the admin's ID
        $subsubcategory->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Sub-subcategory created successfully.');
    }

    public function updateSubsubcategory(Request $request, $id)
    {
        // Ensure the admin is authenticated
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in as an admin to perform this action.');
        }

        // Validate the request data
        $request->validate([
            'subsubcategoryName' => 'required|string|max:255|unique:subsubcategories,subsubcategory_name,' . $id,
        ], [
            'subsubcategoryName.unique' => 'The sub-subcategory name already exists in the selected subcategory.',
        ]);

        // Find the sub-subcategory by ID or fail
        $subsubcategory = Subsubcategory::findOrFail($id);

        // Update the sub-subcategory name and the admin ID who made the update
        $subsubcategory->subsubcategory_name = $request->input('subsubcategoryName');
        $subsubcategory->admin_id = Auth::guard('admin')->user()->id; // Assign the updating admin's ID
        $subsubcategory->save();

        // Redirect back with success message
        return redirect()->route('admin.categories.index')->with('success', 'Sub-subcategory updated successfully.');
    }
    public function destroySubsubcategory($id)
    {
        $subsubcategory = Subsubcategory::findOrFail($id);
        $subsubcategory->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Sub-subcategory deleted successfully.');
    }
}
