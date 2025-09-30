@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Panel Principal')

@section('content')
<div class="row">
    <div class="col-md-4">
        <a href="{{ route('propiedades.index') }}">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Propiedades</h3>
                <p>Gestión de inmuebles</p>
            </div>
            <div class="icon">
                <i class="fas fa-home"></i>
            </div>
            <span class="small-box-footer">Próximamente <i class="fas fa-arrow-circle-right"></i></span>
        </div>
    </div>

    <div class="col-md-4">
    <a href="{{ route('usuarios.index') }}">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Usuarios</h3>
                <p>Gestión de propietarios e inquilinos</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <span class="small-box-footer">Ir al módulo <i class="fas fa-arrow-circle-right"></i></span>
        </div>
    </a>
</div>


    <div class="col-md-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Mapa</h3>
                <p>Visualización geográfica</p>
            </div>
            <div class="icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <span class="small-box-footer">Próximamente <i class="fas fa-arrow-circle-right"></i></span>
        </div>
    </div>
</div>
@endsection