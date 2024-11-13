@extends('layout/app')

@section('contents')
    <div class="ms-1 mt-2 info-sec mb-4">
        <div>
            <h5 class="text-center info-txt mt-2">Dashboard Monitoring</h5>
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

        <div class="card bg-transparent border-0 data mb-3" id="dataThigrow">
            <div class="card-header py-1">
                <a class="info-txt text-decoration-none d-block" href="#dataThigrow" data-bs-toggle="collapse"  role="button" aria-expanded="false" aria-controls="dataThigrow">Sensor T-Higrow</a>
            </div>
            
            <div class="card-body collapse multi-collapse" id="dataThigrow">

                
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
                            <canvas id="thigrowChart1" width="750" height='200' class="canvas-style"></canvas>
                        </div>
                    </div>
            </div>
        </div>

        <div class="card bg-transparent border-0 data mb-3" id="dataBmp">
            <div class="card-header py-1">
                <a class="info-txt text-decoration-none d-block" href="#dataBmp" data-bs-toggle="collapse"  role="button" aria-expanded="false" aria-controls="dataBmp">Sensor BMP-180</a>
            </div>

            <div class="card-body collapse multi-collapse" id="dataBmp">
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
                                    <canvas id="chartBmp" style="background-color:rgba(0, 0, 0, .7)"></canvas>
                                </div>
                                <div class="col">
                                    <canvas id="chartBmp2" style="background-color:rgba(0, 0, 0, .7)"></canvas>
                                </div>
                            </div>
            
                        </div>
                    </div>
            </div>
        </div>

        <div class="card bg-transparent border-0 data mb-3" id="dataThm30d">
            <div class="card-header py-1">
                <a class="info-txt text-decoration-none d-block" href="#dataThm30d" data-bs-toggle="collapse"  role="button" aria-expanded="false" aria-controls="dataThm30d">Sensor THM-30D</a>
            </div>

            <div class="card-body collapse multi-collapse" id="dataThm30d">
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
                         <canvas id="chartThm30d" width="750" height='200' style="background-color: rgba(0, 0, 0, .7)"></canvas> 
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-transparent border-0 data mb-3" id="dataIna219">
            <div class="card-header py-1">
                <a class="info-txt text-decoration-none d-block" href="#dataIna219" data-bs-toggle="collapse"  role="button" aria-expanded="false" aria-controls="dataIna219">Sensor INA-219</a>
            </div>

            <div class="card-body collapse multi-collapse" id="dataIna219">
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
                            <canvas id="chartIna" width="750" height="200" style="background-color: rgba(0, 0, 0, .7)"></canvas>
            
                        </div>
                    </div>
            </div>
        </div>
        <div class="card bg-transparent border-0 data mb-3" id="dataBn220">
            <div class="card-header py-1">
                <a class="info-txt text-decoration-none d-block" href="#dataBn220" data-bs-toggle="collapse"  role="button" aria-expanded="false" aria-controls="dataBn220">Sensor BN-220</a>
            </div>

            <div class="card-body collapse multi-collapse" id="dataBn220">
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 justify-content-around">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="latitudex" id="latitudex" placeholder="DVC-XXX" readonly>
                            <label for="latitudex">Latitude</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="longitudex" id="longitudex" placeholder="DVC-XXX" readonly>
                            <label for="longitudex">Longitudes</label>
                        </div>
                    </div>
                </div>
                <div class="container" id="map">
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
                    getDataBmp180(token);
                    getDataThm30d(token);
                    getDataIna219(token);
                    getDataBn220(token);
                    
                    interval = setInterval(function(){
                        getKodeDevice(token);
                        getDataThigrow(token);
                        getDataBmp180(token);
                        getDataThm30d(token);
                        getDataIna219(token);
                        // getDataBn220(token);


                    },5000);
                } else {
                    $('#kodeDevice').val('');
                    $('#dataThigrow').fadeOut(500);
                    $('#dataBmp').fadeOut(500);
                    $('#dataThm30d').fadeOut(500);
                    $('#dataBn220').fadeOut(500);
                    $('#dataIna219').fadeOut(500);
                    
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
                                $('#dataThigrow').fadeIn(500);
                            } else{
                                // renderChartThigrow().destroy();
                                $('#dataThigrow').fadeOut(500);
                            }
        
                        }
                    });
                }
            }
            let map;
            function getDataBn220(token){
                if(token){
                    
                    $.ajax({
                        url: '/dashboardMonitoring/' + token,
                        method: 'GET',
                        data: 'token=' + token,
                        dataType: 'json',
                        success:function(data){
                            if(data.bn220.length>0){
                                $('#latitudex').val(data.bn220[0].latitude);
                                $('#longitudex').val(data.bn220[0].longitude);

                                if (map) {
                                // If the map already exists, update its view
                                    map.setView([data.bn220[0].latitude, data.bn220[0].longitude], 18);
                                    // Remove existing marker (if any)
                                    map.eachLayer(function (layer) {
                                        if (layer instanceof L.Marker) {
                                            map.removeLayer(layer);
                                        }
                                    });
                                    // Add new marker
                                    L.marker([data.bn220[0].latitude, data.bn220[0].longitude]).addTo(map);
                                } else {
                                    // If the map doesn't exist, create a new one
                                    map = L.map('map').setView([data.bn220[0].latitude, data.bn220[0].longitude], 18);

                                    // Add tile layer
                                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 19,
                                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                                    }).addTo(map);
                                    var circle = L.circle([data.bn220[0].latitude, data.bn220[0].longitude], {
                                        color: 'red',
                                        fillColor: '#f03',
                                        fillOpacity: 0.5,
                                        radius: 20
                                    }).addTo(map);
                                    // Add marker
                                    L.marker([data.bn220[0].latitude, data.bn220[0].longitude]).addTo(map)
                                        .bindPopup('Lokasi Device!')
                                        .openPopup();
                                }

                                $('#dataBn220').fadeIn(500);
                                
                            } else {
                                $('#dataBn220').fadeOut(500);
                            }
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
                            } else {
                                $('#dataIna219').fadeOut(500);
                            }
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
                            } else {
                                $('#dataThm30d').fadeOut(500);
                            }
                        }
                    });
                }
            }
            function getDataBmp180(token){
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
                                renderChartBmp(data.bmp180);
                            } else {
                                $('#dataBmp').fadeOut(500);
                            }
                        }
                    });
                }
            }
            let chartThigrows;
            let chartBmp;
            let chartThm30d;
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
                        pointHoverBackgroundColor: "rgba(0, 21, 229,1)",
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
                        pointHoverBackgroundColor: "rgba(255,0,0,1)",
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
                        pointHoverBackgroundColor: "rgba(0, 189, 2,1)",
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
                                    return context.dataset.data[context.dataIndex] > 10; // Customize when to display the label
                                },
                                formatter: function(value, context) {
                                    return value; // Customize the label format (e.g., value, context.dataset.label, etc.)
                                },
                                align: 'end' // Adjust the alignment of the label (start, end, center, etc.)
                            },
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

            // function renderMap(bnData){

            // }
        });
    </script>
    {{-- <script type="text/javascript">
        $(document).ready(function(){
            $('#device').on('change', function(){
                var id = $('#device').val();
                
                // console.log(id);
                if(id>0 && id<=4) {
                    // var obj = setInterval(dataUpdate, 2000);
                    function dataUpdate(){
                        $.ajax({
                            url:'/dashboardMonitoring/'+id,
                            method:'GET',
                            data : 'id='+id,
                            dataType :'json',
                            success:function(data){
                                var k_dvc= $('#kodeDevice').val(data.device[0].kode_device);
                                var klb = $('#klb-tnh').html(data.sensorThigrow[0].kelembaban_tanah);
                                var tmp =$('#temp').html(data.sensorThigrow[0].temperature);
                                var tmp =$('#pH').html(data.sensorThigrow[0].pH);
                                var bat =$('#bat').html(data.sensorThigrow[0].pH);
                                var chartData = data.sensorThigrow[0];
                                console.log(data, chartData);
                                $('#dataThigrow').fadeIn(500);
                                $('#dataBmp').fadeIn(500);
                                $('#dataThm30d').fadeIn(500);
                                $('#dataIna219').fadeOut(500);
                                
                                // $('#dataIna219').fadeIn(500);
                            }
                        });
                    } dataUpdate();
                } else if(id == 5){
                    $.ajax({
                            url:'/dashboardMonitoring/'+id,
                            method:'GET',
                            data : 'id='+id,
                            dataType :'json',
                            success:function(data){
                                var k_dvc= $('#kodeDevice').val(data.device[0].kode_device);
                                $('#dataIna219').fadeIn(500);
                                $('#dataThigrow').fadeOut(500);
                                $('#dataThm30d').fadeOut(500);
                                $('#dataBmp').fadeOut(500);
                            }
                        }); 
                    
                } else{
                    // $('#dataIna219').fadeIn(500);
                    $('#dataThigrow').fadeOut(500);
                    $('#dataIna219').fadeOut(500);
                    $('#dataThm30d').fadeOut(500);
                    $('#dataBmp').fadeOut(500);
                    $('#kodeDevice').val('');
                }
            }).change();

        });
    </script> --}}
@endsection