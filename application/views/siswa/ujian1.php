<script type="text/javascript">$('#loading_ajax').show();</script>
<style type="text/css">
    #loading_ajax{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: 50% 50% no-repeat rgba(0,0,0,0.80);
    }
    .panel-title-button a.btn {
        color: #ddd;
    }
</style>
<div class="wrapper" style="height: auto; min-height: 100%;">
<div class="container container-medium">


        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
				<div style="min-height: 300px">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title text-center" style="padding-top: 7.5px;">DAFTAR UJIAN</h4>
                        <div class="panel-title-button pull-right">
                            <a href="javascript:void(0);" onclick="searchFilter(0,0)" id="listUjianToday" class="btn btn-success btn-sm"><i class="fas fa-clock"></i> Sekarang</a>
                            <a href="javascript:void(0);" onclick="searchFilter(0,1)" id="listUjianTomorrow" class="btn btn-success btn-sm"><i class="fas fa-clock"></i> Besok</a>
                            <a href="javascript:void(0);" onclick="searchFilterHistory(0)" id="listUjianHistory" class="btn btn-default btn-sm"><i class="fas fa-bars"></i> Daftar</a>
                        </div>
                    </div>
					<div class="panel-body">

                        <div id="postList1" class="list-group" style="font-size: 18px"></div>

						<div id='pagination' class="text-center"></div>


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
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control"  id="sortBy" onchange="searchFilter()">
                            <option value="">Sort By</option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control"  id="limitBy" onchange="searchFilter()">
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

	<script type="text/javascript">

        $('.navbar-right').attr("style", "display:none;");
        $('.panel-title-button').attr("style", "display:block; margin-top:10px; margin-right:15px;");
        $('.panel-title-button').detach().prependTo( $('#bs-example-navbar-collapse-1') );
        /*$('.panel-heading').remove();*/

        //$('#listUjianToday').css('color','#ddd');
        //$('#listUjianTomorrow').css('color','#ddd');
        //$('#listUjianHistory').css('color','#ddd');


        $('h4.panel-title').html("UJIAN HARI INI");

        $('#listUjianHistory').removeClass('btn-success');
        $('#listUjianHistory').addClass('btn-default');
        $('#listUjianTomorrow').removeClass('btn-success');
        $('#listUjianTomorrow').addClass('btn-default');
        $('#listUjianToday').removeClass('btn-default');
        $('#listUjianToday').addClass('btn-success');
        $('#listUjianToday').css('color','#000000');

        $('#listUjianToday').click(function(){
            $('h4.panel-title').html("UJIAN HARI INI");
            $('#listUjianHistory').removeClass('btn-success');
            $('#listUjianHistory').addClass('btn-default');
            $('#listUjianTomorrow').removeClass('btn-success');
            $('#listUjianTomorrow').addClass('btn-default');
            $('#listUjianToday').removeClass('btn-default');
            $('#listUjianToday').addClass('btn-success');
            $('#listUjianToday').css('color','#000000');
        });

        $('#listUjianTomorrow').click(function(){
            $('h4.panel-title').html("UJIAN BESOK");
            $('#listUjianHistory').removeClass('btn-success');
            $('#listUjianHistory').addClass('btn-default');
            $('#listUjianTomorrow').removeClass('btn-default');
            $('#listUjianTomorrow').addClass('btn-success');
            $('#listUjianTomorrow').css('color','#000000');
            $('#listUjianToday').removeClass('btn-success');
            $('#listUjianToday').addClass('btn-default');
        });

        $('#listUjianHistory').click(function(){
            $('h4.panel-title').html("UJIAN DIKERJAKAN");
            $('#listUjianHistory').removeClass('btn-default');
            $('#listUjianHistory').addClass('btn-success');
            $('#listUjianHistory').css('color','#000000');
            $('#listUjianTomorrow').removeClass('btn-success');
            $('#listUjianTomorrow').addClass('btn-default');
            $('#listUjianToday').removeClass('btn-success');
            $('#listUjianToday').addClass('btn-default');
        });

        setTimeout(function () {
		    searchFilter(0,0);
        },1000);
		
		function searchFilter(page_num,besok) {
			page_num = page_num?page_num:0;
			var keywords = $('#keywords').val();
			var sortBy = $('#sortBy').val();
			var limitBy = $('#limitBy').val();
			var jurusanBy = $('#jurusanBy').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>siswa/ujian/ajaxPaginationData/'+page_num,
				data:'todayBy='+besok+'&page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&jurusanBy='+jurusanBy,
				dataType:'json',
				beforeSend: function () {
					$('#loading_ajax').show();
				},
				success: function (responseData) {
					//console.log(responseData);
                    $('#pagination').empty();
					//$('#pagination').html(responseData.pagination);
					paginationData(responseData.empData,besok);
					$('#loading_ajax').fadeOut("slow");
				}
			});
		}

        function searchFilterHistory(page_num) {
            page_num = page_num?page_num:0;
            var keywords = $('#keywords').val();
            var sortBy = $('#sortBy').val();
            var limitBy = $('#limitBy').val();
            var jurusanBy = $('#jurusanBy').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>siswa/ujian/ajaxPaginationDataHistory/'+page_num,
                data:'&page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&jurusanBy='+jurusanBy,
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function (responseData) {
                    //console.log(responseData);
                    $('#pagination').empty();
                    $('#pagination').html(responseData.pagination);
                    paginationDataHistory(responseData.empData);
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }
		
		function paginationData(data,besok) {


            var pesan_a = "hari ini";
            if(besok == 1){
                pesan_a = "besok";
            }



            $('#postList1').empty();
			
			if(data.length < 1){

                var empRow = ''+
                    '<div class="row">'+
                    '<div class="col-md-12">'+
                    '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                    '<h4>Tidak ada daftar ujian '+pesan_a+'</h4>'+
                    '<p>Daftar ujian akan terlihat ketika data tersedia!.</p>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                    '';
				$('#postList1').append(empRow);	
			}else{
				$('#postList1').append('<div class="list-group list">');
			}
			
			
			var nomor = 1;
			for(emp in data){
			    console.log(data);

				var ujian_id = data[emp].ujian_id;
				var ujian_tampil = data[emp].ujian_tampil;

				var ujian_mulai = new Date(data[emp].ujian_tanggal_mulai);
				var ujian_terlambat = new Date(data[emp].ujian_tanggal_selesai);

				var tanggal_sekarang = new Date();

				var status = 2;
				if(tanggal_sekarang < ujian_mulai ){
					status = 0;
				}else if( ( tanggal_sekarang >= ujian_mulai) && ( tanggal_sekarang <= ujian_terlambat) ){
					status = 1;
				}

				//var status_html = '<a href="<?php echo base_url();?>siswa/ujian/ikuti?id='+ujian_id+'"  class="btn btn-xs btn-success"><span class="glyphicon glyphicon-play"></span> Ikuti Ujian</a>';
				if(data[emp].status == 'N'){
					//status_html = '<a href="<?php echo base_url();?>siswa/ujian/selesai?id='+ujian_id+'"  class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Selesai</a>';
				}

				var pesan_b = "beberapa saat lagi";
				if(besok == 1){
                    pesan_b = "besok";
                }

				var status_style = '';
				var status_link = '';
				var status_html = '';
                var status_icon = '';
				if( data[emp].soal_jawab_status != null ){
					if(data[emp].soal_jawab_status == 'N'){
						if(ujian_tampil== 'y'){
                            status_style = '';
							status_link = ' href="<?php echo base_url();?>siswa/ujian/selesai?id='+ujian_id+'"';
							status_html = '<span class="label label-default">Hasil dapat dilihat</span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-search"></i>';
						}else{
                            status_style = '';
							status_link = ' href="javascript:void(0);" onclick="swal(\'Ujian usai!\', \'Hasil tidak diperlihatkan, silahkan hubungi guru yang bersangkutan!\', \'success\')"';
							status_html = '<span class="label label-success">Ujian selesai</span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-ok" style="color:rgb(92, 184, 92);"></i>';
						}

					}else{

                        if(status == 1){
                            status_style = ' list-group-item-success';
                            status_link = ' href="<?php echo base_url();?>siswa/ujian/ikuti?id='+ujian_id+'"';
                            status_html = '<span class="label label-success">Ikuti Ujian <i class="glyphicon glyphicon-search"></i></span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-search" style="color:rgb(131,131,131);"></i>';
                        } else if (status == 0) {
                            status_style = ' list-group-item-danger';
                            status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Ujian belum dimulai, tunggu '+pesan_b+'!\', \'info\')"';
                            status_html = '<span class="label label-danger">Akan dimulai '+pesan_b+'</span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-time"></i>';
                        } else if (status == 2) {
                            status_style = '';
                            status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
                            status_html = '<span class="label label-danger">Waktu ujian lewat<span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-remove" style="color:rgb(184,41,16);"></i>';
                        }else{
                            status_style = '';
                            status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
                            status_html = '<span class="label label-danger">Waktu ujian lewat</span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-remove " style="color:rgb(184,41,16);"></i>';
                        }
					}
				}else{

					if(status == 1){
						status_style = ' list-group-item-success';
						status_link = ' href="<?php echo base_url();?>siswa/ujian/ikuti?id='+ujian_id+'"';
						status_html = '<span class="label label-success">Ikuti Ujian <i class="glyphicon glyphicon-search"></i></span>';
                        status_icon = '<i class="icon-left glyphicon glyphicon-search" style="color:rgb(131,131,131);"></i>';
					} else if (status == 0) {
						status_style = ' list-group-item-danger';
						status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Ujian belum dimulai, tunggu '+pesan_b+'!\', \'info\')"';
						status_html = '<span class="label label-warning">Akan dimulai '+pesan_b+'</span>';
                        status_icon = '<i class="icon-left glyphicon glyphicon-time"></i>';
					} else if (status == 2) {
						status_style = '';
						status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
						status_html = '<span class="label label-danger">Waktu ujian lewat</span>';
                        status_icon = '<i class="icon-left glyphicon glyphicon-ok" style="color:rgb(184,41,16);"></i>';
					}else{
						status_style = '';
						status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
						status_html = '<span class="label label-danger">Waktu ujian lewat</span>';
                        status_icon = '<i class="icon-left glyphicon glyphicon-ok" style="color:rgb(184,41,16);"></i>';
					}

				}



                var empRow = '<a '+status_link+'><div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].ujian_mulai+'</span>'+
                    ' <span class="label label-default">'+data[emp].ujian_selesai+'</span>'+
                    '</p><br/>'+
                    '<div class="col-md-8"><div class="row">'+
                    '<p><i style="color:#999">'+data[emp].ujian_guru+'</i></p>'+
                    '<h3 class="list-group-item-heading name">'+data[emp].ujian_pelajaran+'</h3>'+
                    '<p><i style="color:#999">Waktu '+data[emp].ujian_waktu+' menit</i>, <i style="color:#999">Jenis ujian '+data[emp].ujian_jenis+'</i>, <i style="color:#999">'+data[emp].ujian_jumlah_soal+' buah soal diujikan</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<div class="btn btn-circle btn-default" style="color: #6db571;" >'+status_icon+'</div><br/><br/>'+status_html+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div></a>';





				nomor++;
				$('#postList1').append(empRow);					
			}
			
			if(data.length > 0){
				$('#postList1').append('<div class="list-group list">');
			}
		}


        function paginationData1(data,besok) {


            var pesan_a = "hari ini";
            if(besok == 1){
                pesan_a = "besok";
            }



            $('#postList1').empty();

            if(data.length < 1){

                var empRow = ''+
                    '<div class="row">'+
                    '<div class="col-md-12">'+
                    '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                    '<h4>Tidak ada daftar ujian '+pesan_a+'</h4>'+
                    '<p>Daftar ujian akan terlihat ketika data ujian telah dibuat oleh admin atau guru yang bersangkutan.</p>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                    '';
                $('#postList1').append(empRow);
            }else{
                $('#postList1').append('<div class="list-group list">');
            }


            var nomor = 1;
            for(emp in data){
                console.log(data);

                var ujian_id = data[emp].ujian_id;
                var ujian_tampil = data[emp].ujian_tampil;

                var ujian_mulai = new Date(data[emp].ujian_tanggal_mulai);
                var ujian_terlambat = new Date(data[emp].ujian_tanggal_selesai);

                var tanggal_sekarang = new Date();

                var status = 2;
                if(tanggal_sekarang < ujian_mulai ){
                    status = 0;
                }else if( ( tanggal_sekarang >= ujian_mulai) && ( tanggal_sekarang <= ujian_terlambat) ){
                    status = 1;
                }

                //var status_html = '<a href="<?php echo base_url();?>siswa/ujian/ikuti?id='+ujian_id+'"  class="btn btn-xs btn-success"><span class="glyphicon glyphicon-play"></span> Ikuti Ujian</a>';
                if(data[emp].status == 'N'){
                    //status_html = '<a href="<?php echo base_url();?>siswa/ujian/selesai?id='+ujian_id+'"  class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Selesai</a>';
                }

                var pesan_b = "beberapa saat lagi";
                if(besok == 1){
                    pesan_b = "besok";
                }

                var status_style = '';
                var status_link = '';
                var status_html = '';
                var status_icon = '';
                if( data[emp].soal_jawab_status != null ){
                    if(data[emp].soal_jawab_status == 'N'){
                        if(ujian_tampil== 'y'){
                            status_style = '';
                            status_link = ' href="<?php echo base_url();?>siswa/ujian/selesai?id='+ujian_id+'"';
                            status_html = '<span class="label label-default">Hasil dapat dilihat</span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-search"></i>';
                        }else{
                            status_style = '';
                            status_link = ' href="javascript:void(0);" onclick="swal(\'Ujian usai!\', \'Hasil tidak diperlihatkan, silahkan hubungi guru yang bersangkutan!\', \'success\')"';
                            status_html = '<span class="label label-success">Ujian selesai</span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-ok" style="color:rgb(92, 184, 92);"></i>';
                        }

                    }else{

                        if(status == 1){
                            status_style = ' list-group-item-success';
                            status_link = ' href="<?php echo base_url();?>siswa/ujian/ikuti?id='+ujian_id+'"';
                            status_html = '<span class="label label-success">Ikuti Ujian <i class="glyphicon glyphicon-search"></i></span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-search" style="color:rgb(131,131,131);"></i>';
                        } else if (status == 0) {
                            status_style = ' list-group-item-danger';
                            status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Ujian belum dimulai, tunggu '+pesan_b+'!\', \'info\')"';
                            status_html = '<span class="label label-danger">Akan dimulai '+pesan_b+'</span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-time"></i>';
                        } else if (status == 2) {
                            status_style = '';
                            status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
                            status_html = '<span class="label label-danger">Waktu ujian lewat<span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-remove" style="color:rgb(184,41,16);"></i>';
                        }else{
                            status_style = '';
                            status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
                            status_html = '<span class="label label-danger">Waktu ujian lewat</span>';
                            status_icon = '<i class="icon-left glyphicon glyphicon-remove " style="color:rgb(184,41,16);"></i>';
                        }
                    }
                }else{

                    if(status == 1){
                        status_style = ' list-group-item-success';
                        status_link = ' href="<?php echo base_url();?>siswa/ujian/ikuti?id='+ujian_id+'"';
                        status_html = '<span class="label label-success">Ikuti Ujian <i class="glyphicon glyphicon-search"></i></span>';
                        status_icon = '<i class="icon-left glyphicon glyphicon-search" style="color:rgb(131,131,131);"></i>';
                    } else if (status == 0) {
                        status_style = ' list-group-item-danger';
                        status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Ujian belum dimulai, tunggu '+pesan_b+'!\', \'info\')"';
                        status_html = '<span class="label label-warning">Akan dimulai '+pesan_b+'</span>';
                        status_icon = '<i class="icon-left glyphicon glyphicon-time"></i>';
                    } else if (status == 2) {
                        status_style = '';
                        status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
                        status_html = '<span class="label label-danger">Waktu ujian lewat</span>';
                        status_icon = '<i class="icon-left glyphicon glyphicon-ok" style="color:rgb(184,41,16);"></i>';
                    }else{
                        status_style = '';
                        status_link = ' href="#" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
                        status_html = '<span class="label label-danger">Waktu ujian lewat</span>';
                        status_icon = '<i class="icon-left glyphicon glyphicon-ok" style="color:rgb(184,41,16);"></i>';
                    }

                }




                var empRow = '<a'+status_link+' class="list-group-item'+status_style+'">'+
                    '<div class="row">'+
                    '<div class="col-md-9 col-xs-10">'+
                    '<p class="list-group-item-text title">'+
                    ''+data[emp].ujian_mulai+' - '+data[emp].ujian_selesai+''+
                    '</p><br>'+
                    '<p><i style="color:#999">'+data[emp].ujian_guru+'</i></p>'+
                    '<h3 class="list-group-item-heading name">'+data[emp].ujian_pelajaran+'</h3>'+
                    '</div>'+
                    '<div class="col-md-1 col-xs-2 vertical-center2">'+
                    '<div class="icon1 icon16">'+status_icon+'</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                    '</a>';
                nomor++;
                $('#postList1').append(empRow);
            }

            if(data.length > 0){
                $('#postList1').append('<div class="list-group list">');
            }
        }



        function paginationDataHistory(data) {

            $('#postList1').empty();


            if(data.length < 1){
                var empRow = ''+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                                '<h4>Tidak ada daftar ujian yang diikuti</h4>'+
                                '<p>Daftar ujian akan terlihat jika ujian sudah pernah mengikuti dan telah selesai mengerjakan.</p>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                    '';
                $('#postList1').append(empRow);
            }else{
                $('#postList1').append('<div class="list-group list">');
            }


            var nomor = 1;
            for(emp in data){


                var status_style = '';
                var status_link = '';
                var status_html = '';
                if( data[emp].soal_jawab_status != null ){
                    if(data[emp].soal_jawab_status == 'N'){
                        if(data[emp].soal_jawab_tampil== 'y'){
                            status_link = ' href="<?php echo base_url();?>siswa/ujian/selesai?id='+ujian_id+'"';
                            status_html = 'Hasil dapat dilihat';
                        }else{
                            status_link = ' href="javascript:void(0);" onclick="swal(\'Ujian usai!\', \'Hasil tidak diperlihatkan, silahkan hubungi guru yang bersangkutan!\', \'success\')"';
                            status_html = 'Ujian selesai';
                        }

                    }else{
                        status_style = ' list-group-item-success';
                        status_link = ' href="<?php echo base_url();?>siswa/ujian/ikuti?id='+ujian_id+'"';
                        status_html = 'Ikuti Ujian <i class="glyphicon glyphicon-play"></i>';
                    }
                }else{

                    if(status == 1){
                        status_style = ' list-group-item-success';
                        status_link = ' href="<?php echo base_url();?>siswa/ujian/ikuti?id='+ujian_id+'"';
                        status_html = 'Ikuti Ujian <i class="glyphicon glyphicon-play"></i>';
                    } else if (status == 0) {
                        status_style = ' list-group-item-danger';
                        status_link = ' href="javascript:void(0);" onclick="swal(\'Ujian usai!\', \'Hasil tidak diperlihatkan, silahkan hubungi guru yang bersangkutan!\', \'success\')"';
                        status_html = 'Akan dimulai beberapa saat lagi';
                    } else if (status == 2) {
                        status_style = '';
                        status_link = ' href="javascript:void(0);" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
                        status_html = 'Waktu ujian lewat';
                    }else{
                        status_style = '';
                        status_link = ' href="javascript:void(0);" onclick="swal(\'Perhatian!\', \'Waktu mengikuti ujian telah usai!\', \'info\')"';
                        status_html = 'Waktu ujian lewat';
                    }

                }

                var empRow = '<a '+status_link+'><div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].soal_jawab_mulai+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_jawab_selesai+'</span>'+
                    '</p><br/>'+
                    '<div class="col-md-12"><div class="row">'+
                    '<p><i style="color:#999">'+data[emp].soal_jawab_guru+'</i></p>'+
                    '<h3 class="list-group-item-heading name">'+data[emp].soal_jawab_pelajaran+'</h3>'+
                    '<p><i style="color:#999">Waktu '+data[emp].soal_jawab_waktu+' menit</i>, <i style="color:#999">'+data[emp].soal_jawab_jumlah_soal+' buah soal diujikan</i></p>'+
                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div></a>';

                nomor++;
                $('#postList1').append(empRow);
            }

            if(data.length > 0){
                $('#postList1').append('<div class="list-group list">');
            }
        }
        $('#loading_ajax').fadeOut("slow");
    </script>
<style type="text/css">
    .panel-title-button a.btn {
        color: #000000;
    }
</style>