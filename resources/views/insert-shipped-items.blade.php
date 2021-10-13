@extends('includes.master')


@section('content')


    <div class="vh-100 d-flex flex-column align-items-center justify-content-center fle">
        <!-- Output the result of form validations -->
        @include('includes.validation')
       
        <form action="/shipped-items/insert" method="post" class="row g-3 w-25 p-3">
            @csrf
            <input type="text" class="form-control" placeholder="Item number" name="itemNumber" value="{{old('itemNumber')}}" required>
            <input type="text" class="form-control" placeholder="Weight" name="weight" value="{{old('weight')}}" required>
            <input type="text" class="form-control" placeholder="Dimension" name="dimension" value="{{old('dimension')}}" required>
            <input type="text" class="form-control" placeholder="Insurance amount" name="insuranceAmount" value="{{old('insuranceAmount')}}" required>
            <input type="text" class="form-control" placeholder="Destination" name="destination" value="{{old('destination')}}" required>
            <input type="text" class="form-control" placeholder="Final delivery date" name="finalDeliveryDate" value="{{old('finalDeliveryDate')}}" required>
            <input type="submit" value="Insert item" class="btn btn-success">
        </form>
    </div>
@endsection