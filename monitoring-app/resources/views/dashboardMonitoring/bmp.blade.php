@extends ('layout.app')


@section('contents')
<div class="ms-1 mt-2 info-sec mb-4">
    <div>
        <h5 class="text-center info-txt mt-2">Sensor BMP</h5>
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

<div class="card bg-transparent border-0 mb-3" id="dataBmp">
    <div class="row row-cols-1 row-cols-md-4 row-cols-lg-4 justify-content-center">
        <div class="col">
            <div class="card mb-4 rounded shadow-sm">
                <div class="card-header py-1 text-center">
                    <p class="card-title"><b>TEKANAN UDARA</b></p>
                </div>

                <div class="card-body text-center">
                    <span id="tkn-udr" class="auth-txt">0</span> <span class="auth-txt">mb</span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">SENSOR BMP-180</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded shadow-sm">
                <div class="card-header py-1 text-center">
                    <p class="card-title"><b>KETINGGIAN PERMUKAAN</b></p>
                </div>

                <div class="card-body text-center">
                    <span id="ktg-prm" class="auth-txt">0</span> <span class="auth-txt">ft</span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">SENSOR BMP-180</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded shadow-sm">
                <div class="card-header py-1 text-center">
                    <p class="card-title"><b>BATTERY</b></p>
                </div>

                <div class="card-body text-center">
                    <span id="bat-bmp" class="auth-txt">0</span> <span class="auth-txt">mA</span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">SENSOR BMP-180</small>
                </div>
            </div>
        </div>
    </div>
        <div class="card rounded">
            <div class="card-header text-center fs-5 auth-txt">Grafik Data Sensor BMP-180</div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-lg-2">
                    <div class="col">
                        <canvas id="chartBmp" style="background-color:rgba(0, 0, 0, .7);display:none"></canvas>
                    </div>
                    <div class="col">
                        <canvas id="chartBmp2" style="background-color:rgba(0, 0, 0, .7);display:none"></canvas>
                    </div>
                </div>

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
                getDataBmp(token);
                $('#chartBmp').fadeIn(500);
                $('#chartBmp2').fadeIn(500);
                interval = setInterval(function(){
                    getKodeDevice(token);
                    getDataBmp(token);
                },5000);
            } else {
                $('#kodeDevice').val('');
                $('#chartBmp').fadeOut(500);
                $('#chartBmp2').fadeOut(500);

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
        
        function getDataBmp(token){
            if(token){
                $.ajax({
                    url: '/dashboardMonitoring/' + token,
                    method: 'GET',
                    data: 'token=' + token,
                    dataType: 'json',
                    success:function(data){
                        if(data.bmp180.length>0){
                            $('#tkn-udr').html(data.bmp180[0].tekanan_udara);
                            $('#ktg-prm').html(data.bmp180[0].tinggi_permukaan);
                            $('#bat-bmp').html(data.bmp180[0].tinggi_permukaan);
                            $('#dataBmp').fadeIn(500);
                            $('#dataKosong').fadeOut(500)
                            renderChartBmp(data.bmp180);
                        } else {
                            $('#dataBmp').fadeOut(500);
                            $('#dataKosong').fadeIn(500);
                        }
                    }
                });
            }
        }

        let chartBmp;
        function renderChartBmp(bmpData){
                const ctx=document.getElementById('chartBmp').getContext('2d');
                const ctx2=document.getElementById('chartBmp2').getContext('2d');


                if(chartBmp&&chartBmp2){
                    chartBmp.destroy();
                    chartBmp2.destroy();
                }
                const chartData = {
                    labels:bmpData.map(entry => (entry.created_at)),
                    datasets:[{
                        label:'Tekanan Udara',
                        data : bmpData.map(entry=>entry.tekanan_udara),
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
                        fill:'start',
                    }],
                }
                const chartData2 = {
                    labels:bmpData.map(entry => (entry.created_at)),
                    datasets:[{
                        label: "Ketinggian Permukaan",
                        data: bmpData.map(entry=>entry.tinggi_permukaan),
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
                    }],
                }

                chartBmp = new Chart(ctx, {
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
                chartBmp2 = new Chart(ctx2, {
                    type:'line',
                    data:chartData2,
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