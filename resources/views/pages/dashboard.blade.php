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
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Total Barang
                            </div>
                            <div class="panel-body">
                                {{ count($barang) }}
                                <!-- Replace with dynamic value -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Penerimaan 
                            </div>
                            <div class="panel-body">
                                {{ $penerimaan }}
                                <!-- Replace with dynamic value -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Pengeluaran
                            </div>
                            <div class="panel-body">
                               {{ $pengeluaran }}
                                <!-- Replace with dynamic value -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Stok Habis
                            </div>
                            <div class="panel-body">
                                {{ count($barangStokKosong) }}
                                <!-- Replace with dynamic value -->
                            </div>
                        </div>
                    </div>        
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12 table-barang">
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
        </div>
        @include('components/footer')
    </div>
</div>
@include('partials/footer')