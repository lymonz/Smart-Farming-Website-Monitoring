<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shorcut icon" href="{{ url('/assets/images/logounsri.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('/assets/css/style.css') }}">
  <title>Smart Farming</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.cdnfonts.com/css/lemonmilk" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <script type="text/javascript" src="{{ url('/assets/jquery/jquery.min.js') }}"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  {{-- <script type="text/javascript" src="{{ url('/assets/js/chartina219.js') }}"></script> --}}
  @livewireStyles
  @stack('css')
</head>
<body>

  <div class="main-container d-flex">
    <div class="sidebar bg-dark" id="side_nav">
        <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
           <h1 class="fs-5"><a href="{{ url('home') }}" class="text-decoration-none"><span class="px-2 me-2"><img src="{{ url('/assets/images/logounsri.png') }}" alt="logo unsri" class="img-fluid" width="50" height="50"></span><span class="text-white">Smart Farming</span></a></h1>
           <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered mb-3"></i></button>
        </div>

        <ul class="list-unstyled px-2 sidebar-txt">
          <li class="fs-5"><a href="{{ url('/home') }}" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-house me-2"></i>Home</a></li>
          <hr class="h-color"> 
          <li class="fs-5"><a href="{{ url('/device') }}" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-phone me-2"></i>Device</a></li>
          <hr class="h-color"> 
          {{-- <li class="fs-5"><a href="{{ url('/dashboardMonitoring') }}" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-speedometer me-2"></i>Dashboard</a></li> --}}

          <li class="fs-5">
            <a class="text-decoration-none px-3 py-1 dropdown-toggle d-block" href="#dataDashboard" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="dataDashboard"><i class="bi bi-speedometer me-2"></i>Dashboard</a>

            <div id="dataDashboard" class="collapse multicollapse px-2 py-2 fs-6 db">
              <a href="{{ url('/dashboardMonitoring') }}" class="d-block text-decoration-none px-4 py-2 db"><i class="bi bi-speedometer2"></i> Dashboard Utama</a>
              <a href="{{ url('/dashboardMonitoring/thigrow') }}" class="d-block text-decoration-none px-4 py-2 db"><i class="fa-solid fa-seedling"></i> Data Sensor T-Higrow</a>
              <a href="{{ url('/dashboardMonitoring/bmp') }}" class="d-block text-decoration-none px-4 py-2 db"><i class="bi bi-wind"></i> Data Sensor BMP-180</a>
              <a href="{{ url('/dashboardMonitoring/thm30d') }}" class="d-block text-decoration-none px-4 py-2 db"><i class="bi bi-thermometer-sun"></i> Data Sensor THM-30D</a>
              <a href="{{ url('/dashboardMonitoring/ina219') }}" class="d-block text-decoration-none px-4 py-2 db"><i class="bi bi-lightning-fill"></i> Data Sensor INA-219</a>
            </div>
            {{-- <a href="" class="text-decoration-none px-3 py-2 d-block nav-link collapsed" data-toggle="collapse" data-target="#collapseData"><i class="bi bi-speedometer me-2"></i>Dashboard</a> --}}
          </li>
            
          
          <hr class="h-color"> 
          <li class="fs-5"><a href="{{ url('/data') }}" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-file-earmark-bar-graph me-2"></i>Data History</a></li>
          <hr class="h-color"> 
          {{-- <li class="fs-5"><a href="{{ url('/battery') }}" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-lightning-fill me-2"></i>Battery</a></li>
          <hr class="h-color">  --}}
          @if(Auth::user()->role!='admin')
            
          @else
          <li class="fs-5"><a href="{{ url('/pengguna') }}" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-person-circle me-2"></i>Pengguna</a></li>
          <hr class="h-color">
          @endif
          <li class="fs-5"><a href="{{ url('/sesi/logout') }}" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-box-arrow-in-left me-2"></i>Log-out</a></li>
          <hr class="h-color"> 
          
        </ul>
    </div>
    <div class="content">
        <nav class="navbar navbar-expand-lg bg-dark">
          <div class="container-fluid">
            <div class="d-flex justify-content-between d-md-none d-block">
              <a class="navbar-brand text-white sidebar-txt fs-4" href="#">Smart Farming</a>
              <button class="btn px-1 py-0 open-btn text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end mt-3" id="navbarSupportContent">
              <ul class="navbar-nav mb-2 mb-lg-0 me-3">
                <li class="nav-item me-3 time-txt fs-5 d-flex">
                  <i class="bi bi-clock me-2"></i>
                  <span><p id="currentTime"></p>
                  </span>
                </li>

                <li class="nav-item me-3 time-txt fs-5 d-flex">
                  <i class="bi bi-calendar-fill me-2"></i>
                  <p id="date">
                  <p id="currentDay"></p>/
                  <p id="currentMonth"></p>/
                  <p id="currentYear"></p>
              </p>
                </li>
                <li class="nav-item fs-5 text-white auth-txt">
                  <span class="">Hello, {{ Auth::user()->name }}</span>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <div class="container-fluid">
          @yield('contents')
        </div>
    </div>
  </div>

  {{-- <div class="main-container d-flex">
    <div class="row">
      <div class="d-flex flex-column justify-content-between col-auto bg-dark min-vh-100 clm-wdt">
        <div class="mt-4">
          <a href="#" class="text-white text-decoration-none d-flex align-items-center ms-2" role="button">
            <img src="{{ url('/assets/images/logounsri.png') }}" alt="" class="img-fluid" width="40" height="40">
            <span class="h5">Smart Farming&nbsp;&nbsp;</span>
          </a>
          <hr class="text-white" />
          <ul class="nav nav-pills mt-2 mt-sm-0" id="menu">
            <li class="nav-item">
              <a href="{{ url('/device') }}" class="nav-link text-white" aria-current="page">
                <i class="bi bi-phone"></i>
                <span class="ms-2">Device</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/dashboardMonitoring') }}" class="nav-link text-white" aria-current="page">
                <i class="fa fa-gauge"></i>
                <span class="ms-2">Dashboard</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="/dashboard" class="nav-link text-white" aria-current="page">
                <i class="fa fa-gauge"></i>
                <span class="ms-2">Dashboard 2</span>
              </a>
            </li> --}}
            {{-- <li class="nav-item">
              <a href="{{ url('dashboard/battery') }}" class="nav-link text-white" aria-current="page">
                <i class="fa fa-bolt"></i>
                <span class="ms-2">Battery</span>
              </a>
            </li> --}}
            {{-- <li class="nav-item disabled">
              <a href="#sidemenu" data-bs-toggle = "collapse" class="nav-link text-white" aria-current="page">
                <i class="fa fa-table"></i>
                <span class="ms-2">Daftar Sensor&nbsp;&nbsp;&nbsp;</span>
                <i class="fa fa-caret-down"></i>
              </a>  
                <ul class="nav collapse ms-1 flex-column" id="sidemenu" data-bs-parent = "#menu">
                  <li class="nav-item">
                    <a href="/soilm" class="nav-link text-white" aria-current="page">
                      <span class="ms-4">Sensor Tanah</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/temp" class="nav-link text-white" aria-current="page">
                      <span class="ms-4">Sensor Udara</span>
                    </a>
                  </li> --}}
                  {{-- <li class="nav-item">
                    <a href="" class="nav-link text-white" aria-current="page">
                      <span class="ms-4"></span>
                    </a>
                  </li> --}}
                {{-- </ul>
            </li> --}}
            {{-- <li class="nav-item">
              <a href="/pengguna" class="nav-link text-white" aria-current="page">
                <i class="fa fa-user"></i>
                <span class="ms-2">Pengguna</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div> --}}
    {{-- &nbsp;&nbsp;
    <div class="content">
      <nav class="navbar navbar-expand navbar-dark bg-dark nav-height" aria-label="Second navbar example">
        <div class="container-fluid">
          <h4 class="text-white mt-3">Hello, {{ Auth::user()->name }}</h4>
    
          <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active mt-3 logut-txt" aria-current="page" href="/sesi/logout">
                  <span><i class="bi bi-box-arrow-in-left"></i></span>
                </a>
              </li>
            </ul>
            <div class="text-white me-4 d-flex">
                <span><i class="fa fa-clock icon-margin">&nbsp;</i></span>
                <p class="time-txt" id="currentTime"></p>
            </div>
            <div class="text-white me-4 d-flex">
              <i class="fa fa-calendar icon-margin-2">&nbsp;</i>
              <p class="time-txt" id="date">
                <span id="currentDay"></span>/
                <span id="currentMonth"></span>/
                <span id="currentYear"></span>
              </p>
          </div>
            <form>
              <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
            <a href="{{ url('/device/tambah') }}" class="btn btn-success text-white ms-4 rounded">Add Device</a>
          </div>
        </div>
      </nav> --}}

      {{-- <div class="container-fluid d-flex flex-wrap justify-content-between content-sec">
        @yield('contents')
      </div>
    </div>
  </div> --}}
  
  @include('sweetalert::alert')
  {{-- <script src="{{ url('/assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script> --}}
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    let time = document.getElementById('currentTime');
    let day = document.getElementById('currentDay');
    let month = document.getElementById('currentMonth');
    let year = document.getElementById('currentYear');
    setInterval(() => {
      let d = new Date();
      time.innerHTML = d.toLocaleTimeString();
      day.innerHTML = d.getDate().toString().padStart(2, "0");
      month.innerHTML = (d.getMonth() + 1).toString().padStart(2, "0");
      year.innerHTML = d.getFullYear();
    }, 1000);
  </script>
  <script>
    let table = new DataTable('#dataTable');
  </script>

  <script> 
    $(".sidebar ul li").on('click', function(){
      $(".sidebar ul li.active").removeClass('active');
      $(this).addClass('active');
    });

    $('.open-btn').on('click', function(){
      $('.sidebar').addClass('active');
    });
    
    $('.close-btn').on('click', function(){
      $('.sidebar').removeClass('active');
    });
  </script>
  
  {{-- <script type="text/javascript">
    $(function(){
      $(document).on('click', '#delete_dvc', function(e){
        e.preventDefault();
        var link = $(this).attr("submit");
        
      })
    });
  
  </script> --}}
{{--   
  <script>
      var month = ['JAN', 'FEB', 'MAR', 'APR', 'MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];

        var date = today.getDate();
        var mon = today.getMonth();
        var year = today.getFullYear();
      

      document.getElementById('day').innerHTML = date;
      document.getElementById('month').innerHTML = month[mon];
      document.getElementById('year').innerHTML = year;
  </script> --}}
  @livewireScripts
  @stack('js')
</body>
</html>