<div class="container-flex">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body" style="min-height:800px;">

                <h4><a href="<?php echo base_url(). "admin/soal"; ?>"><i class='fa fa-file fa-fw'></i> Soal</a> <i class='fa fa-angle-right fa-fw'></i> Soal Terkumpul</h4>
                <hr />
                <div class="panel-title-button pull-right">
                    <a href="#formsearch" data-toggle="modal" class="btn btn-sm" title="Filter"style="color:#fff;margin-top: -5px;"><span class="fas fa-search"></span> Cari</a>
                    <a href="#form2" data-toggle="modal" class="btn btn-sm" title="Filter"style="color:#fff;margin-top: -5px;"><span class="fas fa-filter"></span> Filter</a>
                </div>
                <div class="panel-body2">

                    <table id='postList' class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th width="50" class="text-center">NO</th>
                            <th>PELAJARAN</th>
                            <th class="text-center" width="50">JUMLAH</th>
                            <th class="text-center" width="150"><span class="fas fa-cog"></span></th>
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
                                    <h4 class="modal-title">Filter Soal
                                        <div class="pull-right">
                                            <a href="<?php echo base_url(). "admin/soal/soalkumpul"; ?>" class="btn btn-primary">Atur Ulang</a>
                                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>

                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label>Urutkan</label><br/>
                                            <select class="form-control"  id="sortBy" onchange="searchFilter()">
                                                <option value="">Sort By</option>
                                                <option value="asc">Ascending</option>
                                                <option value="desc">Descending</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Limit</label><br/>
                                            <select class="form-control"  id="limitBy" onchange="searchFilter()">
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="150">150</option>
                                                <option value="200">200</option>
                                            </select>
                                        </div>


                                        <div class="clear"></div>
                                    </div>
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
                        <h3><?php echo $kumpul["jumlah_pelajaran"];?></h3>
                        <p>Total Pelajaran</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $kumpul["soal_jumlah_today"];?>/<?php echo $kumpul["soal_jumlah_tomorrow"];?>/<?php echo $kumpul["soal_jumlah"];?></h3>
                        <p>Hari ini/Kemarin/Total Soal Diinput</p>
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

        $('#formsearch').on('shown.bs.modal', function() {
            $('#keywords').trigger('focus');
        });

		searchFilter(0);
		function searchFilter(page_num) {
			page_num = page_num?page_num:0;
			var keywords = $('#keywords').val();
            var sortBy = $('#sortBy').val();
            var limitBy = $('#limitBy').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>admin/soal/ajaxPaginationDataKumpul/'+page_num,
				data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy,
				dataType:'json',
				beforeSend: function () {
					$('#loading_ajax').show();
				},
				success: function (responseData) {
					//console.log(responseData);
					//$('#paginationTop').html(responseData.pagination);
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

				var empRow = '<tr>' +
                    '<td class="text-center">'+nomor+'</td>'+
                    '<td>' + data[emp].soal_pelajaran + '<br>'+
                    '<span class="label label-danger">' + data[emp].soal_guru + '</span><br/>'+
                    ' <span class="label label-success">' + data[emp].soal_kelas + '</span>'+
                    ' <span class="label label-warning">' + data[emp].soal_jurusan + '</span>'+
                    ' <span class="label label-primary">' + data[emp].soal_jurusan_ke + '</span>'+
                    '</td>'+
                    '<td class="text-center"><span class="text-default">' + data[emp].jumlah + '</span></td>' +
                    '<td class="text-center"><a onclick="hapus(\''+ data[emp].soal_pelajaran +'\',\''+ data[emp].soal_guru +'\',\''+ data[emp].soal_kelas +'\',\''+ data[emp].soal_jurusan +'\',\''+ data[emp].soal_jurusan_ke +'\')" class="btn" style="color: #d9534f;"><span class="fas fa-trash"></span></a></td>'+
                    +'</tr>';
                nomor++;
				$('#postList tbody').append(empRow);
			}
		}

        function hapus(a,b,c,d,e){
            $('#loading_ajax').show();
            var tanya = confirm('Apakah yakin mau hapus data?');
            if(tanya){
                $.ajax({
                    type:'POST',
                    data: 'soal_pelajaran='+a+'&soal_guru='+b+'&soal_kelas='+c+'&soal_jurusan='+d+'&soal_jurusan_ke='+e,
                    url:'<?php echo base_url('admin/soal/soalkumpulhapus') ;?>',
                    success: function(){
                        searchFilter(0);
                    }
                });
            }else{
                $('#loading_ajax').fadeOut("slow");
            }
        }
	</script>