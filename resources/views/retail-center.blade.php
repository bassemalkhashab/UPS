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
</body>

</html>