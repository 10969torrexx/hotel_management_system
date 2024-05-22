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
                            <textarea class="form-control" name="description"  id="exampleFormControlTextarea1 description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Room</button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection