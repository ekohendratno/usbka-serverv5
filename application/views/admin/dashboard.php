<div class="position-absolute">
    <div class="container container-medium">
        <div class="row">

            <div class="col-sm-4 col-xs-12">
                <div class="small-box bg-light">
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="inner">
                        <h3><?php echo $jumlah_pelajaran;?>/<?php echo $jumlah_soal;?></h3>
                        <p>Pelajaran/Soal</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="small-box bg-light">
                    <div class="icon">
                        <i class="fas fa-pen"></i>
                    </div>
                    <div class="inner">
                        <h3><?php echo $jumlah_ujian;?></h3>
                        <p>Diujikan</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="small-box bg-light">
                    <div class="icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="inner">
                        <h3><?php echo $jumlah_jurusan;?>/<?php echo $jumlah_peserta;?>/<?php echo $jumlah_pengajar;?></h3>
                        <p>Jurusan/Peserta/Guru</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="small-box bg-light">
                    <div class="icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="inner">
                        <h3><?php echo $jumlah_koordinator;?></h3>
                        <p>Guru Koordinator Soal</p>
                    </div>
                </div>
            </div>


            <div class="col-sm-8 col-xs-12">
                <div class="small-box bg-light">
                    <div class="icon">
                        <i class="fas fa-sun"></i>
                    </div>
                    <div class="inner">
                        <h3><a href="#formTahunAjaran" data-toggle="modal" style="color: #3e86a0"><?php echo $tahunajaran;?>-<?php echo $kegiatan;?></a></h3>
                        <p>Tahun Ajaran</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container container-medium" style="margin-top: 20px">
    <div class="col-md-12">
        <div class="row">

            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="homes" style="padding-bottom: 40px; padding-top: 40px">

                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="<?php echo base_url()?>admin/peserta">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <p class="text-center">Peserta</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="<?php echo base_url()?>admin/guru">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <p class="text-center">Guru</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="<?php echo base_url()?>admin/soal">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-file-word"></i>
                                    </div>
                                    <p class="text-center">Bank Soal</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="<?php echo base_url()?>admin/ujian">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-pen"></i>
                                    </div>
                                    <p class="text-center">Ujian</p>
                                </div>
                            </a>
                        </div>

                        <div class="clearfix"></div><br/><br/>



                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="#formTimeline" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <p class="text-center">Pesan</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="#formPengaturan" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <p class="text-center">Pengaturan</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="<?php echo base_url()?>admin/versi">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-file-upload"></i>
                                    </div>
                                    <p class="text-center">Versi Apk</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="<?php echo base_url()?>admin/overview2">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-server"></i>
                                    </div>
                                    <p class="text-center">Server</p>
                                </div>
                            </a>
                        </div>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>

        </div>
    </div>


</div>



<div class="modal fade modal-fullscreen" id="formTahunAjaran" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tahun Ajaran
                    <div class="pull-right">
                        <button onclick="submitTahunAjaran()" type="button" id="btn-ubah" class="btn btn-success">Simpan Pengaturan</button>
                        <a id="closetahunajaran" style="display: none;" href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">

                <div class="container container-medium">
                    <p>Silahkan lakukkan pemilihan tahun ajaran, sebelum membuat dan memanagement soal soal
                        dan pastikan tahun ajaran yang Anda masukkan telah sesuai, agar soal yang tersedia tepat!.</p>
                    <p>Jangan lupa setelah memilih tahun ajaran klik <strong>Simpan</strong> di pojok kanan atas!</p>

                    <div class="row">

                        <div class="col-md-6">

                            <label>Tahun Ajaran</label><br/>

                            <select class="form-control selectpicker"  id="tahunajaran" data-live-search="true">
                                <option value="">Pilih tahun ajaran</option>
                                <?php
                                $query = $this->db->group_by("ta_tahun")->order_by("ta_tahun","DESC")->get_where("ta",array())->result();
                                foreach ($query as $ta){

                                    $ta_select = "";

                                    if(!empty($tahunajaran)) {
                                        if ($tahunajaran == $ta->ta_tahun . "-" . $ta->ta_semester) {
                                            $ta_select = ' selected="selected"';
                                        }
                                    }else{

                                        if ($ta->ta_aktif == 1) {
                                            $ta_select = ' selected="selected"';
                                        }

                                    }

                                    ?>
                                    <option value="<?php echo $ta->ta_tahun;?>-<?php echo $ta->ta_semester;?>"<?php echo $ta_select;?>><?php echo $ta->ta_tahun;?>-<?php echo $ta->ta_semester;?></option>
                                    <?php
                                }
                                ?>
                            </select>



                        </div>

                        <div class="col-md-6">


                            <label>Kegiatan</label><br/>
                            <select id="kegiatan" class="form-control selectpicker" data-live-search="true">
                                <option value="UTS"<?php if($kegiatan == "UTS") echo " selected";?>>UTS</option>
                                <option value="UAS"<?php if($kegiatan == "UAS") echo " selected";?>>UAS</option>
                                <option value="USBN"<?php if($kegiatan == "USBN") echo " selected";?>>USBN</option>
                            </select>

                        </div>


                    </div>


                </div>

            </div>

        </div>
    </div>
</div>



<div class="modal fade modal-fullscreen" id="formTimeline" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">
            <div class="modal-header">

                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-4">
                        <h4 class="modal-title"><span class="model-title-text2">PESAN</span></h4>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-8">
                        <div class="pull-right">

                            <a href="#" id="pesan-refresh" class="btn btn-default">Refresh</a>
                            <a href="#" onclick="submitPesan()" class="btn btn-primary submitpesan" style="display: none">Publikasi</a>
                            <a href="#" title="Pengaturan" class="btn btn-default btn-sm btn-circle submitpengaturanpesan">
                                <i class="fas fa-arrow-down"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="clearfix"></div>

                    <div class="container container-medium">

                        <div id="pengaturanpesan" style="padding-top: 30px">
                            <div class="col-md-12">

                                <label>Untuk</label><br/>
                                <select class="form-control"  id="untuk" name="untuk" onChange="untukX()">
                                    <option value="semua">Semua</option>
                                    <option value="guru">Guru</option>
                                    <option value="siswa">Siswa</option>
                                </select>

                            </div>


                            <div class="col-md-12">
                                <label>Pesan Pengumuman</label><br/>
                                <textarea class="form-control" style="min-height:300px;" name="pesan_text" id="pesan_text" autofocus></textarea>
                            </div>
                        </div>

                    </div>

                </div>


            </div>
            <div class="modal-body">

                <div class="container container-small">
                    <ul class="timeline">
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade modal-fullscreen" id="formPengaturan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">
            <div class="modal-header">

                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-4">
                        <h4 class="modal-title"><span class="model-title-text2">PENGATURAN</span></h4>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-8">
                        <div class="pull-right">

                            <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-body">

                <div class="container">


                    <ul class="nav nav-tabs" style="margin-bottom: 8px">
                        <li class="active"><a data-toggle="tab" href="#pengaturan_a">Tahun Ajaran</a></li>
                        <li><a data-toggle="tab" href="#pengaturan_b">Jurusan</a></li>
                        <li><a data-toggle="tab" href="#pengaturan_c">Kunci Ujian</a></li>
                        <li><a data-toggle="tab" href="#pengaturan_d">Instansi</a></li>
                        <li><a data-toggle="tab" href="#pengaturan_e">Pengerjaan Ujian</a></li>
                        <li><a data-toggle="tab" href="#pengaturan_f">Welcome Message</a></li>
                        <li><a data-toggle="tab" href="#pengaturan_g" style="display: none">Auto Correct</a></li>
                        <li><a data-toggle="tab" href="#pengaturan_h">Token</a></li>
                        <li><a data-toggle="tab" href="#pengaturan_i" style="display: none">Arsip</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="pengaturan_a" class="tab-pane fade in active">


                            <div class="text-right"><br/>
                                <a onclick="submitTAKunciReset()" class="btn btn-primary btn-danger">Reset Kunci TA</a>
                            </div>


                            <div class="row">
                                <div class="col-md-6">

                                    <label>Tahun</label><br/>
                                    <input type="text" class="form-control" id="ta_tahun" name="ta_tahun" value="<?php echo date('Y');?>/<?php echo date('Y')+1;?>">

                                </div>
                                <div class="col-md-6">

                                    <label>Semester</label><br/>
                                    <select class="form-control" id="ta_semester" name="ta_semester">
                                        <option value="ganjil">Ganjil</option>
                                        <option value="genap">Genap</option>
                                    </select>

                                </div>

                                <div class="col-md-12">
                                    <br/>
                                    <button onclick="submitTATambahdata()" id="btn-tambah" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </div>


                            <br/>
                            <p>Ini adalah aturan untuk default pilihan pada T.A. yang muncul pada dialog sesi</p>

                            <table id='postListPengaturanTA' class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center" width="40%">TAHUN</th>
                                    <th class="text-center" width="40%">SEMESTER</th>
                                    <th class="text-center" width="20%"><span class="glyphicon glyphicon-cog"></span></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                        <div id="pengaturan_b" class="tab-pane fade in">


                            <div class="row">
                                <div class="col-md-12">

                                    <label>Nama Jurusan</label><br/>
                                    <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="">

                                    <br/>
                                    <button onclick="tambahdatajurusan()" id="btn-tambahjurusan" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </div>


                            <div class="clearfix"></div>
                            <br/>
                            <table id='postListPengaturanJurusan' class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Nama Jurusan</th>
                                    <th class="text-center" width="150"><span class="glyphicon glyphicon-cog"></span></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                        <div id="pengaturan_c" class="tab-pane fade in">

                            <div class="col-md-6">


                                <label>Tampilkan hasil ujian</label>
                                <div class="input-group">
                                    <select class="form-control" name="lock_ujian" id="lock_ujian">
                                        <option value="">--Pilih---</option>
                                        <option value="y"<?php if($lock_ujian == 'y') echo ' selected';?>>Tidak ditampilkan</option>
                                        <option value="t"<?php if($lock_ujian == 't') echo ' selected';?>>Tampilkan</option>
                                    </select>
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="submitLockUjian()">Simpan</button>
                                </span>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <label>Kunci ujian siswa web client</label>
                                <div class="input-group">
                                    <select class="form-control" name="lock_client" id="lock_client">
                                        <option value="">--Pilih---</option>
                                        <option value="t"<?php if($lock_client == 't') echo ' selected';?>>Buka kunci</option>
                                        <option value="y"<?php if($lock_client == 'y') echo ' selected';?>>Kunci</option>
                                    </select>
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="submitLockClient()">Simpan</button>
                                </span>
                                </div>

                            </div>

                        </div>
                        <div id="pengaturan_d" class="tab-pane fade in">

                            <label>Nama Instansi</label>
                            <div class="input-group">
                                <input class="form-control" name="instansi" id="instansi" value="<?php echo $instansi;?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="submitInstansi()">Simpan</button>
                                </span>
                            </div>

                        </div>
                        <div id="pengaturan_e" class="tab-pane fade in">

                            <label>Waktu Minimum Mengerjakan Ujian</label>
                            <div class="input-group">
                                <input class="form-control" type="number" name="waktuminimum" id="waktuminimum" value="<?php echo $waktuminimum;?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="submitWaktuMinimum()">Simpan</button>
                                </span>
                            </div>

                        </div>
                        <div id="pengaturan_f" class="tab-pane fade in">

                            <label>Welcome Message</label><br/>
                            <textarea class="form-control" style="height:100px; name="wm_text" id="wm_text" autofocus><?php echo $welcome_message;?></textarea><br/>
                            <div class="text-right">
                                <button onclick="submitWelcome()" class="btn btn-primary">Simpan</button>
                                <button onclick="hapusWelcome()" class="btn btn-danger">Reset</button>
                            </div>

                        </div>

                        <div id="pengaturan_g" class="tab-pane fade in">
                            <div class="text-center"><br/>
                                <button onclick="submitAutoCorrect()" class="btn btn-lg btn-danger">AutoCorrect Now</button>
                            </div>

                        </div>
                        <div id="pengaturan_h" class="tab-pane fade in">

                            <label>Waktu Token Buka - Tutup</label><br/>
                            <textarea class="form-control" style="height:100px;" name="waktutoken" id="waktutoken" autofocus><?php echo $waktutoken;?></textarea><br/>
                            <div class="text-right">
                                <button onclick="submitWaktuToken()" class="btn btn-primary">Simpan</button>
                            </div>

                        </div>

                        <div id="pengaturan_i" class="tab-pane fade in">

                            <div class="text-center"><br/>
                                <button onclick="submitArsipkanSoalUjian()" class="btn btn-lg btn-danger">Arsipkan Soal dan Ujian</button>
                            </div>
                            <div class="text-center"><br/>
                                <button onclick="submitArsipkanPeserta()" class="btn btn-lg btn-danger">Arsipkan Peserta</button>
                            </div>

                        </div>

                    </div>

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
        background-color: #ddd;
    }
    nav.navbar {
        box-shadow: 2px 2px 2px 2px rgb(0 0 0 / 0%);
    }
    .position-absolute{
        margin-top: -20px;
        padding-top: 20px;
        background: #778e9a!important;
        box-shadow: 2px 2px 2px 2px rgb(0 0 0 / 11%);
    }
    .small-box .svg-inline--fa{
        font-size: 28px;
        color: #778e9a;
    }
    .small-box p{
        color: rgba(110, 110, 110, 0.69);
    }


    .homes .img-responsive {
        margin: 0 auto;
    }
    .homes p{
        color: #5B5B5B;
    }
    .homes .icon {
        -webkit-transition: all .3s linear;
        -o-transition: all .3s linear;
        transition: all .3s linear;
        text-align: center;
        z-index: 0;
        font-size: 50px;
        color: rgba(0,0,0,0.15);
    }
    .homes .icon:hover {
        text-decoration: none;
        color: #0092f9;
    }

    .img-home{
        padding: 10px;
    }


</style>

<script src="<?php echo base_url();?>assets/admin/js/tinymce/tinymce.min.js"></script>
<link href="<?php echo base_url();?>assets/css/timeline.css" rel="stylesheet">

<script type="text/javascript">
    tinyMCE.init({
        selector: "#pesan_text,textarea.form-control#wm_text",
        height: 300,
        min_height: 300,
        menubar: false,statusbar:false,
        plugins: 'autoresize searchreplace autolink directionality visualblocks visualchars fullscreen link table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
        toolbar: 'alignleft alignright bullist numlist table forecolor backcolor link removeformat',
    });


    $('#untuk').selectpicker('refresh');



    $("#pengaturanpesan").slideToggle();
    $(".submitpengaturanpesan").click(function(){
        var side = $(".submitpengaturanpesan .fa-arrow-up").attr('class');
        if(side){
            $(".submitpengaturanpesan .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
        }else{
            $(".submitpengaturanpesan .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
        }

        $("#pengaturanpesan").slideToggle();
        $(".submitpesan").slideToggle();

    });


    //$('.position-absolute').detach().appendTo( $('nav.navbar') );
    <?php if(!empty($tahunajaran) ){?>
    $('#tahunajaran').val('<?php echo $tahunajaran;?>');
    $('#tahunajaran').selectpicker('refresh');

    $('#kegiatan').val('<?php echo $kegiatan;?>');
    $('#kegiatan').selectpicker('refresh');

    $('#formTahunAjaran').modal('hide');
    <?php }else{?>
    $('#formTahunAjaran').modal('show');
    <?php }?>

    function closetahunajaran() {
        $('#closetahunajaran').show();
    }

    function submitTahunAjaran(){

        var tahunajaran = $("#tahunajaran").val();
        var kegiatan = $("#kegiatan").val();

        $.ajax({
            type:'POST',
            data: "tahunajaran="+tahunajaran+"&kegiatan="+kegiatan,
            url:'<?php echo base_url('index.php/admin/pengaturan/simpantahunajaran') ;?>',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function(){
                $('#formTahunAjaran').modal('hide');
                $('#loading_ajax').fadeOut("slow");

                setTimeout(function() {
                    window.location.assign("<?php echo base_url('index.php/admin/dashboard') ;?>");
                }, 300);
            }
        });
    }



    $('#loading_ajax').fadeOut("slow");
    $('#pesan-refresh').click(function(){
        searchFilterPesan(0);
    });

    /**
     * Pesan
     */

    searchFilterPesan(0);
    function searchFilterPesan() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/admin/pesan/timeline/',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                paginationDataPesan(responseData);
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function paginationDataPesan(data) {
        $('ul.timeline').empty();
        $('ul.timeline').append('<li class="time-label"><span class="btn btn-sm btn-success">Pengumuman Terakhir</span></li>');
        for(emp in data){
            var empRow = '<li><i class="glyphicon glyphicon-envelope"></i>'+
                '<div class="timeline-item">'+
                '<h3 class="timeline-header" style="font-size: 12px;"><i class="fas fa-calendar-alt"></i> '+data[emp].pesan_tanggal+' dari '+data[emp].username+'</h3>'+
                '<div class="timeline-body">'+data[emp].pesan_text+'</div>'+
                '<div class="timeline-footer"><a onclick="submitHapusPesan('+data[emp].pesan_id+')" class="btn btn-sm btn-circle btn-danger"><i class="glyphicon glyphicon-trash"></i></a></div>'+
                '</div>'+
                '</li>';
            $('ul.timeline').append(empRow);
        }
        $('ul.timeline').append('<li><i class="glyphicon glyphicon-time"></i></li>');
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

                searchFilterPesan(0);

                //$("#form1Pesan").modal("hide");


                $('#loading_ajax').fadeOut("slow");
                $('#Notifikasi').html('<p class="alert alert-success">Pesan berhasil dikirim</p>');
                $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                $("#pengaturanpesan").slideToggle();
                if(hasil.pesan == ''){
                    //window.location.assign("<?php echo base_url();?>index.php/admin/pesan");
                }
            }
        });
    }

    function submitHapusPesan(x){
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+x,
                url:'<?php echo base_url('index.php/admin/pesan/hapusdatabyid') ;?>',
                success: function(){
                    searchFilterPesan(0);
                }
            });
        }
    }


    /**
     * Tahun Ajaran
     */

    ajaxFilterTa();
    function ajaxFilterTa(){

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/pengaturan/daftarta',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                paginationDataTa(responseData);
                //$('#form1').modal('hide');
                $('#loading_ajax').fadeOut("slow");

            }
        });
    }

    function paginationDataTa(data) {
        $('#postListPengaturanTA tbody').empty();
        for(emp in data){
            var button_kunci = '';
            var button_arsip = '';
            var button_enable = '';
            var button_style1 = ' btn-default';
            var button_style2 = ' btn-default';
            var button_style3 = ' btn-default';

            if(data[emp].ta_aktif == 1){
                button_enable = ' disabled';
                button_style1 = ' btn-success';

            }
            if(data[emp].ta_lock == 1){
                button_kunci = ' disabled';
                button_style2 = ' btn-success';
            }


            if(data[emp].ta_arsip == 1){
                button_arsip = '';
                button_style3 = ' btn-success';
            }

            var empRow = '<tr>'+
                '<td class="text-center">'+data[emp].ta_tahun+'</td>'+
                '<td class="text-center">'+data[emp].ta_semester+'</td>'+
                '<td class="text-center">'+
                '<div class="btn-group" role="group">'+
                '<a onclick="submitTARepublish('+data[emp].ta_id+')" class="btn btn-sm'+button_style1+'"'+button_enable+'>pilih</a> '+
                '<a onclick="submitTAHapus('+data[emp].ta_id+')" class="btn btn-sm btn-danger">hapus</a> '+
                '<a onclick="submitTAKunci('+data[emp].ta_id+')" class="btn btn-sm'+button_style2+'"'+button_kunci+'>kunci</a> '+
                '<a onclick="submitTAArsip('+data[emp].ta_id+')" class="btn btn-sm'+button_style3+'"'+button_arsip+'>arsip</a> '+
                '</div>'+
                '</td>'+
                +'</tr>';
            $('#postListPengaturanTA tbody').append(empRow);
        }
    }


    function submitTATambahdata(){

        $('#btn-tambah').removeClass('btn-primary');
        $('#btn-tambah').addClass('btn-default');

        var tahun = $("[name='ta_tahun']").val();
        var semester = $("[name='ta_semester']").val();

        $('#loading_ajax').show();

        $.ajax({
            type:'POST',
            data: {
                'tahun': tahun ,
                'semester': semester
            },
            url:'<?php echo base_url('admin/pengaturan/tambahdataby_ta') ;?>',
            dataType:'json',
            success: function(hasil){
                //console.log(hasil);

                ajaxFilterTa();
                $('#loading_ajax').fadeOut("slow");

                if(hasil.pesan == ''){
                    $('#form1').modal('hide');
                    $('#btn-tambah').removeClass('btn-default');
                    $('#btn-tambah').addClass('btn-primary');

                    //bersihkan form
                }else{
                    $('#btn-tambah').removeClass('btn-default');
                    $('#btn-tambah').addClass('btn-primary');

                    $('.modal-status').show();
                    $('.modal-status').html('<div class="alert alert-danger" role="alert">'+hasil.pesan+'</div>');

                }
            }
        });
    }

    function submitTARepublish(id){
        $.ajax({
            type: 'POST',
            data: 'id='+id,
            url: '<?php echo base_url(); ?>admin/pengaturan/republishby_ta',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (respon) {
                ajaxFilterTa();
                $('#loading_ajax').fadeOut("slow");

            }
        });
    }

    function submitTAHapus(x){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+x,
                url:'<?php echo base_url('admin/pengaturan/hapusdataby_ta') ;?>',
                success: function(){
                    ajaxFilterTa();
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }
    }

    function submitTAKunci(x){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau kunci data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+x,
                url:'<?php echo base_url('admin/pengaturan/kuncidataby_ta') ;?>',
                success: function(){
                    ajaxFilterTa();
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }
    }

    function submitTAArsip(x){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau arsipkan data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+x,
                url:'<?php echo base_url('admin/pengaturan/arsipdataby_ta') ;?>',
                success: function(){
                    ajaxFilterTa();
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }
    }

    function submitTAKunciReset(){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau reset kunci data?');
        if(tanya){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('admin/pengaturan/kuncidataby_ta_reset') ;?>',
                success: function(){
                    ajaxFilterTa();
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }
    }


    /**
     * Jurusan
     */


    ajaxFilterJurusan();
    function ajaxFilterJurusan(){

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/pengaturan/daftarjurusan',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                console.log(responseData);
                paginationDataDialogEditJurusan(responseData);
                //$('#form1').modal('hide');
                $('#loading_ajax').fadeOut("slow");
                $('.panel-footer').fadeIn("slow");
            }
        });
    }

    function paginationDataDialogEditJurusan(data) {
        $('#postListPengaturanJurusan tbody').empty();
        for(emp in data){
            var empRow = '<tr>'+
                '<td>'+data[emp]+'</td>'+
                '<td class="text-center"><div class="btn-group" role="group"><a onclick="hapusJurusan(\''+data[emp]+'\')" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a></div></td>'+
                +'</tr>';

            $('#postListPengaturanJurusan tbody').append(empRow);
        }
    }

    function tambahdatajurusan(){

        $('#btn-tambahjurusan').removeClass('btn-primary');
        $('#btn-tambahjurusan').addClass('btn-default');

        var nama_jurusan = $("[name='nama_jurusan']").val();

        $('#loading_ajax').show();

        $.ajax({
            type:'POST',
            data: {
                'nama_jurusan': nama_jurusan
            },
            url:'<?php echo base_url('admin/pengaturan/tambahdatajurusan') ;?>',
            dataType:'json',
            success: function(hasil){
                console.log(hasil);

                $('#loading_ajax').fadeOut("slow");

                if(hasil.pesan == ''){
                    $('#form1').modal('hide');
                    ajaxFilterJurusan();
                    $('#btn-tambahjurusan').removeClass('btn-default');
                    $('#btn-tambahjurusan').addClass('btn-primary');

                    //bersihkan form
                }else{
                    $('#btn-tambahjurusan').removeClass('btn-default');
                    $('#btn-tambahjurusan').addClass('btn-primary');

                    $('.modal-status-jurusan').show();
                    $('.modal-status-jurusan').html('<div class="alert alert-danger" role="alert">'+hasil.pesan+'</div>');

                }
            }
        });
    }

    function hapusJurusan(x){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+x,
                url:'<?php echo base_url('admin/pengaturan/hapusdatajurusanbyid') ;?>',
                success: function(){
                    ajaxFilterJurusan();
                }
            });
        }
    }

    /**
     * Lain-lain
     */

    function submitLockUjian() {
        var lock_ujian = $('#lock_ujian').val();
        $.ajax({
            type: 'POST',
            data: 'lock_ujian='+lock_ujian,
            url: '<?php echo base_url(); ?>admin/pengaturan/simpandata_lockujian',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function () {
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function submitLockClient() {
        var lock_client = $('#lock_client').val();
        $.ajax({
            type: 'POST',
            data: 'lock_client='+lock_client,
            url: '<?php echo base_url(); ?>admin/pengaturan/simpandata_lockclient',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function () {
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function submitInstansi() {
        var instansi = $('#instansi').val();
        $.ajax({
            type: 'POST',
            data: 'instansi='+instansi,
            url: '<?php echo base_url(); ?>admin/pengaturan/simpandata_instansi',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function () {
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function submitWaktuMinimum() {
        var waktuminimum = $('#waktuminimum').val();
        $.ajax({
            type: 'POST',
            data: 'waktuminimum='+waktuminimum,
            url: '<?php echo base_url(); ?>admin/pengaturan/simpandata_waktuminimum',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function () {
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function submitWaktuToken() {
        var waktutoken = $('#waktutoken').val();
        $.ajax({
            type: 'POST',
            data: 'waktutoken='+waktutoken,
            url: '<?php echo base_url(); ?>admin/pengaturan/simpandata_waktutoken',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function () {
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function submitWelcome(){

        var wm_text =  tinyMCE.get("wm_text").getContent();
        $.ajax({
            type:'POST',
            data: {
                wm_text:wm_text,
            },
            url:'<?php echo base_url('admin/pengaturan/simpandata_welcomepessage') ;?>',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function(hasil){
                console.log(hasil);
                $('#loading_ajax').fadeOut("slow");
                $('.pesan').show();
                $('.pesan').html('<p class="bg-warning">'+hasil.pesan+'</p>');

                if(hasil.pesan == ''){
                    window.location.assign("<?php echo base_url();?>admin/pengaturan");
                }
            }
        });
    }

    function hapusWelcome(){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau reset data?');
        if(tanya){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('admin/pengaturan/resetwelcome') ;?>',
                success: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }
    }


</script>