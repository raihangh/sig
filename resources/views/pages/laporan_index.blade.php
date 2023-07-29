<h1>Laporan Total Stok</h1>
<table style="width: 100%; border-collapse: collapse;">
  <thead>
      <tr>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">No</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Nama Barang</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Kode barang</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Deskripsi</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Harga</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Kategori</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Satuan</th>
          <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Stock</th>
      </tr>
  </thead>
  <tbody>
          @php
          $counter = 1;
          @endphp
          @foreach($barang as $b)
          <tr>
              <td style="border: 1px solid #000; padding: 8px;">{{ $counter}}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $b->nama_barang }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $b->kode_barang }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $b->deskripsi }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $b->harga }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $b->kategori }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $b->satuan }}</td>
              <td style="border: 1px solid #000; padding: 8px;">{{ $b->stock }}</td>
          </tr>
          @php
          $counter++;
          @endphp
          @endforeach
  </tbody>
</table>
