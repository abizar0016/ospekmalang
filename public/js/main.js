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
        $(document).on("click", ".add-btn, .js-addcart-detail", function (e) {
            e.preventDefault();

            var form = $(this).closest("form");
            var formData = form.serialize();
            var nameProduct = $(this)
                .closest(".product-list")
                .find(".name-product")
                .html();

            $.ajax({
                url: form.attr("action"),
                method: form.attr("method"),
                data: formData,
                success: function (response) {
                    if (response.success) {
                        swal({
                            title: nameProduct,
                            text: "is added to cart!",
                            icon: "success",
                            timer: 1000, // Menampilkan selama 1 detik
                            buttons: false,
                        }).then(function () {
                            // Refresh halaman setelah pesan ditutup
                            location.reload();
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text:
                                response.message ||
                                "Failed to add product to cart.",
                            icon: "error",
                            timer: 1000,
                            buttons: false,
                        });
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    swal({
                        title: "Error!",
                        text: "Error occurred: " + xhr.responseText,
                        icon: "error",
                        timer: 1000,
                        buttons: false,
                    });
                },
                complete: function () {
                    // Mengaktifkan kembali tombol setelah proses selesai
                    $(this).prop("disabled", false).text("Tambah ke Keranjang");
                },
            });
        });

        $(document).on("click", ".delete-item", function () {
            var itemId = $(this).data("item-id");
            var formId = "delete-item-" + itemId;
            var nameProduct = $(this).data("item-name");
        
            swal({
                title: "Anda yakin ingin menghapus " + nameProduct + "?",
                text: "Item ini akan dihapus dari keranjang!",
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
                        text: "Sedang menghapus item dari keranjang...",
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

document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua checkbox item
    const checkboxes = document.querySelectorAll(".item-checkbox");
    const totalPriceElement = document.getElementById("total-price");

    // Tambahkan event listener ke setiap checkbox
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            updateTotalPrice(); // Panggil fungsi setiap kali checkbox berubah
        });
    });

    function updateTotalPrice() {
        let totalPrice = 0;

        // Iterasi setiap checkbox yang dicentang
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.getAttribute("data-price"));
                const quantity = parseInt(
                    checkbox.getAttribute("data-quantity")
                );

                // Debugging
                console.log("Price:", price, "Quantity:", quantity);

                // Hitung total harga
                totalPrice += price * quantity;
            }
        });

        // Debugging hasil total price
        console.log("Total Price:", totalPrice);

        // Update total harga di DOM
        if (totalPriceElement) {
            totalPriceElement.textContent = totalPrice.toLocaleString("id-ID", {
                style: "currency",
                currency: "IDR",
            });
        }
    }
});
