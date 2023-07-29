@include('partials.header')
<div class="jumbotron" style="background-image: url('/assets/img/kbk.jpg');background-repeat: no-repeat;background-size: cover;">
  <div class="container">
  <h1>Stok Barang</h1>
  <p>Selamat datang di website stok barang.</p>
</div>
</div>
  <div class="container">
    <div class="row" style="margin-top: 20px;">
      <div class="col-lg-12 table-barang card" style="padding: 20px;">
        <a href="/dashboard-cetak-pdf" class="btn btn-primary" style="margin-bottom: 20px;">Cetak Stok</a>
          <table id="example" class="table table-striped table-bordered " style="width:100%">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama barang</th>
                      <th>Kode barang</th>
                      <th>Deskripsi</th>
                      <th>Harga</th>
                      <th>Kategori</th>
                      <th>Satuan</th>
                      <th>Stock</th>
                  </tr>
              </thead>
              <tbody>
                  @php
                  $counter = 1;
                  @endphp
                  @foreach($barang as $b)
                  <tr>
                      <td>{{ $counter }}</td>
                      <td>{{ $b->nama_barang }}</td>
                      <td>{{ $b->kode_barang }}</td>
                      <td>{{ $b->deskripsi }}</td>
                      <td>{{ $b->harga }}</td>
                      <td>{{ $b->kategori}}</td>
                      <td>{{ $b->satuan }}</td>
                      <td>{{ $b->stock }}</td>   
                  </tr>
                  @php
                  $counter++;
                  @endphp
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
  </div>
  <footer class="footer" style="padding: 30px 0;background: #000;color:white;">
    <div class="container">
      <p class="text-center">&copy; 2023 Stok Barang. All rights reserved.</p>
    </div>
  </footer>
@include('partials.footer')