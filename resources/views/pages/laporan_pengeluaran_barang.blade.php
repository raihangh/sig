<h1>Laporan Pengeluaran Barang</h1>
<h3>Tanggal : {{ $startedDate }} Sampai : {{ $endDate }}</h3>
<table style="width: 100%; border-collapse: collapse;">
  <thead>
      <tr>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">NO</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Nama Barang</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">No Pengeluaran</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Tanggal</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Jumlah</th>
      </tr>
  </thead>
  <tbody>
    @php
        $counter = 1;
    @endphp
      @foreach ($pengeluaranBarangs as $pengeluaranBarang)
          <tr>
              <td style="border: 1px solid #000; padding: 8px;">{{ $counter++ }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $pengeluaranBarang->nama_barang }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $pengeluaranBarang->no_pengeluaran }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $pengeluaranBarang->tanggal_pengeluaran }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $pengeluaranBarang->jumlah }}</td> @include('partials.footer')
          </tr>
      @endforeach
  </tbody>
</table>
