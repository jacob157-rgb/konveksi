<!DOCTYPE html>
<html>

<head>
    <title>Create supplyer</title>
</head>

<body>
    <form action="/supplyer" method="POST">
        @csrf
        <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
        </div>
        <button type="submit">Create</button>
    </form>

    <table border="1">
        <tr>
            <th>no.</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        @foreach ($supplyer as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama }}</td>
                <td>
                    <button class="edit" data-id="{{ $row->id }}">Edit</button>
                    <form action="/supplyer/delete/{{ $row->id }}" method="post">
                        @csrf
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    <div id="modal-edit" style="display: none;">
        <h2>Edit supplyer</h2>
        <form id="editForm" action="/supplyer/update" method="POST">
            @csrf
            <input type="hidden" name="id" id="id_supplyer">
            <input type="text" id="nama_supplyer" name="nama">
            <button type="submit">Simpan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.edit').click(function(e) {
            let post_id = $(this).data('id');
            $.ajax({
                url: `/supplyer/edit/${post_id}`,
                type: "GET",
                success: function(response) {
                    $('#id_supplyer').val(response.data.id);
                    $('#nama_supplyer').val(response.data.nama);
                    $('#modal-edit').show();
                }
            });
        });
    </script>

</body>

</html>
