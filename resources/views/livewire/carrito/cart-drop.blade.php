<div class="dropdown-content-cart-drop">                                    
    <ul>
    @if(count(\Cart::getContent()) > 0)
        @foreach(\Cart::getContent() as $item)
            <li class="list-group-item">
                <div class="row w-100">
                    <div class="col-md-3">
                        <img src="{{ $item->attributes->image }}"
                            style="width: 50px; height: 50px;"
                        >
                    </div>
                    <div class="col-md-5">
                        <b>{{$item->name}}</b>
                        <br><small>Cant: {{$item->quantity}}</small>
                    </div>
                    <div class="col-md-4">
                        <p>{{ $this->getPrice( \Cart::get($item->id)->getPriceSum(), $item->attributes->comercio_id ) }} {{$currencyValue}}</p>
                    </div>
                    <br><br>
                </div>
            </li>
        @endforeach
        <li class="list-group-item">
            <div class="row">
                <div class="col-lg-10">
                    <b>Total: </b>{{$this->getPrice( \Cart::getTotal() ) }} {{ $currencyValue }} 
                </div>
                <div class="col-lg-2">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row d-flex" style="margin: 0px;">
                <!-- <a class="btn btn-app mx-auto" href="{{ route('cart') }}"> -->
                <a class="btn btn-app mx-auto" href="/goCart">
                    VER CARRITO
                </a>
            </div>
        </li>
        <br>
        
    @else
        <li class="list-group-item">Tu carrito esta vacío</li>
    @endif
    </ul>
</div>