@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div
                        class="grid gap-3 px-6 py-4 border-0 border-gray-200 dark:border-neutral-700 md:flex md:items-center md:justify-between">
                        <button type="button"
                            class="inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                            data-hs-overlay="#tambah-modal">
                            Tambah karyawan
                        </button>
                    </div>
                    <div class="pb-2 mt-5 border-b">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Karyawan Cutting</h2>
                    </div>
                    <div class="inline-block min-w-full p-1.5 align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            No.</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Nama</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Jenis</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Nomor Hp</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Alamat</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($karyawanCutting as $row)
                                        <tr class="text-center">
                                            <td
                                                class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $loop->iteration }}.</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->nama }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->jenis_karyawan }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->no }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->alamat }}</td>
                                            <td
                                                class="flex items-center justify-center px-6 py-4 space-x-2 text-sm font-medium">
                                                <a href="/karyawan/cutting/ambil/{{ $row->id }}"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-full tambah-barang gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                    Ambil Cutting
                                                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="lucide lucide-scissors">
                                                        <circle cx="6" cy="6" r="3" />
                                                        <path d="M8.12 8.12 12 12" />
                                                        <path d="M20 4 8.12 15.88" />
                                                        <circle cx="6" cy="18" r="3" />
                                                        <path d="M14.8 14.8 20 20" />
                                                    </svg>
                                                </a>
                                                <a href="/karyawan/cutting/kembali/{{ $row->id }}"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-full kirim-barang gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                    Kembalikan Cutting
                                                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="lucide lucide-scissors">
                                                        <circle cx="6" cy="6" r="3" />
                                                        <path d="M8.12 8.12 12 12" />
                                                        <path d="M20 4 8.12 15.88" />
                                                        <circle cx="6" cy="18" r="3" />
                                                        <path d="M14.8 14.8 20 20" />
                                                    </svg>
                                                </a>
                                                <a href="/karyawan/detail/{{ $row->id }}"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-full gap-x-2 hover:bg-green-700 focus:bg-green-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                    Detail
                                                </a>
                                                <div class="inline-block hs-tooltip">
                                                    <button type="button" data-id="{{ $row->id }}"
                                                        data-hs-overlay="#edit-modal"
                                                        class="hs-tooltip-toggle edit-tanggal inline-flex items-center justify-center gap-x-2 rounded-s-md bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="blue"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>
                                                        <span
                                                            class="absolute z-10 invisible inline-block px-4 py-2 font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                            role="tooltip">
                                                            Edit
                                                        </span>
                                                    </button>
                                                </div>
                                                <div class="inline-block hs-tooltip">
                                                    <form action="/karyawan/delete/{{ $row->id }}" method="post"
                                                        data-id="{{ $row?->id }}" style="display: inline-block;">
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
                                                                class="absolute z-10 invisible inline-block px-4 py-2 font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 delete hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
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
                    </div>

                    <div class="pb-2 mt-5 border-b">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Karyawan Jahit</h2>
                    </div>
                    <div class="inline-block min-w-full p-1.5 align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            No.</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Nama</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Jenis</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Nomor Hp</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Alamat</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($karyawanJahit as $row)
                                        <tr class="text-center">
                                            <td
                                                class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $loop->iteration }}.</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->nama }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->jenis_karyawan }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->no }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->alamat }}</td>
                                            <td
                                                class="flex items-center justify-center px-6 py-4 space-x-2 text-sm font-medium">
                                                <a href="/barang/mentah/{{ $row->id }}"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-full tambah-barang gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                    Ambil Jahit
                                                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-shirt">
                                                        <path
                                                            d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z" />
                                                    </svg>
                                                </a>
                                                <a href="/barang/jadi/{{ $row->id }}"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-full kirim-barang gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                    Kembalikan Jahit
                                                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-shirt">
                                                        <path
                                                            d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z" />
                                                    </svg>
                                                </a>
                                                <a href="/supplyer/detail/{{ $row->id }}"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-full gap-x-2 hover:bg-green-700 focus:bg-green-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                    Detail
                                                </a>
                                                <div class="inline-block hs-tooltip">
                                                    <button type="button" data-id="{{ $row->id }}"
                                                        data-hs-overlay="#edit-modal"
                                                        class="hs-tooltip-toggle edit-tanggal inline-flex items-center justify-center gap-x-2 rounded-s-md bg-white px-1.5 py-1 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="blue"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>
                                                        <span
                                                            class="absolute z-10 invisible inline-block px-4 py-2 font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                                                            role="tooltip">
                                                            Edit
                                                        </span>
                                                    </button>
                                                </div>
                                                <div class="inline-block hs-tooltip">
                                                    <form action="/karyawan/delete/{{ $row->id }}" method="post"
                                                        data-id="{{ $row?->id }}" style="display: inline-block;">
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
                                                                class="absolute z-10 invisible inline-block px-4 py-2 font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 delete hs-tooltip-content hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tambah-modal"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden">
        <div
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Tambah Jenis karyawan
                    </h3>
                    <button type="button"
                        class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-7 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#tambah-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/karyawan" method="post">
                    @csrf
                    <div class="p-4 overflow-y-auto">
                        <label for="nama" class="block mb-2 text-sm font-medium dark:text-white">Nama</label>
                        <input type="text" id="nama" name="nama"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Nama karyawan" autofocus="">

                        <label for="jenis_karyawan" class="block mb-2 text-sm font-medium dark:text-white">Jenis
                            Karyawan</label>
                        <select id="jenis_karyawan" name="jenis_karyawan"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500">
                            <option value="cutting">Cutting</option>
                            <option value="jahit">Jahit</option>
                        </select>

                        <label for="no" class="block mb-2 text-sm font-medium dark:text-white">Nomor Hp</label>
                        <input type="text" id="no" name="no" maxlength="15"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Nomor karyawan">

                        <label for="alamat" class="block mb-2 text-sm font-medium dark:text-white">Alamat</label>
                        <input type="text" id="alamat" name="alamat"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Alamat karyawan">
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#tambah-modal">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                            Tambah
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="edit-modal"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden">
        <div
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Edit Jenis karyawan
                    </h3>
                    <button type="button"
                        class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-7 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#edit-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/karyawan/update" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id_model">
                    <div class="p-4 overflow-y-auto">
                        <label for="nama_model" class="block mb-2 text-sm font-medium dark:text-white">Nama</label>
                        <input type="text" id="nama_model" name="nama"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Nama" autofocus="">
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <label for="jenis_karyawan_model" class="block mb-2 text-sm font-medium dark:text-white">Jenis
                            Karyawan</label>
                        <select id="jenis_karyawan_model" name="jenis_karyawan"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500">
                            <option value="cutting">Cutting</option>
                            <option value="jahit">Jahit</option>
                        </select>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <label for="no_model" class="block mb-2 text-sm font-medium dark:text-white">No</label>
                        <input type="text" id="no_model" name="no"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan No">
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <label for="alamat_model" class="block mb-2 text-sm font-medium dark:text-white">Alamat</label>
                        <input type="text" id="alamat_model" name="alamat"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Alamat">
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#edit-modal">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.edit', function(e) {
            let model_id = $(this).data('id');
            $.ajax({
                url: `/karyawan/edit/${model_id}`,
                type: "GET",
                success: function(response) {
                    $('#id_model').val(response.data.id);
                    $('#nama_model').val(response.data.nama);
                    $('#jenis_karyawan_model').val(response.data
                        .jenis_karyawan); // Tambahkan input jenis karyawan
                    $('#no_model').val(response.data.no); // Tambahkan input no
                    $('#alamat_model').val(response.data.alamat); // Tambahkan input alamat
                    $('#edit-modal').addClass('hs-overlay-open');
                }
            });
        });
    </script>
@endsection
