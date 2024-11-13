@extends('layout.app')

@section('contents')
<div class="ms-1 mt-2 info-sec mb-4">
    <div>
        <h5 class="text-center info-txt mt-2">SENSOR INA-219 PADA SOLAR PANEL</h5>
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
    <h1 class="info-txt">Device Tidak Memiliki Data Sensor BMP-180</h1>
</div>

<div class="card-body bg-transparent border-0 mb-3" id="dataIna219">
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3">
        <div class="col">
            <div class="card mb-4 rounded shadow-sm">
                <div class="card-header py-1 text-center">
                    <p class="card-title"><b>TEGANGAN</b></p>
                </div>

                <div class="card-body text-center">
                    <span id="tegangan" class="auth-txt">0</span> <span class="auth-txt">V</span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">SENSOR INA-219</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded shadow-sm">
                <div class="card-header py-1 text-center">
                    <p class="card-title"><b>ARUS</b></p>
                </div>

                <div class="card-body text-center">
                    <span id="arus" class="auth-txt">0</span> <span class="auth-txt">mA</span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">SENSOR INA-219</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded shadow-sm">
                <div class="card-header py-1 text-center">
                    <p class="card-title"><b>DAYA</b></p>
                </div>

                <div class="card-body text-center">
                    <span id="daya" class="auth-txt">0</span> <span class="auth-txt">W</span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">SENSOR INA-219</small>
                </div>
            </div>
        </div>
    </div>
        <div class="card rounded">
            <div class="card-header text-center fs-5 auth-txt">Grafik Data Sensor INA-219</div>
            <div class="card-body">
                <canvas id="chartIna" width="750" height="200" style="background-color: rgba(0, 0, 0, .7);display:none"></canvas>

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
                getDataIna219(token);
                $('#chartIna').fadeIn(500);
                interval = setInterval(function(){
                    getKodeDevice(token);
                    getDataIna219(token);
                },5000);
            } else {
                    $('#kodeDevice').val('');
                    $('#chartIna').fadeOut(500);

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
        function getDataIna219(token){
            if(token){
                $.ajax({
                    url: '/dashboardMonitoring/' + token,
                    method: 'GET',
                    data: 'token=' + token,
                    dataType: 'json',
                    success:function(data){
                        if(data.ina219.length>0){
                            $('#tegangan').html(data.ina219[0].tegangan);
                            $('#arus').html(data.ina219[0].arus);
                            $('#daya').html(data.ina219[0].daya);
                            renderChartIna(data.ina219);
                            $('#dataIna219').fadeIn(500);
                            $('#dataKosong').fadeOut(500);
                        } else {
                            $('#dataIna219').fadeOut(500);
                            $('#dataKosong').fadeIn(500);
                        }
                    }
                });
            }
        }
        let chartIna219;
        function renderChartIna(inaData){
            const ctx=document.getElementById('chartIna').getContext('2d');
            if(chartIna219){
                chartIna219.destroy();
            }
            const chartData={
                labels:inaData.map(entry=>(entry.created_at)),
                datasets:[{
                    label:'Tegangan',
                    data : inaData.map(entry=>entry.tegangan),
                    lineTension: 0.5,
                    backgroundColor: "rgba(0, 21, 229, 0.3)",
                    borderColor: "rgba(0, 21, 229,1)",
                    borderWidth:1,
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(0, 21, 229,1)",
                    pointBorderColor: "rgba(0, 21, 229,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(0, 21, 2291)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    fill:2,
                },{
                    label: "Arus",
                    data: inaData.map(entry=>entry.arus),
                    lineTension: 0.3,
                    backgroundColor: "rgba(255,0,0,0.3)",
                    borderColor: "rgba(255,0,0,1)",
                    borderWidth:1,
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(255,0,0,1)",
                    pointBorderColor: "rgba(255,0,0,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(255,0,0,1",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    fill:'-1',
                },{
                    label: "Daya",
                    data: inaData.map(entry=>entry.daya),
                    lineTension: 0.3,
                    backgroundColor: "rgba(0, 189, 2, 0.3)",
                    borderColor: "rgba(0, 189, 2,1)",
                    borderWidth:1,
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(0, 189, 2,1)",
                    pointBorderColor: "rgba(0, 189, 2,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(0, 189, 21)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    fill:'start',
                }]
            }
            chartIna219 = new Chart(ctx, {
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
                                text:'Timestamp',
                                color:'#fff'
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
                                color:'#fff'
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            color: 'black',
                            display: function(context) {
                                return context.dataset.dat[context.dataIndex] > 10; //Customize when to display thelabel
                            },
                            formatter: function(value, context){
                                return value; // Customize thelabel format (e.g., value,context.dataset.label, etc.)
                            },
                            align: 'end' // Adjust thealignment of the label (start, end,center, etc.)
                        },
                        legend: {
                            labels: {
                                color: 'white'  // Change labelcolor here
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