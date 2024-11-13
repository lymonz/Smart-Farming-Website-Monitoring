@extends('layout.app')

@section('contents')
    <div class="box-title-dh">
        <p class="fs-4 ms-3 info-txt">Data Report History</p>
    </div>
    <div class="mt-2">
        <form class="" id="formData" action="/data/print">
            @csrf
            @method('post')
        
            <div class="row row-cols-1 row-cols-md-4 row-cols-lg-4 justify-content-center align-items-center">
                <div class="col col-lg-3">
                    <div class="form-floating">
                        <select name="device" id="device" class="form-select">
                            <option value="">-- Pilih Device --</option>
                            @foreach ( $dataDevice as $item)
                                <option value="{{ $item->token }}">{{ $item->nama_device }}</option>
                            @endforeach
                        </select>
                        <label for="device">Device</label>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="form-floating">    
                        <select name="sensor" id="sensor" class="form-select">
                            <option value="">-- Pilih Sensor --</option>
                        </select>
                        <label for="sensor">Sensor</label>
                    </div>
                </div>
                <div class="col col-lg-2">
                    {{-- <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3">
                        <label for="dateStart" class="font-default col-form-label" style="width: 90px">Start :</label>
                            <div class="input-group date" id="datepicker" style="width: 220px; margin-left:-20px;">
                                <input type="text" name="dateStart" class="form-control" id="dateStart"/>
                                <span class="input-group-append">
                                <span class="input-group-text bg-light d-block">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                </span>
                            </div>
                    </div> --}}
                        <div class="form-floating" id="datepicker">
                            <input type="text" name="dateStart" id="dateStart" class="form-control" placeholder="dd/mm/yy">
                            <label for="dateStart">Date Start</label>
                        </div>
                </div>
                <div class="col col-lg-2">
                    {{-- <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2">
                        <label for="dateEnd" class="font-default col-form-label" style="width: 90px">End :</label>
                            <div class="input-group date" id="datepicker2" style="width: 220px; margin-left:-40px;">
                                <input type="text" class="form-control" id="dateEnd" name="dateEnd"/>
                                <span class="input-group-append">
                                <span class="input-group-text bg-light d-block">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                </span>
                            </div>
                    </div> --}}
                    <div class="input-group">
                        <div class="form-floating" id="datepicker">
                            <input type="text" name="dateEnd" id="dateEnd" class="form-control" placeholder="dd/mm/yy" />
                            <label for="dateStart">Date End</label>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-2">
                    <button type="button" class="btn btn-success shadow auth-text w-50" id="findBtn">Find</button>
                    <button type="submit" class="btn btn-success shadow " id="csvBtn"><i class="fa-solid fa-file-csv"></i></button>
                    {{-- <a href="{{ route('data.print') }}"class="btn btn-success" ><i class="fa-solid fa-file-csv"></i></a> --}}
                </div>
            </div>
        </form>
    </div>
    
    <div class="mt-2">
        <nav class="nav-bar">
            <ul>
                <li>
                    <a href="#" class="active" id="dat-grp"><i class="bi bi-graph-up me-2"></i>Data Graphic History</a>
                </li>
                <li>
                    <a href="#" id="dat-tb"><i class="bi bi-table me-2"></i>Data Table History</a>
                </li>
            </ul>
        </nav>

{{-- 
        <div class="card bg-transparent border-0" id="dataGrafik">
            
        </div> --}}
        <div class="data-box">
            <div id="free"></div>
            <div class="dataGrafik" id="dataGrafik">
                <p class="text-center fs-5 info-txt">DATA GRAPHIC HISTORY</p>
                <div class="card bg-transparent border-0 data" id="dataGrafik2">
                    <canvas id="myChart" class="canvas-style" width="750" height="200"></canvas>
                </div>
            </div>

            <div class="dataTb" id="dataTb">
                <p class="text-center fs-5 info-txt">DATA TABLES HISTORY</p>
                <div class="card bg-white data" style="color: black;background-color:red" id="lowkey">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="jTable" border="1" cellspacing="0">
                                <thead>
                                    
                                </thead>
    
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <div id="pagination" class="pagination">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>   

    </div>
            
    

    <script>
        $(function(){
        $('#dateStart').datepicker({
            format:'dd-mm-yyyy',
            autoclose:true
        });
        $('#dateEnd').datepicker({
            format:'dd-mm-yyyy',
            autoclose:true
        });

        // $('#dataTables').DataTable({
        //     "emptyTable": "No data available in table"
        // })
    });
    </script>
{{-- Script javascript active class --}}
    <script>
        $(document).ready(function(){
            // $('#csvBtn').click(function(){
            //     var selectedDevice = $('#device').val();
            //     var selectedSensor = $('#sensor').val();
            //     var startDate = $('#dateStart').val();
            //     var endDate = $('#dateEnd').val();

                
            //     if(selectedDevice&&selectedSensor&&startDate&&endDate){
            //         console.log('Device yang dipilih :', selectedDevice);
            //         console.log('Sensor yang dipilih :', selectedSensor);
            //         console.log('Start Date :', startDate);
            //         console.log('End Date :', endDate);
                    
            //         $.ajax({
            //             url:'/data/print',
            //             method:'GET',
            //             data:{
            //                 selectedDevice: selectedDevice,
            //                 selectedSensor: selectedSensor,
            //                 startDate: startDate,
            //                 endDate: endDate
            //             },
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             success:function(data){
            //                 console.log(data);
            //             },
            //             error: function(data){
            //                 // Handle error, e.g., show an error message
            //                 console.error('Error exporting users:', data);
            //                 alert('An error occurred. Please try again.');
            //             }
            //         });
            //     } else {
                    
            //     }
            // });
            $('#findBtn').click(function(){
                var selectedDevice = $('#device').val();
                var selectedSensor = $('#sensor').val();
                var startDate = $('#dateStart').val();
                var endDate = $('#dateEnd').val();

                console.log('Device yang dipilih :', selectedDevice);
                console.log('Sensor yang dipilih :', selectedSensor);
                console.log('Start Date :', startDate);
                console.log('End Date :', endDate);

                if(selectedDevice&&selectedSensor&&startDate&&endDate){
                    getData(selectedDevice, selectedSensor, startDate, endDate);
                } else {
                    $('#dataGrafik2').fadeOut(500);
                    // $('#myChart').fadeOut(500);
                    $('#lowkey').fadeOut(500);
                    $('#jTable tbody').append('<tr><td colspan="6">No data available.</td></tr>');
                }
            });

            $('#device').on('change', function(){
                var token = $(this).val();
                console.log(token);
                
                if(token){
                    getDataSensor(token);
                    var sensors = $('#sensor').on('change', function(){
                        var selectedSensor = $(this).val();
                        if(selectedSensor){
                            console.log("Memilih Sensor "+selectedSensor);
                        } else {
                            console.log("Belum Memilih Sensor");
                        }
                    });

                } else {
                    $('#sensor').empty();
                }
            });
        });
        
        $('#dateStart').keyup(function(){
            var StartDate = $(this).val();
            console.log(StartDate)
        });
        $('#dateEnd').keyup(function(){
            var EndDate = $(this).val();
            console.log(EndDate)
        });


        // console.log(StartDate, EndDate);
        function getDataSensor(token){
            if(token){
                $.ajax({
                    url: '/data/' + token,
                    method: 'GET',
                    data: 'token=' + token,
                    dataType: 'json',
                    success:function(data){
                        $('#sensor').empty();
                        $('#sensor').append('<option value="">-- Pilih Sensor --</option>')
                        if(data.thigrow.length>0){
                            $('#sensor').append('<option value="thigrow">Sensor T Higrow</option>')
                        }

                        if(data.ina219.length>0){
                            $('#sensor').append('<option value="ina219">Sensor INA-219</option>')
                            
                        }
                        if(data.bmp180.length>0){
                            $('#sensor').append('<option value="bmp">Sensor BMP</option>')

                        }
                        if(data.thm30d.length>0){
                            $('#sensor').append('<option value="thm30d">Sensor THM-30D</option>')
                        }
                        // console.log($('#sensor').val());
                    }
                });
            }
        }
        function getThigrow(token){
            if(token){
                $.ajax({
                    url: '/data/' + token,
                    method: 'GET',
                    data: 'token=' + token,
                    dataType: 'json',
                    success:function(data){
                        // $('#sensor').append('<option value="">-- Pilih Sensor --</option>')
                        if(data.thigrow.length>0){
                            $('#sensor').append('<option value="thigrow">Sensor T Higrow</option>')
                        } else {
                            $('#sensor').empty();
                        }
                    }
                });
            }
        }

        function getIna219(token){
            if(token){
                $.ajax({
                    url: '/data/' + token,
                    method: 'GET',
                    data: 'token=' + token,
                    dataType: 'json',
                    success:function(data){
                        if(data.ina219.length>0){
                            $('#sensor').append('<option value="ina">Sensor INA - 219</option>')
                        }else {
                            // $('#sensor').empty();
                        }
                    }
                });
            }
        }
        function getBmp(token){
            if(token){
                $.ajax({
                    url: '/data/' + token,
                    method: 'GET',
                    data: 'token=' + token,
                    dataType: 'json',
                    success:function(data){
                        if(data.bmp180.length>0){
                            $('#sensor').append('<option value="bmp">Sensor BMP-180</option>')
                        } else {
                            // $('#sensor').empty();
                        }
                    }
                });
            }
        }
        function getThm30d(token){
            if(token){
                $.ajax({
                    url: '/data/' + token,
                    method: 'GET',
                    data: 'token=' + token,
                    dataType: 'json',
                    success:function(data){
                        if(data.thm30d.length>0){
                            $('#sensor').append('<option value="bmp">Sensor THM-30D</option>')
                        } else {
                            $('#sensor').empty();
                        }
                    }
                });
            }
        }
        document.addEventListener('DOMContentLoaded', function(){
            var datGrpElement = document.getElementById('dat-grp');
            var dataGrafikElement = document.getElementById('dataGrafik');
            var dataTbElement = document.getElementById('dataTb');

            // menampilkan data jika dat-grp aktif
            if(datGrpElement.classList.contains('active')){
                dataGrafikElement.style.display='block';
            } else {
                dataGrafikElement.style.display='none';
            }

            // Tangani acara klik untuk dat-grp
            datGrpElement.addEventListener('click', function() {
                var anchors = document.querySelectorAll('.nav-bar a');
                anchors.forEach(function(anchor) {
                    anchor.classList.remove('active');
                });
                this.classList.add('active');

                // Tampilkan elemen jika dat-grp aktif
                dataGrafikElement.style.display = 'block';
                dataTbElement.style.display='none';
                
            });

            // Tangani acara klik untuk dat-tb
            document.getElementById('dat-tb').addEventListener('click', function() {    
                var anchors = document.querySelectorAll('.nav-bar a');
                anchors.forEach(function(anchor) {
                    anchor.classList.remove('active');
                });
                this.classList.add('active');

                // Sembunyikan elemen jika dat-tb aktif
                var dataGrafikElement = document.getElementById('dataGrafik');

                dataGrafikElement.style.display = 'none';
                dataTbElement.style.display='block';
            });
        });

        function getData(selectedDevice, selectedSensor, startDate, endDate) {
                $.ajax({
                    url: '/data/filter/' + selectedDevice + '/' + selectedSensor + '/' + startDate + '/' + endDate +'/',
                    type: 'GET',
                    data: {
                        selectedDevice: selectedDevice,
                        selectedSensor: selectedSensor,
                        startDate: startDate,
                        endDate: endDate
                    },
                    dataType: 'json',
                    success: function (data) {
                        let table;
                        if(table){
                           table.destroy();
                        }
                        if(selectedSensor=='thigrow'){
                            $('#lowkey').fadeIn(500);
                            $('#dataGrafik2').fadeIn(500);
                            // $('#myChart').destroy();
                            chartDataThigrow(data.datas);
                            // dataTbThigrow(data.dvc);
                            // $('#jTable').attr("id","dataTable");
                            $('#jTable thead').empty();
                            var headerRow = $("<tr>");
                            
                            headerRow.append("<th>No.</th>");
                            headerRow.append("<th>Nama Device</th>");            
                            headerRow.append("<th>Kelembaban Tanah (Thigrow)</th>");
                            headerRow.append("<th>Kelembaban Tanah (Soil Moisture)</th>");
                            headerRow.append("<th>Kelembaban Udara</th>");
                            headerRow.append("<th>Intensitas Cahaya</th>");
                            headerRow.append("<th>Battery</th>");
                            headerRow.append("<th>Temperature</th>");
                            headerRow.append("<th>Kadar Garam</th>");
                            headerRow.append("<th>Tanggal</th>");


                            $('#jTable thead').append(headerRow);

                            $('#jTable tbody').empty();
                            
                            $.each(data.datas, function(index, item){
                                var bodyRow = $("<tr>");
                                var autoNumber = index + 1; // Increment index to start from 1
                                bodyRow.append("<td>"+autoNumber+"</td>")
                                bodyRow.append("<td>"+(item.nama_device||'')+"</td>")
                                bodyRow.append("<td>"+item.kelembaban_tanah_th+"</td>")
                                bodyRow.append("<td>"+item.kelembaban_tanah_sm+"</td>")
                                bodyRow.append("<td>"+item.kelembaban_udara+"</td>")
                                bodyRow.append("<td>"+item.i_cahaya+"</td>")
                                bodyRow.append("<td>"+item.battery+"</td>")
                                bodyRow.append("<td>"+item.temperature+"</td>")
                                bodyRow.append("<td>"+item.kadar_garam+"</td>")
                                bodyRow.append("<td>"+item.created_at+"</td>")
                                $('#jTable tbody').append(bodyRow);
                                table = $('#jTable').DataTable();

                            });
                            
                        } else if(selectedSensor=='ina219'){
                            $('#lowkey').fadeIn(500);
                            $('#dataGrafik2').fadeIn(500);
                            // var addAttr = $('#jTable').attr("id","jTable");
                            
                            $('#jTable thead').empty();
                            
                            
                            var headerRow = $("<tr>");
                                
                                headerRow.append("<th>No.</th>");
                                headerRow.append("<th>Nama Device</th>");
                                headerRow.append("<th>Tegangan</th>");
                                headerRow.append("<th>Arus</th>");
                                headerRow.append("<th>Daya</th>");
                                headerRow.append("<th>Tanggal</th>");
                                $('#jTable thead').append(headerRow);
                                
                                $('#jTable tbody').empty();
                                $.each(data.datas, function(index, item){
                                    var bodyRow = $("<tr>");
                                        var autoNumber = index + 1; // Increment index to start from 1
                                        bodyRow.append("<td>"+autoNumber+"</td>")
                                        bodyRow.append("<td>"+(item.nama_device||'')+"</td>")
                                        bodyRow.append("<td>"+item.tegangan+"</td>")
                                        bodyRow.append("<td>"+item.arus+"</td>")
                                        bodyRow.append("<td>"+item.daya+"</td>")
                                        bodyRow.append("<td>"+item.created_at+"</td>")
                                        $('#jTable tbody').append(bodyRow);
                                });
                                    
                                table = $('#jTable').DataTable();
                            // console.log($('#pagination').html());
                            renderChartIna(data.datas);
                        } else if(selectedSensor=='bmp') {
                            $('#lowkey').fadeIn(500);
                            $('#dataGrafik2').fadeIn(500);
                            $('#jTable thead').empty();
                            
                            
                            var headerRow = $("<tr>");
                                
                            headerRow.append("<th>No.</th>");
                            headerRow.append("<th>Nama Device</th>");
                            headerRow.append("<th>Tekanan Udara</th>");
                            headerRow.append("<th>Tinggi Permukaan</th>");
                            headerRow.append("<th>Battery</th>");
                            headerRow.append("<th>Tanggal</th>");
                            $('#jTable thead').append(headerRow);
                            
                            $('#jTable tbody').empty();
                            $.each(data.datas, function(index, item){
                                var bodyRow = $("<tr>");
                                    var autoNumber = index + 1; // Increment index to start from 1
                                    bodyRow.append("<td>"+autoNumber+"</td>")
                                    bodyRow.append("<td>"+(item.nama_device||'')+"</td>")
                                    bodyRow.append("<td>"+item.tekanan_udara+"</td>")
                                    bodyRow.append("<td>"+item.tinggi_permukaan+"</td>")
                                    bodyRow.append("<td>"+item.battery+"</td>")
                                    bodyRow.append("<td>"+item.created_at+"</td>")
                                    $('#jTable tbody').append(bodyRow);
                            });
                                
                            table = $('#jTable').DataTable();
                            renderChartBmp(data.datas);
                        } else if (selectedSensor=='thm30d'){
                            $('#lowkey').fadeIn(500);
                            $('#dataGrafik2').fadeIn(500);
                            $('#jTable thead').empty();
                            
                            
                            var headerRow = $("<tr>");
                                
                            headerRow.append("<th>No.</th>");
                            headerRow.append("<th>Nama Device</th>");
                            headerRow.append("<th>Temperature</th>");
                            headerRow.append("<th>Kelembaban Udara</th>");
                            headerRow.append("<th>Battery</th>");
                            headerRow.append("<th>Tanggal</th>");
                            $('#jTable thead').append(headerRow);

                            $('#jTable tbody').empty();
                            $.each(data.datas, function(index, item){
                                var bodyRow = $("<tr>");
                                    var autoNumber = index + 1; // Increment index to start from 1
                                    bodyRow.append("<td>"+autoNumber+"</td>")
                                    bodyRow.append("<td>"+(item.nama_device||'')+"</td>")
                                    bodyRow.append("<td>"+item.temperature+"</td>")
                                    bodyRow.append("<td>"+item.kelembaban_udara+"</td>")
                                    bodyRow.append("<td>"+item.battery+"</td>")
                                    bodyRow.append("<td>"+item.created_at+"</td>")
                                    $('#jTable tbody').append(bodyRow);
                            });
                                
                            table = $('#jTable').DataTable();
                            renderChartThm(data.datas);
                        }
                        else{
                            $('#dataGrafik2').fadeOut(500);
                            $('#myChart').fadeOut(500);
                            $('#lowkey').fadeOut(500);
                            $('#jTable tbody').append('<tr><td colspan="6">No data available.</td></tr>');

                        }
                        console.log(data);
                        // Do something with the data received from the server
                    }
                });
        }

        // function dataTbThigrow(dataTbTh){
            
        //     $('#jTable thead').empty();
        //     var headerRow = $("<tr>");
            
        //     headerRow.append("<th>No.</th>");
        //     headerRow.append("<th>Nama Device</th>");            
        //     headerRow.append("<th>Kelembaban Tanah (Thigrow)</th>");
        //     headerRow.append("<th>Kelembaban Tanah (Soil Moisture)</th>");
        //     headerRow.append("<th>Kelembaban Udara</th>");
        //     headerRow.append("<th>Intensitas Cahaya</th>");
        //     headerRow.append("<th>Battery</th>");
        //     headerRow.append("<th>Temperature</th>");
        //     headerRow.append("<th>Kadar Garam</th>");
        //     headerRow.append("<th width='10%'>Tanggal</th>");


        //     $('#dataTable thead').append(headerRow);

        //     $('#dataTable tbody').empty();
            
        //     $.each(dataTbTh, function(index, item){
        //         var bodyRow = $("<tr>");
        //         var autoNumber = index + 1; // Increment index to start from 1
        //         bodyRow.append("<td>"+autoNumber+"</td>")
        //         bodyRow.append("<td>"+(item.nama_device||'')+"</td>")
        //         bodyRow.append("<td>"+item.kelembaban_tanah_th+"</td>")
        //         bodyRow.append("<td>"+item.kelembaban_tanah_sm+"</td>")
        //         bodyRow.append("<td>"+item.kelembaban_udara+"</td>")
        //         bodyRow.append("<td>"+item.i_cahaya+"</td>")
        //         bodyRow.append("<td>"+item.battery+"</td>")
        //         bodyRow.append("<td>"+item.temperature+"</td>")
        //         bodyRow.append("<td>"+item.kadar_garam+"</td>")
        //         bodyRow.append("<td>"+item.created_at+"</td>")
        //         $('#dataTable tbody').append(bodyRow);
        //     });

            

           

        // }
        let myCharts;
        function chartDataThigrow(thigrowData){
            const ctx = document.getElementById('myChart').getContext('2d');

           if(myCharts){
            myCharts.destroy();
           }

           const chartData = {
            labels:thigrowData.map(entry =>entry.created_at),
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
           myCharts = new Chart(ctx, {
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
        function renderChartIna(inaData){
            const ctx=document.getElementById('myChart').getContext('2d');
            if(myCharts){
                myCharts.destroy();
            }
            const chartData={
                labels:inaData.map(entry=>entry.created_at),
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
            myCharts = new Chart(ctx, {
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
        function renderChartBmp(bmpData){
            const ctx=document.getElementById('myChart').getContext('2d');
            // const ctx2=document.getElementById('chartBmp2').getContext('2d');
            if(myCharts){
                myCharts.destroy();
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
                    fill:'1',
                }, {
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
            myCharts = new Chart(ctx, {
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
        function renderChartThm(thmData){
            const ctx=document.getElementById('myChart').getContext('2d');
            if(myCharts){
                myCharts.destroy();
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
            myCharts = new Chart(ctx, {
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
        
    </script>
@endsection