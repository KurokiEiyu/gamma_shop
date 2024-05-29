<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link href="{{ asset('/sb_admin_2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .text-black {
            color: #000;
        }

        table td {
            color: #000;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row py-5 border-bottom">
            <div class="col-12">
                <h1 class="text-center text-black">Laporan</h1>
            </div>
        </div>
        <div class="row border-bottom py-5">
            <table>
                <tbody>
                    <tr>
                        <td class="pr-5">Nama Toko</td>
                        <td>:</td>
                        <td class="pl-5">{{ $store->nama_toko }}</td>
                    </tr>
                    <tr>
                        <td class="pr-5">Nama Pemilik</td>
                        <td>:</td>
                        <td class="pl-5">{{ $store->nama_pemilik }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row py-5 border-bottom">
            <div class="col-12 col-md-6 my-2">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h3>Produk</h3>
                        <h1>{{ count($products) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 my-2">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h3>Produk Terjual</h3>
                        <h1>{{ $terjual }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 my-2">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h3>Stok Gudang</h3>
                        <h1>{{ $stok }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 my-2">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h3>Pendapatan</h3>
                        <h1>Rp. {{ $pendapatan }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-5">
            <div class="chart-area">
                <canvas id="diagram-pendapatan"></canvas>
            </div>
        </div>
    </div>

    @php
    $bulan_list = "";
    $data_list  = "";

    foreach ($chart_2 as $item)
    {
        $bulan_list .= '"'.$item['bulan'].'",';
        $data_list  .= $item['data'].',';
    }
    @endphp
    
    <script src="{{ asset('/sb_admin_2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/sb_admin_2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/sb_admin_2/vendor/chart.js/Chart.min.js') }}"></script>
    <script>
        var ctx         = document.getElementById('diagram-pendapatan');
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@php echo $bulan_list @endphp],
                datasets: [{
                    label: 'Pendapatan per Bulan',
                    backgroundColor: '#E74A3B',
                    data: [@php echo $data_list @endphp]
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0
                        }
                    }]
                }
            }
        });

        window.print()
    </script>
</body>
</html>