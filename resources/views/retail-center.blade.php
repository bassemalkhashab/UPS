@extends('includes.master')


@section('content')

<div class="d-flex justify-content-center align-items-center m-5">
    <a href="/retail-center/insert" class="w-25"><button class="btn btn-success w-100">Insert new item</button></a>
    </div>
    <h1 class="m-5">Display all retail centers</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>UniqueID</th>
                <th>Type</th>
                <th>Address</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($retailCenters as $retailCenter)
            <tr>
                    <td>{{$retailCenter->uniqueID}}</td>
                    <td>{{$retailCenter->type}}</td>
                    <td>{{$retailCenter->address}}</td>
                    <td><a href="/retail-center/update/{{$retailCenter->uniqueID}}"><button class="btn btn-secondary">Update</button></a></td>
                    <td><a href="/retail-center/delete/{{$retailCenter->uniqueID}}"><button class="btn btn-danger">Delete</button></a></td>
                </tr>
                @endforeach
        </tbody>
    </table>

@endsection