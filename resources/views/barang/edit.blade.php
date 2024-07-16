@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="p-4 bg-white shadow rounded-xl dark:bg-neutral-900 sm:p-7">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-neutral-200 md:text-3xl">
                                Tambah Barang Supplyer
                            </h2>
                        </div>

                        <form action="/barang/update/{{ $barang->id }}" method="POST">
                            @csrf
                            <div
                                class="py-6 border-t border-gray-200 first:border-transparent first:pt-0 last:pb-0 dark:border-neutral-700 dark:first:border-transparent">
                                <div class="mt-2 space-y-3">
                                    <p>Supplyer</p>
                                    <div class="grid gap-3 sm:flex">
                                        <select name="supplyer_id"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih Supplyer</option>
                                            @foreach ($supplyer as $supplyer)
                                                <option value="{{ $supplyer->id }}"
                                                    {{ $barang->supplyer_id == $supplyer->id ? 'selected' : '' }}>
                                                    {{ $supplyer->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Kain</p>
                                    <div class="grid gap-3 sm:flex">
                                        <select name="kain_id"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih Kain</option>
                                            @foreach ($kain as $kain)
                                                <option value="{{ $kain->id }}"
                                                    {{ $barang->kain_id == $kain->id ? 'selected' : '' }}>
                                                    {{ $kain->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Model</p>
                                    <div class="grid gap-3 sm:flex">
                                        <select name="model_id"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih model</option>
                                            @foreach ($model as $mdl)
                                                <option value="{{ $mdl->id }}"
                                                    {{ $barang->model_id == $mdl->id ? 'selected' : '' }}>
                                                    {{ $mdl->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Warna</p>
                                    <div class="grid gap-3 sm:flex">
                                        <select name="warna_id"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option disabled>Pilih warna</option>
                                            @foreach ($warna as $wr)
                                                <option value="{{ $wr->id }}"
                                                    {{ $barang->warna_id == $wr->id ? 'selected' : '' }}>
                                                    {{ $wr->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                            <option value="kg" {{ $barang->satuan == 'kg' ? 'selected' : '' }}>Kilo (
                                                KG )</option>
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
                            </div>
                            <div class="flex justify-end mt-5 gap-x-2">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
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
@endsection
