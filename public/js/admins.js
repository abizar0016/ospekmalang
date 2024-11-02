$(document).ready(function () {

    $("#user-add").on("submit", function (e) {
        e.preventDefault();
        const form = $(this)[0]; // Ambil form HTML asli
    
        // Buat objek FormData dari form untuk menyertakan file
        const formData = new FormData(form);
    
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            contentType: false, // Atur contentType dan processData menjadi false agar FormData berfungsi
            processData: false,
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
                        "Error",
                        response.message || "Terjadi Kesalahan",
                        "error"
                    );
                }
            },
            error: function (xhr) {
                let errorMessage = 
                xhr.responseJSON?.message || "Gagal menambahkan data";
                swal("Error!", errorMessage, "error");
            },
        });
    });   
    
    $("form[id^='user-update-']").on("submit", function(e) {
        e.preventDefault(); // Mencegah form dikirim langsung
        const form = $(this);

        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    swal({
                        title: "Sukses!",
                        text: response.message,
                        icon: "success",
                        timer: 1000,
                        buttons: false,
                    }).then(() => location.reload());
                } else {
                    swal("Error!", response.message || "Terjadi kesalahan.", "error");
                }
            },
            error: function(xhr) {
                let errorMessage = xhr.responseJSON?.message || "Gagal memperbarui data.";
                swal("Error!", errorMessage, "error");
            },
        });
    });

    $(".delete-button").on("click", function (event) {
        event.preventDefault(); // Mencegah pengiriman form secara langsung
        const formId = $(this).data("form-id"); // Ambil ID form dari tombol
        const nameUser = $(this).data("item-name"); // Ambil nama pengguna untuk konfirmasi
    
        swal({
            title: "Apakah Anda yakin ingin menghapus " + nameUser + "?",
            text: "Anda tidak dapat mengembalikan aksi ini!",
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
    

    // Handler untuk penambahan data kategori
    $("#categories-add").on("submit", function (e) {
        e.preventDefault(); // Mencegah form dikirim langsung
        const form = $(this);

        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
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
                    xhr.responseJSON?.message || "Gagal menambahkan data.";
                swal("Error!", errorMessage, "error");
            },
        });
    });

    // Handler untuk pembaruan data
    $("[id^=categories-update-]").on("submit", function (e) {
        e.preventDefault();
        const form = $(this);
    
        // Tampilkan pesan "Mengubah..."
        swal({
            title: "Mengubah...",
            text: "Sedang memperbarui kategori...",
            icon: "info",
            buttons: false,
            timer: 1000, // Tampilkan selama 1 detik
        });
    
        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
            success: function (response) {
                if (response.success) {
                    // Tampilkan pesan sukses
                    swal({
                        title: "Sukses!",
                        text: response.message,
                        icon: "success",
                        timer: 1000,
                        buttons: false,
                    }).then(() => location.reload());
                } else {
                    // Tampilkan pesan error jika ada
                    swal(
                        "Error!",
                        response.message || "Terjadi kesalahan.",
                        "error"
                    );
                }
            },
            error: function (xhr) {
                // Tampilkan pesan error umum jika terjadi kesalahan
                let errorMessage =
                    xhr.responseJSON?.message || "Gagal memperbarui data.";
                swal("Error!", errorMessage, "error");
            },
        });
    });
    

    // Handler untuk penghapusan data
    $(".delete-button").on("click", function (event) {
        event.preventDefault(); // Mencegah pengiriman form secara langsung
        const formId = $(this).data("form-id"); // Ambil ID form dari tombol
        const nameCategories = $(this).data("item-name"); // Ambil nama item untuk konfirmasi

        swal({
            title: "Apakah Anda yakin ingin menghapus " + nameCategories + "?",
            text: "Anda tidak dapat mengembalikan aksi ini!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Batal",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true, // Memungkinkan modal ditutup
                },
                confirm: {
                    text: "Ya, hapus!",
                    value: true,
                    visible: true,
                    className: "confirm-button",
                    closeModal: true, // Memungkinkan modal ditutup
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
});
jquery;

// Hover
let list = document.querySelectorAll(".navigation li");

function activeLink() {
    list.forEach((item) => {
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

// Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};

function formatRupiah(angka, prefix) {
    let number_string = angka.replace(/[^,\d]/g, "").toString();
    let split = number_string.split(",");
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
    return prefix + rupiah;
}

function previewImageProfile() {
    const fileInput = document.getElementById("image");
    const file = fileInput.files[0];
    const imgPreview = document.querySelector(".img-preview");

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imgPreview.src = e.target.result;
            imgPreview.style.display = "block"; // Pastikan gambar ditampilkan
        };

        reader.readAsDataURL(file);
    } else {
        imgPreview.src = "{{ url('images/default-profile.jpg') }}"; // Tampilkan gambar default jika tidak ada gambar
        imgPreview.style.display = "block"; // Tetap tampilkan gambar
    }
}

function previewImage(imageNumber, productId) {
    const input = document.getElementById("image" + imageNumber + "-" + productId);
    const preview = document.getElementById("imgPreview" + imageNumber + "-" + productId);

    const reader = new FileReader();
    reader.onload = function (e) {
        preview.src = e.target.result; // Set source untuk gambar preview
        preview.style.display = "block"; // Pastikan gambar terlihat
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]); // Baca file sebagai Data URL
    } else {
        preview.src = "{{ asset('images/' . ($product->{'image' + imageNumber} ?? '')) }}"; // Set gambar default
    }
}


function previewImage(userId) {
    const input = document.getElementById(`image-${userId}`);
    const imgPreview = document.getElementById(`imgPreview-${userId}`);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imgPreview.src = e.target.result; // Set source image preview
        }
        reader.readAsDataURL(input.files[0]);
    }
}


// Fungsi untuk membuka modal
function openModal() {
    var modal = document.getElementById("categoryModal");
    modal.style.display = "block";
}

// Fungsi untuk menutup modal
function closeModal() {
    var modal = document.getElementById("categoryModal");
    modal.style.display = "none";
}

function openModal() {
    var modal = document.getElementById("modal-add");
    modal.style.display = "block";
}

// Fungsi untuk menutup modal
function closeModal() {
    var modal = document.getElementById("modal-add");
    modal.style.display = "none";
}

// Tutup modal saat pengguna klik di luar konten modal
window.onclick = function (event) {
    var modal = document.getElementById("categoryModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

function openModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "block";
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    const content = modal.querySelector(".modal-content");

    // Tambahkan kelas animasi zoomOut
    content.style.animation = "zoomOut 0.5s ease-in-out";

    // Tunggu sampai animasi selesai sebelum menyembunyikan modal
    setTimeout(() => {
        modal.style.display = "none";
        content.style.animation = "";
    }, 500);
}

window.onclick = function (event) {
    var modals = document.getElementsByClassName("modal");
    for (var i = 0; i < modals.length; i++) {
        if (event.target === modals[i]) {
            closeModal(modals[i].id);
        }
    }
};

function openTab(evt, tabName) {
    // Cari modal yang terkait dengan tombol yang diklik
    const modalContent = evt.target.closest(".modal-content");

    // Dapatkan semua elemen dengan kelas "tab-content" di dalam modal ini
    const tabcontent = modalContent.getElementsByClassName("tab-content");
    for (let i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active");
    }

    // Dapatkan semua tombol dengan kelas "tab-button" di dalam modal ini
    const tabbuttons = modalContent.getElementsByClassName("tab-button");
    for (let i = 0; i < tabbuttons.length; i++) {
        tabbuttons[i].classList.remove("active");
    }

    // Aktifkan tab yang dipilih dan tombolnya
    modalContent.querySelector(`#${tabName}`).classList.add("active");
    evt.currentTarget.classList.add("active");
}

function setMainImage(src) {
    document.getElementById("mainImage").src = src;
}
// Menangani aksi penambahan kategori
