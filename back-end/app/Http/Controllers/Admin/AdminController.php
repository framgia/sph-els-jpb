<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\AdminTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdminController extends Controller
{
    // Call traits for reusable codes for checking if the user is admin
    use AdminTrait;

    // Display a listing of the Users. 
    public function index()
    {
        $users = User::where('is_admin', false)->get();

        return response()->json(['data' => $users], 200);
    }

    // Display the specified User. 
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);

        if ($user->is_admin) throw new HttpException(404, 'User not found');

        return response()->json(['data' => $user], 200);
    }

    // Update the specified User in storage. 
    /*
    public function update(Request $request, $user_id)
    {
        $this->isAdmin();

        // Admin doesn't need to have a password confirmation function.
        // * This method will be updated in the future for requesting a reset password. 
        // * A function that will generate a random password should be added here.

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
    } */

    // Remove the specified User from storage. 
    public function destroy($user_id)
    {
        $this->isAdmin();

        User::find($user_id)->delete();

        return response()->json(['message' => 'Account Deleted Successfully']);
    }
}
