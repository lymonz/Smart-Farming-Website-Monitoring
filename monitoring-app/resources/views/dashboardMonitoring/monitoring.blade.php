@extends('layout/app')

@section('contents')

        <div class="ms-1 mt-2 py-1 px-2 info-sec mb-3">
            <div>
                <h5 class="text-center info-txt mt-2">Monitoring Dashboard</h5>
            </div>
        </div>

        <div class="card shadow mb-2 w-100 bg-transparent" id="myDiv3">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" value="{{ $dataDashboard->device['nama_device'] }}" name="kode" id="floatingInput" placeholder="DVC-XXX" readonly>
                    <label for="floatingInput">Nama Device</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $dataDashboard->kode_dashboard }}" name="kode" id="floatingInput" placeholder="DVC-XXX" readonly>
                        <label for="floatingInput">Kode Dashboard</label>
                    </div>
                </div>

            </div>
            {{--  --}}
            <div class="row row-cols-1 row-cols-md-5 row-cols-lg-5 mb-3" id="myDiv1">
                
                <div class="col">
                    <div class="card mb-4 rounded shadow-sm">
                        <div class="card-header py-1 text-center">
                            <p class="card-title"><b>KELEMBABAN TANAH</b></p>
                        </div>

                        <div class="card-body text-center">
                            <span id="klb-tnh" class="auth-txt">{{ $dataDashboard->sensorThigrow['kelembaban_tanah'] }}</span> <span class="auth-txt">%</span>
                        </div>

                        <div class="card-footer text-center">
                            <small class="text-muted">SENSOR TT-HIGROW</small>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card mb-4 rounded shadow-sm">
                        <div class="card-header py-1 text-center">
                            <p class="card-title"><b>KELEMBABAN UDARA</b></p>
                        </div>

                        <div class="card-body text-center">
                            <span id="klb-tnh" class="auth-txt">{{ $dataDashboard->sensorThigrow['kelembaban_udara'] }}</span> <span class="auth-txt">%</span>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-muted">SENSOR TT-HIGROW</small>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card mb-4 rounded shadow-sm">
                        <div class="card-header py-1 text-center">
                            <p class="card-title"><b>SUHU</b></p>
                        </div>

                        <div class="card-body text-center">
                            <span id="klb-tnh" class="auth-txt">{{ $dataDashboard->sensorThigrow['temperature'] }}</span> <span class="auth-txt"><sup>o</sup>C</span>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-muted">SENSOR TT-HIGROW</small>
                        </div>
                    </div>
                </div>

            
                    <div class="col">
                        <div class="card mb-4 rounded shadow-sm">
                            <div class="card-header py-1 text-center">
                                <p class="card-title"><b>TEKANAN UDARA</b></p>
                            </div>
    
                            <div class="card-body text-center">
                                <span id="tkn_udr_bmp" class="auth-txt">{{ $dataDashboard->sensorBmp['tekanan_udara'] }}</span> <span class="auth-txt">mb</span>
                            </div>
                            <div class="card-footer text-center">
                                <small class="text-muted">SENSOR BMP-180</small>
                            </div>
                        </div>
                    </div>
            
            
                    <div class="col">
                        <div class="card mb-4 rounded shadow-sm">
                            <div class="card-header py-1 text-center">
                                <p class="card-title"><b>SUHU</b></p>
                            </div>
    
                            <div class="card-body text-center">
                                <span id="suhu_bmp" class="auth-txt">{{ $dataDashboard->sensorBmp['temperature'] }}</span> <span class="auth-txt"><sup>o</sup>C</span>
                            </div>
                            <div class="card-footer text-center">
                                <small class="text-muted">SENSOR BMP-180</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-lg-5 justify-content-center mb-3" id="myDiv2">
                    <div class="col">
                        <div class="card mb-4 rounded shadow-sm">
                            <div class="card-header py-1 text-center">
                                <p class="card-title"><b>SUHU</b></p>
                            </div>
    
                            <div class="card-body text-center">
                                <span id="klb-tnh" class="auth-txt">{{ $dataDashboard->sensorThm30d['temperature'] }}</span> <span class="auth-txt"><sup>o</sup>C</span>
                            </div>
                            <div class="card-footer text-center">
                                <small class="text-muted">SENSOR THM-30D</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4 rounded shadow-sm">
                            <div class="card-header py-1 text-center">
                                <p class="card-title"><b>TEKANAN UDARA</b></p>
                            </div>
    
                            <div class="card-body text-center">
                                <span id="klb-tnh" class="auth-txt">{{ $dataDashboard->sensorThm30d['tekanan_udara'] }}</span> <span class="auth-txt">mb</span>
                            </div>

                            <div class="card-footer text-center">
                                <small class="text-muted">SENSOR THM-30D</small>
                            </div>
                        </div>
                    </div>  
                </div>

                <div class="card-header text-center fs-5 py-1">
                    GRAFIK DATA SENSOR
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="card-header">
                                <i class="bi bi-graph-up-arrow"></i>
                                <p class="text-center">
                                    Grafik Data Sensor BMP-180
                            </p> 
                                <canvas id="myCharts1" width="100%" height="40"></canvas>
                            </div>
                        </div>

                        <div class="col-xl-5">
                            <div class="card-header">
                                <i class="bi bi-graph-up-arrow"></i>
                                <p class="text-center">
                                    Grafik Data Sensor TT-Higrow
                            </p> 
                                <canvas id="myCharts2" width="100%" height="40"></canvas>
                            </div>
                        </div>


                    </div>
                    {{-- <canvas id="myCharts" height="300" width="500" ></canvas> --}}
                </div>

            </div>
            <script type="text/javascript">
            var chartData = JSON.parse(`<?php echo $dataSensor ?>`);
            console.log(chartData);
            var chartData2 = JSON.parse(`<?php echo $dataSensor2 ?>`);
            console.log(chartData2);
            var ctx = document.getElementById('myCharts1');
            var ctx2 = document.getElementById('myCharts2');
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.label ,
                datasets: [{
                label: "Temperature",
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
                data: chartData.data2,
                },{
                label: "Tekanan Udara",
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
                data: chartData.data1,
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
            var myLineChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: chartData2.label ,
                datasets: [{
                label: "Kelembaban Udara",
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
                data: chartData2.data1,
                },{
                label: "Kelembaban Tanah",
                lineTension: 0.3,
                backgroundColor: "rgba(0,255,0,0.2)",
                borderColor: "rgba(0,255,0,1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(0,255,0,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(0,200,0,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: chartData2.data2,
                },{
                label: "Suhu",
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
                data: chartData2.data3, 
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
            </script>

            {{-- <script type="text/javascript">
               $(document).ready(function(){
                 setInterval(function() {
                    $('#tkn_udr_bmp').load("{{  }}");
                 }, 2000);
               });
            </script> --}}
                
                {{--  --}}
                {{-- <div class="col">
                    <div class="card mb-4 rounded shadow-sm">
                        <div class="card-header py-1 text-center">
                            <p class="card-title"><b>KELEMBABAN TANAH</p>
                        </div>

                        <div class="card-body text-center">
                            <span id="klb-tnh" class="auth-txt">0</span> <span class="auth-txt">RH</span>
                        </div>
                    </div>
                </div> --}}
                {{--  --}}

                {{--  --}}
                {{-- <div class="col">
                    <div class="card mb-4 rounded shadow-sm">
                        <div class="card-header py-1 text-center">
                            <p class="card-title">KELEMBABAN UDARA</p>
                        </div>

                        <div class="card-body text-center">
                            <span id="klb-tnh" class="auth-txt">0</span> <span class="auth-txt">%</span>
                        </div>
                    </div>
                </div> --}}
                {{--  --}}


            
            {{--  --}}


        



@endsection







{{-- <div class="mt-2 info-sec mb-4">
    
    <div class="form-floating mb-3">
        <input type="text" class="form-control" value="{{ $dataDashboard->device['nama_device'] }}" name="kode" id="floatingInput" placeholder="DVC-XXX" readonly>
        <label for="floatingInput">Nama Device</label>
    </div>

  
    <div class="form-floating mb-3">
        <input type="text" class="form-control" value="{{ $dataDashboard->kode_dashboard }}" name="kode" id="floatingInput" placeholder="DVC-XXX" readonly>
        <label for="floatingInput">Kode Dashboard</label>
    </div>


    <div class="card mb-3">
        <div class="ms-1 mt-2 row row-cols-1 row-cols-md5 mb-3 text-center">
    
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1">
                        <p><b>KELEMBABAN TANAH</p>
                    </div>
                    <div class="card-body">
                        <span id="klb-tnh-1" class="auth-txt">0</span> <span class="auth-txt">Rh</span>
                    </div>
                </div>
            </div>
    

    
             <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1">
                        <p><b>KELEMBABAN UDARA</p>
                    </div>
                    <div class="card-body">
                        <span id="klb-tnh-1" class="auth-txt">0</span> <span class="auth-txt">%</span>
                    </div>
                </div>
            </div>
    
            
        </div>        
    </div>

</div> --}}
