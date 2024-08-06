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
                        <span
                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-xs font-medium bg-blue-100 text-blue-800">No. {{ $loop->iteration }}
                        </span>
                        {{ \Carbon\Carbon::parse($row?->tanggal_ambil)?->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i:s') }}

                    </div>
                    @foreach ($cutingModel as $item)
                        @php
                            $warnaModel = \App\Models\CuttingWarnaModel::ambilModel($item?->id);
                        @endphp
                        <ul class="container mx-auto divide-y divide-gray-400 divide-dotted"
                            style="font-family: Raleway">
                            <li class="grid items-center w-full grid-cols-12 gap-2 py-2">
                                <div
                                    class="flex flex-col items-center justify-center p-2 text-xs font-semibold  bg-orange-100 text-orange-800 rounded-lg w-fit justify-self-center whitespace-nowrap">
                                    {{ $item?->model }}

                                </div>
                                <div class="col-span-11">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-blue-900">
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

                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-purple-500">
                                            @foreach ($warnaModel as $indexWarna => $rowItem)
                                                <tr>
                                                    <td class="px-4 py-2 text-xs text-purple-700 ">
                                                        {{ $indexWarna + 1 }}.</td>
                                                    <td class="px-4 py-2 text-xs text-purple-700">
                                                        {{ $rowItem?->warna }}</td>
                                                    <td class="px-4 py-2 text-xs">{{ $rowItem?->jumlah_ambil }}
                                                        ({{ $rowItem?->satuan_ambil }})
                                                    </td>
                                                    <td class="px-4 py-2 text-xs">
                                                        {{ formatRupiah($rowItem?->ongkos) }}
                                                        / {{ $rowItem?->satuan_ambil }}
                                                    </td>
                                                    @php
                                                        $getCuttingWarnaModel = \App\Models\CuttingKembali::getCuttingWarnaModel(
                                                            $rowItem->id,
                                                        );
                                                        $totalKeseluruhanHarga += $getCuttingWarnaModel?->total_ongkos;
                                                    @endphp
                                                    <td class="px-4 py-2 text-xs">
                                                        <input type="datetime-local" name="tanggal_kembali"
                                                            value="{{ $getCuttingWarnaModel?->tanggal_kembali }}"
                                                            data-id="{{ $rowItem->id }}"
                                                            class="block w-full px-2 py-1 text-sm {{ !$getCuttingWarnaModel->tanggal_kembali ? 'border-2 border-red-600' : ' border-1 border-green-500' }} rounded shadow-sm ps-9 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Cari barang datang">
                                                    </td>
                                                    <td class="px-4 py-2 text-xs">
                                                        <div class="flex items-center">
                                                            <input type="number" name="jumlah_kembali"
                                                                data-id="{{ $rowItem->id }}"
                                                                class="block w-full px-2 py-1 text-sm {{ !$getCuttingWarnaModel->jumlah_kembali ? 'border-2 border-red-600' : ' border-1 border-green-500' }} rounded focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                                placeholder="Masukan Jumlah Kembali"
                                                                value="{{ $getCuttingWarnaModel?->jumlah_kembali }}">
                                                            <p class="ps-2">
                                                                ({{ $getCuttingWarnaModel?->satuan_kembali }})</p>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-2 text-xs total_ongkos">
                                                        <span
                                                            class="kalkulasi-{{ $rowItem?->id }}">{{ formatRupiah($getCuttingWarnaModel?->total_ongkos) }}</span>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                    <div
                        class="flex flex-col p-4 mb-10 {{ $totalKeseluruhanHarga == 0 ? 'bg-red-100 text-red-800' : 'bg-teal-100 text-teal-800' }}  border border-gray-200 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                        <h2 class="font-bold text-center  uppercase">Total keseluruhan harga :
                            {{ formatRupiah($totalKeseluruhanHarga) }}</h2>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('input[name="date"]').on('change', function() {
                $(this).closest('form').submit();
            });

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
                        $('.kalkulasi-' + response.warna.id).html(formatNominal(response
                            .kalkulasi));
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
                        $('.kalkulasi-' + response.warna.id).html(formatNominal(response
                            .kalkulasi));
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
