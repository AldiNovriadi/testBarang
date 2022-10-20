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
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">|Tambah Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/dashboard" enctype="multipart/form-data">
          @csrf
        <div class="form-group">
          <label> Foto Barang </label>
          <input type="file" name="fotoBarang" class="form-control @error('fotoBarang') is-invalid @enderror" placeholder="Masukkan Foto Barang" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" name="namaBarang" class="form-control m-input" placeholder="Masukkan Nama Barang" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label>Harga Beli</label>
          <input type="number" name="hargaBeli" class="form-control m-input" placeholder="Masukkan Harga Beli" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label>Harga Jual</label>
          <input type="number" name="hargaJual" class="form-control m-input" placeholder="Masukkan Harga Jual" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label>Stok</label>
          <input type="number" name="stok" class="form-control m-input" placeholder="Masukkan Stok Barang" autocomplete="off" required>
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