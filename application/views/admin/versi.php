<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-file-upload fa-fw'></i> VERSI<i class='fa fa-angle-right fa-fw'></i> DATA VERSI</h4>
        <hr/>
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
            <a href="javascript:void()" onclick="searchFilter(0)" class="btn btn-sm" title="Segarkan"><span class="fas fa-bolt"></span> Segarkan</a>
            <a title="Tambah Guru Baru" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog(0)" class="btn btn-sm btn-success  btn-sm btn-circle"><i class="fas fa-plus"></i></a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-8">
        <div>
            <div style="min-height:800px;">
                <ul class="nav nav-tabs" style="margin-bottom: 8px">
                    <li class="active"><a data-toggle="tab" href="#apk">Android App</a></li>
                    <li><a data-toggle="tab" href="#exe">Windows App</a></li>
                </ul>
                <div class="tab-content">
                    <div id="apk" class="tab-pane fade in active">


                        <div id="postList0" class="list-group" style="font-size: 18px"></div>
                        <div id='pagination0'></div>

                    </div>
                    <div id="exe" class="tab-pane fade in">


                        <div id="postList1" class="list-group" style="font-size: 18px"></div>
                        <div id='pagination1'></div>

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
                        <h3><?php echo $total_version;?></h3>
                        <p>Total Versi</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_version_apk;?></h3>
                        <p>Total Android</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_version_exe;?></h3>
                        <p>Total Windows</p>
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
                        <a href="<?php echo base_url(). "admin/versi/index"; ?>" class="btn btn-primary">Atur Ulang Setingan</a>
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

<div class="modal fade modal-fullscreen" id="formDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">
            <form role="form" name="_form"  id="_form" novalidate>
                <input type="hidden" id="id" name="id" value="0"/>

                <div class="modal-header">

                    <h4 class="modal-title"><span class="model-title-text">VERSI</span>
                        <div class="pull-right text-right">

                            <a href="#" onclick="submitSimpan()" class="btn btn-primary submitsimpan">Simpan</a>
                            <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>

                        </div>
                    </h4>

                </div>
                <div class="modal-body">



                    <div class="container container-medium">

                        <div class="modal-status"></div>

                        <div class="row">


                            <div class="col-md-6 col-sm-6">


                                <div class="form-group">
                                    <label>Jenis App <span style="color: red">*</span> :</label>
                                    <select class="form-control selectpicker" type="text" name="version_jenis" id="version_jenis">
                                        <option value="">Pilih Jenis App</option>
                                        <option value="android">Android</option>
                                        <option value="windows">Windows</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Wajib Install <span style="color: red">*</span> :</label>
                                    <select class="form-control selectpicker" type="text" name="version_wajib" id="version_wajib">
                                        <option value="">Pilih Instalasi</option>
                                        <option value="1">Wajib</option>
                                        <option value="0">Tidak Wajib</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Nama Versi <span style="color: red">*</span> :</label>
                                    <input  class="form-control" placeholder="Masukkan Nama Versi ex. 0.1" id="version_nama" name="version_nama" value="" />
                                </div>


                                <div class="form-group">
                                    <label>Nomor <span style="color: red">*</span> :</label>
                                    <input type="number" class="form-control" placeholder="Masukkan Nomor" id="version_nomor" name="version_nomor" value="" />
                                </div>


                                <div class="form-group">
                                    <label>Nomor Minimal<span style="color: red">*</span> :</label>
                                    <input type="number" class="form-control" placeholder="Masukkan Nomor Minimal" id="version_nomor_minimal" name="version_nomor_minimal" value="" />
                                </div>

                                <div class="form-group">
                                    <label>Ukuran File<span style="color: red">*</span> :</label>
                                    <input class="form-control" placeholder="Masukkan Ukuran File" id="version_ukuran" name="version_ukuran" value="" />
                                </div>

                            </div>


                            <div class="col-md-6 col-sm-6">

                                <div class="form-group">
                                    <label>Text Keterangan<span style="color: red">*</span> :</label>
                                    <textarea class="form-control tinyEditor" style="height:100px;" name="version_text" id="version_text" autofocus></textarea>
                                </div>


                            </div>

                        </div>

                    </div>


                </div>

            </form>

        </div>

    </div>
</div>


<script type="text/javascript" language="javascript" >

    $('#_form').submit(function(e){
        var form = new FormData(this);

        form.append('version_text', tinyMCE.get("version_text").getContent());

        e.preventDefault();
        $.ajax({
            type:'POST',
            data: form,
            url:'<?php echo base_url('index.php/admin/versi/simpan') ;?>',
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
            url: '<?php echo base_url(); ?>admin/versi/ajaxPaginationData/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);
                $('#pagination0').html(responseData.pagination);
                paginationData(responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }



    function paginationData(data) {

        $('#postList0').empty();
        $('#postList1').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar versi</h4>'+
                '<p>Daftar versi akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postList0').append(empRow);;
            $('#postList1').append(empRow);
        }else{

            for(emp in data){

                var jk = data[emp].version_jk;
                var jk_text = "";
                if(jk == "L" || jk == "l"){
                    jk_text = "Laki-laki";
                }else{
                    jk_text = "Perempuan";
                }

                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].version_tanggal+'</span>'+
                    ' <span class="label label-default">'+data[emp].version_jenis+'</span>'+
                    ' <span class="label label-default">minimal '+data[emp].version_nomor_minimal+'</span>'+
                    ' <span class="label label-default">'+data[emp].version_ukuran+'</span>'+
                    ' <span class="label label-default">'+data[emp].version_wajib+'</span>'+
                    ' <span class="label label-default">'+data[emp].version_hits+'</span>'+
                    '</p><br/>'+
                    '<div class="col-md-8"><div class="row">'+
                    '<h4 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#formtampil" data-toggle="modal" onclick="tampilData('+data[emp].version_id+')">'+data[emp].version_nama+' ('+data[emp].version_nomor+')</a></h4>'+
                    '<p><i style="color:#999">'+data[emp].version_text+'</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+data[emp].version_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Duplikat Data" title="Duplikat" onClick="submitDuplikat('+data[emp].version_id+')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-clone"></span></a>'+
                    '<a title="Hapus" onclick="submitHapus('+data[emp].version_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;

                if(data[emp].version_jenis == 'android'){
                    $('#postList0').append(empRow);
                }
                if(data[emp].version_jenis == 'windows'){
                    $('#postList1').append(empRow);
                }
            }

        }

    }



    function formDialog(id) {
        $('#id').val(0);
        $('#version_nama').val("");
        $('#version_agama').val("");
        $('#version_jk').val("");
        $('#version_username').val("");
        $('#version_password').val("");

        $('.submitsimpan').html("");
        $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");
        if(id > 0){
            $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "POST",
                data: 'id='+id,
                url: "<?php echo site_url('admin/versi/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                success: function(data){
                    $('#id').val(id);

                    $('#version_jenis').val(data.version_jenis);
                    $('#version_wajib').val(data.version_wajib);
                    $('#version_nama').val(data.version_nama);
                    $('#version_nomor').val(data.version_nomor);
                    $('#version_nomor_minimal').val(data.version_nomor_minimal);
                    $('#version_ukuran').val(data.version_ukuran);
                    tinyMCE.get('version_text').setContent(data.version_text);

                    $('#version_jenis').selectpicker('refresh');
                    $('#version_wajib').selectpicker('refresh');
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


    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+id,
                url:'<?php echo base_url('admin/versi/hapus') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    if(hasil.success){

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">Berhasil dihapus!</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    }else{
                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-danger">Gagal dihapus!</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    }
                    searchFilter(0);
                }
            });
        }
    }



    function submitDuplikat(id) {
        var tanya = confirm('Apakah yakin mau duplikat data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('admin/versi/simpan_duplikat') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){

                    if(hasil.status){

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                        searchFilter(0);

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

</script>