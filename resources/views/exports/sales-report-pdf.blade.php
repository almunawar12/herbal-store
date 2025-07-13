<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        .footer {
            position: absolute;
            bottom: 40px;
            right: 40px;
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>Laporan Penjualan</h2>

    @if($startFormatted && $endFormatted)
        <p style="margin-top: -10px; margin-bottom: 20px;">
            Periode: {{ $startFormatted }} s/d {{ $endFormatted }}
        </p>
    @endif

    <p style="margin-top: 0; margin-bottom: 10px;">
        Jumlah Transaksi: <strong>{{ $totalTransactions }}</strong><br>
        Jumlah Produk Terjual: <strong>{{ $totalProducts }}</strong>
    </p>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $trx)
            <tr>
                <td>{{ $trx->code }}</td>
                <td>{{ $trx->name }}</td>
                <td>{{ $trx->email }}</td>
                <td>Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                <td>{{ $trx->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach

            {{-- Baris total --}}
            <tr>
                <td colspan="3" style="text-align: right; font-weight: bold;">Total Penjualan:</td>
                <td colspan="2" style="font-weight: bold;">
                    Rp {{ number_format($totalAll, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>


        <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
        <br><br><br>
        <p style="text-decoration: underline; font-weight: bold;">{{ $adminName }}</p>
        <p style="margin-top: -10px;">Tanda Tangan</p>
    </div>

</body>
</html>
