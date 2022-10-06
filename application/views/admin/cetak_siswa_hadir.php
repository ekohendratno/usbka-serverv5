<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>CETAK DAFTAR HADIR SISWA</title>

    <script>var base_url = '/';</script>

	<link href="<?php echo base_url('assets/admin/css/cetak_hadir.css') ?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/admin/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/jquery-migrate-1.4.1.min.js') ?>"></script>
	
</head>
<body>
	<style>


        *{
            text-align: left;
            font-size: 12px;
        }
		.page {
		}

        .table{
            width: 100%;
            height: 100%%;
        }

        .text-left{
            text-align: left;
        }

        .text-right{
            text-align: right;
        }

        .text-center{
            text-align: center;
        }

        .text-justify{
            text-align: justify;
        }

        /**
        Folio
         */
        .page {
            width: 215.9mm;
            min-height: 355.6mm;
        }

	</style>
    <?php

    $tahun = date('Y');
    $bulan_tahun_text = "Oktober Tahun Dua Ribu Dua Puluh Satu";
    $semester_text = "Ujian Tengah Semester";

    $page_ke = 0;
    ?>
        <div class="page text-center" style="line-height: 2.5em; margin-top: 0px">
            <?php //if($page_ke <=1){?>
            <img src="<?php echo base_url();?>assets/admin/img/head.png" style="width: 100%;">
            <?php //}?>
            <div class="text-center" style=" font-weight: bold; margin-bottom: 10px">DAFTAR ACARA DAN DAFTAR HADIR PESERTA UJIAN SEMESTER GANJIL <?php echo $tahun.'/'.($tahun+1);?></div>
            <div class="text-justify" style="line-height: 2.5em; font-size: 14px">Pada Hari ini ..............Tanggal ..............Bulan <?php echo $bulan_tahun_text;?> telah diselenggarakan <?php echo $semester_text;?> TP. <?php echo $tahun.'/'.($tahun+1);?> Mata Pelajaran
                ............................................................................. dari pukul ............................ sampai dengan pukul ............................</div>
            <table>
                <tr>
                    <td style="line-height: 2.0em;"><strong>Kelas dan Jurusan</strong></td><td>:</td><td><?php echo $kelas." ".$jurusan." ".$jurusan_ke;?></td>
                </tr>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NISN</th>
                    <th>NAMA SISWA</th>
                    <th class="text-center" colspan="2">TANDA TANGAN</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $total = 0;
                $nomor = 0;
                $ganjil = 0;

                foreach($peserta as $item) {
                    $nomor++;

                    echo '<tr>';
                    echo '<td class="text-center" style="line-height: 2.5em">' . $nomor . '</th>';
                    echo '<td class="text-center" style="width: 40px; line-height: 2.5em">' . $item['peserta_nis'] . '</th>';
                    echo '<td class="text-left" style="line-height: 2.5em">' . $item['peserta_nama'] . '</th>';
                    echo '<td class="text-left" style="width: 150px; line-height: 2.5em">';
                    if ($ganjil == 0) {
                        echo $nomor;
                    }
                    echo '</th>';
                    echo '<td class="text-left" style="width: 150px; line-height: 2.5em; border-left: 0px;">';
                    if ($ganjil == 1) {
                        echo $nomor;
                    }
                    echo '</th>';
                    echo '</tr>';

                    $ganjil++;

                    if ($ganjil > 1) {
                        $ganjil = 0;
                    }

                    if($nomor == 20){
                        ?>
                        </tbody>
                    </table>
                </div>
            <div class="page text-center" style="line-height: 1.5em;margin-top: 40px">
                <table class="table">
                    <tbody>
                    <?php
                    }
                }

                ?>

                </tbody>
            </table>
            <table style="width: 100%; margin-top: 40px;">
                <tr>
                    <td class="text-left">Jumlah yang hadir ................</td>
                    <td class="text-left" rowspan="3" style="width: 30%">
                        <strong>PENGAWAS</strong><br>Candipuro,............................<?php echo $tahun;?><br><br><br><br><br>...................................................
                    </td>
                </tr>
                <tr>
                    <td class="text-left">Jumlah yang tidak hadir ................</td>
                </tr>
                <tr>
                    <td class="text-left">Nomor ................</td>
                </tr>
            </table>
        </div>
    <?php  ?>
		
    <script>
		//window.print();
    </script>

</body></html>