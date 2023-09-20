<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit ticket') }}
        </h2>
    </x-slot>

    <div class="w-full rounded-lg bg-white p-5 mt-5">
        <form action="{{ route('tickets.update', ['ticket' => $ticket]) }}" method="post">
            @csrf
            @method("put")
            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="price">{{ __("Price") }}</label>
                <input type="number" step="0.01" placeholder="{{ __('Price') }}" name="price" id="price" value="{{ $ticket->price }}">
            </div>
            <button type="submit" class="w-24 h-12 text-lg rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                {{ __("Edit") }}
            </button>
        </form>
    </div>
</x-admin-layout>
