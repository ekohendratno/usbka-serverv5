<div class="wrapper" style="height: auto; min-height: 100%;">
<div class="container container-medium">


        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
				<div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title text-center" style="padding-top: 7.5px;">DATA PENGATURAN</h4>
                    </div>
					<div class="panel-body" style="min-height: 200px;">
						
						
						<label>Tahun Ajaran</label><br/>
						<select class="form-control" id="ta" name="ta">
						</select>
						
				</div>
			</div>
		</div>
</div>
</div>

	<script type="text/javascript">	
		
		$('.panel-footer').hide();
		
		callTA();
		function callTA(){			
			$('#ta')
				.children()
				.remove()
				.end()
				.append('<option value="">Loading...</option>');
			
			$.ajax({
				type:'POST',
                url:'<?php echo base_url('siswa/pengaturan/daftarta') ;?>',
                dataType: 'json',
                success: function(data){

                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){

                        var semester = data[i].semester;


                        var selected = '';
                        if(data[i].selected == 1){
                            selected = ' selected="selected"';
                        }
						
						
						html += '<option value="'+data[i].id+'"'+selected+'>'+data[i].tahun+' - ('+semester.toUpperCase()+')</option>';
					}
					$('#ta').empty();
					$('#ta').html(html);
				}
			});
		}
		
		$("#ta").change(function(){	
			republish();
		});
		
		function republish(){
			var id = $('#ta').val();
			
			$.ajax({
					type: 'POST',
					data: 'id='+id,
					url: '<?php echo base_url(); ?>index.php/ta/edit',
					beforeSend: function () {
						$('#loading_ajax').show();
					},
					success: function (respon) {
						$('#loading_ajax').fadeOut("slow");


                        if(respon.pesan == '' ){
                            window.location.assign("<?php echo base_url();?>auth/logout");
                        }
					}
			});
		}
		
	</script>