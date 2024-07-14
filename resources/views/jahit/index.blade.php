@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <h4 class="font-bold">Daftar barang</h4>
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
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
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($barang as $row)
                                        <tr class="text-center">
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $loop->iteration }}.</td>
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $row->supplyer->nama }}</td>
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $row->kain->nama }}</td>
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

                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <a href="/jahit/create/{{ $row->id }}"
                                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                    Tambah Jahit
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-circle-fading-plus">
                                                        <path d="M12 2a10 10 0 0 1 7.38 16.75" />
                                                        <path d="M12 8v8" />
                                                        <path d="M16 12H8" />
                                                        <path d="M2.5 8.875a10 10 0 0 0-.5 3" />
                                                        <path d="M2.83 16a10 10 0 0 0 2.43 3.4" />
                                                        <path d="M4.636 5.235a10 10 0 0 1 .891-.857" />
                                                        <path d="M8.644 21.42a10 10 0 0 0 7.631-.38" />
                                                    </svg>
                                                </a>
                                                <a href="/barang/show/{{ $row->id }}"
                                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-600 text-white hover:bg-yellow-700 disabled:opacity-50 disabled:pointer-events-none">
                                                    History
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-history">
                                                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                                        <path d="M3 3v5h5" />
                                                        <path d="M12 7v5l4 2" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
