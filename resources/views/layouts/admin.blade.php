@extends('adminlte::page')

@section('title', $title ?? 'Panel de Control')

@section('content_header')
    <h1>@yield('page-title', 'Dashboard')</h1>
@stop

@section('content')
    @yield('content')
@stop