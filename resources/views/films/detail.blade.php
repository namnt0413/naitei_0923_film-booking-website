<x-app-layout>

    <x-slot name="header">
        @include('layouts.navbar')
    </x-slot>

    <div class="bg-white w-full border-gray-500 rounded-lg mt-5 py-10 px-5 gap-5 grid grid-cols-3">
        <div class="avatar px-4">
            <img class="object-cover bg-cover float-right mr-8 h-96 w-auto" src="{{ $film->medias->where('type', 'avatar')->first()->link }}" />
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
                    <iframe width="600" height="400" src="{{ $film->medias->where('type', 'trailer')->first()->link }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
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
                    <img class="object-cover bg-cover m-auto h-80 w-auto" src="{{ $media->link }}" />
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="gallery flex gap-5 mt-10 py-5 px-20 grid grid-rows-1">
                <div class="flex flex-row align-center justify-between mb-6">
                    <div class="topic">
                        <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl" href="#">
                            {{ __('Comment') }}
                        </a>
                        <div class="underline block w-16 h-0.5 mt-2 bg-orange-500"></div>
                    </div>
                    <button class="bg-blue-500 text-white px-4 rounded hover:bg-blue-600" id="createCommentBtn">{{ __('Create comment') }}</button>
                </div>
                <div>
                    @foreach ($reviews as $review)
                    <div class="bg-gray-200 p-4 rounded-lg shadow-md mb-10">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex justify-start align-center">
                                <div class="mr-2 text-xl font-bold">{{ $review->user->username }}</div>
                                <div class="flex flex-row align-center">
                                    @for ($i = 1; $i <= $review->rating; $i++)
                                        <i class="fa-solid fa-star" style="color: #ffc107;margin: 3px 3px 0;"></i>
                                        @endfor
                                </div>
                            </div>
                            @if($id == $review->user->id)
                            <div class="flex flex-row">
                                <button id="editCommentBtn" data-comment="{{ $review->comment }}" data-rating="{{ $review->rating }}" class="mx-1"><a class="text-sm text-sky-600 hover:text-lime-600">{{ __('Edit') }}</a></button>
                                <form action="{{ route('reviews.destroy', ['review' => $review]) }}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button class="mx-1"><a class="text-sm text-sky-600 hover:text-red-600">{{ __('Delete') }}</a></button>
                                </form>
                            </div>
                            <!-- Modal Edit -->
                            <div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="commentModalEdit">
                                <div class="modal-overlay fixed inset-0 bg-black opacity-50"></div>
                                <div class="modal-content bg-white fixed w-1/2 p-4 rounded shadow-lg">
                                    <h2 class="text-2xl font-semibold mb-4">{{ __('Update comment') }}</h2>
                                    <form action="{{ route('reviews.update', ['review' => $review]) }}" method="POST">
                                        @csrf
                                        @method("put")
                                        <input type="hidden" name="film_id" value="{{ $film->id }}">
                                        <div class="star-rating">
                                            <div class="star-input">
                                                <input type="radio" name="rating" id="rating-edit-5" value="5">
                                                <label for="rating-edit-5" class="fas fa-star"></label>
                                                <input type="radio" name="rating" id="rating-edit-4" value="4">
                                                <label for="rating-edit-4" class="fas fa-star"></label>
                                                <input type="radio" name="rating" id="rating-edit-3" value="3">
                                                <label for="rating-edit-3" class="fas fa-star"></label>
                                                <input type="radio" name="rating" id="rating-edit-2" value="2">
                                                <label for="rating-edit-2" class="fas fa-star"></label>
                                                <input type="radio" name="rating" id="rating-edit-1" value="1">
                                                <label for="rating-edit-1" class="fas fa-star"></label>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="comment" class="block font-semibold">{{ __('Comment') }}</label>
                                            <textarea class="w-full" name="comment" id="commentEdit" rows="4" required></textarea>
                                        </div>
                                        <div class="flex flex-row justify-end">
                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">{{ __('Edit') }}</button>
                                            <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2 hover:bg-gray-400" id="closeModalEdit"> {{ __('Cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            @endif
                        </div>
                        <p>{{ $review->comment }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Modal Create -->
        <div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="commentModal">
            <div class="modal-overlay fixed inset-0 bg-black opacity-50"></div>
            <div class="modal-content bg-white fixed w-1/2 p-4 rounded shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Reviews and comments') }}</h2>
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="film_id" value="{{ $film->id }}">
                    <div class="star-rating">
                        <div class="star-input">
                            <input type="radio" name="rating" id="rating-create-5" value="5">
                            <label for="rating-create-5" class="fas fa-star"></label>
                            <input type="radio" name="rating" id="rating-create-4" value="4">
                            <label for="rating-create-4" class="fas fa-star"></label>
                            <input type="radio" name="rating" id="rating-create-3" value="3">
                            <label for="rating-create-3" class="fas fa-star"></label>
                            <input type="radio" name="rating" id="rating-create-2" value="2">
                            <label for="rating-create-2" class="fas fa-star"></label>
                            <input type="radio" name="rating" id="rating-create-1" value="1">
                            <label for="rating-create-1" class="fas fa-star"></label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block font-semibold">{{ __('Comment') }}</label>
                        <textarea class="w-full" name="comment" id="comment" rows="4" required></textarea>
                    </div>
                    <div class="flex flex-row justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">{{ __('Create') }}</button>
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2 hover:bg-gray-400" id="closeModal"> {{ __('Cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footer')

</x-app-layout>
