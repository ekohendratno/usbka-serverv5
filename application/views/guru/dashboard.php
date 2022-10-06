<link href="<?php echo base_url();?>assets/css/timeline.css" rel="stylesheet">

<div class="position-absolute">
    <div class="container container-medium">
        <div class="row">


            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="small-box bg-light">
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="inner">
                        <h3><?php echo $jumlah_soal;?>/<?php echo $jumlah_pelajaran;?></h3>
                        <p>Soal dibuat/Pelajaran</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="small-box bg-light">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="inner">
                        <h3><?php echo $jumlah_peserta;?>/<?php echo $jumlah_jurusan;?></h3>
                        <p>Murid/Jurusan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="small-box bg-light">
                    <div class="icon">
                        <i class="fas fa-sun"></i>
                    </div>
                    <div class="inner">
                        <h3><?php echo $tahunajaran;?></h3>
                        <p>Tahun Ajaran</p>
                    </div>
                </div>
            </div>





        </div>
    </div>
</div>

<div class="container container-medium" style="margin-top: 20px">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="homes" style="padding-bottom: 40px; padding-top: 40px">


                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="<?php echo base_url()?>guru/soal">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-file-word"></i>
                                    </div>
                                    <p class="text-center">Bank Soal</p>
                                </div>
                            </a>
                            <br>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="<?php echo base_url()?>guru/ujian">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-pen"></i>
                                    </div>
                                    <p class="text-center">Ujian</p>
                                </div>
                            </a>
                            <br>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="#formTimeline" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <div class="dashboard-circle">
                                    <?php if($notifikasi_pesan > 0){?><i class="notifikasi1"><?php echo $notifikasi_pesan;?></i><?php }?>
                                    <div class="icon">
                                        <i class="fa fa-comment"></i>
                                    </div>
                                    <p class="text-center">Pesan</p>
                                </div>
                            </a>
                            <br>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-6 text-center">
                            <a href="#formTahunAjaran" onclick="closetahunajaran()" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <div class="dashboard-circle">
                                    <div class="icon">
                                        <i class="fas fa-hammer"></i>
                                    </div>
                                    <p class="text-center">Pengaturan</p>
                                </div>
                            </a>
                            <br>
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

                        <div class="col-md-12">

                            <label>Pilih Tahun Ajaran <span class="text-danger">*</span></label><br/>
                            <select class="form-control selectpicker"  id="tahunajaran">
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
                <h4 class="modal-title">Pesan
                    <div class="pull-right">
                        <a href="#" id="pesan-refresh" class="btn btn-primary">Refresh</a>
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                    </div>
                </h4>
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


<?php if(!empty($welcome_message)){?>
<div class="modal fade" id="welcomepage" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-left">
                <?php echo $welcome_message;?>
            </div>
            <div class="modal-footer">
                <button onclick="hilangkanwelcome()" id="btn-sembunyi" type="button" class="btn btn-primary">Sembunyikan Pesan</button>
            </div>

        </div>
    </div>
</div>
<?php }?>


<script type="text/javascript">
    <?php if(!empty($tahunajaran) ){?>
        $('#tahunajaran').val('<?php echo $tahunajaran;?>');
        $('#tahunajaran').selectpicker('refresh');

        $('#formTahunAjaran').modal('hide');
    <?php }else{?>
        $('#formTahunAjaran').modal('show');
    <?php }?>

    function closetahunajaran() {
        $('#closetahunajaran').show();
    }

    function submitTahunAjaran(){

        var tahunajaran = $("#tahunajaran").val();

        $.ajax({
            type:'POST',
            data: "tahunajaran="+tahunajaran,
            url:'<?php echo base_url('index.php/guru/pengaturan/simpantahunajaran') ;?>',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function(){
                $('#formTahunAjaran').modal('hide');
                $('#loading_ajax').fadeOut("slow");

                setTimeout(function() {
                    window.location.assign("<?php echo base_url('index.php/guru/dashboard') ;?>");
                }, 300);
            }
        });
    }


    setTimeout(function() {

        $('#loading_ajax1').fadeOut("slow");
        $('#welcomepage').modal('hide');
        $.ajax({
            type:'POST',
            url:'<?php echo base_url('index.php/guru/dashboard/getwelcome') ;?>',
            dataType: 'json',
            success: function(data){

                var x = 0;
                for(emp in data){
                    if(data[emp].pengaturan_value > 0){
                        x++;
                    }else if(data[emp].pengaturan_value == 0){
                        x = 0;
                    }
                }


                if( x > 0){
                    $('#welcomepage').modal('hide');
                }else{
                    $('#welcomepage').modal('show');
                }


            }
        });
    }, 3000);

    function hilangkanwelcome(){


        $('#btn-sembunyi').removeClass('btn-primary');
        $('#btn-sembunyi').addClass('btn-default');

        $.ajax({
            type:'POST',
            url:'<?php echo base_url('index.php/guru/dashboard/hapuswelcome') ;?>',
            success: function(){
                $('#welcomepage').modal('hide');
            }
        });
    }

    $('#loading_ajax').fadeOut("slow");
    $('#pesan-refresh').click(function(){
        searchFilter(0);
    });

    searchFilter(0);
    function searchFilter() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/guru/dashboard/timeline/',
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
        $('ul.timeline').empty();
        $('ul.timeline').append('<li class="time-label"><span class="btn btn-sm btn-success">Pengumuman Terakhir</span></li>');
        for(emp in data){
            var empRow = '<li><i class="glyphicon glyphicon-envelope"></i>'+
                '<div class="timeline-item">'+
                '<h3 class="timeline-header" style="font-size: 12px;"><i class="fas fa-calendar-alt"></i> '+data[emp].pesan_tanggal+' dari '+data[emp].username+'</h3>'+
                '<div class="timeline-body">'+data[emp].pesan_text+'</div>'+
                '<div class="timeline-footer"></div>'+
                '</div>'+
                '</li>';
            $('ul.timeline').append(empRow);
        }
        $('ul.timeline').append('<li><i class="glyphicon glyphicon-time"></i></li>');
    }


    function getToken(){
        $('#token').val('Loading...');

        $.ajax({
            type:'POST',
            url:'<?php echo base_url('token') ;?>',
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                $('#loading_ajax').fadeOut("slow");
                $('#token').val(responseData.ujian_token_text);

                setInterval(function() {
                    $.ajax({
                        type:'POST',
                        url:'<?php echo base_url('token') ;?>',
                        dataType:'json',
                        success: function (responseData) {
                            $('#token').val(responseData.ujian_token_text);
                        }
                    });

                }, 1000);
            }
        });
    }

</script>


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
    .navbar {
        margin-bottom: 0px;
    }
    .position-absolute{
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

    .notifikasi1{
        padding: 5px;
        width: 30px;
        height: 30px;
        border: 1px solid #ff1a00;
        background: #ff1a00;
        color: #fff;
        position: absolute;
        border-radius: 30px;
    }
</style>