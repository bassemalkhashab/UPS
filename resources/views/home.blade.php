<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <nav >
        <ul class="navbar navbar-dark bg-dark d-flex justify-content-center ">
            <li><a href="/" class="navbar-brand p-5 ">Home</a></li>
            <li><a href="/shipped-items" class="navbar-brand p-5 ">Shipped items</a></li>
            <li><a href="/retail-center" class="navbar-brand p-5">Retail center</a></li>
            <li><a href="/transportation-event" class="navbar-brand p-5">Transportation event</a></li>
            <li><a href="/processes" class="navbar-brand p-5">Processes</a></li>

        </ul>
    </nav>
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
</body>

</html>