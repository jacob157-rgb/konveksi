@extends('layouts.dashboard')
@push('addon_style')
    <style>
        img {
            max-width: 30% !important;
            height: auto !important;
            border-radius: 10px;
        }
    </style>
@endpush
@section('content')
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <h2 class="font-bold text-gray-800 mb-3 dark:text-white">
                Detail Model {{ $detail->nama }}
            </h2>
            <div class=" overflow-x-auto">
                <form>
                    <div class="">
                        <div id="editor">
                            {!! $detail->keterangan !!}
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <a href="/model"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#tambah-modal">
                            Kembali Kedepan
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
