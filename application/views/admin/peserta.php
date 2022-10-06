<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-users fa-fw'></i> PESERTA<i class='fa fa-angle-right fa-fw'></i> DATA PESERTA</h4>
        <hr/>
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
            <a href="#formImport" data-toggle="modal" class="btn btn-sm" title="Import"><span class="fas fa-file-import"></span> Import</a>
            <a href="#formCard" data-toggle="modal" class="btn btn-sm" title="Kartu"><span class="fas fa-id-card"></span> Kartu</a>
            <a title="Tambah Peserta Baru" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog(0)" class="btn btn-sm btn-success  btn-sm btn-circle"><i class="fas fa-plus"></i></a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-8">
        <div>
            <div style="min-height:800px;">


                <div id="postList0" class="list-group" style="font-size: 18px"></div>
                <div id='pagination'></div>


            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">

        <div class="row">
            <div class="col-md-12">
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3><?php echo $total_peserta;?></h3>
                        <p>Total Peserta</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_peserta_laki2x;?></h3>
                        <p>Total Peserta Laki-laki</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_peserta_perempuan;?></h3>
                        <p>Total Peserta Perempuan</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_jurusan;?></h3>
                        <p>Total Jurusan</p>
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
                        <a href="<?php echo base_url(). "admin/peserta/index"; ?>" class="btn btn-primary">Atur Ulang Setingan</a>
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

                            <div class="col-md-3">
                                <label>Kelas</label>
                                <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                    <select name="kelasBy" id="kelasBy" class="form-control selectpicker" data-live-search="true" onchange="searchFilter()">
                                        <option value="">Semua Kelas</option>
                                        <?php foreach ($kelas as $p):?>
                                            <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-9">
                                <label>Jurusan</label>
                                <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>

                                    <select class="form-control selectpicker" type="text" name="jurusanBy" id="jurusanBy"  data-live-search="true" onchange="searchFilter()">
                                        <option value="">Pilih Jurusan</option>

                                        <?php
                                        $x = json_decode($jurusan);


                                        foreach ($x as $k){
                                            echo '<option value="'.$k.'">'.$k.'</option>';

                                        }

                                        ?>
                                    </select>

                                </div>
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

                    <h4 class="modal-title"><span class="model-title-text">PESERTA</span>
                        <div class="pull-right text-right">

                            <a href="#" onclick="submitSimpan()" class="btn btn-primary submitsimpan">Simpan</a>
                            <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>

                        </div>
                    </h4>

                </div>
                <div class="modal-body">



                    <div class="container">

                        <div class="modal-status"></div>

                        <div class="row">


                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Nama Peserta <span style="color: red">*</span> :</label>
                                    <input  class="form-control" placeholder="Masukkan Nama Peserta" id="peserta_nama" name="peserta_nama" value="" />
                                </div>
                                <div class="form-group">
                                    <label>NIS Peserta <span style="color: red">*</span> :</label>
                                    <input  class="form-control" placeholder="Masukkan NIS Peserta" id="peserta_nis" name="peserta_nis" value="" />
                                </div>


                                <div class="form-group">
                                    <label>Jenis kelamin <span style="color: red">*</span> :</label>
                                    <select class="form-control selectpicker" type="text" name="peserta_jk" id="peserta_jk">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Agama <span style="color: red">*</span> :</label>
                                    <select class="form-control selectpicker" type="text" name="peserta_agama" id="peserta_agama">
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katholik">Katholik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Kepercayaan">Kepercayaan</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label>Nomor Peserta <span style="color: red">*</span> :</label>
                                    <input disabled title="Nomor ini digenerate secara otomatis saat membuat kartu ujian"  class="form-control" placeholder="Masukkan Nomor Peserta" id="peserta_nomor" name="peserta_nomor" value="" />
                                </div>
                                <div class="form-group">
                                    <label>Ruangan Peserta <span style="color: red">*</span> :</label>
                                    <input class="form-control" placeholder="Masukkan Ruangan Peserta" id="peserta_ruangan" name="peserta_ruangan" value="" />
                                </div>

                                <div class="form-group">
                                    <label>Kelas <span style="color: red">*</span> :</label>
                                    <input class="form-control" type="number" name="peserta_kelas" id="peserta_kelas" placeholder="Masukan Kelas" value="" />
                                </div>

                                <div class="form-group">
                                    <label>Jurusan <span style="color: red">*</span> :</label>
                                    <select class="form-control selectpicker" type="text" name="peserta_jurusan" id="peserta_jurusan"  data-live-search="true">
                                        <option value="">Pilih Jurusan</option>

                                        <?php
                                        $x = json_decode($this->m->getpengaturan('Jurusan'));


                                        foreach ($x as $k){
                                            echo '<option value="'.$k.'">'.$k.'</option>';

                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Jurusan ke <span style="color: red">*</span> :</label>
                                    <input class="form-control" type="number" name="peserta_jurusan_ke" id="peserta_jurusan_ke" placeholder="Masukan Jurusan ke" value="" />
                                </div>

                            </div>

                            <div class="col-md-3 col-sm-6">

                                <div class="form-group">
                                    <label>Username <span style="color: red">*</span> :</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="peserta_username" id="peserta_username" placeholder="Masukan Username" value="" />
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Password <span style="color: red">*</span> :</label>
                                    <div class="input-group">
                                        <input type="password" name="peserta_password" id="peserta_password"   class="form-control pwd" value="">
                                        <span class="input-group-btn">
            <button class="btn btn-default passwordshow" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
          </span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                </div>

            </form>

        </div>

    </div>
</div>

<div class="modal fade modal-fullscreen" id="formImport" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method='post' action='' enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Upload File Siswa
                        <div class="pull-right">
                            <a href="<?php echo base_url();?>uploads/templates/siswa.xlsx" class="btn btn-default"><span class="fas fa-save"></span> Download Template</a>
                            <input type='button' class='btn btn-danger' value='Upload' id='btn_upload' onclick="submitImport()">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        </div>
                    </h4>
                </div>
                <div class="modal-body">

                    <div class="col-md-4 col-md-offset-4">
                        <label>File (.xlsx)</label><br/>
                        <input type="file" class="form-control" name="file" id="file">
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formCard" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Kartu Akun
                    <div class="pull-right">
                        <a href="#" onclick="submitAkunCard()" class="btn btn-primary">Set Akun Card</a>
                        <a href="#" onclick="submitAkunCardMenyusul()" class="btn btn-warning">Set Akun Menyusul</a>
                        <a href="#" onclick="submitAkunCardMenyusulNomor()" class="btn btn-warning">Set Nomor Menyusul</a>
                        <a href="#" onclick="submitCard()" class="btn btn-default"><i class="fas fa-print"></i> Cetak</a>
                        <a href="#" onclick="submitCardUKK()" class="btn btn-default"><i class="fas fa-print"></i> Cetak UKK</a>
                        <a href="#" onclick="submitCardUKK2()" class="btn btn-default"><i class="fas fa-print"></i> Cetak UKK2</a>
                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </h4>
            </div>
            <div class="modal-body">

                <div class="col-md-6 col-md-offset-3">

                    <div class="row">

                        <div class="col-md-12">
                            <label>Jenis</label>
                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                <select name="card_jenis" class="form-control selectpicker" data-live-search="true">
                                    <option value="kartu">Kartu</option>
                                    <option value="daftar">Daftar Hadir</option>
                                </select>
                            </div>

                            <label>Untuk</label>
                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                <select name="card_untuk" class="form-control selectpicker" data-live-search="true">
                                    <option value="ujian">Ujian</option>
                                    <option value="demo">Demo</option>
                                    <option value="nomor">Nomor</option>
                                </select>
                            </div>

                            <label>Kustom Judul Kartu</label><br/>
                            <input type="text" name="card_text" class="form-control" />

                            <label>Kelas</label>
                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                <select name="card_kelas" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Semua Kelas</option>
                                    <?php foreach ($kelas as $p):?>
                                        <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <label>Jurusan</label>
                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>

                                <select class="form-control selectpicker" type="text" name="card_jurusan" id="card_jurusan"  data-live-search="true">
                                    <option value="">Pilih Jurusan</option>

                                    <?php
                                    $x = json_decode($jurusan);


                                    foreach ($x as $k){
                                        echo '<option value="'.$k.'">'.$k.'</option>';

                                    }

                                    ?>
                                </select>

                            </div>



                            <div id="jurusan_ke" style="display: none">

                                <label>Untuk</label>
                                <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                    <select name="card_jurusan_ke" class="form-control selectpicker" data-live-search="true">
                                        <option value="">Semua</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    /**
    $(function () {
        var $daftar_jurusan = <?php echo $jurusan;?>;


        var $input_tagator1 = $('#card_jurusan');
        $input_tagator1.tagator({
            showAllOptionsOnFocus: true,
            allowAutocompleteOnly: true,
            autocomplete: $daftar_jurusan,
            useDimmer: true
        });

    });*/
</script>
<script type="text/javascript" language="javascript" >

    $('#_form').submit(function(e){
        var form = new FormData(this);

        e.preventDefault();
        $.ajax({
            type:'POST',
            data: form,
            url:'<?php echo base_url('index.php/admin/peserta/simpan') ;?>',
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

    $(".passwordshow").on('click',function() {
        var $pwd = $(".pwd");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });

    $('[name="card_jenis"]').on('change',function() {
        $('#jurusan_ke').hide();
        if(this.value == "daftar"){
            $('#jurusan_ke').show();
        }
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
        var kelasBy = $('#kelasBy').val();
        var jurusanBy = $('#jurusanBy').val();



        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/peserta/ajaxPaginationData/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&kelasBy='+kelasBy+'&jurusanBy='+jurusanBy,
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



    function paginationData(data) {

        $('#postList0').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar peserta</h4>'+
                '<p>Daftar peserta akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postList0').append(empRow);
        }else{

            for(emp in data){

                var jk = data[emp].peserta_jk;
                var jk_text = "";
                if(jk == "L" || jk == "l"){
                    jk_text = "Laki-laki";
                }else{
                    jk_text = "Perempuan";
                }

                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].peserta_kelas+'</span>'+
                    ' <span class="label label-default">'+data[emp].peserta_jurusan+'</span>'+
                    ' <span class="label label-default">'+data[emp].peserta_jurusan_ke+'</span><br/>'+
                    '</p><br/>'+
                    '<div class="col-md-2" style="text-align:center;"><div class="row">'+
                    '<img src="'+data[emp].peserta_foto+'" style="width: 60px; border:1px solid #ddd;"/>'+
                    '</div></div>'+
                    '<div class="col-md-6"><div class="row">'+
                    '<p><i style="color:#999">Nomor: '+data[emp].peserta_nomor+'</i>, <i style="color:#999">Ruang: '+data[emp].peserta_ruangan+'</i></p>'+
                    '<h4 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#formtampil" data-toggle="modal" onclick="tampilData('+data[emp].peserta_id+')">'+data[emp].peserta_nama+'</a></h4>'+
                    '<p><i style="color:#999">'+data[emp].peserta_nis+'</i>, <i style="color:#999">'+jk_text+'</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+data[emp].peserta_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapus('+data[emp].peserta_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postList0').append(empRow);
            }

        }

    }



    function formDialog(id) {
        $('#id').val(0);
        $('#peserta_nomor').val("");

        $('#peserta_ruangan').val("");
        $('#peserta_nis').val("");
        $('#peserta_nama').val("");
        $('#peserta_kelas').val("");
        $('#peserta_jurusan').val("");
        $('#peserta_jurusan_ke').val("");
        $('#peserta_agama').val("");
        $('#peserta_jk').val("");
        $('#peserta_username').val("");
        $('#peserta_password').val("");

        $('.submitsimpan').html("");
        $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");
        if(id > 0){
            $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "POST",
                data: 'id='+id,
                url: "<?php echo site_url('admin/peserta/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                success: function(data){
                    console.log(data);
                    $('#id').val(id);

                    $('#peserta_nama').val(data.peserta_nama);
                    $('#peserta_jk').val(data.peserta_jk);
                    $('#peserta_agama').val(data.peserta_agama);

                    $('#peserta_nomor').val(data.peserta_nomor);
                    $('#peserta_ruangan').val(data.peserta_ruangan);
                    $('#peserta_nis').val(data.peserta_nis);
                    $('#peserta_kelas').val(data.peserta_kelas);
                    $('#peserta_jurusan').val(data.peserta_jurusan);
                    $('#peserta_jurusan_ke').val(data.peserta_jurusan_ke);

                    $('#peserta_username').val(data.peserta_username);
                    $('#peserta_password').val(data.peserta_password);
                    //$('#peserta_foto').val(data.peserta_foto);

                    $('#peserta_agama').selectpicker('refresh');
                    $('#peserta_jurusan').selectpicker('refresh');
                    $('#peserta_jk').selectpicker('refresh');
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
                url:'<?php echo base_url('admin/peserta/hapus') ;?>',
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




    function submitImport(){


        var fd = new FormData();

        var files = $('#file')[0].files[0];
        fd.append('file',files);

        // AJAX request
        $.ajax({
            url: "<?php echo base_url()?>import/siswa",
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function(response){
                $('#loading_ajax').fadeOut("slow");
                console.log(response);

                if(response.pesan == ''){
                    // Show image preview

                    //$('#form3').modal('hide');
                    searchFilter(0);


                    $('#loading_ajax').fadeOut("slow");
                    $('#Notifikasi').html('<p class="alert alert-success">Berhasil diimport!</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                }else{
                    $('#loading_ajax').fadeOut("slow");
                    $('#Notifikasi').html('<p class="alert alert-danger">Gagal diimport!</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                }
            }
        });

    }






    function submitCard(){

        var jenis =$("[name='card_jenis']").val();
        var untuk =$("[name='card_untuk']").val();
        var kustom = $("[name='card_text']").val();
        var kelas = $("[name='card_kelas']").val();
        var jurusan = $("[name='card_jurusan']").val();
        var jurusan_ke = $("[name='card_jurusan_ke']").val();

        if(jenis == "daftar"){

            window.open("<?php echo base_url();?>admin/peserta/akunpeserta_cetakdaftar?kelas="+kelas+"&jurusan="+jurusan+"&jurusan_ke="+jurusan_ke+"&untuk="+untuk+"&kustom="+kustom,'_blank');

        }else{
            window.open("<?php echo base_url();?>admin/peserta/akunpeserta_cetak?kelas="+kelas+"&jurusan="+jurusan+"&jurusan_ke="+jurusan_ke+"&untuk="+untuk+"&kustom="+kustom,'_blank');


        }
    }

    function submitCardUKK(){

        var jenis =$("[name='card_jenis']").val();
        var untuk =$("[name='card_untuk']").val();
        var kustom = $("[name='card_text']").val();
        var kelas = $("[name='card_kelas']").val();
        var jurusan = $("[name='card_jurusan']").val();
        var jurusan_ke = $("[name='card_jurusan_ke']").val();

        if(jenis == "daftar"){

            window.open("<?php echo base_url();?>admin/peserta/akunpeserta_cetakdaftar?kelas="+kelas+"&jurusan="+jurusan+"&jurusan_ke="+jurusan_ke+"&untuk="+untuk+"&kustom="+kustom,'_blank');

        }else{
            window.open("<?php echo base_url();?>admin/peserta/akunpeserta_cetak_blank?kelas="+kelas+"&jurusan="+jurusan+"&jurusan_ke="+jurusan_ke+"&untuk="+untuk+"&kustom="+kustom,'_blank');


        }
    }

    function submitCardUKK2(){

        var jenis =$("[name='card_jenis']").val();
        var untuk =$("[name='card_untuk']").val();
        var kustom = $("[name='card_text']").val();
        var kelas = $("[name='card_kelas']").val();
        var jurusan = $("[name='card_jurusan']").val();
        var jurusan_ke = $("[name='card_jurusan_ke']").val();

        if(jenis == "daftar"){

            window.open("<?php echo base_url();?>admin/peserta/akunpeserta_cetakdaftar?kelas="+kelas+"&jurusan="+jurusan+"&jurusan_ke="+jurusan_ke+"&untuk="+untuk+"&kustom="+kustom,'_blank');

        }else{
            window.open("<?php echo base_url();?>admin/peserta/akunpeserta_cetak_blank2?kelas="+kelas+"&jurusan="+jurusan+"&jurusan_ke="+jurusan_ke+"&untuk="+untuk+"&kustom="+kustom,'_blank');


        }
    }

    function submitAkunCard(){
        var tanya = confirm('Apakah yakin mau generate akun username dan password peserta?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'y=1',
                url:'<?php echo base_url('admin/peserta/akunpeserta') ;?>',
                cache: false,
                dataType:'json',
                success: function(data){
                    if(data.success){

                        searchFilter(0);

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">Berhasil dibuat!</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    }else{

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-danger">Gagal dibuat!</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    }
                }
            });
        }
    }

    function submitAkunCardMenyusul(){
        var tanya = confirm('Apakah yakin mau generate akun username dan password peserta?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'y=1',
                url:'<?php echo base_url('admin/peserta/akunpeserta_belum') ;?>',
                cache: false,
                dataType:'json',
                success: function(data){
                    if(data.success){

                        searchFilter(0);

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">Berhasil dibuat!</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    }else{

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-danger">Gagal dibuat!</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    }
                }
            });
        }
    }

    function submitAkunCardMenyusulNomor(){
        var tanya = confirm('Apakah yakin mau generate akun username dan password peserta?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'y=1',
                url:'<?php echo base_url('admin/peserta/akunpeserta_belum_nomor') ;?>',
                cache: false,
                dataType:'json',
                success: function(data){
                    if(data.success){

                        searchFilter(0);

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-success">Berhasil dibuat!</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    }else{

                        $('#loading_ajax').fadeOut("slow");
                        $('#Notifikasi').html('<p class="alert alert-danger">Gagal dibuat!</p>');
                        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    }
                }
            });
        }
    }
</script>