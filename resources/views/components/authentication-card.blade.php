{{-- @props(['width' => 'sm:max-w-md'])
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white dark:bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full {{$width}} mt-6 px-6 py-4 bg-purple-200 dark:bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div> --}}
@props(['width' => 'sm:max-w-md', 'logoPath' => 'img/icono.png'])

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white dark:bg-gray-100">
    <div>
        <img src="{{ asset($logoPath) }}" alt="Logo" style="max-width: 100px;">
    </div>

    <div class="w-full {{$width}} mt-6 px-6 py-4 bg-purple-200 dark:bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
