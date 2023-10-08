<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FriendshipController extends Controller
{
    public function addFriend(User $user)
    {
        auth()->user()->friends()->attach($user);

        return back()->with('success', 'Friend added successfully');
    }

    public function removeFriend(User $user)
    {
        auth()->user()->friends()->detach($user);

        return back()->with('success', 'Friend removed successfully');
    }

    public function listFriends()
    {
        $friends = auth()->user()->friends;

        return view('friends.index', compact('friends'));
    }

}
