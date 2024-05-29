<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/fonts/linearicons-v1.0.0/WebFont/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/vendor/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/vendor/MagnificPopup/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/cs/css/main.css') }}">
    <style>
        .app-name {
            font-family: Poppins-Bold;
            color: #717FE0;
        }

        .app-name > span {
            color: #000;
        }

        .img-product {
            object-fit: cover;
        }
    </style>
    @yield('style')
</head>
<body class="animsition">

    <div class="app">
        @yield('content')
    </div>
    
    <script src="{{ asset('/cs/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/cs/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('/cs/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('/cs/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/cs/vendor/select2/select2.min.js') }}"></script>
    <script>
        $(".js-select2").each(function(){
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <script src="{{ asset('/cs/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('/cs/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('/cs/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('/cs/js/slick-custom.js') }}"></script>
    <script src="{{ asset('/cs/vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <script src="{{ asset('/cs/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $('.gallery-lb').each(function() {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled:true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <script src="{{ asset('/cs/vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('/cs/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.js-addwish-b2, .js-addwish-disable').on('click', function(e){
            e.preventDefault();
        });

        $('.js-addwish-disable, .js-addcart-disable').click(function() {
            swal('Opps', 'Silahkan login terlebih dahulu untuk menggunakan fitur ini', 'error')
        })

        $('.js-addwish-b2').each(function() {
            $(this).click(function() {
                let product_id 		= $(this).attr('product-id')
                let product_name	= $(this).attr('product-name')
                let product_price	= $(this).attr('product-price')

                $.ajax({
                    url: '{{ route("shop.customer.favorite.add") }}',
                    type: 'post',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'product_id': product_id
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            swal(product_name, "Berhasil ditambahkan ke favorit", "success");

                            let content = '';

                            response.data.forEach(function(i) {
                                content += `
                                    <li class="header-cart-item flex-w flex-t m-b-12">
                                        <div class="header-cart-item-img" favorit-id="${i.id_favorit}" product-name="${i.nama_produk}">
                                            <img src="{{ url('') }}/${i.path_foto}/${i.id_produk}_foto1.jpg" alt="IMG">
                                        </div>
                                        <div class="header-cart-item-txt p-t-8">
                                            <a href="/product/${i.id_produk}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                                ${i.nama_produk}
                                            </a>
                                            <span class="header-cart-item-info">}
                                                Rp. ${i.harga}
                                            </span>
                                        </div>
                                    </li>
                                    `
                            })

                            $('.js-panel-wishlist').find('.header-cart-wrapitem').html(content)
                            $('.js-show-wishlist').attr('data-notify', Number($('.js-show-wishlist').attr('data-notify')) + 1)
                        } else {
                            swal(product_name, "Produk sudah ada di favorit", "error");
                        }
                    }
                })
            })
        })
    </script>
    <script src="{{ asset('/cs/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function(){
            $(this).css('position','relative');
            $(this).css('overflow','hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function(){
                ps.update();
            })
        });
    </script>
	<script src="{{ asset('/cs/js/main.js') }}"></script>
    <script>
        $('.disabled').on('click', function(e) {
            e.preventDefault()
        })

        $('.js-show-wishlist').on('click',function(){
            $('.js-panel-wishlist').addClass('show-header-cart');
        });

        $('.js-hide-wishlist').on('click',function(){
            $('.js-panel-wishlist').removeClass('show-header-cart');
        });

        $('.js-panel-wishlist').on('click', '.header-cart-item-img', function() {
            let id_favorit      = $(this).attr('favorit-id')
            let product_name    = $(this).attr('product-name')

            $.ajax({
                url: '{{ route("shop.customer.favorite.delete") }}',
                type: 'post',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id_favorit': id_favorit
                },
                success: function(response) {
                    if (response.status === 'success') {
                        swal(product_name, "Berhasil menghapus item dari favorit", "success");

                        let content = '';

                        response.data.forEach(function(i) {
                            content += `
                                <li class="header-cart-item flex-w flex-t m-b-12">
                                    <div class="header-cart-item-img" favorit-id="${i.id_favorit}" product-name="${i.nama_produk}">
                                        <img src="{{ url('') }}/${i.path_foto}/${i.id_produk}_foto1.jpg" alt="IMG">
                                    </div>
                                    <div class="header-cart-item-txt p-t-8">
                                        <a href="/product/${i.id_produk}')" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                            ${i.nama_produk}
                                        </a>
                                        <span class="header-cart-item-info">
                                            Rp. ${i.harga}
                                        </span>
                                    </div>
                                </li>
                                `
                        })

                        $('.js-panel-wishlist').find('.header-cart-wrapitem').html(content)
                        $('.js-show-wishlist').attr('data-notify', Number($('.js-show-wishlist').attr('data-notify')) - 1)
                    } else {
                        swal(product_name, "Gagal menghapus item", "error");
                    }
                }
            })
        })

        $('.js-panel-cart').on('click', '.header-cart-item-img', function() {
            let id_cart         = $(this).attr('cart-id')
            let product_name    = $(this).attr('product-name')

            $.ajax({
                url: '{{ route("shop.customer.cart.delete") }}',
                type: 'post',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id_cart': id_cart
                },
                success: function(response) {
                    if (response.status === 'success') {
                        swal(product_name, "Berhasil menghapus item dari troli", "success");

                        let content = '';

                        response.data.forEach(function(i) {
                            content += `
                            <li class="header-cart-item flex-w flex-t m-b-12">
                                <div class="header-cart-item-img" cart-id="${i.id_keranjang}" product-name="${i.nama_produk}">
                                    <img src="{{ url('') }}/${i.path_foto}/${i.id_produk}_foto1.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt p-t-8">
                                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                        ${i.nama_produk} (${i.ukuran_terpilih}) }}
                                    </a>

                                    <span class="header-cart-item-info">
                                        ${i.qty} x Rp. ${i.harga}
                                    </span>
                                </div>
                            </li>`
                        })

                        $('.js-panel-cart').find('.header-cart-wrapitem').html(content)
                        $('.js-show-cart').attr('data-notify', response.total_cart)
                    } else {
                        swal(product_name, "Gagal menghapus item", "error");
                    }
                }
            })
        })

        $('.img-product').each(function() {
            let width = $(this).width();
            $(this).css({
                height: width + 'px'
            })
        })

        let containerMinHeight = $(window).height() - ($('footer').height() + $('header').height());

        $('header').next().css({
            'min-height': containerMinHeight
        })
    </script>
	@yield('script')
</body>
</html>