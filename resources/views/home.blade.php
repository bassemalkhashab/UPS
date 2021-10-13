@extends('includes.master')


@section('content')

<h1 class="m-5">
    Dashboard
</h1>
<table class="table table-striped">
    <thead>
            <th>Shipped items</th>
            <th>Retail center</th>
            <th>Transportation event</th>
        </thead>
        <tbody>
            <!-- Return an array with all shipped items -->
            @foreach($shippedItems as $shippedItem)
            <tr>
                <td>{{$shippedItem->itemNumber}}</td>
                <td>{{$shippedItem->uniqueID}}
                    <!-- If there's a value display delete button -->
                    @empty($shippedItem->uniqueID)
                    @else
                    <a href="/home/delete/uniqueID/{{$shippedItem->uniqueID}}/itemNumber/{{$shippedItem->itemNumber}}"><button class="btn btn-danger">Delete</button></a>
                    @endempty
                </td>
                    <td>{{$shippedItem->scheduleNumber}}
                        @empty($shippedItem->scheduleNumber)
                        @else
                        <a href="/home/delete/scheduleNumber/{{$shippedItem->scheduleNumber}}/itemNumber/{{$shippedItem->itemNumber}}"><button class="btn btn-danger">Delete</button></a>
                        @endempty
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <script src="{{asset('js/app.js')}}"></script>
    
    @endsection