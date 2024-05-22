@extends('layouts.admin-layout')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Add Room</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Number</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp">
                    </div>
                    <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Name</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp">
                    </div>
                    <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Room Type</label>
                        <select id="defaultSelect" class="form-select">
                            @foreach (config('const.room_type') as $item)
                                <option value="{{ ($loop->iteration) - 1 }}">{{ ucfirst(config('const.room_type.'.($loop->iteration) - 1)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection