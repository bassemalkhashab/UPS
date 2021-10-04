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
    <div class="vh-100 d-flex flex-column align-items-center justify-content-center fle">
        <!-- Output the result of form validations -->
        @include('includes.validation')
       
        <form action="/shipped-items/update/{{$shippedItem->itemNumber}}/submit" method="post" class="row g-3 w-25 p-3">
            @csrf
            <input type="text" class="form-control" placeholder="Item number" name="itemNumber" value="{{$shippedItem->itemNumber}}" required disabled>
            <input type="text" class="form-control" placeholder="Weight" name="weight" value="{{$shippedItem->weight}}" required>
            <input type="text" class="form-control" placeholder="Dimension" name="dimension" value="{{$shippedItem->dimensions}}" required>
            <input type="text" class="form-control" placeholder="Insurance amount" name="insuranceAmount" value="{{$shippedItem->insuranceAmount}}" required>
            <input type="text" class="form-control" placeholder="Destination" name="destination" value="{{$shippedItem->destination}}" required>
            <input type="text" class="form-control" placeholder="Final delivery date" name="finalDeliveryDate" value="{{$shippedItem->finalDeliveryDate}}" required>
            <input type="submit" value="Update item" class="btn btn-success">
        </form>
    </div>
</body>

</html>