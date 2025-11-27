<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $postsCount = Post::count();
        $users = User::all();

        return view('admin.index', compact('usersCount', 'postsCount', 'users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent admin from deleting themselves or other admins
        if ($user->is_admin) {
            return redirect()->route('admin')->with('error', 'Cannot delete admin users.');
        }

        $user->delete();

        return redirect()->route('admin')->with('success', 'User deleted successfully.');
    }
}
