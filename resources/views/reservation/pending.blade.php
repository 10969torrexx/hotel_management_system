@extends('layouts.admin-layout')
@section('content')
<div class="content-wrapper">
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
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Pending Reservations</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Client Name</th>
                      <th>Room #</th>
                      <th>Type</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Check In</th>
                      <th>Check Out</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($reservations as $item)
                            <tr>
                                <td>{{ $item->client_name }}</td>
                                <td>{{ $item->number }}</td>
                                <td>{{ config('const.room_type.'.$item->type) }}</td>
                                <td><img src="/{{ $item->file_path }}" alt="" style="height: 100px;"></td>
                                <td>₱{{ number_format($item->price, 2) }}</td>
                                <td>{{ date('M, d, Y', strtotime($item->check_in)) }}</td>
                                <td>{{ date('M, d, Y', strtotime($item->check_out)) }}</td>
                                <td><span class="badge bg-label-primary me-1">{{ config('const.reservation_status.'.$item->reservation_status) }}</span></td>
                                <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('reservationAccept', [
                                            'id' => encrypt($item->reservation_id), 
                                            'email' => $item->email, 
                                            'number' => $item->number, 
                                            'room_id' => $item->room_id
                                        ]) }}"><i class="bx bx-edit-alt me-1"></i> Accept</a>
                                        <a class="dropdown-item" href="{{ route('reservationDecline', [
                                            'id' => encrypt($item->reservation_id), 
                                            'email' => $item->email, 
                                            'number' => $item->number, 
                                            'room_id' => $item->room_id
                                        ]) }}"><i class="bx bx-trash me-1"></i> Decline</a>
                                    </div>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection