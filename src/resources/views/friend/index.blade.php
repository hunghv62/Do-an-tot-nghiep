@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="/css/friend/index.css">
@endsection
@section('content')
    <div class="container">
        <div class="logo-head">
            <div class="float-left">
                logo
            </div>
            <div class="float-right">
                <button id="list">friends list</button>
                <button id="request">friends request</button>
                <button id="find" class="ml-2">find friend</button>
            </div>
        </div>
        <table id="list_friend" class="mt-3">
            <thead>
            <tr>
                <td class="text-center">Avatar</td>
                <td class="text-left">Full Name</td>
                <td class="text-center">Status</td>
                <td class="text-center">Actions</td>
            </tr>
            </thead>
            @foreach($data as $row)
                <tbody>
                <tr>
                    <td class="text-center">avatar</td>
                    <td class="text-left">{{ $row->user->name }}</td>
                    <td class="text-center">{{ \App\Models\Friend::STATUS_TEXT[$row->status] }}</td>
                    <td class="text-center">
                        <a href="" class="mr-3">Unfriend</a>
                        <a href="">Message</a>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
        <table id="list_request" class="d-none mt-3">
            <thead>
            <tr>
                <td class="text-center">Avatar</td>
                <td class="text-left">Full Name</td>
                <td class="text-center">Status</td>
                <td class="text-center">Actions</td>
            </tr>
            </thead>
            @foreach($dataRequest as $row)
                <tbody>
                <tr>
                    <td class="text-center">avatar</td>
                    <td class="text-left">{{ $row->user->name }}</td>
                    <td class="text-center">{{ \App\Models\Friend::STATUS_TEXT[$row->status] }}</td>
                    <td class="text-center">
                        <a href="" class="mr-3">accept</a>
                        <a href="">reject</a>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
        <div id="find_friend" class="d-none">
            <div class="float-right mt-3 mb-3">
                <form action="" id="form_search_friend">
                    @csrf
                    <input type="text" placeholder="type name ..." name="key_search">
                    <button type="button" id="search">search</button>
                </form>
            </div>
            <table>
                <thead>
                <tr>
                    <td class="text-center">Avatar</td>
                    <td class="text-left">Full Name</td>
                    <td class="text-center">Actions</td>
                </tr>
                </thead>
                <tbody id="body_search">
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#request').click(function () {
                $('#list_request').removeClass('d-none')
                $('#list_friend').addClass('d-none')
                $('#find_friend').addClass('d-none')
            });
            $('#list').click(function () {
                $('#list_friend').removeClass('d-none')
                $('#list_request').addClass('d-none')
                $('#find_friend').addClass('d-none')
            });
            $('#find').click(function () {
                $('#find_friend').removeClass('d-none')
                $('#list_request').addClass('d-none')
                $('#list_friend').addClass('d-none')
            });
            $('#search').click(function () {
                let key = $('#key_search').val()
                if (key !== '') {
                    $.ajax({
                        url: '{{ route('friend.find_friend') }}',
                        data: $('#form_search_friend').serialize(),
                        method: 'post',
                        success: function (res) {
                            console.log(res)
                            let html = '';
                            $.each(res, function (key, val) {
                                html += '<tr>\n' +
                                    '                    <td class="text-center">avatar</td>\n' +
                                    '                    <td class="text-left">' + val.name + '</td>\n' +
                                    '                    <td class="text-center">\n' +
                                    '                        <button class="mr-3 add_friend">Add Friend</button>\n' +
                                    '                    </td>\n' +
                                    '                </tr>'
                            })
                            $('#body_search').html(html)

                            $('.add_friend').on('click', function () {
                                $(this).text('Requested');
                            })
                        },
                        error: function (err) {
                            toastr.error(err.responseJSON.message);
                        }
                    })
                }
            });


        })
    </script>
@endsection
