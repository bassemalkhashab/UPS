@extends('includes.master')


@section('content')

<div class="vh-100 d-flex flex-column align-items-center justify-content-center">
    <!-- Output the result of form validations -->
        @include('includes.validation')
        
        <form action="/retail-center/update/{{$retailCenter->uniqueID}}/submit" method="post" class="row g-3 w-25 p-3">
        @csrf
        <input type="text" class="form-control" placeholder="UniqueID" name="uniqueID" value="{{$retailCenter->uniqueID}}" required disabled>
        <input type="text" class="form-control" placeholder="Type" name="type" value="{{$retailCenter->type}}" required>
            <input type="text" class="form-control" placeholder="Address" name="address" value="{{$retailCenter->address}}" required>
            <input type="submit" value="Update item" class="btn btn-success">
        </form>
    </div>

@endsection