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

                @foreach ($barangMentah as $uniqueId => $items)
                    <nav class="relative m-1 z-0 flex border rounded overflow-hidden dark:border-neutral-700"
                        aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                        <button type="button"
                            class="hs-tab-active:bg-green-600 hs-tab-active:text-white relative min-w-0 flex-1 bg-blue-500 first:border-s-0 border-s border-b-2 py-4 px-4 text-white hover:text-gray-200 text-sm font-medium text-center overflow-hidden hover:bg-blue-400 focus:z-10 focus:outline-none focus:bg-green-600 focus:text-white disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-l-neutral-700 dark:border-b-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-400 active"
                            id="bar-with-underline-item-{{ $uniqueId }}-1" aria-selected="true"
                            data-hs-tab="#bar-with-underline-{{ $uniqueId }}-1"
                            aria-controls="bar-with-underline-{{ $uniqueId }}-1" role="tab">
                            Barang Masuk
                        </button>
                        <button type="button"
                            class="hs-tab-active:bg-green-600 hs-tab-active:text-white relative min-w-0 flex-1 bg-blue-500 first:border-s-0 border-s border-b-2 py-4 px-4 text-white hover:text-gray-200 text-sm font-medium text-center overflow-hidden hover:bg-blue-400 focus:z-10 focus:outline-none focus:bg-green-600 focus:text-white disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-l-neutral-700 dark:border-b-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-400"
                            id="bar-with-underline-item-{{ $uniqueId }}-2" aria-selected="false"
                            data-hs-tab="#bar-with-underline-{{ $uniqueId }}-2"
                            aria-controls="bar-with-underline-{{ $uniqueId }}-2" role="tab">
                            Barang Keluar
                        </button>
                        <button type="button"
                            class="hs-tab-active:bg-green-600 hs-tab-active:text-white relative min-w-0 flex-1 bg-blue-500 first:border-s-0 border-s border-b-2 py-4 px-4 text-white hover:text-gray-200 text-sm font-medium text-center overflow-hidden hover:bg-blue-400 focus:z-10 focus:outline-none focus:bg-green-600 focus:text-white disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-l-neutral-700 dark:border-b-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-400"
                            id="bar-with-underline-item-{{ $uniqueId }}-3" aria-selected="false"
                            data-hs-tab="#bar-with-underline-{{ $uniqueId }}-3"
                            aria-controls="bar-with-underline-{{ $uniqueId }}-3" role="tab">
                            Selisih / Bayaran
                        </button>
                        <button type="button"
                            class="hs-tab-active:bg-green-600 hs-tab-active:text-white relative min-w-0 flex-1 bg-blue-500 first:border-s-0 border-s border-b-2 py-4 px-4 text-white hover:text-gray-200 text-sm font-medium text-center overflow-hidden hover:bg-blue-400 focus:z-10 focus:outline-none focus:bg-green-600 focus:text-white disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-l-neutral-700 dark:border-b-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-400"
                            id="bar-with-underline-item-{{ $uniqueId }}-4" aria-selected="false"
                            data-hs-tab="#bar-with-underline-{{ $uniqueId }}-4"
                            aria-controls="bar-with-underline-{{ $uniqueId }}-4" role="tab">
                           Return Barang
                        </button>
                        <a href="/cetak/{{ $uniqueId }}" target="blank"
                            class="hs-tab-active:bg-red-600 hs-tab-active:text-white relative min-w-0 flex-1 bg-red-500 first:border-s-0 border-s border-b-2 py-4 px-4 text-white hover:text-red-200 text-sm font-medium text-center overflow-hidden hover:bg-red-400 focus:z-10 focus:outline-none focus:bg-red-600 focus:text-white disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-l-neutral-700 dark:border-b-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-400">
                          Cetak Print
                        </a>
                    </nav>


                    <div class="mt-3 ">

                        <div id="bar-with-underline-{{ $uniqueId }}-1" role="tabpanel"
                            aria-labelledby="bar-with-underline-item-{{ $uniqueId }}-1">
                            <div class="lg:flex ">
                                <div
                                    class="flex flex-col bg-white border lg:w-2/4 m-2 shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                    <div
                                        class="flex justify-between bg-green-200 items-center border-b rounded-t-xl py-3 px-4 md:px-5 dark:border-neutral-700">
                                        <h3 class="text-sm font-bold text-gray-800 dark:text-white">
                                            Barang Masuk <br>
                                            ID: {{ $uniqueId }}
                                        </h3>

                                        <div class="flex items-center gap-x-1 ">
                                            <div class="hs-tooltip inline-block ">
                                                <a href="/supplyer/detail/add/{{ $uniqueId }}"
                                                    class="bg-green-500 rounded-full font-bold text-white hs-tooltip-toggle size-8 inline-flex justify-center items-center gap-x-2 text-sm border border-transparent disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="lucide lucide-circle-plus">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <path d="M8 12h8" />
                                                        <path d="M12 8v8" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 md:p-5">
                                        <div>
                                            <ul class="space-y-3 text-sm">
                                                @php $totalSemuaBarangDatang = 0; @endphp
                                                @foreach ($items as $it => $item)
                                                    @php
                                                        $tanggalFilter = Carbon\Carbon::parse($tanggal)->toDateString();
                                                        $tanggalItem = Carbon\Carbon::parse(
                                                            $item->tanggal_datang,
                                                        )->toDateString();
                                                    @endphp
                                                    @if ($tanggal)
                                                        @if ($tanggalFilter == $tanggalItem)
                                                            <ul class="text-sm font-semibold ">
                                                                @foreach ($item->kainBarangMentah as $kain)
                                                                    <li
                                                                        class="flex gap-x-3 {{ $tanggalFilter == $tanggalItem ? 'bg-amber-200 p-1 rounded' : '' }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="20" height="20"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-calendar-arrow-down">
                                                                            <path d="m14 18 4 4 4-4" />
                                                                            <path d="M16 2v4" />
                                                                            <path d="M18 14v8" />
                                                                            <path
                                                                                d="M21 11.354V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7.343" />
                                                                            <path d="M3 10h18" />
                                                                            <path d="M8 2v4" />
                                                                        </svg>
                                                                        <span
                                                                            class="text-gray-800 dark:text-neutral-400">
                                                                            <span
                                                                                class="flex text-sm text-gray-600 dark:text-neutral-400">
                                                                                <span class="text-green-600">
                                                                                    {{ $kain->kain }}
                                                                                </span>
                                                                                -({{ \Carbon\Carbon::parse($item->tanggal_datang)->translatedFormat('d F Y H:i') }})
                                                                                <span class="ms-4 border rounded">
                                                                                    <div
                                                                                        class="inline-block hs-tooltip">
                                                                                        <a href="/supplyer/detail/edit/datang/{{ $uniqueId }}/{{ $item->id }}"
                                                                                            data-hs-overlay="#edit-modal-tanggal"
                                                                                            data-id="{{ $item->id }}"
                                                                                            class="hs-tooltip-toggle edit-tanggal inline-flex items-center justify-center gap-x-2 rounded-s bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="blue"
                                                                                                class="w-4 h-4">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                                            </svg>
                                                                                            <span
                                                                                                class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                                                                role="tooltip">
                                                                                                Edit
                                                                                            </span>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div
                                                                                        class="inline-block hs-tooltip">
                                                                                        <form
                                                                                            action="/barang/mentah/delete/{{ $item->id }}"
                                                                                            method="post"
                                                                                            data-id="{{ $item->id }}"
                                                                                            style="display: inline-block;">
                                                                                            @csrf
                                                                                            <button type="submit"
                                                                                                class="hs-tooltip-toggle delete inline-flex items-center justify-center gap-x-2 rounded-e bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                    fill="none"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    stroke-width="1.5"
                                                                                                    stroke="crimson"
                                                                                                    class="w-4 h-4">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
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
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </li>
                                                                    <div class="ps-8 py-2 ">
                                                                        <table
                                                                            class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                                                            <tbody>
                                                                                @foreach ($kain->warnaKain as $warna)
                                                                                    @php $totalSemuaBarangDatang += $warna->total; @endphp
                                                                                    <tr>
                                                                                        <td class="font-semibold">
                                                                                            Total
                                                                                        </td>
                                                                                        <td>
                                                                                            :
                                                                                            {{ formatRupiah($warna->total) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <ul class="text-sm font-semibold data-for-show"
                                                                style="display: none;" id="data-for-show">
                                                                @foreach ($item->kainBarangMentah as $kain)
                                                                    <li class="flex gap-x-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="20" height="20"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-calendar-arrow-down">
                                                                            <path d="m14 18 4 4 4-4" />
                                                                            <path d="M16 2v4" />
                                                                            <path d="M18 14v8" />
                                                                            <path
                                                                                d="M21 11.354V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7.343" />
                                                                            <path d="M3 10h18" />
                                                                            <path d="M8 2v4" />
                                                                        </svg>
                                                                        <span
                                                                            class="text-gray-800 dark:text-neutral-400">
                                                                            <span
                                                                                class="flex text-sm text-gray-600 dark:text-neutral-400">
                                                                                <span class="text-green-600">
                                                                                    {{ $kain->kain }}
                                                                                </span>
                                                                                -({{ \Carbon\Carbon::parse($item->tanggal_datang)->translatedFormat('d F Y H:i') }})
                                                                                <span class="ms-4 border rounded">
                                                                                    <div
                                                                                        class="inline-block hs-tooltip">
                                                                                        <a href="/supplyer/detail/edit/datang/{{ $uniqueId }}/{{ $item->id }}"
                                                                                            data-hs-overlay="#edit-modal-tanggal"
                                                                                            data-id="{{ $item->id }}"
                                                                                            class="hs-tooltip-toggle edit-tanggal inline-flex items-center justify-center gap-x-2 rounded-s bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="blue"
                                                                                                class="w-4 h-4">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                                            </svg>
                                                                                            <span
                                                                                                class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                                                                role="tooltip">
                                                                                                Edit
                                                                                            </span>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div
                                                                                        class="inline-block hs-tooltip">
                                                                                        <form
                                                                                            action="/barang/mentah/delete/{{ $item->id }}"
                                                                                            method="post"
                                                                                            data-id="{{ $item->id }}"
                                                                                            style="display: inline-block;">
                                                                                            @csrf
                                                                                            <button type="submit"
                                                                                                class="hs-tooltip-toggle delete inline-flex items-center justify-center gap-x-2 rounded-e bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                    fill="none"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    stroke-width="1.5"
                                                                                                    stroke="crimson"
                                                                                                    class="w-4 h-4">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
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
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </li>
                                                                    <div class="ps-8 py-2 ">
                                                                        <table
                                                                            class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                                                            <tbody>
                                                                                @foreach ($kain->warnaKain as $warna)
                                                                                    @php $totalSemuaBarangDatang += $warna->total; @endphp
                                                                                    <tr>
                                                                                        <td class="font-semibold">
                                                                                            Total
                                                                                        </td>
                                                                                        <td>
                                                                                            :
                                                                                            {{ formatRupiah($warna->total) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @else
                                                        <ul class="text-sm font-semibold ">
                                                            @foreach ($item->kainBarangMentah as $kain)
                                                                <li class="flex gap-x-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="20" height="20"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="lucide lucide-calendar-arrow-down">
                                                                        <path d="m14 18 4 4 4-4" />
                                                                        <path d="M16 2v4" />
                                                                        <path d="M18 14v8" />
                                                                        <path
                                                                            d="M21 11.354V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7.343" />
                                                                        <path d="M3 10h18" />
                                                                        <path d="M8 2v4" />
                                                                    </svg>
                                                                    <span class="text-gray-800 dark:text-neutral-400">
                                                                        <span
                                                                            class="flex text-sm text-gray-600 dark:text-neutral-400">
                                                                            <span class="text-green-600">
                                                                                {{ $kain->kain }}
                                                                            </span>
                                                                            -({{ \Carbon\Carbon::parse($item->tanggal_datang)->translatedFormat('d F Y H:i') }})
                                                                            <span class="ms-4 border rounded">
                                                                                <div class="inline-block hs-tooltip">
                                                                                    <a href="/supplyer/detail/edit/datang/{{ $uniqueId }}/{{ $item->id }}"
                                                                                        data-hs-overlay="#edit-modal-tanggal"
                                                                                        data-id="{{ $item->id }}"
                                                                                        class="hs-tooltip-toggle edit-tanggal inline-flex items-center justify-center gap-x-2 rounded-s bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke-width="1.5"
                                                                                            stroke="blue"
                                                                                            class="w-4 h-4">
                                                                                            <path
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                                        </svg>
                                                                                        <span
                                                                                            class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                                                            role="tooltip">
                                                                                            Edit
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="inline-block hs-tooltip">
                                                                                    <form
                                                                                        action="/barang/mentah/delete/{{ $item->id }}"
                                                                                        method="post"
                                                                                        data-id="{{ $item->id }}"
                                                                                        style="display: inline-block;">
                                                                                        @csrf
                                                                                        <button type="submit"
                                                                                            class="hs-tooltip-toggle delete inline-flex items-center justify-center gap-x-2 rounded-e bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="crimson"
                                                                                                class="w-4 h-4">
                                                                                                <path
                                                                                                    stroke-linecap="round"
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
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </li>
                                                                <div class="ps-8 py-2 ">
                                                                    <table
                                                                        class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                                                        <tbody>
                                                                            @foreach ($kain->warnaKain as $warna)
                                                                                @php $totalSemuaBarangDatang += $warna->total; @endphp
                                                                                <tr>
                                                                                    <td class="font-semibold">
                                                                                        Total
                                                                                    </td>
                                                                                    <td>
                                                                                        :
                                                                                        {{ formatRupiah($warna->total) }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach
                                                @if ($tanggal)
                                                    <button type="button"
                                                        class="show-data bg-blue-400 hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200  text-gray-800 shadow-sm hover:bg-blue-300 focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                                        aria-haspopup="menu" aria-expanded="false"
                                                        aria-label="Dropdown">
                                                        <span class="toggle">Buka Semua Tanggal Lainnya</span>
                                                    </button>
                                                @endif
                                                <hr>
                                                <div class="ps-8 py-2 ">
                                                    <table
                                                        class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                                        <tbody>
                                                            <tr>
                                                                <td class="font-semibold">
                                                                    Total Semuanya
                                                                </td>
                                                                <td class="font-semibold">
                                                                    : {{ formatRupiah($totalSemuaBarangDatang) }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="relative m-3 lg:w-1/2 flex flex-col h-full overflow-x-auto text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                                    <table class="w-full text-left table-auto min-w-max">
                                        <thead>
                                            <tr>
                                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                                        Tanggal</p>
                                                </th>
                                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                                        Informasi
                                                        Lainnya
                                                    </p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $it => $item)
                                                <tr class="hover:bg-slate-50">
                                                    <td class="p-4 border-b border-slate-200">
                                                        <p class="block text-sm text-slate-800">
                                                            {{ \Carbon\Carbon::parse($item->tanggal_datang)->translatedFormat('d F Y H:i') }}
                                                        </p>
                                                    </td>
                                                    <td class="p-4 border-b border-slate-200">
                                                        <div class="hs-accordion-group">
                                                            @foreach ($item->kainBarangMentah as $kain)
                                                                <div class="hs-accordion"
                                                                    id="hs-basic-nested-heading-one">
                                                                    <button
                                                                        class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
                                                                        aria-expanded="false"
                                                                        aria-controls="hs-basic-nested-collapse-one">
                                                                        <svg class="hs-accordion-active:hidden block size-3.5"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M5 12h14"></path>
                                                                            <path d="M12 5v14"></path>
                                                                        </svg>
                                                                        <svg class="hs-accordion-active:block hidden size-3.5"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M5 12h14"></path>
                                                                        </svg>
                                                                        {{ $kain->kain }}
                                                                    </button>
                                                                    <div id="hs-basic-nested-collapse-one"
                                                                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                                                        role="region"
                                                                        aria-labelledby="hs-basic-nested-heading-one"
                                                                        style="height: 0px;">
                                                                        @foreach ($kain->warnaKain as $warna)
                                                                            <div class="hs-accordion-group ps-6">
                                                                                <div class="hs-accordion"
                                                                                    id="hs-basic-nested-sub-heading-one">
                                                                                    <button
                                                                                        class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
                                                                                        aria-expanded="false"
                                                                                        aria-controls="hs-basic-nested-sub-collapse-one">
                                                                                        <svg class="hs-accordion-active:hidden block size-3"
                                                                                            width="16"
                                                                                            height="16"
                                                                                            viewBox="0 0 16 16"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M2.62421 7.86L13.6242 7.85999"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round">
                                                                                            </path>
                                                                                            <path
                                                                                                d="M8.12421 13.36V2.35999"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round">
                                                                                            </path>
                                                                                        </svg>
                                                                                        <svg class="hs-accordion-active:block hidden size-3"
                                                                                            width="16"
                                                                                            height="16"
                                                                                            viewBox="0 0 16 16"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M2.62421 7.86L13.6242 7.85999"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round">
                                                                                            </path>
                                                                                        </svg>
                                                                                        detail harga
                                                                                    </button>
                                                                                    <div id="hs-basic-nested-sub-collapse-one"
                                                                                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                                                                        role="region"
                                                                                        aria-labelledby="hs-basic-nested-sub-heading-one"
                                                                                        style="height: 0px;">
                                                                                        <div
                                                                                            class="p-4 bg-gray-100 rounded-lg">
                                                                                            <table
                                                                                                class="min-w-full text-sm text-left text-gray-800 dark:text-neutral-200">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="font-semibold">
                                                                                                            Jumlah</td>
                                                                                                        <td>:
                                                                                                            {{ $warna->jumlah }}
                                                                                                            {{ $warna->satuan }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="font-semibold">
                                                                                                            Harga</td>
                                                                                                        <td>:
                                                                                                            {{ formatRupiah($warna->harga) }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="font-semibold">
                                                                                                            Total</td>
                                                                                                        <td>:
                                                                                                            {{ formatRupiah($warna->total) }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div id="bar-with-underline-{{ $uniqueId }}-2" class="hidden" role="tabpanel"
                            aria-labelledby="bar-with-underline-item-{{ $uniqueId }}-2">
                            <div class="lg:flex ">
                                @php
                                    $barangPengiriman = App\Models\BarangJadi::getUniqueBarangDatang($uniqueId);
                                @endphp
                                <div
                                    class="flex flex-col bg-white border lg:w-2/4 m-2 shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                    <div
                                        class="flex justify-between items-center border-b bg-red-200 rounded-t-xl py-3 px-4 md:px-5 dark:border-neutral-700">
                                        <h3 class="text-sm font-bold text-gray-800 dark:text-white">
                                            Barang keluar <br>
                                            ID: {{ $uniqueId }}
                                        </h3>

                                        <div class="flex items-center gap-x-1 ">
                                            <div class="hs-tooltip inline-block ">
                                                <a href="/barang/pengiriman/{{ $uniqueId }}"
                                                    class="bg-green-500 rounded-full font-bold text-white hs-tooltip-toggle size-8 inline-flex justify-center items-center gap-x-2 text-sm border border-transparent disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="lucide lucide-circle-plus">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <path d="M8 12h8" />
                                                        <path d="M12 8v8" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-4 md:p-5">
                                        <div>
                                            <ul class="space-y-3 text-sm">
                                                @php $totalSemuaBarangKirim = 0; @endphp
                                                @foreach ($barangPengiriman as $it => $rows)
                                                    @php
                                                        $tanggalFilter = Carbon\Carbon::parse($tanggal)->toDateString();
                                                        $tanggalItem = Carbon\Carbon::parse(
                                                            $rows->tanggal_kirim,
                                                        )->toDateString();
                                                    @endphp
                                                    @if ($tanggal)
                                                        @if ($tanggalFilter == $tanggalItem)
                                                            <ul class="text-sm font-semibold ">
                                                                @foreach ($rows->modelBarangJadi as $model)
                                                                    <li
                                                                        class="flex gap-x-3 {{ $tanggalFilter == $tanggalItem ? 'bg-amber-200 p-1 rounded' : '' }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="20" height="20"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-calendar-arrow-up">
                                                                            <path d="m14 18 4-4 4 4" />
                                                                            <path d="M16 2v4" />
                                                                            <path d="M18 22v-8" />
                                                                            <path
                                                                                d="M21 11.343V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h9" />
                                                                            <path d="M3 10h18" />
                                                                            <path d="M8 2v4" />
                                                                        </svg>
                                                                        <span
                                                                            class="text-gray-800 dark:text-neutral-400">
                                                                            <span
                                                                                class="flex text-sm text-gray-600 dark:text-neutral-400">
                                                                                <span class="text-green-600">
                                                                                    {{ $model->model }}
                                                                                </span>
                                                                                -({{ \Carbon\Carbon::parse($rows->tanggal_kirim)->translatedFormat('d F Y H:i') }})
                                                                                <span class="ms-4 border rounded">
                                                                                    <div
                                                                                        class="inline-block hs-tooltip">
                                                                                        <a href="/supplyer/detail/edit/pengiriman/{{ $uniqueId }}/{{ $rows->id }}"
                                                                                            data-hs-overlay="#edit-modal-tanggal"
                                                                                            data-id="{{ $rows->id }}"
                                                                                            class="hs-tooltip-toggle edit-tanggal inline-flex items-center justify-center gap-x-2 rounded-s bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="blue"
                                                                                                class="w-4 h-4">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                                            </svg>
                                                                                            <span
                                                                                                class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                                                                role="tooltip">
                                                                                                Edit
                                                                                            </span>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div
                                                                                        class="inline-block hs-tooltip">
                                                                                        <form
                                                                                            action="/barang/jadi/delete/{{ $rows->id }}"
                                                                                            method="post"
                                                                                            data-id="{{ $rows->id }}"
                                                                                            style="display: inline-block;">
                                                                                            @csrf
                                                                                            <button type="submit"
                                                                                                class="hs-tooltip-toggle delete inline-flex items-center justify-center gap-x-2 rounded-e bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                    fill="none"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    stroke-width="1.5"
                                                                                                    stroke="crimson"
                                                                                                    class="w-4 h-4">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
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
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </li>
                                                                    <div class="ps-8 py-2 ">
                                                                        <table
                                                                            class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                                                            <tbody>
                                                                                @foreach ($model->warnaModel as $model)
                                                                                    @php $totalSemuaBarangKirim += $model->total; @endphp
                                                                                    <tr>
                                                                                        <td class="font-semibold">
                                                                                            Total
                                                                                        </td>
                                                                                        <td>
                                                                                            :
                                                                                            {{ formatRupiah($model->total) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <ul class="text-sm font-semibold data-for-show"
                                                                style="display: none;" id="data-for-show">
                                                                @foreach ($rows->modelBarangJadi as $model)
                                                                    <li class="flex gap-x-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="20" height="20"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-calendar-arrow-up">
                                                                            <path d="m14 18 4-4 4 4" />
                                                                            <path d="M16 2v4" />
                                                                            <path d="M18 22v-8" />
                                                                            <path
                                                                                d="M21 11.343V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h9" />
                                                                            <path d="M3 10h18" />
                                                                            <path d="M8 2v4" />
                                                                        </svg>
                                                                        <span
                                                                            class="text-gray-800 dark:text-neutral-400">
                                                                            <span
                                                                                class="flex text-sm text-gray-600 dark:text-neutral-400">
                                                                                <span class="text-green-600">
                                                                                    {{ $model->model }}
                                                                                </span>
                                                                                -({{ \Carbon\Carbon::parse($rows->tanggal_kirim)->translatedFormat('d F Y H:i') }})
                                                                                <span class="ms-4 border rounded">
                                                                                    <div
                                                                                        class="inline-block hs-tooltip">
                                                                                        <a href="/supplyer/detail/edit/datang/{{ $uniqueId }}/{{ $item->id }}"
                                                                                            data-hs-overlay="#edit-modal-tanggal"
                                                                                            data-id="{{ $item->id }}"
                                                                                            class="hs-tooltip-toggle edit-tanggal inline-flex items-center justify-center gap-x-2 rounded-s bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="blue"
                                                                                                class="w-4 h-4">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                                            </svg>
                                                                                            <span
                                                                                                class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                                                                role="tooltip">
                                                                                                Edit
                                                                                            </span>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div
                                                                                        class="inline-block hs-tooltip">
                                                                                        <form
                                                                                            action="/barang/jadi/delete/{{ $rows->id }}"
                                                                                            method="post"
                                                                                            data-id="{{ $rows->id }}"
                                                                                            style="display: inline-block;">
                                                                                            @csrf
                                                                                            <button type="submit"
                                                                                                class="hs-tooltip-toggle delete inline-flex items-center justify-center gap-x-2 rounded-e bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                    fill="none"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    stroke-width="1.5"
                                                                                                    stroke="crimson"
                                                                                                    class="w-4 h-4">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
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
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </li>
                                                                    <div class="ps-8 py-2 ">
                                                                        <table
                                                                            class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                                                            <tbody>
                                                                                @foreach ($model->warnaModel as $model)
                                                                                    @php $totalSemuaBarangKirim += $model->total; @endphp
                                                                                    <tr>
                                                                                        <td class="font-semibold">
                                                                                            Total
                                                                                        </td>
                                                                                        <td>
                                                                                            :
                                                                                            {{ formatRupiah($model->total) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @else
                                                        <ul class="text-sm font-semibold ">
                                                            @foreach ($rows->modelBarangJadi as $model)
                                                                <li class="flex gap-x-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="20" height="20"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="lucide lucide-calendar-arrow-up">
                                                                        <path d="m14 18 4-4 4 4" />
                                                                        <path d="M16 2v4" />
                                                                        <path d="M18 22v-8" />
                                                                        <path
                                                                            d="M21 11.343V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h9" />
                                                                        <path d="M3 10h18" />
                                                                        <path d="M8 2v4" />
                                                                    </svg>
                                                                    <span class="text-gray-800 dark:text-neutral-400">
                                                                        <span
                                                                            class="flex text-sm text-gray-600 dark:text-neutral-400">
                                                                            <span class="text-green-600">
                                                                                {{ $model->model }}
                                                                            </span>
                                                                            -({{ \Carbon\Carbon::parse($rows->tanggal_kirim)->translatedFormat('d F Y H:i') }})
                                                                            <span class="ms-4 border rounded">
                                                                                <div class="inline-block hs-tooltip">
                                                                                    <a href="/supplyer/detail/edit/pengiriman/{{ $uniqueId }}/{{ $rows->id }}"
                                                                                        data-hs-overlay="#edit-modal-tanggal"
                                                                                        data-id="{{ $rows->id }}"
                                                                                        class="hs-tooltip-toggle edit-tanggal inline-flex items-center justify-center gap-x-2 rounded-s bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke-width="1.5"
                                                                                            stroke="blue"
                                                                                            class="w-4 h-4">
                                                                                            <path
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                                        </svg>
                                                                                        <span
                                                                                            class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                                                            role="tooltip">
                                                                                            Edit
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="inline-block hs-tooltip">
                                                                                    <form
                                                                                        action="/barang/jadi/delete/{{ $rows->id }}"
                                                                                        method="post"
                                                                                        data-id="{{ $rows->id }}"
                                                                                        style="display: inline-block;">
                                                                                        @csrf
                                                                                        <button type="submit"
                                                                                            class="hs-tooltip-toggle delete inline-flex items-center justify-center gap-x-2 rounded-e bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="crimson"
                                                                                                class="w-4 h-4">
                                                                                                <path
                                                                                                    stroke-linecap="round"
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
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </li>
                                                                <div class="ps-8 py-2 ">
                                                                    <table
                                                                        class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                                                        <tbody>
                                                                            @foreach ($model->warnaModel as $model)
                                                                                @php $totalSemuaBarangKirim += $model->total; @endphp
                                                                                <tr>
                                                                                    <td class="font-semibold">
                                                                                        Total
                                                                                    </td>
                                                                                    <td>
                                                                                        :
                                                                                        {{ formatRupiah($model->total) }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach
                                                @if ($tanggal)
                                                    <button type="button"
                                                        class="show-data bg-blue-400 hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200  text-gray-800 shadow-sm hover:bg-blue-300 focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                                        aria-haspopup="menu" aria-expanded="false"
                                                        aria-label="Dropdown">
                                                        <span class="toggle">Buka Semua Tanggal Lainnya</span>
                                                    </button>
                                                @endif
                                                <hr>
                                                <div class="ps-8 py-2 ">
                                                    <table
                                                        class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                                        <tbody>
                                                            <tr>
                                                                <td class="font-semibold">
                                                                    Total Semuanya
                                                                </td>
                                                                <td class="font-semibold">
                                                                    : {{ formatRupiah($totalSemuaBarangKirim) }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="relative m-3 lg:w-1/2 flex flex-col h-full overflow-x-auto text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                                    <table class="w-full text-left table-auto min-w-max">
                                        <thead>
                                            <tr>
                                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                                        Tanggal</p>
                                                </th>
                                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                                        Informasi
                                                        Lainnya
                                                    </p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barangPengiriman as $it => $rows)
                                                <tr class="hover:bg-slate-50">
                                                    <td class="p-4 border-b border-slate-200">
                                                        <p class="block text-sm text-slate-800">
                                                            {{ \Carbon\Carbon::parse($rows->tanggal_kirim)->translatedFormat('d F Y H:i') }}
                                                        </p>
                                                    </td>
                                                    <td class="p-4 border-b border-slate-200">
                                                        <div class="hs-accordion-group">
                                                            @foreach ($rows->modelBarangJadi as $model)
                                                                <div class="hs-accordion"
                                                                    id="hs-basic-nested-heading-one">
                                                                    <button
                                                                        class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
                                                                        aria-expanded="false"
                                                                        aria-controls="hs-basic-nested-collapse-one">
                                                                        <svg class="hs-accordion-active:hidden block size-3.5"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M5 12h14"></path>
                                                                            <path d="M12 5v14"></path>
                                                                        </svg>
                                                                        <svg class="hs-accordion-active:block hidden size-3.5"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M5 12h14"></path>
                                                                        </svg>
                                                                        {{ $model->model }}
                                                                    </button>
                                                                    <div id="hs-basic-nested-collapse-one"
                                                                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                                                        role="region"
                                                                        aria-labelledby="hs-basic-nested-heading-one"
                                                                        style="height: 0px;">
                                                                        @foreach ($model->warnaModel as $warna)
                                                                            <div class="hs-accordion-group ps-6">
                                                                                <div class="hs-accordion"
                                                                                    id="hs-basic-nested-sub-heading-one">
                                                                                    <button
                                                                                        class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
                                                                                        aria-expanded="false"
                                                                                        aria-controls="hs-basic-nested-sub-collapse-one">
                                                                                        <svg class="hs-accordion-active:hidden block size-3"
                                                                                            width="16"
                                                                                            height="16"
                                                                                            viewBox="0 0 16 16"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M2.62421 7.86L13.6242 7.85999"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round">
                                                                                            </path>
                                                                                            <path
                                                                                                d="M8.12421 13.36V2.35999"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round">
                                                                                            </path>
                                                                                        </svg>
                                                                                        <svg class="hs-accordion-active:block hidden size-3"
                                                                                            width="16"
                                                                                            height="16"
                                                                                            viewBox="0 0 16 16"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M2.62421 7.86L13.6242 7.85999"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round">
                                                                                            </path>
                                                                                        </svg>
                                                                                        detail harga
                                                                                    </button>
                                                                                    <div id="hs-basic-nested-sub-collapse-one"
                                                                                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                                                                        role="region"
                                                                                        aria-labelledby="hs-basic-nested-sub-heading-one"
                                                                                        style="height: 0px;">
                                                                                        <div
                                                                                            class="p-4 bg-gray-100 rounded-lg">
                                                                                            <table
                                                                                                class="min-w-full text-sm text-left text-gray-800 dark:text-neutral-200">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="font-semibold">
                                                                                                            Jumlah</td>
                                                                                                        <td>:
                                                                                                            {{ $warna->jumlah }}
                                                                                                            {{ $warna->satuan }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="font-semibold">
                                                                                                            Harga</td>
                                                                                                        <td>:
                                                                                                            {{ formatRupiah($warna->harga) }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="font-semibold">
                                                                                                            Total</td>
                                                                                                        <td>:
                                                                                                            {{ formatRupiah($warna->total) }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div id="bar-with-underline-{{ $uniqueId }}-3" class="hidden" role="tabpanel"
                            aria-labelledby="bar-with-underline-item-{{ $uniqueId }}-3">
                            <div class="w-full flex justify-between items-center mb-3 m-3 pl-3">
                                <table class="w-full text-left text-lg font-semibold text-slate-800">
                                    <tbody>
                                        <tr>
                                            <td>BAHAN </td>
                                            <td>: {{ formatRupiah($totalSemuaBarangDatang) }}</td>
                                        </tr>
                                        <tr>
                                            <td>BARANG </td>
                                            <td>: {{ formatRupiah($totalSemuaBarangKirim) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div
                                                    class="py-3 flex w-full items-center text-sm text-gray-800 before:flex-1 before:border-t before:border-gray-200 before:me-6 dark:text-white dark:before:border-neutral-600">
                                                    - </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>SELISIH </td>
                                            <td class="text-green-500">:
                                                {{ formatRupiah($totalSemuaBarangDatang - $totalSemuaBarangKirim) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div
                                class="relative flex flex-col m-3 h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                                <a href="/selisih/add/{{ $uniqueId }}"
                                    class="py-3 mx-3 w-52 px-4 my-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    Tambah Catatan
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-file-plus-2">
                                        <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" />
                                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                        <path d="M3 15h6" />
                                        <path d="M6 12v6" />
                                    </svg>
                                </a>

                                <table class="w-full text-left table-auto min-w-max">
                                    <thead>
                                        <tr>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    No.
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Tanggal
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Nominal
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Keterangan
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Aksi
                                                </p>
                                            </th>
                                        </tr>
                                    </thead>

                                    @php
                                        $selisih = App\Models\Selisih::getSelisihByUniqueId($uniqueId);
                                        $totalNominal = 0; // Inisialisasi total nominal
                                    @endphp

                                    <tbody>
                                        @foreach ($selisih as $sl)
                                            <tr class="hover:bg-slate-50">
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="block font-semibold text-sm text-slate-800">
                                                        {{ $loop->iteration }}. </p>
                                                </td>
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="block font-semibold text-sm text-slate-800">
                                                        {{ \Carbon\Carbon::parse($sl->tanggal)->translatedFormat('d F Y H:i') }}
                                                    </p>
                                                </td>
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="block font-semibold text-sm text-slate-800">:
                                                        {{ formatRupiah($sl->nominal) }}</p>
                                                    @php
                                                        $totalNominal += $sl->nominal; // Mengakumulasi nominal
                                                    @endphp
                                                </td>
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="text-sm">{{ $sl->keterangan }}</p>
                                                </td>
                                                <td class="flex items-center justify-center px-4 py-2 text-xs">
                                                    <div class="inline-block hs-tooltip">
                                                        <a href="/selisih/edit/{{ $sl->id }}"
                                                            class="inline-flex items-center justify-center px-2 py-2 text-sm font-semibold text-gray-800 bg-white border shadow-sm edit-warna hs-tooltip-toggle gap-x-2 rounded-s-md hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
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
                                                        </a>
                                                    </div>
                                                    <div class="inline-block hs-tooltip">
                                                        <form action="/selisih/delete/{{ $sl?->id }}"
                                                            method="post" data-id="{{ $sl?->id }}"
                                                            style="display: inline-block;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="inline-flex items-center justify-center px-2 py-2 text-sm font-semibold text-gray-800 bg-white border shadow-sm hs-tooltip-toggle delete gap-x-2 rounded-e-md hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="crimson" class="w-4 h-4">
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

                                    <tfoot>
                                        <tr class="bg-yellow-500">
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                                Total Nominal </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                                : {{ formatRupiah($totalNominal) }}</td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                        </tr>
                                        <tr class="bg-yellow-500">
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                                Total Selisih </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                                : {{ formatRupiah($totalSemuaBarangDatang - $totalSemuaBarangKirim) }}
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                        </tr>
                                        <tr class="bg-green-500">
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                                Jumlah Sisa </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800 text-green-500">
                                                :
                                                {{ formatRupiah($totalSemuaBarangDatang - $totalSemuaBarangKirim + $totalNominal) }}
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div id="bar-with-underline-{{ $uniqueId }}-4" class="hidden" role="tabpanel"
                            aria-labelledby="bar-with-underline-item-{{ $uniqueId }}-4">

                            <div
                                class="relative flex flex-col m-3 h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                                <a href="/return/add/{{ $uniqueId }}"
                                    class="py-3 mx-3 w-60 px-4 my-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    Tambah Return Barang
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-file-plus-2">
                                        <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" />
                                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                        <path d="M3 15h6" />
                                        <path d="M6 12v6" />
                                    </svg>
                                </a>

                                <table class="w-full text-left table-auto min-w-max">
                                    <thead>
                                        <tr>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    No.
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Model
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Tanggal
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Jumlah
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Harga
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Total
                                                </p>
                                            </th>
                                            <th class="p-4 border-b border-slate-300 bg-slate-50">
                                                <p class="block text-sm font-normal leading-none text-slate-500">
                                                    Aksi
                                                </p>
                                            </th>
                                        </tr>
                                    </thead>

                                    @php
                                        $return = App\Models\ReturnBarang::getReturnByUniqueId($uniqueId);
                                        $totalNominalReturn = 0; // Inisialisasi total nominal
                                    @endphp

                                    <tbody>
                                        @foreach ($return as $rt)
                                            <tr class="hover:bg-slate-50">
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="block font-semibold text-sm text-slate-800">
                                                        {{ $loop->iteration }}. </p>
                                                </td>
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="block font-semibold text-sm text-slate-800">
                                                        {{ $rt->model }}. </p>
                                                </td>
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="block font-semibold text-sm text-slate-800">
                                                        {{ \Carbon\Carbon::parse($rt->tanggal)->translatedFormat('d F Y H:i') }}
                                                    </p>
                                                </td>
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="block font-semibold text-sm text-slate-800">
                                                        {{ $rt->jumlah }} </p>
                                                </td>
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="block font-semibold text-sm text-slate-800">
                                                        {{ formatRupiah($rt->harga) }} </p>
                                                </td>
                                                <td class="p-4 border-b border-slate-200 py-5">
                                                    <p class="block font-semibold text-sm text-slate-800">:
                                                        {{ formatRupiah($rt->total) }}</p>
                                                    @php
                                                        $totalNominalReturn += $rt->total; 
                                                    @endphp
                                                </td>
                                               
                                                <td class="flex items-center justify-center px-4 py-2 text-xs">
                                                    <div class="inline-block hs-tooltip">
                                                        <a href="/return/edit/{{ $rt->id }}"
                                                            class="inline-flex items-center justify-center px-2 py-2 text-sm font-semibold text-gray-800 bg-white border shadow-sm edit-warna hs-tooltip-toggle gap-x-2 rounded-s-md hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
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
                                                        </a>
                                                    </div>
                                                    <div class="inline-block hs-tooltip">
                                                        <form action="/return/delete/{{ $rt?->id }}"
                                                            method="post" data-id="{{ $rt?->id }}"
                                                            style="display: inline-block;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="inline-flex items-center justify-center px-2 py-2 text-sm font-semibold text-gray-800 bg-white border shadow-sm hs-tooltip-toggle delete gap-x-2 rounded-e-md hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="crimson" class="w-4 h-4">
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

                                    <tfoot>
                                        <tr class="bg-yellow-500">
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                                Total Nominal </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                                : {{ formatRupiah($totalNominalReturn) }}</td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                            <td
                                                class="p-4 border-t border-slate-200 py-5 font-semibold text-sm text-slate-800">
                                            </td>
                                        </tr>
                                       
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                    <hr><br>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('input[name="date"]').on('change', function() {
            $(this).closest('form').submit();
        });

        $(".show-data").click(function() {
            $(".data-for-show").toggle();
            if ($(".data-for-show").is(":visible")) {
                $(".toggle").html('Tutup Semua Tanggal Selain Yang Difilter.');
            } else {
                $(".toggle").html('Buka Semua Tanggal Lainnya.');
            }
        });
    });
</script>
