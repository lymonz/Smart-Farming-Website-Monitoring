@extends('layout.app')



@section('contents')
<div class="ms-1 mt-2 info-sec mb-4">
    <div>
        <h5 class="text-center info-txt mt-2">Sensor THM-30D</h5>
    </div>
</div>

<div class="ms-1 content-1 bg-transparent" id="here">
    <div class="row row-cols-1 row-cols-md-4 justify-content-around">
        <div class="col bg-transparent ms-1">
            <div class="form-floating mb-3">
                <select name="device" id="device" class="form-select bg-light rounded">
                    <option value="" selected class="rounded">--Pilih Device--</option>
                    @foreach ($dataDevice as $item)
                        <option value="{{ $item->token }}" class="rounded">{{ $item->nama_device }}</option>
                    @endforeach
                </select>
                <label for="device">Device</label>
            </div>
        </div>

        <div class="col bg-transparent ms-1">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="kode_device" id="kodeDevice" placeholder="DVC-XXX" readonly>
                    <label for="kodeDevice">Kode Device</label>
            </div>
        </div>
    </div>
</div>


<div class="data" id="dataKosong">
    <h1 class="info-txt">Device Tidak Memiliki Data Sensor THM-30D</h1>
</div>

<div class="card-body bg-transparent border-0 mb-3" id="dataThm30d">
    <div class="row row-cols-1 row-cols-md-4 row-cols-lg-4 justify-content-center">
        <div class="col">
            <div class="card mb-4 rounded shadow-sm">
                <div class="card-header py-1 text-center">
                    <p class="card-title"><b>SUHU</b></p>
                </div>

                <div class="card-body text-center">
                    <span id="temp-thm" class="auth-txt">0</span> <span class="auth-txt"><sup>o</sup>C</span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">SENSOR THM-30D</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded shadow-sm">
                <div class="card-header py-1 text-center">
                    <p class="card-title"><b>KELEMBABAN UDARA</b></p>
                </div>

                <div class="card-body text-center">
                    <span id="klb-udr" class="auth-txt">0</span> <span class="auth-txt">%</span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">SENSOR THM-30D</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded shadow-sm">
                <div class="card-header py-1 text-center">
                    <p class="card-title"><b>BATTERY</b></p>
                </div>

                <div class="card-body text-center">
                    <span id="bat-thm" class="auth-txt">0</span> <span class="auth-txt">mA</span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">SENSOR THM-30D</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card rounded">
        <div class="card-header text-center fs-5 auth-txt">Grafik Data Sensor THM-30D</div>
        <div class="card-body">
             <canvas id="chartThm30d" width="750" height='200' style="background-color: rgba(0, 0, 0, .7);display:none"></canvas> 
        </div>
    </div>
</div>

<script> 
    $(document).ready(function(){
        var interval;
        $('#device').on('change', function(){
            var token = $(this).val();
            console.log(token);
            if (interval){
                clearInterval(interval);
            }
            if(token){
                getKodeDevice(token);
                getDataThm30d(token);
                $('#chartThm30d').fadeIn(500);
                interval = setInterval(function(){
                    getKodeDevice(token);
                    getDataThm30d(token);
                },5000);
            } else {
                    $('#kodeDevice').val('');
                    $('#chartThm30d').fadeOut(500);

            }
        });

        function getKodeDevice(token){
                if(token){
                    $.ajax({
                        url: '/dashboardMonitoring/' + token,
                        method: 'GET',
                        data: 'token=' + token,
                        dataType: 'json',
                        success: function(data) {
                            if(data.dvc.length>0){
                                $('#kodeDevice').val(data.dvc[0].kode_device);
                            } else {
                                $('#kodeDevice').val('');
                            }
                            console.log(data);
                        }
                    });
                }
        }
        function getDataThm30d(token){
                if(token){
                    $.ajax({
                        url: '/dashboardMonitoring/' + token,
                        method: 'GET',
                        data: 'token=' + token,
                        dataType: 'json',
                        success:function(data){
                            if(data.thm30d.length>0){
                                $('#klb-udr').html(data.thm30d[0].kelembaban_udara);
                                $('#temp-thm').html(data.thm30d[0].temperature);
                                $('#bat-thm').html(data.thm30d[0].battery);
                                renderChartThm(data.thm30d);
                                $('#dataThm30d').fadeIn(500);
                                $('#dataKosong').fadeOut(500);
                            } else {
                                $('#dataThm30d').fadeOut(500);
                                $('#dataKosong').fadeIn(500);
                            }
                        }
                    });
                }
        }
        let chartThm30d;
        function renderChartThm(thmData){
            const ctx=document.getElementById('chartThm30d').getContext('2d');
            
            if(chartThm30d){
                chartThm30d.destroy();
            }
            const chartData={
                labels:thmData.map(entry => (entry.created_at)),
                    datasets:[{
                        label:'Suhu',
                        data : thmData.map(entry=>entry.temperature),
                        lineTension: 0.5,
                        backgroundColor: "rgba(255,0,0,0.2)",
                        borderColor: "rgba(255,0,0,1)",
                        borderWidth:1,
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(255,0,0,1)",
                        pointBorderColor: "rgba(255,0,0,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(255,0,0,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        fill:'start',
                    },{
                        label:'Kelembaban Udara',
                        data : thmData.map(entry=>entry.kelembaban_udara),
                        lineTension: 0.5,
                        backgroundColor: "rgba(2,117,216,0.5)",
                        borderColor: "rgba(2,117,216,1)",
                        borderWidth:1,
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(2,117,216,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        fill:'-1',
                    }],
            }
            chartThm30d = new Chart(ctx, {
                type:'line',
                data:chartData,
                options: {
                    responsive:true,
                    scales: {
                        x:{
                            grid:{
                                color:'rgba(255,255,255,0.5)'
                            },
                            ticks:{
                                color:'white'
                            },
                            display:true,
                            title:{
                                display:true,
                                text:'Timestamp',
                                color:'white'
                            },
                        },
                        y: {
                            grid:{
                                color:'rgba(255,255,255,0.5)'
                            },
                            ticks:{
                                color:'white'
                            },
                            stacked: false,
                            title:{
                                display:true,
                                text:'Value',
                                color:'white'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: 'white'  // Change label color here
                            }
                        },
                        // customCanvasBackgroundColor: {
                        //     color: 'lightGreen',
                        // },
                        // legend:{
                        //     label:{
                        //         font:{
                        //             color:'white',
                        //         }
                        //     }
                        // },
                        filler: {
                            propagate: false
                        },
                        'samples-filler-analyser': {
                            target: 'chart-analyser'
                        },
                        
                    },
                    interaction: {
                        intersect: false,
                    },
                },
            });
        }
        
    });
</script>
@endsection