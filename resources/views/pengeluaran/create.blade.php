@extends('layouts.dashboard')

@section('content')
    <div class="inline-block min-w-full p-1.5 align-middle">
        <div class="p-4 bg-white shadow rounded-xl dark:bg-neutral-900 sm:p-7">
            <h1 class="mb-4 text-2xl font-bold">Tambah Pengeluaran</h1>
            <form action="/pengeluaran" method="POST">
                @csrf
                <div class="mt-2 space-y-3">
                    <p>Nominal</p>
                    <div class="relative border rounded-md">
                        <input type="text" id="harga" name="nominal"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        <input type="hidden" id="nominal">
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                            <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                        </div>
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                            <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                        </div>
                    </div>
                </div>
                <div class="mt-2 space-y-3">
                    <p>Keterangan</p>
                    <textarea name="keterangan"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        rows="3" placeholder="Tuliskan Keterangan Pengeluaran disini."></textarea>
                </div>
                <div class="flex justify-end mt-5 gap-x-2">
                    <a href="/pengeluaran"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
