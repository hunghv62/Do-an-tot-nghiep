<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        try {
            $data = $request->only("first_name", "last_name", "email", "password", "confirm_password", "birth_day", "gender");
            $data['name'] = $request->first_name . ' ' . $request->last_name;
            unset($data['first_name'], $data['last_name']);
            $data['role'] = $request->role ?? User::USER;
            User::create($data);
            return redirect()->route('index')->with('success', 'Đăng ký thành công');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
