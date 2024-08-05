@extends('layouts.dashboard')

@section('content')
    <!-- Grid for overview cards -->
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
        <!-- Card -->
        <div class="flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                        Total Barang Proses
                    </p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-neutral-200 sm:text-2xl">
                        {{ $barang_sedang_proses['count'] }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                        Total Barang Jadi
                    </p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-neutral-200 sm:text-2xl">
                        {{ $barang_sudah_jadi['count'] }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                        Total Karyawan Cutting
                    </p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-neutral-200 sm:text-2xl">
                        {{ $cutting }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                        Total Karyawan Jahit
                    </p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-neutral-200 sm:text-2xl">
                        {{ $jahit }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>

    <!-- Grid for detailed cards -->
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-2">
        <!-- Barang Proses Card -->
        <div class="flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2 border-b">
                    <p class="pb-2 font-medium uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                        Barang Mentah
                    </p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    @if ($barang_sedang_proses['data']->isEmpty())
                        <div class="mx-auto flex min-h-[400px] w-full max-w-sm flex-col justify-center px-6 py-4">
                            <div
                                class="size-[46px] flex items-center justify-center rounded-lg bg-gray-100 dark:bg-neutral-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="size-6 lucide lucide-package-search flex-shrink-0 text-gray-600 dark:text-neutral-400">
                                    <path
                                        d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                                    <path d="m7.5 4.27 9 5.15" />
                                    <polyline points="3.29 7 12 12 20.71 7" />
                                    <line x1="12" x2="12" y1="22" y2="12" />
                                    <circle cx="18.5" cy="15.5" r="2.5" />
                                    <path d="M20.27 17.27 22 19" />
                                </svg>
                            </div>
                            <h2 class="mt-5 font-semibold text-gray-800 dark:text-white">
                                Tidak ada Barang Mentah
                            </h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                Silahkan tambah Barang terlebih dahulu.
                            </p>
                            <div class="mt-5 grid gap-2 sm:flex">
                                <a href="/supplyer"
                                    class="inline-flex items-center justify-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Tambahkan Barang
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="inline-block min-w-full p-1.5 align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    No.</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Supplyer</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Kain</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Model</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Warna</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Jumlah</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Tanggal Datang</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Tanggal Jadi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                            @foreach ($barang_sedang_proses['data'] as $row)
                                                @php
                                                    $modelBarangMentah = \App\Models\KainBarangMentah::getByBarangMentah(
                                                        $row?->id,
                                                    );
                                                @endphp
                                                <tr class="text-center">
                                                    @foreach ($modelBarangMentah as $item)
                                                        @php
                                                            $warnaKain = \App\Models\WarnaKain::getByWarnaKain(
                                                                $item?->id,
                                                            );
                                                        @endphp
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                            {{ $loop->iteration }}.</td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                            {{ $row->supplyer->nama }}</td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                            {{ $item->warna }}</td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                            {{ $row->jumlah_mentah }} ({{ $row->satuan }})</td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                            {{ \Carbon\Carbon::parse($row->tanggal_datang)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="inline-flex items-center gap-x-1.5 rounded-full bg-red-400 px-3 py-1.5 text-xs font-medium text-white dark:bg-white/10 dark:text-white">Proses</span>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- End Barang Proses Card -->

        <!-- Barang Jadi Card -->
        <div class="flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2 border-b">
                    <p class="pb-2 font-medium uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                        Barang Jadi
                    </p>
                </div>
                <div class="mt-1 flex items-center gap-x-2">
                    @if ($barang_sudah_jadi['data']->isEmpty())
                        <div class="mx-auto flex min-h-[400px] w-full max-w-sm flex-col justify-center px-6 py-4">
                            <div
                                class="size-[46px] flex items-center justify-center rounded-lg bg-gray-100 dark:bg-neutral-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="size-6 lucide lucide-package-search flex-shrink-0 text-gray-600 dark:text-neutral-400">
                                    <path
                                        d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                                    <path d="m7.5 4.27 9 5.15" />
                                    <polyline points="3.29 7 12 12 20.71 7" />
                                    <line x1="12" x2="12" y1="22" y2="12" />
                                    <circle cx="18.5" cy="15.5" r="2.5" />
                                    <path d="M20.27 17.27 22 19" />
                                </svg>
                            </div>
                            <h2 class="mt-5 font-semibold text-gray-800 dark:text-white">
                                Tidak ada Barang Jadi
                            </h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                Silahkan selesaikan Barang terlebih dahulu.
                            </p>
                            <div class="mt-5 grid gap-2 sm:flex">
                                <a href="/barang"
                                    class="inline-flex items-center justify-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                                        <path d="M20 6 9 17l-5-5" />
                                    </svg>
                                    Selesaikan Barang
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="inline-block min-w-full p-1.5 align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    No.</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Supplyer</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Kain</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Model</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Warna</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Jumlah</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Tanggal Datang</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Tanggal Jadi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                            @foreach ($barang_sudah_jadi['data'] as $row)
                                                <tr class="text-center">
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        {{ $loop->iteration }}.</td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ $row->supplyer->nama }}</td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ $row->model->nama }}</td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ $row->warna->nama }}</td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ $row->jumlah_mentah }} ({{ $row->satuan }})</td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ \Carbon\Carbon::parse($row->tanggal_datang)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ \Carbon\Carbon::parse($row->tanggal_jadi)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- End Barang Jadi Card -->
    </div>
@endsection
