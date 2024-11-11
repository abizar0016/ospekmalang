// Menampilkan form edit dan menyembunyikan tampilan profil
$('#editButton').on('click', function() {
    $('#profileView').hide();
    $('#profileEdit').show();
});

// Menyembunyikan form edit dan menampilkan tampilan profil
$('#cancelButton').on('click', function(event) {
    event.preventDefault();
    $('#profileView').show();
    $('#profileEdit').hide();
});

$("form[id^='user-update-']").on("submit", function (e) {
    e.preventDefault(); // Mencegah form dikirim langsung
    const form = $(this);

    $.ajax({
        url: form.attr("action"),
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                swal({
                    title: "Sukses!",
                    text: response.message,
                    icon: "success",
                    timer: 1000,
                    buttons: false,
                }).then(() => location.reload());
            } else {
                swal(
                    "Error!",
                    response.message || "Terjadi kesalahan.",
                    "error"
                );
            }
        },
        error: function (xhr) {
            let errorMessage =
                xhr.responseJSON?.message || "Gagal memperbarui data.";
            swal("Error!", errorMessage, "error");
        },
    });
});


$(".delete-cart-button").on("click", function (event) {
    event.preventDefault();
    const formId = $(this).data("form-id");
    swal({
        title: "Apakah Anda yakon ingin menghapus item ini?",
        text: "Anda tidak dapat mengembalikan data ini!",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Batal",
                value: null,
                visible: true,
                className: "",
                closeModal: true,
            },
            confirm: {
                text: "Ya, hapus!",
                value: true,
                visible: true,
                className: "confirm-button",
                closeModal: true,
            },
        },
    }).then((result) => {
        if (result) {
            // Tampilkan pesan "Menghapus..."
            swal({
                title: "Menghapus...",
                text: "Sedang menghapus item...",
                icon: "info",
                buttons: false, // Menyembunyikan tombol "OK"
                timer: 1000, // Menampilkan selama 1 detik
            });

            // Submit the form via AJAX
            $.ajax({
                url: $("#" + formId).attr("action"),
                method: "POST",
                data: $("#" + formId).serialize(),
                success: function (response) {
                    if (response.success) {
                        // Tampilkan pesan berhasil
                        swal({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success",
                            timer: 1000,
                            buttons: false, // Menyembunyikan tombol "OK"
                        }).then(() => {
                            // Reload halaman setelah menampilkan pesan
                            location.reload();
                        });
                    } else {
                        // Tampilkan pesan kesalahan jika ada
                        swal("Error!", response.message, "error");
                    }
                },
                error: function (xhr) {
                    // Tampilkan pesan kesalahan umum jika terjadi kesalahan
                    var errorMessage =
                        xhr.responseJSON?.message ||
                        "Terjadi kesalahan saat menghapus item.";
                    swal("Error!", errorMessage, "error");
                },
            });
        }
    });
});

// Show the payment modal
function showPaymentModal() {
    document.getElementById("paymentModal").style.display = "block";
}

// Close the payment modal
function closePaymentModal() {
    document.getElementById("paymentModal").style.display = "none";
}

window.onclick = function(event) {
    const modal = document.getElementById('paymentModal');
    if (event.target === modal) {
        closePaymentModal();
    }
};

// Update total price based on selected checkboxes
function updateTotal() {
    let total = 0;
    document
        .querySelectorAll(".cart-checkbox:checked")
        .forEach(function (checkbox) {
            const price = parseInt(checkbox.getAttribute("data-price"));
            const quantity = parseInt(checkbox.getAttribute("data-quantity"));
            total += price * quantity;
        });

    document.getElementById("total-price").textContent =
        total.toLocaleString("id-ID");
}

// Toggle all checkboxes when "Select All" checkbox is clicked
function toggleSelectAll() {
    const selectAllCheckbox = document.getElementById("select-all"); // "Select All" checkbox
    const checkboxes = document.querySelectorAll(".cart-checkbox"); // All item checkboxes

    // Set all item checkboxes to the same checked state as "Select All"
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = selectAllCheckbox.checked;
    });

    // Update total price
    updateTotal();
}

// Add event listener to "Select All" checkbox
document.getElementById("select-all").addEventListener("change", function () {
    // Select or deselect all checkboxes based on the "Select All" checkbox state
    const checkboxes = document.querySelectorAll(".cart-checkbox");
    checkboxes.forEach((checkbox) => {
        checkbox.checked = this.checked;
    });

    // Update the total price
    updateTotal();
});

function userImageUpdate() {
    const input = document.getElementById('imageUpload');
    const preview = document.getElementById('imgPreview');

    if (input && input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result; // Setel sumber pratinjau gambar
        };
        reader.readAsDataURL(input.files[0]); // Baca file sebagai Data URL
    } else {
        // Jika tidak ada file, atur ulang ke gambar default
        preview.src = "{{ asset('images/default-profile.jpg') }}";
    }
}