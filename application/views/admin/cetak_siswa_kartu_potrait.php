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
    $catatan = 'Kartu ini digunakan untuk login ke aplikasi CBT. Simpan dan jaga baik baik kartu ini, jangan sampai dihilangkan atau rusak!';
    $judul_kartu = 'KARTU AKUN PESERTA CBT';

    if(!empty($kustom)) $judul_kartu.= '<br>'.$kustom;

    $judul_kartu.= '<br><span style="font-size: 14px;color:#3A5B73">SMK NEGERI 1 CANDIPURO</span>';

    $key = md5($item['peserta_id']);

    echo '<td style="padding:10px;" valign="top">';

    echo '
    <table style="width:6.6cm;border:1px solid #112a47;  font-size: 14px; class="kartu">
        <tbody>
        <tr> 
        <td align="center" style="font-weight:bold; line-height: 0.5cm; padding: 4px;border-bottom:1px solid #112a47;">
                            '.$judul_kartu. '
                        <br/>
                    <strong style="font-size: 12px;color:#858987">NOMOR : ' .$item['peserta_nomor']. '</strong>
                        </td>
        </tr>

        <tr>
            <td style="text-align: center;  padding: 10px;">
            
                <div style="margin: 0 auto;">
                <div class="qrcode1" id="qr_'.$item['urut'].'" data-value="https://cbt.smkn1candipuro.sch.id/auth/signin_auto?level=peserta&key='.$key.'" title="'.$item['urut'].'"></div>
                <br/>
                <span>https://<strong>cbt.smkn1candipuro.sch.id</strong></span>
                </div>
                
            </td>
        </tr>
        
        <tr>
            <td style="text-align: center">
            
            <table style="width:100%;">
                <tr>
                    <td colspan="3">
                    <strong style="font-size: 14px">'.$item['peserta_nama']. '</strong>
                    <p>'.$item['peserta_kelas'].' '.$item['peserta_jurusan'].' '.$item['peserta_jurusan_ke'].'</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px 0px 0px 0px;">
                        <table class="table" style="width:100%;border:0.3px solid #858987;"  >
                        <tr>
                            <td align="left" style="padding-top: 8px;padding-bottom: 8px">Akun Login</td><td width="1">:</td><td align="left"><span style="font-size:12px;font-weight:bold;">' .$item['peserta_username'].'</span></td>
                        </tr>
                        <tr>
                            <td align="left" style="padding-top: 8px;padding-bottom: 8px">Kata Sandi</td><td width="1">:</td><td align="left"><span style="font-size:12px;font-weight:bold;">'.$item['peserta_password'].'</span></td>
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
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
        </tr>
              
        <tr>
            <td style="padding: 10px;">Catatan :<br/><i>'.$catatan.'</i></td>
        </tr>      
        

        </tbody>
    </table>';


    echo '</td>';

    if($posisi == 2){
        echo '</tr>';
    }

    $posisi++;
    $nomor++;
    $halaman++;

    if($posisi == 3) $posisi = 0;
    $h = 9;

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