@props(['nombre_tabla'])

<div class="w-full">

    <div
        class="bg-white dark:bg-zinc-800 border border-neutral-200 dark:border-neutral-700 rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-neutral-200 dark:border-neutral-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 id="tableTitle" class="text-xl font-semibold text-neutral-900 dark:text-white">
                        {{ $nombre_tabla ?? 'Plantilla table' }}</h2>
                    <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                        Gestiona los datos de {{ $nombre_tabla }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    {{ $resetSearch ?? '' }}
                    
                    {{ $createUrl ?? '' }}
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-neutral-50 dark:bg-zinc-800/50 border-b border-neutral-200 dark:border-neutral-700">
            {{ $searchArea ?? '' }}
        </div>

        <div class="overflow-x-auto">
            {{ $slot }}
        </div>

    </div>
</div>
