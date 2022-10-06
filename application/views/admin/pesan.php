<link href="<?php echo base_url();?>assets/css/timeline.css" rel="stylesheet">


<div class="container container-medium" style="margin-top: 20px">

    <div class="row">


        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title text-center" style="padding-top: 7.5px;">PESAN</h4>
                    <div class="panel-title-button pull-right">
                        <a href="javascript:void(0)" id="pesan-reset" title="Reset" class="btn btn-sm btn-danger">Reset</a>
                        <a href="#form1" data-toggle="modal" id="pesan-add" title="Tambah" class="btn btn-sm btn-success">Buat Pesan</a>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="loading_ajax1" style="position: absolute; left: 50%;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></div></div>

                    <ul class="timeline">
                    </ul>


                </div>
            </div>
        </div

    </div>


</div>


<div class="modal fade modal-fullscreen" id="form1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kirim Pesan
                    <div class="pull-right">
                        <button onclick="submitPesan()" class="btn btn-danger">Kirim</button>
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>

                </h4>
            </div>
            <div class="modal-body">
                <div class="container container-small">
                    <div class="pesan"></div>
                    <div class="row">
                        <div class="col-md-4">

                            <label>Untuk</label><br/>
                            <select class="form-control"  id="untuk" name="untuk" onChange="untukX()">
                                <option value="semua">Semua</option>
                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>
                            </select>

                        </div>


                        <div class="col-md-8">
                            <label>Pesan Pengumuman</label><br/>
                            <textarea class="form-control" style="height:100px;" name="pesan_text" id="pesan_text" autofocus></textarea>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>


        </div>
    </div>
</div>

<style type="text/css">

    body {
        font-family: sans-serif;
        color: #514d6a;
        font-size: 1.5em;
        overflow-x: hidden;
        padding-top: 0px;
        background-color: #ddd;
    }
    nav.navbar {
        box-shadow: 2px 2px 2px 2px rgb(0 0 0 / 0%);
    }
    .position-absolute{
        padding-top: 20px;
        background: #778e9a!important;
        box-shadow: 2px 2px 2px 2px rgb(0 0 0 / 11%);
    }
</style>


	<link href="<?php echo base_url('assets/admin/css/soal.css') ?>" rel="stylesheet">
	<script src="<?php echo base_url();?>assets/admin/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		
			tinyMCE.init({
                selector: "textarea.form-control",
                height: 100,
                min_height: 100,
                menubar: false,statusbar:false,
                plugins: 'autoresize searchreplace autolink directionality visualblocks visualchars fullscreen link table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
                toolbar: 'alignleft alignright bullist numlist table forecolor backcolor link removeformat',
			});
		
		$('#loading_ajax').fadeOut("slow");
		$('#pesan-refresh').click(function(){
			searchFilter(0);
		});
		
		$('#untuk-x').hide();
		function untukX() {
			$('#untuk-x').hide();
			var untuk = $('#untuk').val();
			if(untuk == 'siswa'){
				$('#untuk-x').show();
			}
		}
		
		searchFilter(0);
		function searchFilter() {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/admin/pesan/timeline/',
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
				url:'<?php echo base_url('index.php/admin/pesan/hapusdatabyid') ;?>',
				success: function(){					
					searchFilter(0);
				}
			});
			}
		}
		
		function submitPesan(){
			
				
			var pesan_text =  tinyMCE.get("pesan_text").getContent();
			
			var untuk =  $("[name='untuk']").val();
			var kelas_sekarang =  $("[name='kelas_sekarang']").val();
			var jurusan_id =  $("[name='jurusan_id']").val();
			var ruang =  $("[name='ruang']").val();
			
			$.ajax({
				type:'POST',
				data: {
					pesan_text:pesan_text,
					untuk:untuk,
					kelas_sekarang:kelas_sekarang,
					jurusan_id:jurusan_id,
					ruang:ruang
				},
				url:'<?php echo base_url('index.php/admin/pesan/tambahdata') ;?>',
				dataType:'json',
				success: function(hasil){
					$('.pesan').show();
					$('.pesan').html('<p class="bg-warning">'+hasil.pesan+'</p>');
					
					if(hasil.pesan == ''){						
						window.location.assign("<?php echo base_url();?>index.php/admin/pesan"); 
					}
				}
			});
		}
	</script>