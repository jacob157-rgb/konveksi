@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-green-600 border border-gray-200 rounded shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <h2 class="font-bold text-center text-white uppercase">{{ $karyawan->nama }}</h2>
    </div>

    @include('partials.jahit_kembali')
@endsection
