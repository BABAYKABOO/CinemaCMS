<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserEdit_AdminController extends Controller
{
    public function showUser(int $user_id)
    {
        return view('admin.user_edit', [
            'user' => User::where('user_id', $user_id)->first()
        ]);
    }
    public function save(Request $request, int $user_id)
    {
        User::saveUser($request, $user_id);
        return redirect(route('admin-users'));
    }
}
