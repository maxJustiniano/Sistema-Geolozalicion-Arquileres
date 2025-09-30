@extends('layouts.admin')

@section('title', 'Listado de Usuarios')
@section('page-title', 'Usuarios del sistema')

@section('content')
<div class="row">
    <div class="col-md-12">
        <x-datatable 
            id="usuarios-table" 
            title="Usuarios" 
            :columns="['ID', 'Nombre', 'Email']"
        >
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
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