@extends('layouts.dashboard')

@section('content')
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="p-4 bg-white shadow rounded-xl dark:bg-neutral-900 sm:p-7">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-neutral-200 md:text-3xl">Perbarui Profil
                            </h2>
                        </div>
                        <form id="updateProfilForm" action="/profil" method="POST">
                            @csrf
                            <div
                                class="py-6 border-t border-gray-200 first:border-transparent first:pt-0 last:pb-0 dark:border-neutral-700 dark:first:border-transparent">
                                <div class="mt-2 space-y-3">
                                    <p>Nama</p>
                                    <input name="nama" type="text" value="{{ Auth::user()->nama }}"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan nama" required>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Username</p>
                                    <input name="username" type="text" value="{{ Auth::user()->username }}"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan username" required>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Password Lama</p>
                                    <input name="password_old" type="password"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan password lama" required>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Password Baru</p>
                                    <input id="password" name="password" type="password"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukan password baru" required>
                                </div>
                                <div class="mt-2 space-y-3">
                                    <p>Ulangi Password Baru</p>
                                    <input name="password_confirmation" id='password_confirmation' type="password"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Ulangi password baru" required>
                                </div>
                            </div>
                            <div class="flex justify-end mt-2 gap-x-2">
                                <button type="button" id="submitBtn"
                                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            const passwordNew = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password_confirmation').value;
            var form = document.getElementById('updateProfilForm');

            if (passwordNew !== passwordConfirm) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password baru dan ulangi password baru tidak cocok!',
                });
            } else {
                form.submit();
            }
        });
    </script>
@endsection
