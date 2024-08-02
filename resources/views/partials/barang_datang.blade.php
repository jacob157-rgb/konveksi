<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="inline-block min-w-full p-1.5 align-middle">
            <div class="border divide-y divide-gray-200 rounded-lg dark:divide-neutral-700 dark:border-neutral-700">
                <div class="px-4 py-3">
                    <form class="relative max-w-xs">
                        <label class="sr-only">Search</label>
                        <input type="hidden" name="barang" value="datang">
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
                        <a href="?barang=datang"
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

                @foreach ($barangMentah as $row)
                    @php
                        $totalKeseluruhanHarga = 0;
                    @endphp
                    @php
                        $modelBarangMentah = \App\Models\KainBarangMentah::getByBarangMentah($row?->id);
                    @endphp
                    <div
                        class="flex flex-row items-center justify-between px-4 py-2 mx-8 mb-2 text-xs font-semibold text-white bg-blue-500 rounded-lg whitespace-nowrap">
                        Tanggal:
                        {{ \Carbon\Carbon::parse($row?->tanggal_datang)?->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i:s') }}

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
                                <form action="/barang/mentah/delete/{{ $row?->id }}" method="post"
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
                    @foreach ($modelBarangMentah as $item)
                        @php
                            $warnaKain = \App\Models\WarnaKain::getByWarnaKain($item?->id);
                        @endphp
                        <ul class="container mx-auto divide-y divide-gray-400 divide-dotted"
                            style="font-family: Raleway">
                            <li class="grid items-center w-full grid-cols-12 gap-2 py-2">
                                <div
                                    class="flex flex-col items-center justify-center p-2 text-xs font-semibold text-white bg-pink-500 rounded-lg w-fit justify-self-center whitespace-nowrap">
                                    {{ $item?->kain }}
                                    {{-- Awal action kain --}}
                                    <div
                                        class="inline-flex items-center mt-1 transition-all bg-white border border-gray-300 divide-x divide-gray-300 rounded-lg shadow-sm group dark:divide-neutral-700 dark:border-neutral-700 dark:bg-neutral-700">
                                        <div class="inline-block hs-tooltip">
                                            <button type="button" data-hs-overlay="#edit-modal-kain"
                                                data-id="{{ $item?->id }}"
                                                class="hs-tooltip-toggle edit-kain inline-flex items-center justify-center gap-x-2 rounded-s-md bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
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
                                            <form action="/barang/mentah/kain/delete/{{ $item?->id }}" method="post"
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
                                {{--  akhir aktion kain  --}}
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
                                                    Jumlah Barang</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Harga</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-white uppercase">
                                                    Total Harga</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium tracking-wider text-center text-white uppercase">
                                                    Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-purple-500">
                                            @foreach ($warnaKain as $indexWarna => $rowItem)
                                                @php
                                                    $totalKeseluruhanHarga += $rowItem?->total;
                                                @endphp
                                                <tr>
                                                    <td class="px-4 py-2 text-xs text-purple-700">
                                                        {{ $indexWarna + 1 }}.</td>
                                                    <td class="px-4 py-2 text-xs text-purple-700">
                                                        {{ $rowItem?->warna }}</td>
                                                    <td class="px-4 py-2 text-xs">{{ $rowItem?->jumlah }}
                                                        ({{ $rowItem?->satuan }})
                                                    </td>
                                                    <td class="px-4 py-2 text-xs">{{ formatRupiah($rowItem?->harga) }}
                                                        /{{ $rowItem?->satuan }}
                                                    </td>
                                                    <td class="px-4 py-2 text-xs">{{ formatRupiah($rowItem?->total) }}
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
                                                                action="/barang/mentah/warna/delete/{{ $rowItem?->id }}"
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
                    <div
                        class="flex flex-col mb-10 p-4 bg-green-600 border border-gray-200  shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                        <h2 class="font-bold text-center text-white uppercase">Total keseluruhan harga :
                            {{ formatRupiah($totalKeseluruhanHarga) }}</h2>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="edit-modal"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden"
        role="dialog" tabindex="-1" aria-labelledby="edit-modal">
        <div
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-animation-target hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 id="modal-title" class="font-bold text-gray-800 dark:text-white">Modal title</h3>
                    <button type="button"
                        class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:bg-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#edit-modal">
                        <span class="sr-only">Close</span>
                        <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="edit-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-4 overflow-y-auto">
                        <input type="hidden" name="id" id="edit-id">
                        <div id="edit-content">

                        </div>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#edit-modal">Batal</button>
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('input[name="date"]').on('change', function() {
                $(this).closest('form').submit();
            });
        });

        $(document).on('click', '.edit-tanggal, .edit-warna, .edit-kain', function(e) {
            e.preventDefault(); // Prevent default action
            let post_id = $(this).data('id');
            let url = '';
            let modalTitle = '';
            let editContent = '';

            if ($(this).hasClass('edit-tanggal')) {
                url = `/barang/mentah/edit/${post_id}`;
                postUrl = `/barang/mentah/update`;
                modalTitle = 'Edit Tanggal';
                editContent = `
                    <label for="tanggal_datang" class="block mb-2 text-sm font-medium dark:text-white">Tanggal Kirim</label>
                    <input type="datetime-local" id="tanggal_datang" name="tanggal_datang"
                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500">
                `;
            } else if ($(this).hasClass('edit-warna')) {
                url = `/barang/mentah/warna/edit/${post_id}`;
                postUrl = `/barang/mentah/warna/update`;
                modalTitle = 'Edit Warna';
                editContent = `
                    <label for="warna_id" class="block mb-2 text-sm font-medium dark:text-white">Warna</label>
                    <select name="warna" id="warna"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        @foreach ($warna as $row)
                            <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                        @endforeach
                    </select>
                    <div class="value-container">
                        <label for="jumlah"
                            class="block mb-2 text-sm font-medium dark:text-white">Jml.
                            Barang</label>
                        <div class="relative">
                            <input type="number" id="jumlah"
                                name="jumlah"
                                class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg shadow-sm jumlah pe-20 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan Jumlah Barang">
                            <div
                                class="absolute inset-y-0 flex items-center text-gray-500 end-0 pe-px">
                                <label for="satuan" class="sr-only">Satuan</label>
                                <select id="satuan" name="satuan"
                                    class="block w-full border border-transparent rounded-lg focus:border-blue-600 focus:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-500">
                                    <option value="kg" >Kg</option>
                                    <option value="yard" selected>Yard</option>
                                </select>
                            </div>
                        </div>
                        <label for="harga"
                            class="block mb-2 text-sm font-medium dark:text-white">Harga
                            Barang</label>
                        <div class="relative rounded-md">
                            <input type="text" name="harga" id="harga"
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <input type="hidden" id="nominal">
                            <div
                                class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div
                                class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                        <label for="total"
                            class="block mb-2 text-sm font-medium dark:text-white">Total
                            Harga</label>
                        <div class="relative rounded-md">
                            <input type="text" readonly name="total" id="total"
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm total price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <input type="hidden" id="total" readonly>
                            <div
                                class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div
                                class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                    </div>
                `;
            } else if ($(this).hasClass('edit-kain')) {
                url = `/barang/mentah/kain/edit/${post_id}`;
                postUrl = `/barang/mentah/kain/update`;
                modalTitle = 'Edit Kain';
                editContent = `
                    <label for="kain_id" class="block mb-2 text-sm font-medium dark:text-white">Model</label>
                    <select name="kain" id="kain"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        @foreach ($kain as $row)
                            <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                        @endforeach
                    </select>
                `;
            }

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    console.log(response);
                    $('#modal-title').text(modalTitle);
                    $('#edit-form').attr('action', postUrl);
                    $('#edit-id').val(response.data.id);
                    $('#edit-content').html(editContent);
                    if (modalTitle === 'Edit Tanggal') {
                        $('#tanggal_datang').val(formatDateTime(response.data
                            .tanggal_datang));
                    } else if (modalTitle === 'Edit Kain') {
                        $('#kain').val(response.data.kain);
                    } else if (modalTitle === 'Edit Warna') {
                        $('#warna').val(response.data.warna);
                        $('#jumlah').val(parseInt(response.data.jumlah, 10));
                        $('#satuan').val(response.data.satuan);
                        $('#harga').val(formatNominal(response.data.harga));
                        $('#total').val(formatNominal(response.data.total));
                    }
                    HSOverlay.open('#edit-modal');
                }
            });

            function formatNominal(value) {
                let formattedValue = new Intl.NumberFormat("id-ID").format(value);
                return formattedValue;
            }

            // Function to format datetime for input[type="datetime-local"]
            function formatDateTime(dateTimeString) {
                const date = new Date(dateTimeString);
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                const day = String(date.getDate()).padStart(2, '0');
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');

                return `${year}-${month}-${day}T${hours}:${minutes}`;
            }
        });
    </script>
