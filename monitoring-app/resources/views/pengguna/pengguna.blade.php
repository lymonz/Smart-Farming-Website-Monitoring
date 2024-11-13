@extends('layout/app')
@section('contents')
            <div class="ms-1 mt-2 py-1 px-2 info-sec mb-4">
                <div>
                    <h5 class="text-center info-txt mt-2">DATA PENGGUNA</h5>
                </div>
            </div>

            <div class="card shadow mb-4 ms-1 content-1">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" border="1" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td width ="20%" align="center">
                                        <div class="d-flex flex-row justify-content-around">
                                        <a href="/pengguna/ubah/{{ $item->id }}" class="btn btn-warning">Ubah</a>
                                        <form action="/pengguna/delete/{{ $item->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini?')">Hapus</button>
                                        </form>
                                            {{-- <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Delete
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        Apakah Anda Yakin Menghapus Data?
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                        </form> --}}
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <a href="{{ url('/pengguna/tambah') }}" class="btn btn-success">Tambah Pengguna [+]</a>
                        </div>
                    </div>
                </div>
            </div>

    {{-- <table class="table mt-2">
        <th class="text-center fs-5 title-font table-secondary">DATA PENGGUNA</th>
    </table>

    <table class="table table-borderless">
        <thead class="text-end thead-sty">
                <th colspan="5">
                    <a href="#" class="btn btn-success">Tambah Pengguna [+]</a>
                </th>
        </thead>
    </table>
    <table class="table table-bordered border-dark">
        <tbody>
            <tr class=" bg-info">
                <th width="2%" align="center">No.</th>
                <th width="15%">Username</th>
                <th width="65%">Email</th>
                <th width="20%" class="text-center">Aksi</th>
            </tr>
            @foreach ($data as $item)
            <tr class="bg-light">
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td align="center">
                    <a href="#" class="btn btn-warning">Ubah</a>
                    <a href="#" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table> --}}
@endsection