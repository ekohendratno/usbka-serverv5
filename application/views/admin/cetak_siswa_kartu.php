<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>CETAK KARTU - <?php echo strtoupper($kelas).'.'.strtoupper($jurusan);?></title>

    <script>var base_url = '/';</script>

    <?php if($untuk != 'nomor') {?>
        <link href="<?php echo base_url('assets/admin/css/cetak2a.min.css') ?>" rel="stylesheet">
    <?php }else{?>
        <link href="<?php echo base_url('assets/admin/css/cetak2.min.css') ?>" rel="stylesheet">
    <?php }?>

    <script src="<?php echo base_url('assets/admin/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/jquery-migrate-1.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/qrcode.min.js') ?>"></script>

</head>
<body>
<style>
    .page {
        padding: 1cm;
    }

    <?php if($untuk != 'nomor') {?>
    /**
    Folio
     */
    .page {
        width: 215.9mm;
        min-height: 330.2mm;
    }

    @media print {
        @page {
        }
    }

    <?php }?>


    td {
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 2px;
    }
</style>
<?php
$posisi = 0;
$nomor = 0;
$halaman = 0;
foreach($peserta as $item){
    if($halaman == 0){
        echo '
		<div class="page">
		<center>
			<table align="center" width="100%">
				<tbody>';
    }

    if($posisi == 0){
        echo '<tr>';
    }

    $tahun = date('Y');

    $judul_kartu = 'KARTU AKUN PESERTA CBT';

    if($untuk == 'ujian'){
        $judul_kartu = "KARTU AKUN PESERTA CBT";
    }elseif($untuk == 'demo') {
        $judul_kartu = "KARTU AKUN SIMULASI CBT";
    }elseif($untuk == 'nomor') {
        $judul_kartu = "KARTU TEMPAT PESERTA CBT";
    }

    if(!empty($kustom)) $judul_kartu.= '<br>'.$kustom;

    $judul_kartu.= '<br><span style="font-size: 14px">SMK NEGERI 1 CANDIPURO</span>';
    $judul_kartu.= '<br>TAHUN AJARAN '.$tahun.'/'.($tahun+1);

    $rowx = 5;
    $catatan = 'Kartu ini digunakan untuk login ke aplikasi CBT. Simpan dan jaga baik baik kartu ini, jangan sampai dihilangkan atau rusak!';
    if($untuk == 'demo') $catatan = 'Kartu ini tidak berlaku untuk ujian sesungguhnya!';
    else if($untuk == 'nomor') {
        $rowx = 4;
        $catatan = 'Kartu ini untuk ditempel pada meja ujian sebagai penanda tempat untuk peserta!';
    }

    echo '<td style="padding:10px;" valign="top">';

    echo '
    <table style="width:10.4cm;border:1px solid #112a47;  class="kartu">
        <tbody>
        <tr>
            <td colspan="2" style="border-bottom:1px solid #112a47;">
                <table width="100%" class="kartu">
                    <tbody><tr>
                        <td style="padding: 4px;border-right:1px solid #112a47;"><img src="' .base_url().'assets/images/logo_twh.png" height="40"></td>
                        <td align="center" style="font-weight:bold; padding: 4px;">
                            '.$judul_kartu.'
                        </td>
                        <td style="padding: 4px;border-left:1px solid #112a47; text-align: right">
                            <div style="text-align: center">PESERTA</div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td>Nomor Peserta :<br/><strong>'.$item['peserta_nomor'].'</strong></td>

            <td rowspan="'.$rowx.'" style="width: 60px; alignment: center; text-align: center;  border-left: 0px solid #000;" valign="top">
            
            
                <table style="width100%;height: 100%;">
                    <tbody>
                    <tr>
                        <td style="text-align: center;"><img src="'.$item['peserta_foto'].'" style="width: 60px; border: 1px solid #000;"/></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><div class="qrcode" style="text-align: center;" id="qr_'.$item['urut'].'" data-value="'.base_url().'" title="'.$item['urut'].'"></div></td>
                    </tr>
                    </tbody>
                </table>
            
                
            </td>
        </tr>
        <tr>
            <td>Nama Peserta :<br/><strong>'.$item['peserta_nama'].'</strong></td>
        </tr>
        <!--
        <tr>
            <td>Nama Peserta :<br/><strong>'.$item['peserta_nama'].'</strong></td>
        </tr>-->
        <tr>
            <td>Kelas & Program Keahlian :<br/><strong>'.$item['peserta_kelas'].' '.$item['peserta_jurusan'].' '.$item['peserta_jurusan_ke'].'</strong></td>
        </tr>';

    if($untuk != 'nomor') {
        echo '
        <tr>
            <td>Akun Login :<br/><div style="clear: both; padding: 2px;"></div><span style="border: 0.5px solid #000; padding: 2px;font-size:12px;font-weight:bold;">'.$item['peserta_username'].'</span></td>
        </tr>
        <tr>
            <td>Kata Sandi :<br/><div style="clear: both; padding: 2px;"></div><span style="border: 0.5px solid #000; padding: 2px;font-size:12px;font-weight:bold;">'.$item['peserta_password'].'</span></td>
        </tr>';
        }
        echo '
        <tr>
            <td>Catatan :<br/><i>'.$catatan.'</i></td>
        </tr>

        </tbody>
    </table>
    ';


    echo '</td>';

    if($posisi == 1){
        echo '</tr>';
    }

    $posisi++;
    $nomor++;
    $halaman++;

    if($posisi == 2) $posisi = 0;

    //$h = 8;
    //if($untuk == 'nomor') {
        $h = 10;
    //}

    if($halaman == $h){
        echo '
				</tbody>
			</table>
		</center>
		</div>';

        if($halaman == $h) $halaman = 0;

    }
}
?>

<script>
    $('.qrcode').each(function(){
        new QRCode(document.getElementById($(this).attr('id')), {
            text: $(this).attr('data-value'),
            width: 60,
            height: 60,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    });

    window.print();
</script>

</body></html>