<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'regex:/^[a-zA-Z]+$/', 'max:255'], // No numbers allowed
            'last_name' => ['required', 'string', 'regex:/^[a-zA-Z]+$/', 'max:255'],  // No numbers allowed
            'phone' => ['required', 'regex:/^(98|97)[0-9]{8}$/'],  // Must start with 98 or 97 and be 10 digits
            'address' => ['required', 'string', 'max:255'],  // Can include numbers
            'dob' => ['required', 'date', 'before:-10 years', 'after:-70 years'],  // Date must be between 10 and 70 years ago
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],  // Must be unique in users table
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[0-9]/',  // Must contain at least one number
                'regex:/[!@#$%^&*(),.?":{}|<>]/',  // Must contain at least one special character
                'confirmed'  // Password confirmation required
            ],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Redirect to login page with a success message
        return redirect($this->redirectPath())->with('success', 'Registration successful. Please login.');
    }
}
