@extends('layout/app')

@section('contents')
    <div class="ms-1 mt-2 info-sec mb-4">
        <div>
            <h5 class="text-center info-txt mt-2">Device List</h5>
        </div>
    </div>

    <div class="card shadow mb-4 ms-1 content-1">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Device List</h6>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table" border="1" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode Device</th>
                            <th>Nama Device</th>
                            <th>Token</th>
                            <th>Deskripsi</th>
                            <th width="20%" class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dataDevice as $item)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_device }}</td>
                            <td>{{ $item->nama_device }}</td>
                            <td align="left">{{ $item->token }}</td>
                            <td>{{ $item->deskripsi_device }}</td>
                            <td width ="20%" align="center">
                                @if(Auth::user()->role!='admin')
                                -
                                @else
                                <div class="d-flex flex-row justify-content-around">
                                <a href="/device/edit/{{ $item->id }}" class="btn btn-warning">Ubah</a>
                                
                                <form action="/device/delete/{{ $item->id }}" method="post" id="cnfrm">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Hapus</button>
                                </form>
                                {{-- <form action="/device/delete/{{ $item->id }}" class="" method="post">
                                    @csrf
                                    @method('delete')
                                    <!-- Button trigger modal -->
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
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(Auth::user()->role!='admin')

                @else
                <div>
                    <a href="{{ url('/device/tambah') }}" class="btn btn-success">Tambah Device [+]</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- <script>
        const btn = document.getElementById('cnfrm');
        btn.addEventListener('click', function(){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
        })
    </script> --}}

    {{-- <script>
        function submitForm(button){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result){
                    button.click();
                }
            })
        }
    </script> --}}

    {{-- <script type="text/javascript"> 
        $(function(){
            $(document).on('click', '#delete_dvc', function(e){
            e.preventDefault();
            var link = $(this).attr("submit");
            
      })
    });
    </script> --}}
@endsection