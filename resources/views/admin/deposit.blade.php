@extends('admin.layout.app')

@section('title', 'Permintaan Deposit')

@section('content')
<div id="wrapper">
    @include('admin.layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('admin.layout.navbar')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Deposit</h1>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Database</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Toko</th>
                                                <th>Nama Pemilik</th>
                                                <th>Nominal</th>
                                                <th>Bukti Transfer</th>
                                                <th>Status</th>
                                                <th>Update</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach ($deposits as $deposit)
                                                <form action="{{ route('admin.data.deposit.update') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_deposit" value="{{ $deposit->id_deposit }}">
                                                    <input type="hidden" name="pelapak_id" value="{{ $deposit->pelapak_id }}">
                                                    <input type="hidden" name="nominal" value="{{ $deposit->nominal }}">
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $deposit->nama_toko }}</td>
                                                        <td>{{ $deposit->nama_pemilik }}</td>
                                                        <td>{{ $deposit->nominal }}</td>
                                                        <td>
                                                            <a href="{{ asset($deposit->bukti_transfer) }}" target="_blank">
                                                                <img src="{{ asset($deposit->bukti_transfer) }}" alt="BUKTI TRANSFER" style="width: 100px; height: 100px; object-fit: cover;">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <select name="status" class="form-control">
                                                                <option value="menunggu konfirmasi" {{ $deposit->status === 'menunggu konfirmasi' ? 'selected' : '' }} >Menunggu Konfirmasi</option>
                                                                <option value="diterima" {{ $deposit->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i></button>
                                                        </td>
                                                    </tr>
                                                </form>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layout.footer')
        </div>
    </div>
</div>
@include('admin.layout.scroll_to_top')
@endsection

@section('script')
<script>
    $('body').attr('id', 'page-top')

    $('ul.sidebar').find('li').each(function(i, e) {
        if (i === 6) {
            $(e).addClass('active')
        }
    })
</script>
@endsection