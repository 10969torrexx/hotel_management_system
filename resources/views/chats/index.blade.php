@extends('layouts.admin-layout')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Reply to Chats</h5>
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
                <div class="card-body">
                    <form action="{{route('chatReply')}}" method="post" enctype="multipart/form-data">@csrf
                        <input type="text" class="form-control d-none" hidden name="id" id="id">
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Name</label>
                            <label for="" class="form-control" id="name">Lorem ipsum dolor</label>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Email</label>
                            <label for="" class="form-control" id="email">example@sample.com</label>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Phome Number</label>
                            <label for="" class="form-control" id="phone_number">8-91-93</label>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Message</label>
                            <label for="" class="form-control" id="message">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta inventore sunt officiis a quas iure voluptate eos! Voluptatem, exercitationem adipisci? Temporibus neque quisquam cum necessitatibus iste expedita tempora aspernatur accusantium.</label>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Reply</label>
                            <textarea class="form-control" name="reply"  id="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>    
                    </form>
                </div>
            </div>
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
                            <th>Date Sent</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chats as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td class="text-wrap">{{ $item->message }}</td>
                                    <td>{{ date('M, d, Y', strtotime($item->created_at)) }}</td>
                                    <th>
                                        <a href="#" class="btn btn-outline-primary" id="replybutton" data-id="{{ $item->id }}">Reply</a>
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

    <script>
       $(document).on('click', '#replybutton', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('chatShow') }}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(response){
                    console.log(response);
                    $('#id').val(response.data.id);
                    $('#name').text(response.data.name);
                    $('#email').text(response.data.email);
                    $('#phone_number').text(response.data.phone_number);
                    $('#message').text(response.data.message);
                }
            });
        });

    </script>
@endsection