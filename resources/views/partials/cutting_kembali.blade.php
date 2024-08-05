<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="inline-block min-w-full p-1.5 align-middle">
            <div class="border divide-y divide-gray-200 rounded-lg dark:divide-neutral-700 dark:border-neutral-700">
                <div class="px-4 py-3">
                    <form class="relative max-w-xs">
                        <label class="sr-only">Search</label>
                        <input type="hidden" name="barang" value="kirim">
                        <input type="date" name="date" value="{{ request()?->query('date') }}"
                            class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm ps-9 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Cari barang datang">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="text-gray-400 size-4 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </svg>
                        </div>
                    </form>
                </div>
                @if (request()?->query('date'))
                    <div class="flex items-center p-4 space-x-2">
                        <span class="text-lg font-semibold text-gray-700 dark:text-neutral-300">Menampilkan pada
                            hari:</span>
                        <span class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                            {{ \Carbon\Carbon::parse(request()?->query('date'))?->translatedFormat('l, d F Y') }}
                        </span>
                        <a href="?barang=kirim"
                            class="flex items-center text-sm font-medium border border-transparent rounded-lg hover:text-danger-700 disabled:pointer-events-none disabled:opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-refresh-ccw">
                                <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                                <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                                <path d="M16 16h5v5" />
                            </svg>
                        </a>
                    </div>
                @endif

                @foreach ($cuttingAmbil as $row)
                    @php
                        $totalKeseluruhanHarga = 0;
                    @endphp
                    @php
                        $cutingModel = \App\Models\CuttingAmbilModel::getReturnNull($row?->id);
                    @endphp
                    <div
                        class="flex flex-row items-center justify-between px-4 py-2 mx-8 mb-2 text-xs font-semibold text-white bg-blue-500 rounded-lg whitespace-nowrap">
                        Tanggal:
                        {{ \Carbon\Carbon::parse($row?->tanggal_ambil)?->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i:s') }}

                        {{--  awal action tanggal  --}}
                        <span class="flex text-sm text-gray-600 dark:text-neutral-400">
                            <div class="inline-block hs-tooltip">
                                <button type="button" data-hs-overlay="#edit-modal-tanggal"
                                    data-id="{{ $row?->id }}"
                                    class="hs-tooltip-toggle edit-tanggal inline-flex items-center justify-center gap-x-2 rounded-s-md bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="blue" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    <span
                                        class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                        role="tooltip">
                                        Edit
                                    </span>
                                </button>
                            </div>
                            <div class="inline-block hs-tooltip">
                                <form action="/barang/jadi/delete/{{ $row?->id }}" method="post"
                                    data-id="{{ $row?->id }}" style="display: inline-block;">
                                    @csrf
                                    <button type="submit"
                                        class="hs-tooltip-toggle delete inline-flex items-center justify-center gap-x-2 rounded-e-md bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="crimson" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        <span
                                            class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 delete hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                            role="tooltip">
                                            Hapus
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </span>
                        {{--  akhir aktion tanggal  --}}
                    </div>
                    @foreach ($cutingModel as $item)
                        @php
                            $warnaModel = \App\Models\CuttingWarnaModel::ambilModel($item?->id);
                        @endphp
                        <ul class="container mx-auto divide-y divide-gray-400 divide-dotted"
                            style="font-family: Raleway">
                            <li class="grid items-center w-full grid-cols-12 gap-2 py-2">
                                <div
                                    class="flex flex-col items-center justify-center p-2 text-xs font-semibold text-white bg-pink-500 rounded-lg w-fit justify-self-center whitespace-nowrap">
                                    {{ $item?->model }}
                                    {{-- Awal action model --}}
                                    <div
                                        class="inline-flex items-center mt-1 transition-all bg-white border border-gray-300 divide-x divide-gray-300 rounded-lg shadow-sm group dark:divide-neutral-700 dark:border-neutral-700 dark:bg-neutral-700">
                                        <div class="inline-block hs-tooltip">
                                            <button type="button" data-hs-overlay="#edit-modal-model"
                                                data-id="{{ $item?->id }}"
                                                class="hs-tooltip-toggle edit-model inline-flex items-center justify-center gap-x-2 rounded-s-md bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="blue"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                                <span
                                                    class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                    role="tooltip">
                                                    Edit
                                                </span>
                                            </button>
                                        </div>
                                        <div class="inline-block hs-tooltip">
                                            <form action="/barang/jadi/model/delete/{{ $item?->id }}" method="post"
                                                data-id="{{ $item?->id }}" style="display: inline-block;">
                                                @csrf
                                                <button type="submit"
                                                    class="hs-tooltip-toggle delete inline-flex items-center justify-center gap-x-2 rounded-e-md bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="crimson"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                    <span
                                                        class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 delete hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                        role="tooltip">
                                                        Hapus
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  akhir aktion model  --}}
                                <div class="col-span-11">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-blue-800">
                                            <tr>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    No.</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Warna</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Jumlah Ambil</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Ongkos</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Tanggal Kembali</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Jumlah Kembali</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Total Ongkos</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-center text-white uppercase">
                                                    Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-purple-500">
                                            @foreach ($warnaModel as $indexWarna => $rowItem)
                                                @php
                                                    $totalKeseluruhanHarga += $rowItem?->total;
                                                @endphp
                                                <tr>
                                                    <td class="px-4 py-2 text-xs text-purple-700">
                                                        {{ $indexWarna + 1 }}.</td>
                                                    <td class="px-4 py-2 text-xs text-purple-700">
                                                        {{ $rowItem?->warna }}</td>
                                                    <td class="px-4 py-2 text-xs">{{ $rowItem?->jumlah_ambil }}
                                                        ({{ $rowItem?->satuan_ambil }})
                                                    </td>
                                                    <td class="px-4 py-2 text-xs">
                                                        {{ formatRupiah($rowItem?->ongkos) }}
                                                        /pcs
                                                    </td>
                                                    @php
                                                        $getCuttingWarnaModel = \App\Models\CuttingKembali::getCuttingWarnaModel(
                                                            $rowItem->id,
                                                        );
                                                    @endphp
                                                    <td class="px-4 py-2 text-xs">
                                                        <input type="datetime-local" name="tanggal_kembali"
                                                            value="{{ $getCuttingWarnaModel?->tanggal_kembali }}"
                                                            data-id="{{ $rowItem->id }}"
                                                            class="block w-full px-2 py-1 text-sm border-gray-200 rounded-lg shadow-sm ps-9 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Cari barang datang">
                                                    </td>
                                                    <td class="px-4 py-2 text-xs">
                                                        <div class="flex items-center">
                                                            <input type="number" name="jumlah_kembali"
                                                                data-id="{{ $rowItem->id }}"
                                                                class="block w-full px-2 py-1 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                                placeholder="Masukan Jumlah Kembali"
                                                                value="{{ $getCuttingWarnaModel?->jumlah_kembali }}">
                                                            <p class="ps-2">(Pcs)</p>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-2 text-xs total_ongkos">
                                                        <span class="kalkulasi-{{ $rowItem?->id }}">{{ formatRupiah($getCuttingWarnaModel?->total_ongkos) }}</span>
                                                    </td>
                                                    <td class="flex items-center justify-center px-4 py-2 text-xs">
                                                        <div class="inline-block hs-tooltip">
                                                            <button type="button" type="button"
                                                                data-hs-overlay="#edit-modal-warna"
                                                                data-id="{{ $rowItem?->id }}"
                                                                class="inline-flex items-center justify-center px-2 py-2 text-sm font-semibold text-gray-800 bg-white border shadow-sm edit-warna hs-tooltip-toggle gap-x-2 rounded-s-md hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="blue" class="w-4 h-4">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>
                                                                <span
                                                                    class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                                    role="tooltip">
                                                                    Edit
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div class="inline-block hs-tooltip">
                                                            <form
                                                                action="/barang/jadi/warna/delete/{{ $rowItem?->id }}"
                                                                method="post" data-id="{{ $rowItem?->id }}"
                                                                style="display: inline-block;">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="inline-flex items-center justify-center px-2 py-2 text-sm font-semibold text-gray-800 bg-white border shadow-sm hs-tooltip-toggle delete gap-x-2 rounded-e-md hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="crimson"
                                                                        class="w-4 h-4">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                    </svg>
                                                                    <span
                                                                        class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 delete hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                                        role="tooltip">
                                                                        Hapus
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                    {{-- <div
                        class="flex flex-col p-4 mb-10 bg-green-600 border border-gray-200 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                        <h2 class="font-bold text-center text-white uppercase">Total keseluruhan harga :
                            {{ formatRupiah($totalKeseluruhanHarga) }}</h2>
                    </div> --}}
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function formatNominal(value) {
                let formattedValue = new Intl.NumberFormat("id-ID").format(value);
                return 'Rp.' + formattedValue;
            }

            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 1200,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });


            $('input[name="tanggal_kembali"]').on('input', function(e) {

                let post_id = $(this).data('id');
                let value = $(this).val();
                $.ajax({
                    url: `/karyawan/cutting/kembali/{{ $karyawan->id }}/${post_id}/store`,
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        tanggal_kembali: value,
                        jumlah_kembali: null,
                    },
                    success: function(response) {
                        console.log(response)
                        $('.kalkulasi-'+ response.warna.id).html(formatNominal(response.kalkulasi));
                        Toast.fire({
                            icon: "success",
                            title: "Berhasil Menyimpan data"
                        });
                    },
                    error: function(xhr) {
                        Toast.fire({
                            icon: "error",
                            title: "Gagal Menyimpan data"
                        });
                    }
                });
            });

            $('input[name="jumlah_kembali"]').on('input', function(e) {

                let post_id = $(this).data('id');
                let value = $(this).val();

                $.ajax({
                    url: `/karyawan/cutting/kembali/{{ $karyawan->id }}/${post_id}/store`,
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        jumlah_kembali: value,
                    },
                    success: function(response) {
                        console.log(response)
                        $('.kalkulasi-'+ response.warna.id).html(formatNominal(response.kalkulasi));
                        Toast.fire({
                            icon: "success",
                            title: "Berhasil Menyimpan data"
                        });
                    },
                    error: function(xhr) {
                        Toast.fire({
                            icon: "error",
                            title: "Gagal Menyimpan data"
                        });
                    }
                });
            });
        });
    </script>
