<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pembayaran</title>
    <style>
        body { font-family: sans-serif; }
        h1 { color: #1E40AF; }
        table { width: 100%; margin-top: 20px; }
        td { padding: 6px 0; }
    </style>
</head>
<body>

<h1>Bukti Pembayaran - FourWanders</h1>

<table>
    <tr>
        <td>Nama</td>
        <td>: {{ $booking->nama }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>: {{ $booking->email }}</td>
    </tr>
    <tr>
        <td>No HP</td>
        <td>: {{ $booking->hp }}</td>
    </tr>
    <tr>
        <td>Paket</td>
        <td>: {{ $booking->paket->nama }}</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>: {{ $booking->tanggal }}</td>
    </tr>
    <tr>
        <td>Jumlah Orang</td>
        <td>: {{ $booking->jumlah_orang }}</td>
    </tr>
    <tr>
        <td>Total Harga</td>
        <td>: Rp {{ number_format($booking->total_harga,0,',','.') }}</td>
    </tr>
    <tr>
        <td>Metode Pembayaran</td>
        <td>: {{ $booking->payment_method }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>: {{ $booking->status }}</td>
    </tr>
</table>

<p style="margin-top:40px;">
    Terima kasih telah booking di <b>FourWanders</b> ✨
</p>

</body>
</html>
