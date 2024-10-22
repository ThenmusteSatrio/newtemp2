<div class="" x-data="{ modalMember: @entangle('modalMember'), nik: @entangle('nik'), nama: @entangle('nama'), username: @entangle('username'), jk: @entangle('jk'), notelp: @entangle('notelp'), password: @entangle('password'), alamat: @entangle('alamat') }">
    <button @click="modalMember = true" wire:click='clearData'
        class="relative z-10 px-5 py-2 my-4 text-sm font-bold text-white transition duration-200 bg-teal-500 border-2 border-transparent rounded-sm hover:bg-white hover:text-black hover:border-teal-500">
        Tambah Member
    </button>
    <div x-show="modalMember" class="absolute inset-0 z-40 bg-black opacity-80"></div>
    <div class="absolute top-0 left-0 right-0 z-50 h-screen overflow-y-scroll shadow-lg" id="addBuku"
        x-show="modalMember">
        <x-mdi-window-close class="absolute z-50 w-5 h-5 text-white cursor-pointer top-5 right-5 hover:text-red-500"
            x-on:click="modalMember = !modalMember" wire:click="clearData" />
        <div class="flex items-center justify-center p-12" x-data="{ open: false }">
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Terjadi Kesalahan!</span> coba lagi nanti
                </div>
            @endif
            <div class="p-12 bg-white rounded-md">
                <div class="mb-10 text-center">
                    <h1 class="text-3xl font-bold text-gray-900">REGISTER MEMBER</h1>
                    <p>Enter member information to register</p>
                </div>
                <div class="flex -mx-3">
                    <div class="w-1/2 px-3 mb-5">
                        <label for="" class="px-1 text-xs font-semibold">NIK</label>
                        <div class="flex">
                            <div
                                class="z-10 flex items-center justify-center w-10 pl-1 text-center pointer-events-none">
                                <i class="text-lg text-gray-400 mdi mdi-card-account-details-outline"></i>
                            </div>
                            <input type="text" wire:model="nik" x-model.lazy="nik"
                                class="w-full py-2 pl-10 pr-3 -ml-10 border-2 border-gray-200 rounded-lg outline-none focus:border-indigo-500"
                                placeholder="33015xxxxxxx">
                        </div>
                        @error('nik')
                            <p class="mb-2 font-sans text-xs text-pink-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-1/2 px-3 mb-5">
                        <label for="" class="px-1 text-xs font-semibold">Nama</label>
                        <div class="flex">
                            <div
                                class="z-10 flex items-center justify-center w-10 pl-1 text-center pointer-events-none">
                                <i class="text-lg text-gray-400 mdi mdi-account-outline"></i>
                            </div>
                            <input type="text" wire:model="nama" x-model.lazy="nama"
                                class="w-full py-2 pl-10 pr-3 -ml-10 border-2 border-gray-200 rounded-lg outline-none focus:border-indigo-500"
                                placeholder="John Smith">
                        </div>
                        @error('nama')
                            <p class="mb-2 font-sans text-xs text-pink-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex -mx-3">
                    <div class="w-full px-3 mb-5">
                        <label for="" class="px-1 text-xs font-semibold">Username</label>
                        <div class="flex">
                            <div
                                class="z-10 flex items-center justify-center w-10 pl-1 text-center pointer-events-none">
                                <i class="text-lg text-gray-400 mdi mdi-account-outline"></i>
                            </div>
                            <input type="tel" wire:model="username" x-model.lazy="username"
                                class="w-full py-2 pl-10 pr-3 -ml-10 border-2 border-gray-200 rounded-lg outline-none focus:border-indigo-500"
                                placeholder="john007">
                        </div>
                        @error('username')
                            <p class="mb-2 font-sans text-xs text-pink-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 mb-5">
                        <label for="" class="px-1 text-xs font-semibold">Jenis Kelamin</label>
                        <div class="flex">
                            <div
                                class="z-10 flex items-center justify-center w-10 pl-1 text-center pointer-events-none">
                                <i class="text-lg text-gray-400 mdi mdi-gender-male-female"></i>
                            </div>
                            <select name="" id="" wire:model.change="jk" x-model.lazy="jk"
                                class="w-full py-2 pl-10 pr-3 -ml-10 border-2 border-gray-200 rounded-lg outline-none focus:border-indigo-500">
                                @if ($jk != '')
                                    <option value="L" @if ($jk == 'L') selected @endif>Laki-laki
                                    </option>
                                    <option value="P" @if ($jk == 'P') selected @endif>Perempuan
                                    </option>
                                @else
                                @endif
                                <option value="">Please select Option</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        @error('jk')
                            <p class="mb-2 font-sans text-xs text-pink-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex -mx-3">
                    <div class="w-full px-3 mb-5">
                        <label for="" class="px-1 text-xs font-semibold">No. Telp</label>
                        <div class="flex">
                            <div
                                class="z-10 flex items-center justify-center w-10 pl-1 text-center pointer-events-none">
                                <i class="text-lg text-gray-400 mdi mdi-phone"></i>
                            </div>
                            <input type="tel" wire:model="notelp" x-model.lazy="notelp"
                                class="w-full py-2 pl-10 pr-3 -ml-10 border-2 border-gray-200 rounded-lg outline-none focus:border-indigo-500"
                                placeholder="************">
                        </div>
                        @error('notelp')
                            <p class="mb-2 font-sans text-xs text-pink-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 mb-5">
                        <label for="" class="px-1 text-xs font-semibold">Password</label>
                        <div class="flex">
                            <div
                                class="z-10 flex items-center justify-center w-10 pl-1 text-center pointer-events-none">
                                <i class="text-lg text-gray-400 mdi mdi-lock-outline"></i>
                            </div>
                            <input type="password" wire:model="password" x-model.lazy="password"
                                class="w-full py-2 pl-10 pr-3 -ml-10 border-2 border-gray-200 rounded-lg outline-none focus:border-indigo-500"
                                placeholder="************">
                        </div>
                        @error('password')
                            <p class="mb-2 font-sans text-xs text-pink-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex -mx-3">
                    <div class="w-full px-3 mb-12">
                        <label for="" class="px-1 text-xs font-semibold">Alamat</label>
                        <div class="flex">
                            <div
                                class="z-10 flex items-center justify-center w-10 pl-1 text-center pointer-events-none">
                                <i class="text-lg text-gray-400 mdi mdi-map-marker"></i>
                            </div>
                            <textarea wire:model="alamat" wire:keydown.enter="register" x-model.lazy="alamat"
                                class="w-full pt-5 pl-10 pr-3 -ml-10 align-middle border-2 border-gray-200 rounded-lg outline-none focus:border-indigo-500"
                                placeholder="Jl. Mangga"></textarea>
                        </div>
                        @error('alamat')
                            <p class="mb-2 font-sans text-xs text-pink-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex -mx-3">
                    <div class="w-full px-3 mb-5">
                        <button
                            @if ($updateMember == false) wire:click="register"
                        @else
                            wire:click="update" @endif
                            x-show="nama != '' && username != '' && password != '' && notelp != '' && alamat != '' && jk != ''"
                            class="block w-full max-w-xs px-3 py-3 mx-auto font-semibold text-white bg-indigo-500 rounded-lg hover:bg-indigo-700 focus:bg-indigo-700">
                            <p wire:loading.remove>
                                @if ($updateMember == false)
                                    REGISTER
                                @else
                                    UPDATE
                                @endif
                            </p>
                            <div role="status" wire:loading>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-white"
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
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
