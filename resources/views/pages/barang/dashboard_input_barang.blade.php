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
        <div class="row">
          <div class="col-md-6 card" style="padding: 20px;color:black;">
            <h4>Form Input Barang</h4>
            @if (session('pesanBarang'))
            <div class="alert alert-success">
              {{ session('pesanBarang') }}
            </div>
            @endif
            <form action="/dashboard-input-barang" method="POST">
              @csrf
              <div class="form-group">
                <label for="barang-name">Nama Barang:</label>
                <input type="text" class="form-control" id="barang-name" name="nama_barang"
                  value="{{ old('nama_barang') }}" placeholder="Enter the name of the item" required>
                @error('nama_barang')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="form-group">
                <label for="category">Kode barang:</label>
                <input type="text" class="form-control" id="barang-name" name="kode_barang"
                  value="{{ old('kode_barang') }}" placeholder="Enter the name of the item" required>
                @error('kode_barang')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="form-group">
                <label for="barang-deskripsi">Deskripsi:</label>
                <input type="text" class="form-control" id="barang-price" min="0" name="deskripsi"
                  value="{{ old('deskripsi') }}" placeholder="Enter the price of the item" required>
                @error('deskripsi')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="form-group">
                <label for="barang-price">Harga:</label>
                <input type="number" class="form-control" id="barang-price" min="0" name="harga"
                  value="{{ old('harga') }}" placeholder="Enter the price of the item" required>
                @error('harga')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>

                @enderror
              </div>
              <div class="form-group">
                <label for="barang-deskripsi">Kategori:</label>
                <input type="text" class="form-control" id="barang-price" min="0" name="kategori"
                  value="{{ old('kategori') }}" placeholder="Enter the price of the item" required>
                @error('kategori')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="form-group">
                <label for="barang-deskripsi">Satuan:</label>
                <select name="satuan" id="" class="form-control">
                  <option value="ecer">Ecer</option>
                  <option value="pack">Pack</option>
                </select>
                @error('satuan')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="form-group">
                <label for="barang-quantity">Stok:</label>
                <input type="number" class="form-control" id="barang_quantity_pack" name="stock" min="0"
                  value="{{ old('stock') }}" placeholder="Enter the quantity of the item" required>
                @error('stock')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <button type="submit" class="btn btn-success">Tambah Barang</button>
              <a href="/dashboard-barang" class="btn btn-warning">Kembali</a>
            </form>
          </div>
        </div>
      </div>
    </div>
    @include('components/footer')
  </div>
</div>
@include('partials/footer')