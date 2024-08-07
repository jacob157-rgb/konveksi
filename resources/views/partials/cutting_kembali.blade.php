<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="inline-block min-w-full p-1.5 align-middle">
            <div
                class="overflow-hidden border divide-y divide-gray-200 rounded-lg dark:divide-neutral-700 dark:border-neutral-700">
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
                            class="inline-flex items-center gap-x-1.5 rounded-lg bg-blue-100 px-3 py-1.5 text-xs font-medium text-blue-800">No.
                            {{ $loop->iteration }}
                        </span>
                        {{ \Carbon\Carbon::parse($row?->tanggal_ambil)?->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i:s') }}

                    </div>
                    @foreach ($cutingModel as $item)
                        @php
                            $warnaModel = \App\Models\CuttingWarnaModel::ambilModel($item?->id);
                        @endphp
                        <ul class="container mx-auto divide-y divide-gray-400 divide-dotted"
                            style="font-family: Raleway">
                            <li class="grid items-center w-full grid-cols-12 gap-2 py-2 overflow-x-auto">
                                <div
                                    class="flex flex-col items-center justify-center p-2 text-xs font-semibold text-orange-800 bg-orange-100 rounded-lg w-fit justify-self-center whitespace-nowrap">
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
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Status</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-purple-500">
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
                                                            class="{{ !$getCuttingWarnaModel?->tanggal_kembali ? 'border-2 border-red-600' : ' border-1 border-green-500' }} block w-full rounded px-2 py-1 ps-9 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Cari barang datang">
                                                    </td>
                                                    <td class="px-4 py-2 text-xs">
                                                        <div class="flex items-center">
                                                            <input type="number" name="jumlah_kembali"
                                                                data-id="{{ $rowItem->id }}"
                                                                class="{{ !$getCuttingWarnaModel?->jumlah_kembali ? 'border-2 border-red-600' : ' border-1 border-green-500' }} block w-full rounded px-2 py-1 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
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
                                                    @php
                                                        $getGajiByWarna = App\Models\Gaji::getGajiByWarna(
                                                            $getCuttingWarnaModel?->id,
                                                        );
                                                    @endphp
                                                    <td>
                                                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-500 text-white text-nowrap">{{$getGajiByWarna?->status ?? 'Belum mengembalikan'}}</span>
                                                    </td>
                                                    <td>
                                                        @if ($getGajiByWarna?->id)
                                                            <button type="button" data-id="{{ $getGajiByWarna?->id }}"
                                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg bayar gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                                Bayar
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                    @php
                        $BonCutting = App\Models\Bon::getBonCutting($karyawan->id, $row->id);
                        $GajiCutting = App\Models\Gaji::getGajiCutting($karyawan->id, $row->id);
                    @endphp
                    <div
                        class="{{ $totalKeseluruhanHarga == 0 ? 'bg-red-100 text-red-800' : 'bg-teal-100 text-teal-800' }} mb-5 flex flex-col border border-gray-200 p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                        <h2 class="font-bold uppercase">Total keseluruhan Ongkos :
                            {{ formatRupiah($totalKeseluruhanHarga) }}</h2>
                        @if ($GajiCutting['paid'] != 0)
                            <h2 class="font-bold uppercase">Total Ongkos Terbayarkan:
                                {{ formatRupiah($GajiCutting['paid']) }}</h2>
                        @endif
                        @if ($GajiCutting['unpaid'] != 0)
                            <h2 class="font-bold uppercase">Total Ongkos Belum Terbayarkan:
                                {{ formatRupiah($GajiCutting['unpaid']-$GajiCutting['paid']) }}</h2>
                        @endif
                        @if ($BonCutting['sum'] != 0)
                            <h2 class="font-bold uppercase">Total keseluruhan Bon :
                                {{ formatRupiah($BonCutting['sum']) }}</h2>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="bayar-modal"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden"
        role="dialog" tabindex="-1" aria-labelledby="bayar-modal-label">
        <div
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-animation-target hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 id="bayar-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Bayar Ongkos
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:bg-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#bayar-modal">
                        <span class="sr-only">Close</span>
                        <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/karyawan/cutting/gaji/status" method="post">
                    @csrf
                    <div class="p-4 overflow-y-auto">
                        <input type="hidden" name="bayar_id" id="bayar_id">
                        <label for="nominal_bayar" class="block mb-2 text-sm font-medium dark:text-white">Nominal
                            Bayar</label>
                        <div class="relative rounded-md">
                            <input type="text" name="nominal_bayar"
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <input type="hidden" id="nominal">
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                        <label for="nominal_bayar" class="block mb-2 text-sm font-medium dark:text-white">Status
                            Bayar</label>
                        <select name="status"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option selected="" value="">Pilih Status Bayar</option>
                            <option value="lunas">Lunas</option>
                            <option value="terbayarkan">Terbayarkan</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#bayar-modal">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                            Simpan
                        </button>
                    </div>
                </form>
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

            $(document).on('click', '.bayar', function(e) {
                let bayar_id = $(this).data('id');
                $('#bayar_id').val(bayar_id);
                HSOverlay.open('#bayar-modal');
            });
        </script>
