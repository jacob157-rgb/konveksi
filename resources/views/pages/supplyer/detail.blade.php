@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div
                        class="grid gap-3 px-6 py-4 border-b border-gray-200 dark:border-neutral-700 md:flex md:items-center md:justify-between">
                        <button type="button"
                            class="inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                            data-hs-overlay="#tambah-modal">
                            Tambah supplyer
                        </button>
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
                                            Tanggal Masuk</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Jenis Kain</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Model</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Warna</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Jml. Barang</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Harga Satuan</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Total Harga</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($barang as $row)
                                        <tr class="text-center">
                                            <td
                                                class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $loop->iteration }}.</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->tanggal_datang }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->kain_nama }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->model_nama }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->warna_nama }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->jumlah_mentah }}({{ $row->satuan }})</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ formatRupiah($row->harga) }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ formatRupiah(intval($row->harga) * $row->jumlah_mentah) }}</td>
                                            <td class="px-6 py-4 space-x-2 text-sm font-medium whitespace-nowrap">
                                                <button type="button" data-id="" data-hs-overlay="#tambah-barang"
                                                    class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg edit gap-x-2 hover:text-blue-800 disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400">Kirim
                                                    Barang Jadi</button>
                                                <form action="/supplyer/delete/" method="post"
                                                    class="inline-flex delete-form">
                                                    {{-- @csrf --}}
                                                    <button type="button"
                                                        class="inline-flex items-center text-sm font-semibold text-red-600 border border-transparent rounded-lg delete gap-x-2 hover:text-red-800 disabled:pointer-events-none disabled:opacity-50 dark:text-red-500 dark:hover:text-red-400">
                                                        Hapus
                                                    </button>
                                                </form>
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
    {{-- <div id="tambah-barang"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden">
        <div
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Tambah Barang
                    </h3>
                    <button type="button"
                        class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-7 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#tambah-barang">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/barang" method="post">
                    @csrf
                    <div class="p-4 space-y-2 overflow-y-auto">
                        <input type="hidden" name="supplyer_id" value="">
                        <label for="tanggal_datang" class="block mb-2 text-sm font-medium dark:text-white">Tanggal
                            Masuk</label>
                        <input type="datetime-local" name="tanggal_datang"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            autofocus="">
                        <label for="kain_id" class="block mb-2 text-sm font-medium dark:text-white">Jenis Kain</label>
                        <select name="kain_id"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option selected="">Pilih Jenis Kain</option>
                            @foreach ($barang as $row)
                                <option>{{ $row->kain_nama }}</option>
                            @endforeach
                        </select>
                        <label for="model_id" class="block mb-2 text-sm font-medium dark:text-white">Model</label>
                        <select name="model_id"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option selected="">Pilih Model</option>
                                <option>{{ $row->model_nama }}</option>
                            @endforeach
                        </select>
                        <label for="warna_id" class="block mb-2 text-sm font-medium dark:text-white">Warna</label>
                        <select name="warna_id"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option selected="">Pilih Model</option>
                            @foreach ($warna as $row)
                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                            @endforeach
                        </select>
                        <div>
                            <label for="hs-inline-leading-pricing-select-label"
                                class="block mb-2 text-sm font-medium dark:text-white">Jml. Barang</label>
                            <div class="relative">
                                <input type="number" id="hs-inline-leading-pricing-select-label" name="jumlah_mentah"
                                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg shadow-sm jumlah pe-20 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Masukan Jumlah Barang">
                                <div class="absolute inset-y-0 flex items-center text-gray-500 end-0 pe-px">
                                    <label for="satuan" class="sr-only">Satuan</label>
                                    <select id="satuan" name="satuan"
                                        class="block w-full border border-transparent rounded-lg focus:border-blue-600 focus:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-500">
                                        <option value="kg" selected>Kg</option>
                                        <option value="yard">Yard</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label for="harga" class="block mb-2 text-sm font-medium dark:text-white">Harga Barang</label>
                        <div class="relative rounded-md">
                            <input type="text" name="harga"
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <input type="hidden" id="nominal">
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                        <label for="total" class="block mb-2 text-sm font-medium dark:text-white">Total Harga</label>
                        <div class="relative rounded-md">
                            <input type="text" readonly
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm total price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <input type="hidden" id="total" readonly>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#tambah-barang">
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
    </div> --}}
@endsection
