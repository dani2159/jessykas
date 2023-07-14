<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan</title>
    <style>
        /* CSS untuk mencetak laporan */
        @media print {

            /* Sembunyikan elemen yang tidak perlu dicetak */
            .no-print {
                display: none;
            }

            /* Gaya cetak khusus */
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
            }

        }
    </style>
    <script>
        window.onload = function() {
            window.print(); // Cetak halaman saat halaman selesai dimuat
        }

        // Event listener ketika status pencetakan berubah
        window.onafterprint = function() {
            window.close(); // Tutup tab setelah mencetak atau membatalkan pencetakan
        };
    </script>
</head>

<body>
    <img src="{{ asset('assets/img/kop_surat.png') }}" width="100%" class="brand-image" alt="Kop Surat"><br>

    <h2 style="border: 1.5px solid #000; text-align:center;">Bukti Pengeluaran KAS</h2>
    <br>
    <div style="width:100%; float: right; margin-bottom:30px;">
        <table style="float: right;">
            <tr>
                <td>No. Rekap</td>
                <td>:</td>
                <td>{{ $transaksi->no_transaksi }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                {{-- tanggal sekarang (format dd-mm-yyyy) --}}
                <td>{{ Tgl_Indo($transaksi->tanggal) }}</td>
            </tr>
        </table>
    </div>
    <br>
    <b>
        <div>
            <table align="center">
                <tr>
                    <td style="width:30%">Pengeluaran Untuk</td>
                    <td>:</td>
                    <td>{{ $transaksi->nama_akun }}</td>
                </tr>
                <tr>
                    <td>Nominal</td>
                    <td>:</td>
                    <td style="border: 1.5px solid #000;">Rp. {{ number_format($transaksi->pengeluaran, 0, ',', '.') }}
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>{{ $transaksi->keterangan }}</td>
                </tr>

            </table>
        </div>
        <br>
        <br>

        <div style="width:95%; float: right; margin-right:5%;">
            <table style="float: right; text-align:center;">
                <tr style="width:10%;">
                    <td>Dibuat Oleh,</td>
                </tr>
                <tr>
                    <td style="height: 50px;"></td>
                <tr>
                    {{-- role menjadi huruf besar awal dan nama --}}
                    <td>{{ ucwords(Auth::user()->nama) }}({{ ucwords(Auth::user()->role) }})</td>
                </tr>
            </table>
        </div>

    </b>
</body>

</html>
