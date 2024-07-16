@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div
                        class="grid gap-3 px-6 py-4 border-b border-gray-200 dark:border-neutral-700 md:flex md:items-center md:justify-between">
                        <button type="button"
                            class="inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                            data-hs-overlay="#tambah-modal">
                            Tambah supplyer
                        </button>
                    </div>
                    <div class="inline-block min-w-full p-1.5 align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            No.</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Nama</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($supplyer as $row)
                                        <tr class="text-center">
                                            <td
                                                class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $loop->iteration }}.</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                {{ $row->nama }}</td>
                                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                                <button type="button" data-id="{{ $row->id }}"
                                                    data-hs-overlay="#edit-modal"
                                                    class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg edit gap-x-2 hover:text-blue-800 disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400">Edit</button>
                                                <form action="/supplyer/delete/{{ $row->id }}" method="post"
                                                    class="inline-flex delete-form">
                                                    @csrf
                                                    <button type="button"
                                                        class="inline-flex items-center text-sm font-semibold text-red-600 border border-transparent rounded-lg delete gap-x-2 hover:text-red-800 disabled:pointer-events-none disabled:opacity-50 dark:text-red-500 dark:hover:text-red-400">
                                                        Hapus
                                                    </button>
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
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
