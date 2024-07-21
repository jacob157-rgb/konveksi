@extends('layouts.dashboard')

@section('content')


    <form class="max-w-sm flex">
        <div class="relative">
            <input type="date"
                class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                placeholder="Enter name" name="start_date" value="{{ request()->query('start_date') }}">
            <div
                class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-green-500 lucide lucide-calendar-search">
                    <path d="M21 12V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7.5" />
                    <path d="M16 2v4" />
                    <path d="M8 2v4" />
                    <path d="M3 10h18" />
                    <circle cx="18" cy="18" r="3" />
                    <path d="m22 22-1.5-1.5" />
                </svg>
            </div>
        </div>

        <span class="p-3 font-semibold text-sm">TO</span>

        <div class="relative">
            <input type="date"
                class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                placeholder="Enter " name="end_date" value="{{ request()->query('end_date') }}">
            <div
                class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-green-500 lucide lucide-calendar-search">
                    <path d="M21 12V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7.5" />
                    <path d="M16 2v4" />
                    <path d="M8 2v4" />
                    <path d="M3 10h18" />
                    <circle cx="18" cy="18" r="3" />
                    <path d="m22 22-1.5-1.5" />
                </svg>
            </div>
        </div>
        <button type="submit"
            class="py-3 px-4 ml-1 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 disabled:opacity-50 disabled:pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-filter">
                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
            </svg> Filter
        </button>
    </form>

    <div class="grid gap-3 sm:grid-cols-1 sm:gap-1 lg:grid-cols-3">
        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-3">
                    <p class="text-xs tracking-wide text-gray-500 uppercase dark:text-neutral-500">
                        @if (request()->query('start_date') && request()->query('end_date'))
                            Total keseluruhan dari tanggal <br>
                            <span
                                class="font-bold text-blue-800">{{ \Carbon\Carbon::parse(request()->query('start_date'))->locale('id')->isoFormat('D MMMM YYYY') }}
                                -
                                {{ \Carbon\Carbon::parse(request()->query('end_date'))->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                        @else
                            Total Semua Pengeluaran
                        @endif
                    </p>
                </div>
                <div class="flex items-center mt-1 gap-x-2">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-neutral-200 sm:text-2xl">
                        {{ formatRupiah($total_nominal) }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>


    <div class="flex flex-col">
        <div class="flex items-center justify-between pb-2 mb-2 border-b">
            @if ($pengeluaran->isNotEmpty())
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Daftar Pengeluaran</h2>
                <a href="/pengeluaran/create"
                    class="inline-flex items-center justify-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-plus">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    Tambahkan Pengeluaran
                </a>
            @else
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Daftar Pengeluaran</h2>
            @endif
        </div>
        <div class="-m-1.5 overflow-x-auto">
            <div class="inline-block min-w-full p-1.5 align-middle">
                <div class="overflow-hidden border rounded-lg dark:border-neutral-700">
                    @if ($pengeluaran->isEmpty())
                        <div class="mx-auto flex min-h-[400px] w-full max-w-sm flex-col justify-center px-6 py-4">
                            <div
                                class="size-[46px] flex items-center justify-center rounded-lg bg-gray-100 dark:bg-neutral-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="flex-shrink-0 text-gray-600 size-6 lucide lucide-hand-coins dark:text-neutral-400">
                                    <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                                    <path
                                        d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                                    <path d="m2 16 6 6" />
                                    <circle cx="16" cy="9" r="2.9" />
                                    <circle cx="6" cy="5" r="3" />
                                </svg>
                            </div>
                            <h2 class="mt-5 font-semibold text-gray-800 dark:text-white">
                                Belum ada Pengeluaran
                            </h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                Silahkan tambah Pengeluaran terlebih dahulu.
                            </p>
                            <div class="grid gap-2 mt-5 sm:flex">
                                <a href="/pengeluaran/create"
                                    class="inline-flex items-center justify-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Tambahkan Pengeluaran
                                </a>
                            </div>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        No.</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Nominal</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Keterangan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">
                                        Dibuat</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                                @foreach ($pengeluaran as $row)
                                    <tr>
                                        <td
                                            class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $loop->iteration }}.</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ formatRupiah($row->nominal) }}</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $row->keterangan }}</td>
                                        <td
                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ \Carbon\Carbon::parse($row->updated_at)->locale('id')->isoFormat('D MMMM YYYY - HH:mm:ss') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                            <div class="hs-dropdown relative m-1 inline-flex [--trigger:hover]">
                                                <button id="hs-dropdown-hover-event" type="button"
                                                    class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-500 border border-gray-200 rounded-lg shadow-sm hs-dropdown-toggle gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800">
                                                    Aksi
                                                    <svg class="size-4 hs-dropdown-open:rotate-180"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="m6 9 6 6 6-6" />
                                                    </svg>
                                                </button>

                                                <div class="hs-dropdown-menu duration min-w-60 z-10 mt-2 hidden rounded-lg bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] before:absolute before:-top-4 before:start-0 before:h-4 before:w-full after:absolute after:-bottom-4 after:start-0 after:h-4 after:w-full hs-dropdown-open:opacity-100 dark:divide-neutral-700 dark:border dark:border-neutral-700 dark:bg-neutral-800"
                                                    aria-labelledby="hs-dropdown-hover-event">
                                                    <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        href="/pengeluaran/edit/{{ $row->id }}">
                                                        Edit
                                                    </a>

                                                    <form action="/pengeluaran/delete/{{ $row->id }}"
                                                        method="post">
                                                        @csrf
                                                        <button
                                                            class="delete flex w-full items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                            type="submit">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
