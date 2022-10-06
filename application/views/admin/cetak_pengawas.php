<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>CETAK KARTU</title>

    <script>var base_url = '/';</script>

    <link href="<?php echo base_url('assets/css/cetak.min.css') ?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-migrate-1.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/qrcode.min.js') ?>"></script>

</head>
<body>
<style>
    .page {
        padding: 1cm;
    }

    td {
        padding: 10px;
    }
</style>
<?php
$posisi = 0;
$nomor = 0;
$halaman = 0;
foreach($pengawas as $item){
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

    echo '<td style="padding:10px;" valign="top">';

    echo '<table style="width:10.4cm;border:1px solid #eaeaeb;" class="kartu">
								<tbody><tr>
									<td colspan="4" style="border-bottom:1px solid #eaeaeb;background-color: #eaeaeb;">
										<table width="100%" class="kartu">
										<tbody><tr>
											<td><img src="' .base_url().'assets/img/logo.png" height="40"></td>
											<td align="center" style="font-weight:bold;">
												KARTU AKUN PENGAWAS<br> 
												SMK NEGERI 1 CANDIPURO
											</td>
											<td style="text-align: right">
											<div class="qrcode" id="qr_'.$item['user_id'].'" data-value="'.$item['user_id'].'" style="float: right; " title="'.$item['user_id'].'">
											</div>
											</td>
										</tr>
										</tbody></table>
									</td>
								</tr>
																								 								<tr><td>Username</td><td>:</td>
																								     <td style="font-size:12px;font-weight:bold;">'.$item['username'].'</td>
																							       </tr>
								<tr><td>Password</td><td>:</td>
								  <td style="font-size:12px;font-weight:bold;">'.$item['password'].'</td>
								  </tr>
								
							</tbody></table>';


    echo '</td>';

    if($posisi == 1){
        echo '</tr>';
    }

    $posisi++;
    $nomor++;
    $halaman++;

    if($posisi == 2) $posisi = 0;

    if($halaman == 12){
        echo '
				</tbody>
			</table>
		</center>
		</div>';

        if($halaman == 12) $halaman = 0;

    }
}
?>

<script>
    $('.qrcode').each(function(){
        new QRCode(document.getElementById($(this).attr('id')), {
            text: $(this).attr('data-value'),
            width: 50,
            height: 50,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    });
    window.print();
</script>

</body></html>