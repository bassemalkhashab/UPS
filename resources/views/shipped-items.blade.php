@extends('includes.master')


@section('content')

<div class="d-flex justify-content-center align-items-center m-5">
    <a href="/shipped-items/insert" class="w-25"><button class="btn btn-success w-100">Insert new item</button></a>
    </div>
    <h1 class="m-5">Display all shipped items</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Item number</th>
                <th>Item name</th>
                <th>Weight</th>
                <th>Dimensions</th>
                <th>Insurance amount</th>
                <th>Destination</th>
                <th>Final delivery date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($shippedItem as $item)
            <tr>
                        <td>{{$item->itemNumber}}</td>
                        <td>{{$item->itemName}}</td>
                        <td>{{$item->weight}}</td>
                        <td>{{$item->dimensions}}</td>
                        <td>{{$item->insuranceAmount}}</td>
                        <td>{{$item->destination}}</td>
                        <td>{{$item->finalDeliveryDate}}</td>
                        <td><a href="/shipped-items/update/{{$item->itemNumber}}"><button class="btn btn-secondary">Update</button></a></td>
                        <td><a href="/shipped-items/delete/{{$item->itemNumber}}"><button class="btn btn-danger">Delete</button></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

@endsection