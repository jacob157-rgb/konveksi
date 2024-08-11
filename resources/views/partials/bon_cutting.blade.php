@php
    $bonAlls = App\Models\Bon::getAllCutting($karyawan->id);
@endphp
<div class="flex flex-col mt-2">
    <div class="-m-1.5 overflow-x-auto">
        <div class="inline-block min-w-full p-1.5 align-middle">
            <div class="border divide-y divide-gray-200 rounded-lg dark:border-neutral-700 dark:divide-neutral-700">
                <div class="flex items-center justify-between px-5 py-3">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Tabel Bon</h2>
                    <div class="space-y-2">
                        <form action="" id="BonlunasForm">
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5 mt-1">
                                    <input id="checkbox-bon" name="bon"
                                        value="{{ request()->query('bon') == 'true' ? 'false' : 'true' }}"
                                        type="checkbox"
                                        class="text-blue-600 border-gray-200 rounded bon dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                                        aria-describedby="checkbox-bon-description"
                                        {{ request()->query('bon') ? 'checked' : '' }}>
                                </div>
                                <label for="checkbox-bon" class="ms-3">
                                    <span
                                        class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">Tampilkan
                                        Lunas?</span>
                                    <span id="checkbox-bon-description"
                                        class="block text-sm text-gray-600 dark:text-neutral-500">Centang untuk
                                        menampilkan yang sudah lunas.</span>
                                </label>
                            </div>
                        </form>
                        <form class="relative w-full" id="dateFormBon" method="GET" action="">
                            <label class="sr-only">Search</label>
                            <input type="text" id="datepickerBon" name="bonDays" autocomplete="off"
                                value="{{ request()?->query('bonDays') }}"
                                class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm date dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 ps-9 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                                placeholder="Pilih Tanggal">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                <svg class="text-gray-400 size-4 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-calendar-days">
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                    <path d="M3 10h18" />
                                    <path d="M8 14h.01" />
                                    <path d="M12 14h.01" />
                                    <path d="M16 14h.01" />
                                    <path d="M8 18h.01" />
                                    <path d="M12 18h.01" />
                                    <path d="M16 18h.01" />
                                </svg>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="dark:bg-neutral-700 bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                    No.</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                    Tanggal</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                    Nominal</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                    Nominal Terbayarkan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                    Nominal Belum Terbayarkan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase dark:text-neutral-500">
                                    Status</th>
                            </tr>
                        </thead>
                        @php
                            $nominal = 0;
                            $nominal_terbayarkan = 0;
                            $nominal_belum_terbayarkan = 0;
                        @endphp
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach ($bonAlls['listData'] as $row)
                                @php
                                    $nominal += $row->nominal;
                                    $nominal_terbayarkan += $row->nominal_terbayarkan;
                                    $nominal_belum_terbayarkan += $row->nominal_belum_terbayarkan;
                                @endphp
                                <tr>
                                    <td
                                        class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('l, d F Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                        {{ formatRupiah($row->nominal) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                        {{ formatRupiah($row->nominal_terbayarkan) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                        {{ formatRupiah($row->nominal_belum_terbayarkan) }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                        <button
                                            @if ($row->status != 'lunas') data-id="{{ $row->id }}" data-bon="{{ formatNominal($row->nominal_belum_terbayarkan) }}" @endif
                                            class="{{ $row?->status === 'lunas' ? 'bg-green-500' : ($row?->status === 'belum terbayarkan' ? 'bg-red-500 bonBtn' : 'bg-yellow-500 bonBtn') }} hs-tooltip-toggle text-nowrap inline-flex items-center gap-x-1.5 rounded-full px-3 py-1.5 text-xs font-medium capitalize text-white">
                                            {{ $row?->status }}
                                            @if ($row->nominal_belum_terbayarkan > 0)
                                                <span role="tooltip"
                                                    class="absolute z-10 invisible inline-block px-2 py-1 text-white transition-opacity bg-gray-900 rounded-md opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100">
                                                    {{ formatRupiah($row->nominal_belum_terbayarkan) }}
                                                    Belum Terbayarkan
                                                </span>
                                            @endif
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"
                                    class="px-6 py-4 text-sm font-medium text-center text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                    <strong>TOTAL : </strong>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                    {{ formatRupiah($nominal) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                    {{ formatRupiah($nominal_terbayarkan) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                    @if ($nominal_belum_terbayarkan == 0)
                                        <div>
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-teal-800 bg-teal-100 rounded-full dark:bg-teal-500/10 dark:text-teal-500 gap-x-1">
                                                <svg class="size-3 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                                    </path>
                                                    <path d="m9 12 2 2 4-4"></path>
                                                </svg>
                                                Lunas
                                            </span>
                                        </div>
                                    @else
                                        {{ formatRupiah($nominal_belum_terbayarkan) }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                    <button type="button" id="bayarSemuaButton"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">Bayar
                                        Semua</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
