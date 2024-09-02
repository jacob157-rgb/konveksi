@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-green-600 border border-gray-200 rounded shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <h2 class="font-bold text-center text-white uppercase">SUPPLAYER {{ $supplayer->nama }}</h2>
    </div>

    <div class="flex justify-center m-auto">
        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="?barang=datang"
                class="{{ !request()->query('barang') || request()->query('barang') == 'datang' ? 'bg-green-500 text-white font-bold uppercase' : 'bg-white' }} dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 inline-flex w-40 items-center justify-center gap-x-2 rounded-lg border border-gray-200 px-3 py-2.5 text-sm font-medium text-gray-800 shadow-sm focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                Barang Datang
            </a>

            <div class="border-t border-gray-200 dark:border-neutral-700 sm:border-s sm:border-t-0"></div>

            <a href="?barang=kirim"
                class="{{ request()->query('barang') == 'kirim' ? 'bg-green-500 text-white font-bold uppercase' : 'bg-white' }} dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 inline-flex w-40 items-center justify-center gap-x-2 rounded-lg border border-gray-200 px-3 py-2.5 text-sm font-medium text-gray-800 shadow-sm focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                Barang Kirim
            </a>

            <div class="border-t border-gray-200 dark:border-neutral-700 sm:border-s sm:border-t-0"></div>

            <a href="?barang=selisih"
                class="{{ request()->query('barang') == 'selisih' ? 'bg-green-500 text-white font-bold uppercase' : 'bg-white' }} dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 inline-flex w-40 items-center justify-center gap-x-2 rounded-lg border border-gray-200 px-3 py-2.5 text-sm font-medium text-gray-800 shadow-sm focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                Selisih
            </a>
        </div>
    </div>

    @if (!request()->query('barang') || request()->query('barang') == 'datang')
        @include('partials.barang_datang')
    @elseif(request()->query('barang') == 'kirim')
        @include('partials.barang_kirim')
    @else
        @include('partials.selisih')
    @endif
@endsection
