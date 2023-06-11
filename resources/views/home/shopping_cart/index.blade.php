@extends('home.index')

@section('sections')


<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">Carrito de compras</h1>
            <p class="lead my-3">Aqui podras ver los productos agregados al carrito de compras</p>
        </div>
</div>

<h2 class='text-center'>Lista de productos</h2>
<br>

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

<div class="container container-lg">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $products as $product )
                <tr>
                <td><img  width='80' src="{{asset('storage').'/'.$product->imagen}}" alt="{{$product->id_productos}}"></td>
                    <td>{{ $product->nombres_productos }}</td>
                    <td>
                        <form action="{{ url('home/shoppingcart/'.$product->id) }}"  method="post">
                            @csrf
                            {{ method_field('PATCH') }}
                            <input type="number" min=1 max='{{ $product->cantidad_stock }}' name="quantity" id="quantity" value='{{ $product->quantity }}'>
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </form>
                    </td>
                    <td>{{ $product->precio }}</td>
                    <td>{{ $product->total }}</td>
                    <td>
                        <form action="{{ url('home/shoppingcart/'.$product->id) }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tr>
                <td>Total: </td>
                @if( !$products->isEmpty() )
                <td>{{ $total }}</td>
                @else
                    <td>0</td>
                @endif
            </tr>
        </table>

        @if(Auth::guard()->check())
            @if( !$products->isEmpty() )
            <a href="{{ url('paypal/play') }}" class="btn btn-success" >Pagar</a>
            @endif
        @else
            <p><a href='{{ url("/login") }}'>Inicie session</a> para terminar el proceso de pago </p>
        @endif

</div>

<br><br>

@endsection