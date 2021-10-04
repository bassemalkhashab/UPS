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
    <nav>
        <ul class="navbar navbar-dark bg-dark d-flex justify-content-center ">
            <li><a href="/" class="navbar-brand p-5 ">Home</a></li>
            <li><a href="/shipped-items" class="navbar-brand p-5 ">Shipped items</a></li>
            <li><a href="/retail-center" class="navbar-brand p-5">Retail center</a></li>
            <li><a href="/transportation-event" class="navbar-brand p-5">Transportation event</a></li>
            <li><a href="/processes" class="navbar-brand p-5">Processes</a></li>

        </ul>
    </nav>
    <div class="w-50 m-auto p-5">
        @include('includes.validation')
    </div>
    <div class="d-flex">
        <div class="w-25 m-auto p-5">
            <!-- Output the result of form validations over the first form -->
           
            <form method="post" action="/processes/receivedAt" class="row g-3 p-3">
                @csrf
                <h3>Retail center</h3>
                <div class="form-group">
                    <label for="formGroupExampleInput">Shipped item</label>
                    <input type="text" class="form-control" placeholder="Item number" name="itemNumber" value="{{old('itemNumber')}}">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Received at</label>
                    <input type="text" class="form-control" placeholder="Retail center ID" name="uniqueID" value="{{old('uniqueID')}}">
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary w-100">
                </div>
            </form>
        </div>
        <div class="w-25 m-auto p-5">
            <!-- Output the result of form validations over the second form -->
            
            <form method="post" action="/processes/transportationMethod" class="row g-3 p-3">
                @csrf
                <h3>Transportation event</h3>
                <div class="form-group">
                    <label for="formGroupExampleInput">Shipped item</label>
                    <input type="text" class="form-control" placeholder="Item number" name="itemNumber" value="{{old('itemNumber')}}" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Transportation method</label>
                    <input type="text" class="form-control" placeholder="Schedule number" name="scheduleNumber" value="{{old('scheduleNumber')}}" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary w-100">
                </div>
            </form>
        </div>
    </div>

</body>

</html>