<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="inline-block min-w-full p-1.5 align-middle">
            <div class="divide-y divide-gray-200 rounded-lg border dark:divide-neutral-700 dark:border-neutral-700">
                <div class="px-4 py-3">
                    <form class="relative max-w-xs">
                        <label class="sr-only">Search</label>
                        <input type="hidden" name="barang" value="kirim">
                        <input type="date" name="date" value="{{ request()?->query('date') }}"
                            class="block w-full rounded-lg border-gray-200 px-3 py-2 ps-9 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Cari barang datang">
                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                            <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </svg>
                        </div>
                    </form>
                </div>
                @if (request()?->query('date'))
                    <div class="flex items-center space-x-2 p-4">
                        <span class="text-lg font-semibold text-gray-700 dark:text-neutral-300">Menampilkan pada
                            hari:</span>
                        <span class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                            {{ \Carbon\Carbon::parse(request()?->query('date'))?->translatedFormat('l, d F Y') }}
                        </span>
                        <a href="?barang=kirim"
                            class="hover:text-danger-700 flex items-center rounded-lg border border-transparent text-sm font-medium disabled:pointer-events-none disabled:opacity-50">
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

                @foreach ($jahitAmbil as $row)
                    @php
                        $totalKeseluruhanHarga = 0;
                    @endphp
                    @php
                        $jahitModel = \App\Models\JahitAmbilModel::getReturnNull($row?->id);
                    @endphp
                    <div
                        class="mx-8 mb-2 flex flex-row items-center justify-between whitespace-nowrap rounded-lg bg-blue-500 px-4 py-2 text-xs font-semibold text-white">
                        <span
                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-xs font-medium bg-blue-100 text-blue-800">No. {{ $loop->iteration }}
                        </span>
                        {{ \Carbon\Carbon::parse($row?->tanggal_ambil)?->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i:s') }}

                    </div>
                    @foreach ($jahitModel as $item)
                        @php
                            $warnaModel = \App\Models\JahitWarnaModel::ambilModel($item?->id);
                        @endphp
                        <ul class="container mx-auto divide-y divide-dotted divide-gray-400"
                            style="font-family: Raleway">
                            <li class="grid w-full grid-cols-12 items-center gap-2 py-2">
                                <div
                                    class="flex w-fit flex-col items-center justify-center justify-self-center whitespace-nowrap rounded-lg bg-orange-100 text-orange-800  p-2 text-xs font-semibold ">
                                    {{ $item?->model }}
                                </div>
                                <div class="col-span-11">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-blue-900">
                                            <tr>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-white">
                                                    No.</th>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-white">
                                                    Warna</th>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-white">
                                                    Jumlah Ambil</th>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-white">
                                                    Ongkos</th>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-white">
                                                    Tanggal Kembali</th>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-white">
                                                    Jumlah Kembali</th>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-white">
                                                    Total Ongkos</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-purple-500 bg-white">
                                            @foreach ($warnaModel as $indexWarna => $rowItem)
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
                                                        $getJahitWarnaModel = \App\Models\JahitKembali::getJahitWarnaModel(
                                                            $rowItem->id,
                                                        );
                                                        $totalKeseluruhanHarga += $getJahitWarnaModel?->total_ongkos;
                                                    @endphp
                                                    <td class="px-4 py-2 text-xs">
                                                        <input type="datetime-local" name="tanggal_kembali"
                                                            value="{{ $getJahitWarnaModel?->tanggal_kembali }}"
                                                            data-id="{{ $rowItem->id }}"
                                                            class="block w-full rounded {{ !$getJahitWarnaModel->tanggal_kembali ? 'border-2 border-red-600' : ' border-1 border-green-500' }} px-2 py-1 ps-9 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Cari barang datang">
                                                    </td>
                                                    <td class="px-4 py-2 text-xs">
                                                        <div class="flex items-center">
                                                            <input type="number" name="jumlah_kembali"
                                                                data-id="{{ $rowItem->id }}"
                                                                class="block w-full rounded {{ !$getJahitWarnaModel->tanggal_kembali ? 'border-2 border-red-600' : ' border-1 border-green-500' }} px-2 py-1 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                                placeholder="Masukan Jumlah Kembali"
                                                                value="{{ $getJahitWarnaModel?->jumlah_kembali }}">
                                                            <p class="ps-2">(Pcs)</p>
                                                        </div>
                                                    </td>
                                                    <td class="total_ongkos px-4 py-2 text-xs">
                                                        <span
                                                            class="kalkulasi-{{ $rowItem?->id }}">{{ formatRupiah($getJahitWarnaModel?->total_ongkos) }}</span>
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
                        class="flex flex-col p-4 mb-10 {{ $totalKeseluruhanHarga == 0 ? 'bg-red-100 text-red-800' : 'bg-teal-100 text-teal-800'  }}  border border-gray-200 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                        <h2 class="font-bold text-center  uppercase">Total keseluruhan ongkos :
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
                    url: `/karyawan/jahit/kembali/{{ $karyawan->id }}/${post_id}/store`,
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
                    url: `/karyawan/jahit/kembali/{{ $karyawan->id }}/${post_id}/store`,
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        jumlah_kembali: value,
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
        });
    </script>
