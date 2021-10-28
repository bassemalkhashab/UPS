@extends('includes.master')


@section('content')

<div class="jumbotron p-3" style="background-color:lightgrey;">
    <div class="container">
        <h1 class="display-3">Hello, {{$name}}!</h1>
        <p>This is a template for a simple UPS information system website where you can track shipped items routing to retail centers. It includes add, remove, and update for shipped items, transportation events, and retail centers .</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
    </div>
</div>

<div class="body d-inline-flex">
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white shadow p-3 mb-5 bg-white rounded"" style=" width: 380px;">
        <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
            <svg class="bi me-2" width="30" height="24">
                <use xlink:href="#bootstrap" />
            </svg>
            <span class="fs-5 fw-semibold">Retail centers</span>
        </a>
        <div class="list-group list-group-flush border-bottom scrollarea">
            @foreach($retailCenters as $retailCenter)
            <form action="/filter/{{$retailCenter-> uniqueID}}" method="get" style="border: transparent;">
            @csrf
                <input type="hidden" /> 
                @if($retailCenter->uniqueID == $requestedRetailCenter)
                <a href="#" class="list-group-item list-group-item-action active py-3 lh-tight rounded" onclick="this.parentNode.submit()" style="border: none;">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        
                            <strong class="mb-1">{{$retailCenter->address}}</strong>
                            <small>Tues</small>
                        </div>
                        <div class="col-10 mb-1 small">{{$retailCenter->type}}</div>
                    </a>
                    @else
                    <a href="#" class="list-group-item list-group-item-action py-3 lh-tight" onclick="this.parentNode.submit()" style="border: none;">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                   
                        <strong class="mb-1">{{$retailCenter->address}}</strong>
                        <small class="text-muted">Tues</small>
                    </div>
                    <div class="col-10 mb-1 small">{{$retailCenter->type}}</div>
                </a>
                @endif
            </form>
            @endforeach

        </div>
    </div>

    <div>
        <h2 class="m-5">
            Dashboard
        </h2>

        <div class="card-group p-3">
            @foreach($shippedItems as $shippedItem)
            <div class="card m-3 border-0" style="flex:none;">
                <img class="card-img-top m-3" src="/storage/{{$shippedItem['image']}}" alt="Card image cap" style="width: 200px; height:200px; object-fit:contain;">
                <div class="card-body" style="width: 230px;">
                    <h5 class="card-title">{{$shippedItem['itemName']}}</h5>
                    <p class="card-text">
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item disabled">  Transportation events</li>
                        @if(isset($shippedItem['transportationEvents']))
                        @foreach($shippedItem['transportationEvents'] as $transporatationEvent)
                        <li class="list-group-item">{{$transporatationEvent['type']}} <em class="list-group-item disabled border-0">({{$transporatationEvent['deliveryRoute']}})</em></li>
                        @endforeach
                        @else
                        <em class="list-group-item disabled border-0">No transportation events to show</em>
                        @endif
                    </ul>
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><em>Final delivery date: </em> <strong>{{$shippedItem['finalDeliveryDate']}}</strong></small>
                </div>
            </div>
            @endforeach

        </div>
        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link"  href="?page={{$previous}}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            @for($i=1; $i < $lastPage+1; $i++)
            <li class="page-item"><a class="page-link" href="?page={{$i}}">{{$i}}</a></li>
            @endfor
            <li class="page-item">
              <a class="page-link" href="?page={{$next}}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>

@endsection