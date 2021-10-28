@extends('includes.master')


@section('content')

<div class="vh-100 d-flex flex-column align-items-center justify-content-center fle">
    <!-- Output the result of form validations -->
    @include('includes.validation')
    
    <form action="/shipped-items/update/{{$shippedItem->itemNumber}}/submit" method="post" class="row g-3 w-25 p-3" enctype="multipart/form-data">
            @csrf
            <input type="text" class="form-control" placeholder="Item number" name="itemNumber" value="{{$shippedItem->itemNumber}}" required disabled>
            <input type="text" class="form-control" placeholder="Name" name="itemName" value="{{$shippedItem->itemName}}" required>
            <input type="text" class="form-control" placeholder="Weight" name="weight" value="{{$shippedItem->weight}}" required>
            <input type="text" class="form-control" placeholder="Dimension" name="dimension" value="{{$shippedItem->dimensions}}" required>
            <input type="text" class="form-control" placeholder="Insurance amount" name="insuranceAmount" value="{{$shippedItem->insuranceAmount}}" required>
            <input type="text" class="form-control" placeholder="Destination" name="destination" value="{{$shippedItem->destination}}" required>
            <input type="text" class="form-control" placeholder="Final delivery date" name="finalDeliveryDate" value="{{$shippedItem->finalDeliveryDate}}" required>

            <input type="file" class="form-control" id="customFile" name="image">
            <label class="custom-file-label" for="customFile">Upload an image</label>

            <input type="submit" value="Update item" class="btn btn-success">
        </form>
    </div>

@endsection