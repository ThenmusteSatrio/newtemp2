<div class="fixed inset-0 top-0 left-0 z-40 flex items-center justify-center h-screen bg-center bg-no-repeat bg-cover outline-none min-w-screen animated fadeIn faster focus:outline-none"
    id="modal-id">
    <div class="absolute inset-0 z-0 bg-black opacity-80"></div>
    <div class="relative flex flex-col items-center justify-center min-h-screen " wire:ignore.self>
        <div class="grid place-items-center">
            <div class="flex flex-col">
                <div class="p-4 bg-white shadow-md rounded-3xl">
                    <div class="flex-none lg:flex">
                        <div class="flex items-center justify-center w-full h-full mb-3 lg:h-48 lg:w-48 lg:mb-0">
                            @if ($car['foto'])
                                <img wire:loading.remove src="{{ Storage::url($car['foto']) }}" alt="Just a flower"
                                    class="object-scale-down w-full lg:object-cover lg:h-48 rounded-2xl">
                                <svg wire:loading class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex-auto py-2 ml-3 justify-evenly">
                            <div class="flex flex-wrap ">
                                <div class="flex-none w-full text-xs font-medium text-blue-700 ">
                                    Rent
                                </div>
                                <h2 wire:loading.remove class="flex-auto text-lg font-medium">{{ $car['brand'] }}</h2>
                                <div wire:loading class="w-48 h-4 mt-4 mb-4 bg-gray-200 rounded-full"></div>
                            </div>
                            <p class="mt-3"></p>
                            <div class="flex py-4 text-sm text-gray-500">
                                <div class="inline-flex items-center flex-1">
                                    <x-mdi-car-info class="w-5 h-5 text-gray-400" />
                                    <p class="">{{ $car['status'] }}</p>
                                </div>
                                <div class="inline-flex items-center flex-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="">{{ $car['tahun'] }}</p>
                                </div>
                            </div>
                            <div class="flex pt-4 pl-4 pr-4 border-t border-gray-200 "></div>
                            <p class="pb-2">harga: <span
                                    class="font-semibold">Rp.{{ number_format($car['harga'], 0, ',', '.') }}</span></p>
                            <div class="flex space-x-3 text-sm font-medium">
                                <div class="flex flex-auto space-x-3">
                                    <button @click="modalDetail = !modalDetail"
                                        class="inline-flex items-center px-7 py-1.5 mb-2 space-x-2 tracking-wider text-gray-600 bg-white border rounded-lg shadow-sm md:mb-0 hover:bg-gray-100 ">
                                        <span>Close</span>
                                    </button>
                                </div>
                                <button @click="modalDetail = !modalDetail, openFormTransaksi= true"
                                    wire:click="initializeTransaksi('{{ $car['harga'] }}', '{{ $car['nopol'] }}' )"
                                    class="py-1.5 px-9 mb-2 tracking-wider text-white bg-gray-900 rounded-lg shadow-sm px-7 md:mb-0 hover:bg-gray-800"
                                    type="button" aria-label="like">Rent</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
