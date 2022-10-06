<script type="text/javascript">$('#loading_ajax').show();</script>
<style type="text/css">
    #loading_ajax{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: 50% 50% no-repeat rgba(0,0,0,0.80);
    }
    .panel-title-button a.btn {
        color: #fff;
    }
</style>
<script src="<?php echo base_url(); ?>assets/admin/js/countdown/jquery.countdownTimer.js"></script>
<div class="wrapper" style="height: auto; min-height: 100%;">
    <div class="container container-medium">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
				<div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title text-center" style="padding-top: 7.5px;">KONFIRMASI SOAL &amp; TOKEN</h4>
                    </div>
					<div class="panel-body">

						<div class="row">

						    <input type="hidden" name="_ujian_id" id="_ujian_id" value="<?php echo $ujians["ujian_id"];?>">
						    <input type="hidden" name="_ujian_mulai" id="_ujian_mulai" value="<?php echo $ujians["ujian_tanggal_mulai"];?>">
						    <input type="hidden" name="_ujian_terlambat" id="_ujian_terlambat" value="<?php echo $ujians["ujian_tanggal_terlambat"];?>">
						    <input type="hidden" name="_status" id="_status" value="<?php echo $status;?>">

							<div class="col-md-8">

								<table class="table-noborder table table-borderless">
									<tbody>

                                    <tr><td class="text-left"><strong>Token</strong><br/>
                                            <input autofocus type="text" class="form-control input-lg" name="token" id="token" placeholder="Masukkan kode token disini">
                                        </td></tr>
										<tr><td class="text-left"><strong>Pelajaran</strong><br/><h4><?php echo $ujians["ujian_pelajaran"];?></h4></td></tr>
										<tr><td class="text-left"><strong>Waktu</strong><br/><h4><?php echo $ujians["ujian_waktu"];?> Menit</h4></td></tr>

									</tbody>
								</table>
                                <div class="alert alert-danger text-center" id="waktu_" style="margin-top: 20px">Sisa waktu mengikuti ujian <br>
                                    <span id="waktu_akhir_ujian"></span>
                                </div>

                                <div class="text-center" id="waktu_game_over"></div>



							</div>

                            <div class="col-md-4">
                                <!--<a href="<?php echo base_url(). "index.php/siswa/ujian/index"; ?>" class="btn btn-default"><span class="glyphicon glyphicon-menu-left"></span> Kembali</a>
								<button onclick="mulaiUjian()" type="button" id="btn-mulai" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Kerjakan</button>
								<br/><br/>-->

                                <div class="alert alert-info text-center">Waktu boleh mengerjakan ujian adalah saat tombol "<strong>MULAI</strong>" berwarna hijau..!</div>


                                <div class="text-center"><div id="btn_mulai">Ujian akan mulai dalam <div id="akan_mulai"></div></div></div>

                            </div>
						</div>


					</div>
				</div>
			</div>
		</div>
        <div class="clear"><br><br></div>
	</div>
</div>




	<script type="text/javascript">


        $('.navbar-right').attr("style", "display:none;");
        $('#bs-example-navbar-collapse-1').append( "<div class=\"panel-title-button pull-right\"></div>");
        //$('#bs-example-navbar-collapse-1').html('<div class="panel-title-button pull-right"></div>');
        $('.panel-title-button').attr("style", "display:block; margin-top:10px; margin-right:15px;");
        $('#btn_mulai').detach().prependTo( $('.panel-title-button') );

		$('#loading_ajax').show();
		$('#loading_ajax').fadeOut("slow");

		timer();

		function mulaiUjian(){

            $('#tbl_mulai').removeClass('btn-success');
            $('#tbl_mulai').addClass('btn-default');
            $("#tbl_mulai").attr("disabled", true);
            $("#token").attr("disabled", true);

			var id = $('#_ujian_id').val();
			var token = $('#token').val();
			if(token != ''){
				$.ajax({
					type:'GET',
					data: 'code='+token,
					url:'<?php echo base_url('token');?>',
					dataType: 'json',
					beforeSend: function () {
						$('#loading_ajax').show();
					},
					success: function(hasil){
						console.log(hasil);
						$('#loading_ajax').fadeOut("slow");

						if( hasil.success ){
                            swal({
                                title: "Token Benar!",
                                text: "Tunggu halaman sedang di alihkan",
                                icon: "success",
                                buttons: false,
                                dangerMode: false,
                                allowOutsideClick: false,
                                closeOnClickOutside: false,
                            });
                            $.ajax({
                                type: 'POST',
                                data: 'id=' + id,
                                url: '<?php echo base_url("siswa/ujian/token");?>',
                                success: function (data) {
                                    
                                    //console.log();
                                    
                                    var _id = data._id;
                                    setTimeout(function () {
                                        window.location.assign("<?php echo base_url();?>siswa/ujian/mulai?id="+_id);
                                    },3000);
                                }
                            });
						}else{

                            $('#tbl_mulai').removeClass('btn-default');
                            $('#tbl_mulai').addClass('btn-success');

                            $("#token").val('');

                            swal("Token Salah!", "Token yang dimaksukkan salah!", "error");
                            //alert("Token yang dimaksukkan salah!");

                            $("#tbl_mulai").attr("disabled", false);
                            $("#token").attr("disabled", false);

							//console.log(hasil);
							//window.location.assign("<?php echo base_url();?>siswa/ujian/mulai");
						}
					}
				});
			}else{
                $("#tbl_mulai").attr("disabled", false);
                $("#token").attr("disabled", false);

                $('#tbl_mulai').removeClass('btn-default');
                $('#tbl_mulai').addClass('btn-success');

                swal("Token Kosong!", "Harap isi token dahulu!", "error");
				//alert("Harap isi token dahulu!");
			}
		}

		function timer() {
			var _tanggal_sekarang = new Date();
            var _ujian_mulai = $("#_ujian_mulai").val();
            var _ujian_terlambat = $("#_ujian_terlambat").val();
			var _status = $("#_status").val();

			if (_status == 1) {
				$("#btn_mulai").html('<a href="#" onclick="mulaiUjian()" class="btn btn-success" id="tbl_mulai">MULAI UJIAN</a>');

				$('#waktu_akhir_ujian').countdowntimer({
					startDate : _tanggal_sekarang,
					dateAndTime : _ujian_terlambat,
					size : "lg",
					labelsFormat : true,
					timeUp : hilangkan_tombol,
				});
			} else if (_status == 0) {
				$("#btn_mulai").addClass("alert alert-success");
				$("#waktu_").hide();
				$('#akan_mulai').countdowntimer({
					startDate : _tanggal_sekarang,
					dateAndTime : _ujian_mulai,
					size : "lg",
					labelsFormat : true,
					timeUp : timeIsUp,
				});
			} else if (_status == 2) {
				hilangkan_tombol();
			} else {
				hilangkan_tombol();
			}
		}

		function timeIsUp() {
			var _ujian_id = $("#_ujian_id").val();

			$("#btn_mulai").html('<a href="#" onclick="mulaiUjian()" class="btn btn-success" id="tbl_mulai">MULAI UJIAN</a>');
		}

		function hilangkan_tombol() {
			$("#btn_mulai").hide();
			$("#waktu_").hide();
			$(".panel-title-button").html('<a class="btn btn-danger" onclick="return alert(\'Waktu selesai..!\')">Waktu Ujian Selesai</a>');
		}

        $('#loading_ajax').fadeOut("slow");
	</script>