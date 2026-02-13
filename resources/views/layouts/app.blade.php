<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="flex font-sans antialiased bg-neutral-100">


        <div class="w-24 py-4  ">
            @include('layouts.sidebar')
        </div>
        <div class="flex-1 px-8">            
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-lg">
                    <div class="max-w-7xl  py-6 px-4 sm:px-6 lg:px-8 ">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main >
                {{ $slot }}
            </main>
        </div>

    @livewireScripts
    </body>
    
</html>




