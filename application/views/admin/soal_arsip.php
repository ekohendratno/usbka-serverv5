<div class="container-flex">

    <div class="col-sm-12 col-md-12">

        <h4><i class='fa fa-file fa-fw'></i> BANK SOAL ARSIP<i class='fa fa-angle-right fa-fw'></i> DATA SOAL ARSIP TERBARU</h4>
        <hr/>
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
            <a title="Pembuat Soal" data-backdrop="static" data-keyboard="false" href="#formDialogKumpul" data-toggle="modal" onClick="searchFilterKumpul()" class="btn btn-sm"><i class="fas fa-archive"></i> Pembuat Soal</a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-8">
        <div>
            <div style="min-height:800px;">

                <ul class="nav nav-tabs" style="margin-bottom: 8px">
                    <li class="active"><a data-toggle="tab" href="#soalterkumpul">Soal Arsip Terkumpul</a></li>
                    <li><a data-toggle="tab" href="#soalterbaru">Soal Arsip Terbaru</a></li>
                </ul>
                <div class="tab-content">
                    <div id="soalterkumpul" class="tab-pane fade in active">

                        <div id="postListTerkumpul" class="list-group" style="font-size: 18px"></div>
                        <div id='paginationTerkumpul'></div>
                    </div>
                    <div id="soalterbaru" class="tab-pane fade in">

                        <div id="postList0" class="list-group" style="font-size: 18px"></div>
                        <div id='pagination1'></div>

                    </div>
                </div>



            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">

        <div class="row">
            <div class="col-md-12">
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3><?php echo $total_soal;?></h3>
                        <p>Total Soal</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_pelajaran;?></h3>
                        <p>Total Pelajaran</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_guru;?></h3>
                        <p>Total Guru</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
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
                            <input type="text" class="form-control token" name="keywords" id="keywords" placeholder="Type keywords to filter posts" onkeyup="searchFilter()">
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
                        <a href="<?php echo base_url(). "admin/soalarsip/index"; ?>" class="btn btn-primary">Atur Ulang Setingan</a>
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">

                <div class="container container-small">

                    <div class="row">

                        <div class="col-md-4">
                            <label>Urutkan</label><br/>
                            <select class="form-control"  id="sortBy" onchange="searchFilter()">
                                <option value="">Sort By</option>
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>


                        </div>
                        <div class="col-md-4">

                            <label>Jumlah ditampilkan</label><br/>
                            <select class="form-control"  id="limitBy" onchange="searchFilter()">
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                            </select>
                        </div>

                        <div class="col-md-4">

                            <label>Kelas ditampilkan</label><br/>
                            <select class="form-control selectpicker"  id="kelasBy" onchange="searchFilter()" data-live-search="true">
                                <option value="">Tampil Semua Kelas</option>
                                <?php foreach ($kelasBySoal as $k):?>
                                    <option value="<?php echo $k["id"];?>"><?php echo $k["label"];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="col-md-12">

                            <label>Pelajaran ditampilkan</label><br/>
                            <select class="form-control selectpicker"  id="pelajaranBy" onchange="searchFilter()" data-live-search="true">
                                <option value="">Tampil Semua Mata Pelajaran</option>
                                <?php foreach ($pelajaranBySoal as $p):?>
                                    <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="col-md-12">

                            <label>Guru ditampilkan</label><br/>
                            <select class="form-control selectpicker"  id="guruBy" onchange="searchFilter()" data-live-search="true">
                                <option value="">Tampil Semua Guru</option>
                                <?php foreach ($guruBySoal as $p):?>
                                    <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-12">

                            <label>Pilih Tahun Ajaran <span class="text-danger">*</span></label><br/>
                            <select class="form-control selectpicker"  id="tahunajaran" onchange="submitTahunAjaran()">
                                <option value="">Pilih tahun ajaran</option>
                                <?php
                                $query = $this->db->group_by("ta_tahun")->order_by("ta_tahun","DESC")->get_where("ta",array())->result();
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

<div class="modal fade modal-fullscreen" id="formDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">
            <form role="form" name="_form"  id="_form" novalidate>


                <input type="hidden" id="id" name="id" value="0"/>
                <input type="hidden" id="parent" name="parent" value="0"/>
                <input type="hidden" id="jenis" name="jenis" value="optional"/>

                <div class="modal-header">


                    <div class="row">
                        <div class="col-md-4 col-xs-3">
                            <h4 class="modal-title"><span class="model-title-text">SOAL</span></h4>
                        </div>
                        <div class="col-md-8 col-xs-9">
                            <div class="pull-right">

                                <div class="btn" style="padding: 0px;">
                                    <select name="soal_jenis" class="btn form-control selectpicker">
                                        <option value="optional">Optional</option>
                                        <option value="essay">Essay</option>
                                        <option value="checked">Cheked</option>
                                    </select>
                                </div>


                                <a href="#" title="Pengaturan" class="btn btn-default btn-sm btn-circle submitpengaturan">
                                    <i class="fas fa-arrow-up"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>

                            </div>
                        </div>

                    </div>



                    <div class="clearfix"></div>

                    <div class="container container-medium">


                        <div class="col-md-12">
                            <div id="pengaturan" class="row" style="padding-top: 30px">
                                <div class="row">

                                    <div class="col-md-4">

                                        <label>Kelas</label>
                                        <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                            <select name="soal_kelas" class="form-control selectpicker" data-live-search="true">
                                                <option value="">Pilih Kelas</option>
                                                <?php foreach ($kelas as $k):?>
                                                    <option value="<?php echo $k["id"];?>"><?php echo $k["label"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-8">

                                        <label>Pelajaran</label><br/>
                                        <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                            <select name="soal_pelajaran" class="form-control selectpicker" data-live-search="true">
                                                <option value="">Pilih Mata Pelajaran</option>
                                                <?php foreach ($pelajaran as $p):?>
                                                    <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">

                                        <label>Guru</label>
                                        <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                            <select name="soal_guru" class="form-control selectpicker" data-live-search="true">
                                                <option value="">Pilih Pengajar</option>
                                                <?php foreach ($guru as $g):?>
                                                    <option value="<?php echo $g["id"];?>"><?php echo $g["label"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">


                                        <label>Peruntukan Soal</label><br/>
                                        <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                            <select name="soal_untuk" class="form-control selectpicker" data-live-search="true">
                                                <option value="">Semua Ujian</option>
                                                <option value="UTS">UTS</option>
                                                <option value="UAS">UAS</option>
                                                <option value="USBN">USBN</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <br>

                                <div class="text-right" style="display: none">
                                    <a href="javascript:void();" class="btn btn-default submitpengaturanhide"><i class="fas fa-arrow-up"></i></a>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
                <div class="modal-body">



                    <div class="container container-medium">

                        <div class="modal-status"></div>

                        <ul class="nav nav-tabs" style="margin-bottom: 8px">
                            <li class="active"><a data-toggle="tab" href="#home">Soal</a></li>
                            <li><a data-toggle="tab" href="#menu1">Daftar soal</a></li>
                            <li><a data-toggle="tab" href="#menu2">Daftar kutipan</a></li>
                            <li><a data-toggle="tab" href="#menu3">Kutipan yang digunakan</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">


                                <label>Pertanyaan</label><br/>
                                <div class="funkyradio">
                                    <div class="funkyradio-danger a">
                                        <input type="radio" disabled>
                                        <label title="Pertanyaan"><div class="huruf_opsi">?</div>
                                            <p class="b">
                                                <textarea style="font-size: 16pt; height: 200px" type="text" name="soal_text" id="soal_text" class="form-control tinyEditor" required></textarea>
                                            </p>
                                        </label>
                                    </div>
                                </div>

                                <br/>

                                <label>Jawaban</label><br/>

                                <div id="optional" style="display: block;">
                                    <div class="funkyradio">
                                        <div class="funkyradio-success a">
                                            <input id="A" type="radio" name="soal_text_jawab_optional[]" value="1" disabled>
                                            <label for="A" title="Jawaban"><div class="huruf_opsi">A</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional0" id="soal_text_jawab_optional0" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>
                                        <div class="funkyradio-success a">
                                            <input id="B" type="radio" name="soal_text_jawab_optional[]" value="2" disabled>
                                            <label for="B" title="Jawaban"><div class="huruf_opsi">B</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional1" id="soal_text_jawab_optional1" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>
                                        <div class="funkyradio-success a">
                                            <input id="C" type="radio" name="soal_text_jawab_optional[]" value="3" disabled>
                                            <label for="C" title="Jawaban"><div class="huruf_opsi">C</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional2" id="soal_text_jawab_optional2" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>
                                        <div class="funkyradio-success a">
                                            <input id="D" type="radio" name="soal_text_jawab_optional[]" value="4" disabled>
                                            <label for="D" title="Jawaban"><div class="huruf_opsi">D</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional3" id="soal_text_jawab_optional3" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>
                                        <div class="funkyradio-success a">
                                            <input id="E" type="radio" name="soal_text_jawab_optional[]" value="5" disabled>
                                            <label for="E" title="Jawaban"><div class="huruf_opsi">E</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_optional4" id="soal_text_jawab_optional4" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div id="essay" style="display: none;">
                                    <div class="funkyradio">
                                        <div class="funkyradio-success x">
                                            <input type="radio" disabled>
                                            <label title="Jawaban"><div class="huruf_opsi">&nbsp;</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_essay0" id="soal_text_jawab_essay0" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>
                                    </div>

                                </div>


                                <div id="checked" style="display: none;">

                                    <div class="funkyradio">
                                        <div class="funkyradio-success c1">
                                            <input id="c1" type="checkbox" name="soal_text_jawab_checked[]" value="1" disabled>
                                            <label for="c1" title="Jawaban"><div class="huruf_opsi">1</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked0" id="soal_text_jawab_checked0" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>

                                        <div class="funkyradio-success c2">
                                            <input id="c2" type="checkbox" name="soal_text_jawab_checked[]" value="2" disabled>
                                            <label for="c2" title="Jawaban"><div class="huruf_opsi">2</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked1" id="soal_text_jawab_checked1" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>

                                        <div class="funkyradio-success c3">
                                            <input id="c3" type="checkbox" name="soal_text_jawab_checked[]" value="3" disabled>
                                            <label for="c3" title="Jawaban"><div class="huruf_opsi">3</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked2" id="soal_text_jawab_checked2" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>

                                        <div class="funkyradio-success c4">
                                            <input id="c4" type="checkbox" name="soal_text_jawab_checked[]" value="4" disabled>
                                            <label for="c4" title="Jawaban"><div class="huruf_opsi">4</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked3" id="soal_text_jawab_checked3" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>

                                        <div class="funkyradio-success c5">
                                            <input id="c5" type="checkbox" name="soal_text_jawab_checked[]" value="5" disabled>
                                            <label for="c5" title="Jawaban"><div class="huruf_opsi">5</div>
                                                <p class="b"><textarea style="font-size: 16pt; height: 100px" type="text" name="soal_text_jawab_checked4" id="soal_text_jawab_checked4" class="form-control tinyEditor" required></textarea></p>
                                            </label>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div id="menu1" class="tab-pane fade">


                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control token" name="keywords4" id="keywords4" placeholder="Type keywords to filter posts" onkeyup="searchFilterBySoal()">

                                </div>

                                <div class="clearfix"></div>

                                <div id="postListSoal" style="font-size: 18px; margin-top: 10px"></div>

                            </div>

                            <div id="menu2" class="tab-pane fade">

                                <div class="row">
                                    <div class="col-md-11" style="margin-bottom: 8px">


                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fas fa-search"></i></div>
                                            <input type="text" class="form-control token" name="keywords3" id="keywords3" placeholder="Type keywords to filter posts" onkeyup="searchFilterParent()">

                                        </div>

                                    </div>

                                    <div class="col-md-1 text-right" style="margin-bottom: 8px">

                                        <a data-backdrop="static" data-keyboard="false" data-toggle="modal" href="#formDialogParent" onclick="formDialog3(0)" class="btn btn-block btn-success"><i class="fas fa-plus"></i></a>

                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div id="postListParent" class="list-group" style="font-size: 18px"></div>
                                <div id='pagination2'></div>

                            </div>

                            <div id="menu3" class="tab-pane fade">


                                <div class="clearfix"></div>

                                <div id="postListParentText" style="font-size: 18px; padding: 30px; border: 1px solid #ddd;"></div>

                            </div>
                        </div>


                    </div>

                </div>

            </form>

        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formDialogKumpul" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">

            <form role="form" name="_form2"  id="_form2" novalidate>

                <input type="hidden" id="id2" name="id2" value="0"/>

                <div class="modal-header">

                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-4">
                            <h4 class="modal-title"><span class="model-title-text2">PEMBUAT SOAL</span></h4>
                        </div>
                        <div class="col-md-8 col-sm-6 col-xs-8">
                            <div class="pull-right">

                                <div class="btn" id="keywords2Form" style="padding: 0px;">
                                    <input type="text" class="form-control" name="keywords2" id="keywords2" placeholder="Type keywords to filter posts" onkeyup="searchFilterKumpul()">
                                </div>
                                <a href="#" title="Pengaturan" class="btn btn-default btn-sm btn-circle submitpengaturan2">
                                    <i class="fas fa-arrow-up"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="clearfix"></div>

                        <div class="container container-medium">


                            <div class="col-md-12">
                                <div id="pengaturan2" style="padding-top: 30px">


                                    <div class="row">



                                        <div class="col-md-4">

                                            <label>Kelas</label>
                                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>

                                                <input id="soal_pembuat_kelas"
                                                       name="soal_pembuat_kelas"
                                                       type="text"
                                                       class="form-control"
                                                       value="">

                                            </div>


                                        </div>

                                        <div class="col-md-8">


                                            <label>Jurusan</label>
                                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>

                                                <select name="soal_pembuat_jurusan" class="form-control selectpicker" data-live-search="true">
                                                    <option value="">Semua Jurusan</option>
                                                    <?php foreach ($jurusan as $p):?>
                                                        <option value="<?php echo $p["id"];?>"><?php echo $p["label"];?></option>
                                                    <?php endforeach;?>
                                                </select>

                                            </div>

                                        </div>


                                        <div class="col-md-12">


                                            <label>Pelajaran</label><br/>
                                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                                <input name="soal_pembuat_pelajaran" class="form-control"/>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <label>Guru</label>
                                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                                <input name="soal_pembuat_guru" class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">


                                            <label>Peruntukan Soal</label><br/>
                                            <div class="input-group">
												  <span class="input-group-addon">
													<span class="glyphicon glyphicon-search"></span>
												  </span>
                                                <select name="soal_pembuat_untuk" class="form-control selectpicker" data-live-search="true">
                                                    <option value="UTS">UTS</option>
                                                    <option value="UAS">UAS</option>
                                                    <option value="USBN">USBN</option>
                                                </select>
                                            </div>

                                        </div>


                                        <div class="col-md-3">

                                            <label>Jumlah Soal</label><br/>
                                            <input type='number' min="10" class="form-control" name="soal_pembuat_jumlah" value="30" />

                                        </div>

                                        <div class="col-md-6">

                                            <label>Tanggal Pembuatan Dimulai</label><br/>
                                            <input type='text' class="form-control" name="soal_pembuat_tanggal" id='datetimepicker1a' readonly />

                                        </div>

                                        <div class="col-md-6">

                                            <label>Tanggal Pembuatan Akhir</label><br/>
                                            <input type='text' class="form-control" name="soal_pembuat_tanggal_dikumpulkan" id='datetimepicker1b' readonly />

                                        </div>

                                    </div>
                                    <br>

                                    <div class="text-right" style="display: none">
                                        <a href="javascript:void();" class="btn btn-default submitpengaturanhide"><i class="fas fa-arrow-up"></i></a>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-body">

                    <div class="container">

                        <div class="row">

                            <div class="col-md-12">


                                <div id="postList1" class="list-group" style="font-size: 18px"></div>


                            </div>

                        </div>


                    </div>


                </div>

            </form>

        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formDialogParent" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">

            <form role="form" name="_formparent"  id="_formparent" novalidate>
                <input type="hidden" id="parent_id" name="parent_id" value="0"/>


                <div class="modal-header">

                    <h4 class="modal-title"><span class="model-title-text2">KUTIPAN SOAL</span>

                        <div class="pull-right">
                            <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                        </div>
                    </h4>

                </div>
                <div class="modal-body">

                    <div class="container container-medium">

                        <div class="modal-status"></div>

                        <textarea style="font-size: 16pt; height: 200px" type="text" name="soal_parent_text" id="soal_parent_text" class="form-control tinyEditor" required></textarea>

                        <br/>
                        <div class="clearfix"></div>
                        <p><i>* Kutipan soal ini dapat digunakan kembali untuk soal lainnya di pelajaran yang sama.</i></p>

                    </div>


                </div>

            </form>


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
            url:'<?php echo base_url('index.php/admin/soalarsip/simpantahunajaran_arsip') ;?>',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function(){
                //$('#formFilter').modal('hide');
                $('#loading_ajax').fadeOut("slow");

                searchFilter(0);
                /**
                setTimeout(function() {
                    window.location.assign("<?php echo base_url('index.php/admin/soalarsip') ;?>");
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

        $(".submitselanjutnya").hide();

        $(".submitpengaturanhide").click(function(){
            $("#pengaturan").hide(300);
        });


        $(".submitpengaturan").click(function(){
            var side = $(".submitpengaturan .fa-arrow-up").attr('class');
            if(side){
                $(".submitpengaturan .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            }else{
                $(".submitpengaturan .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            }

            $("#pengaturan").slideToggle();
        });


        $(".submitpengaturan2").click(function(){
            var side = $(".submitpengaturan2 .fa-arrow-up").attr('class');
            if(side){
                $(".submitpengaturan2 .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            }else{
                $(".submitpengaturan2 .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            }

            $("#pengaturan2").slideToggle();
            $("#keywords2Form").slideToggle();
            $(".submitsimpan2").slideToggle();

        });

        $('[name="soal_pelajaran"]').on('change', function() {
            var pelajaran = $('[name="soal_pelajaran"]').val();
            $.ajax({
                type:'GET',
                data: 'pelajaran='+pelajaran,
                url:'<?php echo base_url('admin/soalarsip/getguru') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){

                    $("[name='soal_guru']").val(hasil.label);
                    $("[name='soal_guru']").selectpicker('refresh');

                    $("[name='soal_untuk']").val(hasil.label2);
                    $("[name='soal_untuk']").selectpicker('refresh');


                    searchFilterParent(0);
                    searchFilterBySoal(0);

                }
            });

        });

        $('[name="soal_jenis"]').on('change', function() {
            var jenis = this.value;
            $('#optional').css("display","none");
            $('#essay').css("display","none");
            $('#checked').css("display","none");

            if(jenis == "optional"){
                $('#optional').css("display","block");
            }else if(jenis == "essay"){
                $('#essay').css("display","block");
            }else if(jenis == "checked"){
                $('#checked').css("display","block");
            }

            $('#jenis').val(jenis);
        });


    });



    $('#formSearch').on('shown.bs.modal', function() {
        $('#keywords').trigger('focus');
    });


    searchFilter(0);
    function searchFilter(page_num) {
        searchFilterTerkumpul(0);

        page_num = page_num?page_num:0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();

        var kelasBy = $('#kelasBy').val();
        var pelajaranBy = $('#pelajaranBy').val();
        var guruBy = $('#guruBy').val();


        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/soalarsip/ajaxPaginationData/'+page_num,
            data:
                'page='+page_num+
                '&keywords='+keywords+
                '&sortBy='+sortBy+
                '&limitBy='+limitBy+
                '&kelasBy='+kelasBy+
                '&pelajaranBy='+pelajaranBy+
                '&guruBy='+guruBy,

            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);

                $('#pagination1').html(responseData.pagination);
                paginationData(responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function searchFilterBySoal(page_num) {
        page_num = page_num?page_num:0;

        var keywords = $('[name="keywords4"]').val();
        var kelas = $('[name="soal_kelas"]').val();
        var pelajaran = $('[name="soal_pelajaran"]').val();
        var guru = $('[name="soal_guru"]').val();


        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/soalarsip/ajaxPaginationDataBySoal/'+page_num,
            data:'page='+page_num+'&kelasBy='+kelas+'&pelajaranBy='+pelajaran+'&guruBy='+guru+'&keywords='+keywords,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);

                //$('#pagination1').html(responseData.pagination);
                paginationDataBySoal(responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function searchFilterParent(page_num) {
        page_num = page_num?page_num:0;

        var keywords = $('#keywords3').val();
        var kelas = $('[name="soal_kelas"]').val();
        var pelajaran = $('[name="soal_pelajaran"]').val();
        var guru = $('[name="soal_guru"]').val();
        var id = $('#parent').val();

        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>admin/soalarsip/ajaxPaginationData2/'+page_num,
            data:'page='+page_num+'&kelasBy='+kelas+'&pelajaranBy='+pelajaran+'&guruBy='+guru+'&idBy='+id+'&keywords='+keywords,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);
                $('#pagination2').html(responseData.pagination);
                paginationData3(responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }



    function searchFilterTerkumpul(page_num) {
        page_num = page_num?page_num:0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();

        var kelasBy = $('#kelasBy').val();
        var pelajaranBy = $('#pelajaranBy').val();
        var guruBy = $('#guruBy').val();



        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/soalarsip/ajaxPaginationDataTerkumpul/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&kelasBy='+kelasBy+'&pelajaranBy='+pelajaranBy+'&guruBy='+guruBy,
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

    function paginationData(data) {


        $('#postList0').empty();
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
            $('#postList0').append(empRow);
        }else{

            for(emp in data){

                var jenis_text = "";
                var jenis = data[emp].soal_jenis;
                if(jenis.toLowerCase() == "checked"){
                    jenis_text = '<svg class="feather">\n' +
                        '  <use href="<?php echo base_url(); ?>assets/admin/img/feather-sprite.svg#check-square"/>\n' +
                        '</svg>';
                }
                if(jenis.toLowerCase() == "optional"){
                    jenis_text = '<svg class="feather">\n' +
                        '  <use href="<?php echo base_url(); ?>assets/admin/img/feather-sprite.svg#check-circle"/>\n' +
                        '</svg>';
                }
                if(jenis.toLowerCase() == "essay"){
                    jenis_text = '<svg class="feather">\n' +
                        '  <use href="<?php echo base_url(); ?>assets/admin/img/feather-sprite.svg#align-justify"/>\n' +
                        '</svg>';
                }

                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].soal_date+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_untuk+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_kelas+'</span>'+
                    '</p><br/>'+

                    '<div class="col-md-8"><div class="row">'+
                    '<p><i style="color:#999">'+data[emp].soal_guru+'</i></p>'+
                    '<h3 class="list-group-item-heading name">'+data[emp].soal_text+'</h3>'+
                    '<p><i style="color:#999">'+data[emp].soal_pelajaran+'</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="'+jenis+'" title="'+jenis+'" class="btn btn-circle btn-default" style="color: #ca7234;" >'+jenis_text+'</a>'+

                    '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+data[emp].soal_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapus('+data[emp].soal_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postList0').append(empRow);
            }

        }

    }

    function paginationDataBySoal(data) {


        $('#postListSoal').empty();
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
            $('#postListSoal').append(empRow);
        }else{

            for(emp in data){

                var jenis_text = "";
                var jenis = data[emp].soal_jenis;
                if(jenis.toLowerCase() == "checked"){
                    jenis_text = '<svg class="feather">\n' +
                        '  <use href="<?php echo base_url(); ?>assets/admin/img/feather-sprite.svg#check-square"/>\n' +
                        '</svg>';
                }
                if(jenis.toLowerCase() == "optional"){
                    jenis_text = '<svg class="feather">\n' +
                        '  <use href="<?php echo base_url(); ?>assets/admin/img/feather-sprite.svg#check-circle"/>\n' +
                        '</svg>';
                }
                if(jenis.toLowerCase() == "essay"){
                    jenis_text = '<svg class="feather">\n' +
                        '  <use href="<?php echo base_url(); ?>assets/admin/img/feather-sprite.svg#align-justify"/>\n' +
                        '</svg>';
                }

                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].soal_date+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_untuk+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_kelas+'</span>'+
                    '</p><br/>'+

                    '<div class="col-md-8 col-sm-6 col-xs-8"><div class="row">'+

                    '<h4 class="list-group-item-heading name">'+ data[emp].soal_text+'</h4>'+

                    '<p><i style="color:#999">'+data[emp].soal_pelajaran+'</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4 col-sm-6 col-xs-4" style="text-align:center;"><div class="row">'+


                    '<div class="btn btn-circle btn-default" >'+data[emp].nomor+'</div> '+

                    '<a title="'+jenis+'" title="'+jenis+'" class="btn btn-circle btn-default" style="color: #ca7234;" >'+jenis_text+'</a>'+
                    '<a title="Ubah Data" title="Ubah" href="javascript:void();" onClick="formDialogBySoal('+data[emp].soal_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapus('+data[emp].soal_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postListSoal').append(empRow);
            }

        }

    }

    function paginationDataPembuatSoal(data) {

        $('#postList1').empty();
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
            $('#postList1').append(empRow);
        }else{

            for(emp in data){


                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].soal_pembuat_untuk+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_pembuat_kelas+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_pembuat_jurusan+'</span>'+
                    '</p><br/>'+

                    '<div class="col-md-8 col-sm-6 col-xs-12"><div class="row">'+
                    '<p><i style="color:#999">'+data[emp].soal_pembuat_guru+'</i></p>'+
                    '<h3 class="list-group-item-heading name">'+data[emp].soal_pembuat_pelajaran+'</h3>'+
                    '<p><i style="color:#999">'+data[emp].soal_pembuat_tanggal+' sampai '+data[emp].soal_pembuat_tanggal_dikumpulkan+'</i>, <i style="color:#999">'+data[emp].soal_pembuat_jumlah+' Soal</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4 col-sm-6 col-xs-12" style="text-align:center;"><div class="row">'+

                    '<div class="btn btn-default" title="Terkumpul">'+data[emp].soal_jumlah_terkumpul+'</div> '+
                    '<div class="btn btn-success" title="Minimal Terkumpul Seharusnya">'+data[emp].soal_jumlah_terkumpul_total+'</div> '+


                    '<a title="Ubah Data" title="Ubah" href="javascript:void()" onClick="formDialog2('+data[emp].soal_pembuat_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapus2('+data[emp].soal_pembuat_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+


                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postList1').append(empRow);
            }

        }

    }

    function paginationData3(data) {

        $('#postListParent').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar parent soal</h4>'+
                '<p>Daftar parent soal akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postListParent').append(empRow);
        }else{

            for(emp in data){

                var parent_color = " btn-default";
                var parent = $('#parent').val();

                console.log(parent+"========"+data[emp].soal_parent_id);

                if(parent == data[emp].soal_parent_id){
                    parent_color = " btn-success";
                }

                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].soal_parent_date+'</span>'+
                    '</p><br/>'+

                    '<div class="col-md-8"><div class="row">'+
                    '<h4 class="list-group-item-heading name">'+data[emp].soal_parent_text+'</h4>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="Pilih Data" title="Duplikat" onClick="submitSelectParent('+data[emp].soal_parent_id+')" class="btn btn-circle'+parent_color+'" style="color: #4c4c4c;" ><span class="fas fa-check"></span></a>'+

                    '<a title="Ubah Data" title="Ubah" onClick="formDialog3('+data[emp].soal_parent_id+')" data-backdrop="static" data-keyboard="false" data-toggle="modal" href="#formDialogParent" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapusParent('+data[emp].soal_parent_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postListParent').append(empRow);
            }

        }

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
                    ' <span class="label label-default">'+data[emp].soal_untuk+'</span>'+
                    ' <span class="label label-default">'+data[emp].soal_kelas+'</span>'+
                    '</p><br/>'+

                    '<div class="col-md-7"><div class="row">'+
                    '<p><i style="color:#999">'+data[emp].soal_guru+'</i></p>'+
                    '<h3 class="list-group-item-heading name">'+data[emp].soal_pelajaran+'</h3>'+
                    '</div></div>'+
                    '<div class="col-md-5" style="text-align:center;"><div class="row">'+

                    '<div class="btn btn-default" title="Terkumpul">'+data[emp].soal_jumlah_terkumpul+'</div> '+
                    '<div class="btn btn-success" title="Minimal Terkumpul Seharusnya">'+data[emp].soal_jumlah_terkumpul_total+'</div> '+

                    '<a title="Preview" title="Preview" onClick="submitPreview(\''+data[emp].soal_pelajaran+'\',\''+data[emp].soal_guru+'\',\''+data[emp].soal_kelas+'\',\''+data[emp].soal_untuk+'\')" class="btn btn-circle btn-default" style="color: #4c4c4c;" ><span class="fas fa-eye"></span></a>'+
                    '<a title="Export Data" title="Export" onClick="submitExport(\''+data[emp].soal_pelajaran+'\',\''+data[emp].soal_guru+'\',\''+data[emp].soal_kelas+'\',\''+data[emp].soal_untuk+'\')" class="btn btn-circle btn-default" style="color: #6db571;" ><span class="fas fa-file-export"></span></a>'+
                    '<a title="Hapus Data" title="Hapus" onClick="submitHapusDuplikatSoalByReplace(\''+data[emp].soal_pelajaran+'\',\''+data[emp].soal_guru+'\',\''+data[emp].soal_kelas+'\',\''+data[emp].soal_untuk+'\')" class="btn btn-circle btn-default" style="color: #d9534f;" ><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postListTerkumpul').append(empRow);
            }

        }

    }


    function formDialog(id) {

        /**
         * Open Tab Edit Soal
         */

        $('[href="#home"]').tab('show');

        $(".submitselanjutnya").hide();
        $(".model-title-text").html("BUAT SOAL");


        $('#id').val(0);


        $('[name="soal_kelas"]').val("");
        $('[name="soal_kelas"]').selectpicker('refresh');

        $('[name="soal_pelajaran"]').val("");
        $('[name="soal_pelajaran"]').selectpicker('refresh');

        $('[name="soal_guru"]').val("");
        $('[name="soal_guru"]').selectpicker('refresh');

        $('[name="soal_untuk"]').val("");
        $('[name="soal_untuk"]').selectpicker('refresh');

        $('#jenis').val("optional");
        $('#parent').val(0);
        $('[name="soal_jenis"]').val("optional");
        $('[name="soal_jenis"]').prop('disabled', false);

        $('#soal_text_jawab_essay0').val("");
        tinyMCE.get('soal_text').setContent('<p><p>');

        $('input[type="radio"]:checked').prop('checked', false);
        $('input[type="checkbox"]:checked').prop('checked', false);
        for (var y = 0; y <= 4; ++y) {
            tinyMCE.get('soal_text_jawab_optional'+y).setContent('<p><p>');
            tinyMCE.get('soal_text_jawab_checked'+y).setContent('<p><p>');
        }

        $('#optional').css("display","block");
        $('#essay').css("display","none");
        $('#checked').css("display","none");


        $('.submitsimpan').html("");
        $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");
        if(id > 0){

            $(".model-title-text").html("UBAH SOAL");
            $(".submitpengaturan .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            $("#pengaturan").hide();
            $(".submitselanjutnya").show();

            $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "GET",
                data: 'id='+id,
                url: "<?php echo site_url('admin/soalarsip/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(data){
                    console.log(data);

                    $('#id').val(id);
                    $('[name="soal_kelas"]').val(data.soal_kelas);
                    $('[name="soal_kelas"]').selectpicker('refresh');

                    $('[name="soal_pelajaran"]').val(data.soal_pelajaran);
                    $('[name="soal_pelajaran"]').selectpicker('refresh');

                    $('[name="soal_guru"]').val(data.soal_guru);
                    $('[name="soal_guru"]').selectpicker('refresh');

                    $('[name="soal_untuk"]').val(data.soal_untuk);
                    $('[name="soal_untuk"]').selectpicker('refresh');


                    tinyMCE.get('soal_text').setContent(data.soal_text);

                    var jenis = data.soal_jenis;
                    var soal_text_jawab = data.soal_text_jawab;


                    $('#optional').css("display","none");
                    $('#essay').css("display","none");
                    $('#checked').css("display","none");


                    $('#jenis').val(jenis);
                    $('#parent').val(data.soal_parent_id);
                    $('[name="soal_jenis"]').val(jenis);
                    $('[name="soal_jenis"]').prop('disabled', true);

                    if(jenis == "optional"){
                        $('#optional').css("display","block");

                        let initValues = [];
                        for (var i = 0; i < soal_text_jawab.length; ++i) {
                            tinyMCE.get('soal_text_jawab_optional'+i).setContent(soal_text_jawab[i][1]);

                            if(soal_text_jawab[i][0] == 1){
                                initValues.push(i+1);
                            }
                        }

                        $('#_form').find(':radio[name="soal_text_jawab_optional[]"]').each(function() {
                            if (initValues.some(v => v == $(this).val())) {
                                $(this).prop('checked', true);
                            }
                        });


                    }else if(jenis == "checked"){
                        $('#checked').css("display","block");

                        let initValues = [];
                        for (var i = 0; i < soal_text_jawab.length; ++i) {
                            tinyMCE.get('soal_text_jawab_checked'+i).setContent(soal_text_jawab[i][1]);

                            if(soal_text_jawab[i][0] == 1){
                                initValues.push(i+1);
                            }
                        }
                        $('#_form').find(':checkbox[name="soal_text_jawab_checked[]"]').each(function() {
                            if (initValues.some(v => v == $(this).val())) {
                                $(this).prop('checked', true);
                            }
                        });

                    }else if(jenis == "essay"){
                        $('#essay').css("display","block");

                        $('#soal_text_jawab_essay0').val(soal_text_jawab);
                    }


                    searchFilterParent(0);
                    searchFilterBySoal(0);


                    $('#postListParentText').html('');
                    $.ajax({
                        type: "GET",
                        data: 'id='+data.soal_parent_id,
                        url: "<?php echo site_url('admin/soalarsip/ambildatabyid3'); ?>",
                        cache: false,
                        dataType:'json',
                        beforeSend: function () {
                            $('#loading_ajax').show();
                        },
                        success: function(data){
                            console.log(data);

                            //$('#parent').val(id);
                            $('#postListParentText').html(data.soal_parent_text);

                        },
                        complete: function(){
                            $('#loading_ajax').fadeOut("slow");
                        }
                    });




                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }else{


            searchFilterParent(0);

            $(".submitpengaturan .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            $("#pengaturan").show(1000);
        }

    }

    function formDialogBySoal(id) {

        /**
         * Open Tab Edit Soal
         */

        $('[href="#home"]').tab('show');

        $(".submitselanjutnya").hide();
        $(".model-title-text").html("BUAT SOAL");


        $('#id').val(0);


        $('[name="soal_kelas"]').val("");
        $('[name="soal_kelas"]').selectpicker('refresh');

        $('[name="soal_pelajaran"]').val("");
        $('[name="soal_pelajaran"]').selectpicker('refresh');

        $('[name="soal_guru"]').val("");
        $('[name="soal_guru"]').selectpicker('refresh');

        $('[name="soal_untuk"]').val("");
        $('[name="soal_untuk"]').selectpicker('refresh');

        $('#jenis').val("optional");
        $('#parent').val(0);
        $('[name="soal_jenis"]').val("optional");
        $('[name="soal_jenis"]').prop('disabled', false);

        $('#soal_text_jawab_essay0').val("");
        tinyMCE.get('soal_text').setContent('<p><p>');

        $('input[type="radio"]:checked').prop('checked', false);
        $('input[type="checkbox"]:checked').prop('checked', false);
        for (var y = 0; y <= 4; ++y) {
            tinyMCE.get('soal_text_jawab_optional'+y).setContent('<p><p>');
            tinyMCE.get('soal_text_jawab_checked'+y).setContent('<p><p>');
        }

        $('#optional').css("display","block");
        $('#essay').css("display","none");
        $('#checked').css("display","none");


        $('.submitsimpan').html("");
        $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");

        if(id > 0){

            $(".model-title-text").html("UBAH SOAL");
            $(".submitpengaturan .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            $("#pengaturan").hide();
            $(".submitselanjutnya").show();

            $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "GET",
                data: 'id='+id,
                url: "<?php echo site_url('admin/soalarsip/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(data){
                    console.log(data);

                    $('#id').val(id);
                    $('[name="soal_kelas"]').val(data.soal_kelas);
                    $('[name="soal_kelas"]').selectpicker('refresh');

                    $('[name="soal_pelajaran"]').val(data.soal_pelajaran);
                    $('[name="soal_pelajaran"]').selectpicker('refresh');

                    $('[name="soal_guru"]').val(data.soal_guru);
                    $('[name="soal_guru"]').selectpicker('refresh');

                    $('[name="soal_untuk"]').val(data.soal_untuk);
                    $('[name="soal_untuk"]').selectpicker('refresh');


                    tinyMCE.get('soal_text').setContent(data.soal_text);

                    var jenis = data.soal_jenis;
                    var soal_text_jawab = data.soal_text_jawab;


                    $('#optional').css("display","none");
                    $('#essay').css("display","none");
                    $('#checked').css("display","none");


                    $('#jenis').val(jenis);
                    $('#parent').val(data.soal_parent_id);
                    $('[name="soal_jenis"]').val(jenis);
                    $('[name="soal_jenis"]').prop('disabled', true);

                    if(jenis == "optional"){
                        $('#optional').css("display","block");

                        let initValues = [];
                        for (var i = 0; i < soal_text_jawab.length; ++i) {
                            tinyMCE.get('soal_text_jawab_optional'+i).setContent(soal_text_jawab[i][1]);

                            if(soal_text_jawab[i][0] == 1){
                                initValues.push(i+1);
                            }
                        }

                        $('#_form').find(':radio[name="soal_text_jawab_optional[]"]').each(function() {
                            if (initValues.some(v => v == $(this).val())) {
                                $(this).prop('checked', true);
                            }
                        });


                    }else if(jenis == "checked"){
                        $('#checked').css("display","block");

                        let initValues = [];
                        for (var i = 0; i < soal_text_jawab.length; ++i) {
                            tinyMCE.get('soal_text_jawab_checked'+i).setContent(soal_text_jawab[i][1]);

                            if(soal_text_jawab[i][0] == 1){
                                initValues.push(i+1);
                            }
                        }
                        $('#_form').find(':checkbox[name="soal_text_jawab_checked[]"]').each(function() {
                            if (initValues.some(v => v == $(this).val())) {
                                $(this).prop('checked', true);
                            }
                        });

                    }else if(jenis == "essay"){
                        $('#essay').css("display","block");

                        $('#soal_text_jawab_essay0').val(soal_text_jawab);
                    }


                    searchFilterParent(0);
                    searchFilterBySoal(0);


                    $('#postListParentText').html('');
                    $.ajax({
                        type: "GET",
                        data: 'id='+data.soal_parent_id,
                        url: "<?php echo site_url('admin/soalarsip/ambildatabyid3'); ?>",
                        cache: false,
                        dataType:'json',
                        beforeSend: function () {
                            $('#loading_ajax').show();
                        },
                        success: function(data){
                            console.log(data);

                            //$('#parent').val(id);
                            $('#postListParentText').html(data.soal_parent_text);

                        },
                        complete: function(){
                            $('#loading_ajax').fadeOut("slow");
                        }
                    });




                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }else{


            searchFilterParent(0);

            $(".submitpengaturan .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            $("#pengaturan").show(1000);
        }

    }

    function formDialog2Clear() {
        $('#id2').val(0);
        $('[name="soal_pembuat_kelas"]').val("");
        $('[name="soal_pembuat_jurusan"]').val("");

        $('[name="soal_pembuat_pelajaran"]').val("");
        $('[name="soal_pembuat_guru"]').val("");
        $('[name="soal_pembuat_untuk"]').val("");
        $('[name="soal_pembuat_jumlah"]').val("30");

        $('[name="soal_pembuat_kelas"]').tagator('refresh');
        $('[name="soal_pembuat_jurusan"]').selectpicker('refresh');
        $('[name="soal_pembuat_untuk"]').selectpicker('refresh');



        $(".submitsimpan2baru").hide();
        $('.submitsimpan2').html("");
        $('.submitsimpan2').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");

    }

    function formDialog2(id) {
        //$(".model-title-text2").html("BUAT PEMBUAT SOAL");


        $('#id2').val(0);
        $('[name="soal_pembuat_kelas"]').val("");
        $('[name="soal_pembuat_jurusan"]').val("");

        $('[name="soal_pembuat_pelajaran"]').val("");
        $('[name="soal_pembuat_guru"]').val("");
        $('[name="soal_pembuat_untuk"]').val("");
        $('[name="soal_pembuat_jumlah"]').val("30");

        $('[name="soal_pembuat_kelas"]').tagator('refresh');
        $('[name="soal_pembuat_jurusan"]').selectpicker('refresh');
        $('[name="soal_pembuat_untuk"]').selectpicker('refresh');

        $('.submitsimpan2').html("");
        $('.submitsimpan2').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");
        if(id > 0){

            //$(".model-title-text2").html("UBAH PEMBUAT SOAL");
            $(".submitpengaturan2 .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            $("#pengaturan2").hide();
            $("#keywords2Form").hide();

            $('.submitsimpan2').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");
            $(".submitsimpan2").show();
            $(".submitsimpan2baru").show();



            $.ajax({
                type: "GET",
                data: 'id='+id,
                url: "<?php echo site_url('admin/soalarsip/ambildatabyid2'); ?>",
                cache: false,
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(data){
                    console.log(data);

                    $('#id2').val(id);

                    $('[name="soal_pembuat_kelas"]').val(data.soal_pembuat_kelas);
                    $('[name="soal_pembuat_jurusan"]').val(data.soal_pembuat_jurusan);
                    $('[name="soal_pembuat_pelajaran"]').val(data.soal_pembuat_pelajaran);
                    $('[name="soal_pembuat_guru"]').val(data.soal_pembuat_guru);
                    $('[name="soal_pembuat_untuk"]').val(data.soal_pembuat_untuk);
                    $('[name="soal_pembuat_jumlah"]').val(data.soal_pembuat_jumlah);

                    $('[name="soal_pembuat_kelas"]').tagator('refresh');
                    $('[name="soal_pembuat_jurusan"]').selectpicker('refresh');
                    $('[name="soal_pembuat_untuk"]').selectpicker('refresh');


                    $("#datetimepicker1a" ).datepicker({
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
                    }).datetimepicker('setDate', new Date()).val(data.soal_pembuat_tanggal);

                    $("#datetimepicker1b" ).datepicker({
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
                    }).datetimepicker('setDate', new Date()).val(data.soal_pembuat_tanggal_dikumpulkan);

                    $(".submitpengaturan2 .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
                    $("#pengaturan2").show(1000);


                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }else{

            $(".submitpengaturan2 .fa-arrow-down").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            $("#pengaturan2").show(1000);
        }

    }

    function formDialog3(id) {
        $('#parent_id').val(0);
        tinyMCE.get('soal_parent_text').setContent('<p><p>');

        $('.submitsimpanparent').html("");
        $('.submitsimpanparent').html("<i class=\"fa fa-circle-notch fa-spin buttonload2\" style=\"display: none\"></i> Publikasi");
        if(id > 0){


            $('.submitsimpanparent').html("<i class=\"fa fa-circle-notch fa-spin buttonload2\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "GET",
                data: 'id='+id,
                url: "<?php echo site_url('admin/soalarsip/ambildatabyid3'); ?>",
                cache: false,
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(data){
                    console.log(data);

                    $('#parent_id').val(id);
                    tinyMCE.get('soal_parent_text').setContent(data.soal_parent_text);

                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }

    }

    function searchFilterKumpul() {

        formDialog2Clear();

        //$(".model-title-text2").html("Daftar soal yang terkumpul");
        $(".submitpengaturan2 .fa-arrow-up").removeClass("fa-arrow-up").addClass("fa-arrow-down");
        $("#pengaturan2").hide();
        $(".submitsimpan2").hide();

        var keywords = $('#keywords2').val();


        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/soalarsip/ajaxPaginationData1/0',
            data:'page=0&keywords='+keywords,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                paginationDataPembuatSoal(responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function submitSelectParent(x) {
        $('#parent').val(x);
        $('#Notifikasi').html('<p class="alert alert-success">Parent berhasil dipilih!</p>');
        $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

        $('#postListParentText').html('');
        $.ajax({
            type: "GET",
            data: 'id='+x,
            url: "<?php echo site_url('admin/soalarsip/ambildatabyid3'); ?>",
            cache: false,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function(data){
                console.log(data);

                $('#postListParentText').html(data.soal_parent_text);

                searchFilterParent(0);

            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });

    }


    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('admin/soalarsip/hapus') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    searchFilter(0);
                    searchFilterBySoal(0);
                }
            });
        }
    }

    function submitHapus2(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('admin/soalarsip/hapus2') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    searchFilterKumpul();
                }
            });
        }
    }

    function submitHapusParent(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'id='+id,
                url:'<?php echo base_url('admin/soalarsip/hapus_parent') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    searchFilterParent();
                }
            });
        }
    }



    function submitHapusDuplikatSoalByReplace(soal_pelajaran,soal_guru,soal_kelas,soal_untuk) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'GET',
                data: 'kelas='+soal_kelas+
                    '&guru='+soal_guru+
                    '&pelajaran='+soal_pelajaran+
                    '&untuk='+soal_untuk,
                url:'<?php echo base_url('admin/soalarsip/hapus3') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    $('#Notifikasi').html('<p class="alert alert-danger">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    searchFilterTerkumpul(0);

                }
            });
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



