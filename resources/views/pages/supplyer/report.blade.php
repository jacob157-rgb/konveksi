<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laporan Okinara Collection -
        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm:ss') }} </title>
</head>
<style>
    @import url(https://fonts.bunny.net/css?family=alata:400);

    body {
        background-color: #f3f4f6;
        font-family: "Alata", sans-serif;
    }

    @media print {
        body {
            background-color: #ffffff;
        }

        #media-print {
            display: none;
        }
        #invoice {
            box-shadow: none !important;
        }
        .page-break {
            page-break-before: always;
        }
        .avoid-break {
            page-break-inside: avoid;
        }
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
                    Laporan Barang Supplyer
                </p>
                <p class="text-gray-500 text-sm mt-1">
                    +6285725888333
                </p>
                <p class="text-gray-500 text-sm mt-1">
                    Jl. Garuda Ds. Tembok Kidul RT.02/RW.01 Kec. Adiwerna. Kab Tegal
                </p>
            </div>
        </div>

        <!-- Client info -->
        <div class="grid grid-cols-2 items-center mt-8">
            <div>
                <p class="font-bold text-gray-800">
                    ID : {{ $barangMentahFirst->unique_id }}
                </p>
                <p class="text-gray-900 ">
                    {{ $supplayer->nama }} <br>
                </p>
            </div>

        </div>

        <div class="-mx-4 mt-8 flow-root sm:mx-0 avoid-break">
            <div class="font-bold text-gray-800">
                <p>Histori Barang Masuk </p>
                <hr class="border-t-2 border-gray-800 w-full mt-2">
            </div>
            <table class="min-w-full table-auto">
                <colgroup>
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>

                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Tanggal
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Kain
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Jumlah
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Satuan
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Harga
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalJumlahMentah = 0;
                        $totalHargaMentah = 0;
                        $grandTotalMentah = 0;
                    @endphp
                    @foreach ($barangMentahGet as $uniqueId => $items)
                        @foreach ($items as $it => $item)
                            <tr>
                                <td class="px-3 truncate py-5 text-left text-sm text-gray-500 sm:table-cell">
                                    {{ \Carbon\Carbon::parse($item->tanggal_datang)->translatedFormat('d F Y') }}
                                </td>
                                @foreach ($item->kainBarangMentah as $kain)
                                    <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                        {{ $kain->kain }}
                                    </td>
                                    @foreach ($kain->warnaKain as $warna)
                                        @php
                                            $totalJumlahMentah += $warna->jumlah;
                                            $totalHargaMentah += $warna->harga;
                                            $grandTotalMentah += $warna->total;
                                        @endphp
                                        <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                            {{ $warna->jumlah }}
                                        </td>
                                        <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                            {{ $warna->satuan }}
                                        </td>
                                        <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                            {{ formatRupiah($warna->harga) }}
                                        </td>
                                        <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                            {{ formatRupiah($warna->total) }}
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t border-gray-300">
                        <td colspan="2" class="px-3 py-5 text-right font-bold text-gray-900">
                            Total:
                        </td>
                        <td class="px-3 py-5 text-left font-bold text-gray-900">
                            {{ $totalJumlahMentah }}
                        </td>
                        <td class="px-3 py-5 text-left text-gray-500 sm:table-cell">
                        </td>
                        <td class="px-3 py-5 text-left font-bold text-gray-900">
                            {{ formatRupiah($totalHargaMentah) }}
                        </td>
                        <td class="px-3 py-5 text-left font-bold text-gray-900">
                            {{ formatRupiah($grandTotalMentah) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="-mx-4 mt-8 flow-root sm:mx-0 page-break avoid-break">
            <div class="font-bold text-gray-800">
                <p>Histori Barang Keluar </p>
                <hr class="border-t-2 border-gray-800 w-full mt-2">
            </div>
            <table class="min-w-full table-auto">
                <colgroup>
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>

                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Tanggal
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Model
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Jumlah
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Satuan
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Harga
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalJumlahkirim = 0;
                        $totalHargaKirim = 0;
                        $grandTotalKirim = 0;
                    @endphp
                    @foreach ($barangKirimGet as $uniqueId => $items)
                        @foreach ($items as $it => $item)
                            <tr>
                                <td class="px-3 truncate py-5 text-left text-sm text-gray-500 sm:table-cell">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kirim)->translatedFormat('d F Y') }}
                                </td>
                                @foreach ($item->modelBarangJadi as $model)
                                    <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                        {{ $model->model }}
                                    </td>
                                    @foreach ($model->warnaModel as $warna)
                                        @php
                                            $totalJumlahkirim += $warna->jumlah;
                                            $totalHargaKirim += $warna->harga;
                                            $grandTotalKirim += $warna->total;
                                        @endphp
                                        <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                            {{ $warna->jumlah }}
                                        </td>
                                        <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                            pcs
                                        </td>
                                        <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                            {{ formatRupiah($warna->harga) }}
                                        </td>
                                        <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                            {{ formatRupiah($warna->total) }}
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t border-gray-300">
                        <td colspan="2" class="px-3 py-5 text-right font-bold text-gray-900">
                            Total:
                        </td>
                        <td class="px-3 py-5 text-left font-bold text-gray-900">
                            {{ $totalJumlahkirim }}
                        </td>
                        <td class="px-3 py-5 text-left text-gray-500 sm:table-cell">
                        </td>
                        <td class="px-3 py-5 text-left font-bold text-gray-900">
                            {{ formatRupiah($totalHargaKirim) }}
                        </td>
                        <td class="px-3 py-5 text-left font-bold text-gray-900">
                            {{ formatRupiah($grandTotalKirim) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="-mx-4 mt-8 flow-root sm:mx-0 page-break avoid-break">
            <div class="font-bold text-gray-800">
                <p>Histori Return Barang </p>
                <hr class="border-t-2 border-gray-800 w-full mt-2">
            </div>
            <table class="min-w-full table-auto">
                <colgroup>
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>

                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Tanggal
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Model
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Jumlah
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Harga
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalJumlahReturn = 0;
                        $totalHargaReturn = 0;
                        $grandTotalReturn = 0;
                    @endphp
                    @foreach ($returnBarang as $rows)
                        @php
                            $totalJumlahReturn += $rows->jumlah;
                            $totalHargaReturn += $rows->harga;
                            $grandTotalReturn += $rows->total;
                        @endphp
                        <tr>
                            <td class="px-3 truncate py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ \Carbon\Carbon::parse($rows->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-3 truncate py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ $rows->model }}
                            </td>
                            <td class="px-3 truncate py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ $rows->jumlah }}
                            </td>
                            <td class="px-3 truncate py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ formatRupiah($rows->harga) }}
                            </td>
                            <td class="px-3 truncate py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ formatRupiah($rows->total) }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t border-gray-300">
                        <td colspan="2" class="px-3 py-5 text-right font-bold text-gray-900">
                            Total:
                        </td>
                        <td class="px-3 py-5 text-left font-bold text-gray-900">
                            {{ $totalJumlahReturn }}
                        </td>

                        <td class="px-3 py-5 text-left font-bold text-gray-900">
                            {{ formatRupiah($totalHargaReturn) }}
                        </td>
                        <td class="px-3 py-5 text-left font-bold text-gray-900">
                            {{ formatRupiah($grandTotalReturn) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="-mx-4 mt-8 flow-root sm:mx-0 page-break avoid-break">
            <div class="font-bold text-gray-800">
                <p>Histori Selisih / Bayaran </p>
                <hr class="border-t-2 border-gray-800 w-full mt-2">
            </div>
            <table class="min-w-full table-auto">
                <colgroup>
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-1/6 sm:w-1/6">
                    <col class="w-2/6 sm:w-2/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Tanggal
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 sm:table-cell">
                            Jumlah
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Keterangan
                        </th>
                    </tr>
                </thead>
                @php
                    $totalNominalSelisih = 0;
                @endphp
                <tbody>
                    @foreach ($selisih as $sl)
                        <tr>
                            <td class="px-3 truncate py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ \Carbon\Carbon::parse($sl->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-3 truncate py-5 text-center text-sm text-gray-500 sm:table-cell">
                                {{ formatRupiah($sl->nominal) }}
                                @php
                                    $totalNominalSelisih += $sl->nominal;
                                @endphp
                            </td>
                            <td class="px-3 truncate py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ $sl->keterangan ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t border-gray-300">
                        <td colspan="2" class="px-3 py-5 text-right font-bold text-gray-900">
                            Total Barang Masuk:
                        </td>
                        <td class="px-3 py-5 text-right font-bold text-gray-900">
                            {{ formatRupiah($grandTotalMentah) }}
                        </td>
                    </tr>
                    <tr class="border-t border-gray-300">
                        <td colspan="2" class="px-3 py-5 text-right font-bold text-gray-900">
                            Total Barang Keluar:
                        </td>
                        <td class="px-3 py-5 text-right font-bold text-gray-900">
                            {{ formatRupiah($grandTotalKirim) }}
                        </td>
                    </tr>
                    <tr class="border-t border-gray-300">
                        <td colspan="2" class="px-3 py-5 text-right font-bold text-gray-900">
                            Total Return Barang:
                        </td>
                        <td class="px-3 py-5 text-right font-bold text-gray-900">
                            {{ formatRupiah($grandTotalReturn) }}
                        </td>
                    </tr>
                    <tr class="border-t border-gray-300">
                        <td colspan="2" class="px-3 py-5 text-right font-bold text-gray-900">
                            Total Selisih:
                        </td>
                        <td class="px-3 py-5 text-right font-bold text-gray-900">
                            {{ formatRupiah($totalNominalSelisih) }}
                        </td>
                    </tr>

                    <tr class="border-t border-gray-300">
                        <td colspan="2" class="px-3 py-5 text-right font-bold text-gray-900">
                            Jumlah Keseluruhan:
                        </td>
                        <td class="px-3 py-5 text-right font-bold text-gray-900">
                            {{ formatRupiah($grandTotalMentah - $grandTotalKirim + $totalNominalSelisih - $grandTotalReturn) }}
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

    <div class="fixed bottom-6 right-6 space-y-2" id="media-print">
        <button type="button" id="print"
            class="flex items-center justify-center w-12 h-12 bg-red-500 text-white rounded-full shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-printer-check">
                <path d="M13.5 22H7a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v.5" />
                <path d="m16 19 2 2 4-4" />
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2" />
                <path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6" />
            </svg>
        </button>

        <a href="javascript:void(0)" id="shareButton" data-href="{{ $url }}/laporan/share?supplyer={{ $supplayer->nama }}&&id_barang={{ $barangMentahFirst->unique_id }}"
            class="flex items-center justify-center w-12 h-12 bg-green-500 text-white rounded-full shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-share-2">
                <circle cx="18" cy="5" r="3" />
                <circle cx="6" cy="12" r="3" />
                <circle cx="18" cy="19" r="3" />
                <line x1="8.59" x2="15.42" y1="13.51" y2="17.49" />
                <line x1="15.41" x2="8.59" y1="6.51" y2="10.49" />
            </svg>
        </a>
    </div>

    <div id="shareNotification" class="fixed bottom-20 right-6 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg hidden">
        Link berhasil disalin!
    </div>
</body>

<script>
    document.getElementById('print').addEventListener('click', function() {
        window.print();
    });
    document.getElementById('shareButton').addEventListener('click', function(event) {
            event.preventDefault();
            const link = this.getAttribute('data-href');

            navigator.clipboard.writeText(link).then(function() {
                const notification = document.getElementById('shareNotification');
                notification.classList.remove('hidden');
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 2000);
            }).catch(function(error) {
                console.error('Error copying text: ', error);
            });
        });
</script>

</html>
