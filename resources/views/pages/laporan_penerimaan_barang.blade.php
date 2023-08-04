<h1>Laporan Penerimaan Barang</h1>
<h3>Tanggal : {{ $startedDate }} Sampai : {{ $endDate }}</h3>
<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">NO</th>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Nama Barang
            </th>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">No Penerimaan
            </th>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Tanggal</th>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2; font-weight: bold;">Jumlah</th>
            <!-- Add more table headers as needed -->
        </tr>
    </thead>
    <tbody>
        @php
            $counter = 1;
        @endphp
        @foreach ($penerimaanBarangs as $penerimaanBarang)
            <tr>
                <td style="border: 1px solid #000; padding: 8px;">{{ $counter++ }}</td>
                <td style="border: 1px solid #000; padding: 8px;">{{ $penerimaanBarang->nama_barang }}</td>
                <td style="border: 1px solid #000; padding: 8px;">{{ $penerimaanBarang->no_penerimaan }}</td>
                <td style="border: 1px solid #000; padding: 8px;">{{ $penerimaanBarang->tanggal_penerimaan }}</td>
                <td style="border: 1px solid #000; padding: 8px;">{{ $penerimaanBarang->jumlah }}</td>
                <!-- Add more table cells as needed -->
            </tr>
        @endforeach
    </tbody>
</table>
