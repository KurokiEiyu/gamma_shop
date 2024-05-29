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
        <div class="row py-5 border-bottom">
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h3>Pembeli</h3>
                        <h1>{{ $jumlah_pembeli }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h3>Pelapak</h3>
                        <h1>{{ $jumlah_pelapak }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h3>Produk</h3>
                        <h1>{{ $jumlah_produk }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h3>Transaksi</h3>
                        <h1>{{ $jumlah_transaksi }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 my-2">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <h3>Pendapatan Hari Ini</h3>
                        <h1>Rp. {{ $pendapatan_hari_ini }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 my-2">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h3>Pendapatan Bulan Ini</h3>
                        <h1>Rp. {{ $pendapatan_bulan_ini }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-5">
            <div class="chart-area">
                <canvas id="diagram-pendapatan"></canvas>
            </div>
        </div>
        <div class="row py-5">
            <div class="chart-area">
                <canvas id="diagram-transaksi"></canvas>
            </div>
        </div>
        <div class="row py-5">
            <div class="chart-area">
                <canvas id="diagram-volume"></canvas>
            </div>
        </div>
    </div>

    @php
    $bulan_list     = "";
    $transaksi_data = "";
    $volume_data    = "";
    foreach($data_chart as $data)
    {
        $bulan_list     .= '"'.$data['bulan'].'",';
        $transaksi_data .= $data['transaksi'].',';
        $volume_data    .= $data['volume'].',';
    }

    $bulan_list_2 = "";
    $data_list_2  = "";

    foreach ($chart_2 as $item)
    {
        $bulan_list_2 .= '"'.$item['bulan'].'",';
        $data_list_2  .= $item['data'].',';
    }
    @endphp
    
    <script src="{{ asset('/sb_admin_2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/sb_admin_2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/sb_admin_2/vendor/chart.js/Chart.min.js') }}"></script>
    <script>
        var ctxTransaksi    = document.getElementById('diagram-transaksi')
        var chartTransaksi  = new Chart(ctxTransaksi, {
            type: 'bar',
            data: {
                labels: [@php echo $bulan_list @endphp],
                datasets: [{
                    label: 'Jumlah Transaksi Per Bulan',
                    backgroundColor: "#4e73df",
                    data: [@php echo $transaksi_data @endphp]
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks:{
                            min: 0
                        }
                    }]
                }
            }
        })

        var ctxVolume       = document.getElementById('diagram-volume')
        var chartVolume     = new Chart(ctxVolume, {
            type: 'bar',
            data: {
                labels: [@php echo $bulan_list @endphp],
                datasets: [{
                    label: 'Volume Transaksi Per Bulan',
                    backgroundColor: "#59C98A",
                    data: [@php echo $volume_data @endphp]
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks:{
                            min: 0
                        }
                    }]
                }
            }
        })

        var ctx         = document.getElementById('diagram-pendapatan');
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@php echo $bulan_list_2 @endphp],
                datasets: [{
                    label: 'Pendapatan per Bulan',
                    backgroundColor: '#E74A3B',
                    data: [@php echo $data_list_2 @endphp]
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

        window.print();
    </script>
</body>
</html>