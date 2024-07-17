<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laporan BON - {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm:ss') }} </title>
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
                    Laporan BON Karyawan
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
                    Identitas Karyawan :
                </p>
                <p class="text-gray-500">
                    {{ $karyawan->nama }}
                    <br />
                    {{ $karyawan->no }}
                    <br />
                    {{ $karyawan->alamat }}
                </p>
            </div>

            <div class="text-right">
                <p class="">
                    Sudah Lunas :
                    <span class="text-green-600"> {{ formatRupiah($totalLunas) }} </span>
                </p>

                <p class="">
                    Belum Lunas :
                    <span class="text-red-600">{{ formatRupiah($totalBelumLunas) }}</span>
                </p>

            </div>
        </div>



        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <div class="font-bold text-gray-800">
                <p>Histori BON</p>
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
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            No.
                        </th>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Nominal
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Tanggal Dibuat
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Tanggal Diupdate
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($bon as $row)
                        <tr class="border-b border-gray-200">
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ $loop->iteration }}.
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ formatRupiah($row->nominal) }}
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ \Carbon\Carbon::parse($row->created_at)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                            </td>
                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                {{ \Carbon\Carbon::parse($row->updated_at)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                            </td>

                            <td class="px-3 py-5 text-left text-sm text-gray-500 sm:table-cell">
                                @if ($row->status == 'lunas')
                                    <span class="font-bold text-green-600">LUNAS</span>
                                @else
                                    <span class="font-bold text-red-600">BELUM LUNAS</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
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
