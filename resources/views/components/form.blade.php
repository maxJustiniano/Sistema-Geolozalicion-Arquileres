@props([
    'action',
    'method',
    'submitText',
    'routeIndex'
])

<form action="{{ $action }}" method="POST">>
    @csrf
    @method('{{$method}}')

    {{$slot}}

    <button type="submit">
        {{$submitText}}
    </button>
    <a href="{{ route($routeIndex) }}">Cancelar</a>
</form>
