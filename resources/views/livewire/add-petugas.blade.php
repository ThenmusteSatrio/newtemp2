<div class="" x-data="{ modalPetugas: @entangle('modalPetugas'), username: @entangle('user'), password: @entangle('password') }">
    <button wire:click.prevent="showTambahPetugas" @click="modalPetugas = true"
        class="relative z-10 px-5 py-2 my-4 text-sm font-bold text-white transition duration-200 bg-teal-500 border-2 border-transparent rounded-sm hover:bg-white hover:text-black hover:border-teal-500">
        Tambah Petugas
    </button>
    <div x-show="modalPetugas" class="absolute inset-0 z-40 bg-black opacity-80"></div>
    <div class="absolute top-0 left-0 right-0 z-50 h-screen overflow-y-scroll shadow-lg" id="addBuku"
        x-show="modalPetugas">
        <x-mdi-window-close class="absolute z-50 w-5 h-5 text-white cursor-pointer top-5 right-5 hover:text-red-500"
            x-on:click="modalPetugas = !modalPetugas" wire:click="clearData" />
        <div class="flex items-center justify-center p-12" x-data="{ open: false }">
            <div x-show="open"
                class="fixed z-30 grid w-full h-full mx-10 overflow-hidden bg-transparent rounded-lg shadow-none place-items-center drop-shadow-xl"
                x-show="openModal">
                <div role="status">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
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
            </div>
            <div wire:ignore.self class="mx-auto w-full max-w-[550px] bg-white">
                <form class="py-6 px-9" id="formtambahbuku"
                    @if ($updatePetugas) wire:submit.prevent="update({{ $id }})"
                @else
                wire:submit.prevent="store" @endif
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="mb-3 block text-base font-medium text-[#07074D]">
                            Username
                        </label>
                        <input x-model="username" type="text" wire:model="user" name="username" id="username"
                            placeholder="Alif"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        @error('username')
                            <p class="font-mono text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="mb-3 block text-base font-medium text-[#07074D]">
                            Password
                        </label>
                        <input type="password" x-model="password" name="alif#123$%^" id="password"
                            wire:model="password" placeholder="alif@#1773%6^"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        @error('password')
                            <p class="font-mono text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    @if (session('error'))
                        <p class="mb-3 font-mono text-xs text-red-500">
                            {{ session('error') }}
                        </p>
                    @endif
                    <div wire:loading
                        class="px-3 py-1 mb-2 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">
                        loading...</div>
                    <div>
                        <button type="submit" x-show="username != '' && password != ''"
                            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
