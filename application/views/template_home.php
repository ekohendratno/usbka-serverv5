
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
                    <li><a href="<?php echo base_url();?>#hero-area">Beranda</a></li>
                    <li><a href="<?php echo base_url();?>#fitur">Fitur</a></li>
                    <li><a href="<?php echo base_url();?>#kelebihan">Kelebihan</a></li>
                    <li><a href="<?php echo base_url();?>#about">Kontak</a></li>
                    <li><a href="<?php echo base_url();?>arsip">Arsip</a></li>
                    <?php if($this->session->userdata('level') == ('admin'||'guru')){?>
                        <li><a href="<?php echo base_url(). 'auth/profile';?>">Hallo, <?php echo $this->session->userdata('username');?></a></li>
                        <li><a href="<?php echo base_url(). $this->session->userdata('level').'/dashboard'; ?>"><span class="glyphicon glyphicon-dashboard"></span></li></a>
                    <?php }?>
                    <?php if(!empty($this->session->userdata('level'))){?>
                        <li><a href="<?php echo base_url().'auth/logout'; ?>"><div class="btn btn-sm btn-danger" style="padding: 1px 7px; margin-top: -5px; border-radius:30px;">Logout</div></li></a>
                    <?php }else{?>
                        <li><a class="nav-link" style="cursor: pointer" data-toggle="modal" data-target="#formLogin"><div class="btn btn-sm btn-success" style="padding: 1px 7px; margin-top: -5px; border-radius:30px;">Petugas</div></li></a>
                    <?php }?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</div>
<!-- Nav Menu Section End -->


<?php echo $contents;?>


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


</body>
</html>