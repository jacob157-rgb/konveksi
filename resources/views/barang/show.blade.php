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
                <td class="font-medium">Model</td>
                <td>&nbsp; : &nbsp;{{ formatRupiah($barang->harga) }}</td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Datang</td>
                <td>&nbsp;  :
                    &nbsp;{{ \Carbon\Carbon::parse($barang->tanggal_datang)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                </td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Selesai</td>
                <td>&nbsp;  :
                    &nbsp;{{ \Carbon\Carbon::parse($barang->tanggal_selesai)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
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
                        @if ($barang->jumlah_mentah == $barang->jumlah_cutting)
                            <span
                                class="inline-flex items-center gap-x-1.5 rounded-full bg-blue-500 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">proses
                                cutting selesai</span>
                        @elseif($barang->jumlah_mentah == $barang->jumlah_jahit)
                            <span
                                class="inline-flex items-center gap-x-1.5 rounded-full bg-blue-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">proses
                                jahit selesai</span>
                        @elseif($barang->jumlah_mentah == $barang->jumlah_jahit && $barang->jumlah_mentah == $barang->jumlah_mentah)
                            <span
                                class="inline-flex items-center gap-x-1.5 rounded-full bg-green-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">selesai
                                semua</span>
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
        <div class="items-center pb-5 mb-5">
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
                    @foreach ($cutting as $row)
                        <tr class="text-center">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $loop->iteration }}.</td>

                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $row->karyawan->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $row->jumlah_ambil }} ({{ $row->satuan }})</td>

                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $row->jumlah_kembali }} ({{ $row->satuan }})</td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ \Carbon\Carbon::parse($row->tanggal_ambil)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ \Carbon\Carbon::parse($row->tanggal_kembali)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                <span
                                    class="{{ $row->status == 'proses' ? 'text-red-600' : 'text-green-500' }} font-bold">{{ $row->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $row->ongkos }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                -
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
                                            href="#">
                                            Bayar BON
                                        </a>
                                        <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            href="#">
                                            Bayar Ongkos
                                        </a>
                                        <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            href="#">
                                            Pengembalian
                                        </a>
                                        <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            href="#">
                                            Hapus
                                        </a>
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
                        ---
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
        <div class="items-center pb-5 mb-5">
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
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @foreach ($jahit as $row)
                        <tr class="text-center">
                            <td
                                class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $loop->iteration }}.</td>

                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $row->karyawan->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $row->jumlah_ambil }} ({{ $row->satuan }})</td>

                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $row->jumlah_kembali }} ({{ $row->satuan }})</td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ \Carbon\Carbon::parse($row->tanggal_ambil)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ \Carbon\Carbon::parse($row->tanggal_kembali)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                <span
                                    class="{{ $row->status == 'proses' ? 'text-red-600' : 'text-green-500' }} font-bold">{{ $row->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                {{ $row->ongkos }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                -
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
                                            href="#">
                                            Bayar BON
                                        </a>
                                        <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            href="#">
                                            Bayar Ongkos
                                        </a>
                                        <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            href="#">
                                            Pengembalian
                                        </a>
                                        <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            href="#">
                                            Hapus
                                        </a>
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
                        ---
                    </td>
                    @for ($i = 0; $i < 5; $i++)
                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200"></td>
                    @endfor
                </tr>
            </table>
        </div>
        <hr>
        <table>
            <tr class="font-bold bg-green-400 rounded-lg">
                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                    JUMLAH KESELURUHAN :</td>
                @for ($i = 0; $i < 15; $i++)
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200"></td>
                @endfor
                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                    ---
                </td>
                @for ($i = 0; $i < 5; $i++)
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200"></td>
                @endfor
            </tr>
        </table>
    </div>
@endsection
