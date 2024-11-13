@extends('layout/app')

@section('contents')
        <div class="ms-1 mt-2 py-1 px-2 info-sec mb-4">
            <div>
                <h5 class="text-center info-txt mt-2">Battery Information</h5>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            {{-- <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1">
                        <h4>KAPASITAS</h4>
                    </div>

                    <div class="card-body">
                        <h2>  mAh</h2>
                    </div>
                </div>
            </div> --}}
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1">
                        <h4>TEGANGAN</h4>
                    </div>

                    <div class="card-body">
                        <span id="tegangan" class="auth-txt fs-2">0</span> <span class="auth-txt fs-2">V</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1">
                        <h4>ARUS</h4>
                    </div>

                    <div class="card-body">
                        <span id="arus" class="auth-txt fs-2"></span> <span class="auth-txt fs-2">A</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1">
                        <h4>DAYA</h4>
                    </div>

                    <div class="card-body">
                        <span id="daya" class="auth-txt fs-2"></span> <span class="auth-txt fs-2">W</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card rounded">
            <div class="card-header text-center fs-5 auth-txt">Grafik Data Baterai</div>
            <div class="card-body">
                <canvas id="myChart" width="1200" height="300"></canvas>

            </div>
        </div>

        <script type="text/javascript"> 
            $(document).ready(function(){
              setInterval(function() {
                $('#tegangan').load("{{ url('/battery/bacategangan') }}");
                $('#arus').load("{{ url('/battery/bacaarus') }}");
                $('#daya').load("{{ url('/battery/bacadaya') }}");
              }, 2000);
            });
          </script>
        
        <script> 
            var chartData = JSON.parse(`<?php echo $dataTg ?>`);
            console.log(chartData);
            var ctx = document.getElementById('myChart');
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.label ,
                datasets: [{
                label: "Tegangan",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: chartData.data1,
                },{
                label: "Arus",
                lineTension: 0.3,
                backgroundColor: "rgba(255,0,0,0.2)",
                borderColor: "rgba(255,0,0,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(255,0,0,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(200,0,0,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: chartData.data2,
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 10,
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });

            var updateChart = function(){
                $.ajax({
                url: "{{ route('api.chart') }}",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    myLineChart.data.labels = chartData.label;
                    myLineChart.data.datasets[0].data = chartData.data1;
                    myLineChart.data.datasets[1].data = chartData.data2;
                    myLineChart.update();
                },
                error: function(data){
                    console.log(data);
                }
                });
            }
            updateChart();
            setInterval(() => {
                updateChart();
            }, 2000);
            
        </script>
          {{-- <script>
            const grf = document.getElementById('myChart');

            new Chart(grf, {
                type : 'line',

            });
          </script> --}}
@endsection
