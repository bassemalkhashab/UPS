@extends('includes.master')


@section('content')


    <div class="vh-100 d-flex flex-column align-items-center justify-content-center">
        <!-- Output the result of form validations -->
        @include('includes.validation')
        <form action="/transportation-event/insert" method="post" class="row g-3 w-25 p-3">
        @csrf
            <input type="text" class="form-control" placeholder="Schedule number" name="scheduleNumber" value="{{old('scheduleNumber')}}" required>
            <input type="text" class="form-control" placeholder="Type" name="type" value="{{old('type')}}" required>
            <input type="text" class="form-control" placeholder="Delivery route" name="deliveryRoute" value="{{old('deliveryRoute')}}" required>       
            <input type="submit" value="Insert item" class="btn btn-success">
        </form>
    </div>
@endsection