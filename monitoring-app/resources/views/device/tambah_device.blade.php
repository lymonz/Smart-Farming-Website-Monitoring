@extends('layout/app')

@section('contents')
    <div class="card shadow mt-2 mb-3 w-100">
        <div class="card-body">
            <h5 class="title-font">Tambah Device</h5>

            <form action="{{ url('/device/tambah/simpan') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $kode_device }}" name="kode" id="floatingInput" placeholder="DVC-XXX" readonly>
                    <label for="floatingInput">Kode Device</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $randomToken }}" name="token" id="floatingInput" placeholder="DVC-XXX" readonly>
                    <label for="floatingInput">Token Device</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control"  name="name" id="floatingInput" placeholder="DVC-XXX">
                    <label for="floatingInput">Nama Device</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="description" id="floatingInput" placeholder="DVC-XXX">
                    <label for="floatingInput">Deskripsi Device</label>
                </div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Tambah Device</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Apakah anda yakin dengan data yang telah diisi?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection