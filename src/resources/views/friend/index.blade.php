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
                    <td class="text-left">{{ $row->user->name ?? '' }}</td>
                    <td class="text-center">{{ \App\Models\Friend::STATUS_TEXT[$row->status] }}</td>
                    <td class="text-center">
                        <a href="" class="mr-3">Unfriend</a>
                        <a href="{{ route('message.index', $row->id) }}">Message</a>
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
                    <td class="text-left">{{ $row->user->name ?? '' }}</td>
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
                <form action="" id="form_search_friend" method="post">
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
    <form id="add_friend_form" method="post" class="d-none">
        @csrf
        <input type="hidden" name="id" value="">
    </form>
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
                            let html_fake = '';
                            $.each(res.friends, function (key, val) {
                                html += '<tr>\n' +
                                    '                    <td class="text-center">avatar</td>\n' +
                                    '                    <td class="text-left">' + val.name + '</td>\n' +
                                    '                    <td class="text-center">\n' +
                                    '                        <button class="mr-3 add_friend" data-id="' + val.id + '"';

                                $.each(res.friend_requested, function (key1, val1) {
                                    if (val1.friend_id == val.id) {
                                        html_fake += ' disabled >Requested';
                                        return false;
                                    }
                                })

                                if(html_fake == '') {
                                    html += '>Add Friend';
                                } else {
                                    html += html_fake;
                                }
                                html += '</button>\n' +
                                    '                    </td>\n' +
                                    '                </tr>';
                            })
                            $('#body_search').html(html)

                            $('.add_friend').on('click', function () {
                                addFriend($(this).data('id'))
                            })
                        },
                        error: function (err) {
                            toastr.error(err.responseJSON.message);
                        }
                    })
                }
            });

            function addFriend(id) {
                $('input[name=id]').val(id)
                $.ajax({
                    url: '{{ route('friend.create') }}',
                    data: $('#add_friend_form').serialize(),
                    method: 'post',
                    success: function (res) {
                        toastr.success(res.success);
                        $('.add_friend').text('Requested');
                    },
                    error: function (err) {
                        toastr.error(err.responseJSON.message);
                    }
                })
            }

        })
    </script>
@endsection
