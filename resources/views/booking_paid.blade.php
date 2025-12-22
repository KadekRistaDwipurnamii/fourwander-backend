<h2>Pembayaran Berhasil</2>
<p>Halo {{ $booking->nama }},</p>
<p>Booking kamu telah berhasil dibayar.</p>
<p>Total: Rp {{ number_format($booking->total_harga,0,',','.') }}</p>
<p>Terima kasih telah memilih FourWanders untuk petualanganmu! ✨</p>