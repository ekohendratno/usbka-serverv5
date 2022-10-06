<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-pen fa-fw'></i> UJIAN<i class='fa fa-angle-right fa-fw'></i> DATA UJIAN</h4>
        <hr/>
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
            <a title="Tampilkan Token Ujian" data-backdrop="static" data-keyboard="false" href="#formToken" data-toggle="modal" onClick="formToken()" class="btn btn-sm btn-default btn-circle" style="color: #577a92;"><i class="fas fa-keyboard"></i></a>
            <a title="Tambah Ujian Baru" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog(0)" class="btn btn-sm btn-success btn-sm btn-circle"><i class="fas fa-plus"></i></a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-8">
        <div>
            <div style="min-height:800px;">

                <ul class="nav nav-tabs" style="margin-bottom: 8px">
                    <li class="active"><a data-toggle="tab" href="#ujianterbaru">Daftar Ujian</a></li>
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
                        <a href="<?php echo base_url(). "admin/soal/index"; ?>" class="btn btn-primary">Atur Ulang Setingan</a>
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

                            <div class="col-md-12">

                                <label>Untuk ditampilkan</label><br/>
                                <select class="form-control selectpicker"  id="untukBy" onchange="searchFilter()" data-live-search="true">
                                    <option value="">Tampil Semua Peruntukan</option>
                                    <?php foreach ($untukByUjian as $p):?>
                                        <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                        </div>

                    </div>


                </div>


            </div>


        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">
            <form role="form" name="_form"  id="_form" novalidate>
                <input type="hidden" id="id" name="id" value="0"/>

                <div class="modal-header">
                    <h4 class="modal-title"><span class="model-title-text">UJIAN</span>
                        <div class="pull-right text-right">


                            <a href="#" onclick="submitSimpan()" class="btn btn-primary submitsimpan">Simpan</a>

                            <a href="#" title="Pengaturan" class="btn btn-default btn-sm btn-circle submitpengaturan">
                                <i class="fas fa-arrow-up"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                        </div>
                    </h4>

                    <div class="container container-medium">

                        <div class="col-md-12">
                            <div id="pengaturan" class="row" style="padding-top: 30px">

                                <label>Pelajaran</label><br/>
                                <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                    <select name="ujian_pelajaran" class="form-control selectpicker" data-live-search="true">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        <?php foreach ($pelajaran as $p):?>
                                            <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">


                                        <label>Guru</label>
                                        <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                            <select name="ujian_guru" class="form-control selectpicker" data-live-search="true">
                                                <option value="">Pilih Pengajar</option>
                                                <?php foreach ($guru as $g):?>
                                                    <option value="<?php echo $g["id"];?>"><?php echo $g["label"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-6">


                                        <label>Peruntukan Untuk</label><br/>
                                        <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                            <select name="ujian_untuk" class="form-control selectpicker" data-live-search="true">
                                                <option value="">SEMUA PERUNTUKAN</option>
                                                <?php foreach ($untuk as $u):?>
                                                    <option value="<?php echo $u["id"];?>"><?php echo $u["label"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>



                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Kelas</label>
                                        <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                            <select name="ujian_kelas" class="form-control selectpicker" data-live-search="true">
                                                <option value="">Semua Kelas</option>
                                                <?php foreach ($kelas as $p):?>
                                                    <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <label>Jurusan</label>
                                        <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>

                                            <input id="ujian_jurusan"
                                                   name="ujian_jurusan"
                                                   type="text"
                                                   class="form-control"
                                                   value="">

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

                        <div class="modal-status"></div>


                        <div class="row">


                            <div class="col-xs-12 col-md-6">

                                <label>Mulai Tanggal</label><br/>
                                <input type='text' class="form-control" name="ujian_tanggal" id='datetimepicker1a' readonly />

                                <label>Mulai Jam</label><br/>
                                <input type='text' class="form-control" name="ujian_mulai" id='datetimepicker2a' readonly />

                                <br/>
                                <br/>

                                <label>Waktu Maksimal Mengerjakan Soal (menit)</label><br/>
                                <input type='number' min="10" class="form-control" id="ujian_waktu" name="ujian_waktu" value="0" />

                                <label>Jumlah Soal</label><br/>
                                <input type='number' min="10" class="form-control" id="ujian_jumlah_soal" name="ujian_jumlah_soal" value="0" />


                            </div>
                            <div class="col-xs-12 col-md-6">

                                <label>Jenis Urutan Soal</label><br/>
                                <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                    <select name="ujian_jenis" class="form-control selectpicker" data-live-search="true">
                                        <option value="">Pilih Urutan</option>
                                        <option value="Urut">Urut</option>
                                        <option value="Acak">Acak</option>
                                    </select>
                                </div>
                                <br/>
                                <label>Khusus untuk Agama tertentu</label><br/>

                                <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>

                                    <input id="ujian_agama"
                                           name="ujian_agama"
                                           type="text"
                                           class="form-control"
                                           value="">
                                </div>

                            </div>


                        </div>


                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formToken" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kode Token Ujian
                    <div class="pull-right">
                        <a href="javascript:void();" onclick="formToken()" class="btn btn-success">Segarkan</a>
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center container-fluid">


                        <div id="token">------</div>


                    </div>

                    <div class="clear"></div>
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

                        <a href="#" onclick="submitExportJawaban()" class="btn btn-primary">Export Jawaban</a>
                        <a href="#" onclick="submitSelesaiUjianSemua()" class="btn btn-danger">Set Semua Selesai</a>
                        <a href="#" title="Pengaturan" class="btn btn-default btn-sm btn-circle submitpengaturanhasil">
                            <i class="fas fa-arrow-up"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
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
    var daftar_jurusan = <?php echo $jurusan;?>;
    var daftar_agama = <?php echo $agama;?>;

    $('#ujian_jurusan').tagator({
        showAllOptionsOnFocus: true,
        allowAutocompleteOnly: true,
        autocomplete: daftar_jurusan,
        useDimmer: true
    });

    $('#ujian_agama').tagator({
        showAllOptionsOnFocus: true,
        allowAutocompleteOnly: true,
        autocomplete: daftar_agama,
        useDimmer: true
    });

    $(document).ready(function() {

        $('.selectpicker').selectpicker();

        $(".submitpengaturanhide").click(function(){
            $("#pengaturan").hide(300);
        });
        $(".submitpengaturan").click(function(){
            var side = $(".fa-arrow-up").attr('class');
            if(side){
                $(".fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            }else{
                $(".fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            }

            $("#pengaturan").slideToggle();
        });


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

        $('[name="ujian_pelajaran"]').on('change', function() {
            var pelajaran = $('[name="ujian_pelajaran"]').val();
            $.ajax({
                type:'GET',
                data: 'pelajaran='+pelajaran,
                url:'<?php echo base_url('admin/ujian/getguru') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){

                    $("[name='ujian_guru']").val(hasil.label);
                    $("[name='ujian_guru']").selectpicker('refresh');

                    $("[name='ujian_untuk']").val(hasil.label2);
                    $("[name='ujian_untuk']").selectpicker('refresh');

                }
            });

        });

        $('#_form').submit(function(e){
            var form = new FormData(this);

            e.preventDefault();
            $.ajax({
                type:'POST',
                data: form,
                url:'<?php echo base_url('index.php/admin/ujian/simpan') ;?>',
                dataType:'json',
                processData :false,
                contentType :false,
                cache :false,
                async :false,
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(hasil){
                    console.log(hasil);

                    if(hasil.status){

                        $('.buttonload').fadeOut("slow");
                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                        searchFilter(0);

                        formDialog(hasil.id);
                        ajaxPaginationDataSekarang(0);
                        ajaxPaginationDataBesok(0);

                    }else{
                        $('.buttonload').fadeOut("slow");
                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    }

                    //$("#formDialog").modal('hide');


                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        });

    });

    //$('#btn-tambah').attr("disabled",true);



    $('#formSearch').on('shown.bs.modal', function() {
        $('#keywords').trigger('focus');
    });

    searchFilter(0);
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();
        var untukBy = $('#untukBy').val();


        ajaxPaginationDataSekarang(0);
        ajaxPaginationDataBesok(0);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/ujian/ajaxPaginationData/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&untukBy='+untukBy,
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
                        '<h3 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#formtampil" data-toggle="modal" onClick="submitPreviewSoal(\''+tanggal[emp].ujian_tahunajaran+'\',\''+tanggal[emp].ujian_pelajaran+'\',\''+tanggal[emp].ujian_guru+'\',\''+tanggal[emp].ujian_kelas+'\',\''+tanggal[emp].ujian_untuk+'\')">'+tanggal[emp].ujian_pelajaran+'</a></h3>'+
                        '<p><i style="color:#999">Waktu '+tanggal[emp].ujian_waktu+' menit</i>, <i style="color:#999">Jenis ujian '+tanggal[emp].ujian_jenis+'</i>, <i style="color:#999">'+tanggal[emp].ujian_jumlah_soal+' buah soal</i></p>'+
                        '</div></div>'+
                        '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                        '<a title="Preview" title="Preview" data-backdrop="static" data-keyboard="false" href="#formDialogHasil" data-toggle="modal" onClick="submitHasil('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-eye"></span></a>'+
                        '<a title="Export Data" title="Duplikat" onClick="submitExport('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #6db571;" ><span class="fas fa-file-export"></span></a>'+
                        '<a title="Duplikat Data" title="Duplikat" onClick="submitDuplikat('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-clone"></span></a>'+
                        '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                        '<a title="Hapus" onclick="submitHapus('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+




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

        var untukBy = $('#untukBy').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/ujian/ajaxPaginationDataSekarang/'+page_num,
            data:'page='+page_num+'&untukBy='+untukBy,
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
                        '<h3 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#formtampil" data-toggle="modal" onClick="submitPreviewSoal(\''+tanggal[emp].ujian_tahunajaran+'\',\''+tanggal[emp].ujian_pelajaran+'\',\''+tanggal[emp].ujian_guru+'\',\''+tanggal[emp].ujian_kelas+'\',\''+tanggal[emp].ujian_untuk+'\')">'+tanggal[emp].ujian_pelajaran+'</a></h3>'+
                        '<p><i style="color:#999">Waktu '+tanggal[emp].ujian_waktu+' menit</i>, <i style="color:#999">Jenis ujian '+tanggal[emp].ujian_jenis+'</i>, <i style="color:#999">'+tanggal[emp].ujian_jumlah_soal+' buah soal</i></p>'+
                        '</div></div>'+
                        '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                        '<a title="Preview" title="Preview" data-backdrop="static" data-keyboard="false" href="#formDialogHasil" data-toggle="modal"  onClick="submitHasil('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-eye"></span></a>'+
                        '<a title="Export Data" title="Duplikat" onClick="submitExport('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #6db571;" ><span class="fas fa-file-export"></span></a>'+
                        '<a title="Duplikat Data" title="Duplikat" onClick="submitDuplikat('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-clone"></span></a>'+
                        '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                        '<a title="Hapus" onclick="submitHapus('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+




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

        var untukBy = $('#untukBy').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/ujian/ajaxPaginationDataBesok/'+page_num,
            data:'page='+page_num+'&untukBy='+untukBy,
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
                        '<h3 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#formtampil" data-toggle="modal" onClick="submitPreviewSoal(\''+tanggal[emp].ujian_tahunajaran+'\',\''+tanggal[emp].ujian_pelajaran+'\',\''+tanggal[emp].ujian_guru+'\',\''+tanggal[emp].ujian_kelas+'\',\''+tanggal[emp].ujian_untuk+'\')">'+tanggal[emp].ujian_pelajaran+'</a></h3>'+
                        '<p><i style="color:#999">Waktu '+tanggal[emp].ujian_waktu+' menit</i>, <i style="color:#999">Jenis ujian '+tanggal[emp].ujian_jenis+'</i>, <i style="color:#999">'+tanggal[emp].ujian_jumlah_soal+' buah soal</i></p>'+
                        '</div></div>'+
                        '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                        '<a title="Preview" title="Preview" data-backdrop="static" data-keyboard="false" href="#formDialogHasil" data-toggle="modal" onClick="submitHasil('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-eye"></span></a>'+
                        '<a title="Export Data" title="Duplikat" onClick="submitExport('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #6db571;" ><span class="fas fa-file-export"></span></a>'+
                        '<a title="Duplikat Data" title="Duplikat" onClick="submitDuplikat('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-clone"></span></a>'+
                        '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                        '<a title="Hapus" onclick="submitHapus('+tanggal[emp].ujian_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+




                        '</div></div>'+


                        '<div class="clearfix"></div>'+
                        '</div>';
                    nomor++;
                    $('#postListBesok').append(empRow);
                }

            }


        }

    }



    function formDialog(id) {
        $(".model-title-text").html("BUAT UJIAN");

        $('#id').val(0);
        $('[name="ujian_kelas"]').val("");
        $('[name="ujian_jurusan"]').val("");
        $('[name="ujian_pelajaran"]').val("");
        $('[name="ujian_guru"]').val("");
        $('[name="ujian_untuk"]').val("");
        $('[name="ujian_jenis"]').val("");
        $('[name="ujian_tanggal"]').val("");
        $('[name="ujian_mulai"]').val("");
        $('[name="ujian_waktu"]').val(60);
        $('[name="ujian_jumlah_soal"]').val(30);
        $('[name="ujian_agama"]').val("");

        $('[name="ujian_jurusan"]').tagator('refresh');
        $('[name="ujian_agama"]').tagator('refresh');
        $('[name="ujian_untuk"]').selectpicker('refresh');


        var kegiatan = "<?php echo $kegiatan;?>";
        if( kegiatan != "" ){
            $('[name="ujian_untuk"]').val(kegiatan);
            $('[name="ujian_untuk"]').selectpicker('refresh');
        }

        $('.submitsimpan').html("");
        $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");


        if(id > 0){
            $(".model-title-text").html("UBAH UJIAN");
            $(".fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");

            $("#pengaturan").hide();

            $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "GET",
                data: 'id='+id,
                url: "<?php echo site_url('admin/ujian/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(data){
                    //console.log(data);

                    $('#id').val(id);
                    $('[name="ujian_kelas"]').val(data.ujian_kelas);
                    $('[name="ujian_jurusan"]').val(data.ujian_jurusan);
                    $('[name="ujian_pelajaran"]').val(data.ujian_pelajaran);
                    $('[name="ujian_guru"]').val(data.ujian_guru);
                    $('[name="ujian_untuk"]').val(data.ujian_untuk);
                    $('[name="ujian_jenis"]').val(data.ujian_jenis);
                    $('[name="ujian_tanggal"]').val(data.ujian_tanggal);
                    $('[name="ujian_mulai"]').val(data.ujian_mulai);
                    $('[name="ujian_waktu"]').val(data.ujian_waktu);
                    $('[name="ujian_jumlah_soal"]').val(data.ujian_jumlah_soal);
                    $('[name="ujian_agama"]').val(data.ujian_agama);

                    $("#datetimepicker1a" ).datepicker({
                        dateFormat: 'yy-m-d',
                        yearRange: '2001:2030',
                        changeYear: true,
                        changeMonth: true,
                        autoSize: true,
                        showAnim: 'slideDown',
                        firstDay: 1
                    }).datetimepicker('setDate', new Date()).val(data.ujian_tanggal);

                    $('#datetimepicker2a').timepicker({
                        timeFormat: 'HH:mm',
                        autoSize: true,
                        showAnim: 'slideDown'
                    }).timepicker('setTime', new Date()).val(data.ujian_mulai);



                    /**
                    $('[name="ujian_kelas"]').selectpicker('refresh');
                    $('[name="ujian_jurusan"]').tagator('refresh');
                    $('[name="ujian_pelajaran"]').selectpicker('refresh');
                    $('[name="ujian_guru"]').selectpicker('refresh');
                    $('[name="ujian_untuk"]').selectpicker('refresh');
                    $('[name="ujian_agama"]').tagator('refresh');*/

                    $('.selectpicker').selectpicker('refresh');
                    $('#ujian_jurusan').tagator('refresh');
                    $('#ujian_agama').tagator('refresh');


                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }else{
            $(".fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");

            $("#pengaturan").show(1000);

            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var time = today.getHours() + ":" + today.getMinutes();

            //tanggal
            $("#datetimepicker1a" ).datepicker({
                dateFormat: 'yy-m-d',
                yearRange: '2001:2030',
                changeYear: true,
                changeMonth: true,
                autoSize: true,
                showAnim: 'slideDown',
                firstDay: 1
            }).datetimepicker('setDate', new Date()).val(date);
            //jam
            $('#datetimepicker2a').timepicker({
                timeFormat: 'HH:mm',
                autoSize: true,
                showAnim: 'slideDown'
            }).timepicker('setTime', new Date()).val(time);

        }

        searchFilter(0);
    }

    function formToken(){
        $('#token').html('');

        $.ajax({
            type:'POST',
            url:'<?php echo base_url('token?code=1') ;?>',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                $('#loading_ajax').fadeOut("slow");
                var html = "";
                html+= "<h1  style=\"font-family: 'Courier New'; font-size: 68px; margin-top: 80px;\">"+responseData.ujian_token_text+"</h1><br/>";
                html+="<p>Perbaharui pada tanggal "+responseData.ujian_token_tanggal+"</p>";

                $('#token').html(html);
            }
        });
    }

    function submitSimpan() {
        $('.buttonload').show();
        $('#loading_ajax').show();
        setTimeout(function(){
            $("#_form").submit();
        }, 0);
    }


    function submitDuplikat(id) {
        var tanya = confirm('Apakah yakin mau duplikat data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('admin/ujian/simpan_duplikat') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){

                    if(hasil.status){

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                        searchFilter(0);

                        formDialog(hasil.id);
                        ajaxPaginationDataSekarang(0);
                        ajaxPaginationDataBesok(0);

                        $("#formDialog").modal('show');

                    }else{
                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    }
                }
            });
        }
    }

    function submitExport(x) {
        window.open("<?php echo base_url();?>export/ujian?id="+x,'_blank');
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
            url: '<?php echo base_url(); ?>admin/ujian/ajaxPaginationDataHasil/0',
            data:'page=0&id='+x+'&kelasBy='+kelasBy+'&jurusanBy='+jurusanBy,

            cache: false,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
                $('#postListHasil').empty();
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

                var status = '<a title="Selesai" title="Selesai" href="javascript:void();" onclick="submitPesan()"  class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-check"></span></a>';
                if(data[emp].soal_jawab_status == "Y"){
                    status = '<a title="Set Selesai" title="Set Selesai" href="#" onClick="submitSelesaiUjian('+x+','+data[emp].soal_jawab_id+')" class="btn btn-circle btn-default" style="color: #ff553a;" ><span class="fas fa-times"></span></a>';
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


                    '<a title="Hapus" onclick="submitHapusUjian('+x+','+data[emp].soal_jawab_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+




                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';

                $('#postListHasil').append(empRow);

            }


        }

    }


    function submitSelesaiUjian(x,y){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau selesaikan hasil?');
        if(tanya){
            $.ajax({
                type:'GET',
                url: "<?php echo base_url(); ?>admin/ujian/simpanhasil/?id="+y,
                dataType: 'json',
                success: function(){
                    submitHasil(x);
                    $('#loading_ajax').hide();
                }
            });
        }else{
            $('#loading_ajax').hide();
        }
    }


    function submitSelesaiUjianSemua(){
        var x = $('#idhasil').val();

        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau selesaikan hasil?');
        if(tanya){

            $.ajax({
                type:'GET',
                url: "<?php echo base_url(); ?>admin/ujian/simpanhasil_all/?id="+x,
                dataType: 'json',
                success: function(){
                    submitHasil(x);
                    $('#loading_ajax').hide();
                }
            });
        }else{
            $('#loading_ajax').hide();
        }
    }


    function submitHapusUjian(x,y){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+y,
                url:'<?php echo base_url('admin/ujian/hapushasilbyid') ;?>',
                success: function(){
                    submitHasil(x);
                }
            });
        }
    }


    function submitPreview(x) {
        var w = 800;
        var h = 760;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        window.open("<?php echo base_url();?>admin/ujian/getpreview_siswa?id="+x, '_blank', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        return false;
    }


    function submitExportJawaban() {
        var x = $('#idhasil').val();
        window.open("<?php echo base_url();?>export/ujian_jawaban?id="+x,'_blank');
    }


    function setSelectBox(x,kelasBy,jurusanBy) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>admin/ujian/getkelasjurusanhasil',
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


    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('admin/ujian/hapus') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    searchFilter(0);
                    ajaxPaginationDataSekarang(0);
                    ajaxPaginationDataBesok(0);
                }
            });
        }
    }


    function submitPesan() {
        alert("Peserta telah selesai ujian");
    }



    function submitPreviewSoal(tahunajaran, pelajaran,guru,kelas,untuk) {

        var w = 800;
        var h = 760;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        window.open("<?php echo base_url();?>export/soal?"+
            "tahunajaran="+tahunajaran+
            "&pelajaran="+pelajaran+
            "&guru="+guru+
            "&kelas="+kelas+
            "&untuk="+untuk,
            '_blank', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        return false;
    }

</script>