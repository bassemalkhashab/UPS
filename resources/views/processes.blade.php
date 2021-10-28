@extends('includes.master')


@section('content')
<div class="d-flex justify-content-center align-items-center">
    <h1 class="display-4 p-5">Shipped items</h1>
</div>

<div class="input-group w-50 m-auto">
    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" id="search" value="{{old('search')}}" onkeyup="searchItem()" />
    <button type="button" class="btn btn-outline-primary" onclick="searchKey()">search</button>
</div>

<div class="mb-5">
    <div class="list-group shadow w-50 mx-auto " id="searchResults">

    </div>
</div>

<div class="accordion" id="accordionExample">
    @foreach($shippedItems as $shippedItem)
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$shippedItem->itemNumber}}" aria-expanded="false" aria-controls="collapseOne">
                <span class="badge rounded-pill bg-dark mx-3">{{$shippedItem->itemNumber}}</span>
                {{$shippedItem->itemName}}
            </button>
        </h2>
        <div id="collapse{{$shippedItem->itemNumber}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <form action="/processes/{{$shippedItem->itemNumber}}" method="post" class="w-25 mx-auto">
                    @csrf
                    <div class="w-100 d-flex justify-content-center align-items-center">
                        <div class="btn-group-vertical my-3 w-100" role="group" aria-label="Basic checkbox toggle button group">
                            @foreach($transportationEvents as $transportationEvent)
                            <input type="checkbox" class="btn-check" id="btncheck{{$shippedItem->itemNumber}}{{$transportationEvent->scheduleNumber}}" autocomplete="off" name="transportationEvent{{$transportationEvent->scheduleNumber}}" value="{{$transportationEvent->scheduleNumber}}">
                            <label class="btn btn-outline-primary" for="btncheck{{$shippedItem->itemNumber}}{{$transportationEvent->scheduleNumber}}"><strong>{{$transportationEvent->type}}</strong>
                                <hr> <em>{{$transportationEvent->deliveryRoute}}</em>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <select class="form-select" id="floatingSelect{{$shippedItem->itemNumber}}" name="retailCenter{{$shippedItem->itemNumber}}" aria-label="Retail center">
                        <option value="" selected>Select retail center...</option>
                        @foreach($retailCenters as $retailCenter)
                        <option id="option{{$shippedItem->itemNumber}}{{$retailCenter->uniqueID}}" value="{{$retailCenter->uniqueID}}">{{$retailCenter->address}}</option>
                        @endforeach

                    </select>
                    <div class="d-grid mt-3">
                        <input type="submit" value="confirm" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    (async () => {
        const response = await fetch('/processes/checked-items')
        let json = await response.json()
        json.forEach((shipping) => {
            // console.log(shipping);
            let el = document.querySelector(`#btncheck${shipping.itemNumber}${shipping.scheduleNumber}`);
            if (el != null && el != 'undefined') {
                document.querySelector(`#btncheck${shipping.itemNumber}${shipping.scheduleNumber}`).checked = true;
            }
        })

    })();

    (async () => {
        const response = await fetch('/processes/selected-items')
        let json = await response.json()

        json.forEach((shippedItem) => {
            if (shippedItem.uniqueID !== null) {
                let el = document.querySelector(`#option${shippedItem.itemNumber}${shippedItem.uniqueID}`);
                if (el != null && el != 'undefined') {
                    document.querySelector(`#option${shippedItem.itemNumber}${shippedItem.uniqueID}`).selected = true;
                }
                // console.log(shippedItem.itemNumber)
            }
            // console.log(shippedItem.uniqueID)
        })
    })();


    $('#searchResults').hide();
    async function searchItem() {
        let searchValue = document.querySelector('#search').value;
        if (searchValue != "") {
            let res = await fetch('/processes', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    data: searchValue
                })
            });

            let json = await res.json();

            $('#searchResults').empty();
            $('#searchResults').show();
            json.forEach((item) => {
                $('#searchResults').append(`<a href="/processes?search=${item.itemNumber}" class="list-group-item list-group-item-action d-flex justify-content-between"><p>${item.itemName}</p><p style="color:#999">${item.itemNumber}</p></a>`);
            });
        } else {
            $('#searchResults').hide();
        }

    }

    async function searchKey() {
        $searchValue = $('#search').val();
        window.location.href = `?search=${$searchValue}`;
    }
</script>
@endsection