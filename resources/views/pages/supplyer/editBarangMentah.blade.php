@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-green-600 border border-gray-200 rounded shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <h2 class="font-bold text-center text-white uppercase">SUPPLAYER {{ $supplayer->nama }}</h2>
        <h2 class="font-bold text-center text-white uppercase">ID : {{ $barangMentahFirst->unique_id }}</h2>
        <h2 class="font-bold text-center text-white uppercase">TANGGAL :
            {{ \Carbon\Carbon::parse($barangMentahFirst->tanggal_datang) }}</h2>
    </div>

    <div class=" bg-white shadow-sm border rounded-lg start-0 top-0 z-[80]  overflow-y-auto overflow-x-hidden">
        <form action="/barang/mentah/update/{{ $barangMentahFirst->id }}" method="post" id="updateBarangMentahForm">
            @csrf
            @method('PUT')
            <div class="p-4 -mt-2 space-y-2 overflow-y-auto">
                <!-- Hidden fields for supplyer and unique_id -->
                <input type="hidden" name="supplyer_id" value="{{ $barangMentahFirst->supplyer_id }}">
                <input type="hidden" name="unique_id" value="{{ $barangMentahFirst->unique_id }}">

                <!-- Tanggal Masuk -->
                <label for="tanggal_datang" class="block mb-2 text-sm font-medium dark:text-white">Tanggal Masuk</label>
                <input type="datetime-local" name="tanggal_datang"
                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                    value="{{ $barangMentahFirst->tanggal_datang ?? old('tanggal_datang') }}" autofocus>

                <!-- Jenis Kain -->
                <label for="kain_id" class="block mb-2 text-sm font-medium dark:text-white">Jenis Kain</label>
                <input type="hidden" name="kain[0][id]" value="{{ $barangMentahFirst->kainBarangMentah[0]->id }}">
                <select name="kain[0][nama]"
                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-9 focus:border-blue-500 focus:ring-blue-500">
                    <option selected value="">Pilih Jenis Kain</option>
                    @foreach ($kain as $row)
                        <option value="{{ $row->nama }}"
                            {{ $row->nama == $barangMentahFirst->kainBarangMentah[0]->kain ? 'selected' : '' }}>
                            {{ $row->nama }}
                        </option>
                    @endforeach
                </select>

                <!-- Barang Details -->
                <div class="value-container">
                    <label for="hs-inline-leading-pricing-select-label"
                        class="block mb-2 text-sm font-medium dark:text-white">Jml. Barang</label>
                    <input type="hidden" name="kain[0][warna][0][id]"
                        value="{{ $barangMentahFirst->kainBarangMentah[0]->warnaKain[0]->id }}">
                    <div class="relative">
                        <input type="number" id="hs-inline-leading-pricing-select-label"
                            name="kain[0][warna][0][jumlah_mentah]"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg shadow-sm jumlah dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-20 focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukan Jumlah Barang"
                            value="{{ $barangMentahFirst->kainBarangMentah[0]->warnaKain[0]->jumlah ?? old('jumlah_mentah') }}">

                        <div class="absolute inset-y-0 flex items-center text-gray-500 end-0 pe-px">
                            <label for="satuan" class="sr-only">Satuan</label>
                            <select id="satuan" name="kain[0][warna][0][satuan]"
                                class="block w-full border border-transparent rounded-lg dark:bg-neutral-800 dark:text-neutral-500 focus:border-blue-600 focus:ring-blue-600">
                                <option value="kg"
                                    {{ $barangMentahFirst->kainBarangMentah[0]->warnaKain[0]->satuan == 'kg' ? 'selected' : '' }}>
                                    Kg</option>
                                <option value="yard"
                                    {{ $barangMentahFirst->kainBarangMentah[0]->warnaKain[0]->satuan == 'yard' ? 'selected' : '' }}>
                                    Yard</option>
                            </select>
                        </div>
                    </div>

                    <!-- Harga Barang -->
                    <label for="harga" class="block mb-2 text-sm font-medium dark:text-white">Harga Barang</label>
                    <div class="relative rounded-md">
                        <input type="text" name="kain[0][warna][0][harga]"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                            value="{{ $barangMentahFirst->kainBarangMentah[0]->warnaKain[0]->harga ?? old('harga') }}">
                        <input type="hidden" id="nominal">
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                            <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                        </div>
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                            <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                        </div>
                    </div>

                    <!-- Total Harga -->
                    <label for="total" class="block mb-2 text-sm font-medium dark:text-white">Total Harga</label>
                    <div class="relative rounded-md">
                        <input type="text" readonly name="kain[0][warna][0][total]"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm total price dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                            value="{{ $barangMentahFirst->kainBarangMentah[0]->warnaKain[0]->total ?? old('total') }}">
                        <input type="hidden" id="total" readonly>
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                            <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                        </div>
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                            <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form buttons -->
            <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                <a href="/supplyer/detail/{{ $barangMentahFirst->supplyer_id }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                    Batal
                </a>
                <button type="button" id="submitFormBtn"
                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                    Update
                </button>
            </div>
        </form>

    </div>
    <br>
    <h2 class="font-bold text-center uppercase">Histori Tanggal</h2>
    <hr>
    @foreach ($barangMentahGet as $uniqueId => $items)
        <div>
            <div class="lg:flex">
                <div
                    class="flex flex-col bg-white border w-96 m-2 shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div
                        class="flex justify-between items-center border-b rounded-t-xl py-3 px-4 md:px-5 dark:border-neutral-700">
                        <h3 class="text-sm font-bold text-gray-800 dark:text-white">
                            ID: {{ $uniqueId }}
                        </h3>
                    </div>

                    <div class="p-4 md:p-5">

                        <div>
                            <ul class="space-y-3 text-sm">
                                @php $totalSemua = 0; @endphp
                                @foreach ($items as $it => $item)
                                    <ul
                                        class="text-sm font-semibold {{ $barangMentahFirst->id == $item->id ? 'bg-amber-200 p-2 rounded' : '' }}">
                                        @foreach ($item->kainBarangMentah as $kain)
                                            <li class="flex gap-x-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-arrow-down">
                                                    <path d="m14 18 4 4 4-4" />
                                                    <path d="M16 2v4" />
                                                    <path d="M18 14v8" />
                                                    <path
                                                        d="M21 11.354V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7.343" />
                                                    <path d="M3 10h18" />
                                                    <path d="M8 2v4" />
                                                </svg>
                                                <span class="text-gray-800 dark:text-neutral-400">
                                                    <span class="text-green-600"> {{ $kain->kain }} </span>
                                                    -
                                                    ({{ \Carbon\Carbon::parse($item->tanggal_datang)->translatedFormat('d F Y H:i') }})
                                                </span>
                                            </li>
                                            <div class="ps-8 py-2 ">
                                                <table
                                                    class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                                    <tbody>
                                                        @foreach ($kain->warnaKain as $warna)
                                                            @php $totalSemua += $warna->total; @endphp
                                                            <tr>
                                                                <td class="font-semibold">
                                                                    Total
                                                                </td>
                                                                <td>
                                                                    : {{ formatRupiah($warna->total) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </ul>
                                @endforeach
                                <hr>
                                <div class="ps-8 py-2 ">
                                    <table class="min-w-full text-sm text-left text-red-600 dark:text-neutral-200">
                                        <tbody>
                                            <tr>
                                                <td class="font-semibold">
                                                    Total Semuanya
                                                </td>
                                                <td class="font-semibold">
                                                    : {{ formatRupiah($totalSemua) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="relative m-3 lg:w-2/3 flex flex-col h-full overflow-x-auto text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                    <table class="w-full text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">Tanggal</p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">Informasi
                                        Lainnya
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $it => $item)
                                <tr
                                    class="hover:bg-slate-50 {{ $barangMentahFirst->id == $item->id ? 'bg-amber-200 p-2 rounded' : '' }}">
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ \Carbon\Carbon::parse($item->tanggal_datang)->translatedFormat('d F Y H:i') }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <div class="hs-accordion-group">
                                            @foreach ($item->kainBarangMentah as $kain)
                                                <div class="hs-accordion" id="hs-basic-nested-heading-one">
                                                    <button
                                                        class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
                                                        aria-expanded="false"
                                                        aria-controls="hs-basic-nested-collapse-one">
                                                        <svg class="hs-accordion-active:hidden block size-3.5"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M5 12h14"></path>
                                                            <path d="M12 5v14"></path>
                                                        </svg>
                                                        <svg class="hs-accordion-active:block hidden size-3.5"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M5 12h14"></path>
                                                        </svg>
                                                        {{ $kain->kain }}
                                                    </button>
                                                    <div id="hs-basic-nested-collapse-one"
                                                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                                        role="region" aria-labelledby="hs-basic-nested-heading-one"
                                                        style="height: 0px;">
                                                        @foreach ($kain->warnaKain as $warna)
                                                            <div class="hs-accordion-group ps-6">
                                                                <div class="hs-accordion"
                                                                    id="hs-basic-nested-sub-heading-one">
                                                                    <button
                                                                        class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400"
                                                                        aria-expanded="false"
                                                                        aria-controls="hs-basic-nested-sub-collapse-one">
                                                                        <svg class="hs-accordion-active:hidden block size-3"
                                                                            width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M2.62421 7.86L13.6242 7.85999"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"></path>
                                                                            <path d="M8.12421 13.36V2.35999"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"></path>
                                                                        </svg>
                                                                        <svg class="hs-accordion-active:block hidden size-3"
                                                                            width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M2.62421 7.86L13.6242 7.85999"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"></path>
                                                                        </svg>
                                                                        detail harga
                                                                    </button>
                                                                    <div id="hs-basic-nested-sub-collapse-one"
                                                                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                                                        role="region"
                                                                        aria-labelledby="hs-basic-nested-sub-heading-one"
                                                                        style="height: 0px;">
                                                                        <div class="p-4 bg-gray-100 rounded-lg">
                                                                            <table
                                                                                class="min-w-full text-sm text-left text-gray-800 dark:text-neutral-200">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="font-semibold">
                                                                                            Jumlah</td>
                                                                                        <td>: {{ $warna->jumlah }}
                                                                                            {{ $warna->satuan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="font-semibold">
                                                                                            Harga</td>
                                                                                        <td>:
                                                                                            {{ formatRupiah($warna->harga) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="font-semibold">
                                                                                            Total</td>
                                                                                        <td>:
                                                                                            {{ formatRupiah($warna->total) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.getElementById('submitFormBtn').addEventListener('click', function() {
            var form = document.getElementById('updateBarangMentahForm');
            var formData = new FormData(form);

            Swal.fire({
                title: 'Proses..',
                text: 'Proses update barang mentah.',
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false
            });

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Barang Mentah berhasil diupdate.',
                        }).then(() => {
                            window.location.href = '/supplyer/detail/{{ $supplayer->id }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            html: '<b>Gagal menyimpan data</b> <br> <center>Pastikan semua inputan terisi semuanya.</center>',
                        });
                    }

                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan: ' + error.message,
                    });
                });
        });
    </script>
@endsection
