<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // Show profile page
    public function index()
    {
        return view('profile');
    }

    // Show a specific user's profile
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profile', ['user' => $user]);
    }

    // Approve a user
    public function approve($userId)
    {
        $user = User::findOrFail($userId);
        $user->status = 'approved'; // Update status to approved
        $user->save();

        return redirect()->route('user.index')->with('success', 'User approved successfully.');
    }

    // Decline a user
    public function decline($userId)
    {
        $user = User::findOrFail($userId);
        $user->status = 'declined'; // Update status to declined
        $user->save();

        return redirect()->route('user.index')->with('success', 'User declined successfully.');
    }

    // Update user profile
    public function update(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'regex:/^[a-zA-Z]+$/', 'max:255'],
            'middle_name' => ['nullable', 'string', 'regex:/^[a-zA-Z]+$/', 'max:255'],
            'last_name' => ['required', 'string', 'regex:/^[a-zA-Z]+$/', 'max:255'],
            'phone' => ['required', 'regex:/^(98|97)[0-9]{8}$/'],  // Must start with 98 or 97 and be 10 digits
            'address' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date', 'before:-10 years', 'after:-70 years'],  // Date must be between 10 and 70 years ago
            'gender' => 'required|in:Male,Female,Other',
            'user_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the authenticated user
        $user = User::findOrFail(Auth::id());
        // Update user information
        $user->first_name = $validatedData['first_name'];
        $user->middle_name = $validatedData['middle_name'];
        $user->last_name = $validatedData['last_name'];
        $user->phone = $validatedData['phone'];
        $user->dob = $validatedData['dob'];
        $user->address = $validatedData['address'];
        $user->gender = $validatedData['gender'];

        // Handle profile picture upload
        if ($request->hasFile('user_pic')) {
            $file = $request->file('user_pic');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile_pics', $fileName);
            $user->user_pic = $fileName;
        }

        // Save the updated user
        $user->save();

        // Redirect back with success message
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
// Update password
/**
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function updatePassword(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'old_password' => ['required', 'string', 'min:8'],
        'new_password' => ['required',
            'string',
            'min:8',
            'regex:/[0-9]/',  // Must contain at least one number
            'regex:/[!@#$%^&*(),.?":{}|<>]/',  // Must contain at least one special character
            'confirmed'],  // Password confirmation must match
    ]);

    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Check if the old password matches the current password
    if (!Hash::check($validatedData['old_password'], $user->password)) {
        return back()->withErrors(['old_password' => 'Your current password does not match our records.']);
    }

    // Check if the new password is the same as the old password
    if ($validatedData['old_password'] === $validatedData['new_password']) {
        return back()->withErrors(['new_password' => 'New password cannot be the same as the old password.']);
    }

    // Hash the new password and update it in the database
    $user->password = Hash::make($validatedData['new_password']);
    $user->save();

    // Redirect back with success message
    return redirect()->route('profile.index')->with('success', 'Password updated successfully!');
}



    // Delete user account
    public function destroy(Request $request)
    {
        $user = User::findOrFail(Auth::id());
    
        // Delete all books associated with the user
        $user->books()->delete();
    
        // Optionally, delete the user's profile picture
        if ($user->user_pic) {
            Storage::disk('public')->delete('profile_pics/' . $user->user_pic);
        }
    
        // Delete the user
        $user->delete();
    
        return redirect()->route('home')->with('success', 'Account deleted successfully along with your books.');
    }
    

}
