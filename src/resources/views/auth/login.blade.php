@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login/index.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="login-form">
                        <form action="{{ route('login') }}" method="post" id="login">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" required name="email"
                                       data-msg-required="Hãy nhập email"
                                       data-msg-email="Hãy nhập đúng định dạng email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Mật khẩu" required name="password"
                                       data-msg-required="Hãy nhập mật khẩu">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                            </div>
                            <div class="clearfix text-center">
                                <a href="#">Quên mật khẩu?</a>
                            </div>
                            <hr>
                            <div class="form-group">
                                <p class="text-center"><a data-toggle="modal" class="create" data-target="#exampleModal">Tạo tài khoản mới</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('auth.register')
@endsection
@section('script')
    <script>
        $(function() {
            $("#login").validate({
                rules: {
                    email: {
                        required: true,
                    },
                    password: {
                        required: true
                    }
                }
            });
        });

    </script>
@endsection
