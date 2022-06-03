<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UsersController extends Controller
{
    // Display a listing of the Users. 
    public function index()
    {
        $users = User::where('is_admin', false)->get();

        return response()->json(['data' => $users], 200);
    }

    // Store a newly created User in storage. 
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|string|unique:users|max:191',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('elstoken')->plainTextToken;

        return response()->json([
            'message' => 'Account Created Successfully',
            $token
        ], 201);
    }

    // Display the specified User. 
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);

        if ($user->is_admin) throw new HttpException(404, 'User not found');

        return response()->json(['data' => $user], 200);
    }

    // Update the specified User in storage. 
    public function update(Request $request, $user_id)
    {
        // This method will be updated in the future task for users update informations.
        $user = $request->validate([
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|unique:users|max:191',
            'password' => 'required',
        ]);

        User::findOrFail($user_id)->update([
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
        ]);

        return response()->json(['message' => 'Account Updated Successfully'], 201);
    }

    // Remove the specified User from storage. 
    public function destroy($user_id)
    {
        User::find($user_id)->delete();

        return response()->json(['message' => 'Account Deleted Successfully']);
    }

    // Login user and generate access token for authentication.
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|max:191',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        // Check user credential
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Email or Password is incorrect'], 401);
        }

        $token = $user->createToken('elstoken')->plainTextToken;

        return response()->json([
            'message' => 'Success Login',
            $token
        ], 201);
    }

    // Logout user and delete the access token from storage. 
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out',
        ], 201);
    }
}
