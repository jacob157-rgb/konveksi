@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-green-600 border border-gray-200 shadow-sm rounded dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <h2 class="font-bold text-white uppercase text-center">SUPPLAYER {{ $supplayer->nama }}</h2>
    </div>

    <div class="m-auto justify-center flex">
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="?barang=datang"
                class="py-2.5 px-3 w-40 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 {{ !request()->query('barang') || request()->query('barang') == 'datang' ? 'bg-green-500 text-white font-bold uppercase' : 'bg-white' }} text-gray-800 shadow-sm  focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                Barang Datang
            </a>

            <div class="border-t sm:border-t-0 sm:border-s border-gray-200 dark:border-neutral-700"></div>

            <a href="?barang=kirim"
                class="py-2.5 px-3 w-40  inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 {{ request()->query('barang') == 'kirim' ? 'bg-green-500 text-white font-bold uppercase' : 'bg-white' }} text-gray-800 shadow-sm focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                Barang Kirim
            </a>
        </div>
    </div>

    @if (!request()->query('barang') || request()->query('barang') == 'datang')
        @include('partials.barang_datang')
    @elseif(request()->query('barang') == 'kirim')
        @include('partials.barang_kirim')
    @endif
@endsection
