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

function showPaymentModal() {
    // Dapatkan produk yang dipilih
    let selectedProducts = [];
    document.querySelectorAll('.cart-checkbox:checked').forEach((checkbox) => {
        selectedProducts.push(checkbox.dataset.id);
    });

    // Tampilkan modal jika ada produk yang dipilih
    if (selectedProducts.length > 0) {
        document.getElementById('selected_products').value = JSON.stringify(selectedProducts);
        document.getElementById('recipientModal').style.display = 'block';
    } else {
        alert('Silakan pilih produk terlebih dahulu.');
    }
}