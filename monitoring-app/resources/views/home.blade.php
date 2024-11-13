@extends('layout.app')

@section('contents')
<h6 class="mb-0 text-uppercase info-txt fs-4 mt-2">Halaman Menu Utama Website Monitoring Smart Farming</h6>
<hr>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-xl-4 row-cols-xxl-4 justify-content-around">
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-1 info-txt">Device</p>
                        <h4 class="info-txt"><span class="counter">{{ $dataDevice }}</span></h4>
                    </div>
                    <div class="ms-auto fs-1">
                        <i class="fa-solid fa-mobile"></i>
                    </div>
                </div>
                <hr class="my-2">
                <div class="d-flex align-items-center justify-content-between btn btn-primary">
                    <a href="{{ url('/device') }}" class="small stretched-link text-decoration-none text-white">View Details</a>
                    <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="info-txt align-items-center" ><span>Dashboard</span></h5>
                    </div>
                    <div class="ms-auto fs-1">
                        <i class="fa-solid fa-gauge"></i>
                    </div>
                </div>
                <hr class="my-2">
                <div class="d-flex align-items-center justify-content-between btn btn-primary"  style="margin-top:12.5px">
                    <a href="{{ url('/dashboardMonitoring') }}" class="small stretched-link text-decoration-none text-white">View Details</a>
                    <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role!='admin')

    @else
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-1 info-txt">Pengguna</p>
                        <h4 class="info-txt"><span class="counter">{{ $dataUser }}</span></h4>
                    </div>
                    <div class="ms-auto fs-1">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <hr class="my-2">
                <div class="d-flex align-items-center justify-content-between btn btn-primary">
                    <a href="{{ url('/pengguna') }}" class="small stretched-link text-decoration-none text-white">View Details</a>
                    <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection