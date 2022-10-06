<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMKN1CDP CBT | Ujian Sekolah Berbasis Komputer Android!</title>
    <script src="<?php echo base_url('assets/admin/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/sweetalert/sweetalert.min.js"></script>
    <link rel='dns-prefetch' href='<?php echo base_url();?>' />
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/login.css') ?>" rel="stylesheet">
    <script type="text/javascript">

        $(document).on('keypress', 'input', function(e) {

            if(e.keyCode == 13 && e.target.type !== 'submit') {
                e.preventDefault();
                signin();
            }



            $(".passwordshow").on('click',function() {
                var $pwd = $(".pwd");
                if ($pwd.attr('type') === 'password') {
                    $pwd.attr('type', 'text');
                } else {
                    $pwd.attr('type', 'password');
                }
            });

        });

        function signin() {

            $('.status').empty();
            var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>auth/signinclient',
                data:'username='+username+'&password='+password,
                dataType:'json',
                beforeSend: function () {
                    $("input").attr('disabled','disabled');
                    $("button").attr('disabled','disabled');

                    $('.status').html('<div class="alert alert-warning" role="alert">Loading ...</div>');
                    $('#loading_ajax').show();
                },
                success: function (hasil) {
                    console.log(hasil);

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

        $( document ).ready(function() {
            $('#versibaru').modal('show');
        });
    </script>
    <style type="text/css">

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

        .btn-dl{
            margin-bottom: 10px;
        }
    </style>
</head>

<body>


<div class="modal fade modal-fullscreen" id="versibaru" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Informasi
                    <div class="pull-right">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </h4>
            </div>
            <div class="modal-body text-left">

                <div class="center">

                    <div class="col-md-offset-4 col-md-4">
                        <p>
                            Informasi versi terbaru telah tersedia, versi terbaru semakin ringan dan cepat dalam merespon setiap tindakan dan meminimalisir
                            dari segala kesalahan peserta, serta merasakan pengalaman baru dalam tampilan yang baru<br /><br />
                            Untuk dapat mencoba versi terbaru anda bisa lakukkan cara berikut:<br>
                        <ol>
                            <li>Buka Browser Chrome</li>
                            <li>Buka Alamat "<strong>http://cbt.smkn1candipuro.sch.id</strong>"</li>
                            <li>Klik tombol "<strong>Client Android</strong>"</li>
                            <li>Lalu klik tombol download "<strong>Versi Beta</strong>" dan lakukkan install ulang aplikasi cbt</li>
                        </ol>
                        </p>
                        <p>Informasi ini sifatnya tidak wajib, jadi Anda dapat melanjutkan aktifitas seperti biasanya atau Anda bisa mencobanya lain waktu.</p>


                        <div class="row">
                            <br><br>
                            <div class="col-md-12 btn-dl">
                                <a href="#" class="btn btn-default btn-lg btn-block" data-dismiss="modal">Ok, Trimakasih infonya!</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="container-full">

    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 text-center" style="margin-top: 40px;">
        <img src="<?php echo base_url();?>assets/images/cbt_text.png" width="120px"/>
        <h4 class="pt-2">Ujian Sekolah Berbasis Komputer dan Android</h4>
    </div>
    <div id="loginbox" class="mainbox col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default" >
            <div class="panel-body">

                <div class="of-elegant-modal show">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 px-0">
                                <div class="text-center" style="margin-bottom: 8px">
                                    <h3 class="pt-2">Selamat Datang,</h3>Silahkan login dengan username dan password yang telah anda dapat.
                                </div>

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

                                <br class="clear"/>
                                <!--<a class="of-signup-link of-toggle-link pb-2" href="#">Don't have an account yet? Sign Up!</a>-->
                            </div> <!--End .col-lg-6 -->
                        </div> <!--End .row -->
                    </div> <!--End .container-fluid -->
                </div>

            </div>

        </div>
    </div>


</div>


</body>
</html>
