<div class="container-flex">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body" style="min-height:800px;">

                <h4><a href="<?php echo base_url(); ?>admin/ujian"><i class='fa fa-pen fa-fw'></i> Ujian</a> <i class='fa fa-angle-right fa-fw'></i> Hasil Ujian</h4>
                <hr />
                <div class="panel-title-button pull-right">
                    <a href="#formsearch" data-toggle="modal" class="btn" title="Cari"><span class="fas fa-search"></span></a>
                    <a href="#form2" data-toggle="modal" class="btn"><span class="glyphicon glyphicon-filter"></span></a>
                    <a onClick="selesaisemua(<?php echo $ujian_id;?>)" class="btn"><span class="glyphicon glyphicon-stop"></span></a>
                </div>
                <div class="panel-body2">

                    <table id='postList' class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th width="50" class="text-center"></th>
                            <th>NAMA</th>
                            <th class="text-center">B</th>
                            <th class="text-center">S</th>
                            <th class="text-center" width="150"><span class="glyphicon glyphicon-cog"></span></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div id='pagination'></div>



                    <div class="modal fade" id="formsearch" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">


                                        <div class="col-md-12">
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-addon"><i class="fas fa-search"></i></div>
                                                <input type="text" class="form-control token" name="keywords" id="keywords" placeholder="Type keywords to filter posts" onkeyup="searchFilter()">
                                            </div>

                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="modal fade modal-fullscreen" id="form2" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Filter Ujian
                                        <div class="pull-right">
                                            <a href="<?php echo base_url(). "admin/ujian/hasil/?id=". $ujian_id; ?>" class="btn btn-primary">Atur Ulang</a>
                                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                                        </div>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-8 col-md-offset-2">

                                        <div class="col-md-4">

                                            <label for="sortBy">Urutkan Nama</label><br/>
                                            <select class="form-control"  id="sortBy" onchange="searchFilter()">
                                                <option value="">Sort By</option>
                                                <option value="asc">Ascending</option>
                                                <option value="desc">Descending</option>
                                            </select>
                                            <label for="nilaiBy">Urutkan Nilai</label><br/>
                                            <select class="form-control"  id="nilaiBy" onchange="searchFilter()">
                                                <option value="">Sort By</option>
                                                <option value="asc">Ascending</option>
                                                <option value="desc">Descending</option>
                                            </select>
                                            <label for="limitBy">Limit</label><br/>
                                            <select class="form-control"  id="limitBy" onchange="searchFilter()">
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="500">500</option>
                                            </select>


                                        </div>

                                        <div class="col-md-8">


                                            <label>Kelas</label><br/>
                                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                                <input type="text" name="ujian_kelas2" class="form-control" onchange="searchFilter()" />
                                            </div>

                                            <label>Jurusan</label><br/>
                                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                                <input type="text" name="ujian_jurusan2" class="form-control" onchange="searchFilter()" />
                                            </div>

                                            <label>Ruang</label><br/>
                                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                                <input type="text" name="ujian_jurusan_ke2" class="form-control" onchange="searchFilter()" />
                                            </div>


                                        </div>

                                        </div>

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
                                            </select>

                                        </div>
                                        <div class="col-md-8">

                                            <label>Jurusan</label><br/>
                                            <select class="form-control"  id="jurusan_id2" name="jurusan_id2">
                                            </select>

                                        </div>
                                        <div class="col-md-2">

                                            <label>Ruang</label><br/>
                                            <select class="form-control"  id="ruang2" name="ruang2">
                                                <option value="0">ALL</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pelajaran_id2">
                                                <label for="pelajaran_id2">Pelajaran</label><br/>
                                                <select class="custom-select d-block w-100 form-control" id="pelajaran_id2" name="pelajaran_id2" required>
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


    <div class="col-md-4">

        <div class="row">
            <div class="col-md-12">
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3><?php echo 0;?></h3>
                        <p>Total Pelajaran</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo 0;?>/<?php echo 0;?>/<?php echo 0;?></h3>
                        <p>Hari ini/Kemarin/Total Diujikan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>



    </div>


</div>

	<script type="text/javascript">
		
		
		$(document).ready(function(){
			//setInterval(searchFilter,3000);
            $("[name='ujian_kelas'],[name='ujian_kelas2'],[name='ujian_kelas3'],[name='ujian_kelas4']").autocomplete({
                source: "<?php echo site_url('sugest/kelas?');?>"
            });
            $("[name='ujian_jurusan'],[name='ujian_jurusan2'],[name='ujian_jurusan3'],[name='ujian_jurusan4']").autocomplete({
                source: "<?php echo site_url('sugest/jurusan?');?>"
            });
            $("[name='ujian_jurusan_ke'],[name='ujian_jurusan_ke2'],[name='ujian_jurusan_ke3'],[name='ujian_jurusan_ke4']").autocomplete({
                source: "<?php echo site_url('sugest/jurusan_ke?');?>"
            });
            $("[name='ujian_pelajaran'],[name='ujian_pelajaran2'],[name='ujian_pelajaran3'],[name='ujian_pelajaran4']").autocomplete({
                source: "<?php echo site_url('sugest/pelajaran?');?>"
            });
            $("[name='ujian_guru'],[name='ujian_guru2'],[name='ujian_guru3'],[name='ujian_guru4']").autocomplete({
                source: "<?php echo site_url('sugest/guru?');?>"
            });
            $("[name='ujian_untuk'],[name='ujian_untuk2'],[name='ujian_untuk3'],[name='ujian_untuk4']").autocomplete({
                source: "<?php echo site_url('sugest/untuk?');?>"
            });
		});


        $('#formsearch').on('shown.bs.modal', function() {
            $('#keywords').trigger('focus');
        });
		
		var ujian_id = '<?php echo $ujian_id;?>';


		searchFilter(0);
		
		function searchFilter(page_num) {
			page_num = page_num?page_num:0;
            var keywords = $('#keywords').val();
			var sortBy = $('#sortBy').val();
			var nilaiBy = $('#nilaiBy').val();
			var limitBy = $('#limitBy').val();
			var kelasBy = $('#ujian_kelas2').val();
			var jurusanBy = $('#ujian_jurusan2').val();
			var ruangBy = $('#ujian_jurusan_ke2').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>admin/ujian/ajaxPaginationDataHasil/'+page_num,
				data:'page='+page_num+'&keywords='+keywords+'&nilaiBy='+nilaiBy+'&sortBy='+sortBy+'&limitBy='+limitBy+'&kelasBy='+kelasBy+'&jurusanBy='+jurusanBy+'&ruangBy='+ruangBy+'&id='+ujian_id,
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
				
				var empRow = '<tr>'+
							'<td class="text-center">'+nomor+'</td>'+
							'<td>'+data[emp].peserta_nama+'<br><span class="label label-default">'+data[emp].soal_jawab_mulai+'</span> <span class="label label-default">'+data[emp].soal_jawab_selesai+'</span></td>'+
							'<td class="text-center"><span class="label label-success">'+data[emp].soal_jawab_benar+'</span></td>'+
							'<td class="text-center"><span class="label label-danger">'+data[emp].soal_jawab_salah+'</span></td>'+
					
							'<td class="text-center"><div class="btn-group" role="group"><a onclick="selesai('+data[emp].soal_jawab_id+')" class="btn" style="color: #83d968;"><span class="fas fa-stop"></span></a><a onclick="hapus('+data[emp].soal_jawab_id+')" class="btn" style="color: #d9534f;"><span class="fas fa-trash"></span></a></div></td>'+
							+'</tr>';
				nomor++;
				$('#postList tbody').append(empRow);	

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
			
			window.location.assign("<?php echo base_url();?>admin/ujian/post?pelajaran_id="+pelajaran_id+"&kelas_sekarang="+kelas_sekarang+"&jurusan_id="+jurusan_id+"&ruang="+ruang);
				
			}
		}
		
		
		function hapus(x){
			$('#loading_ajax').show();	
			var tanya = confirm('Apakah yakin mau hapus data?');
			if(tanya){
				$.ajax({
				type:'POST',
				data: 'id='+x,
				url:'<?php echo base_url('admin/ujian/hapushasilbyid') ;?>',
				success: function(){					
					searchFilter(0);
				}
			});
			}
		}

        function selesai(x){
            $('#loading_ajax').show();
            var tanya = confirm('Apakah yakin mau selesaikan hasil?');
            if(tanya){
                $.ajax({
                    type:'GET',
                    url: "<?php echo base_url(); ?>admin/ujian/simpan_akhir/?id="+x,
                    dataType: 'json',
                    success: function(){
                        searchFilter(0);
                    }
                });
            }
        }

        function selesaisemua(x){
            $('#loading_ajax').show();
            var tanya = confirm('Apakah yakin mau selesaikan semua?');
            if(tanya){
                $.ajax({
                    type:'GET',
                    url: "<?php echo base_url(); ?>admin/ujian/simpan_akhir_all/?id="+x,
                    dataType: 'json',
                    success: function(){
                        searchFilter(0);
                    }
                });
            }
        }
	</script>