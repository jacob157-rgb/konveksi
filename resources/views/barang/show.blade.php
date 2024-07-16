@extends('layouts.dashboard')

@section('content')
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between pb-5 mb-5">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Histori Barang</h2>
            </div>
            <div class="inline-flex mt-2 gap-x-2">
                <a class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                    href="#">
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
                <td>&nbsp; : &nbsp;{{ $barang->supplyer->nama }}</td>
            </tr>
            <tr>
                <td class="font-medium">Model</td>
                <td>&nbsp; : &nbsp;{{ $barang->model->nama }}</td>
            </tr>
            <tr>
                <td class="font-medium">Kain</td>
                <td>&nbsp; : &nbsp;{{ $barang->kain->nama }}</td>
            </tr>
            <tr>
                <td class="font-medium">Warna</td>
                <td>&nbsp; : &nbsp;{{ $barang->warna->nama }}</td>
            </tr>
            <tr>
                <td class="font-medium">Harga Satuan</td>
                <td>&nbsp; : &nbsp;{{ formatRupiah($barang->harga) }}</td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Datang</td>
                <td>&nbsp; :
                    &nbsp;{{ \Carbon\Carbon::parse($barang->tanggal_datang)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                </td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Selesai</td>
                <td>&nbsp; :
                    &nbsp;
                    @if ($barang->tanggal_jadi)
                        {{ \Carbon\Carbon::parse($barang->tanggal_jadi)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                    @else
                        <button data-id="{{ $barang->id }}"
                            class="selesaikan-btn inline-flex items-center gap-x-1.5 rounded-full bg-red-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">Selesaikan</button>
                    @endif
                </td>
            </tr>
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
        <div class="items-center pb-5 mb-5 overflow-x-auto">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Histori Cutting</h2>
            </div>
            <table class="divide-y divide-gray-200 dark:divide-neutral-700">
                <thead>
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            No.</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Nama Karyawan</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Jumlah Ambil</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Jumlah Kembali</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Tanggal Ambil</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Tanggal Kembali</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Ongkos</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            BON</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
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
                        <tr class="text-center">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
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
                                <span
                                    class="{{ $row->status == 'proses' ? 'text-red-600' : 'text-green-500' }} font-bold">{{ $row->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ formatRupiah($row->ongkos) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                @if ($bonCutting?->status == 'lunas')
                                    <span class="line-through">{{ formatRupiah($bonCutting?->nominal) }}</span><br>
                                    <span class="text-green-700">Lunas</span>
                                @else
                                    <span class="">{{ formatRupiah($bonCutting?->nominal) }}</span>
                                @endif

                            </td>

                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <div class="hs-dropdown relative m-1 inline-flex [--trigger:hover]">
                                    <button id="hs-dropdown-hover-event" type="button"
                                        class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-500 border border-gray-200 rounded-lg shadow-sm hs-dropdown-toggle gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                        Actions
                                        <svg class="size-4 hs-dropdown-open:rotate-180" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    <div class="hs-dropdown-menu duration min-w-60 mt-2 hidden rounded-lg bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] before:absolute before:-top-4 before:start-0 before:h-4 before:w-full after:absolute after:-bottom-4 after:start-0 after:h-4 after:w-full hs-dropdown-open:opacity-100 dark:divide-neutral-700 dark:border dark:border-neutral-700 dark:bg-neutral-800"
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
                                                class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table>
                <tr class="font-bold bg-yellow-400 rounded-lg">
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        JUMLAH PENGELUARAN :</td>
                    @for ($i = 0; $i < 15; $i++)
                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200"></td>
                    @endfor
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        {{ formatRupiah($totalOngkosCutting) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        {{ formatRupiah($totalBonCutting) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        = {{ formatRupiah($totalOngkosCutting - $totalBonCutting) }}
                    </td>
                    @for ($i = 0; $i < 5; $i++)
                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200"></td>
                    @endfor
                </tr>
            </table>
        </div>
        <hr>
    </div>
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="items-center pb-5 mb-5 overflow-x-auto">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Histori Jahit</h2>
            </div>
            <table class="divide-y divide-gray-200 dark:divide-neutral-700">
                <thead>
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            No.</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Nama Karyawan</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Jumlah Ambil</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Jumlah Kembali</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Tanggal Ambil</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Tanggal Kembali</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Ongkos</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            BON</th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Aksi</th>
                    </tr>
                </thead>
                @php
                    $totalOngkosJahit = 0;
                    $totalBonJahit = 0;
                @endphp
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @foreach ($jahit as $row)
                        @php
                            $bonJahit = \App\Models\Bon::getJahit($row->karyawan_id, $row->id);
                            $totalOngkosJahit += $row->ongkos;
                            $totalBonJahit += $bonJahit?->nominal;
                        @endphp
                        <tr class="text-center">
                            <td
                                class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
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
                                <span
                                    class="{{ $row->status == 'proses' ? 'text-red-600' : 'text-green-500' }} font-bold">{{ $row->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ formatRupiah($row->ongkos) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ formatRupiah($bonJahit?->nominal) }}
                            </td>

                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <div class="hs-dropdown relative m-1 inline-flex [--trigger:hover]">
                                    <button id="hs-dropdown-hover-event" type="button"
                                        class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-500 border border-gray-200 rounded-lg shadow-sm hs-dropdown-toggle gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                        Actions
                                        <svg class="size-4 hs-dropdown-open:rotate-180" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    <div class="hs-dropdown-menu duration min-w-60 mt-2 hidden rounded-lg bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] before:absolute before:-top-4 before:start-0 before:h-4 before:w-full after:absolute after:-bottom-4 after:start-0 after:h-4 after:w-full hs-dropdown-open:opacity-100 dark:divide-neutral-700 dark:border dark:border-neutral-700 dark:bg-neutral-800"
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
                                                class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table>
                <tr class="font-bold bg-yellow-400 rounded-lg">
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        JUMLAH PENGELUARAN :</td>
                    @for ($i = 0; $i < 15; $i++)
                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200"></td>
                    @endfor
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        {{ formatRupiah($totalOngkosJahit) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        {{ formatRupiah($totalBonJahit) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        = {{ formatRupiah($totalOngkosJahit - $totalBonJahit) }}
                    </td>
                    @for ($i = 0; $i < 5; $i++)
                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200"></td>
                    @endfor
                </tr>
            </table>
        </div>
        <hr>
        <div class="overflow-x-auto">
            <table>
                <tr class="font-bold bg-green-400 rounded-lg">
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        JUMLAH KESELURUHAN :</td>
                    @for ($i = 0; $i < 15; $i++)
                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200"></td>
                    @endfor
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        {{ formatRupiah($totalOngkosJahit + $totalOngkosCutting) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        {{ formatRupiah($totalBonJahit + $totalBonCutting) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                        @php
                            $ongkos = $totalOngkosJahit + $totalOngkosCutting;
                            $bon = $totalBonJahit + $totalBonCutting;
                        @endphp
                        {{ formatRupiah($ongkos - $bon) }}
                    </td>
                    @for ($i = 0; $i < 5; $i++)
                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200"></td>
                    @endfor
                </tr>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-blue-100 border border-blue-200 text-gray-800 rounded-lg p-4 dark:bg-blue-800/10 dark:border-blue-900 dark:text-white"
            role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="flex-shrink-0 size-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 16v-4"></path>
                        <path d="M12 8h.01"></path>
                    </svg>
                </div>
                <div class="ms-3">
                    <h3 class="font-semibold">
                        Informasi
                    </h3>
                    <div class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                        Apakah anda yaqin akan menyelesaikan ini ? <br>
                        Jika iya, maka aktifitas dan status selesai.
                    </div>
                    <div class="mt-4">
                        <div class="flex space-x-3">
                            <button type="button"
                                class="close-modal inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400">
                                Tutup
                            </button>
                            <form action="/barang/selesai/{{ $barang->id }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400">
                                    Ya, selesaikan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.selesaikan-btn').click(function() {
                $('#overlay').removeClass('hidden');
                $('#overlay').data('id', barangId);
            });
            $('.close-modal').click(function() {
                $('#overlay').addClass('hidden');
            });
        });
    </script>
@endsection
