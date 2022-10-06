<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>CETAK DATA BUKU</title>

    <script>var base_url = '/';</script>

	<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/cetak_hadir.css') ?>" rel="stylesheet">
	
    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-migrate-1.4.1.min.js') ?>"></script>
	
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
	<div class="page">
		<center>
			<h3><strong>DAFTAR HADIR PENGAWAS</strong></h3>
            <h5>SMK NEGERI 1 CANDIPURO</h5><br>
			
			<table class="table table-striped table-hover table-bordered">
				<thead>				
					<tr>
						<th class="text-center">NO</th>
						<th>NAMA PENGAWAS</th>
						<th class="text-center">JUMLAH SISWA</th>
						<th class="text-center">TIDAK HADIR</th>
                        <th class="text-center">TOTAL HADIR</th>
						<th class="text-center">TTD</th>
					</tr>	
				</thead>
				<tbody>
<?php
	$total = 0;
	$nomor = 0;
	foreach($pengawas as $item){
		$nomor++;

		echo '<tr>';
		echo '<td class="text-center">'.$nomor.'</th>';
		echo '<td>a</th>';
		echo '<td></th>';
		echo '<td></th>';
        echo '<td></th>';
        echo '<td></th>';
		echo '</tr>';
	}
		  
?>
				
				</tbody>		
			</table>
			
		</center>
		</div>
		
    <script>
		 window.print();
    </script>

</body></html>