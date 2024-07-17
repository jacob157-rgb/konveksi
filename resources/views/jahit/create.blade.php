@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="p-4 bg-white shadow rounded-xl dark:bg-neutral-900 sm:p-7">
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200 md:text-xl">
                                Pembagian Bahan Jahit ke Proses Jahit
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                                    data-hs-overlay="#hs-large-modal">
                                    Lihat Detail Barang
                                </button>
                            </h2>
                        </div>
                        <form action="/jahit" method="POST">
                            @csrf
                            <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                            <div
                                class="py-6 border-t border-gray-200 first:border-transparent first:pt-0 last:pb-0 dark:border-neutral-700 dark:first:border-transparent">
                                <div class="mt-2 space-y-3">
                                    <p>Model</p>
                                    <input id="af-payment-billing-contact" name="jumlah_mentah" type="text"
                                        class="block w-full px-3 py-2 text-sm font-semibold border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        value="{{ $barang->model->nama }}" disabled>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Warna</p>
                                    <input id="af-payment-billing-contact" name="jumlah_mentah" type="text"
                                        class="block w-full px-3 py-2 text-sm font-semibold border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        value="{{ $barang->warna->nama }}" disabled>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Kain</p>
                                    <input id="af-payment-billing-contact" name="jumlah_mentah" type="text"
                                        class="block w-full px-3 py-2 text-sm font-semibold border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        value="{{ $barang->kain->nama }}" disabled>
                                </div>

                                <div class="mt-2 space-y-3">
                                    <p>Diberikan kepada</p>
                                    <div class="grid gap-3 sm:flex">
                                        <select name="karyawan_id"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih Penjahit</option>
                                            @foreach ($karyawan as $kr)
                                                <option value="{{ $kr->id }}">{{ $kr->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Jumlah Ambil</p>
                                    <input id="af-payment-billing-contact" type="number" name="jumlah_ambil"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan jumlah ambil bahan">
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Satuan Jumlah Barang</p>
                                    <div class="grid gap-3 sm:flex">
                                        <select name="satuan"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih satuan</option>
                                            <option value="kg">Kilo ( KG )</option>
                                            <option value="koli">Koli ( karung, box )</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Ongkos</p>
                                    <div class="relative border rounded-md">
                                        <input type="text" id="harga" name="ongkos"
                                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
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
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Tanggal Ambil</p>
                                    <input id="af-payment-billing-contact" type="datetime-local" name="tanggal_ambil"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan ambil">
                                </div>

                            </div>
                            <div class="flex justify-start gap-x-2">
                                <button id="bon" type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-red-600 border border-transparent rounded-lg gap-x-2 hover:bg-red-700 disabled:pointer-events-none disabled:opacity-50">
                                    Apakah ada BON ? ya ..
                                </button>
                            </div>
                            <div id="nominal-bon" class="hidden py-6 first:border-transparent first:pt-0 last:pb-0">
                                <div class="mt-2 space-y-3">
                                    <p>Nominal BON</p>
                                    <div class="relative border rounded-md">
                                        <input type="text" id="harga" name="bon"
                                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
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
                                </div>

                            </div>
                            <div class="flex justify-end mt-5 gap-x-2">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="hs-large-modal"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden">
        <div
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 lg:mx-auto lg:w-full lg:max-w-4xl">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Detail Barang
                    </h3>
                    <button type="button"
                        class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-7 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#hs-large-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div
                        class="py-6 border-t border-gray-200 first:border-transparent first:pt-0 last:pb-0 dark:border-neutral-700 dark:first:border-transparent">

                        <div class="mt-2 space-y-3">
                            <p>Supplyer</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->supplyer->nama }}"
                                name="jumlah_mentah" type="text"
                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Model</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->model->nama }}"
                                name="jumlah_mentah" type="text"
                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Kain</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->kain->nama }}" name="jumlah_mentah"
                                type="text"
                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Warna</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->warna->nama }}"
                                name="jumlah_mentah" type="text"
                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Jumlah Barang Mentah</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->jumlah_mentah }}"
                                name="jumlah_mentah" type="number"
                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>

                        <div class="mt-2 space-y-3">
                            <p>Satuan Jumlah Barang</p>
                            <div class="grid gap-3 sm:flex">
                                <select name="satuan"
                                    class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option selected disabled>Pilih satuan</option>
                                    <option value="kg" {{ $barang->satuan == 'kg' ? 'selected' : '' }}>Kilo ( KG )
                                    </option>
                                    <option value="koli" {{ $barang->satuan == 'koli' ? 'selected' : '' }}>Koli (
                                        karung, box )</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Harga</p>
                            <input id="af-payment-billing-contact" type="number" name="harga"
                                value="{{ $barang->harga }}"
                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan harga">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Tanggal datang</p>
                            <input id="af-payment-billing-contact" type="datetime-local" name="tanggal_datang"
                                value="{{ $barang->tanggal_datang }}"
                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan harga">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Tanggal jadi</p>
                            <input id="af-payment-billing-contact" type="datetime-local" name="tanggal_jadi"
                                value="{{ $barang->tanggal_jadi }}"
                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan harga">
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                        data-hs-overlay="#hs-large-modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $("#bon").click(function() {
            $("#nominal-bon").toggle();
        });
    </script>
@endsection
