@push('style')
    @livewireStyles
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.css"
        rel="stylesheet">
@endpush

@push('scripts')
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.1.8/af-2.7.0/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.js">
    </script>
    <script>
        let table = $('#table').DataTable({
            dom: 'Bftip',
            buttons: [
                'excel', 'pdf'
            ],
        });

        Livewire.on('reload', function() {
            $(document).ready(function() {
                table = $('#table').DataTable()
            });
        })
        Livewire.on('update', function() {
            Livewire.dispatch('getAllCars', {})
        })

        function deleteItem(nopol) {
            Livewire.dispatch("delete", {
                nopol: nopol
            });
            Livewire.dispatch('getAllCars', {})
        }

        function getUpdateData(nopol) {
            Livewire.dispatch('getUpdateData', {
                nopol: nopol
            })
        }
    </script>
@endpush

<x-panel>
    <div class="w-full h-full">
        <div class="flex items-center space-x-4">
            @include('livewire.add-car')
        </div>
        @if (session('error'))
            <div class="text-red-500">
                {{ session('error') }}
            </div>
        @endif
        <div class="w-full px-10 py-5 overflow-x-scroll bg-white rounded-lg drop-shadow">
            <table id="table" class="bg-white display">
                <thead>
                    <tr>
                        <th>No. Pol</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody wire:loading.remove>
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $car->nopol }}</td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->type }}</td>
                            <td>{{ $car->tahun }}</td>
                            <td>{{ $car->harga }}</td>
                            <td>
                                <img src="{{ Storage::url($car->foto) }}" alt="" class="w-[5rem] h-auto">
                            </td>
                            <td>{{ $car->status }}</td>
                            <td class="">
                                <div class="flex items-center space-x-2">
                                    <button onclick="deleteItem({{ $car->nopol }})"
                                        class="px-4 py-2 text-sm font-bold text-white transition bg-red-500 border-2 border-transparent rounded-sm hover:border-red-500 hover:bg-white">
                                        <x-mdi-trash-can-outline class="w-5 h-5 text-white hover:text-red-500 " />
                                    </button>
                                    <button onclick="getUpdateData({{ $car->nopol }})"
                                        class="px-4 py-2 text-sm font-bold text-white transition bg-blue-500 border-2 border-transparent rounded-sm hover:border-blue-500 hover:bg-white">
                                        <x-mdi-pencil class="w-5 h-5 text-white hover:text-blue-500 " />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-panel>
