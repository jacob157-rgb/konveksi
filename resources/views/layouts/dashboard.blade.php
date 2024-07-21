<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Open Graph  -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://okinaracollection.com/">
    <meta property="og:title" content="Okinara Collection">
    <meta property="og:description" content="Okinara Collection Tembok Luwung">
    <meta property="og:image" itemprop="image" content="{{ asset('assets/logo-light.png') }}">
    <title>Okinara Collection</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    {{-- End Font --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Swal2 --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- Datatables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> --}}
    <script>
        document.getElementById("theme-toggle").addEventListener("click", function() {
            const html = document.querySelector("html");
            const currentTheme = localStorage.getItem("hs_theme") || "auto";
            let newTheme;

            if (currentTheme === "light") {
                newTheme = "dark";
            } else if (currentTheme === "dark") {
                newTheme = "light";
            } else {
                newTheme = html.classList.contains("dark") ? "light" : "dark";
            }

            localStorage.setItem("hs_theme", newTheme);
            if (newTheme === "light") {
                html.classList.remove("dark");
                html.classList.add("light");
            } else {
                html.classList.remove("light");
                html.classList.add("dark");
            }
        });
    </script>
</head>

<body class="light dark:bg-black dark:text-white">
    <!-- ========== HEADER ========== -->
    <header
        class="sticky inset-x-0 top-0 z-[48] flex w-full flex-wrap border-b bg-white py-2.5 text-sm dark:border-neutral-700 dark:bg-neutral-800 sm:flex-nowrap sm:justify-start sm:py-4 lg:ps-64">
        <nav class="flex items-center w-full px-4 mx-auto basis-full sm:px-6" aria-label="Global">
            <div class="me-5 lg:me-0 lg:hidden">
                <!-- Logo -->
                <a class="flex-none inline-block text-xl font-semibold rounded-xl focus:opacity-80 focus:outline-none"
                    href="/">
                    <img class="h-auto w-28 dark:hidden" src="{{ asset('assets/logo-light.png') }}" alt="">
                    <img class="hidden h-auto w-28 dark:block" src="{{ asset('assets/logo-dark.png') }}" alt="">
                </a>
                <!-- End Logo -->
            </div>

            <div class="flex items-center justify-end w-full ms-auto sm:order-3 sm:justify-between sm:gap-x-3">
                <div class="sm:hidden">
                    <button type="button"
                        class="inline-flex h-[2.375rem] w-[2.375rem] items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                    </button>
                </div>

                <div class="hidden sm:block">
                    <label for="icon" class="sr-only">Search</label>
                    <form action="" method="get" class="relative border rounded-md min-w-72 md:min-w-80">
                        <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-0 ps-4">
                            <svg class="flex-shrink-0 text-gray-400 size-4 dark:text-neutral-400"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </div>
                        <input type="text" id="icon" value="{{ request()->query('query') }}" name="query"
                            class="block w-full px-4 py-2 text-sm border-gray-200 rounded-lg ps-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Search">
                    </form>
                </div>

                <div class="flex flex-row items-center justify-end gap-2">
                    <button type="button"
                        class="inline-flex h-[2.375rem] w-[2.375rem] items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                        </svg>
                    </button>
                    <div class="hs-dropdown">
                        <button type="button"
                            class="flex items-center font-medium text-gray-600 hs-dropdown-toggle hs-dark-mode group me-2 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-neutral-500">
                            <svg class="block size-4 hs-dark-mode-active:hidden" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                            </svg>
                            <svg class="hidden size-4 hs-dark-mode-active:block" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="4"></circle>
                                <path d="M12 2v2"></path>
                                <path d="M12 20v2"></path>
                                <path d="m4.93 4.93 1.41 1.41"></path>
                                <path d="m17.66 17.66 1.41 1.41"></path>
                                <path d="M2 12h2"></path>
                                <path d="M20 12h2"></path>
                                <path d="m6.34 17.66-1.41 1.41"></path>
                                <path d="m19.07 4.93-1.41 1.41"></path>
                            </svg>
                        </button>

                        <div id="selectThemeDropdown"
                            class="hs-dropdown-menu z-10 mb-2 mt-2 hidden origin-bottom-left space-y-1 rounded-lg bg-white p-2 opacity-0 shadow-md transition-[margin,opacity] duration-300 hs-dropdown-open:opacity-100 dark:divide-neutral-700 dark:border dark:border-neutral-700 dark:bg-neutral-800">
                            <button type="button"
                                class="flex w-full items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                data-hs-theme-click-value="default">
                                Default (Light)
                            </button>
                            <button type="button"
                                class="flex w-full items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                data-hs-theme-click-value="dark">
                                Dark
                            </button>
                            <button type="button"
                                class="flex w-full items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                data-hs-theme-click-value="auto">
                                Auto (System)
                            </button>
                        </div>
                    </div>

                    <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                        <button id="hs-dropdown-with-header" type="button"
                            class="inline-flex h-[2.375rem] w-[2.375rem] items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700">
                            <img class="size-[38px] inline-block rounded-full ring-2 ring-white dark:ring-neutral-800"
                                src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                alt="Image Description">
                        </button>

                        <div class="hs-dropdown-menu duration min-w-60 hidden rounded-lg bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 dark:border dark:border-neutral-700 dark:bg-neutral-900"
                            aria-labelledby="hs-dropdown-with-header">
                            <div class="px-5 py-3 -m-2 bg-gray-100 rounded-t-lg dark:bg-neutral-800">
                                <p class="text-sm text-gray-500 dark:text-neutral-400">Masuk sebagai</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-neutral-300">
                                    {{ auth()->user()->nama }}</p>
                            </div>
                            <div class="py-2 mt-2 first:pt-0 last:pb-0">
                                <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                    href="#">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                                    </svg>
                                    Pemberitahuan
                                </a>
                                <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                    href="#">
                                    {{-- href="{{ route('profile') }}"> --}}
                                    <svg class="flex-shrink-0 size-4" width="24" height="24"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    Pengaturan Profil
                                </a>
                                <form method="post" action="/logout">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <!-- Breadcrumb -->
    <div
        class="sticky inset-x-0 top-0 z-20 px-4 bg-white border-y dark:border-neutral-700 dark:bg-neutral-800 sm:px-6 md:px-8 lg:hidden">
        <div class="flex items-center justify-between py-2">
            <!-- Sidebar -->
            <button type="button"
                class="flex items-center justify-center gap-x-1.5 rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-500 hover:text-gray-600 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200"
                data-hs-overlay="#application-sidebar" aria-controls="application-sidebar" aria-label="Sidebar">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 8L21 12L17 16M3 12H13M3 6H13M3 18H13" />
                </svg>
                <span class="sr-only">Sidebar</span>
            </button>
            <!-- End Sidebar -->
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Sidebar -->
    <div id="application-sidebar"
        class="hs-overlay fixed inset-y-0 start-0 z-[60] hidden w-[260px] -translate-x-full transform border-e border-gray-200 bg-white transition-all duration-300 [--auto-close:lg] hs-overlay-open:translate-x-0 dark:border-neutral-700 dark:bg-neutral-800 lg:bottom-0 lg:end-auto lg:block lg:translate-x-0">
        <div class="px-8 pt-4">
            <!-- Logo -->
            <a href="/home"
                class="justify-center flex-none inline-block text-xl font-semibold rounded-xl focus:opacity-80 focus:outline-none"
                href="../templates/admin/index.html" aria-label="Preline">
                <img class="h-auto w-28 dark:hidden" src="{{ asset('assets/logo-light.png') }}" alt="">
                <img class="hidden h-auto w-28 dark:block" src="{{ asset('assets/logo-dark.png') }}" alt="">
            </a>
            <!-- End Logo -->
        </div>

        <nav class="flex flex-col flex-wrap w-full p-6 hs-accordion-group" data-hs-accordion-always-open>
            <ul class="space-y-1.5">
                <li>
                    <a class="{{ request()->is('/home') ? 'flex items-center gap-x-3.5 rounded-lg bg-gray-100 px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-700 dark:text-white' : 'flex items-center gap-x-3.5 rounded-lg  px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:text-neutral-400' }}"
                        href="/home">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Beranda
                    </a>
                </li>

                <li class="hs-accordion" id="projects-accordion">
                    <button type="button"
                        class="{{ request()->routeIs(['product.index', 'product.create', 'category.index']) ? 'hs-accordion-toggle bg-gray-100 dark:bg-neutral-700 text-blue-600 hover:bg-gray-100 dark:text-white flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm ' : 'hs-accordion-toggle hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent dark:hs-accordion-active:text-white flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300' }}">
                        <svg class="flex-shrink-0 size-4" width="24" height="24"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                        Produk
                        <svg class="hidden size-4 ms-auto hs-accordion-active:block"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>

                        <svg class="block size-4 ms-auto hs-accordion-active:hidden"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div id="projects-accordion-child"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                        <ul class="pt-2 ps-2">
                            <li>
                                <a class="{{ request()->routeIs('product.index') ? 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 bg-gray-100 hover:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:hover:text-neutral-300' : 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300' }}"
                                    href="/supplyer">
                                    Supplyer
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('category.*') ? 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 bg-gray-100 hover:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:hover:text-neutral-300' : 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300' }}"
                                    href="/kain">
                                    Kain
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('product.create') ? 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 bg-gray-100 hover:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:hover:text-neutral-300' : 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300' }}"
                                    href="/model">
                                    Model
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('product.index') ? 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 bg-gray-100 hover:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:hover:text-neutral-300' : 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300' }}"
                                    href="/warna">
                                    Warna
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('product.index') ? 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 bg-gray-100 hover:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:hover:text-neutral-300' : 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300' }}"
                                    href="/barang">
                                    Barang
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="hs-accordion" id="users-accordion">
                    <button type="button"
                        class="hs-accordion-toggle flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-neutral-700 hover:bg-gray-100 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent dark:bg-neutral-800 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:hs-accordion-active:text-white">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Karyawan

                        <svg class="hidden size-4 ms-auto hs-accordion-active:block"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>

                        <svg class="block size-4 ms-auto hs-accordion-active:hidden"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div id="users-accordion-child"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                        <ul class="pt-2 hs-accordion-group ps-3" data-hs-accordion-always-open>
                            <li>
                                <a class="{{ request()->routeIs('karyawan.index') ? 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 bg-gray-100 hover:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:hover:text-neutral-300' : 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300' }}"
                                    href="/karyawan">
                                    Karyawan
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('product.create') ? 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 bg-gray-100 hover:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:hover:text-neutral-300' : 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300' }}"
                                    href="/cutting">
                                    Cutting
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('product.index') ? 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 bg-gray-100 hover:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:hover:text-neutral-300' : 'flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300' }}"
                                    href="/jahit">
                                    Jahit
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="{{ request()->is('/pengeluaran') ? 'flex items-center gap-x-3.5 rounded-lg bg-gray-100 px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-700 dark:text-white' : 'flex items-center gap-x-3.5 rounded-lg  px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:text-neutral-400' }}"
                        href="/pengeluaran">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-candlestick-chart">
                            <path d="M9 5v4" />
                            <rect width="4" height="6" x="7" y="9" rx="1" />
                            <path d="M9 15v2" />
                            <path d="M17 3v2" />
                            <rect width="4" height="8" x="15" y="5" rx="1" />
                            <path d="M17 13v3" />
                            <path d="M3 3v18h18" />
                        </svg>
                        Pengeluaran
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-4 space-y-4 sm:space-y-6 sm:p-6">
            @yield('content')
        </div>
    </div>
    <!-- End Content -->
    <!-- ========== END MAIN CONTENT ========== -->
</body>

</html>
