<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
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
        <nav class="mx-auto flex w-full basis-full items-center px-4 sm:px-6" aria-label="Global">
            <div class="me-5 lg:me-0 lg:hidden">
                <!-- Logo -->
                <a class="inline-block flex-none rounded-xl text-xl font-semibold focus:opacity-80 focus:outline-none"
                    href="../templates/admin/index.html" aria-label="Preline">
                    <svg class="h-auto w-28" width="116" height="32" viewBox="0 0 116 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M33.5696 30.8182V11.3182H37.4474V13.7003H37.6229C37.7952 13.3187 38.0445 12.9309 38.3707 12.5369C38.7031 12.1368 39.134 11.8045 39.6634 11.5398C40.1989 11.2689 40.8636 11.1335 41.6577 11.1335C42.6918 11.1335 43.6458 11.4044 44.5199 11.946C45.3939 12.4815 46.0926 13.291 46.6158 14.3743C47.139 15.4515 47.4006 16.8026 47.4006 18.4276C47.4006 20.0095 47.1451 21.3452 46.6342 22.4347C46.1295 23.518 45.4401 24.3397 44.5661 24.8999C43.6982 25.4538 42.7256 25.7308 41.6484 25.7308C40.8852 25.7308 40.2358 25.6046 39.7003 25.3523C39.1709 25.0999 38.737 24.7829 38.3984 24.4013C38.0599 24.0135 37.8014 23.6226 37.6229 23.2287H37.5028V30.8182H33.5696ZM37.4197 18.4091C37.4197 19.2524 37.5367 19.9879 37.7706 20.6158C38.0045 21.2436 38.343 21.733 38.7862 22.0838C39.2294 22.4285 39.768 22.6009 40.402 22.6009C41.0421 22.6009 41.5838 22.4254 42.027 22.0746C42.4702 21.7176 42.8056 21.2251 43.0334 20.5973C43.2673 19.9633 43.3842 19.2339 43.3842 18.4091C43.3842 17.5904 43.2704 16.8703 43.0426 16.2486C42.8149 15.6269 42.4794 15.1406 42.0362 14.7898C41.593 14.4389 41.0483 14.2635 40.402 14.2635C39.7618 14.2635 39.2202 14.4328 38.777 14.7713C38.34 15.1098 38.0045 15.59 37.7706 16.2116C37.5367 16.8333 37.4197 17.5658 37.4197 18.4091ZM49.2427 25.5V11.3182H53.0559V13.7926H53.2037C53.4622 12.9124 53.8961 12.2476 54.5055 11.7983C55.1149 11.3428 55.8166 11.1151 56.6106 11.1151C56.8076 11.1151 57.02 11.1274 57.2477 11.152C57.4754 11.1766 57.6755 11.2105 57.8478 11.2536V14.7436C57.6632 14.6882 57.4077 14.639 57.0815 14.5959C56.7553 14.5528 56.4567 14.5312 56.1859 14.5312C55.6073 14.5312 55.0903 14.6574 54.6348 14.9098C54.1854 15.156 53.8284 15.5007 53.5638 15.9439C53.3052 16.3871 53.176 16.898 53.176 17.4766V25.5H49.2427ZM64.9043 25.777C63.4455 25.777 62.1898 25.4815 61.1373 24.8906C60.0909 24.2936 59.2845 23.4503 58.7182 22.3608C58.1519 21.2652 57.8688 19.9695 57.8688 18.4737C57.8688 17.0149 58.1519 15.7346 58.7182 14.6328C59.2845 13.531 60.0816 12.6723 61.1096 12.0568C62.1437 11.4413 63.3563 11.1335 64.7474 11.1335C65.683 11.1335 66.5539 11.2843 67.3603 11.5859C68.1728 11.8814 68.8806 12.3277 69.4839 12.9247C70.0932 13.5218 70.5672 14.2727 70.9057 15.1776C71.2443 16.0762 71.4135 17.1288 71.4135 18.3352V19.4155H59.4384V16.978H67.7111C67.7111 16.4117 67.588 15.91 67.3418 15.473C67.0956 15.036 66.754 14.6944 66.317 14.4482C65.8861 14.1958 65.3844 14.0696 64.812 14.0696C64.2149 14.0696 63.6856 14.2081 63.2239 14.4851C62.7684 14.7559 62.4114 15.1222 62.1529 15.5838C61.8944 16.0393 61.762 16.5471 61.7559 17.1072V19.4247C61.7559 20.1264 61.8851 20.7327 62.1437 21.2436C62.4083 21.7545 62.7807 22.1484 63.2608 22.4254C63.741 22.7024 64.3103 22.8409 64.9689 22.8409C65.406 22.8409 65.8061 22.7794 66.1692 22.6562C66.5324 22.5331 66.8432 22.3485 67.1018 22.1023C67.3603 21.8561 67.5572 21.5545 67.6927 21.1974L71.3304 21.4375C71.1458 22.3116 70.7672 23.0748 70.1948 23.7273C69.6285 24.3736 68.896 24.8783 67.9974 25.2415C67.1048 25.5985 66.0738 25.777 64.9043 25.777ZM77.1335 6.59091V25.5H73.2003V6.59091H77.1335ZM79.5043 25.5V11.3182H83.4375V25.5H79.5043ZM81.4801 9.49006C80.8954 9.49006 80.3937 9.29616 79.9752 8.90838C79.5628 8.51444 79.3566 8.04356 79.3566 7.49574C79.3566 6.95407 79.5628 6.48935 79.9752 6.10156C80.3937 5.70762 80.8954 5.51065 81.4801 5.51065C82.0649 5.51065 82.5635 5.70762 82.9759 6.10156C83.3944 6.48935 83.6037 6.95407 83.6037 7.49574C83.6037 8.04356 83.3944 8.51444 82.9759 8.90838C82.5635 9.29616 82.0649 9.49006 81.4801 9.49006ZM89.7415 17.3011V25.5H85.8083V11.3182H89.5569V13.8203H89.723C90.037 12.9955 90.5632 12.343 91.3019 11.8629C92.0405 11.3767 92.9361 11.1335 93.9887 11.1335C94.9735 11.1335 95.8322 11.349 96.5647 11.7798C97.2971 12.2107 97.8665 12.8262 98.2728 13.6264C98.679 14.4205 98.8821 15.3684 98.8821 16.4702V25.5H94.9489V17.1719C94.9551 16.304 94.7335 15.6269 94.2841 15.1406C93.8348 14.6482 93.2162 14.402 92.4283 14.402C91.8989 14.402 91.4311 14.5159 91.0249 14.7436C90.6248 14.9714 90.3109 15.3037 90.0831 15.7408C89.8615 16.1716 89.7477 16.6918 89.7415 17.3011ZM107.665 25.777C106.206 25.777 104.951 25.4815 103.898 24.8906C102.852 24.2936 102.045 23.4503 101.479 22.3608C100.913 21.2652 100.63 19.9695 100.63 18.4737C100.63 17.0149 100.913 15.7346 101.479 14.6328C102.045 13.531 102.842 12.6723 103.87 12.0568C104.905 11.4413 106.117 11.1335 107.508 11.1335C108.444 11.1335 109.315 11.2843 110.121 11.5859C110.934 11.8814 111.641 12.3277 112.245 12.9247C112.854 13.5218 113.328 14.2727 113.667 15.1776C114.005 16.0762 114.174 17.1288 114.174 18.3352V19.4155H102.199V16.978H110.472C110.472 16.4117 110.349 15.91 110.103 15.473C109.856 15.036 109.515 14.6944 109.078 14.4482C108.647 14.1958 108.145 14.0696 107.573 14.0696C106.976 14.0696 106.446 14.2081 105.985 14.4851C105.529 14.7559 105.172 15.1222 104.914 15.5838C104.655 16.0393 104.523 16.5471 104.517 17.1072V19.4247C104.517 20.1264 104.646 20.7327 104.905 21.2436C105.169 21.7545 105.542 22.1484 106.022 22.4254C106.502 22.7024 107.071 22.8409 107.73 22.8409C108.167 22.8409 108.567 22.7794 108.93 22.6562C109.293 22.5331 109.604 22.3485 109.863 22.1023C110.121 21.8561 110.318 21.5545 110.454 21.1974L114.091 21.4375C113.907 22.3116 113.528 23.0748 112.956 23.7273C112.389 24.3736 111.657 24.8783 110.758 25.2415C109.866 25.5985 108.835 25.777 107.665 25.777Z"
                            class="fill-blue-600 dark:fill-white" fill="currentColor" />
                        <path
                            d="M1 29.5V16.5C1 9.87258 6.37258 4.5 13 4.5C19.6274 4.5 25 9.87258 25 16.5C25 23.1274 19.6274 28.5 13 28.5H12"
                            class="stroke-blue-600 dark:stroke-white" stroke="currentColor" stroke-width="2" />
                        <path
                            d="M5 29.5V16.66C5 12.1534 8.58172 8.5 13 8.5C17.4183 8.5 21 12.1534 21 16.66C21 21.1666 17.4183 24.82 13 24.82H12"
                            class="stroke-blue-600 dark:stroke-white" stroke="currentColor" stroke-width="2" />
                        <circle cx="13" cy="16.5214" r="5" class="fill-blue-600 dark:fill-white"
                            fill="currentColor" />
                    </svg>
                </a>
                <!-- End Logo -->
            </div>

            <div class="ms-auto flex w-full items-center justify-end sm:order-3 sm:justify-between sm:gap-x-3">
                <div class="sm:hidden">
                    <button type="button"
                        class="inline-flex h-[2.375rem] w-[2.375rem] items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700">
                        <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                    </button>
                </div>

                <div class="hidden sm:block">
                    <label for="icon" class="sr-only">Search</label>
                    <div class="min-w-72 md:min-w-80 relative">
                        <div class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-4">
                            <svg class="size-4 flex-shrink-0 text-gray-400 dark:text-neutral-400"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </div>
                        <input type="text" id="icon" name="icon"
                            class="block w-full rounded-lg border-gray-200 px-4 py-2 ps-11 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Search">
                    </div>
                </div>

                <div class="flex flex-row items-center justify-end gap-2">
                    <button type="button"
                        class="inline-flex h-[2.375rem] w-[2.375rem] items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700">
                        <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                        </svg>
                    </button>
                    <div class="hs-dropdown">
                        <button type="button"
                            class="hs-dropdown-toggle hs-dark-mode group me-2 flex items-center font-medium text-gray-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-neutral-500">
                            <svg class="size-4 block hs-dark-mode-active:hidden" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                            </svg>
                            <svg class="size-4 hidden hs-dark-mode-active:block" xmlns="http://www.w3.org/2000/svg"
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
                    {{-- <button type="button"
                        class="inline-flex h-[2.375rem] w-[2.375rem] items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700"
                        data-hs-offcanvas="#hs-offcanvas-right">

                    </button> --}}

                    <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                        <button id="hs-dropdown-with-header" type="button"
                            class="inline-flex h-[2.375rem] w-[2.375rem] items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700">
                            <img class="size-[38px] inline-block rounded-full ring-2 ring-white dark:ring-neutral-800"
                                src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                alt="Image Description">
                        </button>

                        <div class="hs-dropdown-menu duration min-w-60 hidden rounded-lg bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 dark:border dark:border-neutral-700 dark:bg-neutral-900"
                            aria-labelledby="hs-dropdown-with-header">
                            <div class="-m-2 rounded-t-lg bg-gray-100 px-5 py-3 dark:bg-neutral-800">
                                <p class="text-sm text-gray-500 dark:text-neutral-400">Masuk sebagai</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-neutral-300">
                                    {{ auth()->user()->nama }}</p>
                            </div>
                            <div class="mt-2 py-2 first:pt-0 last:pb-0">
                                <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                    href="#">
                                    <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
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
                                    <svg class="size-4 flex-shrink-0" width="24" height="24"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    Pengaturan Profil
                                </a>
                                <form method="get" action="/logout">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300">
                                        <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
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
        class="sticky inset-x-0 top-0 z-20 border-y bg-white px-4 dark:border-neutral-700 dark:bg-neutral-800 sm:px-6 md:px-8 lg:hidden">
        <div class="flex items-center justify-between py-2">
            <!-- Breadcrumb -->
            <ol class="ms-3 flex items-center whitespace-nowrap">
                <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400">
                    Application Layout
                    <svg class="size-2.5 mx-3 flex-shrink-0 overflow-visible text-gray-400 dark:text-neutral-500"
                        width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </li>
                <li class="truncate text-sm font-semibold text-gray-800 dark:text-neutral-400" aria-current="page">
                    Dashboard
                </li>
            </ol>
            <!-- End Breadcrumb -->

            <!-- Sidebar -->
            <button type="button"
                class="flex items-center justify-center gap-x-1.5 rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-500 hover:text-gray-600 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200"
                data-hs-overlay="#application-sidebar" aria-controls="application-sidebar" aria-label="Sidebar">
                <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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
                class="inline-block flex-none rounded-xl text-xl font-semibold focus:opacity-80 focus:outline-none"
                href="../templates/admin/index.html" aria-label="Preline">
                <svg class="h-auto w-28" width="116" height="32" viewBox="0 0 116 32" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M33.5696 30.8182V11.3182H37.4474V13.7003H37.6229C37.7952 13.3187 38.0445 12.9309 38.3707 12.5369C38.7031 12.1368 39.134 11.8045 39.6634 11.5398C40.1989 11.2689 40.8636 11.1335 41.6577 11.1335C42.6918 11.1335 43.6458 11.4044 44.5199 11.946C45.3939 12.4815 46.0926 13.291 46.6158 14.3743C47.139 15.4515 47.4006 16.8026 47.4006 18.4276C47.4006 20.0095 47.1451 21.3452 46.6342 22.4347C46.1295 23.518 45.4401 24.3397 44.5661 24.8999C43.6982 25.4538 42.7256 25.7308 41.6484 25.7308C40.8852 25.7308 40.2358 25.6046 39.7003 25.3523C39.1709 25.0999 38.737 24.7829 38.3984 24.4013C38.0599 24.0135 37.8014 23.6226 37.6229 23.2287H37.5028V30.8182H33.5696ZM37.4197 18.4091C37.4197 19.2524 37.5367 19.9879 37.7706 20.6158C38.0045 21.2436 38.343 21.733 38.7862 22.0838C39.2294 22.4285 39.768 22.6009 40.402 22.6009C41.0421 22.6009 41.5838 22.4254 42.027 22.0746C42.4702 21.7176 42.8056 21.2251 43.0334 20.5973C43.2673 19.9633 43.3842 19.2339 43.3842 18.4091C43.3842 17.5904 43.2704 16.8703 43.0426 16.2486C42.8149 15.6269 42.4794 15.1406 42.0362 14.7898C41.593 14.4389 41.0483 14.2635 40.402 14.2635C39.7618 14.2635 39.2202 14.4328 38.777 14.7713C38.34 15.1098 38.0045 15.59 37.7706 16.2116C37.5367 16.8333 37.4197 17.5658 37.4197 18.4091ZM49.2427 25.5V11.3182H53.0559V13.7926H53.2037C53.4622 12.9124 53.8961 12.2476 54.5055 11.7983C55.1149 11.3428 55.8166 11.1151 56.6106 11.1151C56.8076 11.1151 57.02 11.1274 57.2477 11.152C57.4754 11.1766 57.6755 11.2105 57.8478 11.2536V14.7436C57.6632 14.6882 57.4077 14.639 57.0815 14.5959C56.7553 14.5528 56.4567 14.5312 56.1859 14.5312C55.6073 14.5312 55.0903 14.6574 54.6348 14.9098C54.1854 15.156 53.8284 15.5007 53.5638 15.9439C53.3052 16.3871 53.176 16.898 53.176 17.4766V25.5H49.2427ZM64.9043 25.777C63.4455 25.777 62.1898 25.4815 61.1373 24.8906C60.0909 24.2936 59.2845 23.4503 58.7182 22.3608C58.1519 21.2652 57.8688 19.9695 57.8688 18.4737C57.8688 17.0149 58.1519 15.7346 58.7182 14.6328C59.2845 13.531 60.0816 12.6723 61.1096 12.0568C62.1437 11.4413 63.3563 11.1335 64.7474 11.1335C65.683 11.1335 66.5539 11.2843 67.3603 11.5859C68.1728 11.8814 68.8806 12.3277 69.4839 12.9247C70.0932 13.5218 70.5672 14.2727 70.9057 15.1776C71.2443 16.0762 71.4135 17.1288 71.4135 18.3352V19.4155H59.4384V16.978H67.7111C67.7111 16.4117 67.588 15.91 67.3418 15.473C67.0956 15.036 66.754 14.6944 66.317 14.4482C65.8861 14.1958 65.3844 14.0696 64.812 14.0696C64.2149 14.0696 63.6856 14.2081 63.2239 14.4851C62.7684 14.7559 62.4114 15.1222 62.1529 15.5838C61.8944 16.0393 61.762 16.5471 61.7559 17.1072V19.4247C61.7559 20.1264 61.8851 20.7327 62.1437 21.2436C62.4083 21.7545 62.7807 22.1484 63.2608 22.4254C63.741 22.7024 64.3103 22.8409 64.9689 22.8409C65.406 22.8409 65.8061 22.7794 66.1692 22.6562C66.5324 22.5331 66.8432 22.3485 67.1018 22.1023C67.3603 21.8561 67.5572 21.5545 67.6927 21.1974L71.3304 21.4375C71.1458 22.3116 70.7672 23.0748 70.1948 23.7273C69.6285 24.3736 68.896 24.8783 67.9974 25.2415C67.1048 25.5985 66.0738 25.777 64.9043 25.777ZM77.1335 6.59091V25.5H73.2003V6.59091H77.1335ZM79.5043 25.5V11.3182H83.4375V25.5H79.5043ZM81.4801 9.49006C80.8954 9.49006 80.3937 9.29616 79.9752 8.90838C79.5628 8.51444 79.3566 8.04356 79.3566 7.49574C79.3566 6.95407 79.5628 6.48935 79.9752 6.10156C80.3937 5.70762 80.8954 5.51065 81.4801 5.51065C82.0649 5.51065 82.5635 5.70762 82.9759 6.10156C83.3944 6.48935 83.6037 6.95407 83.6037 7.49574C83.6037 8.04356 83.3944 8.51444 82.9759 8.90838C82.5635 9.29616 82.0649 9.49006 81.4801 9.49006ZM89.7415 17.3011V25.5H85.8083V11.3182H89.5569V13.8203H89.723C90.037 12.9955 90.5632 12.343 91.3019 11.8629C92.0405 11.3767 92.9361 11.1335 93.9887 11.1335C94.9735 11.1335 95.8322 11.349 96.5647 11.7798C97.2971 12.2107 97.8665 12.8262 98.2728 13.6264C98.679 14.4205 98.8821 15.3684 98.8821 16.4702V25.5H94.9489V17.1719C94.9551 16.304 94.7335 15.6269 94.2841 15.1406C93.8348 14.6482 93.2162 14.402 92.4283 14.402C91.8989 14.402 91.4311 14.5159 91.0249 14.7436C90.6248 14.9714 90.3109 15.3037 90.0831 15.7408C89.8615 16.1716 89.7477 16.6918 89.7415 17.3011ZM107.665 25.777C106.206 25.777 104.951 25.4815 103.898 24.8906C102.852 24.2936 102.045 23.4503 101.479 22.3608C100.913 21.2652 100.63 19.9695 100.63 18.4737C100.63 17.0149 100.913 15.7346 101.479 14.6328C102.045 13.531 102.842 12.6723 103.87 12.0568C104.905 11.4413 106.117 11.1335 107.508 11.1335C108.444 11.1335 109.315 11.2843 110.121 11.5859C110.934 11.8814 111.641 12.3277 112.245 12.9247C112.854 13.5218 113.328 14.2727 113.667 15.1776C114.005 16.0762 114.174 17.1288 114.174 18.3352V19.4155H102.199V16.978H110.472C110.472 16.4117 110.349 15.91 110.103 15.473C109.856 15.036 109.515 14.6944 109.078 14.4482C108.647 14.1958 108.145 14.0696 107.573 14.0696C106.976 14.0696 106.446 14.2081 105.985 14.4851C105.529 14.7559 105.172 15.1222 104.914 15.5838C104.655 16.0393 104.523 16.5471 104.517 17.1072V19.4247C104.517 20.1264 104.646 20.7327 104.905 21.2436C105.169 21.7545 105.542 22.1484 106.022 22.4254C106.502 22.7024 107.071 22.8409 107.73 22.8409C108.167 22.8409 108.567 22.7794 108.93 22.6562C109.293 22.5331 109.604 22.3485 109.863 22.1023C110.121 21.8561 110.318 21.5545 110.454 21.1974L114.091 21.4375C113.907 22.3116 113.528 23.0748 112.956 23.7273C112.389 24.3736 111.657 24.8783 110.758 25.2415C109.866 25.5985 108.835 25.777 107.665 25.777Z"
                        class="fill-blue-600 dark:fill-white" fill="currentColor" />
                    <path
                        d="M1 29.5V16.5C1 9.87258 6.37258 4.5 13 4.5C19.6274 4.5 25 9.87258 25 16.5C25 23.1274 19.6274 28.5 13 28.5H12"
                        class="stroke-blue-600 dark:stroke-white" stroke="currentColor" stroke-width="2" />
                    <path
                        d="M5 29.5V16.66C5 12.1534 8.58172 8.5 13 8.5C17.4183 8.5 21 12.1534 21 16.66C21 21.1666 17.4183 24.82 13 24.82H12"
                        class="stroke-blue-600 dark:stroke-white" stroke="currentColor" stroke-width="2" />
                    <circle cx="13" cy="16.5214" r="5" class="fill-blue-600 dark:fill-white"
                        fill="currentColor" />
                </svg>
            </a>
            <!-- End Logo -->
        </div>

        <nav class="hs-accordion-group flex w-full flex-col flex-wrap p-6" data-hs-accordion-always-open>
            <ul class="space-y-1.5">
                <li>
                    <a class="{{ request()->is('/home') ? 'flex items-center gap-x-3.5 rounded-lg bg-gray-100 px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:bg-neutral-700 dark:text-white' : 'flex items-center gap-x-3.5 rounded-lg  px-2.5 py-2 text-sm text-neutral-700 hover:bg-gray-100 dark:text-neutral-400' }}"
                        href="/home">
                        <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
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
                        <svg class="size-4 flex-shrink-0" width="24" height="24"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                        Produk
                        <svg class="size-4 ms-auto hidden hs-accordion-active:block"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>

                        <svg class="size-4 ms-auto block hs-accordion-active:hidden"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div id="projects-accordion-child"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                        <ul class="ps-2 pt-2">
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
                        <svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Karyawan

                        <svg class="size-4 ms-auto hidden hs-accordion-active:block"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>

                        <svg class="size-4 ms-auto block hs-accordion-active:hidden"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div id="users-accordion-child"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                        <ul class="hs-accordion-group ps-3 pt-2" data-hs-accordion-always-open>
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
            </ul>
        </nav>
    </div>
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="space-y-4 p-4 sm:space-y-6 sm:p-6">
            @yield('content')
        </div>
    </div>
    <!-- End Content -->
    <!-- ========== END MAIN CONTENT ========== -->
</body>

</html>