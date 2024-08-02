@extends('layouts.dashboard')

@section('content')
    <form class="flex flex-col w-full space-y-4 md:flex-row md:space-x-2 md:space-y-0">
        <div class="relative w-full">
            <input type="date"
                class="block w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-lg peer ps-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-transparent dark:bg-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                placeholder="Enter name" name="start_date" value="{{ request()->query('start_date') }}">
            <div
                class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:pointer-events-none peer-disabled:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-green-500 lucide lucide-calendar-search">
                    <path d="M21 12V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7.5" />
                    <path d="M16 2v4" />
                    <path d="M8 2v4" />
                    <path d="M3 10h18" />
                    <circle cx="18" cy="18" r="3" />
                    <path d="m22 22-1.5-1.5" />
                </svg>
            </div>
        </div>

        <span class="flex justify-center text-sm font-semibold md:p-3">TO</span>

        <div class="relative w-full">
            <input type="date"
                class="block w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-lg peer ps-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-transparent dark:bg-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                placeholder="Enter" name="end_date" value="{{ request()->query('end_date') }}">
            <div
                class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:pointer-events-none peer-disabled:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-green-500 lucide lucide-calendar-search">
                    <path d="M21 12V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7.5" />
                    <path d="M16 2v4" />
                    <path d="M8 2v4" />
                    <path d="M3 10h18" />
                    <circle cx="18" cy="18" r="3" />
                    <path d="m22 22-1.5-1.5" />
                </svg>
            </div>
        </div>
        <div class="hs-tooltip inline-block [--placement:bottom]">
            <button type="submit"
                class="edit-warna hs-tooltip-toggle inline-flex items-center justify-center gap-x-2 rounded-s-md border bg-white px-4 py-3.5 font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-filter">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                </svg>
                <span
                    class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                    role="tooltip">
                    Filter
                </span>
            </button>
        </div>
        <div class="hs-tooltip inline-block [--placement:bottom]">
            <a href="/operational"
                class="hs-tooltip-toggle inline-flex items-center justify-center gap-x-2 rounded-e-md border bg-white px-4 py-3.5 font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-refresh-ccw">
                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                    <path d="M3 3v5h5" />
                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                    <path d="M16 16h5v5" />
                </svg>
                <span
                    class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 delete hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                    role="tooltip">
                    Hapus Filter
                </span>
            </a>
        </div>
    </form>

    <div class="grid grid-cols-2 gap-4 sm:gap-6">
        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs tracking-wide text-gray-500 uppercase dark:text-neutral-500">
                        Saldo Awal
                    </p>
                </div>
                <div class="flex items-center mt-1 gap-x-2">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-neutral-200 sm:text-2xl">
                        {{ formatRupiah($operational->saldo_awal) }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs tracking-wide text-gray-500 uppercase dark:text-neutral-500">
                        Sisa Saldo
                    </p>
                </div>
                <div class="flex items-center mt-1 gap-x-2">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-neutral-200 sm:text-2xl">
                        {{ formatRupiah($operational->sisa_saldo) }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>

    <div class="flex flex-col">
        <div class="flex items-center justify-between pb-2 mb-2 border-b">
            @if ($pemakaian->isNotEmpty())
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Daftar Pemakaian Operational</h2>
                <button data-hs-overlay="#modal-tambah"
                    class="inline-flex items-center justify-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-plus">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    Tambahkan Pemakaian Operational
                </button>
            @else
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Daftar Pemakaian</h2>
            @endif
        </div>
        <div class="-m-1.5 overflow-x-auto">
            <div class="inline-block min-w-full p-1.5 align-middle">
                <div class="overflow-hidden border rounded-lg dark:border-neutral-700">
                    @if ($pemakaian->isEmpty())
                        <div class="mx-auto flex min-h-[400px] w-full max-w-sm flex-col justify-center px-6 py-4">
                            <div
                                class="size-[46px] flex items-center justify-center rounded-lg bg-gray-100 dark:bg-neutral-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="flex-shrink-0 text-gray-600 size-6 lucide lucide-hand-coins dark:text-neutral-400">
                                    <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                                    <path
                                        d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                                    <path d="m2 16 6 6" />
                                    <circle cx="16" cy="9" r="2.9" />
                                    <circle cx="6" cy="5" r="3" />
                                </svg>
                            </div>
                            <h2 class="mt-5 font-semibold text-gray-800 dark:text-white">
                                Belum ada Pemakaian Operational
                            </h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                Silahkan tambah Pemakaian.
                            </p>
                            <div class="grid gap-2 mt-5 sm:flex">
                                <button data-hs-overlay="#modal-tambah"
                                    class="inline-flex items-center justify-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Tambahkan Pemakaian
                                </button>
                            </div>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        No.</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Nominal</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Keterangan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Dibuat</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                                @foreach ($pemakaian as $row)
                                    <tr>
                                        <td
                                            class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $loop->iteration }}.</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ formatRupiah($row->saldo) }}</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $row->keterangan }}</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ \Carbon\Carbon::parse($row->created_at)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                            <div class="inline-block hs-tooltip">
                                                <button type="button" data-id="{{ $row->id }}"
                                                    class="inline-flex items-center justify-center px-2 py-2 text-sm font-semibold text-gray-800 bg-white border shadow-sm edit-catatan hs-tooltip-toggle gap-x-2 rounded-s-md hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
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
                                                <form action="/operational/pemakaian/delete/{{ $row->id }}"
                                                    method="post" data-id="{{ $row->id }}"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center justify-center px-2 py-2 text-sm font-semibold text-gray-800 bg-white border shadow-sm hs-tooltip-toggle delete gap-x-2 rounded-e-md hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="modal-tambah"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden"
        role="dialog" tabindex="-1" aria-labelledby="modal-tambah-label">
        <div
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-animation-target hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 id="modal-tambah-label" class="font-bold text-gray-800 dark:text-white">
                        Tambah Pemakaian
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:bg-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#modal-tambah">
                        <span class="sr-only">Close</span>
                        <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/operational/pemakaian/store/{{ $operational->id }}" method="post">
                    @csrf
                    <div class="p-4 space-y-2 overflow-y-auto">
                        <label for="saldo" class="block mb-2 text-sm font-medium dark:text-white">Pemakaian</label>
                        <div class="relative rounded-md">
                            <input type="text" name="saldo"
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                value="{{ old('saldo') }}">
                            <input type="hidden" id="nominal">
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                        <label for="keterangan" class="block mb-2 text-sm font-medium dark:text-white">Keterangan</label>
                        <textarea name="keterangan" id="keterangan"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            rows="3" placeholder="Masukan keterangan saldo awal disini"></textarea>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#modal-tambah">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-edit"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden"
        role="dialog" tabindex="-1" aria-labelledby="modal-edit-label">
        <div
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-animation-target hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 id="modal-edit-label" class="font-bold text-gray-800 dark:text-white">
                        Edit Pemakaian
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:bg-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#modal-edit">
                        <span class="sr-only">Close</span>
                        <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/operational/pemakaian/update" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="p-4 space-y-2 overflow-y-auto">
                        <label for="saldo" class="block mb-2 text-sm font-medium dark:text-white">Pemakaian</label>
                        <div class="relative rounded-md">
                            <input type="text" name="saldo" id="saldo"
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                value="{{ old('saldo') }}">
                            <input type="hidden" id="nominal">
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                        <label for="keterangan" class="block mb-2 text-sm font-medium dark:text-white">Keterangan</label>
                        <textarea name="keterangan" id="edit-keterangan"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            rows="3" placeholder="Masukan keterangan saldo awal disini"></textarea>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#modal-edit">
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
    </div>

    <script>
        $(document).on('click', '.edit-catatan', function(e) {
            e.preventDefault();
            let post_id = $(this).data('id');
            $.ajax({
                url: `/operational/pemakaian/edit/${post_id}`,
                type: "GET",
                success: function(response) {
                    console.log(response);
                    $('#id').val(response.data.id);
                    $('#saldo').val(formatNominal(response.data.saldo));
                    $('#edit-keterangan').html(response.data.keterangan);
                    HSOverlay.open('#modal-edit');
                }
            });

            function formatNominal(value) {
                let formattedValue = new Intl.NumberFormat("id-ID").format(value);
                return formattedValue;
            }
        });
    </script>
@endsection
