@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-green-600 border border-gray-200 shadow-sm rounded dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <h2 class="font-bold text-white uppercase text-center">SUPPLAYER {{ $supplyer->nama }}</h2>
    </div>
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">

                    <div class="pb-2 mt-5 border-b">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Kirim Barang Jadi</h2>
                    </div>

                    <form action="/" method="post">
                        @csrf
                        <input type="text" hidden value="{{ $supplyer->id }}">
                        <div class="p-4 overflow-y-auto">
                            <label for="tanggal_kirim" class="block mb-2 text-sm font-medium dark:text-white">Tanggal Kirim</label>
                            <input type="datetime-local" id="tanggal_kirim" name="tanggal_kirim"
                                class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                               autofocus="">

                            
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
    </div>
@endsection
