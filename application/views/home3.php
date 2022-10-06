
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="E-Ujian">
    <meta name="description" content="Ujian online tanpa ribet! ">
    <title>CBT | Ujian Sekolah Berbasis Komputer Android! </title>

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:title" content="SMKN1CDP CBT | Ujian Sekolah Berbasis Komputer dan Android! " />
    <meta property="og:description" content="CBT Ujian Sekolah Berbasis Komputer dan Android!" />
    <meta property="og:url" content="<?php echo base_url();?>" />
    <meta property="og:image" content="<?php echo base_url('assets/img/logocbt.ico') ?>" />
    <link rel="icon" type="image/ico" href="<?php echo base_url('assets/img/logocbt.ico') ?>">
    <!-- Bootstrap -->
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <!-- Main Style -->
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css?t=2.0">
    <!-- Responsive Style -->
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">
    <!-- Extras -->
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/extras/animate.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/extras/lightbox.css">

    <!--Icon Fonts-->
    <script defer src="<?php echo base_url(); ?>assets/fontawesome/js/all.js"></script>
    <!-- jQuery Load -->
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        /*body{
            background: #ddd url("http://localhost/jualan/img/bg3.png") right center repeat;
		}*/
        .navbar-inverse{background-color:  #3c4b59;}

        .inset {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-top: 10px;
            margin-left: 0px;
            margin-right: 0px;
            background-color: transparent !important;
            z-index: 999;
        }

        .inset img {
            border-radius: inherit;
            width: inherit;
            height: inherit;
            display: block;
            position: relative;
            z-index: 998;
        }


        .inset2 {
            display: block;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-top: 10px;
            margin-left: -3px;
            margin-right: 0px;
            background-color: transparent !important;
            z-index: 999;
        }
        .inset2 img {
            border-radius: inherit;
            width: inherit;
            height: inherit;
            display: block;
            position: relative;
            z-index: 998;
            padding: 1px;
            border: 2px solid #838383;
        }

        .control-sidebar {
            top: 0;
            right: -300px;
            width: 300px;
        }

        .control-sidebar.fix {
            z-index: 101;
        }

        ul.nav.nav-pills.nav-stacked {
            padding-top: 74px;
        }

        .empty-placeholder {
            padding: 20px;
        }


        .navbar-default .navbar-collapse ul.nav li a{
            line-height: 40px;
        }

    </style>
    <style id="jsbin-css">
        .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover{
            background: transparent;
            color: #fff;

        }

        .navbar-default {
            background-color: #f8f8f8;
            border-color: #e7e7e7;
        }


        @media (max-width:768px) {
            .col-md-6.btn-dl {
                margin-bottom: 20px;
            }
        }

        @media (min-width:768px) {

            .nav-bg {
                height: 0px;
                width: 100%;
                position: absolute;
                top: 50px;
                background: #fff;
                -webkit-box-shadow: 0px 3px 3px 0px rgba(0,0,0,0.09);
                -moz-box-shadow: 0px 3px 3px 0px rgba(0,0,0,0.09);
                box-shadow: 0px 3px 3px 0px rgba(0,0,0,0.09);
            }

            .menu-open .nav-bg { height: 50px } /* change to your height of the child menu */

        }

        .navbar-nav.nav > li { position: static }

        .navbar-nav.nav .dropdown-menu {
            left: 0 !important;
            right: 0 !important;
            box-shadow: none;
            border: none;
            margin: 0 auto;
            max-width: 1170px;
            background: transparent;
            padding: 0;
        }

        .navbar-nav.nav .dropdown-menu > li { float: left }

        .navbar-nav.nav .dropdown-menu > li > a {
            width: auto !important;
            background: transparent;
            line-height: 49px;
            padding-top: 0;
            padding-bottom: 0;
            margin: 0;
        }
        }



    </style>

    <style type="text/css">
        .login .modal-content {
            border: none;
            position: relative;
            padding: 0 !important;
            font-size: 14px;
            border-radius: 0;
            -webkit-box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%);
            -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
            box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%);
        }

        .login .modal-content .modal-header {
            padding: 0;
            border: none;
        }

        .login .modal-content button.close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0;
            margin: 0;
            width: 40px;
            height: 40px;
            z-index: 1;
            text-shadow: none;
            background: rgba(0, 0, 0, 0.1);
            color: #fff;
        }
        .login .modal-header .close {
            padding: 1rem 1rem;
            margin: -1rem -1rem -1rem auto;
        }

        .login .no-gutters {
            margin-right: 0;
            margin-left: 0;
        }
        .login .row {
            padding: 0px;
        }
        .login .col-md-6 {
            padding-left: 0px;
            padding-right: 0px;
        }
        .modal-content {
            background: #e7e7e7;

        }
        .modal-content .form-control {
            border-radius: 0;
        }

        .modal-content .modal-body.color-1 h5 {
            line-height: 1.5;
            font-weight: 400;
            font-size: 18px;
        }
        .modal-content .modal-body.color-2 {
            background: #34495e;
            color: rgba(255, 255, 255, 0.8);
        }
        .modal-content .modal-body {
            border: none;
            position: relative;
            z-index: 0;
        }


    </style>

</head>

<body data-spy="scroll" data-offset="20" data-target="#navbar">
<!-- Nav Menu Section -->
<div class="logo-menu">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>" title="CBT">
                    <img alt="Brand" src="<?php echo base_url();?>assets/images/logocbt.ico" style="float: left; padding: 0; height: 30px">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#hero-area">Beranda</a></li>
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#kelebihan">Kelebihan</a></li>
                    <li><a href="#about">Kontak</a></li>
                    <li><a href="<?php echo base_url();?>arsip">Arsip</a></li>
                    <?php if($this->session->userdata('level') == ('admin'||'guru')){?>
                        <li><a href="<?php echo base_url(). 'auth/profile';?>">Hallo, <?php echo $this->session->userdata('username');?></a></li>
                        <li><a href="<?php echo base_url(). $this->session->userdata('level').'/dashboard'; ?>"><span class="glyphicon glyphicon-dashboard"></span></li></a>
                    <?php }?>
                    <?php if(!empty($this->session->userdata('level'))){?>
                        <li><a href="<?php echo base_url().'auth/logout'; ?>"><div class="btn btn-md btn-danger" style="padding: 1px 7px; margin-top: -5px; border-radius:30px;">Logout</div></li></a>
                    <?php }else{?>
                        <li><a class="nav-link" style="cursor: pointer"data-toggle="modal" data-target="#formLogin"><div class="btn btn-md btn-success" style="padding: 1px 7px; margin-top: -5px; border-radius:30px;">Login</div></li></a>
                    <?php }?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</div>
<!-- Nav Menu Section End -->

<!-- Hero Area Section -->

<section id="hero-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br />
                <h2 class="subtitle branded">Ujian tanpa kertas dengan hasil instan!</h2>

                <img class="col-md-6 col-sm-6 col-xs-12 animated fadeInLeft" src="<?php echo base_url();?>assets/images/hero/macbook.png?t=1" alt="">

                <div class="col-md-6 col-sm-6 col-xs-12 animated fadeInRight delay-0-5">
                    <p>
                        Lelah melakukan koreksi ujian konvensional? cbt solusinya.
                        Tanpa harus memasang software tambahan, lembaga Anda dapat menyelenggarakan ujian secara online yang terkontrol baik
                        tanpa kertas dengan mudah.<br /><br />
                        Untuk dapat memulai, silakan klik tombol di bawah ini!
                    </p>
                    <div class="row">

                        <div class="col-md-6 btn-dl">
                            <a href='<?php echo base_url(); ?>uploads/winclient.zip' class="btn btn-primary btn-lg btn-block">Untuk Windows</a>
                        </div>

                        <div class="col-md-6 btn-dl">
                            <a href="<?php echo base_url(); ?>download/android" class="btn btn-success btn-lg btn-block">Untuk Android</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Hero Area Section End-->



<!-- Service Section -->

<section id="fitur">
    <div class="container text-center">
        <div class="row">
            <h1 class="title branded">Fitur</h1>
            <h2 class="subtitle">Ujian online tanpa ribet!</h2>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="service-item">
                    <h3 class="branded">Bank Soal</h3>
                    <p>Manajemen data soal yang dapat ditelusuri berdasarkan materi, kelas (jenjang), kata kunci pada soal dan terkelompok menjadi paket-paket soal siap pakai.</p>
                </div>
            </div>


            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="service-item">
                    <h3 class="branded">Data Pengajar dan Peserta</h3>
                    <p>Pengelolaan data pengajar dan peserta ujian yang sederhana dan terkontrol penuh oleh admin lembaga. Tidak perlu data yang berlebihan untuk berjalannya aplikasi.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="service-item">
                    <h3 class="branded">Manajemen Sesi</h3>
                    <p>Sesi pelaksanaan tes dapat diatur dengan mudah oleh admin lembaga. Admin lembaga memiliki kontrol penuh mulai dari waktu pelaksanaan, berapa lama tes berlangsung, sampai dengan penambahan waktu pengerjaan.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="service-item">
                    <h3 class="branded">Webcam Monitoring</h3>
                    <p>Panitia ujian dapat melakukan pengawasan kepada peserta ujian melalui <em>web camera</em> sehingga diharapkan dapat meminimalkan adanya kecurangan.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="service-item">
                    <h3 class="branded">Fleksibilitas Waktu</h3>
                    <p>Pelaksanaan sesi ujian dapat dilaksanakan secara serentak maupun tidak, diatur semuanya oleh lembaga. Bahkan, waktu pengerjaan satu soal pun bisa dibatasi.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="service-item">
                    <h3 class="branded">Import Soal</h3>
                    <p>Untuk memudahkan dalam proses memasukkan soal, e-ujian dapat menerima soal dari dokumen Microsoft Excel, Microsoft Word, atau ZIP menggunakan template yang sudah disiapkan.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="service-item">
                    <h3 class="branded">Soal Audio</h3>
                    <p>Memungkinkan penyelenggaraan ujian berbasis audio seperti TOEFL, yang didukung dengan mode soal <em>continuous</em> (soal harus dikerjakan berurutan, tidak boleh lompat ataupun kembali ke nomor sebelumnya)</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="service-item">
                    <h3 class="branded">Acak Soal dan Jawaban</h3>
                    <p>Terdapat <b>pilihan</b> untuk mengacak soal dan jawaban pada saat ujian dilaksanakan, sehingga setiap peserta akan mendapat urutan nomor soal dan jawaban yang berbeda-beda, walaupun paket soalnya sama.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="service-item">
                    <h3 class="branded">Laporan Hasil</h3>
                    <p>cbt juga menyajikan laporan hasil pelaksanaan ujian dalam berbagai bentuk, antara lain rangkuman sesi, analisis pertanyaan, dsb. Sehingga, pengajar dapat melakukan evaluasi dari hasil laporan tersebut.</p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Service Section End -->


<!-- Client Section -->
<section id="kelebihan">
    <div class="container text-center">
        <div class="row">

            <h1 class="title branded">Kelebihan</h1>
            <h2 class="subtitle">Ujian online ingin memudahkan Anda!</h2>

            <div class="wow fadeInDown">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <h3 class="branded">Pertukaran Soal</h3>
                        <p>Pengajar boleh saling bertukar paket soal antar lembaga (apabila saling mengijinkan), sehingga bank soal yang ada di cbt dapat lebih bervariasi. </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <h3 class="branded">Tidak Perlu Instalasi</h3>
                        <p>Tidak perlu ada pemasangan software tambahan, cbt dapat dijalankan langsung dari mana saja. Anda dapat menginstall browser khusus ujian apabila diperlukan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <h3 class="branded">Mudah dan Cepat</h3>
                        <p>Pengoperasian aplikasi tidak membutuhkan data yang berlebihan, sehingga Admin maupun operator tidak direpotkan untuk memasukkan data yang tidak perlu.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <h3 class="branded">Unggah Soal Mudah</h3>
                        <p>Menambahkan soal di cbt sangatlah mudah, bahkan Anda bisa saja hanya mengunggah <i>screenshot</i> soal beserta pilihan jawabannya!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <h3 class="branded">Pembatasan IP</h3>
                        <p>Untuk memberikan proteksi tambahan, admin lembaga dapat membatasi pengerjaan ujian hanya dari IP address yang dibolehkan saja.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <h3 class="branded">Kesalahan Pengerjaan</h3>
                        <p>Admin lembaga dapat mengatur sesi ujian sehingga peserta dapat melihat soal-soal yang pengerjaannya kurang tepat setelah selesai ujian.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <h3 class="branded">KaTex</h3>
                        <p>Persamaan matematika dapat dimasukkan dengan mudah menggunakan syntax KaTex (mirip LaTex) yang mendukung berbagai macam bentuk formula.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <h3 class="branded">Bebas Maintenance</h3>
                        <p>Maintenance aplikasi dan server tidak perlu dilakukan oleh lembaga, karena kami akan melakukannya secara gratis!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <h3 class="branded">Hemat Biaya</h3>
                        <p>Kami menggunakan sistem poin (sejenis pulsa) yang dapat di-top-up dengan mudah dan digunakan kapanpun tanpa batas kadaluarsa.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Client Section End -->

<section id="disclaimer">
    <div class="container text-center">
        <div class="row">
            <h1 class="title branded">Disclaimer</h1>

            <h2 class="subtitle">Mohon sempatkan waktu Anda untuk membaca!</h2>

            <div class="col-md-12 col-sm-12">
                <p>
                    Kami pihak CBT berperan hanya sebagai penyedia layanan berbasis web kepada para penyelenggara tes/ujian (lembaga/instansi/perorangan).
                    Segala konten yang ada di dalam masing-masing akun CBT diunggah dan merupakan milik penyelenggara tes/ujian dan di luar kontrol/kendali kami. Kami tidak bertanggung jawab
                    atas apapun hal yang terjadi disebabkan karena konten yang dibuat oleh penyelenggara tes/ujian.
                </p>
                <p>
                    Penyelenggaraan sesi ujian diatur sepenuhnya oleh masing-masing penyelenggara tes/ujian, sehingga kami tidak bertanggung jawab atas hasil yang diperoleh peserta ujian serta keputusan apapun yang dibuat berdasarkan hasil tes/ujian
                    tersebut.
                </p>
                <p>
                    Apabila ada penyelenggara tes/ujian yang menyampaikan hal-hal yang kontradiktif dengan apa yang dijelaskan di atas, maka pihak e-ujian tidak bertanggung jawab atas konsekuensi apapun
                    yang terjadi atas pernyataan tersebut.
                </p>
                <p>
                    Demikian disclaimer ini dibuat untuk diperhatikan.
                </p>
            </div>
        </div>
    </div>
</section>



<!-- About Section -->

<section id="about">
    <div class="container text-center">
        <div class="row">
            <h1 class="title branded">Kontak Kami</h1>

            <h2 class="subtitle">Kami tunggu berita baik dari Anda!</h2>

            <div class="col-md-12 wow fadeInRight">
                <!--
                 <div class="social-links">
                 <a class="social" href="#" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
                 <a class="social" href="#" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
                 <a class="social" href="#" target="_blank"><i class="fa fa-google-plus fa-2x"></i></a>
                 <a class="social" href="#" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a>
                 </div>
                 -->
                <div class="contact-info">
                    <p><i class="fa fa-map-marker"></i> Lampung, Indonesia.</p>
                    <p><i class="fa fa-envelope"></i> eko.hendratno@gmail.com</p>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- About Section End -->


<div id="copyright">
    <div class="container">
        <div class="col-md-10"><p>© 2017-2021 CBT. All rights reserved. Theme by <a href="http://graygrids.com">GrayGrids</a></p></div>
        <div class="col-md-2">
            <span class="to-top pull-right"><a href="#hero-area"><i class="fa fa-angle-up fa-2x"></i></a></span>
        </div>
    </div>
</div>
<!-- Copyright Section End-->

<!-- Bootstrap JS -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<!-- Smooth Scroll -->
<script src="<?php echo base_url();?>assets/js/smooth-scroll.js"></script>
<script src="<?php echo base_url();?>assets/js/lightbox.min.js"></script>

<!-- All JS plugin Triggers -->
<script src="<?php echo base_url();?>assets/js/main.js"></script>

<script src="<?php echo base_url(); ?>assets/admin/js/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript">

    $(document).on('keypress', 'input', function(e) {

        if(e.keyCode == 13 && e.target.type !== 'submit') {
            e.preventDefault();
            signin();
        }


        $(".passwordshow").on('click',function() {
            var $pwd = $("#reg-password");
            if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
            } else {
                $pwd.attr('type', 'password');
            }
        });

    });

    function signin() {

        $('.status').empty();
        var username = $('#reg-email').val();
        var password = $('#reg-password').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>auth/signin',
            data:'username='+username+'&password='+password,
            dataType:'json',

            /**
             * Fungsi Retry
             */
            tryCount : 0,
            retryLimit : 3,
            error : function(xhr, textStatus, errorThrown ) {
                if (textStatus == 'timeout') {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        //try again
                        $.ajax(this);
                        return;
                    }
                    return;
                }
                if (xhr.status == 500) {
                    //handle error
                    console.log('Error 500, Terjadi gangguan server!');
                } else {
                    //handle error
                }
            },
            beforeSend: function () {
                $("input").attr('disabled','disabled');
                $("button").attr('disabled','disabled');

                $('.status').html('<div class="alert alert-warning" role="alert">Loading ...</div>');
                $('#loading_ajax').show();
            },
            error:function (hasil) {
                $('#reg-email').val("");
                $('#reg-password').val("");

                $('.status').empty();
                $("input").removeAttr('disabled');
                $("button").removeAttr('disabled');

                $('#loading_ajax').fadeOut("slow");
                swal({
                    title: "Gagal!",
                    text: "Gagal melakukkan login!",
                    icon: "error",
                    button: true,
                });

            },
            success: function (hasil) {

                $('#loading_ajax').fadeOut("slow");
                $('.status').html(hasil.pesan);
                if(hasil.pesan == ''){
                    swal({
                        title: "Berhasil!",
                        text: "Sedang di dialihkan, Tunggu beberapa saat!",
                        icon: "success",
                        button: false,
                    });

                }else{
                    $("input").removeAttr('disabled');
                    $("button").removeAttr('disabled');
                }
                $('#loading_ajax').fadeOut("slow");

                if( hasil.redirect != null ){
                    setTimeout(function () {
                        window.location.assign("<?php echo base_url();?>"+hasil.redirect);
                    },2000);
                }
            }
        });
    }
</script>


<!--

<div class="modal fade login modal-fullscreen" id="formLogin" tabindex="-1" role="dialog" aria-labelledby="formLogin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-scroll">

            <div class="container-fluid">

                <div class="row">


                    <div class="feature-login hidden-md hidden-sm hidden-xs hidden-xxs col-lg-4 col-md-4">
                        <div class="wrap-fit overlay">
                            <div class="overlay"></div>
                            <div class="logo-login-page">
                            </div>
                            <span class="text-feature-login text-white">
                                <img src="<?php echo base_url(); ?>assets/images/logocbt.ico" style="width: 40px" alt="cbt sekolah">
                                <br><br>
<b class="font-size-18">CBT Sekolah</b><br>
<p>Rencanakan aktivitas Anda dan kendalikan kemajuan Anda secara online.</p>
</span>
                        </div>
                    </div>


                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="logo-login-mobile hidden-lg">
                                    <img src="<?php echo base_url(); ?>assets/images/logocbt.ico" alt="cbt sekolah">
                                </div>
                            </div>
                            <div class="col-lg-11 col-md-7">
                                <div class="box-singup">
                                    <span class="font-m-light font-size-12 hidden-sm hidden-xs">Anda peserta ujian? Silahkan kunjungi link berikut </span><a target="_blank" href="<?php echo base_url(); ?>auth/client"><button class="btn btn-singup-outline btn-sm font-m-normal">Masuk ke area!</button></a> <button class="btn btn-singup-outline btn-sm font-m-normal" data-dismiss="modal" aria-label="Close">Batal</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-offset-3 col-xl-3 col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-5 col-xs-12" style="margin-top: 40px;">
                            <div class="mar_top4 hidden-sm hidden-xs"></div>
                            <div class="mar_top4 hidden-sm hidden-xs"></div>
                            <div class="mar_top4 hidden-sm hidden-xs"></div>
                            <div class="mar_top4 hidden-sm hidden-xs"></div>
                            <div class="mar_top_countdown"></div>
                            <h3 class="font-m-light">Login Member Area</h3>
                            <div class="mar_top2"></div>
                            <div class="status"></div>
                            <div class="mar_top2"></div>

                            <form method="POST" action="<?php echo base_url();?>" id="client-login-form">
                                <div class="form-group step1">
                                    <label class="control-label" for="reg-email">Username</label>

                                    <div class="input-group">

                                        <input id="reg-email" class="form-control" type="text" required="required" name="username" placeholder="Masukkan Username Anda">

                                        <div class="input-group-btn">
                                            <span class="btn btn-default">
                                            <i class="glyphicon glyphicon-search"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group step1">
                                    <label class="control-label" for="reg-password">Password</label>
                                    <div class="input-group">
                                        <input id="reg-password" class="form-control pwd" type="password" required="required" name="password" placeholder="Masukkan Password Anda">

                                        <div class="input-group-btn">
                                            <span class="btn btn-default passwordshow">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" name="step" value="1">
                                <div class="form-group  step1">

                                    <button onclick="signin()" type="button" id="btn-tambah" class="btn btn-block btn-success">MASUK</button>

                                </div>


                            </form>
                            <div class="step1">
                                <div class="mar_top2" style="border-bottom: 1px solid #dbdbdb;"></div>
                                <div class="mar_top2"></div>

                            </div>
                        </div>
                        <div class="mar_top5"></div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade login modal-fullscreen" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-scroll">
            <div class="modal-header">
                <button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fas fa-times"></span>
                </button>
            </div>
            <div class="row no-gutters">
                <div class="col-md-6 d-flex">
                    <div class="modal-body p-5 img d-flex color-1 text-center d-flex align-items-center">
                        <div class="text w-100">
                            <span class="icon-2 ion-ios-beer"></span>
                            <h5>Rencanakan aktivitas Anda dan kendalikan kemajuan Anda secara online</h5>
                            <div class="icon">
                                <img alt="Brand" src="<?php echo base_url();?>assets/images/logocbt.ico" style="padding: 0; height: 60px">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="modal-body p-5 img d-flex align-items-center color-2">
                        <div class="text w-100 py-0 py-md-5">
                            <h3 class="mb-4">Masuk dengan Akun Anda</h3>
                            <form method="POST" action="<?php echo base_url();?>">

                                <div class="status"></div>





                                <div class="form-group">
                                    <label>Username <span style="color: red">*</span> :</label>
                                    <div class="input-group input-group-lg">
                                        <input class="form-control" type="text" name="username" id="username" placeholder="Masukan Username" value="" />
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Password <span style="color: red">*</span> :</label>
                                    <div class="input-group input-group-lg">
                                        <input type="password" name="password" id="password"   class="form-control pwd" value="">
                                        <span class="input-group-btn">
            <button class="btn btn-default passwordshow" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
          </span>
                                    </div>

                                </div>


                                <div class="text-right">
                                    <button onclick="signin()" type="button" id="btn-tambah" class="btn btn-lg btn-block btn-success">MASUK</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->

<style type="text/css">
    /**
       MODAL DIALOG CUSTOM
        */
    .modal-title {
        line-height: 2;
    }

    .modal-fullscreen .modal-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10;
        background-color: rgba(243, 243, 243, 1);
        border-bottom: 2px solid rgba(76, 76, 76, 0.1);
    }

    .modal-fullscreen .modal-body {
        padding-top: 80px;
    }

    .modal-fullscreen {
        padding: 0 !important;
    }
    .modal-fullscreen .modal-dialog {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }
    .modal-fullscreen .modal-content {
        position:relative;
        height: 100%;
        min-height: 100%;
        border: 0 none;
        border-radius: 0;
        box-shadow: none;
    }

    .modal-fullscreen .modal-footer {
        bottom: 0;
        position: absolute;
        width: 100%;
    }

    .modal-content-scroll{
        overflow-y: auto;
    }

    @media (min-height: 500px) {
        .modal-content-scroll { height: 1000px; }
    }

    @media (min-height: 800px) {
        .modal-content-scroll { height: 1600px; }
    }



</style>

<style>
    .text-white {
        color: #fff!important;
    }
    .wrap-fit{position: fixed; height: 100%; width: 460px; left: 0; background: url(<?php echo base_url(); ?>assets/images/utama.jpg); background-size: cover; }
    .wrap-fit .overlay {background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%; }
    .box-singup{margin-top:30px;float: right;}
    .btn-singup-outline{border-radius:25px;background-color:transparent;color:#4d4d4d;border:1px solid #4d4d4d;font-family:'Montserrat-bold',sans-serif;margin-left:15px}
    .login-sosmed{box-sizing:border-box;position:relative;margin:.2em;padding:0 15px 0 46px;border:none;text-align:left;line-height:34px;white-space:nowrap;border-radius:.2em;font-size:16px;color:#FFF}
    .login-sosmed:before{content:"";box-sizing:border-box;position:absolute;top:0;left:0;width:34px;height:100%}
    .login-sosmed:focus{outline:none}
    .login-sosmed:active{box-shadow:inset 0 0 0 32px rgba(0,0,0,0.1)}
    .loginBtn--facebook{background-color:#4C69BA;background-image:linear-gradient(#4C69BA,#3B55A0);text-shadow:0 -1px 0 #354C8C}
    .loginBtn--facebook:before{border-right:#364e92 1px solid;background:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png) 6px 6px no-repeat}
    .loginBtn--facebook:hover,.loginBtn--facebook:focus{background-color:#5B7BD5;background-image:linear-gradient(#5B7BD5,#4864B1)}
    .btn-social{position:relative;padding-left:44px;text-align:center;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.btn-social>:first-child{position:absolute;left:0;top:0;bottom:0;width:32px;line-height:34px;font-size:1.6em;text-align:center;border-right:1px solid rgba(0,0,0,0.2)}
    .btn-social.btn-lg{padding-left:61px}.btn-social.btn-lg>:first-child{line-height:45px;width:45px;font-size:1.8em}
    .btn-social.btn-sm{padding-left:61px;text-align: center;height: 37px;padding-top: 9px;}.btn-social.btn-sm>:first-child{width:40px;font-size:1.5em}
    .btn-social.btn-xs{padding-left:30px}.btn-social.btn-xs>:first-child{line-height:20px;width:20px;font-size:1.2em}
    .btn-social-icon{position:relative;padding-left:44px;text-align:left;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;height:34px;width:34px;padding:0}.btn-social-icon>:first-child{position:absolute;left:0;top:0;bottom:0;width:32px;line-height:34px;font-size:1.6em;text-align:center;border-right:1px solid rgba(0,0,0,0.2)}
    .btn-social-icon.btn-lg{padding-left:61px}.btn-social-icon.btn-lg>:first-child{line-height:45px;width:45px;font-size:1.8em}
    .btn-social-icon.btn-sm{padding-left:38px}.btn-social-icon.btn-sm>:first-child{line-height:28px;width:28px;font-size:1.4em}
    .btn-social-icon.btn-xs{padding-left:30px}.btn-social-icon.btn-xs>:first-child{line-height:20px;width:20px;font-size:1.2em}
    .btn-social-icon>:first-child{border:none;text-align:center;width:100% !important}
    .btn-social-icon.btn-lg{height:45px;width:45px;padding-left:0;padding-right:0}
    .btn-social-icon.btn-sm{height:30px;width:30px;padding-left:0;padding-right:0}
    .btn-social-icon.btn-xs{height:22px;width:22px;padding-left:0;padding-right:0}
    .btn-facebook{color:#fff;background-color:#3b5998;border-color:rgba(0,0,0,0.2)}.btn-facebook:focus,.btn-facebook.focus{color:#fff;background-color:#2d4373;border-color:rgba(0,0,0,0.2)}
    .btn-facebook:hover{color:#fff;background-color:#2d4373;border-color:rgba(0,0,0,0.2)}
    .btn-facebook:active,.btn-facebook.active,.open>.dropdown-toggle.btn-facebook{color:#fff;background-color:#2d4373;border-color:rgba(0,0,0,0.2)}.btn-facebook:active:hover,.btn-facebook.active:hover,.open>.dropdown-toggle.btn-facebook:hover,.btn-facebook:active:focus,.btn-facebook.active:focus,.open>.dropdown-toggle.btn-facebook:focus,.btn-facebook:active.focus,.btn-facebook.active.focus,.open>.dropdown-toggle.btn-facebook.focus{color:#fff;background-color:#23345a;border-color:rgba(0,0,0,0.2)}
    .btn-facebook:active,.btn-facebook.active,.open>.dropdown-toggle.btn-facebook{background-image:none}
    .btn-facebook.disabled:hover,.btn-facebook[disabled]:hover,fieldset[disabled] .btn-facebook:hover,.btn-facebook.disabled:focus,.btn-facebook[disabled]:focus,fieldset[disabled] .btn-facebook:focus,.btn-facebook.disabled.focus,.btn-facebook[disabled].focus,fieldset[disabled] .btn-facebook.focus{background-color:#3b5998;border-color:rgba(0,0,0,0.2)}
    .btn-facebook .badge{color:#3b5998;background-color:#fff}
    .btn-google{color:#fff;background-color:#dd4b39;border-color:rgba(0,0,0,0.2)}.btn-google:focus,.btn-google.focus{color:#fff;background-color:#c23321;border-color:rgba(0,0,0,0.2)}
    .btn-google:hover{color:#fff;background-color:#c23321;border-color:rgba(0,0,0,0.2)}
    .btn-google:active,.btn-google.active,.open>.dropdown-toggle.btn-google{color:#fff;background-color:#c23321;border-color:rgba(0,0,0,0.2)}.btn-google:active:hover,.btn-google.active:hover,.open>.dropdown-toggle.btn-google:hover,.btn-google:active:focus,.btn-google.active:focus,.open>.dropdown-toggle.btn-google:focus,.btn-google:active.focus,.btn-google.active.focus,.open>.dropdown-toggle.btn-google.focus{color:#fff;background-color:#a32b1c;border-color:rgba(0,0,0,0.2)}
    .btn-google:active,.btn-google.active,.open>.dropdown-toggle.btn-google{background-image:none}
    .btn-google.disabled:hover,.btn-google[disabled]:hover,fieldset[disabled] .btn-google:hover,.btn-google.disabled:focus,.btn-google[disabled]:focus,fieldset[disabled] .btn-google:focus,.btn-google.disabled.focus,.btn-google[disabled].focus,fieldset[disabled] .btn-google.focus{background-color:#dd4b39;border-color:rgba(0,0,0,0.2)}
    .btn-google .badge{color:#dd4b39;background-color:#fff}
    .btn-twitter{color:#fff;background-color:#55acee;border-color:rgba(0,0,0,0.2)}.btn-twitter:focus,.btn-twitter.focus{color:#fff;background-color:#2795e9;border-color:rgba(0,0,0,0.2)}
    .btn-twitter:hover{color:#fff;background-color:#2795e9;border-color:rgba(0,0,0,0.2)}
    .btn-twitter:active,.btn-twitter.active,.open>.dropdown-toggle.btn-twitter{color:#fff;background-color:#2795e9;border-color:rgba(0,0,0,0.2)}.btn-twitter:active:hover,.btn-twitter.active:hover,.open>.dropdown-toggle.btn-twitter:hover,.btn-twitter:active:focus,.btn-twitter.active:focus,.open>.dropdown-toggle.btn-twitter:focus,.btn-twitter:active.focus,.btn-twitter.active.focus,.open>.dropdown-toggle.btn-twitter.focus{color:#fff;background-color:#1583d7;border-color:rgba(0,0,0,0.2)}
    .btn-twitter:active,.btn-twitter.active,.open>.dropdown-toggle.btn-twitter{background-image:none}
    .btn-twitter.disabled:hover,.btn-twitter[disabled]:hover,fieldset[disabled] .btn-twitter:hover,.btn-twitter.disabled:focus,.btn-twitter[disabled]:focus,fieldset[disabled] .btn-twitter:focus,.btn-twitter.disabled.focus,.btn-twitter[disabled].focus,fieldset[disabled] .btn-twitter.focus{background-color:#55acee;border-color:rgba(0,0,0,0.2)}
    .btn-twitter .badge{color:#55acee;background-color:#fff}
    /*.feature-login-img{opacity:.2;display:block;width:100%;height:100%;transition:.5s ease;backface-visibility:hidden;}*/
    /*.feature-login{-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;top:0;left:0;width:460px;min-height:850px;height:100%;overflow:hidden;background:#232323;float:left;margin-left:-15px;text-align:center;}*/
    .logo-login-page{position:absolute;top:25px;left:20%;width:460px}
    .logo-login-page img{height:32px}
    .text-feature-login{position:absolute;width:460px;top:50%;left:0;text-align:center;padding:75px;font-size:13px}
    .btn-singup-outline-wh{border-radius:25px;background-color:transparent;color:#fff;border:1px solid #fff;font-family:'Montserrat-bold',sans-serif;margin-left:15px}
    .btn-singup-outline-wh:hover{background:#fff;color:#298eea!important}
    .btn-singup-outline:hover{background:#298eea;color:#fff!important;border:1px solid #298eea}
    .logo-login-mobile{float:left;margin-left:0%;margin-top: 30px;}
    .logo-login-mobile img{height:28px}
    @media screen and (max-width: 320px) {
        .btn{padding:8px 17px!important}
        .btn-twitter{margin-bottom:30px}
        .countdown-button{padding-left: 5px!important;}
    }
    @media (max-width: 1050px) and (min-width: 1000px) {
        .col-sm-offset-4{margin-left:33.33333333%}
        .col-sm-5{width:41.66666667%}
    }
    @media only screen and (max-width: 1365px) {
        /*#countdown-promo {display: none;}*/
        .mar_top_countdown {margin-top: 20px;}
    }
    .box-lds{display:none;position:fixed;top:0;width:100%;height:100%;background-color:#000;opacity:.5;-webkit-opacity:.5;-moz-opacity:.5;filter:alpha(opacity=50);z-index:1060}
    .lds-ripple{display:block;position:absolute;top:50%;left:50%;width:64px;height:64px}
    .lds-loading{display:block;position:absolute;top:57%;left:49%;width:120px;height:64px}
    .lds-ripple div{position:absolute;border:4px solid #cef;opacity:1;border-radius:50%;animation:lds-ripple 1s cubic-bezier(0,0.2,0.8,1) infinite}
    .lds-ripple div:nth-child(2){animation-delay:-.5s}
    @keyframes lds-ripple {
        0%{top:28px;left:28px;width:0;height:0;opacity:1}
        100%{top:-1px;left:-1px;width:58px;height:58px;opacity:0}
    }
</style>


</body>
</html>