<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="border rounded-lg divide-y divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                <div class="py-3 px-4">
                    <form class="relative max-w-xs">
                        <label class="sr-only">Search</label>
                        <input type="hidden" name="barang" value="kirim">
                        <input type="date" name="date" value="{{ request()->query('date') }}"
                            class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Cari barang datang">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                            <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </svg>
                        </div>
                    </form>
                </div>
                @if (request()->query('date'))
                    <div class="flex items-center space-x-2 p-4 ">
                        <span class="text-lg font-semibold text-gray-700 dark:text-neutral-300">Pencarian di
                            hari:</span>
                        <span class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                            {{ \Carbon\Carbon::parse(request()->query('date'))->translatedFormat('l, d F Y') }}
                        </span>
                        <a href="?barang=kirim"
                            class=" flex items-center text-sm font-medium rounded-lg border border-transparent  hover:text-danger-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-refresh-ccw">
                                <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                                <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                                <path d="M16 16h5v5" />
                            </svg>
                        </a>
                    </div>
                @endif
                @php
                    $prevDate = null;
                    $index = 1;
                    $totalOverall = 0; // Variabel untuk menghitung total keseluruhan
                @endphp

                <ul class="container mx-auto divide-y divide-gray-400 divide-dotted" style="font-family: Raleway">
                    @foreach ($barangJadi as $row)
                        @php
                            $currentDate = \Carbon\Carbon::parse($row->tanggal_kirim)->translatedFormat('l, d F Y');
                            $totalHarga = intval($row->harga) * $row->jumlah_jadi;
                            $totalOverall += $totalHarga; // Menambahkan total harga per baris ke total keseluruhan
                        @endphp

                        @if ($prevDate !== $currentDate)
                            <li class="w-full flex items-center px-4 py-2">
                                <div class="mr-5 text-right w-3/1">
                                    <div
                                        class="text-xs font-semibold inline-block font-mono whitespace-nowrap px-2 py-1 rounded text-white bg-pink-500 rounded-2">
                                        {{ $currentDate }}
                                    </div>
                                </div>
                                <div class="w-full">
                                    <table class="table-auto w-full">
                                        <thead>
                                            <tr class="bg-blue-800 text-white">
                                                <th class="px-1">No.</th>
                                                <th class="px-1">Model</th>
                                                <th class="px-1">Warna</th>
                                                <th class="px-1">Jumlah Barang</th>
                                                <th class="px-1">Harga</th>
                                                <th class="px-1">Total Harga</th>
                                                <th class="px-1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-dotted divide-purple-500">
                        @endif

                        <tr>
                            <td class="px-1 text-xs py-2 text-purple-700">{{ $index++ }}.</td>
                            <td class="px-1 text-xs py-2 text-purple-700">{{ $row->model->nama }}</td>
                            <td class="px-1 text-xs py-2">{{ $row->warna->nama }}</td>
                            <td class="px-1 text-xs py-2">{{ $row->jumlah_jadi }} /{{ $row->satuan }}</td>
                            <td class="px-1 text-xs py-2">{{ formatRupiah($row->harga) }} /{{ $row->satuan }}</td>
                            <td class="px-1 text-xs py-2">{{ formatRupiah($totalHarga) }}</td>
                            <td class="px-1 text-xs py-2">
                                <button type="button" data-id="{{ $row->id }}" data-hs-overlay="#edit-modal"
                                    class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg edit gap-x-2 hover:text-blue-800 disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400">Edit</button>
                                <form action="/barang/jadi/delete/{{ $row->id }}" method="post"
                                    class="inline-flex delete-form">
                                    @csrf
                                    <button type="button"
                                        class="inline-flex items-center text-sm font-semibold text-red-600 border border-transparent rounded-lg delete gap-x-2 hover:text-red-800 disabled:pointer-events-none disabled:opacity-50 dark:text-red-500 dark:hover:text-red-400">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @if (
                            $loop->last ||
                                \Carbon\Carbon::parse($barangJadi[$loop->index + 1]->tanggal_kirim)->translatedFormat('l, d F Y') !==
                                    $currentDate)
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-100 text-gray-700">
                                    <td colspan="5" class="px-1 py-2 text-xs font-semibold text-right">Total:</td>
                                    <td class="px-1 py-2 text-xs font-semibold">
                                        {{ formatRupiah($totalOverall) }}
                                    </td>
                                    <td class="px-1 py-2 text-xs"></td>
                                </tr>
                            </tfoot>
                            </table>
            </div>
            </li>
            @php
                $index = 1;
                $totalOverall = 0; // Reset total keseluruhan setelah menampilkan total untuk setiap tanggal
            @endphp
            @endif

            @php
                $prevDate = $currentDate;
            @endphp
            @endforeach
            </ul>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('input[name="date"]').on('change', function() {
            $(this).closest('form').submit();
        });
    });
    $(document).on('click', '.edit', function(e) {
        let post_id = $(this).data('id');
        $.ajax({
            url: `/barang/jadi/edit/${post_id}`,
            type: "GET",
            success: function(response) {
                console.log(response)
                $('#edit-modal').addClass('hs-overlay-open');
            }
        });
    });
</script>
