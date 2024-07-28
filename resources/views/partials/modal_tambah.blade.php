<div id="tambah-barang"
    class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden">
    <div
        class="m-3 mt-0 opacity-0 transition-all ease-out hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
        <div
            class="pointer-events-auto flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
            <div class="flex items-center justify-between border-b px-4 py-3 dark:border-neutral-700">
                <h3 class="font-bold text-gray-800 dark:text-white">
                    Tambah Barang
                </h3>
                <button type="button"
                    class="size-7 flex items-center justify-center rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                    data-hs-overlay="#tambah-barang">
                    <span class="sr-only">Close</span>
                    <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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
                <div class="-mt-2 space-y-2 overflow-y-auto p-4">
                    <input type="hidden" class="supplyer_id" name="supplyer_id" value="{{ old('supplyer_id') }}">

                    <label for="tanggal_datang" class="mb-2 block text-sm font-medium dark:text-white">Tanggal
                        Masuk</label>
                    <input type="datetime-local" name="tanggal_datang"
                        class="block w-full rounded-lg border border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                        autofocus="" value="{{ old('tanggal_datang') }}">

                    <label for="kain_id" class="mb-2 block text-sm font-medium dark:text-white">Jenis Kain</label>
                    <select name="kain_id"
                        class="block w-full rounded-lg border border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        <option value="">Pilih Jenis Kain</option>
                        @foreach ($kain as $row)
                            <option value="{{ $row->id }}" {{ old('kain_id') == $row->id ? 'selected' : '' }}>
                                {{ $row->nama }}</option>
                        @endforeach
                    </select>

                    <div class="value-container">

                        <div>
                            <label for="hs-inline-leading-pricing-select-label"
                                class="mb-2 block text-sm font-medium dark:text-white">Jml. Barang</label>
                            <div class="relative">
                                <input type="number" id="hs-inline-leading-pricing-select-label" name="jumlah_mentah"
                                    class="jumlah block w-full rounded-lg border border-gray-200 px-4 py-3 pe-20 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Masukan Jumlah Barang" value="{{ old('jumlah_mentah') }}">
                                <div class="absolute inset-y-0 end-0 flex items-center pe-px text-gray-500">
                                    <label for="satuan" class="sr-only">Satuan</label>
                                    <select id="satuan" name="satuan"
                                        class="block w-full rounded-lg border border-transparent focus:border-blue-600 focus:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-500">
                                        <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg</option>
                                        <option value="yard" {{ old('satuan') == 'yard' ? 'selected' : 'selected' }}>
                                            Yard</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <label for="harga" class="mb-2 block text-sm font-medium dark:text-white">Harga
                            Barang</label>
                        <div class="relative rounded-md">
                            <input type="text" name="harga"
                                class="nominal price block w-full rounded-lg border-gray-200 px-4 py-3 pe-16 ps-10 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                value="{{ old('harga') }}">
                            <input type="hidden" id="nominal">
                            <div class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div class="pointer-events-none absolute inset-y-0 end-0 z-20 flex items-center pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>

                        <label for="total" class="mb-2 block text-sm font-medium dark:text-white">Total Harga</label>
                        <div class="relative rounded-md">
                            <input type="text" readonly
                                class="total price block w-full rounded-lg border-gray-200 px-4 py-3 pe-16 ps-10 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                value="{{ old('total') }}">
                            <input type="hidden" id="total" readonly>
                            <div class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-4">
                                <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                            </div>
                            <div class="pointer-events-none absolute inset-y-0 end-0 z-20 flex items-center pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-2 border-t px-4 py-3 dark:border-neutral-700">
                    <button type="button"
                        class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                        data-hs-overlay="#tambah-barang">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                        Tambah
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
