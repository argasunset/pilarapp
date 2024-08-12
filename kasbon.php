<?php

include '../koneksi.php';


function convertNumber($num = false)
{
    $num = str_replace(array(',', ''), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas',
        'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'
    );
    $list2 = array('', 'sepuluh', 'dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh', 'enam puluh', 'tujuh puluh', 'delapan puluh', 'sembilan puluh', 'seratus');
    $list3 = array('', 'ribu', 'juta', 'milyar', 'triliun', 'quadrillion', 'kuadriliun', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . ( $list1[$hundreds] == 'satu' ? '' : $list1[$hundreds] ) . ( $hundreds == 1 ? ' seratus' : ' ratus' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? $list1[$tens] . ' ' : '' );
        } elseif ($tens >= 20) {
            $tens = (int)($tens / 10);
            $tens = $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    $words = implode(' ',  $words);
    // $words = preg_replace('/^\s\b(and)/', '', $words );
    $words = trim($words);
    $words = ucfirst($words);
    // $words = $words . ".";
    return $words;
}

function numberFormat($angka){
    $angka_terformat = number_format($angka, 0, ',', '.');

    return $angka_terformat;
}

$id = (int)$_GET['id'];
$dataKasbon = query("SELECT * FROM kasbon 
                        INNER JOIN user ON kasbon.id_user=user.user_id
                        WHERE id_kasbon='$id'")[0];


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            @font-face {
                font-family: 'Dosis'; /* The name you want to use for the font */
                src: url('../fonts/Dosis/static/Dosis-Medium.ttf') format('truetype'); /* Replace with the correct file path */
                font-weight: normal;
                font-style: normal;
            }
            
            .gambar-text-container{
                position: relative;
            }

            .text-overlay{
                position: absolute;
                font-size: 10px;
                top: 0;
                left: 0;
                /* border: 1px solid black; */
            }

            /* SECTION ROW1 */
            .container-row1{
                display: flex;
                /* align-items: center; */
                width: 650px;
                font-size: 14px;
            }

            .container-tglpengajuan-tglacc{
                /* border: 1px solid black; */
                /* margin-left: 290px; */
                margin-top: 67px;
                font-size: 11px;
            }

            .container-tglpengajuan-tglacc .text-tglacc{
                margin-top: 6px;
            }

            .container-nama-nilai{
                /* border: 1px solid black; */
                /* margin-right: 325px; */
                width: 360px;
                margin-left: 182px;
                margin-top: 78px;
            }

            .text-nilai{
                padding-top: 4px;
            }
            
            /* !SECTION ROW1 */

            /* SECTION ROW2 */
            .container-row2{
                font-size: 13px;
                /* border: 1px solid black; */
                width: 634px;
            }
            
            .container-row2 .container-terbilang-keperluan{
                /* margin-top: 18px;1 */
                margin-left: 183px;
                border-top: 1px solid black;
                /* width: 630px; */
            }

            .text-terbilang{
                padding-top: 2px;
            }

            /* !SECTION ROW2 */

            /* SECTION ROW1-1 */
            .container-row1-1{
                /* border: 1px solid black; */
                display: flex;
            }

            .container-row1-1 .title-persetujuan{
                font-size: 12.3px;
                margin-left: 103px;
                font-family: 'Dosis', sans-serif;
            }

            .container-row1-1 .title-persetujuan span{
                font-size: 15.5px; 
                margin-left: 14px;
            }

            .container-row1-1 .text-setujurp {
                margin-left: 4px;
                font-size: 14px; 
                padding-top: 4px;
            }
            
            /* !SECTION ROW1-1 */

            /* SECTION ROW3 */
            .container-row3{
                display: flex;
                /* border: 1px solid black; */
                width: 640px;
                font-size: 13px;
                margin-top: 51px;
            }

            .gambar-ttdacc{
                margin-left: 110px;
            }

            .gambar-ttdadmin{
                margin-left: 10px;
            }
            /* !SECTION ROW3 */
        </style>
    </head>
    <body>

    <div class="gambar-text-container">
        <img width=95% src="../gambar/template_kasbon/Form Kasbon_page-0001.jpg" alt="">
        <div class="text-overlay">
            <div class="container-row1">
                <div class="container-nama-nilai">
                    <div class="text-nama"><?= $dataKasbon['user_nama'] ?></div>
                    <div class="text-nilai"><?= numberFormat($dataKasbon['nominal_pengajuan']) ?></div>
                </div>
                <div class="container-tglpengajuan-tglacc">
                    <div class="text-tglpengajuan"><?= $dataKasbon['tgl_pengajuan'] ?></div>
                    <div class="text-tglacc"><?= $dataKasbon['tgl_approval'] ?></div>
                </div>
            </div>
            <div class="container-row1-1">
                <div class="title-persetujuan">Disetujui Rp.<span>:</span></div>
                <?php
                $number = $dataKasbon['nominal_approval'];
                
                ?>
                <div class="text-setujurp"><?= numberFormat($number) ?></div>
            </div>
            <div class="container-row2">
                <div class="container-terbilang-keperluan">
                    <div class="text-terbilang"><?= convertNumber($number) . " rupiah" ?></div>
                    <?php 
                    $teksPembayaran = $dataKasbon['keperluan'];
                    $jumlahTeks = strlen($teksPembayaran);
                    $teksPembayaranArray = NULL;
                    if($jumlahTeks > 78){
                        $teksPembayaranArray = str_split($teksPembayaran, 78);
                    }
                    ?>
                    <div class="text-keperluan">
                        <?= $teksPembayaranArray ? $teksPembayaranArray[0] : $teksPembayaran ; ?>
                    </div>
                    <?php if($teksPembayaranArray) : ?>
                        <div class="text-keperluan">
                        <?= $teksPembayaranArray[1] ?>
                        </div>
                    <?php else : ?>
                        <br>
                    <?php endif ;?>
                </div>
            </div>
            <div class="container-row3">
                <div class="gambar-ttdacc">
                    <img style="width: 80%; height: 65px; margin-top: 20px;" src="../gambar/template_kasbon/TTD2.jpg" alt="">
                </div>
                <div class="gambar-ttdadmin">
                    <img style="width: 100%; height: 65px; margin-top: 20px;" src="../gambar/template_kasbon/TTD.jpg" alt="">
                </div>
                <!-- QR CODE -->
                <?php 

                $qrText = $dataKasbon['user_id'];
                $width = 150; // Lebar gambar QR code
                $height = 150; // Tinggi gambar QR code

                // Membangun URL dengan parameter ukuran
                $googleChartUrl = "https://chart.googleapis.com/chart?chs={$width}x{$height}&cht=qr&chl=" . urlencode($qrText);
                ?>
                <div class="qr">
                    <img style="width: 90px; height: 90px; margin-left: 30px;" src="<?= $googleChartUrl ?>" alt="">
                </div>
                <div class="gambar-ttd-pengaju">
                    <img style="width: 100px; height: 100px; margin-left: 30px; margin-top: 15px;" src="../gambar/signatures/<?= $dataKasbon['ttd'] ?>" alt="">
                </div>
            </div>
        </div>
    </div>

    <script>
        window.print();
        // Event listener untuk mendeteksi selesai mencetak
        window.addEventListener("afterprint", function() {
            // Setelah pencetakan selesai, alihkan ke halaman sebelumnya
          window.history.back();
        });
    </script>

    </body>
</html>