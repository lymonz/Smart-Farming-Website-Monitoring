@extends('layout.app')

@section('contents')
    <div class="card shadow mt-2 mb-3 w-100">
        <div class="card-body">
            <h5 class="title-font">Ubah Data Dashboard</h5>

            <form action="/dashboardMonitoring/{{ $dataDashboard->id }}" method="post">
            @method('put')
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="{{ $dataDashboard->kode_dashboard }}" name="kode_dashboard" id="floatingInput" placeholder="DVC-XXX" readonly>
                <label for="floatingInput">Kode Dashboard</label>
            </div>

            <div class="form-floating mb-3">
                <select name="device_id" class="form-select" id="floatingSelect">
                    <option value="{{ $dataDashboard->device_id }}" selected>{{ $dataDashboard->device->nama_device }}</option>
                    @foreach ($dataDevice as $item)
                    <option value="{{ $item->id }}"> {{ $item->nama_device }} </option>
                    @endforeach
                </select>
                <label for="floatingSelect">Device</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control"  name="nama_dashboard" id="floatingInput" placeholder="DVC-XXX" value="{{ $dataDashboard->nama_dashboard }}">
                <label for="floatingInput">Nama Dashboard</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="deskripsi_dashboard" id="floatingInput" placeholder="DVC-XXX" value="{{ $dataDashboard->deskripsi_dashboard }}">
                <label for="floatingInput">Deskripsi Dashboard</label>
            </div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Ubah
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Ubah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Apakah anda yakin dengan data yang telah diisi?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection