<div class="container container-medium">
    <div class="row">


        <div class="col-md-12">

            <div class="row">
                <!-- Blog Entries Column -->


                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="chartWrapper">
                                <div class="chartAreaWrapper">
                                    <canvas id="peserta" width="1200" height="1200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="chartWrapper">
                                <div class="chartAreaWrapper">
                                    <canvas id="server" width="1200" height="1200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p class="well">
                                <span class="description">CPU Usage: </span> <span class="result-cpu">0</span> %,
                                <span class="description">Memory Usage:</span> <span class="result-memory">0</span> %,
                                <span class="description">Disk Usage:</span> <span class="result-disk">0</span> %,
                                <span class="description">Network Usage:</span> <span class="result-network">0</span>,
                                <span class="description">Bandwidth Usage:</span> <span class="result-bandwidth">0</span>,
                                <span class="description">Uptime:</span> <span class="result-uptime">0</span>,
                                <span class="description">Procesor:</span> <span class="result-number_processes">0</span>,
                                <span class="description">Kernel Version:</span> <span class="result-kernel_version">0</span>,
                                <span class="description">Connections:</span> <span class="result-http_connections">0</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="display: none">
                    <div class="jumbotron">
                        <div class="py-5 text-center">

                            <img src="<?php echo base_url();?>assets/img/logo.png" width="128px"/>
                            <h2>USBK</h2>
                            <p class="lead">Ujian Sekolah Berbasis Komputer.</p>
                            <hr class="my-4">
                            <p>Baca lebih lanjut cara penggunaan</p>
                            <a class="btn btn-secondary btn-sm" href="<?php echo base_url();?>index.php/admin/docs" role="button">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <a href="#" id="silit" class="left-btn" data-toggle="control-sidebar">
        <div class="toggler bg-x" style="right:0px;">
            <span class="glyphicon glyphicon-chevron-left" style="color:#000">&nbsp;</span>
        </div>
    </a>

    <aside class="control-sidebar control-sidebar-light control-sidebar-close">
        <div class="contente">
            <div id="tampil_jawaban">

                <div class="list-group list">

                </div>

            </div>
        </div>
    </aside>

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
        margin-bottom: 0px;
    }
    .position-absolute{
        padding-top: 20px;
        background: #778e9a!important;
        box-shadow: 2px 2px 2px 2px rgb(0 0 0 / 11%);
    }

    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    .chartWrapper {
        position: relative;
    }

    .chartWrapper > canvas {
        position: absolute;
        left: 0;
        top: 0;
        pointer-events:none;
    }

    .chartAreaWrapper {
        overflow-x: hidden;
    }
    .contente{
        margin-left:0px;
    }
    .list-group-item {
        background-color: transparent;
        border:0px;
        border-bottom: 1px solid #ddd;
    }
</style>

<link href="<?php echo base_url('assets/admin/css/AdminLTE.css') ?>" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/admin/js/adminlte.js"></script>
<script src="<?php echo base_url('assets/admin/js/Chart.min.js') ?>"></script>

<script type="text/javascript">


    window.pesertaChart = new Chart(document.getElementById("peserta").getContext('2d'), {
        type: 'pie',
        data: {
            labels: [
                "Peserta",
                "Ikut",
                "Selesai",
            ],
            datasets: [
                {
                    data: [0,0,0,0],
                    borderColor: ['rgb(210,210,210,1)','rgba(75, 192, 192, 1)','rgb(89,192,137,1)','rgb(192,32,57,1)'],
                    backgroundColor: ['rgba(210,210,210, 0.2)','rgba(75, 192, 192, 0.2)','rgba(89,192,137, 0.2)','rgba(192,32,57, 0.2)'],
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: "Monitoring Peserta"
            }
        }
    });


    window.serverChart = new Chart( document.getElementById("server").getContext('2d') , {
        type: 'pie',
        data: {
            labels: [
                "CPU",
                "Memory",
                "Disk Space",
            ],
            datasets: [
                {
                    data: [0,0,0],
                    borderColor: ['rgb(255,231,0,1)','rgb(50,133,192,1)','rgba(12,12,12,1)'],
                    backgroundColor: ['rgba(255,231,0, 0.2)','rgba(50,133,192, 0.2)','rgba(12,12,12, 0.2)'],
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: "Monitoring Sumberdaya"
            }
        }
    });


    $('#loading_ajax').show();
    window.myVar = null;
    setTimeout(function () {

        window.myVar = setInterval(_statistik, 5000);

    },3000);


    $('#silit').click(function() {
        var side = $(this).attr('class');
        if(side=="left-btn"){
            $('.toggler .glyphicon').removeClass('.glyphicon glyphicon-chevron-left');
            $('.toggler .glyphicon').addClass('.glyphicon glyphicon-chevron-right');
            $(this).removeClass('left-btn');
            $(this).addClass('right-btn');
            $('.toggler').css('right','300px');
        }else{
            $('.toggler .glyphicon').removeClass('.glyphicon glyphicon-chevron-right');
            $('.toggler .glyphicon').addClass('.glyphicon glyphicon-chevron-left');
            $(this).removeClass('right-btn');
            $(this).addClass('left-btn');
            $('.toggler').css('right','0px');
        }
    });

    var data_empty ='<div class="empty-placeholder">'+
        '<div class="placeholder-image"></div>'+
        '<div class="text-center"><h4>Tidak ada data<h4></div>'+
        '<div class="text-center">Lihat siapa yang sedang online hari ini di sini</div>'+
        '</div>'+
        '</div>';

    var data_loading ='<div class="empty-placeholder">'+
        '<div class="placeholder-image text-center"><i class="fas fa-clock"></i></div>'+
        '<div class="text-center"><h4>Sedang memuat data...<h4></div>'+
        '<div class="text-center">Biasanya membutuhkan waktu beberapa detik untuk menampilkan data</div>'+
        '</div>'+
        '</div>';


    $('.list-group').append(data_loading);
    $('a').click(function() {
        clearInterval(window.myVar);

        console.log(window.myVar);
    });

    function _statistik() {
        $('#loading_ajax').fadeOut("slow");


        $.ajax({
            type:'POST',
            url:'<?php echo $this->config->item('serverapi1') .'/statistik';?>',
            dataType: 'json',
            success: function(data){
                console.log('_statistik');

                if(data.sumberdaya){
                    $('.result-cpu').html(data.sumberdaya.cpu);
                    $('.result-memory').html(data.sumberdaya.memory);
                    $('.result-disk').html(data.sumberdaya.disk);
                    $('.result-bandwidth').html(data.sumberdaya.bandwidth.rx+'/'+data.sumberdaya.bandwidth.tx);
                    $('.result-uptime').html(data.sumberdaya.uptime);
                    $('.result-number_processes').html(data.sumberdaya.number_processes);
                    $('.result-kernel_version').html(data.sumberdaya.kernel_version);
                    $('.result-http_connections').html(data.sumberdaya.http_connections);

                    window.serverChart.data.datasets[0].data = [data.sumberdaya.cpu,data.sumberdaya.memory,data.sumberdaya.disk];
                    window.serverChart.update();
                }

                if(data.peserta){

                    window.pesertaChart.data.datasets[0].data = [data.peserta.total,data.peserta.ikut,data.peserta.selesai,data.peserta.pengawas];
                    window.pesertaChart.update();
                }


                if(data.whoisonline){

                    paginationDataHistory(data.whoisonline);
                }
            }
        });

        /**

        $.ajax({
            type:'POST',
            url:'<?php echo base_url('statistik/peserta') ;?>',
            dataType: 'json',
            success: function(data){

                if( data != null ){
                    window.pesertaChart.data.datasets[0].data = [data.total,data.ikut,data.selesai,data.pengawas];
                    window.pesertaChart.update();
                }
            }
        });

        $.ajax({
            type:'POST',
            url:'<?php echo base_url('statistik/whoisonline') ;?>',
            dataType: 'json',
            success: function(data){
                console.log(data);

                paginationDataHistory(data);
            }
        });*/
    }



    function paginationDataHistory(data) {
        $('.list-group.list').empty();


        if(data.length < 1){
            var empRow = 'Tidak ada Data';
            $('.list-group').append(data_empty);
        }


        var nomor = 1;
        for(emp in data){

            var nama = data[emp].nama;
            var level = data[emp].level;
            var kelas = data[emp].kelas;

            var s = '<span class="label label-danger">Offline</span> ';
            if(data[emp].status == "online"){
                s = '<span class="label label-success">Online</span> ';
            }

            var empRow = '<a href="javascript:void(0);" class="list-group-item">'+
                '<div class="row">'+
                '<div class="col-md-12 col-xs-12 vertical-center">'+
                '<div class="expertise">'+
                '<span>'+nama.toUpperCase()+'</span><br><span class="label label-warning">'+level.toUpperCase()+'</span> ' + s;
                    if( kelas != '' ) {
                        empRow+= '<span class="label label-success">' + kelas.toUpperCase() + '</span>';
                    }
            empRow+=
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '</a>';
            nomor++;
            $('.list-group.list').append(empRow);
        }
    }

</script>