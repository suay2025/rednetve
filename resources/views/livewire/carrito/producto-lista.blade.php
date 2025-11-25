<div >
  <div class="row">
    <div class="col-md-12 mx-3">
      <h1 class="color_menu text-center">Productos similares</h1>    
    </div>  
  </div>
      
  <div class="row">
    <div class="col-md-12">
      <div class="row mx-3">
      @foreach($products as $pro)
        @if( $id_pro != $pro->id )
          <div class="col-md-4 my-2">              
            <div class="card card-p border-secondary"> 
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12">
                    <img  src="{{$ruta.$pro->image_path1}}" class="card-img shadow rounded mx-auto d-blod img-fluid">
                  </div>
                </div>
                <div class="row contenedor overflow-hidden">
                    <div class="col-md-12">
                      <div class="text-justify">
                        <span class="color_menu fw-bold">{{$pro->name}}
                        </span>
                        <br>
                        <span class="color_v">Precio: {{$pro->price1}} $.</span>
                      </div>
                    </div>                          
                  </div>
                  <div class="row my-4">
                    <div class="col-md-12">
                      <a href="/previoproductcart/{{$pro->sucursal_id}}/{{$pro->id}}" class="text-decoration-none " style="text-decoration: none">
                      <button class="btn_buy">Comprar ahora</button>
                      </a>
                    </div>
                  </div>
              </div>
                
              <div class="card-footer rating"> 
                <i class="bi bi-star-fill star star{{$pro->id}}"  nro="1" s_id = "{{ $pro->id }}" id="{{$pro->id}}-1" ></i>
                <i class="bi bi-star-fill star star{{$pro->id}}"  nro="2" s_id = "{{ $pro->id }}" id="{{$pro->id}}-2" ></i>
                <i class="bi bi-star-fill star star{{$pro->id}}"  nro="3" s_id = "{{ $pro->id }}" id="{{$pro->id}}-3" ></i>
                <i class="bi bi-star-fill star star{{$pro->id}}"  nro="4" s_id = "{{ $pro->id }}" id="{{$pro->id}}-4" ></i>
                <i class="bi bi-star-fill star star{{$pro->id}}"  nro="5" s_id = "{{ $pro->id }}" id="{{$pro->id}}-5" ></i>
              </div>                
            </div>              
          </div>
        @endif
      @endforeach 

        <!--Footer-->
        <div class="card-footer mr-auto">
          {{$products->links() }}
        </div>
        <!--End footer-->          
      </div>        
    </div>
  </div>



</div>  

@if( $count > 0 )
@else
  @include('sucursal-info')
@endif

    
