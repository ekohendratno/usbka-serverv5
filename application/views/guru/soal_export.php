<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>CETAK SOAL</title>

    <script>var base_url = '/';</script>

	<link href="<?php echo base_url('css/export.min.css') ?>" rel="stylesheet">
	
    <script src="<?php echo base_url('js/jquery.min.js') ?>"></script>	
    <script src="<?php echo base_url('js/jquery-migrate-1.4.1.min.js') ?>"></script>	
    <script src="<?php echo base_url('js/qrcode.min.js') ?>"></script>	
	
</head>
<body>
	<style>
		.page {
			padding: 1cm;
		}

		td {
			padding: 5px;
		}
	</style>
	<?php
	$posisi = 0;
	$nomor = 0;
	$halaman = 0;
		  
	echo '<div class="page">';
	foreach($soal as $item){
		echo $item['soal_tanya'];
		if( $item['soal_tanya'] == 'essay' ){
            echo $item['soal_opsi_a'];
            echo $item['soal_opsi_b'];
            echo $item['soal_opsi_c'];
            echo $item['soal_opsi_d'];
            echo $item['soal_opsi_e'];
        }
	}
	echo '</div>';
	?>
		
    <script>
		//window.print();
    </script>

</body></html>