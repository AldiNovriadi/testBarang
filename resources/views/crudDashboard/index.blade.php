@extends('layouts.template')

@section('content')
@section('title')
  Dashboard
@endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@include('sweetalert::alert')
<?php $no = 1; ?>
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                  <h1 class="text-center"> CRUD Barang</h1>

                {{-- <div class="row"> --}}
                  <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                    Tambah Data 
                  </button>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th> No </th>
                            <th> Foto Barang </th>
                            <th> Nama Barang </th>
                            <th> Harga Beli </th>
                            <th> Harga Jual </th>
                            <th> Stok </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $barangs)
                        <tr>
                          <input type="hidden" class="delete_id" value="{{ $barangs->id }}">
                            <td class="text-center"> <?php echo $no++; ?></td>
                            <td class="text-center"> <img src="{{ asset('gambarBarang/'.$barangs->fotoBarang) }}" alt="" style="width: 50px"></td>
                            <td> {{ $barangs->namaBarang }}</td>
                            <td> Rp {{ number_format($barangs->hargaBeli, 0, '', '.') }}</td>
                            <td> Rp {{ number_format($barangs->hargaJual, 0, '', '.') }}</td>
                            <td> {{ $barangs->stok }}</td>
                            <td class="text-center">
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{$barangs->id}}" style="display: inline-block;"> <i class="fas fa-edit"></i>
                              </button>
                                {{-- <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#tambahModal" style="display: inline-block;"> <i class="fas fa-edit"></i></a> --}}
                                <form action="/dashboard/{{ $barangs->id }}" method="post" style="display: inline-block;" onsubmit="return confirm('Konfirmasi Hapus Data')">
                                  @csrf
                                  @method('DELETE')
                                <button class="btn btn-danger btndelete" type="submit"> <i class="fas fa-trash"> </i></button>
                                </form>
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

@foreach ($barang as $data)
<div class="modal fade" id="editModal-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row g-3" method="post" action="/dashboard/{{ $data->id}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="col-lg-12">
              <div id="inputFormRow">
                <span class="text-secondary">Foto Barang <b>(<span>  Foto Barang Saat ini : @if(empty($data->fotoBarang)) Belum Ada @else <a href="{{asset('/gambarBarang/'.$data->fotoBarang)}}">{{$data->fotoBarang}}</a> @endif )</b></span>
                  <input type="file" name="fotoBarang" class="form-control @error('fotoBarang') is-invalid @enderror" value="{{ $data->fotoBarang }}" autocomplete="off"></br>
                  <span class="text-secondary">Nama Barang</span>
                  <input type="text" name="namaBarang" class="form-control m-input" value="{{ $data->namaBarang }}" autocomplete="off" required></br>
                  <span class="text-secondary">Harga Beli</span>
                  <input type="number" name="hargaBeli" class="form-control m-input" value="{{ $data->hargaBeli }}" autocomplete="off" required></br>
                  <span class="text-secondary">Harga Jual</span>
                  <input type="number" name="hargaJual" class="form-control m-input" value="{{ $data->hargaJual }}" autocomplete="off" required></br>
                  <span class="text-secondary">Stok</span>
                  <input type="number" name="stok" class="form-control m-input" value="{{ $data->stok }}" autocomplete="off" required></br>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endforeach
@include('crudDashboard.create')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "emptyTable": "Tidak ada data Barang"
            },
        });
    });
</script>

@endsection