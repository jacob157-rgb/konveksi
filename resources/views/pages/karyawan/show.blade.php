@extends('layouts.dashboard')

@section('content')
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <table border="1" class="my-5">
            <tr>
                <td class="font-medium">Nama Karyawan</td>
                <td>&nbsp; : &nbsp;{{ $karyawan->nama }}</td>
            </tr>
            <tr>
                <td class="font-medium">Jenis Karyawan</td>
                <td>&nbsp; : &nbsp;{{ $karyawan->jenis_karyawan }}</td>
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
        <hr>


        @php
            $gaji = App\Models\Gaji::getGaji($karyawan->id);
        @endphp
        <div class="flex flex-col mt-2">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="border divide-y divide-gray-200 rounded-lg dark:border-neutral-700 dark:divide-neutral-700">
                        <div class="flex items-center justify-between px-5 py-3">
                            <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Tabel Gaji</h2>
                            <div class="space-y-2">
                                <form action="" id="lunasForm">
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5 mt-1">
                                            <input id="checkbox-lunas" name="lunas" value="{{ request()->query('lunas') == 'true' ? 'false' : 'true' }}" type="checkbox"
                                                class="text-blue-600 border-gray-200 rounded lunas dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                                                aria-describedby="checkbox-lunas-description" {{ request()->query('lunas') ? 'checked' : '' }}>
                                        </div>
                                        <label for="checkbox-lunas" class="ms-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">Tampilkan
                                                Lunas?</span>
                                            <span id="checkbox-lunas-description"
                                                class="block text-sm text-gray-600 dark:text-neutral-500">Centang untuk
                                                menampilkan yang sudah lunas.</span>
                                        </label>
                                    </div>
                                </form>
                                <form class="relative w-full" id="dateForm" method="GET" action="">
                                    <label class="sr-only">Search</label>
                                    <input type="text" id="datepicker" name="days"
                                        value="{{ request()?->query('days') }}"
                                        class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm date dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 ps-9 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                                        placeholder="Pilih Tanggal">
                                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                        <svg class="text-gray-400 size-4 dark:text-neutral-500"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-calendar-days">
                                            <path d="M8 2v4" />
                                            <path d="M16 2v4" />
                                            <rect width="18" height="18" x="3" y="4" rx="2" />
                                            <path d="M3 10h18" />
                                            <path d="M8 14h.01" />
                                            <path d="M12 14h.01" />
                                            <path d="M16 14h.01" />
                                            <path d="M8 18h.01" />
                                            <path d="M12 18h.01" />
                                            <path d="M16 18h.01" />
                                        </svg>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="dark:bg-neutral-700 bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                            No.</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                            Tanggal</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                            Nominal</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                            Nominal Terbayarkan</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-start">
                                            Nominal Belum Terbayarkan</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase dark:text-neutral-500">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase dark:text-neutral-500">
                                            Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $nominal = 0;
                                    $nominal_terbayarkan = 0;
                                    $nominal_belum_terbayarkan = 0;
                                @endphp
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($gaji['listData'] as $row)
                                        @php
                                            $nominal += $row->nominal;
                                            $nominal_terbayarkan += $row->nominal_terbayarkan;
                                            $nominal_belum_terbayarkan += $row->nominal_belum_terbayarkan;
                                        @endphp
                                        <tr>
                                            <td
                                                class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                                {{ formatRupiah($row->nominal) }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                                {{ formatRupiah($row->nominal_terbayarkan) }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                                {{ formatRupiah($row->nominal_belum_terbayarkan) }}</td>
                                            <td
                                                class="px-6 py-4 text-sm text-center text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                                <span
                                                    class="{{ $row?->status === 'lunas' ? 'bg-green-500' : ($row?->status === 'belum terbayarkan' ? 'bg-red-500 ' : 'bg-yellow-500 ') }} hs-tooltip-toggle text-nowrap inline-flex items-center gap-x-1.5 rounded-full px-3 py-1.5 text-xs font-medium text-white">
                                                    {{ $row?->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                                <button type="button" data-id="{{ $row->id }}"
                                                    data-ongkos="{{ formatNominal($row->nominal_belum_terbayarkan) }}"
                                                    class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg bayarBtn dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400 gap-x-2 hover:text-blue-800 focus:text-blue-800 focus:outline-none disabled:pointer-events-none disabled:opacity-50">Bayar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"
                                            class="px-6 py-4 text-sm font-medium text-center text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                            <strong>TOTAL : </strong>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                            {{ formatRupiah($nominal) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                            {{ formatRupiah($nominal_terbayarkan) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                            {{ formatRupiah($nominal_belum_terbayarkan) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 whitespace-nowrap">
                                            {{-- <span
                                                class="{{ $row?->status === 'lunas' ? 'bg-green-500' : ($row?->status === 'belum terbayarkan' ? 'bg-red-500 ' : 'bg-yellow-500 ') }} hs-tooltip-toggle text-nowrap inline-flex items-center gap-x-1.5 rounded-full px-3 py-1.5 text-xs font-medium text-white">
                                                {{ $row?->status }}
                                            </span> --}}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                            <button type="button"
                                                class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">Bayar
                                                Semua</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.kembali_modal')
    <script>
        $(function() {
            $("#datepicker").datepicker({
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [day === 6, ""];
                },
                dateFormat: 'yy-mm-dd',
                onSelect: function(dateText, inst) {
                    $('#dateForm').submit();
                }
            });
        });
        $(document).ready(function() {

            $('.lunas').on('change', function() {
                $('#lunasForm').submit();
            });
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });

            $(document).on('click', '.bayarBtn', function(e) {
                e.preventDefault();
                let post_id = $(this).data('id');
                let dataOngkos = $(this).data('ongkos');

                postUrl = `/karyawan/cutting/gaji/status`;
                modalTitle = 'Bayar Sisa Gaji';
                modalContent = `
        <label for="nominal_bayar_gaji" class="block mb-2 text-sm font-medium dark:text-white">Nominal Bayar</label>
        <div class="flex space-x-2">
            <div class="relative w-9/12 rounded-md">
                <input type="text" name="nominal_bayar_gaji" id="nominal_bayar_gaji"
                    class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg shadow-sm nominal price dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 pe-16 ps-10 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50">
                <input type="hidden" id="nominal">
                <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                    <span class="text-gray-500 dark:text-neutral-500">Rp.</span>
                </div>
                <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-0 pe-4">
                    <span class="text-gray-500 dark:text-neutral-500">IDR</span>
                </div>
            </div>
            <label for="hs-checkbox-in-form-bayar-in" class="flex w-3/12 p-3 text-sm bg-white border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <input id="hs-checkbox-in-form-bayar-in" name="allbayar" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Semua?</span>
            </label>
        </div>`;

                $('#modal-title').text(modalTitle);
                $('#modal-form').attr('action', postUrl);
                $('#modal-content').html(modalContent);
                $('#post_id').val(post_id);

                // Open the modal after setting the content
                HSOverlay.open('#kembali-modal');

                // Attach event handler after modal content is rendered
                $(document).on('change', '#hs-checkbox-in-form-bayar-in', function() {
                    if ($(this).is(':checked')) {
                        $('#nominal_bayar_gaji').val(dataOngkos);
                    } else {
                        $('#nominal_bayar_gaji').val('');
                    }
                });
            });

            $(document).on('submit', '#modal-form', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success && Array.isArray(response.success)) {
                            response.success.forEach(function(message, index) {
                                setTimeout(function() {
                                    Toast.fire({
                                        icon: "success",
                                        title: message
                                    });
                                }, index * 2000);
                            });

                            setTimeout(function() {
                                    location
                                        .reload();
                                }, response.success.length *
                                2000);
                        } else {
                            Toast.fire({
                                icon: "success",
                                title: "Berhasil Menyimpan data"
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }

                        HSOverlay.close('#kembali-modal');
                    },
                    error: function(xhr) {
                        let errorMessage = "Gagal Menyimpan data";

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors).map(function(
                                value) {
                                return value.join(', ');
                            }).join('<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Toast.fire({
                            icon: "error",
                            title: errorMessage
                        });
                    }
                });
            });
        });
    </script>
@endsection
