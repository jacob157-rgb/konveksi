@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div
                        class="grid gap-3 border-b border-gray-200 px-6 py-4 dark:border-neutral-700 md:flex md:items-center md:justify-between">
                        <a href="/barang/create"
                            class="inline-flex items-center justify-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                            Tambah Barang
                        </a>
                    </div>
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
                                                <a href="/barang/edit/{{ $row->id }}"
                                                    class="edit inline-flex items-center gap-x-2 rounded-lg border border-transparent text-sm font-semibold text-blue-600 hover:text-blue-800 disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400">Edit</a>
                                                <a href="/barang/show/{{ $row->id }}"
                                                    class="show inline-flex items-center gap-x-2 rounded-lg border border-transparent text-sm font-semibold text-green-600 hover:text-green-800 disabled:pointer-events-none disabled:opacity-50 dark:text-green-500 dark:hover:text-green-400">Detail</a>
                                                <form action="/kain/delete/{{ $row->id }}" method="post"
                                                    class="inline-flex">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-x-2 rounded-lg border border-transparent text-sm font-semibold text-red-600 hover:text-red-800 disabled:pointer-events-none disabled:opacity-50 dark:text-red-500 dark:hover:text-red-400">Hapus</button>
                                                </form>
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
