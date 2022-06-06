<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
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
            'password' => 'required|string|confirmed|min:9',
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $cover = get_headers('https://source.unsplash.com/1600x900/?galaxy', 1);
        $user_id = User::latest()->first()->id;

        Image::create([
            'user_id' => $user_id,
            'avatar_url' => "https://api.multiavatar.com/{$user_id}/{$data['first_name']}",
            'cover_url' => $cover["Location"],
        ]);

        // $token = $user->createToken('elstoken')->plainTextToken;

        return response()->json([
            'message' => 'Account Created Successfully',
            // $token
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
        $data = $request->validate([
            'avatar_url' => 'url|max:999|nullable',
            'cover_url' => 'url|max:999|nullable',
            'first_name' => 'string|max:191|nullable',
            'last_name' => 'string|max:191|nullable',
            'email' => 'email|unique:users|max:191|nullable',
            'current_password' => 'string|required',
            'new_password' => 'string|nullable|min:9',
        ]);

        $user = User::findOrFail($user_id);

        // User must confirm current password if they want to update something.
        if (!Hash::check($data['current_password'], $user->password)) {
            return response()->json(['message' => 'Old Password is incorrect'], 401);
        }

        // Update specific details if the user wants to, set to current value if not.
        $user->update([
            'first_name' => $data['first_name'] ? $data['first_name'] : $user->first_name,
            'last_name' => $data['last_name'] ? $data['last_name'] : $user->last_name,
            'email' => $data['email'] ? $data['email'] : $user->email,
            'password' => $data['new_password'] ? bcrypt($data['new_password']) : $user->password,
        ]);

        $image = Image::findOrFail($user_id);

        Image::where('user_id', $user_id)->update([
            'avatar_url' => $data['avatar_url'] ? $data['avatar_url'] : $image->avatar_url,
            'cover_url' => $data['cover_url'] ? $data['cover_url'] : $image->cover_url,
        ]);

        return response()->json(['message' => 'Account Updated Successfully'], 201);
    }

    // Remove the specified User from storage. 
    /*
    public function destroy($user_id)
    {
        // This method is for future purposes if the users want to delete their account
        User::find($user_id)->delete();

        return response()->json(['message' => 'Account Deleted Successfully']);
    }
    */

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
