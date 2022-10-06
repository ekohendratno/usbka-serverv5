<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
    function __construct() {
        parent::__construct();

    }

    function index(){
    	$for = $this->input->get('for');

		$file = '';

		if( $for == 'windows' ){
			$file = FCPATH . 'uploads/usbkclient.zip'; //not public folder
		}

		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/vnd.android.package-archive');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}else{
			redirect('');
		}
	}


	function android(){

		$version = $this->db->select('*')->from('version')->order_by('version_tanggal','desc')->limit(1)->get();

		foreach ($version->result() as $v){
			$hits = $v->version_hits;

			$this->db->where("version_nomor",$v->version_nomor);
			$this->db->update("version",array("version_hits" => ($hits+1) ));

			redirect( $this->config->item('serverapi1') .'/assets/update/cbt'.$v->version_nomor.'.apk');
		}


	}
}
?>
