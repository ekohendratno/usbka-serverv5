<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>CETAK KARTU PESERTA</title>

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
    $catatan = 'Kartu ini digunakan untuk UKK. Simpan dan jaga baik baik kartu ini, jangan sampai dihilangkan atau rusak!';
    $judul_kartu = 'KARTU UJI PESERTA UKK';

    $judul_kartu.= '<br><span style="font-size: 14px;color:#3A5B73">SMK NEGERI 1 CANDIPURO</span>';
    
    if(!empty($kustom)) $judul_kartu.= '<br>'.$kustom;


    $key = md5($item['peserta_id']);

    echo '<td style="padding:10px;" valign="top">';

    echo '
    <table style="width:100%; border:1px solid #112a47;  font-size: 14px;" class="kartu">
        <tbody>
        <tr> 
        <td colspan="2" align="center" style="font-weight:bold; line-height: 0.5cm; padding: 4px;border-bottom:1px solid #112a47;">
                            '.$judul_kartu. '
                        </td>
        </tr>
        
        <tr>
            <td style="text-align: center">
            
            <table style="width:100%;">
                <tr>
                    <td colspan="3">
                    <strong style="font-size: 14px; color:#808080">'.$item['peserta_nomor']. '</strong><br/>
                    <strong style="font-size: 14px">'.$item['peserta_nama']. '</strong>
                    <p>'.$item['peserta_kelas'].' '.$item['peserta_jurusan'].' '.$item['peserta_jurusan_ke'].'</p>
                    </td>
                </tr>
                <tr style="display: none;">
                    <td colspan="3">
                    
                    <table style="width:100%;" border="1">
                    
                    <tr><td width="1"><strong>NO</strong></td><td align="left"><strong>MATA PELAJARAN</strong></td></tr>
                    <tr><td>1</td><td align="left">Mata Pelajaran</td></tr>
                    
                    </table>
                    
                    
                    </td>
                </tr>
            </table>
            
            
            </td>
            <td>
            
            <table class="table" style="width:200px; border:1px solid #112a47;  font-size: 14px;" border="1">
            
                        <thead>
                        <tr>
                            <td align="left" style="padding-top: 8px;padding-bottom: 8px;" ><strong>Ujian</sctrong></td><td align="center"><strong>Diperiksa</sctrong></td>
                        </tr>
                        </thead>
                        
                        <tbody>
                        <tr>
                            <td align="left" style="padding-top: 8px;padding-bottom: 8px;" >Perakitan</td><td align="left"></td>
                        </tr>
                        <tr>
                            <td align="left" style="padding-top: 8px;padding-bottom: 8px">Instalasi</td><td align="left"></td>
                        </tr>
                        <tr>
                            <td align="left" style="padding-top: 8px;padding-bottom: 8px">Pengkabelan</td><td align="left"></td>
                        </tr>
                        <tr>
                            <td align="left" style="padding-top: 8px;padding-bottom: 8px">Konfigurasi</td><td align="left"></td>
                        </tr>
                        </tbody>
                        
                        </table>
            
            </td>
        </tr>      
        

        </tbody>
    </table>';


    echo '</td>';

    if($posisi == 1){
        echo '</tr>';
    }

    $posisi++;
    $nomor++;
    $halaman++;

    if($posisi == 2) $posisi = 0;
    $h = 10;

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

<style>
    .table tbody tr:nth-child(even) {
        background: #FFF;
    }
</style>

<script>
    $('.qrcode1').each(function(){
        new QRCode(document.getElementById($(this).attr('id')), {
            text: $(this).attr('data-value'),
            width: 64,
            height: 64,
            colorDark : "#3A5B73",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });


    });

    setTimeout(function(){
        $('.qrcode1 img').removeAttr("style");
    },3000);


    //window.print();
</script>

</body></html>