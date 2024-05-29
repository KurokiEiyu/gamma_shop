@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Shop')

@section('content')

@include('shop.modal.modal_cart')
@include('shop.modal.modal_wishlist')
@include('shop.layout.header')

<div class="bg0 m-t-23 p-b-140">
    <div class="container">
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
</div>

@include('shop.layout.footer')
@endsection

@section('script')
<script>
    $('header').addClass('header-v4');
	$('.wrap-menu-desktop').addClass('how-shadow1');
	$('.main-menu > li:nth-child(2)').addClass('active-menu')
</script>
@endsection