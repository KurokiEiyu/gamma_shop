@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Keranjang')

@section('content')


@include('shop.modal.modal_cart')
@include('shop.modal.modal_wishlist')
@include('shop.layout.header')

<div>
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Troli
        </span>
    </div>
</div>
    
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Produk</th>
                                <th class="column-2"></th>
                                <th class="column-3">Harga</th>
                                <th class="column-4">Jumlah</th>
                                <th class="column-5">Total</th>
                            </tr>
                            @php $total_price = 0 @endphp
                            @foreach ($carts as $cart)
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset($cart->path_foto.'/'.$cart->id_produk.'_foto1.jpg') }}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2"><a href="{{ url('/product/'.$cart->id_produk) }}" class="cl3">{{ $cart->nama_produk }}</a></td>
                                <td class="column-3">Rp. {{ $cart->harga }}</td>
                                <td class="column-4">{{ $cart->qty }}</td>
                                <td class="column-5">Rp. {{ $cart->harga * $cart->qty }}</td>
                            </tr>
                            @php $total_price += ($cart->harga * $cart->qty) @endphp
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <form class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50" action="{{ route('shop.customer.checkout') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    @if ($errors->any())
                    <div class="p-tb-16 p-lr-24 bor10 m-b-12 alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                    @endif
                    <h4 class="mtext-109 cl2 p-b-30">
                        Metode Pembayaran
                    </h4>
                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-30">
                        <select class="js-select2" name="metode_pembayaran">
                            <option value="">Pilih...</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="Cash on Delivery">Bayar di Tempat</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <div class="dis-none rs1-select2 rs2-select2 bor8 bg0 m-b-30 rekening">
                        <select class="js-select2" name="rekening">
                            <option value="">Pilih Bank...</option>
                            @foreach ($rekenings as $rekening)
                                <option value="{{ $rekening->id_rekening }}">{{ $rekening->nama_bank }} - {{ $rekening->atas_nama }} - {{ $rekening->no_rekening }}</option>
                            @endforeach
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <div class="dis-none p-b-13 rekening-info">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Transfer Ke:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="stext-110 cl3">
                                <div>
                                    <span class="nama_bank"></span>
                                    <br>
                                    <span class="atas_nama">Atas Nama : </span>
                                    <br>
                                    <span class="no_rek">No. Rek: </span>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="dis-none bukti-transfer">
                        <span class="cl2">Bukti Transfer</span>
                        <input type="file" name="bukti_transfer" class="stext-111 cl8 plh3 size-111">
                    </div>
                    <hr>
                    <h4 class="mtext-109 cl2 p-b-30">
                        Total
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2 subtotal">
                                {{ $total_price }}
                            </span>
                        </div>
                    </div>

                    <!-- <div class="dis-none bor12 p-t-15 p-b-13 ongkir-container">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Ongkir:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                <input type="hidden" name="ongkir" value="0">
                                Rp. 8000
                            </span>
                        </div>
                    </div> -->

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Alamat Pengiriman:
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <div>
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="telepon" placeholder="Telepon">
                                </div>

                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" placeholder="Email (opsional)">
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <textarea class="stext-111 cl8 plh3 size-120 p-lr-15 p-tb-8" type="text" name="alamat" placeholder="Alamat Lengkap"></textarea>
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <textarea class="stext-111 cl8 plh3 size-120 p-lr-15 p-tb-8" type="text" name="catatan" placeholder="Catatan untuk penjual (opsional)"></textarea>
                                </div>                                    
                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2 total">
                                <input type="hidden" name="total_bayar" value="{{ $total_price }}">
                                <span>Rp. {{ $total_price }}</span>
                                <div class="stext-102 cl3">* Harga belum termasuk ongkir</div>
                                <div class="stext-102 cl3">* Untuk ongkir bisa hubungi penjual dibawah</div>
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <!-- <div class="size-208"> -->
                            <span class="mtext-101 cl2 p-b-16 bor12">
                                Kontak Penjual :
                            </span>
                            <span class="mtext-110 cl2 p-t-16">
                                @foreach ($contacts as $contact)
                                <a href="https://wa.me/{{ str_replace($contact->telepon[0], '62', $contact->telepon) }}" class="mtext-102 cl2 dis-block" target="_blank"><i class="fa fa-whatsapp"></i> {{  $contact->telepon }} ({{ $contact->nama_toko }})</a>
                                @endforeach
                            </span>
                        <!-- </div> -->

                        <!-- <div class="size-209 p-t-1 bor16 p-l-4">
                            
                        </div> -->
                    </div>

                    <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Lanjutkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@include('shop.layout.footer')

@endsection

@section('script')
<script>
    $('header').addClass('header-v4')

    $('select[name="metode_pembayaran"]').change(function() {
        if ($(this).val() === 'Transfer Bank') {
            $('.bukti-transfer').removeClass('dis-none');
            // $('.ongkir-container').addClass('dis-none').removeClass('flex-w flex-t')
            $('.rekening').removeClass('dis-none')
            // $('input[name="ongkir"]').val(0)
        } else {
            $('.bukti-transfer').addClass('dis-none');
            // $('.ongkir-container').removeClass('dis-none').addClass('flex-w flex-t')
            $('.rekening').addClass('dis-none')
            // $('input[name="ongkir"]').val(8000)
        }

        // $('input[name="total_bayar"]').val(Number($('.subtotal').text()) + Number($('input[name="ongkir"]').val()))
        // $('.total > span').text($('input[name="total_bayar"]').val())
    })

    $('select[name="rekening"]').change(function() {
        if ($(this).val() !== "") {
            $rekening_info = $(this).find('option:selected').text().split(" - ")
            $('.nama_bank').text($rekening_info[0])
            $('.atas_nama').text('Atas Nama: ' + $rekening_info[1])
            $('.no_rek').text('No. Rek: ' + $rekening_info[2])
            $('.rekening-info').removeClass('dis-none').addClass('flex-w flex-t')
        } else {
            $('.rekening-info').addClass('dis-none').removeClass('flex-w flex-t')
            $('.nama_bank, .atas_nama, .no_rek').text("")
        }
    })
</script>
@endsection