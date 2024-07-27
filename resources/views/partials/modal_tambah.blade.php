<div id="tambah-barang"
    class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden">
    <div
        class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
        <div
            class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
            <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                <h3 class="font-bold text-gray-800 dark:text-white">
                    Tambah Barang
                </h3>
                <button type="button"
                    class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-7 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                    data-hs-overlay="#tambah-barang">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/barang/mentah" method="post">
                @csrf
                <div class="p-4 -mt-2 space-y-2 overflow-y-auto">
                    <input type="hidden" class="supplyer_id" name="supplyer_id" value="{{ old('supplyer_id') }}">

                    <label for="tanggal_datang" class="block mb-2 text-sm font-medium dark:text-white">Tanggal
                        Masuk</label>
                    <input type="datetime-local" name="tanggal_datang"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                        autofocus="" value="{{ old('tanggal_datang') }}" >

                    <label for="kain_id" class="block mb-2 text-sm font-medium dark:text-white">Jenis Kain</label>
                    <select name="kain_id"
                        class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        <option value="">Pilih Jenis Kain</option>
                        @foreach ($kain as $row)
                            <option value="{{ $row->id }}" {{ old('kain_id') == $row->id ? 'selected' : '' }}>
                                {{ $row->nama }}</option>
                        @endforeach
                    </select>

                    <div>
                        <label for="hs-inline-leading-pricing-select-label"
                            class="block mb-2 text-sm font-medium dark:text-white">Jml. Barang</label>
                        <div class="relative">
                            <input type="number" id="hs-inline-leading-pricing-select-label" name="jumlah_mentah"
                                class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg shadow-sm jumlah pe-20 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukan Jumlah Barang" value="{{ old('jumlah_mentah') }}">
                            <div class="absolute inset-y-0 flex items-center text-gray-500 end-0 pe-px">
                                <label for="satuan" class="sr-only">Satuan</label>
                                <select id="satuan" name="satuan"
                                    class="block w-full border border-transparent rounded-lg focus:border-blue-600 focus:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-500">
                                    <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg</option>
                                    <option value="yard" {{ old('satuan') == 'yard' ? 'selected' : 'selected' }}>Yard</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <label for="harga" class="block mb-2 text-sm font-medium dark:text-white">Harga Barang</label>
                    <div class="relative rounded-md">
                        <input type="text" name="harga"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            value="{{ old('harga') }}">
                        <input type="hidden" id="nominal">
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                            <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                        </div>
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                            <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                        </div>
                    </div>

                    <label for="total" class="block mb-2 text-sm font-medium dark:text-white">Total Harga</label>
                    <div class="relative rounded-md">
                        <input type="text" readonly
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm total price pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            value="{{ old('total') }}">
                        <input type="hidden" id="total" readonly>
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                            <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                        </div>
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                            <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                        data-hs-overlay="#tambah-barang">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                        Tambah
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
