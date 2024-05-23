@extends('layouts.admin-layout')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Add Room</h5>
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
                    <form action="{{ route('roomsStore') }}" method="post" enctype="multipart/form-data">@csrf
                        <input type="text" class="form-control" name="id" id="id">
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Number</label>
                            <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="number" autofocus>
                            @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Price</label>
                            <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="defaultSelect" class="form-label">Room Type</label>
                            <select id="defaultSelect" class="form-select" name="type">
                                @foreach (config('const.room_type') as $item)
                                    <option value="{{ ($loop->iteration) - 1 }}">{{ ucfirst(config('const.room_type.'.($loop->iteration) - 1)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" name="img" id="img formFile" type="file">
                          </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" name="description"  id="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Room</button>    
                    </form>
                </div>
            </div>
            @if (count($rooms) <= 0)
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                            <lottie-player src="https://lottie.host/0a731f25-c465-43fd-84d3-c19915e2f23f/HGDqixWDVY.json" background="##FFFFFF" speed="1" style="width: 40%;" loop autoplay direction="1" mode="normal"></lottie-player>
                            <h4 class="text-center">No rooms found</h4>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <h5 class="card-header">List of Rooms</h5>
                    <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th>Room #</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $item)
                                <tr>
                                    <td>{{ $item->number }}</td>
                                    <td class="text-wrap">{{ $item->description }}</td>
                                    <td><img src="/{{ $item->file_path }}" alt="" height="100"></td>
                                    <td>{{ ucfirst(config('const.room_type.'.($item->type) )) }}</td>
                                    <td>{{ ucfirst(config('const.room_status.' . $item->status)) }}</td>
                                    <td>{{ date('M, d, Y', strtotime($item->created_at)) }}</td>
                                    <th>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                            <a class="dropdown-item" id="editbutton" href="javascript:void(0);" data-id="{{ $item->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="{{ route('roomsDelete', ['id' => $item->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
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
        $(document).on('click', '#editbutton', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('roomsShow') }}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#number').val(response.data.number);
                    $('#price').val(response.data.price);
                    $('#description').text(response.data.description);
                    $('#defaultSelect').val(response.data.type);
                    $('#exampleFormControlTextarea1').val(response.data.description);
                    $('#img').val(response.file_path);
                    $('#id').val(response.data.id);

                    console.log(response.data.id);
                }
            });
        });
    </script>
@endsection