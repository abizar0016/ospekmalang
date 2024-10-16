    <!--===============================================================================================-->
    <script src="{{ url('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ url('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ url('vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ url('vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('vendor/slick/slick.min.js') }}"></script>
    <script src="js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script src="{{ url('vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="{{ url('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ url('vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        // Menangani klik pada tombol tambah ke wishlist
        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function(e) {
                e.preventDefault();
                swal(nameProduct, "is added to wishlist!", "success");
                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });
    
        // Menangani klik pada tombol tambah ke wishlist di detail produk
        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist!", "success");
                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });
    
        // Menangani klik pada tombol tambah ke keranjang
        $('.js-addcart-detail').each(function() {
            var nameProduct = $(this).closest('.product-list').find('.name-product').html();
            $(this).on('click', function(e) {
                e.preventDefault(); // Mencegah formulir dikirim langsung
    
                // Tampilkan SweetAlert
                swal({
                    title: nameProduct,
                    text: "is added to cart!",
                    icon: "success",
                    button: "OK",
                }).then(() => {
                    // Kirim formulir setelah pengguna menekan tombol OK
                    $(this).closest('form').submit();
                });
            });
        });
    </script>
    
    <!--===============================================================================================-->
    <script src="{{ url('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ url('js/main.js') }}"></script>
    <script src="{{ url('js/sekerip.js') }}"></script>
</body>

</html>