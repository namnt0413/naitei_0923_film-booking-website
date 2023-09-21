<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail user') }}
        </h2>
    </x-slot>

    <div class="bg-white w-full border-gray-500 rounded-lg mt-5 flex flex-col py-5 px-5 gap-5">
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Username") }}: </p>
            <p>{{ $user->username }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Full name") }}: </p>
            <p>{{ $user->getFullNameAttribute() }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Email") }}: </p>
            <p>{{ $user->email }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Role") }}: </p>
            <p>{{ $user->role->name }}</p>
        </div>        
        <div class="flex gap-3">
            <a href="{{ route('users.index') }}">
                <button class="w-24 h-12 rounded-md bg-slate-700 text-white hover:bg-slate-300 hover:text-gray-700 transition-all">
                    {{ __("Back") }}
                </button>
            </a>
        </div>
    </div>
</x-admin-layout>
