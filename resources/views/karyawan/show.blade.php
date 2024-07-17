@extends('layouts.dashboard')

@section('content')
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <div class="mb-5 flex items-center justify-between pb-5">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Detail Karyawan</h2>
            </div>
            <div class="mt-2 inline-flex gap-x-2">
                <a target="blank" class="inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
                    href="/karyawan/print/{{ $karyawan->id }}">
                    <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9" />
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                        <rect width="12" height="8" x="6" y="14" />
                    </svg>
                    Print
                </a>
            </div>
        </div>
        <hr>
        <table border="1" class="my-5">
            <tr>
                <td class="font-medium">Nama Cutting</td>
                <td>&nbsp; : &nbsp;{{ $karyawan->nama }}</td>
            </tr>
            <tr>
                <td class="font-medium">No. Tlp</td>
                <td>&nbsp; : &nbsp;{{ $karyawan->no }}</td>
            </tr>
            <tr>
                <td class="font-medium">Alamat</td>
                <td>&nbsp; : &nbsp;{{ $karyawan->alamat }}</td>
            </tr>
        </table>
        <table border="1" class="my-5">
            <tr>
                <td class="font-medium">Total Bon Belum Lunas</td>
                <td>&nbsp; : &nbsp;{{ formatRupiah($totalBelumLunas) }}</td>
            </tr>
            <tr>
                <td class="font-medium">Total Bon Sudah Lunas</td>
                <td>&nbsp; : &nbsp;{{ formatRupiah($totalLunas) }}</td>
            </tr>
        </table>
        <div class="mb-5 flex items-center justify-between pb-5">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Histori BON</h2>
            </div>
        </div>
        <hr>
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
                                Nominal BON</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Tanggal Dibuat</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Tanggal Diupdate</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @foreach ($bon as $row)
                            <tr class="text-center">
                                <td
                                    class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                    {{ $loop->iteration }}.</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                    {{ formatRupiah($row->nominal) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                    {{ \Carbon\Carbon::parse($row->created_at)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                    {{ \Carbon\Carbon::parse($row->updated_at)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                    @if ($row->status == 'lunas')
                                        <span class="font-bold text-green-600">LUNAS</span>
                                    @else
                                        <span class="font-bold text-red-600">BELUM LUNAS</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm ">
                                    <button type="button" data-id="{{ $row->id }}" data-hs-overlay="#edit-modal"
                                        class="edit py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Edit</button>
                                    @if ($row->cutting_id)
                                        <a href="/barang/show/{{ $row->cutting->barang_id }}"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-600 text-white hover:bg-yellow-700 disabled:opacity-50 disabled:pointer-events-none">History
                                            Barang</a>
                                    @else
                                        <a href="/barang/show/{{ $row->jahit->barang_id }}"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-600 text-white hover:bg-yellow-700 disabled:opacity-50 disabled:pointer-events-none">History
                                            Barang</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                        Edit BON
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
                <form action="/karyawan/update/bon" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id_bon">
                    <div class="p-4 overflow-y-auto">
                        <label for="nominal" class="block mb-2 text-sm font-medium dark:text-white">Nominal</label>
                        <input type="text" id="nominal" name="nominal"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Nominal">
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <label for="status" class="block mb-2 text-sm font-medium dark:text-white">Status</label>
                        <select id="status" name="status"
                            class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500">
                            <option value="lunas">lunas</option>
                            <option value="belumlunas">belum lunas</option>
                        </select>
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
            let bon_id = $(this).data('id');
            $.ajax({
                url: `/karyawan/edit/bon/${bon_id}`,
                type: "GET",
                success: function(response) {
                    $('#id_bon').val(response.data.id);
                    $('#nominal').val(response.data.nominal);
                    $('#status').val(response.data.status);
                    $('#edit-modal').addClass('hs-overlay-open');
                }
            });
        });
    </script>
@endsection
