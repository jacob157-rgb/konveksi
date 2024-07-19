@extends('layouts.dashboard')

@section('content')
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between pb-5 mb-5">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Histori Barang</h2>
            </div>
            <div class="inline-flex mt-2 gap-x-2">
                <a target="blank"
                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                    href="/barang/print/{{ $barang->id }}">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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
                <td class="font-medium">Nama Supplyer</td>
                <td class="flex items-center space-x-2">
                    <span>&nbsp;: &nbsp;</span>
                    <span>{{ $barang->supplyer->nama }}</span>
                </td>
            </tr>
            <tr>
                <td class="font-medium">Model</td>
                <td class="flex items-center space-x-2">
                    <span>&nbsp;: &nbsp;</span>
                    <span>{{ $barang->model->nama }}</span>
                </td>
            </tr>
            <tr>
                <td class="font-medium">Kain</td>
                <td class="flex items-center space-x-2">
                    <span>&nbsp;: &nbsp;</span>
                    <span>{{ $barang->kain->nama }}</span>
                </td>
            </tr>
            <tr>
                <td class="font-medium">Warna</td>
                <td class="flex items-center space-x-2">
                    <span>&nbsp;: &nbsp;</span>
                    <span>{{ $barang->warna->nama }}</span>
                </td>
            </tr>
            <tr>
                <td class="font-medium">Harga Satuan</td>
                <td class="flex items-center space-x-2">
                    <span>&nbsp;: &nbsp;</span>
                    <span>{{ formatRupiah($barang->harga) }}</span>
                </td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Datang</td>
                <td class="flex items-center space-x-2">
                    <span>&nbsp;: &nbsp;</span>
                    <span>{{ \Carbon\Carbon::parse($barang->tanggal_datang)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}</span>
                </td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Selesai</td>
                <td class="flex items-center space-x-2">
                    <span>&nbsp;: &nbsp;</span>
                    @if ($barang->tanggal_jadi)
                        <span>{{ \Carbon\Carbon::parse($barang->tanggal_jadi)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}</span>
                    @else
                        <form action="/barang/selesai/{{ $barang->id }}" method="post" class="inline-flex">
                            @csrf
                            <button data-id="{{ $barang->id }}"
                                class="selesaikan-btn inline-flex items-center gap-x-1.5 rounded-full bg-red-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">
                                Selesaikan
                            </button>
                        </form>
                    @endif
                </td>
            </tr>

            @if ($barang->tanggal_jadi)
                <tr>
                    <td class="font-medium">Status</td>
                    <td class="flex items-center space-x-2">
                        <span>&nbsp;: &nbsp;</span>
                        <button
                            class="inline-flex items-center gap-x-1.5 rounded-full bg-green-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">
                            Selesai</button>
                    </td>
                </tr>
            @endif
        </table>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                        Jumlah Mentah</th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                        Jumlah Cutting</th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                        Jumlah Jait</th>

                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                        Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                <tr class="text-center">
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        {{ $barang->jumlah_mentah }} ({{ $barang->satuan }})</td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        {{ $barang->jumlah_cutting }} ({{ $barang->satuan }})</td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        {{ $barang->jumlah_jahit }} ({{ $barang->satuan }})</td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        @if ($barang->jumlah_mentah == $barang->jumlah_cutting + $barang->jumlah_jahit)
                            <span
                                class="inline-flex items-center gap-x-1.5 rounded-full bg-green-500 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">proses
                                selesai</span>
                        @elseif($barang->tanggal_jadi != null)
                            <span
                                class="inline-flex items-center gap-x-1.5 rounded-full bg-green-500 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">proses
                                selesai</span>
                        @else
                            <span
                                class="inline-flex items-center gap-x-1.5 rounded-full bg-red-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">Masih
                                proses</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="pb-2 border-b">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Histori Cutting</h2>
            </div>
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full border-b divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        No.</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Nama Karyawan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Jml. Ambil</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Jml. Kembali</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Tgl. Ambil</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">
                                        Tgl. Kembali</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Ongkos</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">
                                        BON</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @php
                                    $totalOngkosCutting = 0;
                                    $totalBonCutting = 0;
                                @endphp
                                @foreach ($cutting as $row)
                                    @php
                                        $bonCutting = \App\Models\Bon::getCutting($row->karyawan_id, $row->id);
                                        $totalOngkosCutting += $row->ongkos;
                                        $totalBonCutting += $bonCutting?->nominal;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $loop->iteration }}.</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $row->karyawan->nama }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $row->jumlah_ambil }} ({{ $row->satuan }})</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            @if ($row->jumlah_kembali)
                                                {{ $row->jumlah_kembali }} ({{ $row->satuan }})
                                            @else
                                                <span class="text-red-600">Belum selesai</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ \Carbon\Carbon::parse($row->tanggal_ambil)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            @if ($row->tanggal_kembali)
                                                {{ \Carbon\Carbon::parse($row->tanggal_kembali)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                            @else
                                                <span class="text-red-600">Belum selesai</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $row->status }}</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ formatRupiah($row->ongkos) }}</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            @if ($bonCutting?->status == 'lunas')
                                                <span
                                                    class="line-through">{{ formatRupiah($bonCutting?->nominal) }}</span><br>
                                                <span class="text-green-700">Lunas</span>
                                            @else
                                                <span class="">{{ formatRupiah($bonCutting?->nominal) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                            <div class="hs-dropdown relative m-1 inline-flex [--trigger:hover]">
                                                <button id="hs-dropdown-hover-event" type="button"
                                                    class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-500 border border-gray-200 rounded-lg shadow-sm hs-dropdown-toggle gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                    Aksi
                                                    <svg class="size-4 hs-dropdown-open:rotate-180"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="m6 9 6 6 6-6" />
                                                    </svg>
                                                </button>

                                                <div class="hs-dropdown-menu duration min-w-60 z-10 mt-2 hidden rounded-lg bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] before:absolute before:-top-4 before:start-0 before:h-4 before:w-full after:absolute after:-bottom-4 after:start-0 after:h-4 after:w-full hs-dropdown-open:opacity-100 dark:divide-neutral-700 dark:border dark:border-neutral-700 dark:bg-neutral-800"
                                                    aria-labelledby="hs-dropdown-hover-event">
                                                    <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        href="/barang/pengembalian/cutting/detail/{{ $barang->id }}/{{ $row->id }}">
                                                        Cek Detail
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        href="/barang/pengembalian/cutting/{{ $barang->id }}/{{ $row->id }}">
                                                        Pengembalian
                                                    </a>

                                                    <form action="/cutting/delete/{{ $row->id }}" method="post">
                                                        @csrf
                                                        <button
                                                            class="flex w-full items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                            type="submit">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex flex-col p-4 mt-2 font-medium bg-yellow-400">
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <span class="text-gray-800 uppercase dark:text-neutral-200">
                        Jumlah Pengeluaran Cutting:
                    </span>
                    <span class="text-gray-800 uppercase dark:text-neutral-200 sm:ml-2">
                        {{ formatRupiah($totalOngkosCutting) }} - {{ formatRupiah($totalBonCutting) }} =
                        {{ formatRupiah($totalOngkosCutting - $totalBonCutting) }}
                    </span>
                </div>
                <span class="text-sm font-light">
                    ⁱ Jumlah didapatkan dari total keseluruhan ongkos cutting - total keseluruhan bon cutting
                </span>
            </div>
        </div>
    </div>
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="pb-2 border-b">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Histori Jahit</h2>
            </div>
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full border-b divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        No.</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Nama Karyawan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Jml. Ambil</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Jml. Kembali</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Tgl. Ambil</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">
                                        Tgl. Kembali</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Ongkos</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">
                                        BON</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @php
                                    $totalOngkosJahit = 0;
                                    $totalBonJahit = 0;
                                @endphp
                                @foreach ($jahit as $row)
                                    @php
                                        $bonJahit = \App\Models\Bon::getJahit($row->karyawan_id, $row->id);
                                        $totalOngkosJahit += $row->ongkos;
                                        $totalBonJahit += $bonJahit?->nominal;
                                    @endphp
                                    <tr>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $loop->iteration }}.</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $row->karyawan->nama }}</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $row->jumlah_ambil }} ({{ $row->satuan }})</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            @if ($row->jumlah_kembali)
                                                {{ $row->jumlah_kembali }} ({{ $row->satuan }})
                                            @else
                                                <span class="text-red-600">Belum selesai</span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ \Carbon\Carbon::parse($row->tanggal_ambil)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            @if ($row->tanggal_kembali)
                                                {{ \Carbon\Carbon::parse($row->tanggal_kembali)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                            @else
                                                <span class="text-red-600">Belum selesai</span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $row->status }}</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ formatRupiah($row->ongkos) }}</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            @if ($bonJahit?->status == 'lunas')
                                                <span
                                                    class="line-through">{{ formatRupiah($bonJahit?->nominal) }}</span><br>
                                                <span class="text-green-700">Lunas</span>
                                            @else
                                                <span class="">{{ formatRupiah($bonJahit?->nominal) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                            <div class="hs-dropdown relative m-1 inline-flex [--trigger:hover]">
                                                <button id="hs-dropdown-hover-event" type="button"
                                                    class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-500 border border-gray-200 rounded-lg shadow-sm hs-dropdown-toggle gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                    Aksi
                                                    <svg class="size-4 hs-dropdown-open:rotate-180"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="m6 9 6 6 6-6" />
                                                    </svg>
                                                </button>

                                                <div class="hs-dropdown-menu duration min-w-60 z-10 mt-2 hidden rounded-lg bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] before:absolute before:-top-4 before:start-0 before:h-4 before:w-full after:absolute after:-bottom-4 after:start-0 after:h-4 after:w-full hs-dropdown-open:opacity-100 dark:divide-neutral-700 dark:border dark:border-neutral-700 dark:bg-neutral-800"
                                                    aria-labelledby="hs-dropdown-hover-event">
                                                    <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        href="/barang/pengembalian/jahit/detail/{{ $barang->id }}/{{ $row->id }}">
                                                        Cek Detail
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        href="/barang/pengembalian/jahit/{{ $barang->id }}/{{ $row->id }}">
                                                        Pengembalian
                                                    </a>

                                                    <form action="/jahit/delete/{{ $row->id }}" method="post">
                                                        @csrf
                                                        <button
                                                            class="flex w-full items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                            type="submit">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex flex-col p-4 mt-2 font-medium bg-yellow-400">
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <span class="text-gray-800 uppercase dark:text-neutral-200">
                        Jumlah Pengeluaran Jahit:
                    </span>
                    <span class="text-gray-800 uppercase dark:text-neutral-200 sm:ml-2">
                        {{ formatRupiah($totalOngkosJahit) }} - {{ formatRupiah($totalBonJahit) }} =
                        {{ formatRupiah($totalOngkosJahit - $totalBonJahit) }}
                    </span>
                </div>
                <span class="text-sm font-light">
                    ⁱ Jumlah didapatkan dari total keseluruhan ongkos jahit - total keseluruhan bon jahit
                </span>
            </div>
        </div>
    </div>
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="flex flex-col p-4 mt-2 font-medium bg-green-400">
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <span class="text-gray-800 uppercase dark:text-neutral-200">
                        Jumlah Pengeluaran Keseluruhan:
                    </span>
                    <span class="text-gray-800 uppercase dark:text-neutral-200 sm:ml-2">
                        {{ formatRupiah($totalOngkosJahit + $totalOngkosCutting) }} -
                        {{ formatRupiah($totalBonJahit + $totalBonCutting) }} =
                        @php
                            $ongkos = $totalOngkosJahit + $totalOngkosCutting;
                            $bon = $totalBonJahit + $totalBonCutting;
                        @endphp
                        {{ formatRupiah($ongkos - $bon) }}
                    </span>
                </div>
                <span class="text-sm font-light">
                    ⁱ Jumlah didapatkan dari total keseluruhan ongkos - total keseluruhan bon
                </span>
            </div>
        </div>
    </div>
@endsection
