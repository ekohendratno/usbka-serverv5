<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link href="<?php echo base_url('assets/admin/css/soal.css') ?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/admin/js/tinymce/tinymce.min.js');?>"></script>

    <script src="<?php echo base_url('assets/admin/js/jquery-ui-timepicker-addon.min.js')?>"></script>
    <link href="<?php echo base_url('assets/admin/css/jquery-ui-timepicker-addon.min.css')?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/admin/js/bootstrap-select.min.js')?>"></script>
    <link href="<?php echo base_url('assets/admin/css/bootstrap-select.min.css')?>" rel="stylesheet" />

    <style type="text/css">
        /* width */
        ::-webkit-scrollbar {
            width: 4px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .btn {
            padding: 6px 6px;
        }
        .feather {
            width: 24px;
            height: 24px;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
        }

        .modal-header {
            padding: 8px 15px;
        }
        .navbar-inverse{background-color:  #778E99; border-color: #778E99}
        .navbar-inverse .navbar-brand {
            color: #f2f2f2;
        }
        .navbar-inverse .navbar-nav>li>a {
            color: #f2f2f2;
        }
        .panel-title-button a.btn {
            color: #f2f2f2;
        }

        .inset {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-top: 7px;
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

        #Notifikasi {
            cursor: pointer;
            position: fixed;
            bottom:0;
            right: 0;
            z-index: 9999;
            margin-bottom: 15px;
            margin-right: 15px;
            min-width: 300px;
            max-width: 800px;
        }

        .bootstrap-tagsinput{
            display: block;
        }


        a:hover .icon{
            color:#1ba1ea;
        }
        a:hover{
            text-decoration: none;
        }
        .dashboard-circle{
            padding: 10px;
            margin: auto;
            background-color: #f2f2f2;
            border-radius: 120px;
            width: 120px;
            height: 120px;
            text-align: center;
        }

        .list-group-item:hover {
            background-color: #f5f5f5;
        }
    </style>
    <style id="jsbin-css">
        .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover{
            background: transparent;
            color: #fff;

        }

        .navbar-nav.nav .dropdown-menu {
        }

        .navbar-nav.nav .dropdown-menu > li > a {
        }




    </style>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";




        tinyEditor();
        function tinyEditor(){
            //tinymce 5
            tinyMCE.init({
                selector: "textarea.tinyEditor",
                content_style: "body {font-size: 14pt;}",
                height : 200,
                max_height: 500,
                min_height: 200,
                menubar: false,
                statusbar:false,
                setup: function (editor) {
                    editor.ui.registry.addContextToolbar('imagealignment', {
                        predicate: function (node) {
                            return node.nodeName.toLowerCase() === 'img'
                        },
                        items: 'alignleft aligncenter alignright',
                        position: 'node',
                        scope: 'node'
                    });

                    editor.ui.registry.addContextToolbar('textselection', {
                        predicate: function (node) {
                            return !editor.selection.isCollapsed();
                        },
                        items: 'removeformat bold italic underline strikethrough forecolor alignleft aligncenter alignright alignjustify',
                        position: 'selection',
                        scope: 'node'
                    });
                },
                plugins: 'autoresize print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help code ', //tiny_mce_wiris
                toolbar: 'image media bullist numlist table code codesample help', //  tiny_mce_wiris tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry
                image_advtab: true,
                convert_fonts_to_spans: true,
                paste_webkit_styles: "color font-size",
                paste_word_valid_elements: "b,strong,i,em,h1,h2,u,p,ol,ul,li,a[href],span,color,font-size,font-color,font-family,mark",
                paste_retain_style_properties: "all",
                paste_data_images: true,
                images_upload_url: '<?php echo base_url();?>admin/soal/uploadfile',

                //relative_urls: true,
                relative_urls: false,
                remove_script_host: false,

                // override default upload handler to simulate successful upload
                images_upload_handler: function (blobInfo, success, failure) {

                    var xhr, formData;

                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '<?php echo base_url();?>admin/soal/uploadfile');

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
                },
                file_picker_types: 'media',
                file_picker_callback: function(callback, value, meta) {
                    // File type
                    if ( meta.filetype =="media" ) {

                        // Trigger click on file element
                        jQuery("#fileupload").trigger("click");
                        $("#fileupload").unbind('change');
                        // File selection
                        jQuery("#fileupload").on("change", function() {
                            var file = this.files[0];
                            var reader = new FileReader();

                            // FormData
                            var fd = new FormData();
                            var files = file;
                            fd.append("file",files);
                            fd.append('filetype',meta.filetype);

                            var filename = "";

                            // AJAX
                            jQuery.ajax({
                                url: "<?php echo base_url();?>admin/soal/uploadfile",
                                type: "post",
                                data: fd,
                                contentType: false,
                                processData: false,
                                async: false,
                                success: function(response){
                                    filename = response;
                                }
                            });

                            reader.onload = function(e) {
                                callback(filename);
                            };
                            reader.readAsDataURL(file);
                        });
                    }

                }
            });
        }
    </script>
</head>
<body id="body">

<div id="Notifikasi"></div>
<div id="loading_ajax"><center style="padding:20px;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></center></div></div>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">

        <div class="navbar-header" style="padding-left:20px;">

            <?php if($this->uri->segment(2) == 'dashboard'){?>
                <a class="navbar-brand" href="<?php echo base_url().$this->uri->segment(1);?>/dashboard">
                    <img alt="CBT" src="<?php echo base_url();?>assets/images/logocbt.ico" style="margin-top: -5px; padding: 0; height: 30px">
                </a>
            <?php }?>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if($this->uri->segment(2) != 'dashboard'){?>
                    <li><a href="<?php echo base_url().$this->uri->segment(1);?>/dashboard"><span class="fas fa-arrow-left"></span></a></li>
                <?php }else{?>


                <?php }?>
            </ul>


            <ul class="nav navbar-nav navbar-right" style="padding-right:20px;">

                <li><a href="<?php echo base_url().'index.php/auth/profile';?>">Hallo, <?php echo $this->session->userdata('username');?></a></li>


                <?php if($this->session->userdata('level') == "guru"){?>
                    <li><a href="<?php echo base_url();?>guru/soal"><i class='fa fa-file-word fa-fw'></i> Bank Soal</a></li>
                    <li><a href="<?php echo base_url();?>guru/ujian"><i class='fa fa-paper-plane fa-fw'></i> Diujikan</a></li>
                <?php }?>

                <?php if($this->session->userdata('level') == "admin"){?>
                    <li><a href="<?php echo base_url().'index.php/admin/pesan'; ?>" title="Notifikasi"><span class="fas fa-bell"></span></li></a>
                    <li><a href="<?php echo base_url().'index.php/admin/overview'; ?>" title="Overview Server"><span class="fas fa-server"></span></li></a>
                    <li><a href="<?php echo base_url().'index.php/admin/pengaturan'; ?>" title="Pengaturan"><span class="fas fa-cog"></span></li></a>
                <?php }?>

                <li><a href="<?php echo base_url().'index.php'; ?>" target="_blank" title="Lihat Situs"><span class="fas fa-share-alt"></span></li></a>
                <li onclick="aksiLogout()"><a href="javascript:void(0);" title="Logout"><span class="fas fa-power-off"></span></a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<?php echo $contents ?>


<footer class="footer container">

    <section class="col-sm-12" style="margin-top: 50px;">
        <div class="col-lg-10 col-lg-offset-1 text-center">
            <hr class="medium">
            <p class="text-muted" style="font-size: 12px;">Copyright &copy; 2018. Versi 4. Powered by <a href="https://berkarya.kopas.id/">@KopasProjects</a></p>
        </div>
    </section>
</footer>
<script id="jsbin-javascript">

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

    $('.dropdown-toggle').click(function () {

        if (!$(this).parent().hasClass('open')) {

            $('html').addClass('menu-open');

        } else {

            $('html').removeClass('menu-open');


        }

    });


    <?php if($this->uri->segment(2) != 'dashboard'){?>
    $('.navbar-right').attr("style", "display:none;");
    $('.panel-title-button').attr("style", "display:block; margin-top:8px;margin-right:15px;");
    $('.panel-title-button').detach().prependTo( $('#bs-example-navbar-collapse-1') );


    $('.panel-footer-button').detach().prependTo( $('.modal__footer') );
    //$('.panel-heading').remove();
    <?php }?>


    $(document).on('click touchstart', function (a) {
        if ($(a.target).parents().index($('.navbar-nav')) == -1) {
            $('html').removeClass('menu-open');
        }
    });


</script>

<div class="modal" id="ModalGue" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class='fa fa-times'></i></button>
                <h4 class="modal-title" id="ModalHeader"></h4>
            </div>
            <div class="modal-body" id="ModalContent"></div>
            <div class="modal-footer" id="ModalFooter"></div>
        </div>
    </div>
</div>

<style>
    .tox-tinymce {
        border: 1px solid #ccc;
        border-radius: 0px;
    }
</style>
<script>
    feather.replace()
</script>

</body>
</html>
