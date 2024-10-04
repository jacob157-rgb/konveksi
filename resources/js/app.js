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


document.addEventListener("input", function (e) {
    if (e.target.classList.contains("price")) {
        let value = e.target.value;
        console.log(value);

        // Izinkan angka dan titik sebagai desimal
        value = value.replace(/[^0-9.]/g, '');

        // Tampilkan nilai asli (tanpa format ribuan, titik sebagai desimal)
        e.target.value = value;

        // Simpan nilai asli ke dalam input tersembunyi (untuk perhitungan)
        e.target.nextElementSibling.value = value;
    }

    if (e.target.classList.contains("jumlah") || e.target.classList.contains("nominal")) {
        const container = e.target.closest(".value-container");

        if (container) {
            // Ambil nilai jumlah dan nominal (anggap titik sebagai pemisah desimal)
            const jumlah = parseFloat(container.querySelector(".jumlah").value) || 0;
            const nominal = parseFloat(container.querySelector(".nominal").value) || 0;

            // Hitung total tanpa membulatkan hasil
            const total = jumlah * nominal;

            // Update field total tanpa membulatkan angka desimal
            container.querySelector(".total").value = total.toString();

            // Update total keseluruhan jika ada
            allTotal();
        } else {
            console.error("Container tidak ditemukan");
        }
    }

    function allTotal() {
        const totalInputs = document.querySelectorAll('input[name*="model"][name*="[total]"]');
        let totalValue = 0;

        totalInputs.forEach((input) => {
            totalValue += parseFloat(input.value.replace(/\./g, "").replace(/,/g, ".")) || 0;
        });

        // Cek apakah elemen #est-all-total ada sebelum mengaksesnya
        const estAllTotalElement = document.getElementById("est-all-total");
        if (estAllTotalElement) {
            // Update total keseluruhan tanpa membulatkan desimal
            estAllTotalElement.value = totalValue.toString();
        } else {
            console.error("Element with id 'est-all-total' not found.");
        }
    }
});



// document.addEventListener("DOMContentLoaded", function () {
//     const tambahBarangButtons = document.querySelectorAll(".tambah-barang");
//     const kirimBarangButtons = document.querySelectorAll(".kirim-barang");

//     if (tambahBarangButtons.length === 0 || kirimBarangButtons.length === 0) {
//         console.error(
//             "No elements with the class 'tambah-barang' or 'kirim-barang' found."
//         );
//         return;
//     }

//     function setSupplyerId(event) {
//         const supplyerId = event.currentTarget.getAttribute("data-supplyer-id");
//         const hiddenInputs = document.querySelectorAll(".supplyer_id");

//         if (hiddenInputs.length === 0) {
//             console.error("No elements with the class 'supplyer_id' found.");
//             return;
//         }

//         hiddenInputs.forEach((hiddenInput) => {
//             hiddenInput.value = supplyerId;
//             console.log(hiddenInput.value);
//         });
//     }

//     tambahBarangButtons.forEach((button) => {
//         button.addEventListener("click", setSupplyerId);
//     });

//     kirimBarangButtons.forEach((button) => {
//         button.addEventListener("click", setSupplyerId);
//     });
// });
