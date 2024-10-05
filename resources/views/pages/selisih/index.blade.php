@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-green-600 border border-gray-200 rounded shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <h2 class="font-bold text-center text-white uppercase">ID : {{ $unique }}</h2>
    </div>

    <form action="{{ route('selisih.store') }}" method="post" id="addBarangMentahForm">
        @csrf
        <div class=" bg-white shadow-sm border rounded-lg start-0 top-0 z-[80]  overflow-y-auto overflow-x-hidden">
            <div class="p-4 -mt-2 space-y-2 overflow-y-auto">
                <input type="hidden" class="unique_id" name="unique_id" value="{{ $unique }}">

                <label for="tanggal" class="block mb-2 text-sm font-medium dark:text-white">Tanggal</label>
                <input type="datetime-local" name="tanggal" placeholder="Masukan Nominal Uang"
                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                    autofocus="" value="{{ old('tanggal') }}">
            </div>
            <div class="p-4 -mt-2 space-y-2 overflow-y-auto">
                <label for="nominal" class="block mb-2 text-sm font-medium dark:text-white">Nominal</label>
                <input type="number" name="nominal" placeholder="Masukan Nominal Uang"
                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                    autofocus="" value="{{ old('nominal') }}">
            </div>
            <div class="p-4 -mt-2 space-y-2 overflow-y-auto">
                <label for="nominal" class="block mb-2 text-sm font-medium dark:text-white">Keterangan</label>
                <textarea id="textarea-label" name="keterangan"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    rows="3" placeholder="Keterangan bersifat optional"></textarea>
            </div>

            <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                <button type="submit" id="submitFormBtn"
                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                    Kirim
                </button>
            </div>
        </div>
    </form>
@endsection
