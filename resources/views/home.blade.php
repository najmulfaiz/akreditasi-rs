@extends('_main')

@section('content')
<style>
    .bullet-hijau {
        background-color: #009688;
    }
    .bullet-oranye {
        background-color: #F57C00;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="grafik_capaian" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
                    <table align="center">
                        <tr>
                            <td width="25px" class="bullet-hijau"></td>
                            <td width="20px" align="center">:</td>
                            <td>Tercapai</td>
                            <td width="25px"></td>
                            <td width="25px" class="bullet-oranye"></td>
                            <td width="20px" align="center">:</td>
                            <td>Belum Tercapai</td>
                        </tr>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 id="status"></h4>
                            <p class="text-default">
                                Kriteria Kelulusan : <br>
                                Semua bab skor >= 80% (min 80%)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="/assets/global/js/plugins/highcharts/code/highcharts.js"></script>
    <script src="/assets/global/js/plugins/highcharts/code/modules/exporting.js"></script>
    <script src="/assets/global/js/plugins/highcharts/code/modules/export-data.js"></script>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: '{{ route('home.capaian') }}',
                dataType: 'json',
                data: { },
                success: function(data) {
                    $('#status').html('Status : ' + data.status);
                    initGrafik(data.capaian);
                }, 
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        });

        function initGrafik(data) {
            Highcharts.chart('grafik_capaian', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafik Capaian Nilai Per Bab'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Persentase Nilai (%)'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Capaian nilai: <b>{point.y:.2f}%</b>'
                },
                series: [{
                    name: 'Capaian',
                    data: data,
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.2f}%', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }],
                plotOptions: {
                    column: {
                        zones: [{
                            value: 80,
                            color: '#F57C00'
                        },{
                            color: '#009688'
                        }]
                    }
                }
            });
        }
    </script>
@endsection