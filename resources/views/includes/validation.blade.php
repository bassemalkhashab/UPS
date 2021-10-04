@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{session()->get('success')}}
    </div>
@endif

@if(session()->has('failure'))
    <div class="alert alert-danger" role="alert">
        {{session()->get('failure')}}
    </div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
    @endforeach
@endif