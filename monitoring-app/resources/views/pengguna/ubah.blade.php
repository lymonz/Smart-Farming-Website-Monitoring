@extends('layout.app')

@section('contents')
<div class="card shadow mt-2 mb-3">
    <div class="card-body">
        <h5 class="title-font">Ubah Data Pengguna</h5>

        <form action="/pengguna/ubah/simpan/{{ $dataUser->id }}" method="POST">
            @method('put')
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="{{ $dataUser->name }}" name="name" id="floatingInput" placeholder="DVC-XXX" >
                <label for="floatingInput">Username</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" value="{{ $dataUser->email }}" name="email" id="floatingInput" placeholder="DVC-XXX" >
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" value="" name="password" id="floatingInput" placeholder="DVC-XXX">
                <label for="floatingInput">Password</label>
            </div>
            <div class="form-floating mb-3">
                <select name="role" id="floatingSelect" class="form-select">
                    <option value="Admin">Admin</option>
                    <option value="Pengguna">Pengguna</option>
                </select>
                <label for="floatingSelect">Role User</label>
            </div>

            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Ubah
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Ubah Pengguna</h1>
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