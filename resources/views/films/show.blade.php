<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Film') }}
        </h2>
    </x-slot>

    <div class="bg-white w-full border-gray-500 rounded-lg mt-5 py-10 px-5 gap-5 grid grid-cols-3">
        <div class="avatar px-4">
            @foreach ($film->medias as $media)
                @if($media->type == "avatar")
                    <img class="object-cover bg-cover m-auto h-80 w-auto" src="{{ $media->link }}"/>
                @endif
            @endforeach
            <div class="action mx-20 my-5 py-5 px-5 gap-5">
                <div class="flex gap-3">
                    <a href="{{ route('films.edit', ['film' => $film]) }}">
                        <button class="w-24 h-12 rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                            {{ __("Edit") }}
                        </button>
                    </a>
                    <a href="{{ route('films.index') }}">
                        <button class="w-24 h-12 rounded-md bg-slate-700 text-white hover:bg-slate-300 hover:text-gray-700 transition-all">
                            {{ __("Back") }}
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="info col-span-2 px-4">
            <div class="flex gap-5 py-2 px-2">
            <p class="uppercase font-bold">{{ __('Title') }} : </p>
                <p>{{ $film->title }}</p>
            </div>
            <div class="flex gap-5 py-2 px-2">
                <p class="uppercase font-bold">{{ __('Director') }} : </p>
                <p>{{ $film->director }}</p>
            </div>
            <div class="flex gap-5 py-2 px-2">
                <p class="uppercase font-bold">{{ __('Release date') }} : </p>
                <p>{{ $film->release_date }}</p>
            </div>
            <div class="flex gap-5 py-2 px-2">
                <p class="uppercase font-bold">{{ __('Duration') }} : </p>
                <p>{{ $film->duration }} {{ __('minitues') }}</p>
            </div>
            <div class="flex gap-5 py-2 px-2">
                <p class="uppercase font-bold">{{ __('Genres') }} : </p>
                @foreach ($film->genres as $genre)
                    <p>{{ $genre->name }}</p>
                @endforeach
            </div>
            <div class="flex gap-2 py-2 px-2 grid grid-rows-1">
                <p class="uppercase font-bold">{{ __('Description') }} : </p>
                <p class="max-w-prose">{{ $film->description }}</p>
            </div>
        </div>
        <div class="media mx-20 py-5 px-5 gap-5 col-span-3">
           <div class="trailer flex py- px-20 grid grid-rows-1">
                <p class="uppercase font-bold py-2 px-5">{{ __('Trailer') }} : </p>
                <div class="embed-responsive embed-responsive-21by9 relative w-full overflow-hidden">
                    @foreach ($film->medias as $media)
                        @if($media->type == "trailer")
                            <iframe width="600" height="400" src="{{ $media->link }}"
                                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                                gyroscope; picture-in-picture; web-share" allowfullscreen>
                            </iframe>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="gallery flex gap-5 mt-10 py-5 px-20 grid grid-rows-1">
                <p class="uppercase font-bold">{{ __('Images gallery') }} : </p>
                <div class="images px-4 grid grid-cols-2 gap-4">
                    @foreach ($film->medias as $media)
                        @if($media->type == "image")
                            <img class="object-cover bg-cover m-auto h-80 w-auto" src="{{ $media->link }}"/>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>


    </div>
</x-admin-layout>
