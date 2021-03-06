<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('getLogin');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $param = $request->only(['email', 'password']);

        $user = User::where('email', $param['email'])->first();
        if (!isset($user)) {
            return redirect()->back()->with('error', 'Tài khoản không tồn tại!');
        }

        if ($user->email_verified_at === '') {
            return redirect()->back()->with('error', 'Tài khoản chưa được kích hoạt');
        }

        if (Auth::attempt($param)) {
            return redirect()->route('index');
        } else {
            return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
