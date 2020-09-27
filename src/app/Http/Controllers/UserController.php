<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\VerifyEmail;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        try {
            $data = $request->only("first_name", "last_name", "email", "password", "confirm_password", "birth_day", "gender");
            $data['name'] = $request->first_name . ' ' . $request->last_name;
            unset($data['first_name'], $data['last_name']);
            $data['role'] = $request->role ?? User::USER;
            $user = User::create($data);
            VerifyEmail::dispatch($user);
            return redirect()->route('index')->with('success', 'Đăng ký thành công');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function verify($id){
        $user = User::find(base64_decode($id));
        $user->email_verified_at = Carbon::now();
        $user->save();
        dd('đăng nhập luôn vào sử dụng');
        return 1;
    }
}
