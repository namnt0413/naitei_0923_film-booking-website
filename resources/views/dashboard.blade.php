<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mt-5 p-5 bg-white rounded-md">
        <div class="flex items-center justify-around">
            <div class="w-64 h-36 bg-sky-500 text-white p-5 flex flex-col justify-around rounded-md">
                <p class="text-xl">{{ __("Total films") }}</p>
                <p class="text-4xl">{{ $totalFilms }}</p>
            </div>
            <div class="w-64 h-36 bg-indigo-500 text-white p-5 flex flex-col justify-around rounded-md">
                <p class="text-xl">{{ __("Total tickets") }}</p>
                <p class="text-4xl">{{ $totalTickets }}</p>
            </div>
            <div class="w-64 h-36 bg-fuchsia-500 text-white p-5 flex flex-col justify-around rounded-md">
                <p class="text-xl">{{ __("Sum price") }}</p>
                <p class="text-4xl">{{ number_format($sumPrice) }}</p>
            </div>
        </div>

        <div class="mt-5 flex items-center justify-around">
            <div class="w-96 bg-green-500 text-white p-5 rounded-md">
                <p class="text-xl mb-5">{{ __("Most booking user") }}</p>
                <p class="text-2xl">{{ $mostBookingUser->getFullNameAttribute() }}</p>
                <p class="text-2xl">{{ $mostBookingUser->username }}</p>
                <p class="text-2xl">{{ $mostBookingUser->email }}</p>
            </div>
            <div class="w-96 bg-cyan-500 text-white p-5 rounded-md">
                <p class="text-xl mb-5">{{ __("Most popular film") }}</p>
                <p class="text-2xl">{{ $mostPopularFilm->title }}</p>
                <p class="text-2xl">{{ $mostPopularFilm->director }}</p>
            </div>
        </div>
    </div>
</x-admin-layout>
