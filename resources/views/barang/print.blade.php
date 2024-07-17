<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laporan Barang- {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm:ss') }} </title>
</head>
<style>
    @import url(https://fonts.bunny.net/css?family=alata:400);

    body {
        background-color: #f3f4f6;
        font-family: "Alata", sans-serif;
    }
</style>

<body>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow-sm my-6" id="invoice">
        <div class="grid grid-cols-2 items-center">
            <div>
                <img src="https://i.ibb.co.com/hyZ908t/images.png" alt="company-logo" height="100" width="100">
            </div>

            <div class="text-right">
                <p>
                    Laporan Konveksi
                </p>
                <p class="text-gray-500 text-sm mt-1">
                    +62 8132000973
                </p>
                <p class="text-gray-500 text-sm mt-1">
                    JL. Sipelem Tegal Raya
                </p>
            </div>
        </div>

        <!-- Client info -->
        <div class="grid grid-cols-2 items-center mt-8">
            <div>
                <p class="font-bold text-gray-800">
                    Suplyyer :
                </p>
                <p class="text-gray-500">
                    {{ $barang->supplyer->nama }}
                    <br />
                    Status :
                    @if ($barang->tanggal_jadi)
                        <span class="font-medium text-green-600 italic">Selesai</span>
                    @else
                        <span class="font-medium text-red-600">Belum Selesai</span>
                    @endif
                </p>
            </div>

            <div class="text-right">
                <p class="">
                    Tanggal datang:
                    <span
                        class="text-gray-500">{{ \Carbon\Carbon::parse($barang->tanggal_datang)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                </p>

                <p class="">
                    Tanggal Selesai:
                    <span class="text-gray-500">
                        @if ($barang->tanggal_jadi)
                            {{ \Carbon\Carbon::parse($barang->tanggal_jadi)->locale('id')->isoFormat('D MMMM YYYY') }}
                        @else
                            <span class="text-red-600 italic">belum selesai</span>
                        @endif
                    </span>
                </p>

            </div>
        </div>

        <!-- keterangan barang -->
        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <table class="min-w-full">
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Model</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                            Kain</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                            Warna</th>
                        <th scope="col"
                            class="py-3.5 pl-3 pr-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">Harga Satuan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="py-5 text-sm text-gray-500">{{ $barang->model->nama }}</td>
                        <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                            {{ $barang->kain->nama }}</td>
                        <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                            {{ $barang->warna->nama }}</td>
                        <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">
                            {{ formatRupiah($barang->harga) }} / {{ $barang->satuan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- keterangan kinerja -->
        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <table class="min-w-full">
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-0">Jumlah
                            Bahan Mentah</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-center text-sm font-semibold text-gray-900 sm:table-cell">
                            Jumlah Pengembalian Cutting</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-center text-sm font-semibold text-gray-900 sm:table-cell">
                            Jumlah Pengembalian Jahit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="py-5 text-sm text-center text-gray-500"> {{ $barang->jumlah_mentah }}
                            ({{ $barang->satuan }})</td>
                        <td class="hidden px-3 py-5 text-center text-sm text-gray-500 sm:table-cell">
                            {{ $barang->jumlah_cutting }} ({{ $barang->satuan }})</td>
                        <td class="hidden px-3 py-5 text-center text-sm text-gray-500 sm:table-cell">
                            {{ $barang->jumlah_jahit }} ({{ $barang->satuan }})</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <div class="font-bold text-gray-800">
                <p>Histori proses cutting</p>
                <hr class="border-t-2 border-gray-800 w-full mt-2">
            </div>
            <table class="min-w-full table-auto">
                <colgroup>
                    <col class="w-full sm:w-1/4">
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Nama Pencutting
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            JML Ambil
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            JML Kembali
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            TGL Ambil
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            TGL Kembali
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
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
                        <tr class="border-b border-gray-200">
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ $row->karyawan->nama }}
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ $row->jumlah_ambil }} ({{ $row->satuan }})
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                @if ($row->jumlah_kembali)
                                    {{ $row->jumlah_kembali }} ({{ $row->satuan }})
                                @else
                                    <span class="text-red-600">Belum selesai</span>
                                @endif
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ \Carbon\Carbon::parse($row->tanggal_ambil)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                @if ($row->tanggal_kembali)
                                    {{ \Carbon\Carbon::parse($row->tanggal_kembali)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                @else
                                    <span class="text-red-600">Belum selesai</span>
                                @endif
                            </td>
                            <td class="px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                                {{ $row->status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="4"
                            class="pl-4 pr-3 pt-6 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">
                            Total Ongkos Cutting :
                        </th>
                        <td class="pl-3 pr-6 pt-6 text-right text-sm text-gray-500 sm:pr-0">
                            {{ formatRupiah($totalOngkosCutting) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="4"
                            class="pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">
                            Total BON Cutting :
                        </th>
                        <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">
                            {{ formatRupiah($totalBonCutting) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="4"
                            class="pl-4 pr-3 pt-4 text-right text-sm font-semibold text-gray-900 sm:table-cell sm:pl-0">
                            Total Yang Harus Dibayarkan :
                        </th>
                        <td class="pl-3 pr-4 pt-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">
                            {{ formatRupiah($totalOngkosCutting - $totalBonCutting) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <div class="font-bold text-gray-800">
                <p>Histori proses jahit</p>
                <hr class="border-t-2 border-gray-800 w-full mt-2">
            </div>
            <table class="min-w-full table-auto">
                <colgroup>
                    <col class="w-full sm:w-1/4">
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Nama penjahit
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            JML Ambil
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            JML Kembali
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            TGL Ambil
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            TGL Kembali
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
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
                        <tr class="border-b border-gray-200">
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ $row->karyawan->nama }}
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ $row->jumlah_ambil }} ({{ $row->satuan }})
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                @if ($row->jumlah_kembali)
                                    {{ $row->jumlah_kembali }} ({{ $row->satuan }})
                                @else
                                    <span class="text-red-600">Belum selesai</span>
                                @endif
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ \Carbon\Carbon::parse($row->tanggal_ambil)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                @if ($row->tanggal_kembali)
                                    {{ \Carbon\Carbon::parse($row->tanggal_kembali)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                @else
                                    <span class="text-red-600">Belum selesai</span>
                                @endif
                            </td>
                            <td class="px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                                {{ $row->status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="4"
                            class="pl-4 pr-3 pt-6 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">
                            Total Ongkos Jahit :
                        </th>
                        <td class="pl-3 pr-6 pt-6 text-right text-sm text-gray-500 sm:pr-0">
                            {{ formatRupiah($totalOngkosJahit) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="4"
                            class="pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">
                            Total BON Jahit :
                        </th>
                        <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">
                            {{ formatRupiah($totalBonJahit) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="4"
                            class="pl-4 pr-3 pt-4 text-right text-sm font-semibold text-gray-900 sm:table-cell sm:pl-0">
                            Total Yang Harus Dibayarkan :
                        </th>
                        <td class="pl-3 pr-4 pt-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">
                            {{ formatRupiah($totalOngkosJahit - $totalBonJahit) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>


        <!--  Footer  -->
        <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-16">
            - Laporan dicetak menggunakan system ini adalah sah dan benar adanya - <br>
            <span class="italic text-center font-mono ">Laporan dicetak pada
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm:ss') }}
            </span>
        </div>

    </div>
</body>

<script>
    window.print()
</script>

</html>
