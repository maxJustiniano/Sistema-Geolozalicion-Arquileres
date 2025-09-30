@extends('layouts.admin')

@section('title', 'Listado de Propiedades')
@section('page-title', 'Propiedades registradas')

@section('content')
<div class="row">
    <div class="col-md-12">
        <x-datatable 
            id="propiedades-table" 
            title="Propiedades" 
            :columns="['ID', 'Título', 'Dirección', 'Estado']"
        >
            @foreach ($propiedades as $propiedad)
                <tr>
                    <td>{{ $propiedad->id }}</td>
                    <td>{{ $propiedad->titulo }}</td>
                    <td>{{ $propiedad->direccion }}</td>
                    <td>{{ $propiedad->estado }}</td>
                </tr>
            @endforeach
        </x-datatable>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endpush