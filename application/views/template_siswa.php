<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no" />

	<title><?php echo $title?></title>


    <script src="<?php echo base_url('assets/admin/js/jquery.min.js') ?>"></script>

    <script src="<?php echo base_url('assets/admin/js/jquery-ui.js') ?>"></script>
    <link href="<?php echo base_url('assets/admin/css/jquery-ui.css') ?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/admin/js/fm.tagator.jquery.js') ?>"></script>
    <link href="<?php echo base_url('assets/admin/css/fm.tagator.jquery.css') ?>" rel="stylesheet">

    <script defer src="<?php echo base_url('assets/admin/js/fontawesome/js/all.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/sweetalert/sweetalert.min.js'); ?>"></script>

    <link rel="icon" type="image/ico" href="<?php echo base_url('assets/images/logocbt.ico') ?>">
    <link rel='dns-prefetch' href='<?php echo base_url();?>' />

    <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js') ?>"></script>
    <link href="<?php echo base_url('assets/admin/css/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/admin/css/custom.css') ?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/admin/js/jquery-ui-timepicker-addon.min.js')?>"></script>
    <link href="<?php echo base_url('assets/admin/css/jquery-ui-timepicker-addon.min.css')?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/admin/js/bootstrap-select.min.js')?>"></script>
    <link href="<?php echo base_url('assets/admin/css/bootstrap-select.min.css')?>" rel="stylesheet" />

	<style type="text/css">
      	.navbar-inverse{background-color:  #3c4b59;}

        .icon1 {
            font-size: 32px;
            text-align: center;
        }

        .btn-circle {
            border-radius: 40px;
            width: 40px;
            height: 40px;
            line-height: 2;
            margin-left: 5px;
        }
        .btn-circle.btn-sm {
            border-radius: 35px;
            width: 35px;
            height: 35px;
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

        .navbar-collapse {
            border-top: 0px solid transparent;
            -webkit-box-shadow: inset 0 0px 0 rgb(255 255 255 / 10%);
            box-shadow: inset 0 0px 0 rgb(255 255 255 / 10%);
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

        .small-box{
            padding-top:10px;
            padding-bottom:10px;
            color: rgba(45, 45, 45, 0.87);
        }

        .small-box .icon {
            font-size: 50px;
        }
        .small-box:hover .icon {
            font-size: 50px;
        }

        .small-box>.inner {
            padding-top:0px;
            padding-bottom:0px;
            padding-left:10px;
            padding-right:10px;
        }
        .small-box:hover{
            color:#000;
        }
        .bg-light {
            background-color: #f8f9fa!important;
        }
        .bg-dark {
            background-color: #343a40!important;
        }

        span.label {
            padding: 4px;
        }
    </style>
	<style id="jsbin-css">
		.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover{
			background: transparent;
			    color: #fff;

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

	<script type="text/javascript">var base_url = "<?php echo base_url(); ?>";</script>
</head>
<body id="body">
	<div id="loading_ajax"><center style="padding:20px;"><span style="clear:both">Memuat Data...</span></center></div>

	<nav class="navbar <?php if($this->uri->segment(3) == 'mulai'){?>navbar-ujian<?php }else{?>navbar-inverse<?php }?> navbar-fixed-top" role="navigation">
		<div class="<?php if($this->session->userdata('level') == 'siswa'){?>container container-medium<?php }else{?>container-flex<?php }?>">

            <?php if($this->uri->segment(2) == 'dashboard'){?>
                <div class="navbar-header" style="padding-left:20px;">
                    <a class="navbar-brand" href="<?php echo base_url() . $this->session->userdata('level') ;?>/dashboard" title="CBT">
                        <img alt="Brand" src="<?php echo base_url();?>assets/images/logocbt.ico" style="float: left; margin-top: -5px; padding: 0; height: 30px">
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            <?php }?>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<?php if($this->uri->segment(2) != 'dashboard'){?>
					<li><a href="<?php echo base_url() . $this->session->userdata('level') ;?>/dashboard"><span class="glyphicon glyphicon-chevron-left" style="font-size: 14px"></span></a></li>
					<?php }?>
					<?php if($this->session->userdata('level') == 'admin'){?>
                    <?php if($this->uri->segment(2) == 'dashboard'){?>
                    <?php }?>
					<?php }elseif($this->session->userdata('level') == 'guru'){?>
					<?php if($this->uri->segment(2) == 'soal'){?>
					<li><a href="<?php echo base_url();?>guru/soal" title="Soal"><span class="fas fa-file-alt<?php if($this->uri->segment(2) == 'soal'){?> active<?php }?>"></span> Soal</a></li>
                    <?php }?>
                    <?php if($this->uri->segment(2) == 'ujian'){?>
                            <li><a href="<?php echo base_url();?>guru/ujian" title="Ujian"><span class="fas fa-bullhorn<?php if($this->uri->segment(2) == 'ujian'){?> active<?php }?>"></span> Ujian</a></li>
					<?php }}?>
				</ul>
				<ul class="nav navbar-nav navbar-right">

<?php if($this->uri->segment(2) != 'ujian'){?>
					<?php if($this->session->userdata('level') == 'admin'){?>
                        <li><a href="<?php echo base_url().'admin/overview'; ?>" title="Overview"><span class="fas fa-server<?php if($this->uri->segment(2) == 'overview'){?> active<?php }?>"></span></a></li>
					<li><a href="<?php echo base_url().'admin/pesan'; ?>" title="Pesan"><span class="fas fa-comment-dots"<?php if($this->uri->segment(2) == 'pesan'){?> active<?php }?>></span></a></li>
					<li><a href="<?php echo base_url().'admin/pengaturan'; ?>" title="Pengaturan"><span class="fas fa-cog<?php if($this->uri->segment(2) == 'pengaturan'){?> active<?php }?>"></span></a></li>
					<?php }elseif($this->session->userdata('level') == 'guru'){?>
					<li><a href="<?php echo base_url().'guru/pesan'; ?>" title="Pesan"><span class="fas fa-comment-dots<?php if($this->uri->segment(2) == 'pesan'){?> active<?php }?>"></span></a></li>
					<li><a href="<?php echo base_url().'guru/pengaturan'; ?>" title="Pengaturan"><span class="fas fa-cog<?php if($this->uri->segment(2) == 'pengaturan'){?> active<?php }?>"></span></a></li>
					<?php }?>
                    <li>
                        <a href="<?php echo base_url().'auth/profile';?>" title="<?php echo $this->session->userdata('username');?>">Hallo, <?php echo $this->session->userdata('username');?>
                        </a>
                    </li>

    <li onclick="aksiLogout()"><a href="javascript:void(0);" title="Logout"><span class="glyphicon glyphicon-off"></span></a></li>


<?php }?>
                </ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>

    <?php
    $s2 = $this->uri->segment(2);
    $s3 = $this->uri->segment(3);
    function c_e($s2,$s3){

        if( $s2 != 'dashboard'){
            if( $s3 == 'mulai' ){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }

    }
?>
    <?php echo $contents;?><div class="clearfix"></div>
    <footer class="footer container">
        <div class="text-center">
            <div class="text-dark">&copy; <?php echo date('Y');?>.<br>Created by Eko Hendratno, S.Kom</div>
        </div>
    </footer>


    <script type="text/javascript">


        <?php if($this->uri->segment(2) != 'dashboard'){?>
        $('.navbar-right').attr("style", "display:none;");
        $('.panel-title-button').attr("style", "display:block; margin-top:12.5px;margin-right:15px;");
        $('.panel-title-button').detach().prependTo( $('#bs-example-navbar-collapse-1') );
        //$('.panel-heading').remove();
        <?php }?>
        <?php if($this->uri->segment(2) == 'ujian' && $this->uri->segment(3) == 'mulai'){?>
        $('.panel-title-button').attr("style", "display:block; margin-top:5px;");
        <?php }?>


        $('#silit').click(function() {
            var side = $(this).attr('class');
            if(side=="left-btn"){
                $('.toggler .glyphicon').removeClass('.glyphicon glyphicon-chevron-left');
                $('.toggler .glyphicon').addClass('.glyphicon glyphicon-chevron-right');
                $(this).removeClass('left-btn');
                $(this).addClass('right-btn');
                $('.toggler').css('right','300px');
                $('.toggler').css('background-color','rgb(119, 142, 154)');
            }else{
                $('.toggler .glyphicon').removeClass('.glyphicon glyphicon-chevron-right');
                $('.toggler .glyphicon').addClass('.glyphicon glyphicon-chevron-left');
                $(this).removeClass('right-btn');
                $(this).addClass('left-btn');
                $('.toggler').css('right','0px');
                $('.toggler').css('background-color','rgb(119, 142, 154,0.3)');
            }
        });

        var didScroll = false;
        // on scroll, let the interval function know the user has scrolled
        $(window).scroll(function(event){
            didScroll = true;
        });
        // run hasScrolled() and reset didScroll status
        setInterval(function() {
            if (didScroll) {
                $('nav.navbar').css('box-shadow','2px 2px 2px 2px rgba(0,0,0,.11)');
                didScroll = false;
            }else{
                $('nav.navbar').css('box-shadow','none');
            }
        }, 250);

        $( '.navbar' ).append( '<span class="nav-bg"></span>' );

        $('.dropdown-toggle').click(function () {

          if (!$(this).parent().hasClass('open')) {

             $('html').addClass('menu-open');

          } else {

             $('html').removeClass('menu-open');


          }

        });


        $(document).on('click touchstart', function (a) {
                if ($(a.target).parents().index($('.navbar-nav')) == -1) {
                        $('html').removeClass('menu-open');
                }
        });

        function aksiLogout() {
            swal({
                title: "Keluar?",
                text: "Kamu yakin mau keluar?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.assign("<?php echo base_url();?>auth/logout");
                    }

                });
        }


        /**
        setTimeout(function () {

            window.myVar = setInterval(_statistik_online, 1000);

        },3000);*/

        function _statistik_online() {

            $.ajax({
                type:'POST',
                url:'<?php echo base_url('statistik/online') ;?>',
                dataType: 'json',
                success: function(){}
            });
        }
        //$('#loading_ajax').fadeOut("slow");

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
