@extends('layouts.dashboard')
@push('addon_style')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script src="https://unpkg.com/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
    <style>
        .ql-container {
            border: none !important;
            padding: 0 !important;
        }

        #editor {
            min-height: 200px;
        }

        #toolbar-container {
            border: none !important;
        }

        img {
            max-width: 30% !important;
            height: auto !important;
            border-radius: 10px;
        }
    </style>
@endpush
@section('content')
    <div
        class="flex flex-col p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 md:p-5">
        <div class="flex flex-col">
            <h3 class="font-bold text-gray-800 dark:text-white">
                Tambah Jenis model
            </h3>
            <div class="-m-1.5 overflow-x-auto">
                <form action="/model/update/{{ $edit->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="p-4 overflow-y-auto">
                        <label for="nama" class="block mb-2 text-sm font-medium dark:text-white">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ $edit->nama }}"
                            class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500"
                            placeholder="Masukan Jenis model" autofocus="">
                    </div>

                    <div class="">
                        <div id="toolbar-container" class="w-full">
                            <span class="ql-formats">
                                <select class="ql-font"></select>
                                <select class="ql-size"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-color"></select>
                                <select class="ql-background"></select>
                            </span>

                            <span class="ql-formats">
                                <button class="ql-header" value="1"></button>
                                <button class="ql-header" value="2"></button>
                                <button class="ql-header" value="3"></button>
                                <button class="ql-header" value="4"></button>
                                <button class="ql-header" value="5"></button>
                                <button class="ql-header" value="6"></button>
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-indent" value="-1"></button>
                                <button class="ql-indent" value="+1"></button>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-align"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-image"></button> <!-- Tombol untuk upload gambar -->
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div id="editor">
                            {!! $edit->keterangan !!}
                        </div>
                        <input type="hidden" name="keterangan" id="keterangan">
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <a href="/model"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#tambah-modal">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Block = Quill.import('blots/block');
            Block.tagName = 'DIV';
            Quill.register(Block, true);

            const quill = new Quill('#editor', {
                modules: {
                    syntax: true,
                    toolbar: {
                        container: '#toolbar-container',
                        handlers: {
                            image: function() {
                                selectLocalImage();
                            }
                        }
                    },
                    imageResize: {
                        displayStyles: {
                            backgroundColor: 'black',
                            border: 'none',
                            color: 'white'
                        },
                        modules: ['Resize', 'DisplaySize', 'Toolbar'] // Opsi tambahan resize
                    },
                },
                placeholder: 'Buat keterangan disini....',
                theme: 'snow',
            });

            function selectLocalImage() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                input.onchange = function() {
                    const file = input.files[0];
                    if (/^image\//.test(file.type)) {
                        saveToServer(file);
                    } else {
                        console.warn('File bukan gambar.');
                    }
                };
            }

            function saveToServer(file) {
                const formData = new FormData();
                formData.append('image', file);

                fetch('/upload-image', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            insertToEditor(result.url);
                        } else {
                            console.warn('Upload gagal.');
                        }
                    })
                    .catch(error => {
                        console.error('Error uploading image:', error);
                    });
            }

            function insertToEditor(url) {
                const range = quill.getSelection();
                quill.insertEmbed(range.index, 'image', url);
            }

            function updateQuillContent() {
                const delta = quill.getContents();
                const html = quill.root.innerHTML;

                let content = html.replace(/<p>/g, '<p class="text-gray-700 mb-2">')
                    .replace(/<h1>/g, '<h1 class="text-4xl font-bold mb-2">')
                    .replace(/<h2>/g, '<h2 class="text-3xl font-bold mb-2">')
                    .replace(/<h3>/g, '<h3 class="text-2xl font-bold mb-2">')
                    .replace(/<ol>/g, '<ol class="list-decimal list-inside mb-2">')
                    .replace(/<ul>/g, '<ul class="list-disc list-inside mb-2">');

                document.querySelector('#keterangan').value = content;
            }

            var observer = new MutationObserver(updateQuillContent);

            observer.observe(quill.root, {
                childList: true,
                subtree: true,
                characterData: true
            });

            document.querySelector('#tartib-form').onsubmit = function() {
                updateQuillContent();
                return true;
            };
        });
    </script>
@endsection
