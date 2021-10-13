@extends('includes.master')


@section('content')

<div class="vh-100 d-flex flex-column align-items-center justify-content-center">
    <!-- Output the result of form validations -->
    @include('includes.validation')
    <form action="/transportation-event/update/{{$transportationEvent->scheduleNumber}}/submit" method="post" class="row g-3 w-25 p-3">
        @csrf
        <input type="text" class="form-control" placeholder="Schedule number" name="scheduleNumber" value="{{$transportationEvent->scheduleNumber}}" required disabled>
        <input type="text" class="form-control" placeholder="Type" name="type" value="{{$transportationEvent->type}}" required>
        <input type="text" class="form-control" placeholder="Delivery route" name="deliveryRoute" value="{{$transportationEvent->deliveryRoute}}" required>       
            <input type="submit" value="Update item" class="btn btn-success">
        </form>
    </div>

@endsection