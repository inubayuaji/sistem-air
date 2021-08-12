<html>

<head>
    <title>Kartu Pelanggan</title>
</head>

<style>
    body {
        font-size: 12px;
        font-family: sans-serif;
    }

</style>

<body>
    {{-- Header --}}
    <table style="width: 100%;">
        <tr>
            <td style="width: 20%; text-align: right;">
                <div style="width: 50px; height: 50px; background: #ccc;">logo</div>
            </td>
            <td style="width: 60%; text-align: center;">
                <h2 style="font-size: 14px;">SUMUR ARTETIS</h2>
                <h1 style="font-size: 18px;">"UD. DUTA SAMUDRA TEKNIK"</h1>
                <p>Nomor HP: 085-866-864-599</p>
            </td>
            <td style="width: 20%;"> </td>
        </tr>
    </table>

    {{-- Data pelanggan --}}
    <table style="width: 100%;">
        <tr>
            <td width="135px">Nomor Pelanggan </td>
            <td>: {{ str_pad($pelanggan->no, 3, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td width="135px">Nama </td>
            <td>: {{ $pelanggan->nama }}</td>
        </tr>
        <tr>
            <td width="135px">Alamat </td>
            <td>: {{ $pelanggan->desa->nama }}</td>
        </tr>
    </table>

    {{-- Tabel Tagihan --}}
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td rowspan="2" style="border: 1px solid #000; text-align: center;"> No </td>
            <td rowspan="2" style="border: 1px solid #000; text-align: center; width: 10%;"> Bulan </td>
            <td colspan="2" style="border: 1px solid #000; text-align: center;"> Meter </td>
            <td rowspan="2" style="border: 1px solid #000; text-align: center;"> Jumlah <br> Meter </td>
            <td rowspan="2" style="border: 1px solid #000; text-align: center;"> 0m - 5m </td>
            <td rowspan="2" style="border: 1px solid #000; text-align: center;"> >= 6m </td>
            <td rowspan="2" style="border: 1px solid #000; text-align: center; width: 15%;"> Jumlah </td>
            <td rowspan="2" style="border: 1px solid #000; text-align: center; width: 15%;"> Meter <br> Penerima </td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center; width: 10%;"> Yang Lalu </td>
            <td style="border: 1px solid #000; text-align: center; width: 10%;"> Sekarang </td>
        </tr>

        <tr>
            <td style="border: 1px solid #000; text-align: center;">1</td>
            <td style="border: 1px solid #000; text-align: left;">Januari</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">2</td>
            <td style="border: 1px solid #000; text-align: left;">Februari</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">3</td>
            <td style="border: 1px solid #000; text-align: left;">Maret</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">4</td>
            <td style="border: 1px solid #000; text-align: left;">April</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">5</td>
            <td style="border: 1px solid #000; text-align: left;">Mei</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">6</td>
            <td style="border: 1px solid #000; text-align: left;">Juni</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">7</td>
            <td style="border: 1px solid #000; text-align: left;">Juli</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">8</td>
            <td style="border: 1px solid #000; text-align: left;">Agustus</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">9</td>
            <td style="border: 1px solid #000; text-align: left;">September</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">10</td>
            <td style="border: 1px solid #000; text-align: left;">Oktober</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">11</td>
            <td style="border: 1px solid #000; text-align: left;">November</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; text-align: center;">12</td>
            <td style="border: 1px solid #000; text-align: left;">Desember</td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
            <td style="border: 1px solid #000; text-align: right;"></td>
            <td style="border: 1px solid #000; text-align: center;"></td>
        </tr>
    </table>

    {{-- Footer --}}
    <table>
        <tr>
            <td style="width: 40%">
                <b>Informasi: </b>
                <ul>
                    <li>Mulai bulan Januari 2021, tagihan (meter rekening) 0m - 5m pelanggan membayar Rp. 25.000 (dua
                        puluh lima ribu rupiah)</li>
                    <li>Untuk 6m keatas tetap menggunakan aturan lama Rp. 4.000 per m, plus beban Rp. 5.000 per bulan.
                    </li>
                </ul>
            </td>
            <td style="width: 40%">
                <b>Sangsi: </b>
                <ul>
                    <li>Pelanggan yang terlambat membayar rekening sampai batas waktu yang ditentukan dikenakan biayaya
                        keterlambatan.</li>
                    <li>Jika keterlambatan membayar rekening sampai 3 bulan berturut - turut diadakan pemutusan aliran.
                    </li>
                </ul>
            </td>
            <td style="text-align: center;">
                Pengusaha.
                <br>
                <br>
                <br>
                <br>
                <b>Bp. Narto</b>
            </td>
        </tr>
    </table>
</body>

</html>
