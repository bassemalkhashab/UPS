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
</body>

</html>