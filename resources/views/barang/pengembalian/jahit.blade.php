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
                    @if ($barang->tanggal_selesai)
                        {{ \Carbon\Carbon::parse($barang->tanggal_selesai)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                    @else
                        <button
                            class="inline-flex items-center gap-x-1.5 rounded-full bg-red-400 px-3 py-1.5 text-xs font-medium text-gray-800 dark:bg-white/10 dark:text-white">Belum
                            Selesai</button>
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between pb-5 mb-1">
            <h2 class="text-1xl font-semibold text-gray-800 dark:text-neutral-200">Keterangan Karyawan:</h2>
        </div>
        <hr>
        <table border="1" class="my-5">
            <tr>
                <td class="font-medium">Nama Penjahit</td>
                <td>&nbsp; : &nbsp;{{ $jahit->karyawan->nama }}</td>
            </tr>
            <tr>
                <td class="font-medium">No. Tlp</td>
                <td>&nbsp; : &nbsp;{{ $jahit->karyawan->no }}</td>
            </tr>
            <tr>
                <td class="font-medium">Alamat</td>
                <td>&nbsp; : &nbsp;{{ $jahit->karyawan->alamat }}</td>
            </tr>
            @php
                $bonJahit = \App\Models\Bon::getJahit($jahit->karyawan->id, $jahit->id);
            @endphp
            <tr>
                <td class="font-medium">Jumlah Ambil</td>
                <td>&nbsp; : &nbsp;{{ $jahit?->jumlah_ambil }} {{ $jahit?->satuan }}</td>
            </tr>
            <tr>
                <td class="font-medium">Tanggal Ambil</td>
                <td>&nbsp; :
                    &nbsp;{{ \Carbon\Carbon::parse($jahit->tanggal_ambil)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                </td>
            </tr>
            <tr>
                <td class="font-medium">Ongkos</td>
                <td>&nbsp; : &nbsp;{{ formatRupiah($jahit?->ongkos) }}</td>
            </tr>
            <tr>
                <td class="font-medium">BON</td>
                <td>&nbsp; : &nbsp;
                    @if ($bonJahit?->status == 'lunas')
                        <span class="line-through">{{ formatRupiah($bonJahit?->nominal) }}</span>
                        <span class="text-green-600"> - Lunas</span>
                    @else
                        <span class="">{{ formatRupiah($bonJahit?->nominal) }}</span>
                    @endif
                </td>
            </tr>
        </table>
        <p>Total Yang Harus Dibayarkan : {{ formatRupiah($jahit?->ongkos - $bonJahit?->nominal) }}</p>
    </div>

    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="p-4 bg-white shadow rounded-xl dark:bg-neutral-900 sm:p-7">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-neutral-200 md:text-3xl">
                                Pengembalian jahit
                            </h2>
                        </div>
                        <form action="/barang/pengembalian/jahit/update/{{ $barang?->id }}/{{ $jahit?->id }}"
                            method="POST">
                            @csrf
                            <div
                                class="py-6 border-t border-gray-200 first:border-transparent first:pt-0 last:pb-0 dark:border-neutral-700 dark:first:border-transparent">
                                <div class="mt-2 space-y-3">
                                    <p>Jumlah pengembalian</p>
                                    <div class="relative border rounded-md">
                                        <input type="number" name="jumlah_kembali" type="number" required
                                            value="{{ $jahit?->jumlah_kembali }}"
                                            placeholder="Masukan jumlah barang yang dikembalikan"
                                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <div
                                            class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                                            <span
                                                class="text-red-500 font-bold dark:text-neutral-500">{{ $jahit->satuan }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2 space-y-3">
                                    <p>Bayar Ongkos </p>
                                    <input id="jumlah" name="bayar_ongkos" type="number"
                                        value="{{ $jahit?->bayar_ongkos }}"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan jumlah barang mentah" required>
                                </div>

                                @if ($bonJahit)
                                    <div class="mt-2 space-y-3">
                                        <p>Status BON</p>
                                        <div class="grid gap-3 sm:flex">
                                            <select name="status_bon"
                                                class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                <option selected disabled>Pilih status BON</option>
                                                <option {{ $bonJahit->status == 'belumlunas' ? 'selected' : '' }}
                                                    value="belumlunas">Belum Lunas</option>
                                                <option {{ $bonJahit->status == 'lunas' ? 'selected' : '' }}
                                                    value="lunas">Lunas</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-2 space-y-3">
                                    <p>Status</p>
                                    <div class="grid gap-3 sm:flex">
                                        <select name="status_jahit" required
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected disabled>Pilih status</option>
                                            <option {{ $jahit?->status == 'jadi' ? 'selected' : '' }} value="jadi">
                                                Selesai</option>
                                            <option {{ $jahit?->status == 'proses' ? 'selected' : '' }} value="proses">
                                                Masih Proses</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="flex justify-end mt-5 gap-x-2">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk Format IDR --}}
    <script>
        document.getElementById('harga').addEventListener('input', function(e) {
            // Menghapus karakter non-numerik
            let value = e.target.value.replace(/\D/g, '');

            // Mengupdate input tersembunyi dengan nilai numerik
            document.getElementById('nominal').value = value;

            // Menghitung total
            let totalValue = value * document.getElementById('jumlah').value;

            // Memformat angka dengan pemisah ribuan
            let formattedValue = new Intl.NumberFormat('id-ID').format(value);
            let formattedTotalValue = new Intl.NumberFormat('id-ID').format(totalValue);

            // Menampilkan nilai terformat
            e.target.value = formattedValue;
            document.getElementById('total').value = formattedTotalValue;
        });
    </script>
@endsection
