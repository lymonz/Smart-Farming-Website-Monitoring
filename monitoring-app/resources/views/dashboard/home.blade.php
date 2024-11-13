@extends('layout/app')

@section('contents')
    <div class="mt-4 graph-sec text-white">
      <h1 class="text-center ">GRAPHIC SESSION</h1>
    </div>

    <div class="mt-4 map-sec text-white">
      <h1 class="text-center">MAP SESSION</h1>
    </div>

    <div class="mt-4 ms-4 status-sec d-flex flex-wrap justify-content-between text-center text-white">
      <div class="mt-2 ms-2 comp-stats">
          <h3>Battery Status</h3>
      </div>

      <div class="mt-2 me-2 comp-stats">
        <h3>Temperature</h3>
      </div>
    
      <div class="mt-2 ms-2 comp-stats">
        <h3>pH</h3>
      </div>
  
      <div class="mt-2 me-2 comp-stats">
        <h3>Humidity</h3>
      </div>
    </div>

    <div class="mt-4 adds-sec text-white">
        <h1 class="mt-2">ADD-ONS</h3>
        <div class="mt-5 d-flex justify-content-between">
            <div class="mt-2 ms-5 me-3 addon-item">
              <h4>Wifi Speed</h4>
            </div>
            <div class="mt-2 ms-5 me-5 addon-item">
              <h4>Wifi Speed</h4>
            </div>
        </div>
    </div>
@endsection