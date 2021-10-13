@extends('includes.master')


@section('content')

<div class="d-flex justify-content-center align-items-center m-5">
    <a href="/transportation-event/insert" class="w-25"><button class="btn btn-success w-100">Insert new item</button></a>
</div>
<h1 class="m-5">Display all transportation events</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Schedule number</th>
                <th>Type</th>
                <th>Delivery route</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($transportationEvents as $transportationEvent)
            <tr>
                <td>{{$transportationEvent->scheduleNumber}}</td>
                <td>{{$transportationEvent->type}}</td>
                <td>{{$transportationEvent->deliveryRoute}}</td>
                <td><a href="/transportation-event/update/{{$transportationEvent->scheduleNumber}}"><button class="btn btn-secondary">Update</button></a></td>
                <td><a href="/transportation-event/delete/{{$transportationEvent->scheduleNumber}}"><button class="btn btn-danger">Delete</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection