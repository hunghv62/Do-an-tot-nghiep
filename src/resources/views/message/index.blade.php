@extends('layouts.app')
@section('stype')
    <link rel="stylesheet" href="{{ asset('css/message/index.css') }}">
@endsection
@section('content')
    <div class="container">
        <h1>Message will be appeared below</h1>
        <div id="list_message">
        </div>
        <form id="sendMessage">
            @csrf
            <input type="text" name="message">
            <button type="button" id="sendButton">Send</button>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('d707decfb907126d1546', {
                cluster: 'ap3',
                auth: {
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                },
                authEndpoint: '{{ route('pusherAuth') }}'
            });

            // var channel = pusher.subscribe('my-channel');
            var channel = pusher.subscribe('private-message');
            channel.bind('my-event', function (data) {
                if (data.user_created != {{ auth()->id() }}) {
                    let html = '<div>' + data.message + '</div>';
                    $('#list_message').append(html)
                }
            });

            let route_send = '{{ route('message.store') }}'
            $('#sendButton').click(function () {
                $.ajax({
                    url: route_send,
                    method: 'post',
                    data: $('#sendMessage').serialize(),
                    beforeSend: function () {
                        // $('#sendButton').blockUI();
                    },
                    success: function (response) {
                        let html = '<div ';
                        if (response.user_created == {{ auth()->id() }}) {
                            html += 'style="color: blue"'
                        }
                        html += '>' + response.content_text + '</div>';
                        $('#list_message').append(html)
                    },
                    error: function (err) {
                        toastr.error(err.responseJSON.message);
                    },
                    complete: function () {
                        // $('#sendButton').unblockUI();
                    }
                })
            })
        })
    </script>
@endsection
