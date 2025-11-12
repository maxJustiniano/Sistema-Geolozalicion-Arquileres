<x-layouts.app :title="__('Tipos de Usuarios')">
    <main class="py-6 px-4 sm:px-6 lg:px-8 w-full h-full">
        <x-form :action='{{ $action }}' :method='{{ $method }}' 
            :submitText='{{ $submitText }}' :routeIndex='{{ $routeIndex }}'>

            <label for="">Nombre del Rol</label>
            <input type="text" name="" id="" value="{{$rol->}}">

        </x-form>
    </main>
</x-layouts.app>
