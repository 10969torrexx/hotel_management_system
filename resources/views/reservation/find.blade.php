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
                <input class="form-control" type="date" name="check_in" required value="{{ date('Y-m-d') }}" id="html5-date-input" min="{{ date('Y-m-d') }}">
            </div>
            <div class="mb-1">
                <label for="">Check Out</label>
                <input class="form-control" type="date" name="check_out" required value="{{ date('Y-m-d') }}" id="html5-date-input" min="{{ date('Y-m-d') }}">
            </div>
            <div class="mb-1 mt-1">
                <button type="submit" class="btn btn-primary">Find Room</button>
            </div>
        </form>
    </div>
</div>
@endsection