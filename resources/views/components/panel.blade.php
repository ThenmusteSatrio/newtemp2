<div class="min-h-screen bg-gray-50/50">
    <aside
        class="bg-gradient-to-br from-gray-800 to-gray-900 -translate-x-80 fixed inset-0 z-40 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0">
        <div class="relative border-b border-white/20">
            <a class="flex items-center gap-4 px-8 py-6" href="#/">
                <h6
                    class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-white">
                    Perpustakaan Digital</h6>
            </a>
            <button
                class="middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-white hover:bg-white/10 active:bg-white/30 absolute right-0 top-0 grid rounded-br-none rounded-tl-none xl:hidden"
                type="button">
                <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" aria-hidden="true" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </span>
            </button>
        </div>
        <div class="m-4">
            @if (Auth::guard('inspector')->user()->lvl == 'admin')
                <ul wire:ignore class="flex flex-col gap-1 mb-4">
                    <li>
                        <a aria-current="page" class="active" href="/admin/control/panel/dashboard">
                            <button
                                class="{{ request()->path() == 'admin/control/panel/dashboard' ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize' : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize' }}"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" class="w-5 h-5 text-inherit">
                                    <path
                                        d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z">
                                    </path>
                                    <path
                                        d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z">
                                    </path>
                                </svg>
                                <p
                                    class="block font-sans text-base antialiased font-medium leading-relaxed capitalize text-inherit">
                                    dashboard</p>
                            </button>
                        </a>
                    </li>

                    <li>
                        <a class="" href="/admin/control/panel/petugas">
                            <button
                                class="{{ request()->path() == 'admin/control/panel/petugas' ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize' : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize' }}"
                                type="button">
                                <x-mdi-shield-account class="w-5 h-5 text-inherit" />
                                <p
                                    class="block font-sans text-base antialiased font-medium leading-relaxed capitalize text-inherit">
                                    Petugas</p>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a class="" href="/admin/control/panel/member">
                            <button
                                class="{{ request()->path() == 'admin/control/panel/member' ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize' : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize' }}"
                                type="button">
                                <x-mdi-account-group class="w-5 h-5 text-inherit" />
                                <p
                                    class="block font-sans text-base antialiased font-medium leading-relaxed capitalize text-inherit">
                                    Members</p>
                            </button>
                        </a>
                    </li>
                </ul>
            @elseif (Auth::guard('inspector')->user()->lvl == 'petugas')
                <ul wire:ignore class="flex flex-col gap-1 mb-4">
                    <li>
                        <a aria-current="page" class="active" href="/petugas/control/panel/dashboard">
                            <button
                                class="{{ request()->path() == 'petugas/control/panel/dashboard' ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize' : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize' }}"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" class="w-5 h-5 text-inherit">
                                    <path
                                        d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z">
                                    </path>
                                    <path
                                        d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z">
                                    </path>
                                </svg>
                                <p
                                    class="block font-sans text-base antialiased font-medium leading-relaxed capitalize text-inherit">
                                    dashboard</p>
                            </button>
                        </a>
                    </li>


                    <li>
                        <a class="" href="/petugas/control/panel/cars">
                            <button
                                class="{{ request()->path() == 'petugas/control/panel/cars' ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize' : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize' }}"
                                type="button">
                                <x-mdi-car-multiple class="w-5 h-5 text-inherit" />
                                <p
                                    class="block font-sans text-base antialiased font-medium leading-relaxed capitalize text-inherit">
                                    Cars</p>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a class="" href="/petugas/control/panel/permintaan">
                            <button
                                class="{{ request()->path() == 'petugas/control/panel/permintaan' ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize' : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize' }}"
                                type="button">
                                <x-mdi-checkbox-blank-badge class="w-5 h-5 text-inherit" />
                                <p
                                    class="block font-sans text-base antialiased font-medium leading-relaxed capitalize text-inherit">
                                    Permintaan</p>
                            </button>
                        </a>
                    </li>
                </ul>
            @endif
            <ul class="flex flex-col gap-1 mb-4">
                <li class="mx-3.5 mt-4 mb-2">
                    <p
                        class="block font-sans text-sm antialiased font-black leading-normal text-white uppercase opacity-75">
                        auth pages</p>
                </li>
                <li>
                    <a class="" href="/logout">
                        <button
                            class="flex items-center w-full gap-4 px-4 py-3 font-sans text-xs font-bold text-white capitalize transition-all rounded-lg middle none center disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-white/10 active:bg-white/30"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true" class="w-5 h-5 text-inherit">
                                <path fill-rule="evenodd"
                                    d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p
                                class="block font-sans text-base antialiased font-medium leading-relaxed capitalize text-inherit">
                                Logout</p>
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <div class="flex flex-col justify-between p-4 xl:ml-80">
        <nav class="block w-full max-w-full px-0 py-1 text-white transition-all bg-transparent shadow-none rounded-xl">
            <div class="flex flex-col-reverse justify-between gap-6 md:flex-row md:items-center">
                <div class="capitalize">
                    <nav aria-label="breadcrumb" class="w-max">
                        <ol
                            class="flex flex-wrap items-center w-full p-0 transition-all bg-transparent rounded-md bg-opacity-60">
                            <li
                                class="flex items-center font-sans text-sm antialiased font-normal leading-normal transition-colors duration-300 cursor-pointer text-blue-gray-900 hover:text-light-blue-500">
                                <a href="#">
                                    <p
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-900 transition-all opacity-50 hover:text-blue-500 hover:opacity-100">
                                        Admin</p>
                                </a>
                                <span
                                    class="mx-2 font-sans text-sm antialiased font-normal leading-normal text-gray-500 pointer-events-none select-none">/</span>
                            </li>
                            <li
                                class="flex items-center font-sans text-sm antialiased font-normal leading-normal text-blue-900 transition-colors duration-300 cursor-pointer hover:text-blue-500">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ request()->path() == 'admin/control/panel/dashboard'
                                        ? 'dashboard'
                                        : (request()->path() == 'admin/control/panel/petugas'
                                            ? 'Petugas'
                                            : (request()->path() == 'admin/control/panel/member'
                                                ? 'Member'
                                                : (request()->path() == 'petugas/control/panel/cars'
                                                    ? 'Cars'
                                                    : (request()->path() == 'petugas/control/panel/dashboard'
                                                        ? 'Dashboard'
                                                        : 'Permintaan')))) }}
                                </p>
                            </li>
                        </ol>
                    </nav>
                    <h6
                        class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-gray-900">
                        {{ request()->path() == 'admin/control/panel/dashboard'
                            ? 'dashboard'
                            : (request()->path() == 'admin/control/panel/petugas'
                                ? 'Petugas'
                                : (request()->path() == 'admin/control/panel/member'
                                    ? 'Member'
                                    : (request()->path() == 'petugas/control/panel/cars'
                                        ? 'Cars'
                                        : (request()->path() == 'petugas/control/panel/dashboard'
                                            ? 'Dashboard'
                                            : 'Permintaan')))) }}
                    </h6>
                </div>
            </div>
        </nav>
        {{ $slot }}

    </div>
</div>
