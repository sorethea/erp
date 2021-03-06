@props([
    'active' => false,
    'badge',
    'icon',
    'shouldOpenUrlInNewTab',
    'url',
])

<li class="filament-sidebar-item">
    <a
        href="{{ $url }}"
        {!! $shouldOpenUrlInNewTab ? 'target="_blank"' : '' !!}
        x-on:click="window.matchMedia(`(max-width: 1024px)`).matches && $store.sidebar.close()"
        @class([
            'flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition',
            'hover:bg-gray-500/5 focus:bg-gray-500/5' => ! $active,
            'dark:text-gray-300 dark:hover:bg-gray-700' => (! $active) && config('filament.dark_mode'),
            'bg-primary-500 text-white' => $active,
        ])
    >
        <x-dynamic-component :component="$icon" class="h-5 w-5" />

        <div class="flex flex-1"
            @if (config('filament.layout.sidebar.is_collapsible_on_desktop'))
                x-data="{}"
                x-show="$store.sidebar.isOpen"
            @endif
        >
            <span>
                {{ $slot }}
            </span>

            @if (filled($badge))
                <span
                    @class([
                        'inline-flex items-center justify-center ml-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal',
                        'text-primary-700 bg-primary-500/20' => ! $active,
                        'text-white bg-white/20' => $active,
                        'dark:text-primary-500' => (! $active) && config('filament.dark_mode'),
                    ])
                >
                    {{ $badge }}
                </span>
            @endif
        </div>
    </a>
</li>
