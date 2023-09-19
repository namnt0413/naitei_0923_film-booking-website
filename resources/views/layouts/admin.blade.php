<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-100 flex">
            <div class="min-h-screen bg-white w-fit border-r-2 flex flex-col sidebar relative">
                <div class="cursor-pointer sidebar-toggle w-10 h-10 rounded-full absolute -right-5 top-2.5 flex items-center justify-center bg-white border">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
                <a href="">
                    <div class="flex gap-3 items-center max-w-full px-8 py-5 hover:bg-slate-300 hover:text-indigo-500 transition-all ease-linear cursor-pointer text-2xl">
                        <i class="fa-solid fa-house"></i>
                        <h2 class="content">{{ __("Admin page") }}</h2>
                    </div>
                </a>
                <a href="{{ route('films.index') }}">
                    <div class="flex gap-3 items-center max-w-full px-8 py-5 hover:bg-slate-300 hover:text-indigo-500 transition-all ease-linear cursor-pointer text-lg">
                        <i class="fa-solid fa-film"></i>
                        <p class="content">{{ __("Film") }}</p>
                    </div>
                </a>
                <a href="{{ route('rooms.index') }}">
                    <div class="flex gap-3 items-center max-w-full px-8 py-5 hover:bg-slate-300 hover:text-indigo-500 transition-all ease-linear cursor-pointer text-lg">
                        <i class="fa-solid fa-door-open"></i>
                        <p class="content">{{ __("Room") }}</p>
                    </div>
                </a>
                <a href="{{ route('tickets.index') }}">
                    <div class="flex gap-3 items-center max-w-full px-8 py-5 hover:bg-slate-300 hover:text-indigo-500 transition-all ease-linear cursor-pointer text-lg">
                        <i class="fa-solid fa-ticket"></i>
                        <p class="content">{{ __("Ticket") }}</p>
                    </div>
                </a>
                <a href="{{ route('screenings.index') }}">
                    <div class="flex gap-3 items-center max-w-full px-8 py-5 hover:bg-slate-300 hover:text-indigo-500 transition-all ease-linear cursor-pointer text-lg">
                        <i class="fa-solid fa-calendar-days"></i>
                        <p class="content">{{ __("Screening") }}</p>
                    </div>
                </a>
                <a href="{{ route('seats.index') }}">
                    <div class="flex gap-3 items-center max-w-full px-8 py-5 hover:bg-slate-300 hover:text-indigo-500 transition-all ease-linear cursor-pointer text-lg">
                        <i class="fas fa-chair"></i>
                        <p class="content">{{ __("Seat") }}</p>
                    </div>
                </a>
            </div>
            <div class="grow px-5">
                @include('layouts.navigation')

                <!-- Page Heading -->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>

        </div>

        <script src="{{ asset('js/adminLayout.js') }}">

        </script>
    </body>
</html>
