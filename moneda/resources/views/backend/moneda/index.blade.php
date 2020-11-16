@extends('backend.base'); 

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')

    @if(session()->has('op'))
        <div class="aler alert-success" roler="alert">
            Operacion: {{ session()->get('op')}}. id: {{ session()->get('id') }}. resultado: {{ session()->get('resultado') }}
        </div>
    @endif
    
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url('backend/moneda/create') }}" class="btn btn-primary">Create coin</a>
            </div>
        </div>
    </div>
</div>

<table class="table table-hover">
              <thead>
                <th scope="col">id #</th>
                <th scope="col">name</th>
                <th scope="col">symbol</th>
                <th scope="col">country</th>
                <th scope="col">value (€)</th>
                <th scope="col">date</th>
                
                <th scope="col">show</th>
                <th scope="col">edit</th>
                <th scope="col">delete</th>
            </thead>
            @foreach ($monedas as $moneda)
            <tbody>
                <tr>
                    <th scope="row">{{ $moneda->id}}</th>
                    <td>{{ $moneda->name }}</td>
                    <td>{{ $moneda->symbol}}</td>
                    <td>{{ $moneda->country }}</td>
                    <td>{{ $moneda->value }}</td>
                    <td>{{ date("d-m-Y", strtotime($moneda['initialdate'])) }}</td>
                    
                    
                    <td><a href="{{ url('backend/moneda/' . $moneda['id']) }}">show</a></td>
                    <td><a href="{{ url('backend/moneda/' . $moneda->id . '/edit') }}">edit</a></td>
                    <td><a data-id="{{ $moneda->id }}" data-name="{{ $moneda->name }}" class="enlaceBorrar" href="#">delete</a></td>
                    
                    <form id="formDelete" action="{{ url('backend/moneda') }}" method="post">
                        @method('delete')
                        @csrf
                    </form>
                </tr>
            </tbody>
            @endforeach
        </table>


@endsection





