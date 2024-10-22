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

        function approve(id) {
            Livewire.dispatch('approve', {
                id: id
            })
        }

        Livewire.on('reload', function() {
            $(document).ready(function() {
                table = $('#table').DataTable()
            });
        })

        function formBayar(id) {
            Livewire.dispatch('formBayar', {
                id: id
            })

        }
    </script>
@endpush

<x-panel>
    <div class="w-full h-full">
        <div>
            @include('components.form-kembali')
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
                        <th>No.</th>
                        <th>Nama Member</th>
                        <th>Mobil</th>
                        <th>Tanggal Ambil</th>
                        <th>Tanggal Kembali</th>
                        <th>Down Payment</th>
                        <th>Kekurangan</th>
                        <th>Aksi / Status</th>
                    </tr>
                </thead>
                <tbody wire:loading.remove>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($permintaan as $item)
                        <tr>
                            <td>{{ $index++ }}.</td>
                            <td>{{ $item->member->nama }}</td>
                            <td>{{ $item->mobil->brand }}</td>
                            <td>{{ $item->tgl_ambil }}</td>
                            <td>{{ $item->tgl_kembali }}</td>
                            <td>Rp{{ number_format($item->downpayment, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->kekurangan, 0, ',', '.') }}</td>
                            <td class="">
                                <div class="flex items-center space-x-2">
                                    @if ($item->status == 'booking')
                                        <button onclick="approve({{ $item->id }})"
                                            class="px-4 py-2 text-sm text-white transition bg-green-500 border-2 border-transparent rounded-sm cursor-pointer font-b old hover:border-green-500 hover:bg-green-200">
                                            <p class="text-white">Approve</p>
                                        </button>
                                    @elseif ($item->status == 'approve' || $item->status == 'ambil')
                                        <button disabled
                                            class="px-4 py-2 text-sm font-bold text-white transition bg-yellow-500 border-2 border-transparent rounded-sm hover:border-yellow-500">
                                            <p class="text-white">Dalam Peminjaman...</p>
                                        </button>
                                    @elseif($item->status == 'kembali' && $item->kekurangan > 0)
                                        <button
                                            wire:click.prevent="fillForm('{{ $item->id }}', '{{ $item->mobil->harga }}', '{{ $item->tgl_kembali }}', '{{ $item->kekurangan }}', '{{ $item->downpayment }}')"
                                            class="px-4 py-2 text-xs font-semibold text-white transition bg-red-500 border-2 border-transparent rounded-sm hover:border-red-500 hover:bg-red-200">
                                            <p class="text-white">Dikembalikan, Periksa!</p>
                                        </button>
                                    @elseif($item->kekurangan <= 0 && $item->status == 'kembali')
                                        <button
                                            class="px-4 py-2 text-sm font-bold text-white transition bg-red-500 border-2 border-transparent rounded-sm hover:border-red-500"
                                            disabled>
                                            <p class="text-white">Selesai!</p>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-panel>
