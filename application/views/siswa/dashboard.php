<link href="<?php echo base_url();?>assets/css/timeline.css" rel="stylesheet">
<div class="container container-medium">
    <div class="row">


        <div class="col-md-8 col-sm-8">

            <div class="row">

                <div class="col-md-12">
                    <div class="small-box bg-blue" style="padding-left:20px;">
                        <a href="<?php echo base_url() ?>siswa/ujian">
                            <h3>Lihat Daftar Ujian</h3>
                            <p>Akan terdapat daftar ujian yang akan diujikan</p>
                        </a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="small-box bg-olive" style="padding-left:20px;">
                        <a href="<?php echo base_url() ?>siswa/soalarsip">
                            <h3>Lihat Daftar Arsip Soal</h3>
                            <p>Akan terdapat daftar soal arsip yang pernah diujikan</p>
                        </a>
                    </div>
                </div>

                <div class="col-md-12">

                    <div id="loading_ajax1"><span style="clear:both">Memuat Data...</span></div>

                    <ul class="timeline">
                    </ul>
                </div>

            </div>

        </div>

        <div class="col-md-4 col-sm-4">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h5><?php echo $tahunajaran;?></h5>
                            <p>Tahun Ajaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-sun"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h5><?php echo $jumlah_dikerjakan." dari ".$jumlah_pelajaran;?> pelajaran</h5>
                            <p>Pelajaran dikerjakan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h5><?php echo $ruangan;?></h5>
                            <p>Ruang Ujian saat ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-home"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h5><?php echo $jumlah_jurusan."/".$jumlah_jurusan;?></h5>
                            <p>Total Siswa/Jurusan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h5><?php echo $jumlah_pelajaran;?></h5>
                            <p>Mata Pelajaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>




</div>

<div style="
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: transparent;
    color: white;
    text-align: center;
    padding: 20px;
    display: none;
">
    <button class="btn btn-success btn-lg">Masuk ke ujian</button>
</div>


<div class="modal fade modal-fullscreen" id="ruanganx" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ruangan
                    <div class="pull-right">
                        <button onclick="simpanruangan()" type="button" id="btn-ubah" class="btn btn-success">Simpan</button>
                    </div>
                </h4>
            </div>
            <div class="modal-body text-left">

                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <p>Silahkan lakukkan pemilihan ruangan ujian, sebelum mengerjakan soal soal yang diberikan
                            dan pastikan ruangan yang Anda masukkan benar, agar pengawas ruangan dapat mengetahui Anda!.</p>
                        <p>Jangan lupa setelah memilih ruangan klik <strong>Simpan</strong> di pojok kanan atas!</p>

                        <label>Pilih Ruangan Ujian <span class="text-danger">*</span></label><br/>
                        <select class="form-control"  id="ruangan">
                            <?php for($a=1; $a<=$jumlahruangan; $a++){?>
                                <option value="<?php echo $a?>">Ruang <?php echo $a?></option>
                            <?php }?>
                        </select>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>



<script src="<?php echo base_url('assets/admin/js/bootstrap.min.js') ?>"></script>
<style type="text/css">
    .small-box .icon {
        font-size: 20px;
    }
</style>

<script type="text/javascript">
    <?php if(!empty($ruangan)){?>
    $('#ruanganx').modal('hide');
    <?php }else{?>
    $('#ruanganx').modal('show');
    <?php }?>

    function simpanruangan(){

        var ruangan = $("#ruangan").val();

        $.ajax({
            type:'POST',
            data: "ruangan="+ruangan,
            url:'<?php echo base_url('index.php/siswa/dashboard/simpanruangan') ;?>',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function(){
                $('#ruanganx').modal('hide');
                $('#loading_ajax').fadeOut("slow");
                window.location.assign("<?php echo base_url('index.php/siswa/dashboard') ;?>");
            }
        });
    }


    function hilangkanwelcome(){


        $('#btn-sembunyi').removeClass('btn-primary');
        $('#btn-sembunyi').addClass('btn-default');

        $.ajax({
            type:'POST',
            url:'<?php echo base_url('index.php/siswa/dashboard/hapuswelcome') ;?>',
            success: function(){
                $('#welcomepage').modal('hide');
            }
        });
    }

    $('#loading_ajax').fadeOut("slow");
    $('#pesan-refresh').click(function(){
        searchFilter(0);
    });

    setTimeout(function() {
        searchFilter(0);

    },600);


    function searchFilter() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/siswa/dashboard/timeline/',
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
                '<h3 class="timeline-header"><i class="glyphicon glyphicon-calendar"></i>'+data[emp].pesan_tanggal+' dari '+data[emp].username+'</h3>'+
                '<div class="timeline-body">'+data[emp].pesan_text+'</div>'+
                '<div class="timeline-footer"></div>'+
                '</div>'+
                '</li>';
            $('ul.timeline').append(empRow);
        }
        $('ul.timeline').append('<li><i class="glyphicon glyphicon-time"></i></li>');
    }
</script>