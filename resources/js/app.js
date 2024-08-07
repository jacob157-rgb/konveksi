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
        // Menghapus karakter non-numerik
        let value = e.target.value.replace(/\D/g, "");

        // Mengupdate input tersembunyi yang terkait dengan elemen input yang berubah
        e.target.nextElementSibling.value = value;

        // Memformat angka dengan pemisah ribuan
        let formattedValue = new Intl.NumberFormat("id-ID").format(value);

        // Menampilkan nilai terformat
        e.target.value = formattedValue;
    }
});

document.addEventListener("input", function (e) {
    if (
        e.target.classList.contains("jumlah") ||
        e.target.classList.contains("nominal")
    ) {
        // Find the closest container that includes both 'jumlah' and 'nominal' inputs
        const container = e.target.closest(".value-container");

        if (container) {
            // Get the values from the inputs
            const jumlah =
                parseFloat(container.querySelector(".jumlah").value) || 0;
            const nominal =
                parseFloat(
                    container.querySelector(".nominal").value.replace(/\D/g, "")
                ) || 0;

            console.log(nominal);
            // Calculate the total
            const total = jumlah * nominal;

            // Update the total input field with the formatted total
            container.querySelector(".total").value = new Intl.NumberFormat(
                "id-ID"
            ).format(total);
            allTotal();
        } else {
            console.error("Container not found");
        }
    }

    function allTotal() {
        const totalInputs = document.querySelectorAll('input[name*="model"][name*="[total]"]');
        let totalValue = 0;

        totalInputs.forEach((input) => {
            totalValue += parseFloat(input.value.replace(/\D/g, "")) || 0;
        });

        // Tampilkan total keseluruhan di elemen dengan id="est-all-total"
        document.getElementById("est-all-total").value = new Intl.NumberFormat("id-ID").format(totalValue);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const tambahBarangButtons = document.querySelectorAll(".tambah-barang");
    const kirimBarangButtons = document.querySelectorAll(".kirim-barang");

    if (tambahBarangButtons.length === 0 || kirimBarangButtons.length === 0) {
        console.error(
            "No elements with the class 'tambah-barang' or 'kirim-barang' found."
        );
        return;
    }

    function setSupplyerId(event) {
        const supplyerId = event.currentTarget.getAttribute("data-supplyer-id");
        const hiddenInputs = document.querySelectorAll(".supplyer_id");

        if (hiddenInputs.length === 0) {
            console.error("No elements with the class 'supplyer_id' found.");
            return;
        }

        hiddenInputs.forEach((hiddenInput) => {
            hiddenInput.value = supplyerId;
            console.log(hiddenInput.value);
        });
    }

    tambahBarangButtons.forEach((button) => {
        button.addEventListener("click", setSupplyerId);
    });

    kirimBarangButtons.forEach((button) => {
        button.addEventListener("click", setSupplyerId);
    });
});
