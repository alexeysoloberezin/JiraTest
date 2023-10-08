<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    public function index(Request  $request): Response
    {
        $currentUserId = Auth::id();
        $users = User::where('id', '!=', $currentUserId)->get();

        $currentUserFriends = Auth::user()->friends;

        return Inertia::render('Users/index', [
            'users' => $users,
            'currentUserFriends' => $currentUserFriends,
            'myId' => $currentUserId,
        ]);
    }

    public function show(int $id): Response
    {
        $user = User::find($id);

        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);

    }
}
