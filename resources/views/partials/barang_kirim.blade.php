<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="border rounded-lg divide-y divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                <div class="py-3 px-4">
                    <form class="relative max-w-xs">
                        <label class="sr-only">Search</label>
                        <input type="hidden" name="barang" value="kirim">
                        <input type="date" name="date" value="{{ request()?->query('date') }}"
                            class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Cari barang datang">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
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
                    <div class="flex items-center space-x-2 p-4 ">
                        <span class="text-lg font-semibold text-gray-700 dark:text-neutral-300">Pencarian di
                            hari:</span>
                        <span class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                            {{ \Carbon\Carbon::parse(request()?->query('date'))?->translatedFormat('l, d F Y') }}
                        </span>
                        <a href="?barang=kirim"
                            class=" flex items-center text-sm font-medium rounded-lg border border-transparent  hover:text-danger-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
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
                @php
                    $totalKeseluruhanHarga = 0;
                @endphp

                @foreach ($barangJadi as $row)
                    @php
                        $modelBarangJadi = \App\Models\ModelBarangJadi::getByBarangJadi($row?->id);
                    @endphp
                    <div
                        class="text-xs font-semibold inline-block whitespace-nowrap px-2 py-1 m-2 rounded text-white bg-blue-500 rounded-2">
                        Tanggal : {{ \Carbon\Carbon::parse($row?->tanggal_kirim)?->translatedFormat('l, d F Y') }}

                        {{--  awal action tanggal  --}}
                        <span class="flex  text-sm text-gray-600 dark:text-neutral-400">
                            <button type="button" data-hs-overlay="#edit-modal-tanggal" data-id="{{ $row?->id }}"
                                class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg edit-tanggal gap-x-2 hover:text-blue-800 disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-pen-line">
                                    <path
                                        d="m18 5-2.414-2.414A2 2 0 0 0 14.172 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2" />
                                    <path
                                        d="M21.378 12.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                                    <path d="M8 18h1" />
                                </svg>
                            </button>
                            <form action="/barang/jadi/delete/{{ $row?->id }}" method="post"
                                data-id="{{ $row?->id }}" class="inline-flex delete-form">
                                @csrf
                                <button type="button"
                                    class="inline-flex items-center text-sm font-semibold text-red-600 border border-transparent rounded-lg delete gap-x-2 hover:text-red-800 disabled:pointer-events-none disabled:opacity-50 dark:text-red-500 dark:hover:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                                        <path d="M3 6h18" />
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                        <line x1="10" x2="10" y1="11" y2="17" />
                                        <line x1="14" x2="14" y1="11" y2="17" />
                                    </svg>
                                </button>
                            </form>
                        </span>
                        {{--  akhir aktion tanggal  --}}

                    </div>
                    @foreach ($modelBarangJadi as $item)
                        @php
                            $warnaModel = \App\Models\WarnaModel::getByWarnaModel($item?->id);
                        @endphp
                        <ul class="container mx-auto divide-y divide-gray-400 divide-dotted"
                            style="font-family: Raleway">
                            <li class="w-full flex items-center px-4 py-2">
                                <div class="mr-5 text-right w-3/1">
                                    <div
                                        class="text-xs font-semibold inline-block whitespace-nowrap px-2 py-1 rounded text-white bg-pink-500 rounded-2">
                                        {{ $item?->model }}

                                    </div>


                                    {{--  awal action model  --}}
                                    <span class="flex  text-sm text-gray-600 dark:text-neutral-400">
                                        <button type="button" data-hs-overlay="#edit-modal-model"
                                            data-id="{{ $item?->id }}"
                                            class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg edit-model gap-x-2 hover:text-blue-800 disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-file-pen-line">
                                                <path
                                                    d="m18 5-2.414-2.414A2 2 0 0 0 14.172 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2" />
                                                <path
                                                    d="M21.378 12.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                                                <path d="M8 18h1" />
                                            </svg>
                                        </button>
                                        <form action="/barang/jadi/model/delete/{{ $item?->id }}" method="post"
                                            data-id="{{ $item?->id }}" class="inline-flex delete-form">
                                            @csrf
                                            <button type="button"
                                                class="inline-flex items-center text-sm font-semibold text-red-600 border border-transparent rounded-lg delete gap-x-2 hover:text-red-800 disabled:pointer-events-none disabled:opacity-50 dark:text-red-500 dark:hover:text-red-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-trash-2">
                                                    <path d="M3 6h18" />
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                    <line x1="10" x2="10" y1="11"
                                                        y2="17" />
                                                    <line x1="14" x2="14" y1="11"
                                                        y2="17" />
                                                </svg>
                                            </button>
                                        </form>
                                    </span>
                                    {{--  akhir aktion model  --}}


                                </div>
                                <div class="w-full">
                                    <table class="table-auto w-full">
                                        <thead>
                                            <tr class="bg-blue-800 text-white">
                                                <th class="px-1">No.</th>
                                                <th class="px-1">Warna</th>
                                                <th class="px-1">Jumlah Barang</th>
                                                <th class="px-1">Harga</th>
                                                <th class="px-1">Total Harga</th>
                                                <th class="px-1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-dotted divide-purple-500">
                                            @foreach ($warnaModel as $indexWarna => $rowItem)
                                                @php
                                                    $totalKeseluruhanHarga += $rowItem?->total;
                                                @endphp
                                                <tr>
                                                    <td class="px-1 text-xs py-2 text-purple-700">
                                                        {{ $indexWarna + 1 }}
                                                    </td>
                                                    <td class="px-1 text-xs py-2 text-purple-700">
                                                        {{ $rowItem?->warna }}
                                                    </td>
                                                    <td class="px-1 text-xs py-2">{{ $rowItem?->jumlah }} /pcs</td>
                                                    <td class="px-1 text-xs py-2">{{ formatRupiah($rowItem?->harga) }}
                                                    </td>
                                                    <td class="px-1 text-xs py-2">{{ formatRupiah($rowItem?->total) }}
                                                    </td>
                                                    <td class="px-1 text-xs py-2">
                                                        <button type="button" data-hs-overlay="#edit-modal-warna"
                                                            data-id="{{ $rowItem?->id }}"
                                                            class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg edit-warna gap-x-2 hover:text-blue-800 disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-file-pen-line">
                                                                <path
                                                                    d="m18 5-2.414-2.414A2 2 0 0 0 14.172 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2" />
                                                                <path
                                                                    d="M21.378 12.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                                                                <path d="M8 18h1" />
                                                            </svg>
                                                        </button>
                                                        <form action="/barang/jadi/warna/delete/{{ $rowItem?->id }}"
                                                            method="post" data-id="{{ $rowItem?->id }}"
                                                            class="inline-flex delete-form">
                                                            @csrf
                                                            <button type="button"
                                                                class="inline-flex items-center text-sm font-semibold text-red-600 border border-transparent rounded-lg delete gap-x-2 hover:text-red-800 disabled:pointer-events-none disabled:opacity-50 dark:text-red-500 dark:hover:text-red-400">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-trash-2">
                                                                    <path d="M3 6h18" />
                                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                                    <line x1="10" x2="10"
                                                                        y1="11" y2="17" />
                                                                    <line x1="14" x2="14"
                                                                        y1="11" y2="17" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endforeach

                <div
                    class="flex flex-col p-4 bg-green-600 border border-gray-200 rounded shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                    <h2 class="font-bold text-center text-white uppercase">Total keseluruhan harga :
                        {{ formatRupiah($totalKeseluruhanHarga) }}</h2>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('input[name="date"]').on('change', function() {
                $(this).closest('form').submit();
            });
        });

        $(document).on('click', '.edit-tanggal', function(e) {
            let post_id = $(this).data('id');
            $.ajax({
                url: `/barang/jadi/edit/${post_id}`,
                type: "GET",
                success: function(response) {
                    console.log(response)
                    $('#edit-modal').addClass('hs-overlay-open');
                }
            });
        });

        $(document).on('click', '.edit-warna', function(e) {
            let post_id = $(this).data('id');
            $.ajax({
                url: `/barang/jadi/warna/edit/${post_id}`,
                type: "GET",
                success: function(response) {
                    console.log(response)
                    $('#edit-modal').addClass('hs-overlay-open');
                }
            });
        });

        $(document).on('click', '.edit-model', function(e) {
            let post_id = $(this).data('id');
            $.ajax({
                url: `/barang/jadi/model/edit/${post_id}`,
                type: "GET",
                success: function(response) {
                    console.log(response)
                    $('#edit-modal').addClass('hs-overlay-open');
                }
            });
        });
    </script>
