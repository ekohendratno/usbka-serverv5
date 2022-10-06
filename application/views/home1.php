
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
                    <?php if($this->session->userdata('level') == ('admin'||'guru')){?>
                        <li><a href="<?php echo base_url(). 'auth/profile';?>">Hallo, <?php echo $this->session->userdata('username');?></a></li>
                        <li><a href="<?php echo base_url(). $this->session->userdata('level').'/dashboard'; ?>"><span class="glyphicon glyphicon-dashboard"></span></li></a>
                    <?php }?>
                    <?php if(!empty($this->session->userdata('level'))){?>
                        <li><a href="<?php echo base_url().'auth/logout'; ?>"><div class="btn btn-md btn-danger" style="padding: 1px 7px; margin-top: -5px; border-radius:30px;">Logout</div></li></a>
                    <?php }else{?>
                        <li><a class="nav-link" style="cursor: pointer"data-toggle="modal" data-target="#loginModal"><div class="btn btn-md btn-success" style="padding: 1px 7px; margin-top: -5px; border-radius:30px;">Login</div></li></a>
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

    });

    function signin() {

        $('.status').empty();
        var username = $('#username').val();
        var password = $('#password').val();
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
                $('#username').val("");
                $('#password').val("");

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

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="loginModal">LOGIN AKUN
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button></h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url();?>">

                    <div class="status"></div>

                    <div class="form-group form-group-lg">
                        <input type="input" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class="form-group form-group-lg">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <div class="of-input-validation lpassword-toggle-btn show-password"></div>
                    </div>

                    <div class="text-right">
                        <button onclick="signin()" type="button" id="btn-tambah" class="btn btn-lg btn-block btn-success">MASUK</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>