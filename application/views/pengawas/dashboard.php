<div class="wrapper" style="height: auto; min-height: 100%;">
    <div class="container container-medium">
	<div class="row">


        <div class="col-md-5">
            <div class="small-box bg-blue">
                <a href="#form5" data-toggle="modal" onClick="getToken()">
                    <div class="row">

                        <div class="col-md-12" style="padding-left: 30px;">
                            <h3>Lihat Token</h3>
                            <p>Token akan berubah setiap 15 menit</p>
                        </div>
                    </div>
                </a>
            </div>


            <div class="small-box bg-x">
                <a href="<?php echo base_url();?>pengawas/siswa">
                    <div class="row">
                    <div class="col-md-12" style="padding-left: 30px;">

                        <h3>Daftar Peserta Ujian</h3>
                        <p>Akan terdapat daftar siswa yang sedang melangsungkan sesi ujian hari ini</p>
                    </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-7">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon-left fas fa-comment"></i> Pengumuman
                    <div class="panel-tools">
                        <a href="javascript:void(0)" id="pesan-refresh" class="btn btn-success btn-xs"><i class="icon-left fas fa-redo"></i> Refresh</a>
                    </div>
                </div>
                <div class="panel-body" style="min-height: 250px;">
                    <div id="loading_ajax1" style="position: absolute; left: 50%;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></div></div>

                    <ul class="timeline">
                    </ul>


                </div>
            </div>
        </div>


	</div>
			
    </div>
</div>



<div class="modal fade modal-fullscreen" id="form5" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kode Token Ujian
                    <div class="pull-right">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center container-fluid">


                        <div id="token" style="font-family: 'Courier New'; font-size: 68px; margin-top: 80px;">------</div>


                    </div>

                    <div class="clear"></div>
                </div>
            </div>

        </div>
    </div>
</div>


	<script type="text/javascript">

        $('#loading_ajax').fadeOut("slow");
        $('#pesan-refresh').click(function(){
            searchFilter(0);
        });

        searchFilter(0);
        function searchFilter() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>pengawas/dashboard/timeline/',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax1').show();
                },
                success: function (responseData) {
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
                    '<h3 class="timeline-header"><i class="fas fa-calendar-alt"></i>'+data[emp].pesan_tanggal+' dari '+data[emp].username+'</h3>'+
                    '<div class="timeline-body">'+data[emp].pesan_text+'</div>'+
                    '<div class="timeline-footer"></div>'+
                    '</div>'+
                    '</li>';
                $('ul.timeline').append(empRow);
            }
            $('ul.timeline').append('<li><i class="glyphicon glyphicon-time"></i></li>');
        }


        function getToken(){
            $('#token').html('');

            $.ajax({
                type:'POST',
                url:'<?php echo base_url('token') ;?>',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function (responseData) {
                    $('#loading_ajax').fadeOut("slow");
                    $('#token').html(responseData.ujian_token_text);
                }
            });
        }
	</script>