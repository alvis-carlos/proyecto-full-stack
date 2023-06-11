@extends('home.index')

@section('sections')

<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">Facturas</h1>
            <p class="lead my-3">Aqui encontraras tu lista de facturas pagadas</p>
        </div>
</div>

<br>

<div class="container container-lg">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Fecha</th>
                <th>Descargar</th>
            </tr>
        </thead>
        <tbody>

        @foreach($factures as $facture)
            <tr>    
                <td>{{ $facture->id }}</td>
                <td>{{ $facture->status }}</td>
                <td>{{ $facture->created_at }}</td>
                <td> <a  target="_blank" href="{{ url('home/facture/pdf/'.$facture->id) }}" class="btn btn-success">Descargar</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {!! $factures->links() !!}
    </div>
</div>
@endsection