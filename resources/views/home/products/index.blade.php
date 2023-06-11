@extends('home.index')

@section('sections')

    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">Productos</h1>
            <p class="lead my-3">Lista de productos disponibles para la venta</p>
        </div>
    </div>


@if( Session::has('mensaje') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if( Session::has('mensaje_error') )
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('mensaje_error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      @foreach($products as $product)
            <div class="col">
            <div class="card shadow-sm">
                <img class="bd-placeholder-img card-img-top" width="100%" height="225" 
                src="{{asset('storage').'/'.$product->imagen}}" role="img"></img>
                <div class="card-body">
                <h5 class="card-title">{{ $product->nombres_productos }}</h5>
                <p class="card-text">{{ $product->descripcion }}</p>
                        <p class="card-text">${{ $product->valor }}</p>
               <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">

                    @if($product->cantidad_stock != null)
                            <form action="{{ url('home/shoppingcart') }}" method='POST'>

                                @csrf
                                <input type="hidden" name="id_productos" value='{{ $product->id_productos }}' >
                                <input type="number" class="form-control" name='quantity' max='{{ $product->cantidad_stock }}' min='1' value=1>
                                <input type="submit" class="btn btn-primary  d-block mx-auto" value="Agregar">
                                
                            </form>
                            @else
                                <p class='text-danger'>Producto NO disponible</p>
                            @endif
                    </div>
                </div>
                </div>
            </div>
            </div>
        @endforeach
      </div>
      
        <div class="d-flex justify-content-end">
            {!! $products->links() !!}
        </div>
    </div>
  </div>


@endsection