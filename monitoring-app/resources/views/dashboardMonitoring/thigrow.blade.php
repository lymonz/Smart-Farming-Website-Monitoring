@extends('layout.app')

@section('contents')
<div class="ms-1 mt-2 info-sec mb-4">
    <div>
        <h5 class="text-center info-txt mt-2">Sensor T-HIGROW</h5>
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
    <h1 class="info-txt">Device Tidak Memiliki Data Sensor T-Higrow</h1>
</div>

<div class="card bg-transparent border-0 mb-3" id="dataThigrow">
    
    <div class="card-body">
        <div class="row row-cols-1 row-cols-md-4 row-cols-lg-4 justify-content-center">
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1 text-center">
                        <p class="card-title title-txt"><b>SUHU</b></p>
                    </div>

                    <div class="card-body text-center">
                        <span id="suhu-thigrow" class="auth-txt">0</span> <span class="auth-txt"><sup>o</sup>C</span>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">SENSOR TT-HIGROW</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1 text-center">
                        <p class="card-title title-txt"><b>KELEMBABAN UDARA</b></p>
                    </div>

                    <div class="card-body text-center">
                        <span id="klb-udr-thigrow" class="auth-txt">0</span> <span class="auth-txt">%</span>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">SENSOR TT-HIGROW</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1 text-center">
                         <p class="card-title title-txt"><b>KELEMBABAN TANAH</b></p>
                    </div>

                    <div class="card-body text-center">
                        <span id="klb-tnh-sm" class="auth-txt">0</span> <span class="auth-txt">%</span>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">SENSOR SOIL MOISTURE</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1 text-center">
                        <p class="card-title title-txt"><b>KELEMBABAN TANAH</b></p>
                    </div>

                    <div class="card-body text-center">
                        <span id="klb-tnh-th" class="auth-txt">0</span> <span class="auth-txt">%</span>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">SENSOR TT-HIGROW</small>
                    </div>
                </div>
            </div>
            
            
        </div>
        <div class="row row-cols-1 row-cols-md-4 row-cols-lg-4 justify-content-center">
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1 text-center">
                        <p class="card-title title-txt"><b>INTENSITAS CAHAYA</b></p>
                    </div>
                
                    <div class="card-body text-center">
                        <span id="cahaya-thigrow" class="auth-txt">0</span> <spa    class="auth-txt"></span>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">SENSOR TT-HIGROW</small>
                    </div>
                </div>
            </div>
            <div class="col w-25">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1 text-center">
                        <p class="card-title title-txt"><b>BATTERY</b></p>
                    </div>

                    <div class="card-body text-center">
                        <span id="bat-th" class="auth-txt">0</span> <span class="auth-txt"></span>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">Max Capacity 3600mA <br>
                        SENSOR TT-HIGROW</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded shadow-sm">
                    <div class="card-header py-1 text-center">
                        <p class="card-title title-txt"><b>KADAR GARAM</b></p>
                    </div>

                    <div class="card-body text-center">
                        <span id="kad-gar" class="auth-txt">0</span> <span class="auth-txt"></span>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">SENSOR TT-HIGROW</small>
                    </div>
                </div>
            </div>

        </div>
            <div class="card rounded">
                <div class="card-header text-center fs-5 auth-txt">Grafik Data Sensor T-HIGROW</div>
                <div class="card-body canvas-container">
                    <canvas id="thigrowChart1" width="700" height="200" class="canvas-style" style="display: none"></canvas>
                </div>
            </div>
    </div>
</div>

<script type="text/javascript"> 
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
                getDataThigrow(token);
                $('#thigrowChart1').fadeIn(500);
                interval = setInterval(function(){
                    getKodeDevice(token);
                    getDataThigrow(token);
                },5000);
            } else {
                    $('#kodeDevice').val('');

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
        function getDataThigrow(token){
            if(token){
                $.ajax({
                    url: '/dashboardMonitoring/' + token,
                    method: 'GET',
                    data: 'token=' + token,
                    dataType: 'json',
                    success:function(data){
                        if(data.thigrow.length>0){
                            $('#klb-tnh-sm').html(data.thigrow[0].kelembaban_tanah_sm);
                            $('#klb-tnh-th').html(data.thigrow[0].kelembaban_tanah_th);
                            $('#suhu-thigrow').html(data.thigrow[0].temperature);
                            $('#klb-udr-thigrow').html(data.thigrow[0].kelembaban_udara);
                            $('#bat-th').html(data.thigrow[0].battery);
                            $('#kad-gar').html(data.thigrow[0].kadar_garam);
                            $('#cahaya-thigrow').html(data.thigrow[0].i_cahaya);
                            renderChartThigrow(data.thigrow);
                            $('#dataKosong').fadeOut(500);
                            $('#dataThigrow').fadeIn(500);
                        } else{
                            $('#thigrowChart1').fadeOut(500);
                            $('#dataThigrow').fadeOut(500);
                            $('#dataKosong').fadeIn(500);
                            // renderChartThigrow().destroy();
                            // $('#klb-tnh-sm').html('');
                            // $('#klb-tnh-th').html('');
                            // $('#suhu-thigrow').html('');
                            // $('#klb-udr-thigrow').html('');
                            // $('#bat-th').html('');
                            // $('#kad-gar').html('');
                            // $('#cahaya-thigrow').html('');
                        }
    
                    }
                });
            }
        }
        var chartThigrows;
        function renderChartThigrow(thigrowData){
                const ctx = document.getElementById('thigrowChart1').getContext('2d');

                if(chartThigrows){
                    chartThigrows.destroy();
                }
                const chartData = {
                    labels:thigrowData.map(entry => (entry.created_at)),
                    datasets:[{
                        label:'Kelembaban Tanah (T-Higrow)',
                        data : thigrowData.map(entry=>entry.kelembaban_tanah_th),
                        lineTension: 0.5,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        borderWidth:1,
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(2,117,216,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        fill:'1',
                    }, {
                        label: "Suhu",
                        data: thigrowData.map(entry=>entry.temperature),
                        lineTension: 0.3,
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
                    }, {
                        label: "Kelembaban Udara (T-Higrow)",
                        data: thigrowData.map(entry=>entry.kelembaban_udara),
                        lineTension: 0.3,
                        backgroundColor: "rgba(143,113,80,0.2)",
                        borderColor: "rgba(143,113,80,1)",
                        borderWidth:1,
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(143,113,80,1)",
                        pointBorderColor: "rgba(143,113,80,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(143,113,80,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        fill:3,
                    }, {
                        label: "Kelembaban Tanah (Soil Moisture)",
                        data: thigrowData.map(entry=>entry.kelembaban_tanah_sm),
                        lineTension: 0.3,
                        backgroundColor: "rgba(0,255,0,0.2)",
                        borderColor: "rgba(0,255,0,1)",
                        borderWidth:1,
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(0,255,0,1)",
                        pointBorderColor: "rgba(0,255,0,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(0,255,0,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        fill:'1',
                    }]
                }

                chartThigrows = new Chart(ctx, {
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
                                stacked:true,
                                title:{
                                    display:true,
                                    text:'Timestamp'
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
                                    text:'Value'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'white'  // Change label color here
                                }
                            },
                            filler: {
                                propagate: false,
                            },
                            'samples-filler-analyser': {
                                target: 'chart-analyser'
                            }
                        },
                        interaction: {
                            intersect: false,
                        },
                    },
                })
            }
    });
</script>

        
@endsection