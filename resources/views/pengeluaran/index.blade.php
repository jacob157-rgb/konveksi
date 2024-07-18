@extends('layouts.dashboard')

@section('content')
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
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ formatRupiah($row->nominal) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            {{ $row->keterangan }}</td>
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

                                                    <form action="/pengeluaran/delete/{{ $row->id }}" method="post">
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
