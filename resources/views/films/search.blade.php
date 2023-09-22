<x-app-layout>
    <x-slot name="header">
        @include('layouts.navbar')
    </x-slot>

    <div class="my-5 px-20">
        <form action="{{ route('search') }}" method="get">
            <div class="flex gap-3">
                <input class="flex-grow" type="text" name="search" id="search" placeholder="{{ __('Input information') }}">
                <select name="remain" id="remain">
                    <option value="1">{{ __("Remain") }}</option>
                    <option value="0">{{ __("Not remain") }}</option>
                </select>
                <button type="submit" class="w-24 h-12 rounded-md bg-slate-700 text-white hover:bg-slate-300 hover:text-gray-700 transition-all">
                    {{ __("Search") }}
                </button>
            </div>
        </form>
    </div>

    <div class="my-5 px-20">
        <div class="flex gap-5 flex-wrap justify-center">
            @foreach ($films as $film)
                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="{{ route('films.detail', ['film' => $film]) }}" class="film">
                        @foreach ($film->medias as $media)
                            @if($media->type == "avatar")
                                <img class="hover:grow hover:shadow-lg bg-cover m-auto h-auto w-full p-2" src="{{ $media->link }}"/>
                            @endif
                        @endforeach
                    </a>
                    <a href="{{ route('films.booking', ['film' => $film]) }}">
                        <div class="pt-3 flex items-center justify-between">
                            <p class="p-2">{{ $film->title }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="d-felx justify-content-center">
            {{ $films->links() }}
        </div> 
    </div>

    @include('layouts.footer')
</x-app-layout>
