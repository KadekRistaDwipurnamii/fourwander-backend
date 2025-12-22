<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Berhasil</title>
</head>
<body style="font-family: Arial, sans-serif">

<h2>Halo {{ $booking->nama }} 👋</h2>

<p>
Terima kasih telah melakukan booking di <b>FourWanders Travel</b>.
Pembayaran Anda telah <b>BERHASIL</b>.
</p>

<hr>

<p><b>Detail Booking:</b></p>
<ul>
    <li>Paket: {{ $booking->paket->nama }}</li>
    <li>Tanggal: {{ $booking->tanggal }}</li>
    <li>Jumlah Orang: {{ $booking->jumlah_orang }}</li>
    <li>Total Bayar: Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</li>
    <li>Metode Pembayaran: {{ $booking->payment_method }}</li>
</ul>

<p>
📎 Bukti pembayaran terlampir dalam email ini.
</p>

<p>
Jika ada pertanyaan, silakan hubungi kami.
</p>

<p>
Salam hangat,<br>
<b>FourWanders Travel</b>
</p>

</body>
</html>
