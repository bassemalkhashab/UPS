@extends('includes.master')


@section('content')

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
    
    @endsection