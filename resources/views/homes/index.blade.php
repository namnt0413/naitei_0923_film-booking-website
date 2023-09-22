<x-app-layout>

    <x-slot name="header">
        @include('layouts.navbar')
    </x-slot>

    <div class="content bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">

        {{-- Slider --}}
        <section class="carousel relative mx-auto w-full">
            <div class="carousel-inner relative overflow-hidden w-full">
                <!--Slide 1-->
                <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
                <div class="carousel-item absolute opacity-0" style="height:60vh;">
                    <div class="slider">
                        <img src="https://cdn.galaxycine.vn/media/2023/9/8/2048x682_1694155905949.jpg" class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right">
                    </div>
                </div>
                <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

                <!--Slide 2-->
                <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
                <div class="carousel-item absolute opacity-0 bg-cover bg-right" style="height:60vh;">
                    <div class="slider">
                        <img src="https://www.venuscinema.vn/uploaded/slideshow/banner-ke-an-danh.jpg" class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right">
                    </div>
                </div>
                <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

                <!--Slide 3-->
                <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
                <div class="carousel-item absolute opacity-0" style="height:60vh;">
                    <div class="slider">
                        <img src="https://cdn.galaxycine.vn/media/2023/9/14/dont-buy-the-seller-5_1694702932807.jpg"
                            class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right">
                    </div>
                </div>
                <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

                <!-- Add additional indicators for each slide-->
                <ol class="carousel-indicators">
                    <li class="inline-block mr-3">
                        <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                    </li>
                    <li class="inline-block mr-3">
                        <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                    </li>
                    <li class="inline-block mr-3">
                        <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                    </li>
                </ol>
            </div>
        </section>

        {{-- New film --}}
        <section class="bg-white py-4">
            <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
                <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                        <div>
                            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl" href="#">
                                {{ __('New film') }}
                            </a>
                            <div class="underline block w-16 h-0.5 mt-2 bg-orange-500"></div>
                        </div>
                        <div class="flex items-center" id="store-nav-content">
                            <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                                </svg>
                            </a>
                            <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </nav>
                @foreach ($newFilms as $newFilm)
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                        <a href="{{ route('films.detail', ['film' => $newFilm]) }}" class="film">
                            @foreach ($newFilm->medias as $media)
                                @if($media->type == "avatar")
                                    <img class="hover:grow hover:shadow-lg bg-cover m-auto h-auto w-full p-2" src="{{ $media->link }}"/>
                                @endif
                            @endforeach
                        </a>
                        <div class="pt-3 flex items-center justify-between">
                            <p class="p-2">{{ $newFilm->title }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="more-button w-full">
                    <button class="float-right mx-10 bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-4 px-4 border border-orange-500 hover:border-transparent rounded w-40 flex gap-2 justify-center">
                        {{ __('See more') }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        {{-- Hot film --}}
        <section class="bg-white py-4">
            <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
                <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                        <div>
                            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl" href="#">
                                {{ __('Hot film') }}
                            </a>
                            <div class="underline block w-16 h-0.5 mt-2 bg-orange-500"></div>
                        </div>
                        <div class="flex items-center" id="store-nav-content">
                            <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                                </svg>
                            </a>
                            <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </nav>
                @foreach ($hotFilms as $hotFilm)
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                        <a href="{{ route('films.detail', ['film' => $hotFilm->film]) }}" class="film">
                            @foreach ($hotFilm->film->medias as $media)
                                @if($media->type == "avatar")
                                    <img class="hover:grow hover:shadow-lg bg-cover m-auto h-auto w-full p-2" src="{{ $media->link }}"/>
                                @endif
                            @endforeach
                        </a>
                        <div class="pt-3 flex items-center justify-between">
                            <p class="p-2">{{ $hotFilm->film->title }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="more-button w-full">
                    <button class="float-right mx-10 bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-4 px-4 border border-orange-500 hover:border-transparent rounded w-40 flex gap-2 justify-center">
                        {{ __('See more') }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        {{-- Current screenings --}}
        <section class="bg-white py-4">
            <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
                <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                        <div>
                            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl" href="#">
                                {{ __('Current screenings') }}
                            </a>
                            <div class="underline block w-16 h-0.5 mt-2 bg-orange-500"></div>
                        </div>
                        <div class="flex items-center" id="store-nav-content">
                            <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                                </svg>
                            </a>
                            <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </nav>
                <div class="current-screenings w-full">
                    <div class="px-4 py-4 grid grid-row-2">
                        <div class="flex items-start row-span-1">
                        <h2 class="text-lg font-medium text-gray-900 p-2" id="slide-over-title">{{ __('Select date') }} : </h2>
                            <input type="date" name="" id="" class="" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="list-screenings row-span-1 mt-10 divide-y divide-gray-200 grid grid-cols-3 gap-4">
                            @foreach ($currentScreenings as $currentScreening)
                                <a href="#" class="screening p-4 rounded-md border border-gray-200 grid grid-cols-4 gap-4 hover:shadow-lg">
                                    <div class="h-full w-auto overflow-hidden rounded-md border border-gray-200 col-span-1">
                                        @foreach ($currentScreening->film->medias as $media)
                                            @if($media->type == "avatar")
                                                <img src="{{ $media->link }}" class="h-full w-auto object-cover object-center hover:grow hover:shadow-lg bg-cover m-auto"/>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="ml-4 col-span-3">
                                        <div class="film-description my-2">
                                            <h3 class="film-name my-2 p-2">
                                                <b>{{ $currentScreening->film->title }}</b>
                                            </h3>
                                            <p class="my-2 p-2">{{ $currentScreening->room->name }}</p>
                                        </div>
                                        <div class="flex flex-1 items-end justify-between text-sm">
                                            <div class="screen-time border border-orange-300 p-2">
                                                <p class="text-orange-600">{{ $currentScreening->startTime }} - {{ $currentScreening->endTime }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="more-button w-full">
                    <button class="float-right mx-10 bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-4 px-4 border border-orange-500 hover:border-transparent rounded w-40 flex gap-2 justify-center">
                        {{ __('See more') }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

    </div>

    @include('layouts.footer')

</x-app-layout>
