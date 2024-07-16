@extends('layouts.dashboard')

@section('content')
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between pb-5 mb-1">
            <h2 class="font-semibold text-gray-800 text-1xl dark:text-neutral-200">Keterangan Barang:</h2>
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
                        <button
                            class="inline-flex items-center gap-x-1.5 rounded-full bg-red-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">Belum
                            Selesai</button>
                    @endif
                </td>
            </tr>
            @if ($barang->tanggal_jadi)
                <tr>
                    <td class="font-medium">Status</td>
                    <td>&nbsp; :
                        &nbsp;
                        <button
                            class="inline-flex items-center gap-x-1.5 rounded-full bg-green-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">
                            Selesai</button>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between pb-5 mb-1">
            <h2 class="font-semibold text-gray-800 text-1xl dark:text-neutral-200">Keterangan Karyawan:</h2>
        </div>
        <hr>
        <table border="1" class="my-5">
            <tr>
                <td class="font-medium">Nama Cutting</td>
                <td>&nbsp; : &nbsp;{{ $cutting->karyawan->nama }}</td>
            </tr>
            <tr>
                <td class="font-medium">No. Tlp</td>
                <td>&nbsp; : &nbsp;{{ $cutting->karyawan->no }}</td>
            </tr>
            <tr>
                <td class="font-medium">Alamat</td>
                <td>&nbsp; : &nbsp;{{ $cutting->karyawan->alamat }}</td>
            </tr>
            @php
                $bonCutting = \App\Models\Bon::getCutting($cutting->karyawan->id, $cutting->id);
            @endphp
            <tr>
                <td class="font-medium">Jumlah Ambil</td>
                <td>&nbsp; : &nbsp;{{ $cutting?->jumlah_ambil }} {{ $cutting?->satuan }}</td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Ambil</td>
                <td>&nbsp; :
                    &nbsp;{{ \Carbon\Carbon::parse($cutting->tanggal_ambil)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                </td>
            </tr>
            <tr>
                <td class="font-medium">Ongkos</td>
                <td>&nbsp; : &nbsp;{{ formatRupiah($cutting?->ongkos) }}</td>
            </tr>
            <tr>
                <td class="font-medium">BON</td>
                <td>&nbsp; : &nbsp;
                    @if ($bonCutting?->status == 'lunas')
                        <span class="line-through">{{ formatRupiah($bonCutting?->nominal) }}</span>
                        <span class="text-green-600"> - Lunas</span>
                    @else
                        <span class="">{{ formatRupiah($bonCutting?->nominal) }}</span>
                    @endif
                </td>
            </tr>
        </table>
        <p>Total Yang Harus Dibayarkan : {{ formatRupiah($cutting?->ongkos - $bonCutting?->nominal) }}</p>
    </div>

    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div
            class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="inline-block min-w-full p-1.5 align-middle">
                        <div class="p-4 bg-white shadow rounded-xl dark:bg-neutral-900 sm:p-7">
                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-gray-800 dark:text-neutral-200 md:text-3xl">
                                    Pengembalian cutting
                                </h2>
                            </div>
                            <form action="/barang/pengembalian/cutting/update/{{ $barang?->id }}/{{ $cutting?->id }}"
                                method="POST">
                                @csrf
                                <div
                                    class="py-6 border-t border-gray-200 first:border-transparent first:pt-0 last:pb-0 dark:border-neutral-700 dark:first:border-transparent">
                                    <div class="mt-2 space-y-3">
                                        <p>Jumlah pengembalian</p>
                                        <div class="relative border rounded-md">
                                            <input type="number" name="jumlah_kembali" type="number" required
                                                value="{{ $cutting?->jumlah_kembali }}"
                                                placeholder="Masukan jumlah barang yang dikembalikan"
                                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <div
                                                class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                                <span
                                                    class="font-bold text-red-500 dark:text-neutral-500">{{ $cutting->satuan }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-2 space-y-3">
                                        <p>Bayar Ongkos </p>
                                        <div class="relative border rounded-md">
                                            <input type="text" id="harga" name="bayar_ongkos"
                                                value="{{ $cutting?->bayar_ongkos }}" required
                                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <input type="hidden" id="nominal">
                                            <div
                                                class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                                            </div>
                                            <div
                                                class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($bonCutting)
                                        <div class="mt-2 space-y-3">
                                            <p>Status BON</p>
                                            <div class="grid gap-3 sm:flex">
                                                <select name="status_bon"
                                                    class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                    <option selected disabled>Pilih status BON</option>
                                                    <option {{ $bonCutting->status == 'belumlunas' ? 'selected' : '' }}
                                                        value="belumlunas">Belum Lunas</option>
                                                    <option {{ $bonCutting->status == 'lunas' ? 'selected' : '' }}
                                                        value="lunas">Lunas</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="mt-2 space-y-3">
                                        <p>Status</p>
                                        <div class="grid gap-3 sm:flex">
                                            <select name="status_cutting" required
                                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                <option selected disabled>Pilih status</option>
                                                <option {{ $cutting?->status == 'jadi' ? 'selected' : '' }} value="jadi">
                                                    Selesai</option>
                                                <option {{ $cutting?->status == 'proses' ? 'selected' : '' }}
                                                    value="proses">
                                                    Masih Proses</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="flex justify-end mt-5 gap-x-2">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
