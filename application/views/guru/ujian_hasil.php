<div class="container container-medium">


        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
                        <h4 class="panel-title text-center" style="padding-top: 7.5px;"> DATA HASIL UJIAN</h4>
                        <div class="panel-title-button pull-right">
						  <a href="#form2" data-toggle="modal" class="btn"><span class="fas fa-filter"></span></a>
						  <a href="#form3" data-toggle="modal" onClick="submit('cetak')" class="btn" style="display: none"><span class="fas fa-print"></span></a>
					  </div>
					</div>
					<div class="panel-body">

						<table id='postList' class="table table-striped table-hover">
									<thead>				
										<tr>
											<th width="50" class="text-center">NO</th>
											<th>NAMA</th>
											<th class="text-center">B</th>
											<th class="text-center">S</th>
											<th class="text-center">N</th>
                                            <th class="text-center">STATUS</th>
                                            <?php if($lock_ujian == 't'){?>
											<th class="text-center" width="150"><span class="glyphicon glyphicon-cog"></span></th>
                                            <?php }?>
										</tr>
									</thead>
									<tbody></tbody>		
						</table>
						<div id='pagination'></div>


						<div class="modal fade" id="form2" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
										<div class="row">
											
											
										<div class="col-md-4">
											<label for="sortBy">Urutkan Nama</label><br/>
											<select class="form-control"  id="sortBy" onchange="searchFilter()">
												<option value="">Sort By</option>
												<option value="asc">Ascending</option>
												<option value="desc">Descending</option>
											</select>
										</div>
										<div class="col-md-4">
											<label for="nilaiBy">Urutkan Nilai</label><br/>
											<select class="form-control"  id="nilaiBy" onchange="searchFilter()">
												<option value="">Sort By</option>
												<option value="asc">Ascending</option>
												<option value="desc">Descending</option>
											</select>
										</div>
										<div class="col-md-4">
											<label for="limitBy">Limit</label><br/>
											<select class="form-control"  id="limitBy" onchange="searchFilter()">
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</div>
										<div class="col-md-3">
											<label for="kelasBy">Kelas</label><br/>
											<select class="form-control"  id="kelasBy" onchange="searchFilter()">
												<option value="">Semua Kelas</option>
												<option value="x"<?php if($kelas_sekarang == 'x') echo ' selected="selected"'?>>X</option>
												<option value="xi"<?php if($kelas_sekarang == 'xi') echo ' selected="selected"'?>>XI</option>
												<option value="xii"<?php if($kelas_sekarang == 'xii') echo ' selected="selected"'?>>XII</option>
											</select>
										</div>
										<div class="col-md-6">
											<label for="jurusanBy">Jurusan</label><br/>
											<select class="form-control"  id="jurusanBy" onchange="searchFilter()">
                                                <option value="0"<?php if($jurusan_id == 0) echo ' selected="selected"'?>>Semua Jurusan</option>
												<?php foreach($this->m->getdata('jurusan') as $item ){?>
												<option value="<?php echo $item->jurusan_id?>"<?php if($jurusan_id == $item->jurusan_id) echo ' selected="selected"';?>><?php echo $item->jurusan_title?></option>
												<?php }?>
											</select>
										</div>
										<div class="col-md-3">
											<label for="ruangBy">Ruang</label><br/>
											<select class="form-control"  id="ruangBy" onchange="searchFilter()">
												<option value="0"<?php if($ruang == 0) echo ' selected="selected"'?>>Semua Ruang</option>
												<option value="1"<?php if($ruang == 1) echo ' selected="selected"'?>>1</option>
												<option value="2"<?php if($ruang == 2) echo ' selected="selected"'?>>2</option>
												<option value="3"<?php if($ruang == 3) echo ' selected="selected"'?>>3</option>
											</select>
										</div>
										<div class="col-md-12">
											<label for="pelajaranBy">Pelajaran</label><br/>
											<select class="form-control"  id="pelajaranBy" onchange="searchFilter()">
												<?php foreach($pelajaran as $item ){?>
												<option value="<?php echo $item['pelajaran_id'];?>"<?php if($pelajaran_id == $item['pelajaran_id']) echo ' selected="selected"';?>><?php echo $item['pelajaran_title']?></option>
												<?php }?>
											</select>
										</div>
											
										<div class="col-md-12">
											<label for="keteranganBy">Soal Keterangan</label><br/>
											<select class="custom-select d-block w-100 form-control" id="keteranganBy" name="keteranganBy" required>
											</select>
										</div>

                                            <div class="col-md-12">
                                                <label>Tampilkan semua data</label><br>
                                                <a href="<?php echo base_url(). "index.php/guru/ujian/index"; ?>" class="btn btn-primary">Show All</a>
                                            </div>

										<div class="clear"></div>
										</div>
									</div>
									
								</div>
							</div>	
						</div>
						
						
						

						
						
						<div class="modal fade" id="form3" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-status"></div>
									<div class="modal-body">
										<div class="row">
										<div class="col-md-2">
											
											<label>Kelas</label><br/>
											<select class="form-control"  id="kelas_sekarang2" name="kelas_sekarang2">
											<?php foreach($datakelas as $item ){?>
											<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
											<?php }?>
											</select>
											
										</div>
										<div class="col-md-8">
											
											<label>Jurusan</label><br/>
											<select class="form-control"  id="jurusan_id2" name="jurusan_id2">			
											<?php foreach($datajurusan as $item ){?>
											<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
											<?php }?>
											</select>
											
										</div>
										<div class="col-md-2">
											
											<label>Ruang</label><br/>
											<select class="form-control"  id="ruang2" name="ruang2">									
											<option value="0">ALL</option>
											<?php foreach($dataruang as $item ){?>
											<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
											<?php }?>
											</select>
											
										</div>
										</div>
										
										<div class="row">
										<div class="col-md-12">
											<div class="pelajaran_id2">
												<label for="pelajaran_id2">Pelajaran</label><br/>
												<select class="custom-select d-block w-100 form-control" id="pelajaran_id2" name="pelajaran_id2" required>
                                                    <?php foreach($pelajaran as $item ){?>
                                                        <option value="<?php echo $item['pelajaran_id'];?>"<?php if($pelajaran_id == $item['pelajaran_id']) echo ' selected="selected"';?>><?php echo $item['pelajaran_title']?></option>
                                                    <?php }?>
												</select>
											</div>
											</div>
											<div class="col-md-12">
												<div class="soal_keterangan2">
												<label for="soal_keterangan2">Soal Keterangan</label><br/>
												<select class="custom-select d-block w-100 form-control" id="soal_keterangan2" name="soal_keterangan2" required>
												</select>
												</div>											
											</div>
										</div>
										<div class="clear"></div>
									</div>
									<div class="modal-footer">
									  	<a href="#" class="btn btn-default" data-dismiss="modal">Close</a> 
										<button onclick="cetak()" type="button" id="btn-cetak" class="btn btn-primary">Cetak</button> 
									</div>
								</div>
							</div>	
						</div>
						
						
						

					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">


		$(document).ready(function(){
			//setInterval(searchFilter,3000);
		});

		var ujian_id = '<?php echo $ujian_id;?>';
		$('.pelajaranId').hide();

		callKeterangan();

		$("#pelajaranBy").change(function(){
			$('#keteranganBy').fadeIn("slow");
			callKeterangan();
		});


		function callKeterangan(pelajaran_id, keterangan){
			var value = $('#pelajaranBy').val();
			if(!value) value = pelajaran_id;

			$('#keteranganBy')
				.children()
				.remove()
				.end()
				.append('<option value="">Loading...</option>');

			$.ajax({
				type:'POST',
				url:'<?php echo base_url('guru/ujian/keterangan') ;?>',
				data: 'pelajaran_id='+value,
				dataType: 'json',
				success: function(data){
					var html = '<option value=\'\'>--Pilih Semua Keterangan--</option>';
					var i;
					for(i=0; i<data.length; i++){
						var selected = '';
						if(keterangan != '' && data[i].soal_keterangan == keterangan) selected = ' selected';
						html += '<option value="'+data[i].soal_keterangan+'"'+selected+'>'+data[i].soal_keterangan+'</option>';
					}
					$('#keteranganBy').empty();
					$('#keteranganBy').html(html);
				}
			});
		}

		searchFilter(0);

		function searchFilter(page_num) {
			page_num = page_num?page_num:0;
			var sortBy = $('#sortBy').val();
			var nilaiBy = $('#nilaiBy').val();
			var limitBy = $('#limitBy').val();
			var kelasBy = $('#kelasBy').val();
			var jurusanBy = $('#jurusanBy').val();
			var ruangBy = $('#ruangBy').val();
			var pelajaranBy = $('#pelajaranBy').val();
			var keteranganBy = $('#keteranganBy').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>guru/ujian/ajaxPaginationDataHasil/'+page_num,
				data:'page='+page_num+'&nilaiBy='+nilaiBy+'&sortBy='+sortBy+'&limitBy='+limitBy+'&kelasBy='+kelasBy+'&jurusanBy='+jurusanBy+'&ruangBy='+ruangBy+'&pelajaranBy='+pelajaranBy+'&keteranganBy='+keteranganBy+'&id='+ujian_id,
				dataType:'json',
				beforeSend: function () {
					$('#loading_ajax').show();
				},
				success: function (responseData) {
					//console.log(responseData);
					$('#pagination').html(responseData.pagination);
					paginationData(responseData.empData);
					$('#loading_ajax').fadeOut("slow");
				}
			});
		}

		function paginationData(data) {

			$('#postList tbody').empty();
			var nomor = 1;
			for(emp in data){
				var ujian_id = data[emp].ujian_id;

				var untuk = '';

				if(data[emp].kelas_sekarang != ''){
					untuk +='<span class="label label-success">'+data[emp].kelas_sekarang+'</span>';
				}
				if(data[emp].jurusan_id != ''){
					untuk +=' <span class="label label-primary">'+data[emp].jurusan_title+'</span>';
				}

				if(data[emp].ruang != ''){
					untuk +=' <span class="label label-primary">'+data[emp].ruang+'</span>';
				}



				var status = ' <span class="label label-warning">Mengerjakan</span>';
                if(data[emp].status == 'N'){
                    status =' <span class="label label-success">Selesai</span>';
                }

				//var status = data[emp].status;

				//if(data[emp].status == 'N'){

				var nilai_html = '';
				var nilai = data[emp].soal_jawab_nilai;

				if(nilai < 60 )
				nilai_html = '<span class="label label-danger">'+data[emp].soal_jawab_nilai+'</span>';
				else if(nilai < 70 )
				nilai_html = '<span class="label label-warning">'+data[emp].soal_jawab_nilai+'</span>';
				else if(nilai < 80 )
				nilai_html = '<span class="label label-success">'+data[emp].soal_jawab_nilai+'</span>';
				else if(nilai <= 100 )
				nilai_html = '<span class="label label-primary">'+data[emp].soal_jawab_nilai+'</span>';

				var empRow = '<tr>'+
							'<td class="text-center">'+nomor+'</td>'+
							'<td>'+data[emp].siswa_nama+'<br><span class="label label-default">'+data[emp].soal_jawab_jam_selesai+'</span></td>'+
							'<td class="text-center"><span class="label label-success">'+data[emp].soal_jawab_benar+'</span></td>'+
							'<td class="text-center"><span class="label label-danger">'+data[emp].soal_jawab_salah+'</span></td>'+
							'<td class="text-center">'+nilai_html+'</td>'+
                            '<td class="text-center">'+status+'</td>'+
                            <?php if($lock_ujian == 't'){?>
							'<td class="text-center"><div class="btn-group" role="group"><a onclick="hapus('+data[emp].soal_jawab_id+')" class="btn" style="color: #d9534f;"><span class="fas fa-trash"></span></a></div></td>'+
                            <?php }?>
							+'</tr>';
				nomor++;
				$('#postList tbody').append(empRow);

				//}
			}
		}

		function submit(x){

			if(x == 'cetak'){

			}else{

			$('#loading_ajax').fadeOut("slow");
			//$('#form1').modal('hide');
			$('#btn-tambah').show();
			$('#btn-ubah').hide();

			var pelajaran_id =  $("[name='pelajaranid']").val();

			var kelas_sekarang = $('#datakelas').val();
			var jurusan_id = $('#datajurusan').val();
			var ruang = $('#dataruang').val();

			window.location.assign("<?php echo base_url();?>guru/soal/post?pelajaran_id="+pelajaran_id+"&kelas_sekarang="+kelas_sekarang+"&jurusan_id="+jurusan_id+"&ruang="+ruang);

			}
		}


		function hapus(x){
			$('#loading_ajax').show();
			var tanya = confirm('Apakah yakin mau hapus data?');
			if(tanya){
				$.ajax({
				type:'POST',
				data: 'id='+x,
				url:'<?php echo base_url('guru/ujian/hapushasilbyid') ;?>',
				success: function(){
					searchFilter(0);
				}
			});
			}
		}
	</script>