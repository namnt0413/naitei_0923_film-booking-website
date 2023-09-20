@props(['errors'])

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p class="bg-red-600 text-white p-5 mt-3 text-base">{{ $error }}</p>
    @endforeach
@endif

@if (session()->has('success'))
    <p class="bg-green-600 text-white p-5 mt-3 text-base">{{ session()->get('success') }}</p>
@endif

@if (session()->has('error'))
    <p class="bg-red-600 text-white p-5 mt-3 text-base">{{ session()->get('error') }}</p>
@endif
