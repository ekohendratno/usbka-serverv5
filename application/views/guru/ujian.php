<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-pen fa-fw'></i> UJIAN <i class='fa fa-angle-right fa-fw'></i> DATA UJIAN</h4>
        <hr/>
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
            <a style="display: none" title="Tambah Soal Baru" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog(0)" class="btn btn-sm btn-success  btn-sm btn-circle"><i class="fas fa-plus"></i></a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-8">
        <div>
            <div style="min-height:800px;">

                <ul class="nav nav-tabs" style="margin-bottom: 8px">
                    <li class="active"><a data-toggle="tab" href="#ujianterbaru">Semua Daftar Ujian</a></li>
                    <li><a data-toggle="tab" href="#ujiansekarang">Ujian Hari Ini</a></li>
                    <li><a data-toggle="tab" href="#ujianbesok">Ujian Besok</a></li>
                </ul>
                <div class="tab-content">
                    <div id="ujianterbaru" class="tab-pane fade in active">

                        <div id="postList0" class="list-group" style="font-size: 18px"></div>
                        <div id='pagination'></div>

                    </div>
                    <div id="ujiansekarang" class="tab-pane fade in">

                        <div id="postListSekarang" class="list-group" style="font-size: 18px"></div>

                    </div>
                    <div id="ujianbesok" class="tab-pane fade in">

                        <div id="postListBesok" class="list-group" style="font-size: 18px"></div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">

        <div class="row">
            <div class="col-md-12">
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3><?php echo $total_pelajaran;?></h3>
                        <p>Total Pelajaran</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_ujian_day;?>/<?php echo $total_ujian_yesterday;?>/<?php echo $total_ujian_tomorrow;?>/<?php echo $total_ujian;?></h3>
                        <p>Hari ini/Kemarin/Besok/Total Diujikan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<div class="modal fade" id="formSearch" role="dialog">
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

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formFilter" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Filter
                    <div class="pull-right">
                        <a href="<?php echo base_url(). "guru/soal/index"; ?>" class="btn btn-primary">Atur Ulang Setingan</a>
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">

                <div class="container container-small">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="col-md-6">
                                <label>Urutkan</label><br/>
                                <select class="form-control"  id="sortBy" onchange="searchFilter()">
                                    <option value="">Sort By</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>


                            </div>
                            <div class="col-md-6">

                                <label>Jumlah ditampilkan</label><br/>
                                <select class="form-control"  id="limitBy" onchange="searchFilter()">
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                </select>
                            </div>


                        </div>

                    </div>


                </div>


            </div>


        </div>
    </div>
</div>


<div class="modal fade modal-fullscreen" id="formDialogHasil" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-content-scroll">
            <div class="modal-header">
                <h4 class="modal-title">Hasil Ujian
                    <div class="pull-right">
                        <a href="#" title="Pengaturan" class="btn btn-default btn-sm btn-circle submitpengaturanhasil">
                            <i class="fas fa-arrow-up"></i>
                        </a>
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>
                </h4>

                <div class="container container-medium">

                    <div class="col-md-12">
                        <div id="pengaturanhasil" class="row" style="padding-top: 30px">


                            <div class="row">

                                <div class="col-md-6">
                                    <label>Kelas</label>
                                    <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                        <select id="kelasBy" name="kelasBy" class="form-control" onchange="submitHasil(0)">
                                            <option value="">Semua Kelas</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label>Jurusan</label>
                                    <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>


                                        <select id="jurusanBy" name="jurusanBy" class="form-control" onchange="submitHasil(0)">
                                            <option value="">Semua Jurusan</option>
                                        </select>

                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="text-right" style="display: none">
                                <a href="javascript:void();" class="btn btn-default submitpengaturanhide">Sembunyikan</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-body">
                <div class="container container-medium">

                    <input type="hidden" id="idhasil" name="idhasil" value="0"/>
                    <div id="postListHasil" class="list-group" style="font-size: 18px"></div>


                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {


        $(".submitpengaturanhidehasil").click(function(){
            $("#pengaturanhasil").hide(300);
        });
        $(".submitpengaturanhasil").click(function(){
            var side = $(".submitpengaturanhasil .fa-arrow-up").attr('class');
            if(side){
                $(".submitpengaturanhasil .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            }else{
                $(".submitpengaturanhasil .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            }

            $("#pengaturanhasil").slideToggle();
        });


    });

    $('#formSearch').on('shown.bs.modal', function() {
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
            url: '<?php echo base_url(); ?>guru/ujian/ajaxPaginationData/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy,
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

        $('#postList0').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar ujian</h4>'+
                '<p>Daftar ujian akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postList0').append(empRow);
        }else{

            for(emp2 in data){
                var tanggal = data[emp2].tanggal;

                var empRow = '<div class="list-group-item list-group-item-warning">'+
                    '<p class="list-group-item-text title" style="text-align:left;">'+data[emp2].ujian_tanggal_indo+'</p>'+
                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postList0').append(empRow);

                for(emp in tanggal) {


                    var empRow = '<div class="list-group-item">'+
                        '<p class="list-group-item-text title" style="text-align:center;">'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_mulai+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_selesai+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_untuk+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_kelas+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_jurusan+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_agama+'</span>'+
                        '</p><br/>'+
                        '<div class="col-md-8"><div class="row">'+
                        '<p><i style="color:#999">'+tanggal[emp].ujian_guru+'</i></p>'+
                        '<h3 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#formtampil" data-toggle="modal" onclick="tampilData('+tanggal[emp].ujian_id+')">'+tanggal[emp].ujian_pelajaran+'</a></h3>'+
                        '<p><i style="color:#999">Waktu '+tanggal[emp].ujian_waktu+' menit</i>, <i style="color:#999">Jenis ujian '+tanggal[emp].ujian_jenis+'</i>, <i style="color:#999">'+tanggal[emp].ujian_jumlah_soal+' buah soal</i></p>'+
                        '</div></div>'+
                        '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                        '<a title="Preview" title="Preview" data-backdrop="static" data-keyboard="false" href="#formDialogHasil" data-toggle="modal" onClick="submitHasil('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-eye"></span></a>'+
                        '<a title="Export Data" title="Duplikat" onClick="submitExport('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #6db571;" ><span class="fas fa-file-export"></span></a>'+



                        '</div></div>'+


                        '<div class="clearfix"></div>'+
                        '</div>';
                    nomor++;
                    $('#postList0').append(empRow);
                }

            }


        }

    }


    ajaxPaginationDataSekarang(0);
    function ajaxPaginationDataSekarang(page_num) {
        page_num = page_num?page_num:0;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>guru/ujian/ajaxPaginationDataSekarang/'+page_num,
            data:'page='+page_num,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                paginationDataSekarang(responseData.empData);
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function paginationDataSekarang(data) {

        $('#postListSekarang').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar ujian sekarang</h4>'+
                '<p>Daftar ujian akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postListSekarang').append(empRow);
        }else{

            for(emp2 in data){
                var tanggal = data[emp2].tanggal;

                var empRow = '<div class="list-group-item list-group-item-warning">'+
                    '<p class="list-group-item-text title" style="text-align:left;">'+data[emp2].ujian_tanggal_indo+'</p>'+
                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postListSekarang').append(empRow);

                for(emp in tanggal) {


                    var empRow = '<div class="list-group-item">'+
                        '<p class="list-group-item-text title" style="text-align:center;">'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_mulai+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_selesai+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_untuk+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_kelas+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_jurusan+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_agama+'</span>'+
                        '</p><br/>'+
                        '<div class="col-md-8"><div class="row">'+
                        '<p><i style="color:#999">'+tanggal[emp].ujian_guru+'</i></p>'+
                        '<h3 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#formtampil" data-toggle="modal" onclick="tampilData('+tanggal[emp].ujian_id+')">'+tanggal[emp].ujian_pelajaran+'</a></h3>'+
                        '<p><i style="color:#999">Waktu '+tanggal[emp].ujian_waktu+' menit</i>, <i style="color:#999">Jenis ujian '+tanggal[emp].ujian_jenis+'</i>, <i style="color:#999">'+tanggal[emp].ujian_jumlah_soal+' buah soal</i></p>'+
                        '</div></div>'+
                        '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                        '<a title="Preview" title="Preview" data-backdrop="static" data-keyboard="false" href="#formDialogHasil" data-toggle="modal"  onClick="submitHasil('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-eye"></span></a>'+
                        '<a title="Export Data" title="Export" onClick="submitExport('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #6db571;" ><span class="fas fa-file-export"></span></a>'+



                        '</div></div>'+


                        '<div class="clearfix"></div>'+
                        '</div>';
                    nomor++;
                    $('#postListSekarang').append(empRow);
                }

            }


        }

    }




    ajaxPaginationDataBesok(0);
    function ajaxPaginationDataBesok(page_num) {
        page_num = page_num?page_num:0;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>guru/ujian/ajaxPaginationDataBesok/'+page_num,
            data:'page='+page_num,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                paginationDataBesok(responseData.empData);
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function paginationDataBesok(data) {

        $('#postListBesok').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar ujian besok</h4>'+
                '<p>Daftar ujian akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postListBesok').append(empRow);
        }else{

            for(emp2 in data){
                var tanggal = data[emp2].tanggal;

                var empRow = '<div class="list-group-item list-group-item-warning">'+
                    '<p class="list-group-item-text title" style="text-align:left;">'+data[emp2].ujian_tanggal_indo+'</p>'+
                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postListBesok').append(empRow);

                for(emp in tanggal) {


                    var empRow = '<div class="list-group-item">'+
                        '<p class="list-group-item-text title" style="text-align:center;">'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_mulai+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_selesai+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_untuk+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_kelas+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_jurusan+'</span>'+
                        ' <span class="label label-default">'+tanggal[emp].ujian_agama+'</span>'+
                        '</p><br/>'+
                        '<div class="col-md-8"><div class="row">'+
                        '<p><i style="color:#999">'+tanggal[emp].ujian_guru+'</i></p>'+
                        '<h3 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#" data-toggle="modal">'+tanggal[emp].ujian_pelajaran+'</a></h3>'+
                        '<p><i style="color:#999">Waktu '+tanggal[emp].ujian_waktu+' menit</i>, <i style="color:#999">Jenis ujian '+tanggal[emp].ujian_jenis+'</i>, <i style="color:#999">'+tanggal[emp].ujian_jumlah_soal+' buah soal</i></p>'+
                        '</div></div>'+
                        '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                        '<a title="Preview" title="Preview" data-backdrop="static" data-keyboard="false" href="#formDialogHasil" data-toggle="modal" onClick="submitHasil('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-eye"></span></a>'+
                        '<a title="Export Data" title="Export" onClick="submitExport('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #6db571;" ><span class="fas fa-file-export"></span></a>'+



                        '</div></div>'+


                        '<div class="clearfix"></div>'+
                        '</div>';
                    nomor++;
                    $('#postListBesok').append(empRow);
                }

            }


        }

    }






    function submitHasil(x) {
        if(x == 0){
            x = $('#idhasil').val();
        }

        //console.log(x);
        //window.open("<?php echo base_url();?>admin/ujian/gethasil?id="+x,'_blank');

        $(".submitpengaturanhasil  .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
        $("#pengaturanhasil").hide();

        $('#idhasil').val(x);

        var kelasBy = $('#kelasBy').val();
        var jurusanBy = $('#jurusanBy').val();
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>guru/ujian/ajaxPaginationDataHasil/0',
            data:'page=0&id='+x+'&kelasBy='+kelasBy+'&jurusanBy='+jurusanBy,

            cache: false,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationHasil').html(responseData.pagination);
                paginationDataHasil(responseData.empData,x);

                setSelectBox(x,kelasBy,jurusanBy);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }



    function paginationDataHasil(data,x) {

        $('#postListHasil').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar peserta ujian</h4>'+
                '<p>Daftar ujian akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postListHasil').append(empRow);
        }else{

            for(emp in data){

                var status = '<a title="Selesai" title="Selesai" href="javascript:void();" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-check"></span></a>';
                if(data[emp].soal_jawab_status == "Y"){
                    status = '<a title="Sedang mengerjakan" title="Sedang mengerjakan" href="#" class="btn btn-circle btn-default" style="color: #ff553a;" ><span class="fas fa-times"></span></a>';
                }

                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].peserta_kelas+'</span>'+
                    ' <span class="label label-default">'+data[emp].peserta_jurusan+'</span>'+
                    ' <span class="label label-default">'+data[emp].peserta_jurusan_ke+'</span>'+
                    '</p><br/>'+
                    '<div class="col-md-8"><div class="row">'+
                    '<p><i style="color:#999"></i></p>'+
                    '<h3 class="list-group-item-heading name"><a href="#">'+data[emp].peserta_nama+'</a></h3>'+
                    '<p><i style="color:#999">Mulai '+data[emp].soal_jawab_mulai+'</i>, <i style="color:#999">Selesai '+data[emp].soal_jawab_selesai+'</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="Benar" title="Benar" href="#" class="btn btn-circle btn-success" style="color: #fff;" >'+data[emp].soal_jawab_benar+'</a>'+
                    '<a title="Salah" title="Salah" href="#" class="btn btn-circle btn-danger" style="color: #fff;" >'+data[emp].soal_jawab_salah+'</a>'+ status +

                    '<a title="Preview" title="Preview" onclick="submitPreview('+data[emp].soal_jawab_id+')" class="btn btn-circle btn-default"><span class="fas fa-eye"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';

                $('#postListHasil').append(empRow);

            }


        }

    }

    function setSelectBox(x,kelasBy,jurusanBy) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>guru/ujian/getkelasjurusanhasil',
            data:'page=0&id='+x,

            cache: false,
            dataType:'json',
            success: function (responseData) {
                console.log(responseData);

                $('#kelasBy').html('<option value="">Semua Kelas</option>');
                $('#jurusanBy').html('<option value="">Semua Jurusan</option>');

                for(emp1 in responseData.kelas){
                    var selected = "";
                    if(responseData.kelas[emp1] == kelasBy){
                        selected = " selected";
                    }
                    $('#kelasBy').append('<option value="'+responseData.kelas[emp1]+'"'+selected+'>'+responseData.kelas[emp1]+'</option>');
                }
                for(emp2 in responseData.jurusan){
                    var selected = "";
                    if(responseData.jurusan[emp2] == jurusanBy){
                        selected = " selected";
                    }

                    $('#jurusanBy').append('<option value="'+responseData.jurusan[emp2]+'"'+selected+'>'+responseData.jurusan[emp2]+'</option>');
                }


                //$('#kelasBy').addClass("selectpicker");
                //$('#jurusanBy').addClass("selectpicker");


                //$('#kelasBy').attr("data-live-search","true");
                //$('#jurusanBy').attr("data-live-search","true");

                // selectpicker" data-live-search="true"
                //$('#jurusanBy').appendChild('<option value="a">a</option><option value="b">b</option>');
            }
        });
    }




    function submitExport(x) {
        window.open("<?php echo base_url();?>export/ujian?id="+x,'_blank');
    }
</script>