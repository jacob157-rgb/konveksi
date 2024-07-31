@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col rounded border border-gray-200 bg-green-600 p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <h2 class="text-center font-bold uppercase text-white">SUPPLYER {{ $supplyer->nama }}</h2>
    </div>
    <div
        class="flex flex-col rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <form action="/barang/mentah" method="post" id="addBarangMentahForm">
                    @csrf
                    <div class="inline-block min-w-full py-1.5 align-middle">

                        <div class="border-b p-2">
                            <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Tambah Barang Mentah</h2>
                        </div>

                        <input type="text" name="supplyer_id" hidden value="{{ $supplyer->id }}">
                        <div class="kain-container overflow-y-auto px-3 py-4">
                            <label for="tanggal_datang" class="mb-2 block text-sm font-medium dark:text-white">Tanggal
                                Datang</label>
                            <input type="datetime-local" id="tanggal_datang" name="tanggal_datang"
                                class="block w-full rounded-lg border border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                                autofocus="">
                            <div class="kain-card">
                                <div
                                    class="mt-3 flex flex-col rounded-xl border border-blue-800 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                                    <label for="kain_id"
                                        class="mb-2 block text-sm font-medium dark:text-white">Kain</label>
                                    <select name="kain[0][nama]"
                                        class="block w-full rounded-lg border border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option selected value="">Pilih Jenis Kain</option>
                                        @foreach ($kain as $row)
                                            <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="warna-container">
                                        <div class="warna-card">
                                            <div
                                                class="mt-3 flex flex-col rounded-xl border border-red-800 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                                                <label for="warna_id"
                                                    class="mb-2 block text-sm font-medium dark:text-white">Warna</label>
                                                <select name="kain[0][warna][0][warna]"
                                                    class="block w-full rounded-lg border border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                    <option selected value="">Pilih Warna</option>
                                                    @foreach ($warna as $row)
                                                        <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="value-container">
                                                    <label for="hs-inline-leading-pricing-select-label"
                                                        class="mb-2 block text-sm font-medium dark:text-white">Jml.
                                                        Barang</label>
                                                    <div class="relative">
                                                        <input type="number" id="hs-inline-leading-pricing-select-label"
                                                            name="kain[0][warna][0][jumlah_mentah]"
                                                            class="jumlah block w-full rounded-lg border border-gray-200 px-4 py-3 pe-20 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Masukan Jumlah Barang">
                                                        <div
                                                            class="absolute inset-y-0 end-0 flex items-center pe-px text-gray-500">
                                                            <label for="satuan" class="sr-only">Satuan</label>
                                                            <select id="satuan" name="kain[0][warna][0][satuan]"
                                                                class="block w-full rounded-lg border border-transparent focus:border-blue-600 focus:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-500">
                                                                <option value="kg">Kg</option>
                                                                <option value="yard" selected>Yard</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label for="harga"
                                                        class="mb-2 block text-sm font-medium dark:text-white">Harga
                                                        Barang</label>
                                                    <div class="relative rounded-md">
                                                        <input type="text" name="kain[0][warna][0][harga]"
                                                            class="nominal price block w-full rounded-lg border-gray-200 px-4 py-3 pe-16 ps-10 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                        <input type="hidden" id="nominal">
                                                        <div
                                                            class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-4">
                                                            <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                                                        </div>
                                                        <div
                                                            class="pointer-events-none absolute inset-y-0 end-0 z-20 flex items-center pe-4">
                                                            <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                                                        </div>
                                                    </div>
                                                    <label for="total"
                                                        class="mb-2 block text-sm font-medium dark:text-white">Total
                                                        Harga</label>
                                                    <div class="relative rounded-md">
                                                        <input type="text" readonly name="kain[0][warna][0][total]"
                                                            class="total price block w-full rounded-lg border-gray-200 px-4 py-3 pe-16 ps-10 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                        <input type="hidden" id="total" readonly>
                                                        <div
                                                            class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-4">
                                                            <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                                                        </div>
                                                        <div
                                                            class="pointer-events-none absolute inset-y-0 end-0 z-20 flex items-center pe-4">
                                                            <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-4 flex items-center justify-start gap-x-2 border-t px-4 pt-3 dark:border-neutral-700">
                                        <button type="button"
                                            class="tambah-warna inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                            Tambah Warna
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="flex items-center justify-between gap-x-2 border-t px-4 pt-3 dark:border-neutral-700">
            <div>
                <button type="button"
                    class="tambah-kain inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                    Tambah Kain
                </button>
            </div>
            <div>
                <button type="button"
                    class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                    data-hs-overlay="#tambah-modal">
                    Batal
                </button>
                <button type="button" id="submitFormBtn"
                    class="inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                    Kirim
                </button>
            </div>
            </form>
        </div>
    </div>

    <script>
        let kainCount = 1
        let warnaCount = 1

        document.addEventListener('click', (event) => {
            if (event.target.classList.contains('tambah-kain')) {
                const kainContainer = document.getElementsByClassName('kain-container')[0];

                const cardKain = `
                <div class="kain-card">
                    <div class="flex flex-col p-4 mt-3 bg-white border border-blue-700 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                        <div class="flex items-center justify-start mb-4">
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-red-500 border border-transparent rounded-lg hapus-kain gap-x-2 hover:bg-red-600 disabled:pointer-events-none disabled:opacity-50">
                                Hapus Model -
                            </button>
                        </div>
                        <label for="kain_id"
                            class="block mb-2 text-sm font-medium dark:text-white">Model</label>
                        <select name="kain[${kainCount}][nama]"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option selected value="">Pilih Model</option>
                            @foreach ($kain as $row)
                                <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                            @endforeach
                        </select>
                        <div class="warna-container">
                            <div class="warna-card">
                                <div
                                    class="flex flex-col p-4 mt-3 bg-white border border-red-800 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                                    <label for="warna_id"
                                        class="block mb-2 text-sm font-medium dark:text-white">Warna</label>
                                    <select name="kain[${kainCount}][warna][${warnaCount}][warna]"
                                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option selected value="">Pilih Warna</option>
                                        @foreach ($warna as $row)
                                            <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="value-container">
                                        <label for="hs-inline-leading-pricing-select-label"
                                            class="block mb-2 text-sm font-medium dark:text-white">Jml.
                                            Barang</label>
                                        <div class="relative">
                                            <input type="number" id="hs-inline-leading-pricing-select-label"
                                                name="kain[${kainCount}][warna][${warnaCount}][jumlah_mentah]"
                                                class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg shadow-sm jumlah pe-20 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                placeholder="Masukan Jumlah Barang">
                                            <div
                                                class="absolute inset-y-0 flex items-center text-gray-500 end-0 pe-px">
                                                <label for="satuan" class="sr-only">Satuan</label>
                                                <select id="satuan" name="kain[${kainCount}][warna][${warnaCount}][satuan]"
                                                    class="block w-full border border-transparent rounded-lg focus:border-blue-600 focus:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-500">
                                                    <option value="kg">Kg</option>
                                                    <option value="yard" selected>Yard</option>
                                                </select>
                                            </div>
                                        </div>
                                        <label for="harga"
                                            class="block mb-2 text-sm font-medium dark:text-white">Harga
                                            Barang</label>
                                        <div class="relative rounded-md">
                                            <input type="text" name="kain[${kainCount}][warna][${warnaCount}][harga]"
                                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
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
                                        <label for="total"
                                            class="block mb-2 text-sm font-medium dark:text-white">Total
                                            Harga</label>
                                        <div class="relative rounded-md">
                                            <input type="text" readonly name="kain[${kainCount}][warna][${warnaCount}][total]"
                                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm total price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <input type="hidden" id="total" readonly>
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
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-start px-4 pt-3 mt-4 border-t gap-x-2 dark:border-neutral-700">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg tambah-warna gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                Tambah Warna
                            </button>
                        </div>
                    </div>
                </div>
                `

                kainContainer.insertAdjacentHTML('beforeend', cardKain);
                kainCount++;
                warnaCount++;
            }

            // Hapus Variant button functionality
            if (event.target.classList.contains('hapus-kain')) {
                console.log('click')
                const kainCard = event.target.closest('.kain-card');
                kainCard.remove();
            }
        });


        document.addEventListener('click', (event) => {
            if (event.target.classList.contains('tambah-warna')) {
                // const warnaContainer = event.target.closest('.kain-card').querySelector('.warna-container');
                const kainCard = event.target.closest('.kain-card');
                const kainSelect = kainCard.querySelector('select[name^="kain["]');
                const kainName = kainSelect.getAttribute('name');
                const kainCountMatch = kainName.match(/kain\[(\d+)\]/);
                let kainCount = 0;

                if (kainCountMatch) {
                    kainCount = kainCountMatch[1];
                }

                console.log(kainCard)
                const warnaContainer = kainCard.querySelector('.warna-container');

                if (warnaContainer) {
                    const cardWarna = `
                <div class="warna-card">
                    <div class="flex flex-col p-4 mt-3 bg-white border border-red-800 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
                        <div class="flex items-center justify-start mb-4">
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-red-500 border border-transparent rounded-lg hapus-warna gap-x-2 hover:bg-red-600 disabled:pointer-events-none disabled:opacity-50">
                                Hapus Warna -
                            </button>
                        </div>
                        <label for="warna_id"
                            class="block mb-2 text-sm font-medium dark:text-white">Warna</label>
                        <select name="kain[${kainCount}][warna][${warnaCount}][warna]"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option selected value="">Pilih Warna</option>
                            @foreach ($warna as $row)
                                <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                            @endforeach
                        </select>
                        <div class="value-container">
                            <label for="hs-inline-leading-pricing-select-label"
                                class="block mb-2 text-sm font-medium dark:text-white">Jml.
                                Barang</label>
                            <div class="relative">
                                <input type="number" id="hs-inline-leading-pricing-select-label"
                                    name="kain[${kainCount}][warna][${warnaCount}][jumlah_mentah]"
                                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg shadow-sm jumlah pe-20 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Masukan Jumlah Barang">
                                <div
                                    class="absolute inset-y-0 flex items-center text-gray-500 end-0 pe-px">
                                    <label for="satuan" class="sr-only">Satuan</label>
                                    <select id="satuan" name="kain[${kainCount}][warna][${warnaCount}][satuan]"
                                        class="block w-full border border-transparent rounded-lg focus:border-blue-600 focus:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-500">
                                        <option value="kg">Kg</option>
                                        <option value="yard" selected>Yard</option>
                                    </select>
                                </div>
                            </div>
                            <label for="harga"
                                class="block mb-2 text-sm font-medium dark:text-white">Harga
                                Barang</label>
                            <div class="relative rounded-md">
                                <input type="text" name="kain[${kainCount}][warna][${warnaCount}][harga]"
                                    class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
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
                            <label for="total"
                                class="block mb-2 text-sm font-medium dark:text-white">Total
                                Harga</label>
                            <div class="relative rounded-md">
                                <input type="text" readonly name="kain[${kainCount}][warna][${warnaCount}][total]"
                                    class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm total price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                <input type="hidden" id="total" readonly>
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
                    </div>
                </div>
                `;

                    // Append the new card to the found 'warna-container'
                    warnaContainer.insertAdjacentHTML('beforeend', cardWarna);
                    warnaCount++;
                }
            }

            // Hapus Variant button functionality
            if (event.target.classList.contains('hapus-warna')) {
                const warnaCard = event.target.closest('.warna-card');
                warnaCard.remove();
            }
        });
    </script>

    <script>
        document.getElementById('submitFormBtn').addEventListener('click', function() {
            var form = document.getElementById('addBarangMentahForm');
            var formData = new FormData(form);

            Swal.fire({
                title: 'Proses..',
                text: 'Proses tambah barang mentah.',
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
                            text: 'Barang Mentah berhasil ditambahkan.',
                        }).then(() => {
                            window.location.href = '/supplyer';
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
