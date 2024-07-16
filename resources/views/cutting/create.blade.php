@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-900">
                        <div class=" mb-8">
                            <h2 class="text-xl md:text-xl font-bold text-gray-800 dark:text-neutral-200">
                                Pembagian Bahan ke proses cutting
                                <button type="button"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    data-hs-overlay="#hs-large-modal">
                                    Lihat Detail Barang
                                </button>
                            </h2>
                        </div>
                        <form action="/cutting" method="POST">
                            @csrf
                            <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                            <div
                                class="py-6 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                                <div class="mt-2 space-y-3">
                                    <p>Model</p>
                                    <input id="af-payment-billing-contact" name="jumlah_mentah" type="text"
                                        class="py-2 font-semibold px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        value="{{ $barang->model->nama }}" disabled>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Warna</p>
                                    <input id="af-payment-billing-contact" name="jumlah_mentah" type="text"
                                        class="py-2 font-semibold px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        value="{{ $barang->warna->nama }}" disabled>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Kain</p>
                                    <input id="af-payment-billing-contact" name="jumlah_mentah" type="text"
                                        class="py-2 font-semibold px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        value="{{ $barang->kain->nama }}" disabled>
                                </div>

                                <div class="mt-2 space-y-3">
                                    <p>Diberikan kepada</p>
                                    <div class="grid sm:flex gap-3">
                                        <select name="karyawan_id"
                                            class="py-2 px-3 pe-9 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih Cutting</option>
                                            @foreach ($karyawan as $kr)
                                                <option value="{{ $kr->id }}">{{ $kr->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Jumlah Ambil</p>
                                    <input id="af-payment-billing-contact" type="number" name="jumlah_ambil"
                                        class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan jumlah ambil bahan">
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Satuan Jumlah Barang</p>
                                    <div class="grid sm:flex gap-3">
                                        <select name="satuan"
                                            class="py-2 px-3 pe-9 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih satuan</option>
                                            <option value="kg">Kilo ( KG )</option>
                                            <option value="koli">Koli ( karung, box )</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Ongkos</p>
                                    <input id="af-payment-billing-contact" type="number" name="ongkos"
                                        class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan ongkos cutting">
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Tanggal Ambil</p>
                                    <input id="af-payment-billing-contact" type="datetime-local" name="tanggal_ambil"
                                        class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan ambil">
                                </div>
                            </div>
                            <div class=" flex justify-start gap-x-2">
                                <button id="bon" type="button"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                    Apakah ada BON ? ya ..
                                </button>
                            </div>
                            <div id="nominal-bon" class="py-6 first:pt-0 last:pb-0 hidden  first:border-transparent">
                                <div class="mt-2 space-y-3">
                                    <p>Nominal BON</p>
                                    <input id="af-payment-billing-contact" type="number" name="bon"
                                        class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan nominal BON">
                                </div>

                            </div>
                            <div class="mt-5 flex justify-end gap-x-2">
                                <button type="button"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg  border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
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
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all lg:max-w-4xl lg:w-full m-3 lg:mx-auto">
            <div
                class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Detail Barang
                    </h3>
                    <button type="button"
                        class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#hs-large-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div
                        class="py-6 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">

                        <div class="mt-2 space-y-3">
                            <p>Supplyer</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->supplyer->nama }}"
                                name="jumlah_mentah" type="text"
                                class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Model</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->model->nama }}"
                                name="jumlah_mentah" type="text"
                                class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Kain</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->kain->nama }}" name="jumlah_mentah"
                                type="text"
                                class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Warna</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->warna->nama }}"
                                name="jumlah_mentah" type="text"
                                class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Jumlah Barang Mentah</p>
                            <input id="af-payment-billing-contact" value="{{ $barang->jumlah_mentah }}"
                                name="jumlah_mentah" type="number"
                                class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan jumlah barang mentah">
                        </div>

                        <div class="mt-2 space-y-3">
                            <p>Satuan Jumlah Barang</p>
                            <div class="grid sm:flex gap-3">
                                <select name="satuan"
                                    class="py-2 px-3 pe-9 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
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
                                class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan harga">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Tanggal datang</p>
                            <input id="af-payment-billing-contact" type="datetime-local" name="tanggal_datang"
                                value="{{ $barang->tanggal_datang }}"
                                class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan harga">
                        </div>
                        <div class="mt-2 space-y-3">
                            <p>Tanggal jadi</p>
                            <input id="af-payment-billing-contact" type="datetime-local" name="tanggal_jadi"
                                value="{{ $barang->tanggal_jadi }}"
                                class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan harga">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800"
                        data-hs-overlay="#hs-large-modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $("#bon").click(function(){
            $("#nominal-bon").toggle();
          });
    </script>
@endsection
