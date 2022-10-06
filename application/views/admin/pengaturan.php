<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-cog fa-fw'></i> PENGATURAN<i class='fa fa-angle-right fa-fw'></i> DATA PENGATURAN</h4>
        <hr/>
        <div class="panel-title-button pull-right">
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-12">
        <div>
            <div style="min-height:800px;">




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
                            <a href="#formTahunAjaran" data-toggle="modal" class="btn btn-primary btn-success">Atur TA Sesi</a>
                            <a href="#formDialogTA" data-toggle="modal" class="btn btn-primary btn-success">Tambah TA</a>
                            <a onclick="submitTAKunciReset()" class="btn btn-primary btn-danger">Reset Kunci TA</a>
                        </div>


                        <br/>
                        <p>Ini adalah aturan untuk default pilihan pada T.A. yang muncul pada dialog sesi</p>

                        <table id='postListPengaturanTA' class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" width="150">TAHUN</th>
                                <th class="text-center" width="150">SEMESTER</th>
                                <th class="text-center"><span class="glyphicon glyphicon-cog"></span></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                    </div>
                    <div id="pengaturan_b" class="tab-pane fade in">

                        <div class="text-right">
                            <a href="#formDialogJurusan" data-toggle="modal" class="btn btn-primary btn-success">Tambah Jurusan</a>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <table id='postListPengaturanJurusan' class="table table-hover">
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


<div class="modal fade modal-fullscreen" id="formTahunAjaran" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tahun Ajaran
                    <div class="pull-right">
                        <button onclick="submitTahunAjaran()" type="button" id="btn-ubah" class="btn btn-success">Simpan Pengaturan</button>
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
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
                            <select class="form-control selectpicker"  id="tahunajaran">
                                <option value="">Pilih tahun ajaran</option>
                                <?php
                                $query = $this->db->group_by("ta_tahun")->order_by("ta_tahun","DESC")->get_where("ta",array())->result();
                                foreach ($query as $ta){?>
                                    <option value="<?php echo $ta->ta_tahun;?>-<?php echo $ta->ta_semester;?>"><?php echo $ta->ta_tahun;?>-<?php echo $ta->ta_semester;?></option>
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

<div class="modal fade" id="formDialogJurusan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-status-jurusan"></div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">

                        <label>Nama Jurusan</label><br/>
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="">

                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="tambahdatajurusan()" id="btn-tambahjurusan" class="btn btn-primary">Tambahkan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="formDialogTA" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-status"></div>
            <div class="modal-body">
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
                </div>
                <div class="clear"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="submitTATambahdata()" id="btn-tambah" class="btn btn-primary">Tambahkan</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    <?php if(!empty($tahunajaran) ){?>
    $('#tahunajaran').val('<?php echo $tahunajaran;?>');
    $('#tahunajaran').selectpicker('refresh');

    <?php }?>


    tinyMCE.init({
        selector: "textarea.form-control#wm_text",
        height: 100,
        max_height: 300,
        min_height: 100,
        menubar: false,
        statusbar:false,
        plugins: 'autoresize print preview searchreplace autolink directionality visualblocks visualchars fullscreen image media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help code',
        toolbar: 'image media alignleft alignright bullist numlist table removeformat  code codesample ',
        image_advtab: true,
        images_upload_url: '<?php echo base_url();?>admin/pengaturan/uploadfile',

        //relative_urls: true,
        relative_urls: false,
        remove_script_host: false,

        // override default upload handler to simulate successful upload
        images_upload_handler: function (blobInfo, success, failure) {

            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '<?php echo base_url();?>admin/pengaturan/uploadfile');

            xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        }

    });

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

    $('.panel-footer').hide();







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




    function  resetDataAll() {

        var tanya = confirm('Apakah yakin mau hapus semua data?');
        if(tanya){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('admin/pengaturan/resetdataall') ;?>',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(respon){
                    $('#loading_ajax').fadeOut("slow");

                    if(respon.pesan == '' ){
                        window.location.assign("<?php echo base_url();?>auth/logout");
                    }
                }
            });
        }


    }



    function submitAutoCorrect(){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau mengkoreksi jawaban peserta?');
        if(tanya){
            $.ajax({
                type:'GET',
                url:'<?php echo base_url('admin/pengaturan/autocorrect') ;?>',
                success: function(data){
                    $('#loading_ajax').hide();

                    if(data.success){
                        alert("Berhasil di koreksi!");
                    }
                }
            });
        }else{

            $('#loading_ajax').hide();
        }
    }



    function submitArsipkanSoalUjian(){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau mengarsipkan soal?');
        if(tanya){
            $.ajax({
                type:'GET',
                url:'<?php echo base_url('admin/pengaturan/arsipkansoalujian') ;?>',
                success: function(data){
                    $('#loading_ajax').hide();

                    if(data.success){
                        alert("Berhasil di arsipkan!");
                    }
                }
            });
        }else{

            $('#loading_ajax').hide();
        }
    }



    function submitArsipkanPeserta(){
        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau mengarsipkan peserta?');
        if(tanya){
            $.ajax({
                type:'GET',
                url:'<?php echo base_url('admin/pengaturan/arsipkanpeserta') ;?>',
                success: function(data){
                    $('#loading_ajax').hide();

                    if(data.success){
                        alert("Berhasil di arsipkan!");
                    }
                }
            });
        }else{

            $('#loading_ajax').hide();
        }
    }






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

</script>