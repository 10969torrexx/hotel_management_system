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
    @if(Session::has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}")
        </script>
    @endif
    <h5 class="card-header">Make Reservation</h5>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-6">
                <img src="/{{ $rooms->file_path }}" alt="">
            </div>
            <div class="col-6">
                <div class="mb-1">
                    <label for="" class="m-0">Room Type</label>
                    <h2 class="m-0"><strong>{{ config('const.room_type.'. $rooms->type)}}</strong></h2>    
                </div>
                <div class="mb-1">
                    <label for="" class="m-0">Room #</label>
                    <h2 class="m-0"><strong>{{ $rooms->number }}</strong></h2>  
                </div>
                <div class="mb-1">
                    <label for="" class="m-0">Price</label>
                    <h2 class="m-0"><strong>₱{{  number_format($rooms->price, 2) }}</strong></h2>  
                </div>
                <div class="mb-1">
                    <label for="" class="m-0">Status</label>
                    <h2 class="m-0"><strong>{{ config('const.room_status.'.$rooms->status) }}</strong></h2>  
                </div>
                <div class="mb-1">
                    <label for="" class="m-0">Description</label>
                    <p><strong>{{ $rooms->description }}</strong></p>
                </div>
                <form action="{{ route('reservationMake') }}" method="post">
                    @csrf
                    <input type="text" name="id" value="{{ $rooms->id }}" class="form-control d-none">
                    <div class="mb-1">
                        <label for="">Check In</label>
                        <input class="form-control" type="date" name="check_in" required value="{{ date('Y-m-d') }}" id="html5-date-input" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-1">
                        <label for="">Check Out</label>
                        <input class="form-control" type="date" name="check_out" required value="{{ date('Y-m-d') }}" id="html5-date-input" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-1 mt-1">
                        <button type="submit" class="btn btn-primary">Make Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection