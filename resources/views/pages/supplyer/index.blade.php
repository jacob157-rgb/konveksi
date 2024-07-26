@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="inline-block min-w-full p-1.5 align-middle">
                        <div
                            class="grid gap-3 px-6 py-4 border-b border-gray-200 dark:border-neutral-700 md:flex md:items-center md:justify-between">
                            <button type="button"
                                class="inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                                data-hs-overlay="#tambah-modal">
                                Tambah supplyer
                            </button>
                        </div>
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col"
                                            class="px-3 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            No.</th>
                                        <th scope="col"
                                            class="px-3 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Nama Supplyer</th>
                                        <th scope="col"
                                            class="px-3 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($supplyer as $row)
                                        <tr class="text-center">
                                            <td
                                                class="px-3 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $loop->iteration }}.</td>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->nama }}</td>
                                            <td class="px-3 py-4 space-x-1 text-sm font-medium whitespace-nowrap">
                                                <button type="button" data-hs-overlay="#tambah-barang"
                                                    data-supplyer-id="{{ $row->id }}"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-full tambah-barang gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                    Tambah
                                                    Barang Mentah
                                                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="lucide lucide-package-open">
                                                        <path d="M12 22v-9" />
                                                        <path
                                                            d="M15.17 2.21a1.67 1.67 0 0 1 1.63 0L21 4.57a1.93 1.93 0 0 1 0 3.36L8.82 14.79a1.655 1.655 0 0 1-1.64 0L3 12.43a1.93 1.93 0 0 1 0-3.36z" />
                                                        <path
                                                            d="M20 13v3.87a2.06 2.06 0 0 1-1.11 1.83l-6 3.08a1.93 1.93 0 0 1-1.78 0l-6-3.08A2.06 2.06 0 0 1 4 16.87V13" />
                                                        <path
                                                            d="M21 12.43a1.93 1.93 0 0 0 0-3.36L8.83 2.2a1.64 1.64 0 0 0-1.63 0L3 4.57a1.93 1.93 0 0 0 0 3.36l12.18 6.86a1.636 1.636 0 0 0 1.63 0z" />
                                                    </svg>
                                                </button>
                                                <button type="button" data-hs-overlay="#kirim-barang"
                                                    data-supplyer-id="{{ $row->id }}"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-full kirim-barang gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                    Kirim
                                                    Barang Jadi
                                                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="lucide lucide-package-check">
                                                        <path d="m16 16 2 2 4-4" />
                                                        <path
                                                            d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                                                        <path d="m7.5 4.27 9 5.15" />
                                                        <polyline points="3.29 7 12 12 20.71 7" />
                                                        <line x1="12" x2="12" y1="22" y2="12" />
                                                    </svg>
                                                </button>
                                                <a href="/supplyer/detail/{{ $row->id }}"
                                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-full gap-x-2 hover:bg-green-700 focus:bg-green-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                                                    Detail
                                                </a>
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
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Tambah supplyer
                    </h3>
                    <button type="button"
                        class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-7 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#tambah-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/supplyer" method="post">
                    @csrf
                    <div class="p-4 overflow-y-auto">
                        <label for="nama" class="block mb-2 text-sm font-medium dark:text-white">Nama</label>
                        <input type="text" id="nama" name="nama"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan supplyer" autofocus="">
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#tambah-modal">
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
    @include('partials.modal_tambah')
    @include('partials.modal_kirim')

    <div id="edit-modal"
        class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden">
        <div
            class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
            <div
                class="flex flex-col bg-white border shadow-sm pointer-events-auto rounded-xl dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Edit supplyer
                    </h3>
                    <button type="button"
                        class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-7 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#edit-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="/supplyer/update" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id_supplyer">
                    <div class="p-4 overflow-y-auto">
                        <label for="nama_supplyer" class="block mb-2 text-sm font-medium dark:text-white">Nama</label>
                        <input type="text" id="nama_supplyer" name="nama"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Jenis supplyer" autofocus="">
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#edit-modal">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.edit', function(e) {
            let supplyer_id = $(this).data('id');
            $.ajax({
                url: `/supplyer/edit/${supplyer_id}`,
                type: "GET",
                success: function(response) {
                    $('#id_supplyer').val(response.data.id);
                    $('#nama_supplyer').val(response.data.nama);
                    $('#edit-modal').addClass('hs-overlay-open');
                }
            });
        });
    </script>
@endsection
