@push('style')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

<div x-data="{ explore: @entangle('explore'), openFormTransaksi: false, notif: false, }" class="flex flex-col justify-between w-full min-h-screen overflow-x-hidden bg-cover"
    style="background-image: url('https://images.unsplash.com/photo-1490902931801-d6f80ca94fe4?q=80&w=1920&h=1080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-attachment: fixed; background-size:cover">
    <x-navbar />
    <main class="mt-[17rem] mb-[4rem]" x-data="{ modalDetail: false }">

        <div :class="notif ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'"
            class="fixed top-0 right-0 z-50 w-full h-full max-w-xs px-6 py-4 overflow-y-auto transition duration-1000 transform border-l-2 border-gray-300 backdrop-filter backdrop-blur-xl">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-medium text-gray-700">Notification</h3>
                <button @click="notif = !notif" class="text-gray-600 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <hr class="my-3">
            @if ($permintaan != null)
                @foreach ($permintaan as $item)
                    {{-- Card Pinjam --}}
                    <div
                        class="items-center justify-center w-full mb-2 space-x-6 bg-white bg-opacity-50 shadow-xl cursor-pointer hover:bg-gray-100 rounded-xl group sm:flex hover:rounded-2xl">
                        <img class="block w-20 h-20 rounded-lg" alt="art cover" loading="lazy"
                            src='{{ Storage::url('public/' . $item->mobil->foto) }}' />
                        <div class="pl-0 sm:w-8/12">
                            <div class="space-y-1">
                                <div class="space-y-2">
                                    <h4 class="font-semibold text-justify text-md text-cyan-900">
                                        {{ $item->mobil->brand }}
                                    </h4>
                                </div>

                                <div class="flex items-center justify-between mb-2 space-x-4">
                                    <div class="flex flex-row space-x-1">
                                        @if ($item->status == 'approve')
                                            <div wire:click='updateStatus({{ $item->id }})'
                                                class="bg-green-500 shadow-lg shadow- shadow-green-600 text-white cursor-pointer px-2 py-0.5 text-center justify-center items-center rounded-md text-xs flex space-x-2 flex-row">
                                                Ambil
                                            </div>
                                        @elseif ($item->status == 'ambil')
                                            <div wire:click='kembalikan({{ $item->id }})'
                                                class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-2 py-0.5 text-center justify-center items-center rounded-md text-xs flex space-x-2 flex-row">
                                                Kembalikan
                                            </div>
                                        @elseif ($item->status == 'booking')
                                            <div
                                                class="bg-yellow-500 shadow-lg shadow- shadow-yellow-600 text-white cursor-pointer px-2 py-0.5 text-center justify-center items-center rounded-md text-xs flex space-x-2 flex-row">
                                                Dalam Prosess...
                                            </div>
                                        @elseif ($item->status == 'kembali' && $item->kekurangan > 0)
                                            <div
                                                class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-2 py-0.5 text-center justify-center items-center rounded-md text-xs flex space-x-2 flex-row">
                                                Transaksi anda belum lunas
                                            </div>
                                        @elseif ($item->status == 'kembali' && $item->kekurangan <= 0)
                                            <div
                                                class="bg-blue-500 shadow-lg shadow- shadow-blue-600 text-white cursor-pointer px-2 py-0.5 text-center justify-center items-center rounded-md text-xs flex space-x-2 flex-row">
                                                Transaksi Selesai
                                            </div>
                                        @endif
                                        {{-- <div
                                            class="bg-orange-500 text-xs shadow-lg shadow- shadow-orange-600 text-white cursor-pointer px-2 text-center justify-center items-center py-0.5 rounded-xl flex space-x-2 flex-row">
                                            Read

                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="grid px-10 place-items-start " x-show="!explore">
            <p class="font-mono text-3xl font-bold text-white">Rent Car in WorldWide</p>
            <div class="w-[30rem] mt-3">
                <p class="font-mono text-sm font-light text-white">Affordable and flexible car rentals for every
                    journey.
                    Choose from a wide range of vehciles for hassle-free travel experiences.</p>
            </div>
            <div class="mt-4">
                <button type="button" @click="explore = !explore" wire:click="getCars"
                    class="text-gray-900 bg-[#e0e3e7] border border-white border-2 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 text-center inline-flex items-center dark:focus:ring-gray-500 me-2 mb-2">
                    Explore
                </button>
            </div>
        </div>
        <div class="container mx-[1rem] px-6" x-show="explore">
            <div class="mt-5 font-mono">
                <h3 class="font-sans text-2xl font-bold text-gray-300 hover:text-gray-400">Our Cars</h3>
                <div class="flex flex-wrap gap-8 mt-8"
                    @if (!$cars) wire:loading.class="items-center justify-center" @endif>
                    @if (!$cars)
                        <div role="status" wire:loading class="mt-20">
                            <svg aria-hidden="true"
                                class="w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    @endif
                    @if ($cars)
                        @foreach ($cars as $carItems)
                            <div
                                class="overflow-hidden rounded-2xl has-shadow relative w-[250px] h-[280px] hover:scale-105 transition duration-300">
                                <div>
                                    <img src="{{ Storage::url($carItems->foto) }}"
                                        class="w-[250px] h-[280px] object-cover" alt="" />
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 z-20 flex items-center justify-between p-4 pb-5 text-white bg-gradient-to-t from-black">
                                    <div class="w-[120px]">
                                        <h3 class="font-semibold truncate text-md">
                                            {{ $carItems->brand }}</h3>
                                        <div class="opacity-80">
                                            <p class="text-xs ">
                                                {{ $carItems->type }}
                                            </p>
                                        </div>
                                    </div>
                                    <button x-on:click="modalDetail = !modalDetail"
                                        wire:click.prevent="setCar({{ $carItems }})"
                                        class="p-2 -mb-4 text-white bg-blue-500 rounded-full hover:bg-orange-600 focus:outline-none focus:bg-blue-500">
                                        <div>
                                            <x-mdi-car-info class="w-5 h-5 text-white" />
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{-- Card Product --}}
                </div>
            </div>
        </div>
        <div x-show="openFormTransaksi">
            @include('components.form-transaksi')
        </div>
        <div x-show="modalDetail">
            <div class="absolute z-50 cursor-pointer top-10 right-10" @click="modalDetail = !modalDetail">
                <x-mdi-window-close class="w-5 h-5 text-white" />
            </div>
            @if ($car != null)
                @include('components.product-detail')
            @endif
        </div>
    </main>
    <x-footer />
</div>
