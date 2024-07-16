@extends('layouts.dashboard')

@section('content')
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between pb-5 mb-1">
            <h2 class="text-1xl font-semibold text-gray-800 dark:text-neutral-200">Keterangan Barang:</h2>
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
            <h2 class="text-1xl font-semibold text-gray-800 dark:text-neutral-200">Keterangan Pengembalian:</h2>
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
                <td class="font-medium">Jumlah Kembali</td>
                <td>&nbsp; : &nbsp;{{ $cutting?->jumlah_kembali }} {{ $cutting?->satuan }}</td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Ambil</td>
                <td>&nbsp; :
                    &nbsp;{{ \Carbon\Carbon::parse($cutting->tanggal_ambil)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                </td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Kembali</td>
                <td>&nbsp; :
                    &nbsp;
                    @if ($cutting->tanggal_kembali)
                        {{ \Carbon\Carbon::parse($cutting->tanggal_kembali)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td class="font-medium">Ongkos</td>
                <td>&nbsp; : &nbsp;{{ formatRupiah($cutting?->ongkos) }}</td>
            </tr>
            <tr>
                <td class="font-medium">Bayar Ongkos</td>
                <td>&nbsp; : &nbsp;
                    @if ($cutting?->ongkos - $bonCutting?->nominal == $cutting?->bayar_ongkos)
                        <span class="line-through">{{ formatRupiah($cutting?->bayar_ongkos) }}</span>
                        <span class="text-green-600"> - Lunas</span>
                    @else
                        {{ formatRupiah($cutting?->bayar_ongkos) }}
                    @endif
                </td>
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
            <tr>
                <td class="font-medium">Status</td>
                <td>&nbsp; :
                    &nbsp;
                    @if ($cutting->status == 'proses')
                        <span
                            class="inline-flex items-center gap-x-1.5 rounded-full bg-red-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">
                            Belum Jadi
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-x-1.5 rounded-full bg-green-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">
                            Sudah Selesai</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
@endsection
