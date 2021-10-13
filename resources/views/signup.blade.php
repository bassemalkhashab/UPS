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
        <ul class="navbar navbar-dark bg-dark d-flex justify-content-end">
            <li><a href="/login" class="navbar-brand p-5">Sign in</a></li>

        </ul>
    </nav>
    <div class="w-50 m-auto p-5">
        @include('includes.validation')
    </div>
    <form class="w-25 vh-100 m-auto pt-5" method="post" action="/sign-up">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Re-enter password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="reenterPassword">
        </div>
        
        <button type="submit" class="btn btn-primary">Create account</button>
    </form>
</body>

</html>