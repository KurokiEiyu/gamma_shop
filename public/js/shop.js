$('.js-addwish-b2').each(function() {
$(this).click(function() {
    let product_id 		= $(this).attr('product-id')
    let product_name	= $(this).attr('product-name')
    let product_price	= $(this).attr('product-price')

    $.ajax({
        url: 'http://localhost:8000/customer/favorite/add',
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
                                <img src="http://localhost:8000/${i.path_foto}/product-01.jpg" alt="IMG">
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
                $('.js-show-wishlist').attr('data-notify', Number($('.js-show-wishlist').attr('data-notify')) + 1)
            } else {
                swal(product_name, "Produk sudah ada di favorit", "error");
            }
        }
    })
})
})