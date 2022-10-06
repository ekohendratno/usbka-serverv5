<div class="container container-medium">

    <div class="row">
	<div class="col-md-8">

					<div class="panel panel-default">
						<div class="panel-heading">
                            <h4 class="panel-title text-center" style="padding-top: 7.5px;">PESAN</h4>
                            <div class="panel-title-button pull-right">
                                <a href="javascript:void(0)" id="pesan-reset" title="Reset" class="btn btn-sm btn-danger">Reset</a>
                                <a href="#form1" data-toggle="modal" id="pesan-add" title="Tambah" class="btn btn-sm btn-success">Buat Pesan</a>
							</div>
						</div>
                        <div class="panel-body" style="min-height: 250px;">
							<div id="loading_ajax1" style="position: absolute; left: 50%;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></div></div>

							<ul class="timeline">
							</ul>


						</div>
					</div>
	</div>
	<div class="col-md-4">
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12" style="display: none;">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h5><?php echo 0;?></h5>
                        <p>Soal</p>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-book"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h5><?php echo $jumlah_siswa;?></h5>
                        <p>Anggota Siswa/i</p>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h5><?php echo $jumlah_jurusan;?></h5>
                        <p>Jurusan</p>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-briefcase"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</div>



						<div class="modal fade" id="form1" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
										<div class="pesan"></div>
										<div class="row">
										<div class="col-md-2">

											<label>Kelas</label><br/>
											<select class="form-control"  id="kelas_sekarang" name="kelas_sekarang">
											<?php foreach($kelas as $item ){?>
											<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
											<?php }?>
											</select>

										</div>
                                            <div class="col-md-8">

                                                <label>Jurusan</label><br/>
                                                <select class="form-control"  id="jurusan_id" name="jurusan_id">
                                                    <?php foreach($jurusan as $item ){?>
                                                        <option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
                                                    <?php }?>
                                                </select>

                                            </div>
										<div class="col-md-2">

											<label>Ruang</label><br/>
											<select class="form-control"  id="ruang" name="ruang">
											<option value="0">ALL</option>
											<?php foreach($ruang as $item ){?>
											<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
											<?php }?>
											</select>

										</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>Pesan Pengumuman</label><br/>
												<textarea class="form-control" style="height:100px;" name="pesan_text" id="pesan_text" autofocus></textarea>
											</div>
										</div>
										<div class="clear"></div>
									</div>
									<div class="modal-footer">
									  <button class="btn btn-default" data-dismiss="modal">Close</button>
									  <button onclick="submitPesan()" class="btn btn-danger">Kirim</button>
									</div>
								</div>
							</div>
						</div>



	<link href="<?php echo base_url('css/soal.css') ?>" rel="stylesheet">
	<script src="<?php echo base_url();?>js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">

			tinyMCE.init({
								 selector: "textarea.form-control",
								 height: 100,
                                 min_height: 100,
								 menubar: false,statusbar:false,
								 plugins: 'autoresize searchreplace autolink directionality visualblocks visualchars fullscreen link table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
								 toolbar: 'alignleft aligncenter alignright alignjustify bold italic underline bullist numlist table forecolor backcolor link removeformat',
			});

		$('#loading_ajax').fadeOut("slow");
		$('#pesan-refresh').click(function(){
			searchFilter(0);
		});

		searchFilter(0);
		function searchFilter() {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>guru/pesan/timeline/',
				dataType:'json',
				beforeSend: function () {
					$('#loading_ajax1').show();
				},
				success: function (responseData) {
					//console.log(responseData);
					paginationData(responseData);
					$('#loading_ajax1').fadeOut("slow");
				}
			});
		}

		function paginationData(data) {
			$('ul.timeline').empty();
			$('ul.timeline').append('<li class="time-label"><span class="btn btn-success">Pengumuman Terakhir</span></li>');
			for(emp in data){
				var empRow = '<li><i class="glyphicon glyphicon-envelope"></i>'+
					'<div class="timeline-item">'+
					'<div class="timeline-header">'+
					'<strong><i class="glyphicon glyphicon-calendar"></i>'+data[emp].pesan_tanggal+'</strong>'+
					'<div class="pull-right">'+
					'<a href="javascript:void(0)" onclick="hapus('+data[emp].pesan_id+')" style="padding-left:10px;padding-right:10px;"><i class="glyphicon glyphicon-trash"></i></a>'+
					'</div>'+
					'</div>'+
					'<div class="timeline-body">'+data[emp].pesan_text+'</div>'+
					'<div class="timeline-footer"></div>'+
					'</div>'+
					'</li>';
				$('ul.timeline').append(empRow);
			}
			$('ul.timeline').append('<li><i class="glyphicon glyphicon-time"></i></li>');
		}

		function hapus(x){
			var tanya = confirm('Apakah yakin mau hapus data?');
			if(tanya){
				$.ajax({
				type:'POST',
				data: 'id='+x,
				url:'<?php echo base_url('guru/pesan/hapusdatabyid') ;?>',
				success: function(){
					searchFilter(0);
				}
			});
			}
		}

		function submitPesan(){

			$('#loading_ajax').show();
			var pesan_text =  tinyMCE.get("pesan_text").getContent();

			var kelas_sekarang =  $("[name='kelas_sekarang']").val();
			var jurusan_id =  $("[name='jurusan_id']").val();
			var ruang =  $("[name='ruang']").val();

			$.ajax({
				type:'POST',
				data: {
					pesan_text:pesan_text,
					kelas_sekarang:kelas_sekarang,
					jurusan_id:jurusan_id,
					ruang:ruang
				},
				url:'<?php echo base_url('guru/pesan/tambahdata') ;?>',
				dataType:'json',
				success: function(hasil){
					console.log(hasil);
					$('#loading_ajax').fadeOut("slow");
					$('.pesan').show();
					$('.pesan').html('<p class="bg-warning">'+hasil.pesan+'</p>');

					if(hasil.pesan == ''){
						window.location.assign("<?php echo base_url();?>guru/pesan");
					}
				}
			});
		}
	</script>