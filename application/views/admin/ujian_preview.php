
<script src="<?php echo base_url('assets/admin/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/sweetalert/sweetalert.min.js"></script>

<link rel='dns-prefetch' href='<?php echo base_url();?>' />

<link href="<?php echo base_url('assets/admin/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/css/custom.css') ?>" rel="stylesheet">

<link href="<?php echo base_url('assets/admin/css/ujian.css') ?>" rel="stylesheet">
<script src="<?php echo base_url();?>assets/admin/js/tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image"></script>

<style type="text/css">
    body{
        background: #f2f2f2;
    }

</style>
<div class="wrapper" style="height: auto; min-height: 100%;">

	<div class="container container-medium">

        <div class="row">
            <!-- Blog Entries Column -->

            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">

                            <?php
                            $html  = '';
                            $arr_jawab = array();

                            $no = 1;
                            foreach($soal as $item){

                                $html .= '<div class="step" id="widget_'.$no.'">';


                                $html .= '<div style="border-bottom: 1px solid #ddd; text-align: center">';
                                $html .= '<div class="btn btn-default btn-circle text-center" style="margin-bottom: -15px">'.$no.'</div>';
                                $html .= '</div>';
                                $html .= '<div class="soal">'.html_entity_decode( $item['soal_text'] ).'</div>';

                                $soal_text_jawab = json_decode($item['soal_text_jawab']);
                                $html .= '<div class="funkyradio">';

                                $opsi = array("1","2","3","4","5");
                                $opsi2 = array("A","B","C","D","E");
                                for($j = 0; $j<=4; $j++) {

                                    $opsional = 'opsi_' . $opsi[$j] . '_' . $no;
                                    $checked = $soal_text_jawab[$j][0] == 1 ? "checked" : "";
                                    //$jawaban1 = empty($jawaban[0][$j]) ? '-' : $jawaban[$j];

                                    $html .= '<div class="funkyradio-success">';
                                    $html .= '<input disabled type="radio" id="'.$opsional.'" name="opsi_'.$no.'" value="'.strtoupper($opsi[$j]).'" '.$checked.'>';
                                    $html .= '<label for="'.$opsional.'"><div class="huruf_opsi">'.strtoupper($opsi2[$j]).'</div><div class="huruf_opsi_jawaban"><p></p>'.html_entity_decode( $soal_text_jawab[$j][1]).'<p></p></div></label>';
                                    $html .= '</div>';
                                }
                                $html .= '</div>';



                                $html .= '<div>';
                                $html .=  "Jawaban Peserta: <strong>".strtoupper($item['jawaban'])."</strong>";
                                $html .= '</div>';


                                $html .= '</div>';

                                $no++;

                            }

                            echo $html;
                            ?>


                        </div>
                    </div>


                </div>

            </div>
		</div>






	</div>
	</div>
