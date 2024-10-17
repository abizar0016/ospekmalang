(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'html',
        transition: function (url) { window.location.href = url; }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height() / 2;

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display', 'flex');
        } else {
            $("#myBtn").css('display', 'none');
        }
    });

    $('#myBtn').on("click", function () {
        $('html, body').animate({ scrollTop: 0 }, 300);
    });

    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    var posWrapHeader = ($('.top-bar').length > 0) ? $('.top-bar').height() : 0;

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top', 0);
        } else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
        }
    });

    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function () {
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for (var i = 0; i < arrowMainMenu.length; i++) {
        $(arrowMainMenu[i]).on('click', function () {
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        });
    }

    $(window).resize(function () {
        if ($(window).width() >= 992) {
            if ($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display', 'none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function () {
                if ($(this).css('display') == 'block') {
                    $(this).css('display', 'none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });
        }
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click', function () {
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if ($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click', function () {
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if ($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click', function () {
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click', function () {
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    
    /*==================================================================
    [ Sidebar ]*/
    $('.js-show-sidebar').on('click', function () {
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click', function () {
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function () {
        var numProduct = Number($(this).next().val());
        if (numProduct > 0) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function () {
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function () {
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function () {
            var index = item.index(this);
            for (var i = 0; i <= index; i++) {
                $(item[i]).removeClass('zmdi-star-outline').addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline').removeClass('zmdi-star');
            }
        });

        $(item).on('click', function () {
            var index = item.index(this);
            rated = index;
            $(input).val(index + 1);
        });

        $(this).on('mouseleave', function () {
            for (var i = 0; i <= rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline').addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline').removeClass('zmdi-star');
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/
    $('.js-show-modal1').on('click', function (e) {
        e.preventDefault();
        $('.js-modal1').addClass('show-modal1');
    });

    $('.js-hide-modal1').on('click', function () {
        $('.js-modal1').removeClass('show-modal1');
    });

    // Menggunakan jQuery untuk AJAX
// Menggunakan jQuery untuk AJAX dan swal bersamaan
$(document).on('click', '.add-btn, .js-addcart-detail', function (e) {
    e.preventDefault(); // Mencegah form submit default
    
    var form = $(this).closest('form'); // Ambil form terdekat
    var formData = form.serialize(); // Ambil data dari form
    var nameProduct = $(this).closest('.product-list').find('.name-product').html(); // Ambil nama produk

    $.ajax({
        url: form.attr('action'), // Ambil URL dari atribut action form
        method: form.attr('method'), // Ambil method dari form
        data: formData, // Kirim data dari form
        success: function (response) {
            if (response.success) {
                // Tampilkan swal untuk memberi tahu produk berhasil ditambahkan
                swal(nameProduct, "is added to cart!", "success");
        
                // Tambahkan class js-addedcart-detail untuk menandai produk sudah ditambahkan
                $(e.currentTarget).addClass('js-addedcart-detail');
                $(e.currentTarget).off('click'); // Matikan event klik agar tidak bisa ditambahkan dua kali
            } else {
                // Tampilkan swal untuk memberi tahu produk gagal ditambahkan
                swal('Error!', response.message || 'Failed to add product to cart.', 'error');
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            // Tampilkan swal untuk memberi tahu terjadi kesalahan
            swal('Error!', 'Error occurred: ' + xhr.responseText, 'error');
        }
        
    });
});


    $(".js-select2").each(function () {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    });

    $('.gallery-lb').each(function () { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });


})(jQuery);

document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter-button');
    const productItems = document.querySelectorAll('.isotope-item');

    // Fungsi untuk menyaring produk
    function filterProducts(filter) {
        console.log('Filter:', filter); // Lihat nilai filter yang digunakan
        productItems.forEach(item => {
            console.log('Item classes:', item.className); // Lihat kelas item produk
            if (filter === '*' || item.classList.contains(filter)) {
                item.classList.add('show');
                item.classList.remove('hide');
            } else {
                item.classList.remove('show');
                item.classList.add('hide');
            }
        });
    }

    // Menangani klik pada tombol filter
    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            const filter = this.getAttribute('data-filter');
            filterProducts(filter);
        });
    });

    // Inisialisasi tampilan produk
    filterProducts('*');

    // Tampilkan modal pertama atau produk tertentu (misalnya id=1)
    showModal(1);  // Ganti dengan ID produk yang diinginkan
});

function showModal(id) {
    // Sembunyikan semua modal
    document.querySelectorAll('.wrap-modal1').forEach(function (modal) {
        modal.style.display = 'none';
    });

    // Tampilkan modal yang sesuai
    document.getElementById('modal-' + id).style.display = 'block';
}

function changeImage(imageUrl, productId) {
    console.log('Changing image for product:', productId, 'to:', imageUrl); // Debugging
    var mainImage = document.getElementById('mainProductImage-' + productId);
    var mainLink = document.getElementById('mainProductLink-' + productId);

    if (mainImage && mainLink) {
        mainImage.src = imageUrl;
        mainLink.href = imageUrl;
    }
}

window.onload = function () {
    var modal = document.getElementById("successModal");
    var span = document.getElementsByClassName("close")[0];

    if (modal) {
        modal.style.display = "block";

        // Tutup modal otomatis setelah 3 detik (3000 ms)
        setTimeout(function () {
            modal.style.display = "none";
        }, 3000);

        // Tutup modal ketika tombol close diklik
        span.onclick = function () {
            modal.style.display = "none";
        }

        // Tutup modal ketika klik di luar modal
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
}

// Menampilkan popup
function showPopup() {
    var modal = document.getElementById("popupModal");
    modal.style.display = "flex"; // Menampilkan popup

    // Menyembunyikan popup setelah 3 detik
    setTimeout(function () {
        modal.style.display = "none"; // Menyembunyikan popup
    }, 3000);
}

// Menutup popup ketika tombol OK ditekan
document.getElementById("popupButton").onclick = function () {
    document.getElementById("popupModal").style.display = "none"; // Menyembunyikan popup
}

// Panggil showPopup() ketika halaman dimuat atau saat tertentu
window.onload = function () {
    showPopup(); // Tampilkan popup saat halaman dimuat
};

document.addEventListener('DOMContentLoaded', function () {
    // Ambil semua checkbox item
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const totalPriceElement = document.getElementById('total-price');

    // Tambahkan event listener ke setiap checkbox
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            updateTotalPrice();  // Panggil fungsi setiap kali checkbox berubah
        });
    });

    function updateTotalPrice() {
        let totalPrice = 0;

        // Iterasi setiap checkbox yang dicentang
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.getAttribute('data-price'));
                const quantity = parseInt(checkbox.getAttribute('data-quantity'));

                // Debugging
                console.log('Price:', price, 'Quantity:', quantity);

                // Hitung total harga
                totalPrice += price * quantity;
            }
        });

        // Debugging hasil total price
        console.log('Total Price:', totalPrice);

        // Update total harga di DOM
        if (totalPriceElement) {
            totalPriceElement.textContent = totalPrice.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });
        }
    }
});