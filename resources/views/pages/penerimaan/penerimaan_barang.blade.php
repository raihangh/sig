@include('partials.header')

<div class="wrapper">

  @include('components.sidebar')

  <div class="main-panel">

    @include('components.topbar')

    <div class="content">
      <div class="container-fluid">
        <div class="row card" style="margin-top: 20px;padding:20px;">
          <div class="col-lg-5">
            <h4>Form Peneriman Barang</h4>
            @if (session('penerimaanBarang'))
            <div class="alert alert-success">
              {{ session('penerimaanBarang') }}
            </div>
            @endif
            <form action="/dashboard-penerimaan-barang" method="POST">
              @csrf
              <div class="form-group">
                <label for="barang-name">Nama Barang:</label>
                <select class="form-control" name="barang_id" id="id_barang" onchange="changeValue()" required>
                  <option value="">Pilih Barang</option>
                  @foreach($barang as $b)
                  <option value="{{ $b->id}}">{{ $b->nama_barang}}</option>
                  @endforeach
                </select>
                @error('barang_id')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="form-group">
                <label for="barang-name">Kode Barang:</label>
                <input type="text" value="" name="kode_barang" id="kode_barang" class="form-control" readonly="readonly">
                @error('kode_barang')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="form-group">
                <label for="category">No Penerimaan:</label>
                <input type="text" class="form-control" id="barang-name" name="no_penerimaan"
                  value="{{ old('no_penerimaan') }}" placeholder="Enter the name of the item" required>
                @error('no_penerimaan')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="form-group">
                <label for="satuan">Satuan:</label>
                <input type="text" value="" name="satuan" id="satuan_penerimaan" class="form-control" readonly="readonly">
                @error('satuan')
                <small id="" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>

              <div class="form-group">
                <label for="barang-deskripsi">Tanggal:</label>
                <input type="date" class="form-control" name="tanggal_penerimaan" value="{{ old('deskripsi') }}"
                  placeholder="Enter the price of the item" required>
                @error('tanggal_penerimaan')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="form-group">
                <label for="" >JUMLAH / <span id="packorecer"></span></label>
                <input type="number" class="form-control" name="jumlah"
                  value="{{ old('jumlah') }}" placeholder="Enter the price of the item" min="0" required>
                @error('jumlah')
                <small id="passwordHelp" class="text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <button class="btn btn-primary">Tambah Penerimaan</button>
            </form>

          </div>
          <div class="col-lg-7 table-barang">
            <h4>Daftar Peneriman Barang</h4>
            <table id="tabeldashboard" class="table table-striped table-bordered " style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama barang</th>
                  <th>No Penerimaan</th>
                  <th>Tanggal Penerimaan</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                </tr>
              </thead>
              <tbody>
                @php
                $counter = 1;
                @endphp
                @foreach($penerimaan as $p)
                <tr>
                  <td>{{ $counter }}</td>
                  <td>{{ $p->nama_barang }}</td>
                  <td>{{ $p->no_penerimaan }}</td>
                  <td>{{ $p->tanggal_penerimaan }}</td>
                  <td>{{ $p->jumlah }}</td>
                  <td>{{ $p->satuan }}</td>
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