@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-900">
                        <div class=" mb-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-neutral-200">
                                Tambah Barang Supplyer
                            </h2>
                        </div>

                        <form action="/barang/update/{{ $barang->id }}" method="POST">
                            @csrf
                            <div
                                class="py-6 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                                <div class="mt-2 space-y-3">
                                    <p>Supplyer</p>
                                    <div class="grid sm:flex gap-3">
                                        <select name="supplyer_id"
                                            class="py-2 px-3 pe-9 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih Supplyer</option>
                                            @foreach ($supplyer as $supplyer)
                                                <option value="{{ $supplyer->id }}" {{ $barang->supplyer_id == $supplyer->id ? 'selected' : '' }}>{{ $supplyer->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Kain</p>
                                    <div class="grid sm:flex gap-3">
                                        <select name="kain_id"
                                            class="py-2 px-3 pe-9 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih Kain</option>
                                            @foreach ($kain as $kain)
                                                <option value="{{ $kain->id }}" {{ $barang->kain_id == $kain->id ? 'selected' : '' }}>{{ $kain->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Model</p>
                                    <div class="grid sm:flex gap-3">
                                        <select name="model_id"
                                            class="py-2 px-3 pe-9 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih model</option>
                                            @foreach ($model as $mdl)
                                                <option value="{{ $mdl->id }}" {{ $barang->model_id == $mdl->id ? 'selected' : '' }}>{{ $mdl->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Warna</p>
                                    <div class="grid sm:flex gap-3">
                                        <select name="warna_id"
                                            class="py-2 px-3 pe-9 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option disabled>Pilih warna</option>
                                            @foreach ($warna as $wr)
                                                <option value="{{ $wr->id }}" {{ $barang->warna_id == $wr->id ? 'selected' : '' }}>{{ $wr->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-2 space-y-3">
                                    <p>Jumlah Barang Mentah</p>
                                    <input id="af-payment-billing-contact" value="{{ $barang->jumlah_mentah }}" name="jumlah_mentah" type="number"
                                        class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan jumlah barang mentah">
                                </div>

                                <div class="mt-2 space-y-3">
                                    <p>Satuan Jumlah Barang</p>
                                    <div class="grid sm:flex gap-3">
                                        <select name="satuan"
                                            class="py-2 px-3 pe-9 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih satuan</option>
                                            <option value="kg" {{ $barang->satuan == 'kg' ? 'selected' : '' }}>Kilo ( KG )</option>
                                            <option value="koli" {{ $barang->satuan == 'koli' ? 'selected' : '' }}>Koli ( karung, box )</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Harga</p>
                                    <input id="af-payment-billing-contact" type="number" name="harga" value="{{ $barang->harga }}"
                                        class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan harga">
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Tanggal datang</p>
                                    <input id="af-payment-billing-contact" type="datetime-local" name="tanggal_datang" value="{{ $barang->tanggal_datang }}"
                                        class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan harga">
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Tanggal jadi</p>
                                    <input id="af-payment-billing-contact" type="datetime-local" name="tanggal_jadi" value="{{ $barang->tanggal_jadi }}"
                                        class="py-2 px-3 pe-11 border block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan harga">
                                </div>
                            </div>
                            <div class="mt-5 flex justify-end gap-x-2">
                                <button type="button"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
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
@endsection
