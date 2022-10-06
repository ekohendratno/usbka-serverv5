<div class="wrapper" style="height: auto; min-height: 100%;">
    <div class="container container-medium">


        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title text-center" style="padding-top: 7.5px;">DAFTAR SISWA</h4>
                        <div class="panel-title-button pull-right">
                            <a href="#form5" data-toggle="modal" onClick="getToken()" class="btn"><span class="fas fa-key"></span></a>
                            <a style="display:none;" title="Segarkan" href="javascript:void(0);" onclick="searchFilter()" class="btn"><span class="fas fa-redo"></span></a>
                        </div>
                    </div>
                    <div class="panel-body" style="min-height: 200px;">

                        <table id='postList' class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th width="50" class="text-center"></th>
                                <th>NAMA</th>
                                <th class="text-center" width="150"><span class="glyphicon glyphicon-cog"></span></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div id='pagination'></div>

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

        /**
        searchFilter(0);
        function searchFilter() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>pengawas/siswa/timeline/',
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
            $('ul.timeline').append('<li class="time-label"><span class="btn btn-success">Daftar Siswa</span></li>');
            var nomor=1;
            for(emp in data){
                var s = '<span class="label label-danger">OFFLINE</span> ';
                if(data[emp].status == "online"){
                    s = '<span class="label label-success">ONLINE</span> ';
                }


                var kelas = data[emp].kelas_sekarang;
                var jurusan = data[emp].jurusan_kode;
                var empRow = '<li><i class="glyphicon"></i>'+
                    '<div class="timeline-item">'+
                    '<h3 class="timeline-header"><i class="glyphicon glyphicon-calendar"></i>'+data[emp].last_active_title+'</h3>'+
                    '<div class="timeline-body">'+data[emp].siswa_nama+'<br/>'+
                    '<span class="label label-danger">'+kelas.toUpperCase()+'</span>'+
                    ' <span class="label label-success">'+jurusan.toUpperCase()+'</span>'+
                    ' <span class="label label-warning">'+data[emp].ruang+'</span> '+s+
                    '</div>'+
                    '<div class="timeline-footer"></div>'+
                    '</div>'+
                    '</li>';
                $('ul.timeline').append(empRow);
                nomor++;
            }
            $('ul.timeline').append('<li><i class="glyphicon glyphicon-time"></i></li>');
        }
*/
		$(document).ready(function(){
			setInterval(searchFilter,5000);
		});
		
        searchFilter();

        function searchFilter() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>pengawas/siswa/timeline',
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function (responseData) {
                    paginationData(responseData);
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }

        function paginationData(data) {

            $('#postList tbody').empty();
            var nomor = 1;
            for(emp in data){
				
				if(data[emp].selesai < 1){
				//------------------------	
                var ujian_id = data[emp].ujian_id;

                var untuk = '';

                if(data[emp].soal_jawab_kelas != ''){
                    untuk +='<span class="label label-success">'+data[emp].kelas_sekarang+'</span>';
                }
                if(data[emp].soal_jawab_jurusan != ''){
                    untuk +=' <span class="label label-primary">'+data[emp].soal_jawab_jurusan+'</span>';
                }

                if(data[emp].soal_jawab_jurusan_ke != ''){
                    untuk +=' <span class="label label-primary">'+data[emp].soal_jawab_jurusan_ke+'</span>';
                }


                if(data[emp].soal_jawab_pelajaran != ''){
                    untuk +=' <span class="label label-default">'+data[emp].soal_jawab_pelajaran+'</span>';
                }

                var status_html = '<span class="label label-danger">Mengerjakan</span>';
                if(data[emp].soal_jawab_status == 'N'){
                    status_html = '<span class="label label-success">Selesai</span>';
                }


                var status = ' <span class="label label-danger">off</span>';
                if(data[emp].status == 'online'){
                    status = ' <span class="label label-success">on</span>';
                }
				
				status+= ' '+data[emp].last_update_title;
                var tombol_status = '';

                if(data[emp].soal_jawab_status == 'Y') {
                    tombol_status = '<br/><a onclick="selesai_sekarang(' + data[emp].soal_jawab_id + ')" class="btn" style="color: #3dd963;"><span class="fas fa-check"></span></a>';
                }

                var empRow = '<tr>'+
                    '<td class="text-center">'+nomor+'</td>'+
                    '<td>'+data[emp].siswa_nama+status+'<br>'+untuk+
                    '</td>'+
                    '<td class="text-center">'+status_html+''+tombol_status+'</td>'+
                    +'</tr>';
                nomor++;
                $('#postList tbody').append(empRow);

				//------------------------	
                }
            }
        }

        function selesai_sekarang(id) {
            $('#loading_ajax').show();
            var tanya = confirm('Apakah yakin mau diselesaikan?');
            if(tanya){
                $.ajax({
                    type:'POST',
                    data:'id='+id,
                    url:'<?php echo base_url('pengawas/siswa/selesaisekarang') ;?>',
                    beforeSend: function () {
                        $('#loading_ajax').show();
                    },
                    success: function(){
                        $('#loading_ajax').fadeOut("slow");
                        searchFilter(0);
                    }
                });
            }
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