import "./bootstrap";
import "preline";
import "./../css/app.css";
import Swal from "sweetalert2";

window.Swal = Swal;
// SweetAlert2 confirmation for delete action
$(document).on("click", ".delete", function (e) {
    e.preventDefault();
    let form = $(this).closest("form");
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Anda tidak dapat mengembalikan ini setelah dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
$(document).on("click", ".selesaikan-btn", function (e) {
    e.preventDefault();
    let form = $(this).closest("form");
    Swal.fire({
        title: "Apakah Anda yakin akan menyelesaikan ini?",
        text: "Jika iya, maka aktifitas dan status selesai!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Selesaikan!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('price')) {
        // Menghapus karakter non-numerik
        let value = e.target.value.replace(/\D/g, '');

        // Mengupdate input tersembunyi yang terkait dengan elemen input yang berubah
        e.target.nextElementSibling.value = value;

        // Memformat angka dengan pemisah ribuan
        let formattedValue = new Intl.NumberFormat('id-ID').format(value);

        // Menampilkan nilai terformat
        e.target.value = formattedValue;
    }
});
