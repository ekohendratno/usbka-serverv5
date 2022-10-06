<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-file fa-fw'></i> BANK SOAL <i class='fa fa-angle-right fa-fw'></i> DATA SOAL TERBARU</h4>
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


                <div id="postList0" class="list-group"></div>
                <div id='pagination'></div>


            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">

        <div class="row">
            <div class="col-md-12">

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
                    <div class="col-md-12" style="display: none">
                        <div class="small-box bg-light" style="min-height: 120px;">
                            <?php
                            foreach ($kumpul["pelajaranx"] as $k => $v){ ?>
                                <div class="inner">
                                    <h3><?php echo $v["jumlah_kumpul"];?></h3>
                                    <p><?php echo $v["pelajaran"];?></p>
                                    <p><?php echo $v["kelas"];?></p>
                                </div>
                            <?php }?>
                            <div class="icon">
                                <i class="fas fa-file"></i>
                            </div>
                        </div>
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
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="200">200</option>
                                </select>
                            </div>


                        </div>

                    </div>


                </div>


            </div>


        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formDialogList" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">

            <div class="modal-header">

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h4 class="modal-title"><span class="model-title-text2">DAFTAR SOAL</span></h4>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-10">
                        <div class="input-group input-group" id="keywords2Form">
                            <div class="input-group-addon"><i class="fas fa-search"></i></div>
                            <input type="text" class="form-control" name="keywords2" id="keywords2" placeholder="Type keywords to filter posts" onkeyup="searchFilter2(0,0)">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-2">
                        <div class="pull-right">
                            <a title="Import Soal Baru" data-backdrop="static" data-keyboard="false" href="#formDialogImport" data-toggle="modal" onClick="formDialogImport()" class="btn btn-sm btn-primary  btn-sm btn-circle"><i class="fas fa-file-import"></i></a>
                            <a title="Tambah Soal Baru" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog(0)" class="btn btn-sm btn-success  btn-sm btn-circle"><i class="fas fa-plus"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-body">

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div id="postList1" class="list-group"></div>
                            <div id='pagination1'></div>


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
                <input type="hidden" id="parent" name="parent" value="0"/>
                <input type="hidden" id="jenis" name="jenis" value="optional"/>

                <div class="modal-header">


                    <h4 class="modal-title"><span class="model-title-text">SOAL</span>
                        <div class="pull-right text-right">

                            <select name="soal_jenis" class="btn">
                                <option value="optional">Optional</option>
                                <option value="essay">Essay</option>
                                <option value="checked">Cheked</option>
                            </select>

                            <a href="#" title="Selanjutnya" onClick="submitSelanjutnya()" class="btn btn-default submitselanjutnya">Selanjutnya</a>
                            <a href="#" onclick="submitSimpan()" class="btn btn-primary submitsimpan">Publikasi</a>
                            <a href="#" title="Pengaturan" class="btn btn-default btn-sm btn-circle submitpengaturan">
                                <i class="fas fa-arrow-up"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>

                        </div>
                    </h4>
                    <div class="clearfix"></div>

                    <div class="container container-medium">


                        <div class="col-md-12">
                            <div id="pengaturan" class="row" style="padding-top: 30px">

                                <div class="col-md-8">
                                    <label>Pelajaran</label><br/>
                                    <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                        <select name="soal_pelajaran" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Pilih Mata Pelajaran</option>
                                            <?php foreach ($pelajaran as $p):?>
                                                <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">


                                    <label>Peruntukan Soal</label><br/>
                                    <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                        <select name="soal_untuk" class="form-control selectpicker" data-live-search="true">
                                            <option value="UTS">UTS</option>
                                            <option value="UAS">UAS</option>
                                            <option value="USBN">USBN</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="text-right" style="display: none">
                                    <a href="javascript:void();" class="btn btn-default submitpengaturanhide"><i class="fas fa-arrow-up"></i></a>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
                <div class="modal-body">



                    <div class="container container-medium">

                        <div class="modal-status"></div>



                        <ul class="nav nav-tabs" style="margin-bottom: 8px">
                            <li class="active"><a data-toggle="tab" href="#home">Soal</a></li>
                            <li><a data-toggle="tab" href="#menu2">Daftar kutipan</a></li>
                            <li><a data-toggle="tab" href="#menu1">Kutipan yang digunakan</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">



                                <label>Pertanyaan</label><br/>
                                <div class="input-group">
                                    <textarea style="font-size: 16pt; height: 200px" type="text" name="soal_text" id="soal_text" class="form-control tinyEditor" required></textarea>
                                    <span class="input-group-addon"><i class="fas fa-file"></i></span>
                                </div>
                                <br/>
                                <label>Jawaban</label><br/>

                                <div id="optional" style="display: block;">
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional0" id="soal_text_jawab_optional0" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="radio" name="soal_text_jawab_optional[]" value="1"></span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional1" id="soal_text_jawab_optional1" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="radio" name="soal_text_jawab_optional[]" value="2"></span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional2" id="soal_text_jawab_optional2" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="radio" name="soal_text_jawab_optional[]" value="3"></span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional3" id="soal_text_jawab_optional3" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="radio" name="soal_text_jawab_optional[]" value="4"></span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional4" id="soal_text_jawab_optional4" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="radio" name="soal_text_jawab_optional[]" value="5"></span>
                                    </div>
                                </div>

                                <div id="essay" style="display: none;">
                                    <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_essay0" id="soal_text_jawab_essay0" class="form-control" required></textarea>
                                </div>


                                <div id="checked" style="display: none;">
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked0" id="soal_text_jawab_checked0" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="checkbox" name="soal_text_jawab_checked[]" value="1"></span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked1" id="soal_text_jawab_checked1" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="checkbox" name="soal_text_jawab_checked[]" value="2"></span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked2" id="soal_text_jawab_checked2" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="checkbox" name="soal_text_jawab_checked[]" value="3"></span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked3" id="soal_text_jawab_checked3" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="checkbox" name="soal_text_jawab_checked[]" value="4"></span>
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked4" id="soal_text_jawab_checked4" class="form-control tinyEditor" required></textarea>
                                        <span class="input-group-addon"><input type="checkbox" name="soal_text_jawab_checked[]" value="5"></span>
                                    </div>
                                </div>


                            </div>
                            <div id="menu1" class="tab-pane fade">


                                <div class="clearfix"></div>

                                <div id="postListParentText" style="font-size: 18px"></div>

                            </div>
                            <div id="menu2" class="tab-pane fade">

                                <div class="row">
                                    <div class="col-md-11" style="margin-bottom: 8px">


                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fas fa-search"></i></div>
                                            <input type="text" class="form-control token" name="keywords3" id="keywords3" placeholder="Type keywords to filter posts" onkeyup="searchFilter3()">

                                        </div>

                                    </div>

                                    <div class="col-md-1 text-right" style="margin-bottom: 8px">

                                        <a data-backdrop="static" data-keyboard="false" data-toggle="modal" href="#formDialogParent" onclick="formDialog2(0)" class="btn btn-block btn-success"><i class="fas fa-plus"></i></a>

                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div id="postListParent" class="list-group"></div>
                                <div id='pagination2'></div>

                            </div>
                        </div>




                    </div>

                </div>

            </form>

        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formDialogParent" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">

            <form role="form" name="_formparent"  id="_formparent" novalidate>
                <input type="hidden" id="parent_id" name="parent_id" value="0"/>


                <div class="modal-header">

                    <h4 class="modal-title"><span class="model-title-text2">KUTIPAN SOAL</span>

                        <div class="pull-right">
                            <a href="#" onclick="submitSimpanParent()" class="btn btn-primary submitsimpanparent">Publikasi</a>
                            <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                        </div>
                    </h4>

                </div>
                <div class="modal-body">

                    <div class="container container-medium">

                        <div class="modal-status"></div>

                        <textarea style="font-size: 16pt; height: 200px" type="text" name="soal_parent_text" id="soal_parent_text" class="form-control tinyEditor" required></textarea>

                        <br/>
                        <div class="clearfix"></div>
                        <p><i>* Kutipan soal ini dapat digunakan kembali untuk soal lainnya di pelajaran yang sama.</i></p>

                    </div>


                </div>

            </form>


        </div>
    </div>
</div>

<script type="text/javascript">

    var js = document.createElement("script");
    js.type = "text/javascript";
    js.src = "<?php echo base_url();?>assets/admin/js/tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image";
    document.head.appendChild(js);


    $(document).ready(function() {

        $('[name="soal_jenis"]').on('change', function() {
            var jenis = this.value;
            $('#optional').css("display","none");
            $('#essay').css("display","none");
            $('#checked').css("display","none");

            if(jenis == "optional"){
                $('#optional').css("display","block");
            }else if(jenis == "essay"){
                $('#essay').css("display","block");
            }else if(jenis == "checked"){
                $('#checked').css("display","block");
            }

            $('#jenis').val(jenis);
        });



        $(".submitpengaturan").click(function(){
            var side = $(".submitpengaturan .fa-arrow-up").attr('class');
            if(side){
                $(".submitpengaturan .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            }else{
                $(".submitpengaturan .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            }

            $("#pengaturan").slideToggle();
        });



        $('#_form').submit(function(e){
            $(".submitselanjutnya").hide();

            var form = new FormData(this);

            form.append('soal_text', tinyMCE.get("soal_text").getContent());

            for (var y = 0; y <= 4; ++y) {
                form.append('soal_text_jawab_optional'+y, tinyMCE.get('soal_text_jawab_optional'+y).getContent());
            }
            for (var x = 0; x <= 4; ++x) {
                form.append('soal_text_jawab_checked'+x, tinyMCE.get('soal_text_jawab_checked'+x).getContent());
            }

            e.preventDefault();
            $.ajax({
                type:'POST',
                data: form,
                url:'<?php echo base_url('index.php/guru/soal/simpan') ;?>',
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

                        searchFilter2(0,0);

                        formDialog(hasil.id);


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



        $('#_formparent').submit(function(e){

            var form = new FormData(this);

            form.append('parent_pelajaran', $('[name="soal_pelajaran"]').val());
            form.append('soal_parent_text', tinyMCE.get("soal_parent_text").getContent());

            e.preventDefault();
            $.ajax({
                type:'POST',
                data: form,
                url:'<?php echo base_url('index.php/guru/soal/simpanparent') ;?>',
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

                        $('.buttonload2').fadeOut("slow");
                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                        searchFilter3(0,0);

                        formDialog2(hasil.id);


                    }else{
                        $('.buttonload2').fadeOut("slow");
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
            url: '<?php echo base_url(); ?>guru/soal/ajaxPaginationData/'+page_num,
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
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function searchFilter2(page_num,id,pelajaran,untuk) {
        page_num = page_num?page_num:0;

        $('[name="soal_pelajaran"]').val(pelajaran);
        $('[name="soal_pelajaran"]').selectpicker('refresh');

        $('[name="soal_untuk"]').val(untuk);
        $('[name="soal_untuk"]').selectpicker('refresh');

        var keywords = $('#keywords2').val();
        //var id = $('#parent').val();

        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>guru/soal/ajaxPaginationData1/'+page_num,
            data:'page='+page_num+'&idBy='+id+'&keywords='+keywords,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);
                $('#pagination1').html(responseData.pagination);
                paginationData2(responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function searchFilter3(page_num,id) {
        page_num = page_num?page_num:0;

        var keywords = $('#keywords3').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>guru/soal/ajaxPaginationData2/'+page_num,
            data:'page='+page_num+'&idBy='+id+'&keywords='+keywords,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);
                $('#pagination2').html(responseData.pagination);
                paginationData3(responseData.empData);
            },
            complete: function(){
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
                '<h4>Tidak ada daftar soal</h4>'+
                '<p>Daftar soal akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postList0').append(empRow);
        }else{

            for(emp in data){



                var empRow = '<a data-backdrop="static" data-keyboard="false" href="#formDialogList" data-toggle="modal" onClick="searchFilter2(0,'+data[emp].soal_pembuat_id+',\''+data[emp].soal_pembuat_pelajaran+'\',\''+data[emp].soal_pembuat_untuk+'\')"><div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">Tugas dibuat pada '+data[emp].soal_pembuat_tanggal+'</span>'+
                    ' <span class="label label-default">Tersisa '+data[emp].soal_pembuat_tanggal_dikumpulkan+' hari</span>'+
                    '</p><br/>'+

                    '<div class="col-md-8"><div class="row">'+
                    '<h4 class="list-group-item-heading name">'+data[emp].soal_pembuat_pelajaran+'</h4>'+
                    '<p><i style="color:#999">'+data[emp].soal_pembuat_untuk+', '+data[emp].soal_pembuat_kelas+', '+data[emp].soal_pembuat_jurusan+'</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<div class="btn btn-default" title="Terkumpul">'+data[emp].soal_jumlah_terkumpul+'</div> '+
                    '<div class="btn btn-success" title="Minimal Terkumpul Seharusnya">'+data[emp].soal_jumlah_terkumpul_total+'</div> '+

                    //'<a title="Tambah Soal Data" title="Tambah" href="javascript:void()" onClick="formDialog('+data[emp].soal_pembuat_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-plus"></span></a>'+


                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div></a>';
                nomor++;
                $('#postList0').append(empRow);
            }

        }

    }

    function paginationData2(data) {

        $('#postList1').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar soal</h4>'+
                '<p>Daftar soal akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postList1').append(empRow);
        }else{

            for(emp in data){



                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].soal_date+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_untuk+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_jenis+'</span>'+
                    '</p><br/>'+

                    '<div class="col-md-8"><div class="row">'+
                    '<h4 class="list-group-item-heading name">'+data[emp].soal_text+'</h4>'+
                    '<p><i style="color:#999">'+data[emp].soal_pelajaran+'</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="Duplikat Data" title="Duplikat" onClick="submitDuplikat('+data[emp].soal_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-clone"></span></a>'+
                    '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+data[emp].soal_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapus('+data[emp].soal_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postList1').append(empRow);
            }

        }

    }

    function paginationData3(data) {

        $('#postListParent').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar parent soal</h4>'+
                '<p>Daftar parent soal akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postListParent').append(empRow);
        }else{

            for(emp in data){

                var parent_color = " btn-default";
                var parent = $('#parent').val();

                console.log(parent+"========"+data[emp].soal_parent_id);

                if(parent == data[emp].soal_parent_id){
                    parent_color = " btn-success";
                }

                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].soal_parent_date+'</span>'+
                    '</p><br/>'+

                    '<div class="col-md-8"><div class="row">'+
                    '<h4 class="list-group-item-heading name">'+data[emp].soal_parent_text+'</h4>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="Pilih Data" title="Duplikat" onClick="submitSelectParent('+data[emp].soal_parent_id+')" class="btn btn-circle'+parent_color+'" style="color: #4c4c4c;" ><span class="fas fa-check"></span></a>'+
                    '<a title="Duplikat Data" title="Duplikat" onClick="submitDuplikatParent('+data[emp].soal_parent_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-clone"></span></a>'+
                    '<a title="Ubah Data" title="Ubah" onClick="formDialog2('+data[emp].soal_parent_id+')" data-backdrop="static" data-keyboard="false" data-toggle="modal" href="#formDialogParent" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapusParent('+data[emp].soal_parent_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postListParent').append(empRow);
            }

        }

    }



    function formDialog(id) {

        $(".submitselanjutnya").hide();
        $(".model-title-text").html("BUAT SOAL");


        $('#id').val(0);

        //$('[name="soal_pelajaran"]').val("");
        //$('[name="soal_pelajaran"]').selectpicker('refresh');

        //$('[name="soal_guru"]').val("");
        //$('[name="soal_guru"]').selectpicker('refresh');

        //$('[name="soal_untuk"]').val("");
        //$('[name="soal_untuk"]').selectpicker('refresh');

        $('#jenis').val("optional");
        $('#parent').val(0);

        //$('[name="soal_jenis"]').val("optional");
        $('[name="soal_jenis"]').prop('disabled', false);

        $('#soal_text_jawab_essay0').val("");
        tinyMCE.get('soal_text').setContent('<p><p>');

        $('input[type="radio"]:checked').prop('checked', false);
        $('input[type="checkbox"]:checked').prop('checked', false);
        for (var y = 0; y <= 4; ++y) {
            tinyMCE.get('soal_text_jawab_optional'+y).setContent('<p><p>');
            tinyMCE.get('soal_text_jawab_checked'+y).setContent('<p><p>');
        }

        $('#optional').css("display","block");
        $('#essay').css("display","none");
        $('#checked').css("display","none");


        $('.submitsimpan').html("");
        $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");
        if(id > 0){

            $(".model-title-text").html("UBAH SOAL");
            $(".submitpengaturan .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            $("#pengaturan").hide();
            $(".submitselanjutnya").show();

            $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "GET",
                data: 'id='+id,
                url: "<?php echo site_url('guru/soal/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(data){
                    console.log(data);

                    $('#id').val(id);
                    $('[name="soal_pelajaran"]').val(data.soal_pelajaran);
                    $('[name="soal_pelajaran"]').selectpicker('refresh');

                    $('[name="soal_guru"]').val(data.soal_guru);
                    $('[name="soal_guru"]').selectpicker('refresh');

                    $('[name="soal_untuk"]').val(data.soal_untuk);
                    $('[name="soal_untuk"]').selectpicker('refresh');


                    tinyMCE.get('soal_text').setContent(data.soal_text);

                    var jenis = data.soal_jenis;
                    var soal_text_jawab = data.soal_text_jawab;


                    $('#optional').css("display","none");
                    $('#essay').css("display","none");
                    $('#checked').css("display","none");


                    $('#jenis').val(jenis);
                    $('#parent').val(data.soal_parent_id);

                    $('[name="soal_jenis"]').val(jenis);
                    $('[name="soal_jenis"]').prop('disabled', true);

                    if(jenis == "optional"){
                        $('#optional').css("display","block");

                        let initValues = [];
                        for (var i = 0; i < soal_text_jawab.length; ++i) {
                            tinyMCE.get('soal_text_jawab_optional'+i).setContent(soal_text_jawab[i][1]);

                            if(soal_text_jawab[i][0] == 1){
                                initValues.push(i+1);
                            }
                        }

                        $('#_form').find(':radio[name="soal_text_jawab_optional[]"]').each(function() {
                            if (initValues.some(v => v == $(this).val())) {
                                $(this).prop('checked', true);
                            }
                        });


                    }else if(jenis == "checked"){
                        $('#checked').css("display","block");

                        let initValues = [];
                        for (var i = 0; i < soal_text_jawab.length; ++i) {
                            tinyMCE.get('soal_text_jawab_checked'+i).setContent(soal_text_jawab[i][1]);

                            if(soal_text_jawab[i][0] == 1){
                                initValues.push(i+1);
                            }
                        }
                        $('#_form').find(':checkbox[name="soal_text_jawab_checked[]"]').each(function() {
                            if (initValues.some(v => v == $(this).val())) {
                                $(this).prop('checked', true);
                            }
                        });

                    }else if(jenis == "essay"){
                        $('#essay').css("display","block");

                        $('#soal_text_jawab_essay0').val(soal_text_jawab);
                    }


                    searchFilter3(0,id);

                    //$('#parent').val(0);
                    $('#postListParentText').html('');
                    $.ajax({
                        type: "GET",
                        data: 'id='+data.soal_parent_id,
                        url: "<?php echo site_url('guru/soal/ambildatabyid2'); ?>",
                        cache: false,
                        dataType:'json',
                        beforeSend: function () {
                            $('#loading_ajax').show();
                        },
                        success: function(data){
                            console.log(data);

                            //$('#parent').val(id);
                            $('#postListParentText').html(data.soal_parent_text);

                        },
                        complete: function(){
                            $('#loading_ajax').fadeOut("slow");
                        }
                    });


                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }else{
            searchFilter3(0,id);
            $(".submitpengaturan .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            $("#pengaturan").show(1000);
        }

    }

    function formDialog2(id) {
        $('#parent_id').val(0);
        tinyMCE.get('soal_parent_text').setContent('<p><p>');

        $('.submitsimpanparent').html("");
        $('.submitsimpanparent').html("<i class=\"fa fa-circle-notch fa-spin buttonload2\" style=\"display: none\"></i> Publikasi");
        if(id > 0){


            $('.submitsimpanparent').html("<i class=\"fa fa-circle-notch fa-spin buttonload2\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "GET",
                data: 'id='+id,
                url: "<?php echo site_url('guru/soal/ambildatabyid2'); ?>",
                cache: false,
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(data){
                    console.log(data);

                    $('#parent_id').val(id);
                    tinyMCE.get('soal_parent_text').setContent(data.soal_parent_text);

                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }

    }

    function submitSimpan() {
        $('.buttonload').show();
        $('#loading_ajax').show();
        setTimeout(function(){
            $("#_form").submit();
        }, 0);
    }

    function submitSimpanParent() {
        $('.buttonload2').show();
        $('#loading_ajax').show();
        setTimeout(function(){
            $("#_formparent").submit();
        }, 0);
    }

    function submitDuplikat(id) {
        var tanya = confirm('Apakah yakin mau duplikat data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('guru/soal/simpan_duplikat') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){

                    if(hasil.status){

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                        searchFilter2(0,0);

                        formDialog(hasil.id);
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

    function submitDuplikatParent(id) {
        var tanya = confirm('Apakah yakin mau duplikat data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('guru/soal/simpan_duplikatparent') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){

                    if(hasil.status){

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                        searchFilter3(0,id);

                        formDialog3(hasil.id);
                        $("#formDialogParent").modal('show');

                    }else{
                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    }
                }
            });
        }
    }

    function submitSelectParent(x) {
        $('#parent').val(x);
        $('#Notifikasi').html('<p class="alert alert-success">Parent berhasil dipilih!</p>');
        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

        $('#postListParentText').html('');
        $.ajax({
            type: "GET",
            data: 'id='+x,
            url: "<?php echo site_url('guru/soal/ambildatabyid2'); ?>",
            cache: false,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function(data){
                console.log(data);

                $('#postListParentText').html(data.soal_parent_text);

                searchFilter3(0,0);

            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });

    }

    function submitSelanjutnya() {
        var id = $('#id').val();
        $.ajax({
            type:'GET',
            data: 'id='+id,
            url:'<?php echo base_url('guru/soal/ambildatabyid') ;?>',
            cache: false,
            dataType:'json',
            success: function(data){

                formDialog(0);

                $(".submitpengaturan .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
                $("#pengaturan").hide();
                $(".submitselanjutnya").hide();

                var jenis = data.soal_jenis;
                $('#optional').css("display","none");
                $('#essay').css("display","none");
                $('#checked').css("display","none");

                if(jenis == "optional"){
                    $('#optional').css("display","block");
                }else if(jenis == "essay"){
                    $('#essay').css("display","block");
                }else if(jenis == "checked"){
                    $('#checked').css("display","block");
                }

                $('#jenis').val(jenis);
                $('#parent').val(data.soal_parent_id);
                $('[name="soal_jenis"]').val(jenis);

                $('[name="soal_pelajaran"]').val(data.soal_pelajaran);
                $('[name="soal_pelajaran"]').selectpicker('refresh');

                $('[name="soal_guru"]').val(data.soal_guru);
                $('[name="soal_guru"]').selectpicker('refresh');

                $('[name="soal_untuk"]').val(data.soal_untuk);
                $('[name="soal_untuk"]').selectpicker('refresh');



            }
        });

    }

    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('guru/soal/hapus') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    searchFilter2(0,0);
                }
            });
        }
    }

    function submitHapusParent(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('guru/soal/hapusduplikat') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    searchFilter3(0,0);
                }
            });
        }
    }
</script>