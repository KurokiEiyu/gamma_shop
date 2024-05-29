@extends('shop.layout.app')

@section('title', env("APP_NAME"))

@section('content')

@include('shop.modal.modal_cart')
@include('shop.modal.modal_wishlist')
@include('shop.layout.header')

<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            <div class="item-slick1" style="background-image: url(/cs/images/FFXV.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div>
                            <span class="ltext-101 cl0 respon2">
                                 
                                <br>
                                <span class="cl0"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-slick1" style="background-image: url(/cs/images/PFFXV.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div>
                            <span class="ltext-101 cl0 respon2">
                                
                                <br>
                                <span class="cl0"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg0 p-t-50 p-b-140">
	<div class="container">
		<div class="p-b-10">
			<h3 class="ltext-103 cl5">
				Produk Terbaru
			</h3>
		</div>

		<div class="flex-w flex-sb-m p-b-52">
			<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
					Semua
				</button>

				@foreach ($categories as $category)
				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $category->id_kategori }}">
					{{ $category->nama_kategori }}
				</button>
				@endforeach
			</div>
		</div>

		@isset($products)
		<div class="row isotope-grid">
            @php $i = 0 @endphp
			@foreach ($products as $product)
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $product->kategori_id }}">
					@include('shop.layout.card_product', [
						'id' 	    => $product->id_produk,
						'img'	    => url($product->path_foto.$product->id_produk.'_foto1.jpg'),
						'name'	    => $product->nama_produk,
						'price'	    => $product->harga,
                        'ratings'   => round($ratings[$i])
					])
				</div>
                @php $i++ @endphp
			@endforeach
		</div>
		@endisset
	</div>
</section>

@include('shop.layout.footer')

@endsection

@section('script')
<script>
	$('.main-menu > li:first-child').addClass('active-menu')
</script>
@endsection