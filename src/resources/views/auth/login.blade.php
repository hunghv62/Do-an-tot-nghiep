@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login/index.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="login-form">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email hoặc số điện thoại" required="required" name="user_name">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Mật khẩu" required="required" name="password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                            </div>
                            <div class="clearfix text-center">
                                <a href="#">Quên mật khẩu?</a>
                            </div>
                            <hr>
                            <div class="form-group">
                                <p class="text-center"><a href="#" id="create">Tạo tài khoản mới</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
