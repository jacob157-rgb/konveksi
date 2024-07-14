@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div
                        class="grid gap-3 border-b border-gray-200 px-6 py-4 dark:border-neutral-700 md:flex md:items-center md:justify-between">
                        <button type="button"
                            class="inline-flex items-center justify-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                            data-hs-overlay="#tambah-modal">
                            Tambah karyawan
                        </button>
                    </div>
                    <div class="inline-block min-w-full p-1.5 align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                            No.</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                            Nama</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                            Jenis</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                            Nomor Hp</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                            Alamat</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($karyawan as $row)
                                        <tr class="text-center">
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $loop->iteration }}.</td>
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $row->nama }}</td>
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $row->jenis_karyawan }}</td>
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $row->no }}</td>
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $row->alamat }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <button type="button" data-id="{{ $row->id }}"
                                                    data-hs-overlay="#edit-modal"
                                                    class="edit inline-flex items-center gap-x-2 rounded-lg border border-transparent text-sm font-semibold text-blue-600 hover:text-blue-800 disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400">Edit</button>
                                                <form action="/karyawan/delete/{{ $row->id }}" method="post"
                                                    class="inline-flex">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-x-2 rounded-lg border border-transparent text-sm font-semibold text-red-600 hover:text-red-800 disabled:pointer-events-none disabled:opacity-50 dark:text-red-500 dark:hover:text-red-400">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tambah-modal"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden">
        <div
            class="m-3 mt-0 opacity-0 transition-all ease-out hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="pointer-events-auto flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between border-b px-4 py-3 dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Tambah Jenis karyawan
                    </h3>
                    <button type="button"
                        class="size-7 flex items-center justify-center rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#tambah-modal">
                        <span class="sr-only">Close</span>
                        <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/karyawan" method="post">
                    @csrf
                    <div class="overflow-y-auto p-4">
                        <label for="nama" class="mb-2 block text-sm font-medium dark:text-white">Nama</label>
                        <input type="text" id="nama" name="nama"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Nama karyawan" autofocus="">

                        <label for="jenis_karyawan" class="mb-2 block text-sm font-medium dark:text-white">Jenis
                            Karyawan</label>
                        <select id="jenis_karyawan" name="jenis_karyawan"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500">
                            <option value="cutting">Cutting</option>
                            <option value="jahit">Jahit</option>
                        </select>

                        <label for="no" class="mb-2 block text-sm font-medium dark:text-white">Nomor Hp</label>
                        <input type="text" id="no" name="no" maxlength="15"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Nomor karyawan">

                        <label for="alamat" class="mb-2 block text-sm font-medium dark:text-white">Alamat</label>
                        <input type="text" id="alamat" name="alamat"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Alamat karyawan">
                    </div>
                    <div class="flex items-center justify-end gap-x-2 border-t px-4 py-3 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#tambah-modal">
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

    <div id="edit-modal"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden">
        <div
            class="m-3 mt-0 opacity-0 transition-all ease-out hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="pointer-events-auto flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between border-b px-4 py-3 dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Edit Jenis karyawan
                    </h3>
                    <button type="button"
                        class="size-7 flex items-center justify-center rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#edit-modal">
                        <span class="sr-only">Close</span>
                        <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/karyawan/update" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id_model">
                    <div class="overflow-y-auto p-4">
                        <label for="nama_model" class="mb-2 block text-sm font-medium dark:text-white">Nama</label>
                        <input type="text" id="nama_model" name="nama"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Nama" autofocus="">
                    </div>
                    <div class="overflow-y-auto p-4">
                        <label for="jenis_karyawan_model" class="mb-2 block text-sm font-medium dark:text-white">Jenis
                            Karyawan</label>
                        <select id="jenis_karyawan_model" name="jenis_karyawan"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500">
                            <option value="cutting">Cutting</option>
                            <option value="jahit">Jahit</option>
                        </select>
                    </div>
                    <div class="overflow-y-auto p-4">
                        <label for="no_model" class="mb-2 block text-sm font-medium dark:text-white">No</label>
                        <input type="text" id="no_model" name="no"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan No">
                    </div>
                    <div class="overflow-y-auto p-4">
                        <label for="alamat_model" class="mb-2 block text-sm font-medium dark:text-white">Alamat</label>
                        <input type="text" id="alamat_model" name="alamat"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Alamat">
                    </div>
                    <div class="flex items-center justify-end gap-x-2 border-t px-4 py-3 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#edit-modal">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.edit', function(e) {
            let model_id = $(this).data('id');
            $.ajax({
                url: `/karyawan/edit/${model_id}`,
                type: "GET",
                success: function(response) {
                    $('#id_model').val(response.data.id);
                    $('#nama_model').val(response.data.nama);
                    $('#jenis_karyawan_model').val(response.data
                    .jenis_karyawan); // Tambahkan input jenis karyawan
                    $('#no_model').val(response.data.no); // Tambahkan input no
                    $('#alamat_model').val(response.data.alamat); // Tambahkan input alamat
                    $('#edit-modal').addClass('hs-overlay-open');
                }
            });
        });
    </script>
@endsection