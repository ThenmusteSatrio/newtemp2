<div class="fixed inset-0 top-0 left-0 z-40 flex items-center justify-center h-screen bg-center bg-no-repeat bg-cover outline-none min-w-screen animated fadeIn faster focus:outline-none"
    id="modal-id">
    <div class="absolute inset-0 z-0 bg-black opacity-80"></div>
    <div class="relative flex flex-col items-center justify-center min-h-screen " wire:ignore.self>
        <form class="py-6 px-9" id="formtambahbuku" wire:submit.prevent="rental" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-10 mb-5">
                <div class="">
                    <label for="tglambil" class="block mb-3 text-base font-medium text-white">
                        Tanggal Ambil
                    </label>
                    <input type="date" wire:model="tglambil" wire:change='updateTotalFromDay' name="tglambil"
                        id="tglambil"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    @error('tglambil')
                        <p class="font-mono text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="">
                    <label for="tglkembali" class="block mb-3 text-base font-medium text-white">
                        Tanggal Kembali
                    </label>
                    <input required type="date" wire:change='updateTotalFromDay' wire:model="tglkembali"
                        name="tglkembali" id="tglkembali"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    @error('tglkembali')
                        <p class="font-mono text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-5">
                <label for="sopir" class="block mb-3 text-base font-medium text-white">
                    Dengan Sopir
                </label>
                <select name="sopir" id="" wire:model.change="sopir" wire:change="updateTotal"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option value="">Please select option</option>
                    <option value="0">Tanpa Sopir</option>
                    <option value="1">Dengan Sopir</option>
                </select>
                @error('sopir')
                    <p class="font-mono text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="downpayment" class="block mb-3 text-base font-medium text-white">
                    downpayment
                </label>
                <input type="number" wire:keydown.enter='initializeKekurangan' wire:change='initializeKekurangan'
                    wire:model="downpayment" name="downpayment" id="downpayment" placeholder="2500000"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                @error('downpayment')
                    <p class="font-mono text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div wire:loading
                class="px-3 py-1 mb-2 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">
                loading...</div>
            @if ($total != null)
                <div for="downpayment" class="flex justify-between block mb-3 text-base font-medium text-white">
                    <p>

                        Total Pembayaran
                    </p>
                    <span class="font-semibold">Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
            @endif
            @if ($kekurangan != null)
                <div for="downpayment" class="flex justify-between block mb-3 text-base font-medium text-white">
                    <p>
                        Kekurangan

                    </p>
                    <span class="font-semibold">Rp{{ number_format($kekurangan, 0, ',', '.') }}</span>
                </div>
            @endif

            <div>
                <button type="submit"
                    class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                    Submit
                </button>
            </div>
        </form>

    </div>
</div>
