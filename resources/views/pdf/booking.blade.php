<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Bukti Pembayaran</title>

<style>
  body {
    font-family: Arial, sans-serif;
    background: #EFF6FF;
    padding: 30px;
  }

  .box {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
  }

  h1 {
    color: #1E40AF;
    margin: 0;
  }

  .subtitle {
    color: #334155;
    margin-top: 4px;
    font-size: 14px;
  }

  hr {
    border: none;
    border-top: 1px solid #CBD5E1;
    margin: 18px 0;
  }

  table {
    width: 100%;
    font-size: 14px;
  }

  td {
    padding: 6px 4px;
    vertical-align: top;
  }

  .label {
    font-weight: bold;
    width: 35%;
    color: #0F172A;
  }

  .value {
    color: #1F2937;
  }

  .total-box {
    background: #F59E0B;
    color: #ffffff;
    padding: 14px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
    margin-top: 18px;
    text-align: center;
  }

  .status {
    text-align: center;
    margin-top: 16px;
  }

  .status span {
    background: #1E40AF;
    color: #ffffff;
    padding: 6px 22px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 14px;
  }

  .discount {
    color: #DC2626;
    font-weight: bold;
  }
</style>
</head>

<body>

<div class="box">

  <h1>Fourwander Travel</h1>
  <div class="subtitle">Bukti Pembayaran Booking</div>

  <hr>

  <!-- DATA CUSTOMER -->
  <table>
    <tr>
      <td class="label">Nama</td>
      <td class="value">{{ $booking->nama }}</td>
    </tr>
    <tr>
      <td class="label">Email</td>
      <td class="value">{{ $booking->email ?? '-' }}</td>
    </tr>
    <tr>
      <td class="label">No HP</td>
      <td class="value">{{ $booking->hp }}</td>
    </tr>
  </table>

  <hr>

  <!-- DATA PAKET -->
  <table>
    <tr>
      <td class="label">Paket</td>
      <td class="value">{{ optional($booking->paket)->nama ?? '-' }}</td>
    </tr>
    <tr>
      <td class="label">Tanggal</td>
      <td class="value">
        {{ \Carbon\Carbon::parse($booking->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
      </td>
    </tr>
    <tr>
      <td class="label">Jumlah Orang</td>
      <td class="value">{{ $booking->jumlah_orang }}</td>
    </tr>
  </table>

  <hr>

  <!-- PEMBAYARAN -->
  <table>
    <tr>
      <td class="label">Metode Pembayaran</td>
      <td class="value">{{ $booking->payment_method }}</td>
    </tr>
    <tr>
      <td class="label">Referensi</td>
      <td class="value">{{ $booking->payment_reference ?? '-' }}</td>
    </tr>
    <tr>
      <td class="label">Booking ID</td>
      <td class="value">#{{ $booking->id }}</td>
    </tr>
  </table>

  <hr>

  <!-- RINCIAN HARGA -->
  <table>
    <tr>
      <td class="label">Harga Awal</td>
      <td class="value">
        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
      </td>
    </tr>

    <tr>
      <td class="label">Diskon</td>
      <td class="value discount">
        - Rp {{ number_format($booking->diskon ?? 0, 0, ',', '.') }}
      </td>
    </tr>
  </table>

  <!-- TOTAL AKHIR -->
  <div class="total-box">
    Total Dibayar:
    Rp {{ number_format($booking->total_akhir ?? ($booking->total_harga - ($booking->diskon ?? 0)), 0, ',', '.') }}
  </div>

  <!-- STATUS -->
  <div class="status">
    <span>LUNAS</span>
  </div>

</div>

</body>
</html>
