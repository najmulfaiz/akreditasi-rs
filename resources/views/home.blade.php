@extends('_main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="grafik_capaian" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
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
                    initGrafik(data);
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
                    pointFormat: 'Capaian nilai: <b>{point.y:.1f} %</b>'
                },
                series: [{
                    name: 'Capaian',
                    data: data,
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.2f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });
        }
    </script>
@endsection