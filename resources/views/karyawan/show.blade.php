@extends('layouts.dashboard')

@section('content')
    <div class="mx-auto my-4 max-w-[85rem] px-4 sm:my-10 sm:px-6 lg:px-8">
        <table border="1" class="my-5">
            <tr>
                <td class="font-medium">Nama Karyawan</td>
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
        <hr>
    </div>
    @if ($karyawan->jenis_karyawan == 'cutting')
        @include('partials.cutting_kembali')
    @else
        @include('partials.jahit_kembali')
    @endif



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
