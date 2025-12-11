@php
    // Define los tipos de mensaje que vamos a buscar
    $messageType = null;
    $message = null;

    if (session()->has('success')) {
        $messageType = 'success';
        $message = session('success');
        $bgColor = 'bg-green-500';
        $iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'; // Checkmark
    } elseif (session()->has('error') || session()->has('danger')) {
        $messageType = 'error';
        $message = session('error') ?? session('danger'); // Soporta 'error' o 'danger'
        $bgColor = 'bg-red-600';
        $iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'; // Exclamation circle
    } elseif (session()->has('warning')) {
        $messageType = 'warning';
        $message = session('warning');
        $bgColor = 'bg-yellow-500';
        $iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 21a9 9 0 100-18 9 9 0 000 18z" />'; // Exclamation triangle
    }
@endphp

{{-- Solo renderiza si se encontró algún tipo de mensaje flash --}}
@if ($messageType)
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-full"
        class="fixed top-5 right-5 z-50 p-4 rounded-lg shadow-xl text-white flex items-center space-x-3 {{ $bgColor }}"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            {!! $iconPath !!}
        </svg>

        <p class="font-semibold text-sm">
            {{ $message }}
        </p>

        <button @click="show = false" class="text-white hover:opacity-75 ml-2">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif