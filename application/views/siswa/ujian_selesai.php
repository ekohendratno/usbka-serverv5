<div class="wrapper" style="height: auto; min-height: 100%;">
	<div class="container container-medium">

	
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
					
				<div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title text-center" style="padding-top: 7.5px;">NILAI HASIL MENGERJAKAN</h4>
                    </div>
					<div class="panel-body">
						
						<div class="clear"></div>
						<div class="row">
							<div class="col-md-12">
								<div class="text-center"><span class="x2"><strong><?php echo $soal_jawab[0]['soal_jawab_nilai'];?></strong></span><br><br>NILAI KAMU</div>
							</div>
						</div>
						
						<br>
						<?php if($soal_jawab[0]['ujian_kkm'] > 0 ){?>
						<?php if($soal_jawab[0]['soal_jawab_nilai'] < $soal_jawab[0]['ujian_kkm'] ){?>	
						<div class="alert alert-danger" role="alert">
						  <strong>Harap diperhatikan</strong> nilai kamu dibawah ambang minimum kkm "<?php echo $soal_jawab[0]['ujian_kkm'];?>", <strong>dimohon belajar kembali</strong>!
						</div>
						<?php /*}elseif($soal_jawab[0]['soal_jawab_nilai'] <= ((100-$soal_jawab[0]['ujian_kkm'])/2)+$soal_jawab[0]['ujian_kkm'] ){?>	
						<div class="alert alert-success" role="alert">
						  <strong>Bagus</strong> nilai kamu telah mencapai harapan, <strong>pertahankan dan tingkatkan lagi prestasim</strong>u!
						</div>
						<?php */}elseif($soal_jawab[0]['soal_jawab_nilai'] <= 100 ){?>	
						<div class="alert alert-default" role="alert">
						  <strong>Selamat</strong> nilai kamu memuaskan, <strong>harap pertahankan prestasimu</strong>!
						</div>
						<?php }?>
						<?php }else{?>
						
						<?php if($soal_jawab[0]['soal_jawab_nilai'] < 50 ){?>	
						<div class="alert alert-danger" role="alert">
						  <strong>Harap diperhatikan</strong> nilai kamu dibawah "50" alias "<?php echo $soal_jawab[0]['soal_jawab_nilai'];?>", <strong>dimohon belajar kembali lebih giat lagi</strong>!
						</div>
						<?php }elseif($soal_jawab[0]['soal_jawab_nilai'] < 80 ){?>	
						<div class="alert alert-default" role="alert">
						  <strong>Perhatian</strong> nilai kamu diatas "49" dibawah "80" alias "<?php echo $soal_jawab[0]['soal_jawab_nilai'];?>", <strong>harap tingkatkan kambali belajarmu</strong>!
						</div>
						<?php }elseif($soal_jawab[0]['soal_jawab_nilai'] < 100 ){?>	
						<div class="alert alert-default" role="alert">
						  <strong>Selamat</strong> nilai kamu diatas "89" dibawah "100" alias "<?php echo $soal_jawab[0]['soal_jawab_nilai'];?>", <strong>pertahankan dan tingkatkan belajarmu</strong>!
						</div>
						<?php }elseif($soal_jawab[0]['soal_jawab_nilai'] == 100 ){?>	
						<div class="alert alert-default" role="alert">
						  <strong>Selamat</strong> nilai kamu sempurna, <strong>pertahankan</strong>!
						</div>
						<?php }?>
						
						<?php }?>
						
						<hr>
						<div class="row">
							<div class="col-xs-3">
								<div class="small-box bg-blue">
									<div class="inner">
										<h2><?php echo $soal_jawab[0]['soal_jawab_ok'];?></h2>
										<p>Soal yang dikerjakan</p>
									</div>
									<div class="icon">
										<i class="glyphicon glyphicon-check"></i>
									</div>
								</div>
								
							</div>
							<div class="col-xs-3">
								<div class="small-box bg-yellow">
									<div class="inner">
										<h2><?php echo $soal_jawab[0]['soal_jawab_none'];?></h2>
										<p>Soal tidak dikerjakan</p>
									</div>
									<div class="icon">
										<i class="glyphicon glyphicon-unchecked"></i>
									</div>
								</div>
								
							</div>
							<div class="col-xs-3">
								<div class="small-box bg-olive">
									<div class="inner">
										<h2><?php echo $soal_jawab[0]['soal_jawab_benar'];?></h2>
										<p>Soal terjawab benar</p>
									</div>
									<div class="icon">
										<i class="glyphicon glyphicon-ok"></i>
									</div>
								</div>
								
							</div>
							<div class="col-xs-3">
								<div class="small-box bg-red">
									<div class="inner">
										<h2><?php echo $soal_jawab[0]['soal_jawab_salah'];?></h2>
										<p>Soal terjawab salah</p>
									</div>
									<div class="icon">
										<i class="glyphicon glyphicon-remove"></i>
									</div>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>
<style type="text/css">
.x2 {
	font-size: 80px;
	padding: 15px;
	width: 80px;
	height: 80px;
    border-radius:50%;
    -moz-border-radius:50%;
    -webkit-border-radius:50%;
    -khtml-border-radius: 50%;
    text-align:center;
}
.x3 {
	font-size: 10px;
	padding: 15px;
    border-radius:50%;
    -moz-border-radius:50%;
    -webkit-border-radius:50%;
    -khtml-border-radius: 50%;
    background:#eee;
    text-align:center;
}
.x4 {
	padding:5px;
	margin-top: 35px;
    border-radius:15px;
    -moz-border-radius:15px;
    -webkit-border-radius:15px;
    -khtml-border-radius: 15px;
    background:#eee;
    text-align:center;
}

@media (max-width: 320px) 
{
    .x1 .x2 {padding: 50%;}
}

@media (min-width: 321px) and (max-width: 800px)
{
    .x1 .x2 {padding: 25%;}
}

@media (min-width: 801px)
{
    .x1 .x2 {padding: 12.5%;}
}

</style>