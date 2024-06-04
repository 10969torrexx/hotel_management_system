@extends('layouts.user-layout')
@section('content')
<div class="card mb-4 shadow-sm">
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
    <h5 class="card-header">Find Room</h5>
    <div class="card-body">
        <form action="" method="post">
            @csrf
            <div class="mb-1">
                <label for="">Check In</label>
                <input class="form-control" type="date" name="check_in" required value="{{ isset($checkIn) ? $checkIn : date('Y-m-d') }}" id="html5-date-input" min="{{ date('Y-m-d') }}">
            </div>
            <div class="mb-1">
                <label for="">Check Out</label>
                <input class="form-control" type="date" name="check_out" required value="{{ isset($checkOut) ? $checkOut : date('Y-m-d') }}" id="html5-date-input" min="{{ date('Y-m-d') }}">
            </div>
            <div class="mb-1 mt-1">
                <button type="submit" class="btn btn-primary">Find Room</button>
            </div>
        </form>
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
                    <th>Price</th>
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
                            <td>{{ $item->description }}</td>
                            <td>₱{{ number_format($item->price, 2) }}</td>
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
                                    <a class="dropdown-item" id="editbutton" href="javascript:void(0);" data-id="{{ encrypt($item->id ) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route('roomsDelete', ['id' => encrypt($item->id)]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
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
@endsection