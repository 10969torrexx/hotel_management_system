@extends('layouts.user-layout')
@section('content')
<div class="card">
    <h5 class="card-header">Your Reservations</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead class="table-dark">
          <tr>
            <th>Room #</th>
            <th>type</th>
            <th>Image</th>
            <th>Price</th>
            <th>Status</th>
            <th>Check In</th>
            <th>Check Out</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($reservations as $item)
                <tr>
                    <td>{{ $item->number }}</td>
                    <td>{{ config('const.room_type.'.$item->type) }}</td>
                    <td>
                        <img src="/{{ $item->file_path }}" alt="" style="height: 100px;">
                    </td>
                    <td>₱{{ number_format($item->price, 2) }}</td>
                    <td>{{ config('const.reservation_status.'.$item->reservation_status) }}</td>
                    <td>{{ date('M, d, Y', strtotime($item->check_in)) }}</td>
                    <td>{{ date('M, d, Y', strtotime($item->check_out)) }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection