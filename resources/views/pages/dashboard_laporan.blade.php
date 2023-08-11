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
                            <li><a href="dashboard-laporan">{{ $title }}</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 " style="padding:20px;">
                        <h4>Table Penerimaan Barang</h4>
                        <div style="display: flex; margin-top: 20px;">
                            <form id="dateRangeFormPenerimaan" action="/dashboard-laporan-penerimaan-search" method="POST">
                                @csrf
                                <label for="">Mulai dari</label>
                                <input type="date" name="tanggal_penerimaan" id = "tanggal_penerimaan" required>
                                <label for="">Sampai: </label>
                                <input type="date" name="tanggal_penerimaan_end" id = "tanggal_penerimaan_end" required>
                                <button class="btn btn-primary" style="margin-left: 10px;">Cari</button>
                            </form>
                        
                            @if($startDatePenerimaan && $endDatePenerimaan)
                                <form action="/dashboard-cetak-pdf-laporan-penerimaan/{{ $startDatePenerimaan }}/{{ $endDatePenerimaan }}" method="GET">
                                    <button class="btn btn-primary" style="margin-left: 10px;">Cetak</button>
                                </form>
                            @else
                                <form action="/dashboard-cetak-pdf-laporan-penerimaan/{{ $penerimaan[count($penerimaan) - 1]->tanggal_penerimaan }}/{{ $penerimaan[0]->tanggal_penerimaan }}" method="GET">
                                    <button class="btn btn-primary" style="margin-left: 10px;">Cetak</button>
                                </form>
                            @endif
                        </div>
                        
                        
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
                            @if(count($penerimaan)< 1)
                                <div class="">
                                    <p>Tidak ada penerimaan barang di Tgl: {{ $startDatePenerimaan }} sampai: {{ $endDatePenerimaan }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="padding:20px;">
                        <h4>Table Pengeluaran Barang</h4>
                        <div style="display: flex; margin-top: 20px;">
                            <form id="dateRangeFormPengeluaran" action="/dashboard-laporan-pengeluaran-search" method="POST">
                                @csrf
                                <label for="">Mulai dari</label>
                                <input type="date" name="tanggal_pengeluaran" id = "tanggal_pengeluaran" required>
                                <label for="">Sampai: </label>
                                <input type="date" name="tanggal_pengeluaran_end" id = "tanggal_pengeluaran_end" required>
                                <button class="btn btn-primary" style="margin-left: 10px;">Cari</button>
                            </form>
                        
                            @if($startDatePengeluaran && $endDatePengeluaran)
                                <form action="/dashboard-cetak-pdf-laporan-penerimaan/{{ $startDatePengeluaran }}/{{ $endDatePengeluaran }}" method="GET">
                                    <button class="btn btn-primary" style="margin-left: 10px;">Cetak</button>
                                </form>
                            @else
                                <form action="/dashboard-cetak-pdf-laporan-pengeluaran/{{ $pengeluaran[count($pengeluaran) - 1]->tanggal_pengeluaran }}/{{ $pengeluaran[0]->tanggal_pengeluaran }}" method="GET">
                                    <button class="btn btn-primary" style="margin-left: 10px;">Cetak</button>
                                </form>
                            @endif
                        </div>                       
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
                            @if(count($pengeluaran)< 1)
                            <div class="">
                                <p>Tidak ada pengeluaran barang di Tgl: {{ $startDatePengeluaran }} sampai: {{ $endDatePengeluaran }}</p>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components/footer')
    </div>
</div>
@include('partials/footer')

<script>
    const startDatePenerimaan = document.querySelector('#tanggal_penerimaan');
    const endDatePenerimaan = document.querySelector('#tanggal_penerimaan_end');
  
    startDatePenerimaan.addEventListener('change', (e) => {
      const selectedStartDate = e.target.value;
      endDatePenerimaan.value = ''; // Clear the end date input
      endDatePenerimaan.min = selectedStartDate; // Set the minimum value for end date
    });

    const startDatePengeluaran = document.querySelector('#tanggal_pengeluaran');
    const endDatePengeluaran = document.querySelector('#tanggal_pengeluaran_end');
  
    startDatePengeluaran.addEventListener('change', (e) => {
    const selectedStartDate = e.target.value;
    endDatePengeluaran.value = ''; // Clear the end date input
    endDatePengeluaran.min = selectedStartDate; // Set the minimum value for end date
    });
</script>