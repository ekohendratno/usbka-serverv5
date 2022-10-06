<div class="container container-medium">


        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<b>DATA JADWAL</b>
					</div>
					<div class="panel-body">

						
						<div class="row">
									<div class="col-md-9">
										<div class="col-md-2" style="padding-left: 0px;">
										<select class="form-control"  id="sortBy" onchange="searchFilter()">
											<option value="">Sort By</option>
											<option value="asc">Ascending</option>
											<option value="desc">Descending</option>
										</select>
										</div>
										<div class="col-md-2">
										<select class="form-control"  id="limitBy" onchange="searchFilter()">
											<option value="10">10</option>
											<option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="150">150</option>
                                            <option value="200">200</option>
										</select>
										</div>
										<div class="col-md-3">
										<select class="form-control"  id="jurusanBy" onchange="searchFilter()">
											<?php foreach($this->m->getdata('jurusan') as $item ){?>
											<option value="<?php echo $item->jurusan_id?>"><?php echo $item->jurusan_title?></option>
											<?php }?>
										</select>
										</div>
										<div class="col-md-2">
										<a href="<?php echo base_url(). "index.php/admin/jadwal/index"; ?>" class="btn btn-primary">Show All</a>
										</div>
									</div>
									<div class="col-md-3 text-right">
										<a href="#form" data-toggle="modal" onclick="submit('tambah')" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-plus"></span> Tambah Data Baru</a>
									</div>
						</div>
						<br/>
						<table id='postList' class="table table-striped table-hover table-bordered">
									<thead>				
										<tr>
											<th width="50" class="text-center">NO</th>
											<th>PELAJARAN</th>
											<th class="text-center">JAM MULAI</th>
											<th class="text-center">JAM SELESAI</th>
											<th class="text-center">PENGAJAR</th>
											<th class="text-center" width="100"><span class="glyphicon glyphicon-cog"></span></th>
										</tr>
									</thead>
									<tbody></tbody>		
						</table>
						<div id='pagination'></div>

						<div class="modal fade" id="form" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
										<div class="row">
										<div class="col-md-2">
											<label>TA</label><br/>
											<input type='text' class="form-control" id='datata' value="<?php echo date('Y');?>" />
											<input type='hidden' class="form-control" id='id' value="" />
										</div>
										<div class="col-md-4">
											<label>Hari</label><br/>
											<select class="form-control"  id="datahari">
											<?php foreach($hari as $item ){?>
											<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
											<?php }?>
											</select>
										</div>
										<div class="col-md-3">
											<label>Mulai</label><br/>
											<input type='text' class="form-control" id='datastart' value="" />
										</div>
										<div class="col-md-3">
											<label>Selesai</label><br/>
											<input type='text' class="form-control" id='dataend' value="" />
										</div>
										</div>
										<div class="row">
										<div class="col-md-2">
											
											<label>Kelas</label><br/>
											<select class="form-control"  id="datakelas">
											<option value="x">X</option>
											<option value="xi">XI</option>
											<option value="xii">XII</option>
											</select>
											
										</div>
										<div class="col-md-8">
											
											<label>Jurusan</label><br/>
											<select class="form-control"  id="datajurusan">
											<?php foreach($jurusan as $item ){?>
											<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
											<?php }?>
											</select>
											
										</div>
										<div class="col-md-2">
											
											<label>Ruang</label><br/>
											<select class="form-control"  id="dataruang">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											</select>
											
										</div>
										</div>
										
										<div class="row">
										<div class="col-md-12">
											
											<label>Pelajaran</label><br/>
											<select class="form-control"  id="datapelajaran">
											<option value="">--Pilih Materi Pelajaran--</option>
											<?php foreach($pelajaran as $item ){?>
											<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
											<?php }?>
											</select>
										</div>
										</div>
										
										<div class="row">
										<div class="col-md-12">
											
											<label>Pengajar</label><br/>
											<select class="form-control"  id="dataguru">
											<option value="">--Pilih Pengajar--</option>
											<?php foreach($guru as $item ){?>
											<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
											<?php }?>
											</select>
										</div>
										</div>
										<div class="clear"></div>
									</div>
									<div class="modal-footer">
									  	<button class="btn btn-default" data-dismiss="modal">Close</button>
										<button onclick="tambahdata()" type="button" id="btn-tambah" class="btn btn-primary">Tambah</button> <button onclick="simpandata()" type="button" id="btn-ubah" class="btn btn-primary">Ubah</button> 
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
			
			var today = new Date();		
			var time = today.getHours() + ":" + today.getMinutes();
				
				
			$('#datastart').timepicker({
					timeFormat: 'HH:mm',
					autoSize: true,
					showAnim: 'slideDown'
			}).timepicker('setTime', new Date()).val(time);
			$('#dataend').timepicker({
					timeFormat: 'HH:mm',
					autoSize: true,
					showAnim: 'slideDown'
			}).timepicker('setTime', new Date()).val(time);
		});
		
		searchFilter(0);
		function searchFilter(page_num) {
			page_num = page_num?page_num:0;
			var keywords = $('#keywords').val();
			var sortBy = $('#sortBy').val();
			var limitBy = $('#limitBy').val();
			var jurusanBy = $('#jurusanBy').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/admin/jadwal/ajaxPaginationData/'+page_num,
				data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&jurusanBy='+jurusanBy,
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
				var hari = data[emp].hari_title;
				//console.log(data[emp].tanggal);
				var empRow = '<tr>'+
					'<th colspan="6">'+hari.toUpperCase()+'</th>'+
					+'</tr>';
				
				var hari_data = data[emp].hari_data;
				for(emp1 in hari_data){	
					var jadwal_id = hari_data[emp1].jadwal_id;
					var kelas = hari_data[emp1].kelas_sekarang;
					var jurusan_id = hari_data[emp1].jurusan_id;
					var jurusan_title = hari_data[emp1].jurusan_title;
					var ruang = hari_data[emp1].ruang;
					var hari_id = data[emp].hari_id;
					var start = hari_data[emp1].jadwal_jam_start;
					var end = hari_data[emp1].jadwal_jam_end;
					var pelajaran_id = hari_data[emp1].pelajaran_id;
					var pelajaran_title = hari_data[emp1].pelajaran_title;
					var pengajar = hari_data[emp1].guru_nama;
					
					empRow+= '<tr>'+
							'<td class="text-center">'+nomor+'</td>'+
							'<td><span class="label label-default">'+kelas.toUpperCase()+'</span> <span class="label label-default">'+jurusan_title+'</span> <span class="label label-default">'+ruang+'</span><br><span class="label label-success">'+pelajaran_title+'</span></td>'+
							'<td class="text-center"><span class="label label-primary">'+start+'</span></td>'+
							'<td class="text-center"><span class="label label-danger">'+end+'</span></td>'+
							'<td class="text-center"><span class="label label-default">'+pengajar+'</span></td>'+
							'<td class="text-center"><div class="btn-group" role="group"><a href="#form" data-toggle="modal" onclick="edit('+jadwal_id+')" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-wrench"></span></a><a href="#" onclick="hapus('+jadwal_id+')" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a></div></td>'+
							+'</tr>';
					nomor++;
				}
				$('#postList tbody').append(empRow);					
			}
		}
		
		function tambahdata(){		
			
			$('#btn-tambah').removeClass('btn-primary');
			$('#btn-tambah').addClass('btn-default');
			var ta = $('#datata').val();
			var hari_id = $('#datahari').val();
			var start = $('#datastart').val();	
			var end = $('#dataend').val();	
			
			var kelas =  $('#datakelas').val();
			var jurusan_id =  $('#datajurusan').val();
			var ruang =  $('#dataruang').val();
			
			
			
			var pelajaran_id =  $('#datapelajaran').val();
			var guru_id =  $('#dataguru').val();
			
			$('#loading_ajax').show();			
			
			$.ajax({
				type:'POST',
				data: 'ta='+ta+'&hari_id='+hari_id+'&jam_start='+start+'&jam_end='+end+'&jurusan_id='+jurusan_id+'&kelas_sekarang='+kelas+'&ruang='+ruang+'&pelajaran_id='+pelajaran_id+'&guru_id='+guru_id,
				url:'<?php echo base_url('index.php/admin/jadwal/tambahdata') ;?>',
				dataType:'json',
				success: function(hasil){
					console.log(hasil);
					
					$('#loading_ajax').fadeOut("slow");
					$('.modal-status').show();
					$('.modal-status').html('<p class="bg-warning">'+hasil.pesan+'</p>');
					
					if(hasil.pesan == ''){
						$('#form').modal('hide');
						searchFilter(0);
						$('#btn-tambah').removeClass('btn-default');
						$('#btn-tambah').addClass('btn-primary');

						//bersihkan form
					}
				}
			});
		}
		
		function simpandata(){		
							
			$('#btn-ubah').removeClass('btn-primary');
			$('#btn-ubah').addClass('btn-default');
			
			var ta = $('#datata').val();
			var hari_id = $('#datahari').val();
			var start = $('#datastart').val();	
			var end = $('#dataend').val();	
			
			var kelas =  $('#datakelas').val();
			var jurusan_id =  $('#datajurusan').val();
			var ruang =  $('#dataruang').val();
			
			
			var jadwal_id =  $('#id').val();
			var pelajaran_id =  $('#datapelajaran').val();
			var guru_id =  $('#dataguru').val();
			
			$('#loading_ajax').show();			
			
			$.ajax({
				type:'POST',
				data: 'jadwal_id='+jadwal_id+'&ta='+ta+'&hari_id='+hari_id+'&jam_start='+start+'&jam_end='+end+'&jurusan_id='+jurusan_id+'&kelas_sekarang='+kelas+'&ruang='+ruang+'&pelajaran_id='+pelajaran_id+'&guru_id='+guru_id,
				url:'<?php echo base_url('index.php/admin/jadwal/simpandata') ;?>',
				success: function(){
					
					$('#loading_ajax').fadeOut("slow");					
					$('#form').modal('hide');
					searchFilter(0);
					$('#btn-ubah').removeClass('btn-default');
					$('#btn-ubah').addClass('btn-primary');
				}
			});
		}
		
		function submit(x){
			
			$('.modal-status').hide();
			if(x == 'tambah'){
				$('#btn-tambah').show();
				$('#btn-ubah').hide();
				//bersihkan form

				$("[name='datakelas']").val('');
				$("[name='datajurusan']").val('');
				$("[name='dataruang']").val('');
				
				$('#datapelajaran').val('');
				$('#dataguru').val('');
			}else{
				/*
				var ta = $('#datata').val();
				var hari_id = $('#datahari').val();
				var start = $('#datastart').val();	
				var end = $('#dataend').val();	

				var kelas =  $('#datakelas').val();
				var jurusan_id =  $('#datajurusan').val();
				var ruang =  $('#dataruang').val();


				var pelajaran_id =  $('#datapelajaran').val();
				var guru_id =  $('#dataguru').val();	


				$('.modal-title').empty();
				$('.modal-title').append( '<span class="label label-default">'+ formatTextDate(tanggal) +'</span> <span class="label label-danger">'+nilai_desc.toUpperCase()+'</span>');			


				$.ajax({
						type: 'POST',
						url: '<?php echo base_url(); ?>index.php/admin/jadwal/daftarsiswa',
						data: 'ta='+ta+'&hari_id='+hari_id+'&jam_start='+start+'&jam_end='+end+'&jurusan_id='+jurusan_id+'&kelas_sekarang='+kelas+'&ruang='+ruang+'&pelajaran_id='+pelajaran_id+'&guru_id='+guru_id,
						beforeSend: function () {
							$('#loading_ajax').show();
						},
						success: function (responseData) {
							//console.log(responseData);
							//paginationDataDialogEdit(responseData);
							//$('#form1').modal('hide');
							$('#loading_ajax').fadeOut("slow");
						}
				});*/
			}
		}
		
		function edit(jadwal_id){	
			
			$('#btn-tambah').hide();
			$('#btn-ubah').show();			
				
			$.ajax({
					type:'POST',
					data: 'jadwal_id='+jadwal_id,
					url:'<?php echo base_url('index.php/admin/jadwal/ambiljadwalbyid');?>',
					dataType:'json',
					beforeSend: function () {
						$('#loading_ajax').show();
					},
					success: function(responseData){
						console.log(responseData);
						$('#loading_ajax').fadeOut("slow");
						
						
						$('#datata').val(responseData.ta);
						$('#datahari').val(responseData.hari_id);
						
						$('#datastart').timepicker('setTime', new Date()).val(responseData.jadwal_jam_start);
						$('#dataend').timepicker('setTime', new Date()).val(responseData.jadwal_jam_end);

						$('#datakelas').val(responseData.kelas_sekarang);
						$('#datajurusan').val(responseData.jurusan_id);
						$('#dataruang').val(responseData.ruang);


						$('#datapelajaran').val(responseData.pelajaran_id);
						$('#dataguru').val(responseData.guru_id);
						$('#id').val(responseData.jadwal_id);
						
					}
			});
		}
	
		function hapus(jadwal_id){
			$('#loading_ajax').show();	
			var tanya = confirm('Apakah yakin mau hapus data?');
			if(tanya){
				$.ajax({
					type:'POST',
					data: 'jadwal_id='+jadwal_id,
					url:'<?php echo base_url('index.php/admin/jadwal/hapusdata') ;?>',
					success: function(){					
						searchFilter(0);
					}
				});
			}else{				
				$('#loading_ajax').fadeOut("slow");	
			}
		}
	</script>