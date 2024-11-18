(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: "fade-in",
        outClass: "fade-out",
        inDuration: 1500,
        outDuration: 800,
        linkElement: ".animsition-link",
        loading: true,
        loadingParentElement: "html",
        loadingClass: "animsition-loading-1",
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ["animation-duration", "-webkit-animation-duration"],
        overlay: false,
        overlayClass: "animsition-overlay-slide",
        overlayParentElement: "html",
        transition: function (url) {
            window.location.href = url;
        },
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height() / 2;

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css("display", "flex");
        } else {
            $("#myBtn").css("display", "none");
        }
    });

    $("#myBtn").on("click", function () {
        $("html, body").animate({ scrollTop: 0 }, 300);
    });

    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $(".container-menu-desktop");
    var wrapMenu = $(".wrap-menu-desktop");

    var posWrapHeader = $(".top-bar").length > 0 ? $(".top-bar").height() : 0;

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass("fix-menu-desktop");
            $(wrapMenu).css("top", 0);
        } else {
            $(headerDesktop).removeClass("fix-menu-desktop");
            $(wrapMenu).css("top", posWrapHeader - $(this).scrollTop());
        }
    });

    /*==================================================================
    [ Menu mobile ]*/
    $(".btn-show-menu-mobile").on("click", function () {
        $(this).toggleClass("is-active");
        $(".menu-mobile").slideToggle();
    });

    var arrowMainMenu = $(".arrow-main-menu-m");

    for (var i = 0; i < arrowMainMenu.length; i++) {
        $(arrowMainMenu[i]).on("click", function () {
            $(this).parent().find(".sub-menu-m").slideToggle();
            $(this).toggleClass("turn-arrow-main-menu-m");
        });
    }

    $(window).resize(function () {
        if ($(window).width() >= 992) {
            if ($(".menu-mobile").css("display") == "block") {
                $(".menu-mobile").css("display", "none");
                $(".btn-show-menu-mobile").toggleClass("is-active");
            }

            $(".sub-menu-m").each(function () {
                if ($(this).css("display") == "block") {
                    $(this).css("display", "none");
                    $(arrowMainMenu).removeClass("turn-arrow-main-menu-m");
                }
            });
        }
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $(".js-show-filter").on("click", function () {
        $(this).toggleClass("show-filter");
        $(".panel-filter").slideToggle(400);

        if ($(".js-show-search").hasClass("show-search")) {
            $(".js-show-search").removeClass("show-search");
            $(".panel-search").slideUp(400);
        }
    });

    $(".js-show-search").on("click", function () {
        $(this).toggleClass("show-search");
        $(".panel-search").slideToggle(400);

        if ($(".js-show-filter").hasClass("show-filter")) {
            $(".js-show-filter").removeClass("show-filter");
            $(".panel-filter").slideUp(400);
        }
    });

    /*==================================================================
    [ Cart ]*/
    $(".js-show-cart").on("click", function () {
        $(".js-panel-cart").addClass("show-header-cart");
    });

    $(".js-hide-cart").on("click", function () {
        $(".js-panel-cart").removeClass("show-header-cart");
    });

    /*==================================================================
    [ Sidebar ]*/
    $(".js-show-sidebar").on("click", function () {
        $(".js-sidebar").addClass("show-sidebar");
    });

    $(".js-hide-sidebar").on("click", function () {
        $(".js-sidebar").removeClass("show-sidebar");
    });

    /*==================================================================
    [ +/- num product ]*/
    $(".btn-num-product-down").on("click", function () {
        var numProduct = Number($(this).next().val());
        if (numProduct > 0)
            $(this)
                .next()
                .val(numProduct - 1);
    });

    $(".btn-num-product-up").on("click", function () {
        var numProduct = Number($(this).prev().val());
        $(this)
            .prev()
            .val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $(".wrap-rating").each(function () {
        var item = $(this).find(".item-rating");
        var rated = -1;
        var input = $(this).find("input");
        $(input).val(0);

        $(item).on("mouseenter", function () {
            var index = item.index(this);
            for (var i = 0; i <= index; i++) {
                $(item[i])
                    .removeClass("zmdi-star-outline")
                    .addClass("zmdi-star");
            }

            for (var j = i; j < item.length; j++) {
                $(item[j])
                    .addClass("zmdi-star-outline")
                    .removeClass("zmdi-star");
            }
        });

        $(item).on("click", function () {
            var index = item.index(this);
            rated = index;
            $(input).val(index + 1);
        });

        $(this).on("mouseleave", function () {
            for (var i = 0; i <= rated; i++) {
                $(item[i])
                    .removeClass("zmdi-star-outline")
                    .addClass("zmdi-star");
            }

            for (var j = i; j < item.length; j++) {
                $(item[j])
                    .addClass("zmdi-star-outline")
                    .removeClass("zmdi-star");
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/
    $(".js-show-modal1").on("click", function (e) {
        e.preventDefault();
        $(".js-modal1").addClass("show-modal1");
    });

    $(".js-hide-modal1").on("click", function () {
        $(".js-modal1").removeClass("show-modal1");
    });

    //========================================================================================
    //[Cart]

    $(document).ready(function () {

        $("#handleback").on("submit", function (e) {
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

    });

    $(".delete-order").on("submit", function (event) {
        event.preventDefault(); // Mencegah pengiriman form secara langsung
        const formId = $(this).attr("id"); // Ambil ID form
    
        swal({
            title: "Apakah Anda yakin ingin menghapus ?",
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
                    buttons: false,
                    timer: 1000,
                });
    
                // Submit the form via AJAX
                $.ajax({
                    url: $("#" + formId).attr("action"),
                    method: "POST", // Gunakan POST
                    data: $("#" + formId).serialize(),
                    success: function (response) {
                        if (response.success) {
                            // Tampilkan pesan berhasil
                            swal({
                                title: "Berhasil!",
                                text: response.message,
                                icon: "success",
                                timer: 1000,
                                buttons: false,
                            }).then(() => {
                                location.reload(); // Reload halaman
                            });
                        } else {
                            swal("Error!", response.message, "error");
                        }
                    },
                    error: function (xhr) {
                        var errorMessage =
                            xhr.responseJSON?.message || "Terjadi kesalahan saat menghapus item.";
                        swal("Error!", errorMessage, "error");
                    },
                });
            }
        });
    });
    
    

    //===========================================================================================================

    $(".js-select2").each(function () {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next(".dropDownSelect2"),
        });
    });

    $(".gallery-lb").each(function () {
        // the containers for all your galleries
        $(this).magnificPopup({
            delegate: "a", // the selector for gallery item
            type: "image",
            gallery: {
                enabled: true,
            },
            mainClass: "mfp-fade",
        });
    });
})(jQuery);

document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-button");
    const productItems = document.querySelectorAll(".isotope-item");

    // Fungsi untuk menyaring produk
    function filterProducts(filter) {
        console.log("Filter:", filter); // Lihat nilai filter yang digunakan
        productItems.forEach((item) => {
            console.log("Item classes:", item.className); // Lihat kelas item produk
            if (filter === "*" || item.classList.contains(filter)) {
                item.classList.add("show");
                item.classList.remove("hide");
            } else {
                item.classList.remove("show");
                item.classList.add("hide");
            }
        });
    }

    // Menangani klik pada tombol filter
    filterButtons.forEach((button) => {
        button.addEventListener("click", function () {
            filterButtons.forEach((btn) => btn.classList.remove("active"));
            this.classList.add("active");
            const filter = this.getAttribute("data-filter");
            filterProducts(filter);
        });
    });

    // Inisialisasi tampilan produk
    filterProducts("*");

    // Tampilkan modal pertama atau produk tertentu (misalnya id=1)
    showModal(1); // Ganti dengan ID produk yang diinginkan
});

function showModal(id) {
    // Sembunyikan semua modal
    document.querySelectorAll(".wrap-modal1").forEach(function (modal) {
        modal.style.display = "none";
    });

    // Tampilkan modal yang sesuai
    document.getElementById("modal-" + id).style.display = "block";
}

function changeImage(imageUrl, productId) {
    console.log("Changing image for product:", productId, "to:", imageUrl); // Debugging
    var mainImage = document.getElementById("mainProductImage-" + productId);
    var mainLink = document.getElementById("mainProductLink-" + productId);

    if (mainImage && mainLink) {
        mainImage.src = imageUrl;
        mainLink.href = imageUrl;
    }
}

// Fungsi untuk memperbarui total harga dan produk yang dipilih
// Fungsi untuk memperbarui total harga dan produk yang dipilih
function updateTotal() {
    let total = 0;
    let selectedProducts = [];

    // Menentukan produk yang dipilih dan menghitung total harga
    document.querySelectorAll('.cart-checkbox:checked').forEach(function(checkbox) {
        // Mendapatkan harga dan kuantitas produk dengan validasi
        let price = parseInt(checkbox.getAttribute('data-price'));
        if (isNaN(price)) {
            price = 0;  // Pastikan harga valid, jika tidak maka 0
        }
        
        let quantity = parseInt(checkbox.getAttribute('data-quantity')) || 1; // Menggunakan 1 jika kuantitas tidak valid
        if (quantity <= 0) {
            quantity = 1;  // Pastikan kuantitas valid, jika tidak maka 1
        }

        let productId = checkbox.getAttribute('data-id');

        // Menambahkan harga dan kuantitas ke total
        total += price * quantity;
        
        // Menambahkan produk yang dipilih ke array
        selectedProducts.push({ id: productId, quantity: quantity });
    });

    // Menampilkan total harga dengan format Rupiah
    document.getElementById('total-price').textContent = total.toLocaleString('id-ID');

    // Menyimpan produk yang dipilih dalam input tersembunyi (dalam format JSON)
    document.getElementById('selected_products').value = JSON.stringify(selectedProducts);
}

// Fungsi untuk menandai atau menghapus semua checkbox
function toggleSelectAll() {
    let selectAll = document.getElementById('select-all');
    let checkboxes = document.querySelectorAll('.cart-checkbox');
    
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = selectAll.checked;
    });

    updateTotal(); // Update total setelah memilih semua
}

// Mengikat event ketika DOM sudah siap
document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk checkbox "select-all"
    const selectAllCheckbox = document.getElementById('select-all');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', toggleSelectAll);
    } else {
        console.warn("Checkbox 'select-all' tidak ditemukan.");
    }

    // Event listener untuk setiap checkbox produk
    document.querySelectorAll('.cart-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', updateTotal);
    });

    // Pastikan total awal dihitung saat halaman dimuat
    updateTotal();
});
