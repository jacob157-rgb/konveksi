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
                            class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 ps-9 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
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
                        class="flex flex-row items-center justify-between p-2 mx-4 mb-2 text-xs font-semibold text-white bg-blue-500 rounded-lg whitespace-nowrap">
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
                            <li class="grid items-center w-full grid-cols-12 gap-2 py-2 mx-4 overflow-x-auto">
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
                                                    class="px-1 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Jumlah Kembali</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Total Ongkos</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-center text-white uppercase">
                                                    Status Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-purple-500">
                                            @foreach ($warnaModel as $indexWarna => $rowItem)
                                                <tr>
                                                    <td class="px-4 py-2 text-xs text-purple-700">
                                                        {{ $indexWarna + 1 }}.</td>
                                                    <td class="px-4 py-2 text-xs text-purple-700">
                                                        {{ $rowItem?->warna }}</td>
                                                    <td class="px-4 py-2 text-xs text-nowrap">
                                                        {{ $rowItem?->jumlah_ambil }}
                                                        ({{ $rowItem?->satuan_ambil }})
                                                    </td>
                                                    <td class="px-4 py-2 text-xs text-nowrap">
                                                        {{ formatRupiah($rowItem?->ongkos) }}
                                                        / {{ $rowItem?->satuan_ambil }}
                                                    </td>
                                                    @php
                                                        $isitReturn = \App\Models\CuttingKembali::isitReturn(
                                                            $rowItem?->id,
                                                        );
                                                    @endphp
                                                    @if ($isitReturn == null)
                                                        <td colspan="2">
                                                            <div class="flex items-center justify-center py-2">
                                                                <button data-id="{{ $rowItem->id }}"
                                                                    data-ongkos="{{ formatNominal($rowItem->ongkos) }}"
                                                                    class="text-nowrap kembaliBtn inline-flex items-center gap-x-1.5 rounded-full bg-red-500 px-3 py-1.5 text-xs font-medium text-white">Belum
                                                                    Dikembalikan</button>
                                                            </div>
                                                        </td>
                                                    @else
                                                        @php
                                                            $getCuttingWarnaModel = \App\Models\CuttingKembali::getCuttingWarnaModel(
                                                                $rowItem->id,
                                                            );
                                                            $totalKeseluruhanHarga +=
                                                                $getCuttingWarnaModel?->total_ongkos;
                                                            $getGajiByWarna = App\Models\Gaji::getGajiByWarna(
                                                                $getCuttingWarnaModel?->id,
                                                            );
                                                        @endphp
                                                        <td class="px-4 py-2 text-xs">
                                                            {{ $getCuttingWarnaModel?->tanggal_kembali }}
                                                        </td>
                                                        <td class="px-1 py-2 text-xs">
                                                            {{ $getCuttingWarnaModel?->jumlah_kembali }}
                                                            ({{ $getCuttingWarnaModel?->satuan_kembali }})
                                                        </td>
                                                        <td class="px-4 py-2 text-xs total_ongkos">
                                                            {{ formatRupiah($getCuttingWarnaModel?->total_ongkos) }}
                                                        </td>
                                                        <td class="text-center">
                                                            <div
                                                                class="flex items-center justify-center py-2 hs-tooltip">
                                                                <button
                                                                    @if ($getGajiByWarna?->status == 'belum terbayarkan' || $getGajiByWarna?->status === 'terbayarkan') data-id="{{ $getGajiByWarna?->id }}"
                                                                        data-ongkos="{{ formatNominal($getGajiByWarna?->nominal_belum_terbayarkan) }}" @endif
                                                                    class="{{ $getGajiByWarna?->status === 'lunas' ? 'bg-green-500' : ($getGajiByWarna?->status === 'belum terbayarkan' ? 'bg-red-500 bayarBtn' : 'bg-yellow-500 bayarBtn') }} hs-tooltip-toggle text-nowrap inline-flex items-center gap-x-1.5 rounded-full px-3 py-1.5 text-xs font-medium text-white">
                                                                    {{ $getGajiByWarna?->status }}
                                                                    @if ($getGajiByWarna->nominal_belum_terbayarkan > 0)
                                                                        <span role="tooltip"
                                                                            class="absolute z-10 invisible inline-block px-2 py-1 text-white transition-opacity bg-gray-900 rounded-md opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100">
                                                                            {{ formatRupiah($getGajiByWarna->nominal_belum_terbayarkan) }}
                                                                            Belum Terbayarkan</span>
                                                                    @endif
                                                                </button>
                                                            </div>
                                                        </td>
                                                    @endif
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
                        class="{{ $totalKeseluruhanHarga == 0 ? 'bg-red-100 text-red-800' : 'bg-teal-100 text-teal-800' }} dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 mb-5 grid grid-cols-2 border border-gray-200 p-4 shadow-sm md:p-5">
                        <div>
                            <h2 class="font-bold uppercase">Total Ongkos Terbayarkan :
                                {{ formatRupiah($GajiCutting['paid']) }}</h2>
                            <h2 class="font-bold uppercase">Total Ongkos Belum Terbayarkan :
                                @if ($GajiCutting['unpaid'] == 0)
                                    LUNAS
                                @else
                                    {{ formatRupiah($GajiCutting['unpaid']) }}
                                @endif
                            </h2>
                            <h2 class="font-bold uppercase">Total Ongkos keseluruhan :
                                {{ formatRupiah($GajiCutting['sum']) }}</h2>
                        </div>
                        <div>
                            <h2 class="font-bold uppercase">Total Bon Terbayarkan :
                                {{ formatRupiah($BonCutting['paid']) }}</h2>
                            <h2 class="font-bold uppercase">Total Bon Belum Terbayarkan :
                                @if ($BonCutting['unpaid'] == 0)
                                    LUNAS
                                @else
                                    {{ formatRupiah($BonCutting['unpaid']) }}
                                @endif
                            </h2>
                            <h2 class="font-bold uppercase">Total Bon keseluruhan :
                                {{ formatRupiah($BonCutting['sum']) }}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('partials.kembali_modal')

    <script>
        function getCurrentDateTime() {
            const now = new Date();
            const options = {
                timeZone: "Asia/Jakarta",
                year: "numeric",
                month: "2-digit",
                day: "2-digit",
                hour: "2-digit",
                minute: "2-digit",
                hour12: false,
            };
            const formatter = new Intl.DateTimeFormat("en-GB", options);
            const formattedDate = formatter.format(now).split(", ");
            const [day, month, year] = formattedDate[0].split("/");
            const [hour, minute] = formattedDate[1].split(":");
            return `${year}-${month}-${day}T${hour}:${minute}`;
        }
        $(document).ready(function() {
            $('input[name="date"]').on('change', function() {
                $(this).closest('form').submit();
            });

            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });


            $(document).on('click', '.kembaliBtn', function(e) {
                e.preventDefault();
                let post_id = $(this).data('id');
                let dataOngkos = $(this).data('ongkos');
                let modalTitle = '';
                let modalContent = '';

                if ($(this).hasClass('kembaliBtn')) {
                    postUrl = `/karyawan/cutting/kembali/{{ $karyawan->id }}/${post_id}/store`;
                    modalTitle = 'Pengembalian Cutting';
                    modalContent = `
                    <label for="tanggal_kembali" class="block mb-2 text-sm font-medium dark:text-white">Tanggal Kembali</label>
                    <input type="datetime-local" id="tanggal_kembali" name="tanggal_kembali"
                        value="${getCurrentDateTime()}"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 focus:border-blue-500 focus:ring-blue-500"
                        autofocus="" required>
                    <div class="space-y-2 value-container">
                        <label for="hs-inline-leading-pricing-select-label"
                            class="block mb-2 text-sm font-medium dark:text-white">Jml.
                            Barang Kembali</label>
                        <div class="relative">
                            <input type="number" required id="hs-inline-leading-pricing-select-label" name="jumlah_kembali"
                                class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg shadow-sm jumlah dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-20 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                                placeholder="Masukan Jumlah Barang">
                            <div class="absolute inset-y-0 flex items-center text-gray-500 end-0 pe-px">
                                <label for="satuan" class="sr-only">Satuan</label>
                                <select id="satuan" name="satuan_kembali"
                                    class="block w-full border border-transparent rounded-lg dark:bg-neutral-800 dark:text-neutral-500 focus:border-blue-600 focus:ring-blue-600">
                                    <option value="pcs" selected>Pcs</option>
                                </select>
                            </div>
                        </div>
                        <label for="harga" class="block mb-2 text-sm font-medium dark:text-white">Ongkos
                            Satuan</label>
                        <div class="relative rounded-md">
                            <input type="text" readonly name="" id="ongkos_satuan"
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50">
                            <input type="hidden" id="nominal">
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                        <label for="total" class="block mb-2 text-sm font-medium dark:text-white">
                            Total
                            Ongkos</label>
                        <div class="relative rounded-md">
                            <input type="text" readonly name="" id="total_ongkos"
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm total price dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50">
                            <input type="hidden" id="total" readonly>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                    </div>
                    <label for="hs-checkbox-in-form" class="flex w-full p-3 text-sm bg-white border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        <input id="hs-checkbox-in-form" name="lbayar" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                        <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Langsung Bayar?</span>
                    </label>
                    <div id="nominal-bayar-section" class="space-y-2"></div>
                `;

                    $('#modal-title').text(modalTitle);
                    $('#modal-form').attr('action', postUrl);
                    $('#modal-content').html(modalContent);
                    $('#post_id').val(post_id);
                    $('#ongkos_satuan').val(dataOngkos);
                    HSOverlay.open('#kembali-modal');

                    // Checkbox functionality
                    $('#hs-checkbox-in-form').on('change', function() {
                        if ($(this).is(':checked')) {
                            $('#nominal-bayar-section').html(`
                        <label for="nominal_bayar" class="block mb-2 text-sm font-medium dark:text-white">Nominal Bayar</label>
                        <div class="flex space-x-2">
                            <div class="relative w-9/12 rounded-md">
                                <input type="text" name="nominal_bayar" id="nominal_bayar"
                                    class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50">
                                <input type="hidden" id="nominal">
                                <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                    <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                                </div>
                                <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                    <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                                </div>
                            </div>
                            <label for="hs-checkbox-in-form-all-in" class="flex w-3/12 p-3 text-sm bg-white border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                <input id="hs-checkbox-in-form-all-in" name="allbayar" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Semua?</span>
                            </label>
                        </div>
                        <label for="hs-checkbox-in-bon" class="flex w-full p-3 text-sm bg-white border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                            <input id="hs-checkbox-in-bon" name="bbon" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                            <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Bayar Bon?</span>
                        </label>
                        <div id="nominal-bon-section" class="space-y-2"></div>
                    `);
                            $('#hs-checkbox-in-form-all-in').on('change', function() {
                                if ($(this).is(':checked')) {
                                    let totalOngkos = $('#total_ongkos').val();
                                    $('#nominal_bayar').val(totalOngkos);
                                } else {
                                    $('#nominal_bayar').val('');
                                }
                            });
                            $('#hs-checkbox-in-bon').on('change', function() {
                                if ($(this).is(':checked')) {
                                    $('#nominal-bon-section').html(`
                                        <label for="nominal_bayar_bon" class="block mb-2 text-sm font-medium dark:text-white">Nominal Bayar Bon</label>
                                        <div class="flex space-x-2">
                                            <div class="relative w-9/12 rounded-md">
                                                <input type="text" name="nominal_bayar_bon" id="nominal_bayar_bon"
                                                    class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50">
                                                <input type="hidden" id="nominal">
                                                <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                                    <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                                                </div>
                                                <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                                    <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                                                </div>
                                            </div>
                                            <label for="hs-checkbox-in-bon-all-in" class="flex w-3/12 p-3 text-sm bg-white border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <input id="hs-checkbox-in-bon-all-in" name="allbon" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Semua?</span>
                                            </label>
                                        </div>
                                    `);
                                    $('#hs-checkbox-in-bon-all-in').on('change',
                                        function() {
                                            if ($(this).is(':checked')) {
                                                let totalOngkos = $('#total_ongkos')
                                                    .val();
                                                $('#nominal_bayar_bon').val(
                                                    totalOngkos);
                                            } else {
                                                $('#nominal_bayar_bon').val('');
                                            }
                                        });
                                } else {
                                    $('#nominal-bon-section').html('');
                                }
                            });
                        } else {
                            $('#nominal-bayar-section').html('');
                        }
                    });
                }
            });

            $(document).on('click', '.bayarBtn', function(e) {
                e.preventDefault();
                let post_id = $(this).data('id');
                let dataOngkos = $(this).data('ongkos');

                postUrl = `/karyawan/cutting/gaji/status`;
                modalTitle = 'Bayar Sisa Gaji';
                modalContent = `
        <label for="nominal_bayar_gaji" class="block mb-2 text-sm font-medium dark:text-white">Nominal Bayar</label>
        <div class="flex space-x-2">
            <div class="relative w-9/12 rounded-md">
                <input type="text" name="nominal_bayar_gaji" id="nominal_bayar_gaji"
                    class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50">
                <input type="hidden" id="nominal">
                <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                    <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                </div>
                <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                    <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                </div>
            </div>
            <label for="hs-checkbox-in-form-bayar-in" class="flex w-3/12 p-3 text-sm bg-white border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <input id="hs-checkbox-in-form-bayar-in" name="allbayar" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Semua?</span>
            </label>
        </div>`;

                $('#modal-title').text(modalTitle);
                $('#modal-form').attr('action', postUrl);
                $('#modal-content').html(modalContent);
                $('#post_id').val(post_id);

                // Open the modal after setting the content
                HSOverlay.open('#kembali-modal');

                // Attach event handler after modal content is rendered
                $(document).on('change', '#hs-checkbox-in-form-bayar-in', function() {
                    if ($(this).is(':checked')) {
                        $('#nominal_bayar_gaji').val(dataOngkos);
                    } else {
                        $('#nominal_bayar_gaji').val('');
                    }
                });
            });

            $(document).on('submit', '#modal-form', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success && Array.isArray(response.success)) {
                            response.success.forEach(function(message, index) {
                                setTimeout(function() {
                                    Toast.fire({
                                        icon: "success",
                                        title: message
                                    });
                                }, index * 2000);
                            });

                            setTimeout(function() {
                                    location
                                        .reload();
                                }, response.success.length *
                                2000);
                        } else {
                            Toast.fire({
                                icon: "success",
                                title: "Berhasil Menyimpan data"
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }

                        HSOverlay.close('#kembali-modal');
                    },
                    error: function(xhr) {
                        let errorMessage = "Gagal Menyimpan data";

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors).map(function(
                                value) {
                                return value.join(', ');
                            }).join('<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Toast.fire({
                            icon: "error",
                            title: errorMessage
                        });
                    }
                });
            });
        });
    </script>
