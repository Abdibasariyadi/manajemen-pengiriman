@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                    <div class="col-lg-3 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3>{{ \DB::table('pengiriman')->whereMonth('created_at',date('m'))->count() }}</h3>

                          <p>Total Pengiriman Bulan Ini</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3>{{ \DB::table('users')->where('role_id',7)->count() }}</h3>

                          <p>Jumlah Driver</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          {{-- <h3>{{ number_format(\DB::table('transaksis')->where('status_bayar',3)->whereMonth('tanggal',date('m'))->sum('grand_total_amount'),0) }}</h3> --}}
                          <h3>{{ number_format(\DB::table('pengiriman')->whereMonth('created_at',date('m'))->sum('dana_talangan'),0) }}</h3>

                          <p>Total Dana Talangan Bulan Ini</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-add"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ number_format(\DB::table('pengiriman')->whereMonth('created_at',date('m'))->sum('total_tagihan'),0) }}</h3>

                            <p>Pendapatan Bulan Ini</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
            </div>
        </div>
        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
    </div>
</div>

@endsection

@section('scripts')
{{-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script> --}}
{{-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}
<script type="text/javascript">
    $(document).ready(function(){

        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
    })

    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Pengiriman Per Bulan'
    },
    subtitle: {
        text: '-'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Barang'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} Barang</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Pengiriman',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

    }]
});
</script>


@endsection
