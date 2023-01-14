<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $title = "New Orders";
        $breadcrumb = "Nowe zamówienia";

        $users = User::all();

        return view('pages.dashboard.user-list', compact('title', 'breadcrumb', 'users'));
    }
}
