<div class="container container-medium">

    <div class="col-sm-12 col-md-12">

        <h4><i class='fa fa-file fa-fw'></i> BANK SOAL ARSIP</h4>
        <hr/>
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-12">
        <div>
            <div style="min-height:800px;">


                <div id="postListTerkumpul" class="list-group" style="font-size: 18px"></div>
                <div id='paginationTerkumpul'></div>


            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="formSearch" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">


                    <div class="col-md-12">
                        <div class="input-group input-group-lg">
                            <div class="input-group-addon"><i class="fas fa-search"></i></div>
                            <input type="text" class="form-control token" name="keywords" id="keywords" placeholder="Type keywords to filter posts" onkeyup="searchFilterTerkumpul(0)">
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formFilter" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Filter
                    <div class="pull-right">
                        <a href="<?php echo base_url(). "siswa/soalarsip/index"; ?>" class="btn btn-primary">Atur Ulang Setingan</a>
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">

                <div class="container container-small">

                    <div class="row">

                        <div class="col-md-6">
                            <label>Urutkan</label><br/>
                            <select class="form-control"  id="sortBy" onchange="searchFilterTerkumpul()">
                                <option value="">Sort By</option>
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>


                        </div>
                        <div class="col-md-6">

                            <label>Jumlah ditampilkan</label><br/>
                            <select class="form-control"  id="limitBy" onchange="searchFilterTerkumpul()">
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                            </select>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-12">

                            <label>Pilih Tahun Ajaran <span class="text-danger">*</span></label><br/>
                            <select class="form-control selectpicker"  id="tahunajaran" onchange="submitTahunAjaran()">
                                <option value="">Pilih tahun ajaran</option>
                                <?php
                                $query = $this->db->group_by("ta_tahun")->order_by("ta_tahun","DESC")->get_where("ta",array("ta_arsip" => "1"))->result();
                                foreach ($query as $ta){

                                    $ta_select = "";
                                    if($tahunajaran_arsip == $ta->ta_tahun."-".$ta->ta_semester){
                                        $ta_select = ' selected="selected"';
                                    }
                                    ?>
                                    <option value="<?php echo $ta->ta_tahun;?>-<?php echo $ta->ta_semester;?>"<?php echo $ta_select;?>><?php echo $ta->ta_tahun;?>-<?php echo $ta->ta_semester;?></option>
                                    <?php
                                }
                                ?>
                            </select>

                        </div>

                    </div>

                </div>


            </div>


        </div>
    </div>
</div>


<script type="text/javascript" language="javascript" >
    <?php if(!empty($tahunajaran_arsip) ){?>
    $('#tahunajaran').val('<?php echo $tahunajaran_arsip;?>');
    $('#tahunajaran').selectpicker('refresh');

    $('#formFilter').modal('hide');
    <?php }else{?>
    $('#formFilter').modal('show');
    <?php }?>



    function submitTahunAjaran(){

        var tahunajaran = $("#tahunajaran").val();

        $.ajax({
            type:'POST',
            data: "tahunajaran="+tahunajaran,
            url:'<?php echo base_url('index.php/siswa/soalarsip/simpantahunajaran_arsip') ;?>',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function(){
                //$('#formTahunAjaran').modal('hide');
                $('#loading_ajax').fadeOut("slow");

                searchFilterTerkumpul(0);

                /**
                setTimeout(function() {
                    window.location.assign("<?php echo base_url('index.php/siswa/soalarsip') ;?>");
                }, 300);*/
            }
        });
    }



    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes();

    //tanggal
    $("#datetimepicker1a,#datetimepicker1b" ).datepicker({
        dateFormat: 'yy-m-d',
        yearRange: '2001:2030',
        changeYear: true,
        changeMonth: true,
        autoSize: true,
        showAnim: 'slideDown',
        firstDay: 1,
        beforeShow: function() {
            setTimeout(function(){
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        }
    }).datetimepicker('setDate', new Date()).val(date);

    $('#soal_pembuat_kelas').tagator({
        showAllOptionsOnFocus: true,
        allowAutocompleteOnly: true,
        autocomplete: ["10","11","12"],
        useDimmer: true
    });

    $('#datetimePicker').datetimepicker({
        // dateFormat: 'dd-mm-yy',
        defaultDate: new Date(),
        format:'YYYY-MM-DD HH:mm:ss'
    });



    $(document).ready(function(){


        $("[name='soal_pembuat_guru']").autocomplete({
            source: "<?php echo site_url('sugest/guru?');?>"
        });
        $("[name='soal_pembuat_pelajaran']").autocomplete({
            source: "<?php echo site_url('sugest/pelajaran?');?>"
        });


    });



    $('#formSearch').on('shown.bs.modal', function() {
        $('#keywords').trigger('focus');
    });

    searchFilterTerkumpul(0);



    function searchFilterTerkumpul(page_num) {
        page_num = page_num?page_num:0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();


        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>siswa/soalarsip/ajaxPaginationDataTerkumpul/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);

                //$('#paginationTerkumpul').html(responseData.pagination);
                paginationDataTerkumpul(responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function paginationDataTerkumpul(data) {

        $('#postListTerkumpul').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar soal</h4>'+
                '<p>Daftar soal akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postListTerkumpul').append(empRow);
        }else{

            for(emp in data){


                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].ujian_tanggal_indo+'</span>'+
                    ' <span class="label label-default">'+data[emp].ujian_untuk+'</span>'+
                    ' <span class="label label-default">'+data[emp].ujian_kelas+'</span>'+
                    '</p><br/>'+

                    '<div class="col-md-7"><div class="row">'+
                    '<p><i style="color:#999">'+data[emp].ujian_guru+'</i></p>'+
                    '<h3 class="list-group-item-heading name">'+data[emp].ujian_pelajaran+'</h3>'+
                    '</div></div>'+
                    '<div class="col-md-5" style="text-align:center;"><div class="row">'+

                    '<a title="Preview" title="Preview" onClick="submitPreview(\''+data[emp].ujian_pelajaran+'\',\''+data[emp].ujian_guru+'\',\''+data[emp].ujian_kelas+'\',\''+data[emp].ujian_untuk+'\')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-eye"></span></a>'+
                    '<a title="Export Data" title="Export" onClick="submitExport(\''+data[emp].ujian_pelajaran+'\',\''+data[emp].ujian_guru+'\',\''+data[emp].ujian_kelas+'\',\''+data[emp].ujian_untuk+'\')" class="btn btn-circle btn-default" style="color: #6db571;" ><span class="fas fa-file-export"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postListTerkumpul').append(empRow);
            }

        }

    }


    function submitExport(pelajaran,guru,kelas,untuk) {
        var w = 800;
        var h = 760;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        window.open("<?php echo base_url();?>export/soal?"+
            "print=1"+
            "&arsip=1"+
            "&pelajaran="+pelajaran+
            "&guru="+guru+
            "&kelas="+kelas+
            "&untuk="+untuk,
            '_blank', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        return false;
    }

    function submitPreview(pelajaran,guru,kelas,untuk) {

        var w = 800;
        var h = 760;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        window.open("<?php echo base_url();?>export/soal?"+
            "arsip=1"+
            "&pelajaran="+pelajaran+
            "&guru="+guru+
            "&kelas="+kelas+
            "&untuk="+untuk,
            '_blank', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        return false;
    }

</script>



