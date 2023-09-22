<x-app-layout>

    <x-slot name="header">
        @include('layouts.navbar')
    </x-slot>

    <div class="bg-white w-full border-gray-500 rounded-lg mt-5 py-10 px-5 gap-5 grid grid-cols-3">
        <div class="avatar px-4">
            <img class="object-cover bg-cover float-right mr-8 h-96 w-auto" src="{{ $film->medias->where('type', 'avatar')->first()->link }}"/>
        </div>
        <div class="info col-span-2 px-4">
            <div class="flex gap-5 py-3 px-2">
                <p class="uppercase font-bold text-2xl">{{ $film->title }}</p>
            </div>
            <div class="flex gap-5 py-3 px-2">
                <p class="uppercase font-bold">{{ __('Director') }} : </p>
                <p>{{ $film->director }}</p>
            </div>
            <div class="flex gap-5 py-3 px-2">
                <p class="uppercase font-bold">{{ __('Release date') }} : </p>
                <p>{{ $film->release_date }}</p>
            </div>
            <div class="flex gap-5 py-3 px-2">
                <p class="uppercase font-bold">{{ __('Duration') }} : </p>
                <p>{{ $film->duration }} {{ __('minitues') }}</p>
            </div>
            <div class="flex gap-5 py-3 px-2">
                <p class="uppercase font-bold">{{ __('Genres') }} : </p>
                @foreach ($film->genres as $genre)
                    <p>{{ $genre->name }}</p>
                @endforeach
            </div>
            <div class="flex gap-2 py-4 px-2 grid grid-rows-1">
                <a href="{{ route('films.booking', ['film' => $film]) }}" class="float-right bg-transparent hover:bg-orange-500 text-orange-700 uppercase font-bold hover:text-white
                    py-4 px-4 border border-orange-500 hover:border-transparent rounded w-40 flex gap-3 justify-center">
                    {{ __('Book ticket') }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="description mx-20 py-5 px-5 gap-5 col-span-3">
            <div class="trailer flex py- px-20 grid grid-rows-1">
                 <div class="topic mb-4">
                     <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl" href="#">
                         {{ __('Description') }}
                     </a>
                     <div class="underline block w-16 h-0.5 mt-2 bg-orange-500"></div>
                 </div>
                 <div class="embed-responsive embed-responsive-21by9 relative w-full overflow-hidden">
                    <p>{{ $film->description }}</p>
                 </div>
             </div>
        </div>
        <div class="media mx-20 py-5 px-5 gap-5 col-span-3">
           <div class="trailer flex py- px-20 grid grid-rows-1">
                <div class="topic mb-4">
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl" href="#">
                        {{ __('Trailer') }}
                    </a>
                    <div class="underline block w-16 h-0.5 mt-2 bg-orange-500"></div>
                </div>
                <div class="embed-responsive embed-responsive-21by9 relative w-full overflow-hidden">
                    <iframe width="600" height="400" src="{{ $film->medias->where('type', 'trailer')->first()->link }}"
                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                        gyroscope; picture-in-picture; web-share" allowfullscreen>
                    </iframe>
                </div>
            </div>
            <div class="gallery flex gap-5 mt-10 py-5 px-20 grid grid-rows-1">
                <div class="topic mb-1">
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl" href="#">
                        {{ __('Images gallery') }}
                    </a>
                    <div class="underline block w-16 h-0.5 mt-2 bg-orange-500"></div>
                </div>
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

    @include('layouts.footer')

</x-app-layout>
