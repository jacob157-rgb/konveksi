@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-green-600 border border-gray-200 rounded shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <h2 class="font-bold text-center text-white uppercase">RETURN BARANG ID : {{ $unique }}</h2>
    </div>

    <form action="/return/store/" method="post" id="addBarangMentahForm">
        @csrf
        <div class="bg-white shadow-sm border rounded-lg start-0 top-0 z-[80] overflow-y-auto overflow-x-hidden">
            <div class="p-4 -mt-2 space-y-2 overflow-y-auto">
                <input type="hidden" class="unique_id" name="unique_id" value="{{ $unique }}">

                <label for="tanggal" class="block mb-2 text-sm font-medium dark:text-white">Tanggal</label>
                <input type="datetime-local" name="tanggal"
                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                    value="{{ old('tanggal') }}">
            </div>

            {{-- Dynamic Entry --}}
            <div id="dynamic-entry">
                <div class="p-4 -mt-2 space-y-2 overflow-y-auto entry-group">
                    <label for="jenis" class="block mb-2 text-sm font-medium dark:text-white">Jenis Model</label>
                    <select name="model[]"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 focus:border-blue-500 focus:ring-blue-500">
                        <option selected value="">Pilih Model</option>
                        @foreach ($model as $row)
                            <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                        @endforeach
                    </select>

                    <label for="jumlah" class="block mb-2 text-sm font-medium dark:text-white">Jml. Barang</label>
                    <input type="number" name="jumlah[]"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg jumlah dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukan Jumlah Barang">

                    <label for="harga" class="block mb-2 text-sm font-medium dark:text-white">Harga Barang</label>
                    <div class="relative rounded-md">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-neutral-500 ">Rp.
                        </span>
                        <input type="number" name="harga[]"
                            class="block w-full pl-10 pr-16 py-3 text-sm border border-gray-200 rounded-lg harga dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukan Harga Barang">
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-neutral-500">IDR</span>
                    </div>

                    <label for="total" class="block mb-2 text-sm font-medium dark:text-white">Total Harga</label>
                    <div class="relative rounded-md">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-neutral-500">Rp.</span>
                        <input type="text" readonly name="total[]"
                            class="block w-full pl-10 pr-16 py-3 text-sm border border-gray-200 rounded-lg total dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Total Harga Otomatis">
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-neutral-500">IDR</span>
                    </div>

                    <button type="button" class="remove-entry bg-red-500 text-white px-4 py-2 rounded-lg mt-2 hidden">
                        Hapus
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                <button type="button" id="add-entry"
                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Tambah Model Return
                </button>
            </div>

            <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                <button type="submit"
                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Kirim
                </button>
            </div>
        </div>
    </form>


    {{-- Script untuk menambah dan menghapus entri serta kalkulasi otomatis --}}
    <script>
        document.getElementById('add-entry').addEventListener('click', function() {
            var entry = document.querySelector('.entry-group').cloneNode(true);

            // Reset nilai input
            entry.querySelector('select[name="model[]"]').value = '';
            entry.querySelector('input[name="jumlah[]"]').value = '';
            entry.querySelector('input[name="harga[]"]').value = '';
            entry.querySelector('input[name="total[]"]').value = '';

            // Tampilkan tombol Hapus Entri
            entry.querySelector('.remove-entry').classList.remove('hidden');

            document.getElementById('dynamic-entry').appendChild(entry);
            toggleRemoveButtons();
        });

        document.getElementById('dynamic-entry').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-entry')) {
                e.target.parentNode.remove();
                toggleRemoveButtons();
            }
        });

        document.getElementById('dynamic-entry').addEventListener('input', function(e) {
            if (e.target && (e.target.classList.contains('jumlah') || e.target.classList.contains('harga'))) {
                calculateTotal(e.target.closest('.entry-group'));
            }
        });

        function calculateTotal(entry) {
            var jumlah = parseFloat(entry.querySelector('input[name="jumlah[]"]').value) || 0;
            var harga = parseFloat(entry.querySelector('input[name="harga[]"]').value.replace(/[^0-9.-]+/g, "")) || 0;
            var total = entry.querySelector('input[name="total[]"]');
            total.value = jumlah * harga;
        }

        function toggleRemoveButtons() {
            var entries = document.querySelectorAll('.entry-group');
            entries.forEach(function(entry, index) {
                var removeButton = entry.querySelector('.remove-entry');
                if (entries.length > 1) {
                    removeButton.classList.remove('hidden');
                } else {
                    removeButton.classList.add('hidden');
                }
            });
        }

        // Inisialisasi saat halaman dimuat
        toggleRemoveButtons();
    </script>
@endsection
