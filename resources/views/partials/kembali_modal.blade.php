<div id="kembali-modal"
    class="hs-overlay size-full pointer-events-none fixed start-0 top-0 z-[80] hidden overflow-y-auto overflow-x-hidden"
    role="dialog" tabindex="-1">
    <div
        class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-animation-target hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:mx-auto sm:w-full sm:max-w-lg">
        <div
            class="flex flex-col bg-white border shadow-sm pointer-events-auto dark:border-neutral-700 dark:bg-neutral-800 dark:shadow-neutral-700/70 rounded-xl">
            <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                <h3 id="modal-title" class="font-bold text-gray-800 dark:text-white"></h3>
                <button type="button"
                    class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 dark:bg-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600 gap-x-2 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                    aria-label="Close" data-hs-overlay="#kembali-modal">
                    <span class="sr-only">Close</span>
                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="modal-form" action="" method="post">
                @csrf
                <input type="hidden" name="post_id" id="post_id">
                <div id="modal-content" class="p-4 space-y-2">

                </div>
                <div class="flex items-center justify-end px-4 py-3 border-t dark:border-neutral-700 gap-x-2">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 gap-x-2 hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                        data-hs-overlay="#kembali-modal">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
