@extends('layouts.admin-layout')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <script>
                        toastr.error("{{  $error }}")
                    </script>
                @endforeach
            @endif
            @if(Session::has('success'))
                <script>
                    toastr.success("{{ Session::get('success') }}")
                </script>
            @endif
            @if (count($chats) <= 0)
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                            <lottie-player src="https://lottie.host/0a731f25-c465-43fd-84d3-c19915e2f23f/HGDqixWDVY.json" background="##FFFFFF" speed="1" style="width: 40%;" loop autoplay direction="1" mode="normal"></lottie-player>
                            <h4 class="text-center">No messages found</h4>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <h5 class="card-header">List of Messages</h5>
                    <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Message</th>
                            <th>Reply</th>
                            <th>Date Sent</th>
                            <th>Date Replied</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chats as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td class="text-nowrap">{{ $item->message }}</td>
                                    <td class="text-nowrap">{{ $item->reply }}</td>
                                    <td>{{ date('M, d, Y H:i:s', strtotime($item->created_at)) }}</td>
                                    <td>{{ date('M, d, Y H:i:s', strtotime($item->updated_at)) }}</td>
                                    <th>
                                        <a href="{{ route('chatDelete', ['id' => $item->id]) }}" class="btn btn-outline-danger" id="replybutton" data-id="{{ $item->id }}">Delete</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection