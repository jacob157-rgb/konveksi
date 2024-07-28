@extends('layouts.dashboard')

@section('content')
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="mb-5 flex items-center justify-between pb-5">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Detail Karyawan</h2>
            </div>
            <div class="mt-2 inline-flex gap-x-2">
                <a target="blank" class="inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                    href="/karyawan/print/{{ $karyawan->id }}">
                    <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9" />
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                        <rect width="12" height="8" x="6" y="14" />
                    </svg>
                    Print
                </a>
            </div>
        </div>
        <hr>
        <table border="1" class="my-5">
            <tr>
                <td class="font-medium">Nama Cutting</td>
                <td>&nbsp; : &nbsp;{{ $karyawan->nama }}</td>
            </tr>
            <tr>
                <td class="font-medium">No. Tlp</td>
                <td>&nbsp; : &nbsp;{{ $karyawan->no }}</td>
            </tr>
            <tr>
                <td class="font-medium">Alamat</td>
                <td>&nbsp; : &nbsp;{{ $karyawan->alamat }}</td>
            </tr>
        </table>
       
        <div class="mb-5 flex items-center justify-between pb-5">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Histori BON</h2>
            </div>
        </div>
        <hr>


    </div>



@endsection
