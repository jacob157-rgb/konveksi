@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-green-600 border border-gray-200 rounded shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <h2 class="font-bold text-center text-white uppercase">RETURN BARANG ID : {{ $return->unique_id }}</h2>
    </div>

    <form action="/return/update/{{ $return->id }}" method="post" id="addBarangMentahForm">
        @csrf
        <div class="bg-white shadow-sm border rounded-lg start-0 top-0 z-[80] overflow-y-auto overflow-x-hidden">
            <div class="p-4 -mt-2 space-y-2 overflow-y-auto">
                <input type="hidden" class="unique_id" name="unique_id" value="{{ $return->unique_id }}">

                <label for="tanggal" class="block mb-2 text-sm font-medium dark:text-white">Tanggal</label>
                <input type="datetime-local" name="tanggal"
                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                    value="{{ $return->tanggal }}">
            </div>

            {{-- Dynamic Entry --}}
            <div id="dynamic-entry">
                <div class="p-4 -mt-2 space-y-2 overflow-y-auto entry-group">
                    <label for="jenis" class="block mb-2 text-sm font-medium dark:text-white">Jenis Model</label>
                    <select name="model"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 focus:border-blue-500 focus:ring-blue-500">
                        <option  value="">Pilih Model</option>
                        @foreach ($model as $row)
                            <option value="{{ $row->nama }}" {{ $row->nama == $return->model ? 'selected' : '' }}>{{ $row->nama }}</option>
                        @endforeach
                    </select>

                    <label for="jumlah" class="block mb-2 text-sm font-medium dark:text-white">Jml. Barang</label>
                    <input type="number" name="jumlah"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg jumlah dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukan Jumlah Barang" value="{{ $return->jumlah }}">

                    <label for="harga" class="block mb-2 text-sm font-medium dark:text-white">Harga Barang</label>
                    <div class="relative rounded-md">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-neutral-500 ">Rp.
                        </span>
                        <input type="number" name="harga"
                            class="block w-full pl-10 pr-16 py-3 text-sm border border-gray-200 rounded-lg harga dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukan Harga Barang" value="{{ $return->harga }}">
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-neutral-500">IDR</span>
                    </div>

                    <label for="total" class="block mb-2 text-sm font-medium dark:text-white">Total Harga</label>
                    <div class="relative rounded-md">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-neutral-500">Rp.</span>
                        <input type="text" readonly name="total"
                            class="block w-full pl-10 pr-16 py-3 text-sm border border-gray-200 rounded-lg total dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Total Harga Otomatis" value="{{ $return->total }}">
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-neutral-500">IDR</span>
                    </div>

                </div>
            </div>


            <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                <button type="submit"
                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Kirim
                </button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            // Function to calculate the total price
            function calculateTotal() {
                var jumlah = parseFloat($('input[name="jumlah"]').val()) || 0;
                var harga = parseFloat($('input[name="harga"]').val()) || 0;
                var total = jumlah * harga;
                
                // Set the total value
                $('input[name="total"]').val(total);
            }
    
            // Trigger calculate function when 'jumlah' or 'harga' input changes
            $('input[name="jumlah"], input[name="harga"]').on('input', function () {
                calculateTotal();
            });
    
            // Trigger the calculation on page load if there are values already set
            calculateTotal();
        });
    </script>
    
@endsection
