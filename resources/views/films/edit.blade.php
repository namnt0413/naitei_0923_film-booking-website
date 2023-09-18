<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Edit Film") }}
        </h2>
    </x-slot>

    <div class="w-full rounded-lg bg-white p-5 mt-5">
        <form class="px-20 py-10 grid grid-cols-2 gap-4" action="{{ route('films.update', ['film' => $film]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="mb-2 mx-16">
                <label class="block text-lg font-bold mb-2" for="title">{{ __("Title") }}</label>
                <input type="text" name="title" id="title" class="title w-full" value="{{ $film->title }}">
                @error('title')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        {{ $message }}
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"></svg>
                        </span>
                    </div>
                @enderror
            </div>

            <div class="mb-2 mx-16">
                <label class="block text-lg font-bold mb-2" for="director">{{ __("Director") }}</label>
                <input type="text" name="director" id="director" class="director w-full" value="{{ $film->director }}">
                @error('director')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        {{ $message }}
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"></svg>
                        </span>
                    </div>
                @enderror
            </div>

            <div class="mb-2 mx-16">
                <label class="block text-lg font-bold mb-2" for="release_date">{{ __("Release date") }}</label>
                <input type="date" name="release_date" id="release_date" class="release_date w-full" value="{{ $film->release_date }}">
                @error('release_date')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        {{ $message }}
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"></svg>
                        </span>
                    </div>
                @enderror
            </div>

            <div class="mb-2 mx-16">
                <label class="block text-lg font-bold mb-2" for="duration">{{ __("Duration") }}</label>
                <input type="number" name="duration" id="duration" class="title w-full" value="{{ $film->duration }}">
                @error('duration')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        {{ $message }}
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"></svg>
                        </span>
                    </div>
                @enderror
            </div>

            <div class="mb-2 mx-16 col-span-2">
                <label class="block text-lg font-bold mb-2" for="description">{{ __("Description") }}</label>
                <textarea name="description" id="description" class="description w-full" rows="4">{{ $film->description }}</textarea>
                @error('description')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        {{ $message }}
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"></svg>
                        </span>
                    </div>
                @enderror
            </div>

            <div class="mb-2 mx-16">
                <label class="block text-lg font-bold mb-2" for="genres">{{ __("Genres") }}</label>
                <select data-te-select-init data-te-select-placeholder="select gendres" name="genres[]" id="genres" multiple>
                    @foreach ($genres as $genre)
                        @php
                            $selected="";
                            foreach ($film->genres as $filmGenre) {
                                $genre->id == $filmGenre->id ? $selected="selected" : "";
                            }
                        @endphp
                        <option value="{{ $genre->id }}" <?= $selected ?>>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2 mx-16">
                <label class="block text-lg font-bold mb-2" for="trailer">{{ __("Trailer") }}</label>
                @php
                    $checkTrailer = false
                @endphp
                @foreach ($film->medias as $media)
                    @if($media->type == "trailer")
                        <input type="text" name="trailer" id="trailer" class="trailer w-full" value="{{ $media->link }}">
                        @php
                            $checkTrailer=true;
                        @endphp
                    @endif
                @endforeach
                @if(!$checkTrailer)
                    <input type="text" name="trailer" id="trailer" class="trailer w-full" value="">
                @endif
            </div>

            <div class="mb-2 mx-16">
                <label class="block text-lg font-bold mb-2" for="avatar">{{ __("Avatar") }}</label>
                <input type="file" name="avatar" id="avatar"
                    class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-green-700
                    hover:file:bg-violet-100"
                />
                @foreach ($film->medias as $media)
                    @if($media->type == "avatar")
                        <img class="object-cover bg-cover h-80 w-auto px-10 py-5" src="{{ $media->link }}"/>
                    @endif
                @endforeach
            </div>

            <div class="mb-2 mx-16">
                <label class="block text-lg font-bold mb-2" for="avatar">{{ __("Images gallery") }}</label>
                <input type="file" name="images[]" id="image" multiple
                    class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-red-700
                    hover:file:bg-violet-100"
                />
                <div class="images px-4 grid grid-cols-2 gap-4 py-5">
                    @foreach ($film->medias as $media)
                        @if($media->type == "image")
                            <img class="object-cover bg-cover m-auto h-24 w-30" src="{{ $media->link }}"/>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="mb-2 mx-16 mt-5 col-span-2">
                <button type="submit" class="w-24 h-12 text-lg rounded-md bg-green-600 text-white hover:bg-green-300 hover:text-gray-600 transition-all">
                    {{ __("Edit") }}
                </button>
            </div>

        </form>
    </div>
</x-admin-layout>
