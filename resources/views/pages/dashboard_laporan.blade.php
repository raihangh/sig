@include('partials.header')
<div class="wrapper">
    @include('components.sidebar')
    <div class="main-panel">
        @include('components.topbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row no-gutter">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Admin</a></li>
                            <li>{{ $title }}</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 " style="padding:20px;">
                        <h4>Table Penerimaan Barang</h4>
                        <form id="dateRangeFormPenerimaan" action="/dashboard-laporan-penerimaan-search"
                            style="margin-top:20px;" method="POST">
                            @csrf
                            <label for="">Mulai dari</label>
                            <input type="date" name="tanggal_penerimaan">
                            <label for="">Sampai: </label>
                            <input type="date" name="tanggal_penerimaan_end">
                            <button class="btn btn-primary">Cari</button>
                          </form>
                          @if(count($penerimaan) !== 0)
                          <form action="/dashboard-cetak-pdf-laporan-penerimaan/{{ $penerimaan[count($penerimaan) - 1]->tanggal_penerimaan }}/{{ $penerimaan[0]->tanggal_penerimaan }}" method="GET">
                            <button class="btn btn-primary">Cetak</button>
                          </form>                        
                          @endif
                        <div class="table-responsive table-full-width" style="margin-top:20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No Penerimaan</th>
                                        <th>Tgl Penerimaan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($penerimaan as $p)
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $p->nama_barang }}</td>
                                            <td>{{ $p->no_penerimaan }}</td>
                                            <td>{{ $p->tanggal_penerimaan }}</td>
                                            <td>{{ $p->jumlah }}</td>
                                        </tr>
                                        @php
                                            $counter++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding:20px;">
                        <h4>Table Pengeluaran Barang</h4>
                        <form id="dateRangeFormPengeluaran" action="/dashboard-laporan-pengeluaran-search"
                            style="margin-top:20px;" method="POST">
                            @csrf
                            <label for="">Mulai dari</label>
                            <input type="date" name="tanggal_pengeluaran">
                            <label for="">Sampai: </label>
                            <input type="date" name="tanggal_pengeluaran_end">
                            <button class="btn btn-primary">Cari</button>
                          </form>
                          @if(count($pengeluaran) !== 0)
                          <form action="/dashboard-cetak-pdf-laporan-pengeluaran/{{ $pengeluaran[count($pengeluaran) - 1]->tanggal_pengeluaran }}/{{ $pengeluaran[0]->tanggal_pengeluaran }}" method="GET">
                            <button class="btn btn-primary">Cetak</button>
                          </form>                        
                          @endif

                        <div class="table-responsive table-full-width" style="margin-top:20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No Pengeluaran</th>
                                        <th>Tgl Pengeluaran</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($pengeluaran as $p)
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $p->nama_barang }}</td>
                                            <td>{{ $p->no_pengeluaran }}</td>
                                            <td>{{ $p->tanggal_pengeluaran }}</td>
                                            <td>{{ $p->jumlah }}</td>
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
        </div>
        @include('components/footer')
    </div>
</div>
@include('partials/footer')

