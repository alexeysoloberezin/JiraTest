<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index(Request $request)
    {
        return auth()->user()->friends;
    }
}
