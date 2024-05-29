@extends('admin.layout.app')

@section('title', 'Permintaan Withdraw')

@section('content')
<div id="wrapper">
    @include('admin.layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('admin.layout.navbar')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Withdraw</h1>
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
                                                <th>Nama Bank</th>
                                                <th>Nama Pemilik Rekening</th>
                                                <th>No. Rekening</th>
                                                <th>Nominal</th>
                                                <th>Status</th>
                                                <th>Update</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach ($withdraws as $withdraw)
                                                <form action="{{ route('admin.data.withdraw.update') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_withdraw" value="{{ $withdraw->id_withdraw }}">
                                                    <input type="hidden" name="pelapak_id" value="{{ $withdraw->pelapak_id }}">
                                                    <input type="hidden" name="nominal" value="{{ $withdraw->nominal }}">
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $withdraw->nama_toko }}</td>
                                                        <td>{{ $withdraw->nama_pemilik }}</td>
                                                        <td>{{ $withdraw->nama_bank }}</td>
                                                        <th>{{ $withdraw->atas_nama }}</th>
                                                        <th>{{ $withdraw->no_rek_tujuan }}</th>
                                                        <td>{{ $withdraw->nominal }}</td>
                                                        <td>
                                                            <select name="status" class="form-control">
                                                                <option value="menunggu konfirmasi" {{ $withdraw->status === 'menunggu konfirmasi' ? 'selected' : '' }} >Menunggu Konfirmasi</option>
                                                                <option value="disetujui" {{ $withdraw->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
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
        if (i === 7) {
            $(e).addClass('active')
        }
    })
</script>
@endsection