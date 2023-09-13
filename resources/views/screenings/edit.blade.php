<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit screening') }}
        </h2>
    </x-slot>

    <div class="w-full rounded-lg bg-white p-5 mt-5">
        <form action="{{ route('screenings.update', ['screening' => $screening]) }}" method="post">
            @csrf
            @method("put")
            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="start">{{ __("Start time") }}</label>
                <input type="text" placeholder="Y-m-d H:i:s" name="start_time" id="start" class="time" value="{{ $screening->start_time }}">
            </div>

            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="end">{{ __("End time") }}</label>
                <input type="text" placeholder="Y-m-d H:i:s" name="end_time" id="end" class="time" value="{{ $screening->end_time }}">
            </div>

            <button type="submit" class="w-24 h-12 text-lg rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                {{ __("Edit") }}
            </button>
        </form>
    </div>
</x-admin-layout>
