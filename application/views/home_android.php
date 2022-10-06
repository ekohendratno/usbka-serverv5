
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="E-Ujian">
    <meta name="description" content="Ujian online tanpa ribet! ">
    <title>SMKN1CDP CBT | Ujian Sekolah Berbasis Komputer Android! </title>

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
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/extras/animate.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/extras/lightbox.css">

    <!--Icon Fonts-->
    <script defer src="<?php echo base_url(); ?>assets/fontawesome/js/all.js"></script>
    <!-- jQuery Load -->
    <script src="<?php echo base_url();?>assets/js/jquery-min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">


        .row {
            padding-bottom: 0;
        }

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
                    <li><a href="<?php echo base_url();?>#hero-area">Beranda</a></li>
                    <li><a href="<?php echo base_url();?>#fitur">Fitur</a></li>
                    <li><a href="<?php echo base_url();?>#kelebihan">Kelebihan</a></li>
                    <li><a href="<?php echo base_url();?>#about">Kontak</a></li>
                    <?php if($this->session->userdata('user_level') == 'admin'){?>
                        <li><a href="<?php echo base_url().'auth/profile';?>">Hallo, <?php echo $this->session->userdata('username');?></a></li>
                        <li><a href="<?php echo base_url().'admin/dashboard'; ?>"><span class="glyphicon glyphicon-dashboard"></span></li></a>
                        <li><a href="<?php echo base_url().'auth/logout'; ?>" target="_blank"><span class="glyphicon glyphicon-log-in"></span></li></a>
                    <?php }else{?>
                        <li><a href="<?php echo base_url().'auth'; ?>"><div class="btn btn-sm btn-success" style="padding: 1px 7px; border-radius: 3px;">Login</div></li></a>
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
                <h2 class="subtitle branded">Android versi terbaru!</h2>

                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 animated delay-0-5">
                    <p>
                        Versi terbaru semakin ringan dan cepat dalam merespon setiap kesalahan dan meminimalisir
                        dari segala kecurangan peserta<br /><br />
                        Untuk dapat memulai, silakan klik tombol di bawah ini!<br>
                        <i>Versi ini kemungkinan tidak stable karna masih terdapat banyak bug.</i><br><br>

                        <a href='<?php echo $this->config->item('serverapi1'); ?>uploads/autoupdate/cbt304.apk' class="btn btn-primary btn-lg btn-block">Unduh Versi Beta 2</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Hero Area Section End-->


<!-- About Section -->

<section id="about" style="background-color: #ffffff; color: #4d4d4d">
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
        <div class="col-md-10"><p>© 2017-2021 SMKN1CDP CBT. All rights reserved. Theme by <a href="http://graygrids.com">GrayGrids</a></p></div>
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

</body>
</html>