@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login/index.css') }}" rel="stylesheet">
<div class="container">
    Cảm ơn {{ $name }} vì đã đăng ký tài khoản.
    <br>
    Hãy xác thực email để tiếp tục sủ dụng!
    <br>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('verify', $id) }}">Xác thực</a>
        </div>
    </div>
</div>
@endsection
