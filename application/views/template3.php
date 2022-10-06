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

        body {
            padding-top: 0px;
        }

        .btn-dark{
            color: #fff;
            background-color: #343a40;
            border-color: #343a40;
        }

        @media (min-width: 768px){
            .navbar {
                border-radius: 0px;
            }
        }

    </style>



    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,400;0,800;1,400;1,800&display=swap');
        @keyframes swing {
            0% {
                transform: rotate(0deg);
            }
            10% {
                transform: rotate(10deg);
            }
            30% {
                transform: rotate(0deg);
            }
            40% {
                transform: rotate(-10deg);
            }
            50% {
                transform: rotate(0deg);
            }
            60% {
                transform: rotate(5deg);
            }
            70% {
                transform: rotate(0deg);
            }
            80% {
                transform: rotate(-5deg);
            }
            100% {
                transform: rotate(0deg);
            }
        }

        @keyframes sonar {
            0% {
                transform: scale(0.9);
                opacity: 1;
            }
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        .page-wrapper .sidebar-wrapper,
        .sidebar-wrapper .sidebar-brand > a,
        .sidebar-wrapper .sidebar-dropdown > a:after,
        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before,
        .sidebar-wrapper ul li a i,
        .page-wrapper .page-content,
        .sidebar-wrapper .sidebar-search input.search-menu,
        .sidebar-wrapper .sidebar-search .input-group-text,
        .sidebar-wrapper .sidebar-menu ul li a,
        #show-sidebar,
        #close-sidebar {
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        /*----------------page-wrapper----------------*/

        .page-wrapper {
            height: 100vh;
        }

        .page-wrapper .theme {
            width: 40px;
            height: 40px;
            display: inline-block;
            border-radius: 4px;
            margin: 2px;
        }

        .page-wrapper .theme.chiller-theme {
            background: #1e2229;
        }

        /*----------------toggeled sidebar----------------*/

        .page-wrapper.toggled .sidebar-wrapper {
            left: 0px;
        }

        @media screen and (min-width: 768px) {
            .page-wrapper.toggled .page-content {
                padding-left: 260px;
            }
        }
        /*----------------show sidebar button----------------*/
        #show-sidebar {
            position: fixed;
            left: 0;
            top: 100px;
            border-radius: 0 4px 4px 0px;
            padding: 10px;
            width: 35px;
            z-index: 10001;
            transition-delay: 0.3s;
        }
        #show-sidebar i{
            font-size: 18px;
        }
        .page-wrapper.toggled #show-sidebar {
            left: -40px;
        }
        /*----------------sidebar-wrapper----------------*/

        .sidebar-wrapper {
            width: 260px;
            height: 100%;
            max-height: 100%;
            position: fixed;
            top: 0;
            left: -260px;
            z-index: 999;
            box-shadow: 1px 1px 1px 1px rgb(0 0 0 / 5%);
        }

        .sidebar-wrapper ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-wrapper a {
            text-decoration: none;
        }

        /*----------------sidebar-content----------------*/

        .sidebar-content {
            max-height: calc(100% - 30px);
            height: calc(100% - 30px);
            overflow-y: auto;
            position: relative;
        }

        .sidebar-content.desktop {
            overflow-y: hidden;
        }

        /*--------------------sidebar-brand----------------------*/

        .sidebar-wrapper .sidebar-brand {
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        .sidebar-wrapper .sidebar-brand > a {
            text-transform: uppercase;
            font-weight: bold;
            flex-grow: 1;
        }

        .sidebar-wrapper .sidebar-brand #close-sidebar {
            cursor: pointer;
            font-size: 20px;
        }
        /*--------------------sidebar-header----------------------*/

        .sidebar-wrapper .sidebar-header {
            padding: 20px;
            overflow: hidden;
        }

        .sidebar-wrapper .sidebar-header .user-pic {
            float: left;
            width: 42px;
            padding: 2px;
            margin-right: 15px;
            overflow: hidden;
        }

        .sidebar-wrapper .sidebar-header .user-pic img {
            object-fit: cover;
            border-radius: 1000px;
            height: 100%;
            width: 100%;
        }

        .sidebar-wrapper .sidebar-header .user-info {
            padding-top: 12px;
        }

        .sidebar-wrapper .sidebar-header .user-info > span {
            display: block;
        }

        .sidebar-wrapper .sidebar-header .user-info .user-role {
            font-size: 12px;
        }

        .sidebar-wrapper .sidebar-header .user-info .user-status {
            font-size: 11px;
            margin-top: 4px;
        }

        .sidebar-wrapper .sidebar-header .user-info .user-status i {
            font-size: 8px;
            margin-right: 4px;
            color: #5cb85c;
        }

        /*-----------------------sidebar-search------------------------*/

        .sidebar-wrapper .sidebar-search > div {
            padding: 10px 20px;
        }

        /*----------------------sidebar-menu-------------------------*/

        .sidebar-wrapper .sidebar-menu {
            padding-bottom: 10px;
        }

        .sidebar-wrapper .sidebar-menu .header-menu span {
            font-size: 14px;
            padding: 15px 20px 5px 20px;
            display: inline-block;
        }

        .sidebar-wrapper .sidebar-menu ul li a {
            display: inline-block;
            width: 100%;
            text-decoration: none;
            position: relative;
            padding: 8px 30px 8px 20px;
        }

        .sidebar-wrapper .sidebar-menu ul li a svg {
            margin-right: 10px;
            font-size: 16px;
            width: 20px;
            height: 20px;
            line-height: 30px;
            text-align: center;
            border-radius: 1000px;
        }

        .sidebar-wrapper .sidebar-menu ul li a:hover > svg::before {
            display: inline-block;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown > a:after {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f105";
            font-style: normal;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-align: center;
            background: 0 0;
            position: absolute;
            right: 15px;
            top: 14px;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu ul {
            padding: 5px 0;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li {
            padding-left: 25px;
            font-size: 13px;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before {
            content: "\f111";
            font-family: "Font Awesome 5 Free";
            font-weight: 400;
            font-style: normal;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            margin-right: 10px;
            font-size: 8px;
        }

        .sidebar-wrapper .sidebar-menu ul li a span.label,
        .sidebar-wrapper .sidebar-menu ul li a span.badge {
            float: right;
            margin-top: 8px;
            margin-left: 5px;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .badge,
        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .label {
            float: right;
            margin-top: 0px;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-submenu {
            display: none;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active > a:after {
            transform: rotate(90deg);
            right: 17px;
        }

        /*--------------------------side-footer------------------------------*/

        .sidebar-footer {
            position: absolute;
            width: 100%;
            bottom: 0;
            display: flex;
        }

        .sidebar-footer > a {
            flex-grow: 1;
            text-align: center;
            height: 30px;
            line-height: 30px;
            position: relative;
        }

        .sidebar-footer > a .notification {
            position: absolute;
            top: 0;
        }

        .badge-sonar {
            display: inline-block;
            background: #980303;
            border-radius: 50%;
            height: 8px;
            width: 8px;
            position: absolute;
            top: 0;
        }

        .badge-sonar:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            border: 2px solid #980303;
            opacity: 0;
            border-radius: 50%;
            width: 100%;
            height: 100%;
            animation: sonar 1.5s infinite;
        }

        /*--------------------------page-content-----------------------------*/

        .page-wrapper .page-content {
            display: inline-block;
            width: 100%;
        }

        .page-wrapper .page-content > div {
        }

        .page-wrapper .page-content {
            overflow-x: hidden;
        }

        /*------scroll bar---------------------*/

        ::-webkit-scrollbar {
            width: 5px;
            height: 7px;
        }
        ::-webkit-scrollbar-button {
            width: 0px;
            height: 0px;
        }
        ::-webkit-scrollbar-thumb {
            background: #525965;
            border: 0px none #ffffff;
            border-radius: 0px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #525965;
        }
        ::-webkit-scrollbar-thumb:active {
            background: #525965;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
            border: 0px none #ffffff;
            border-radius: 50px;
        }
        ::-webkit-scrollbar-track:hover {
            background: transparent;
        }
        ::-webkit-scrollbar-track:active {
            background: transparent;
        }
        ::-webkit-scrollbar-corner {
            background: transparent;
        }


        /*-----------------------------chiller-theme-------------------------------------------------*/

        .chiller-theme .sidebar-wrapper {
            background: #ffffff;
        }

        .chiller-theme .sidebar-wrapper .sidebar-header,
        .chiller-theme .sidebar-wrapper .sidebar-search,
        .chiller-theme .sidebar-wrapper .sidebar-menu {
            border-top: 0px solid #3a3f48;
        }

        .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
        .chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
            border-color: transparent;
            box-shadow: none;
        }

        .chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-role,
        .chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-status,
        .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
        .chiller-theme .sidebar-wrapper .sidebar-search .input-group-text,
        .chiller-theme .sidebar-wrapper .sidebar-brand>a,
        .chiller-theme .sidebar-wrapper .sidebar-menu ul li a,
        .chiller-theme .sidebar-footer>a {
            color: #818896;
        }

        .chiller-theme .sidebar-wrapper .sidebar-menu ul li:hover>a,
        .chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active>a,
        .chiller-theme .sidebar-wrapper .sidebar-header .user-info,
        .chiller-theme .sidebar-wrapper .sidebar-brand>a:hover,
        .chiller-theme .sidebar-footer>a:hover i {
            color: #b8bfce;
        }

        .page-wrapper.chiller-theme.toggled #close-sidebar {
            color: #bdbdbd;
        }

        .page-wrapper.chiller-theme.toggled #close-sidebar:hover {
            color: #ffffff;
        }

        .chiller-theme .sidebar-wrapper ul li:hover a i,
        .chiller-theme .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover:before,
        .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu:focus+span,
        .chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active a i {
            color: #16c7ff;
            text-shadow:0px 0px 10px rgba(22, 199, 255, 0.5);
        }

        .chiller-theme .sidebar-wrapper .sidebar-menu ul li a i,
        .chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown div,
        .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
        .chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
            background: #f2f2f2;
        }

        .chiller-theme .sidebar-wrapper .sidebar-menu .header-menu span {
            color: #6c7b88;
        }

        .chiller-theme .sidebar-footer {
            background: #f2f2f2;
            border-top: 0px solid #464a52;
            font-size: 14px;
        }

        .chiller-theme .sidebar-footer>a:first-child {
            border-left: none;
        }

        .chiller-theme .sidebar-footer>a:last-child {
            border-right: none;
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


<div class="page-wrapper chiller-theme <?php if($this->uri->segment(2) != 'dashboard'){?>toggled<?php }?>">
    <?php if($this->uri->segment(2) != 'dashboard'){?>
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-angle-right"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="#">CBT</a>
                <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="sidebar-header" style="display:none;">
                <div class="user-pic">
                    <img class="img-responsive img-rounded" src="<?php echo $this->session->userdata('foto');?>" alt="User picture">
                </div>
                <div class="user-info">
                    <span class="user-name"><?php echo $this->session->userdata('username');?></span>
                </div>

            </div>
            <!-- sidebar-header  -->

            <div class="sidebar-search" style="display:none;">
                <div>
                    <div class="input-group">
                        <input type="text" class="form-control search-menu" placeholder="Search...">
                        <div class="input-group-append">
              <span class="input-group-text">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sidebar-search  -->

            <div class="sidebar-menu">
                <ul>
                    <li class="header-menu">
                        <span>Wordspace</span>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/dashboard">
                            <i class="fa fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/peserta">
                            <i class="fa fa-users"></i>
                            <span>Peserta</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/guru">
                            <i class="fa fa-chalkboard-teacher"></i>
                            <span>Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/soal">
                            <i class="fa fa-file-word"></i>
                            <span>Bank Soal</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/ujian">
                            <i class="fa fa-pen"></i>
                            <span>Ujian</span>
                        </a>
                    </li>


                    <li class="header-menu">
                        <span>Alat dan Pengaturan</span>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/overview">
                            <i class="fa fa-server"></i>
                            <span>Overview Server</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/pesan">
                            <i class="fa fa-comment"></i>
                            <span>Pesan</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/pengaturan">
                            <i class="fa fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/dokumentasi">
                            <i class="fa fa-book"></i>
                            <span>Documentation</span>
                            <span class="badge badge-pill badge-primary">Beta</span>
                        </a>
                    </li>


                </ul>
            </div>
            <!-- sidebar-menu  -->


        </div>
        <div class="sidebar-footer">
            <a href="#">Created by Eko hendratno,S.Kom</a>
        </div>
    </nav>

    <?php }?>

    <!-- sidebar-wrapper  -->
    <main class="page-content">
        <div class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">

                <div class="navbar-header">

                    <?php if($this->uri->segment(2) == 'dashboard'){?>
                        <a class="navbar-brand" href="<?php echo base_url().$this->uri->segment(1);?>/dashboard">
                            <img alt="CBT" src="<?php echo base_url();?>assets/images/logocbt.ico" style="margin-top: -5px; padding: 0; height: 30px">
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    <?php }?>

                </div>

                <div id="bs-example-navbar-collapse-1">
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
        </div>

        <?php echo $contents ?>
    </main>
    <!-- page-content" -->

</div>









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
<script type="text/javascript">
    jQuery(function ($) {

        $(".sidebar-dropdown > a").click(function() {
            $(".sidebar-submenu").slideUp(200);
            if (
                $(this)
                    .parent()
                    .hasClass("active")
            ) {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                    .parent()
                    .removeClass("active");
            } else {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                    .next(".sidebar-submenu")
                    .slideDown(200);
                $(this)
                    .parent()
                    .addClass("active");
            }
        });

        $("#close-sidebar").click(function() {
            $(".page-wrapper").removeClass("toggled");
        });
        $("#show-sidebar").click(function() {
            $(".page-wrapper").addClass("toggled");
        });



    });

</script>
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
<script>
    feather.replace()
</script>

</body>
</html>
