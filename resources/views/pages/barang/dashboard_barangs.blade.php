@include('partials.header')
<div class="wrapper">
  @include('components.sidebar')
  <div class="main-panel">
    @include('components.topbar')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li><a href="#">Admin</a></li>
              <li>{{ $title }}</li>
            </ol>
          </div>
        </div>
        <div class="row" style="margin-top: 20px;">
          <div class="col-lg-12 table-barang" >
            <a href="/dashboard-input-barang" class="btn btn-primary" style="margin-bottom: 20px;">Tambah Barang</a>
            <table id="tabeldashboard" class="table table-striped table-bordered " style="width:100%">
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
                  <th>Aksi</th>
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
                  <td style="display:flex; justify-content: center; gap: 5px">
                    <a href="/dashboard-barang-edit/{{ $b->id }}" class="btn btn-primary">Edit</a>
                    <form action="/dashboard-barang-delete/{{ $b->id }}" method="POST">
                      @csrf
                      @method("delete")
                      <button class="btn btn-danger"
                        onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                    </form>
                  </td>
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
    </div>
    @include('components/footer')
  </div>
</div>
@include('partials/footer')