        {{-- Navbar --}}
        <nav id="header" class="w-full z-30 top-0 py-1 bg-zinc-900">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6">
                <label for="menu-toggle" class="cursor-pointer md:hidden block">
                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </label>
                <input class="hidden" type="checkbox" id="menu-toggle"/>
                <div class="m-auto hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
                    <nav>
                        <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0">
                            <li class="hover:bg-zinc-800 active:bg-zinc-800">
                                <a class="inline-block no-underline hover:text-orange-500 hover:no-underline py-4 px-4 w-36 h-auto text-center text-white"href="#">{{ __('Film') }}</a>
                            </li>
                            <li class="hover:bg-zinc-800 active:bg-zinc-800">
                                <a class="inline-block no-underline hover:text-orange-500 hover:no-underline py-4 px-4 w-36 h-auto text-center text-white"href="#">{{ __('Book ticket') }}</a>
                            </li>
                            <li class="hover:bg-zinc-800 active:bg-zinc-800">
                                <a class="inline-block no-underline hover:text-orange-500 hover:no-underline py-4 px-4 w-36 h-auto text-center text-white"href="#">{{ __('Theater') }}</a>
                            </li>
                            <li class="hover:bg-zinc-800 active:bg-zinc-800">
                                <a class="inline-block no-underline hover:text-orange-500 hover:no-underline py-4 px-4 w-36 h-auto text-center text-white"href="#">{{ __('User') }}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </nav>
