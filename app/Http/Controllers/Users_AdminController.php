<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Users_AdminController extends Controller
{
    public function showUsers()
    {

        return view('admin.users', [
            'users' => User::get()
        ]);
    }
}
