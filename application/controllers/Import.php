<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'third_party/PHPExcel/PHPExcel.php';

class Import extends CI_Controller {
    function __construct() {
        parent::__construct();

		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');
		
		if( empty($this->session->userdata('level')) ){
			redirect('auth');
		}
		
		$this->user_id = $this->session->userdata('user_id');

    }



    function siswa() {

		$idx_baris_mulai = 3;
		$idx_baris_selesai = 1000;

		$target_file = './uploads/temp/';
		$buat_folder_temp = !is_dir($target_file) ? @mkdir("./uploads/temp/") : false;

		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file.$_FILES['file']['name']);

		$file   = explode('.',$_FILES['file']['name']);
		$length = count($file);

		$result = array();
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls') {

			$tmp    = './uploads/temp/'.$_FILES['file']['name'];
			//Baca dari tmp folder jadi file ga perlu jadi sampah di server :-p

			$read   = PHPExcel_IOFactory::createReaderForFile($tmp);
			$read->setReadDataOnly(true);
			$excel  = $read->load($tmp);

			$_sheet = $excel->setActiveSheetIndexByName('siswa');

			$data = array();
			$result['pesan'] = "Format template tidak sesuai";
			for ($j = $idx_baris_mulai; $j <= $idx_baris_selesai; $j++) {

				$_nomor = $_sheet->getCell("B".$j)->getCalculatedValue(); 	//nomor
				$_ruangan = $_sheet->getCell("C".$j)->getCalculatedValue(); //ruang
				$_nis = $_sheet->getCell("D".$j)->getCalculatedValue(); 	//nis
				$_nama = $_sheet->getCell("E".$j)->getCalculatedValue();	//nama
				$_jk = $_sheet->getCell("F".$j)->getCalculatedValue();		//jk
				$_kelas = $_sheet->getCell("G".$j)->getCalculatedValue();	//kelas
				$_jurusan = $_sheet->getCell("H".$j)->getCalculatedValue();	//jurusan
				$_ke = $_sheet->getCell("I".$j)->getCalculatedValue();		//ke
				$_agama = $_sheet->getCell("J".$j)->getCalculatedValue();		//agama

				if ( $_nama != "" ) {
					$item = array();
					$item['peserta_nomor'] = $_nomor;
					$item['peserta_ruangan'] = $_ruangan;

					$item['peserta_nis'] = $_nis;
					$item['peserta_nama'] = strtoupper( $_nama );
					$item['peserta_jk'] = strtoupper( $_jk );

					$item['peserta_kelas'] = $_kelas;
					$item['peserta_jurusan'] = $_jurusan;
					$item['peserta_jurusan_ke'] = $_ke;

					$item['peserta_agama'] = ucfirst( $_agama );

					array_push($data,$item);
				}
			}

			if( sizeof($data) > 0 ){
				$this->db->insert_batch('peserta',$data);
				$result['pesan'] = "";
			}

		} else {
			$result['pesan'] = "Bukan File Excel...";
		}



		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
    }

	function guru() {

		$idx_baris_mulai = 3;
		$idx_baris_selesai = 1000;

		$target_file = './uploads/temp/';
		$buat_folder_temp = !is_dir($target_file) ? @mkdir("./uploads/temp/") : false;

		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file.$_FILES['file']['name']);

		$file   = explode('.',$_FILES['file']['name']);
		$length = count($file);

		$result = array();
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls') {

			$tmp    = './uploads/temp/'.$_FILES['file']['name'];
			//Baca dari tmp folder jadi file ga perlu jadi sampah di server :-p

			$read   = PHPExcel_IOFactory::createReaderForFile($tmp);
			$read->setReadDataOnly(true);
			$excel  = $read->load($tmp);

			$_sheet = $excel->setActiveSheetIndexByName('guru');

			$data = array();
			$result['pesan'] = "Format template tidak sesuai";
			for ($j = $idx_baris_mulai; $j <= $idx_baris_selesai; $j++) {

				$_nomor = $_sheet->getCell("A".$j)->getCalculatedValue(); 	//nomor
				$_nip = $_sheet->getCell("B".$j)->getCalculatedValue(); 	//nip
				$_nama = $_sheet->getCell("C".$j)->getCalculatedValue();	//nama
				$_jk = $_sheet->getCell("D".$j)->getCalculatedValue();		//jk
				$_agama = $_sheet->getCell("E".$j)->getCalculatedValue();		//agama

				if ( $_nama != "" ) {
					$item = array();
					//$item['guru_nomor'] = $_nomor;

					//$item['guru_nip'] = $_nip;
					$item['guru_nama'] = strtoupper( $_nama );
					$item['guru_jk'] = strtoupper( $_jk );

					$item['guru_agama'] = ucfirst( $_agama );

					array_push($data,$item);
				}
			}

			if( sizeof($data) > 0 ){
				$this->db->insert_batch('guru',$data);
				$result['pesan'] = "";
			}

		} else {
			$result['pesan'] = "Bukan File Excel...";
		}



		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}

	function soal() {
		if( empty($_FILES['file']['name']) ) die();

		$soal_jenis = $this->input->post('soal_jenis');
		$soal_untuk = $this->input->post('soal_untuk');
		$soal_pelajaran = $this->input->post('soal_pelajaran');
		$soal_guru = $this->input->post('soal_guru');

		$soal_kelas = $this->input->post('soal_kelas');
		$soal_jurusan = $this->input->post('soal_jurusan');
		$soal_jurusan_ke = $this->input->post('soal_jurusan_ke');

		$idx_baris_mulai = 3;
		$idx_baris_selesai = 100;

		$target_file = './uploads/temp/';
		$buat_folder_temp = !is_dir($target_file) ? @mkdir("./uploads/temp/") : false;

		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file.$_FILES['file']['name']);

		$file   = explode('.',$_FILES['file']['name']);
		$length = count($file);

		$result = array();
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls') {

			$tmp    = './uploads/temp/'.$_FILES['file']['name'];
			//Baca dari tmp folder jadi file ga perlu jadi sampah di server :-p

			$read   = PHPExcel_IOFactory::createReaderForFile($tmp);
			$read->setReadDataOnly(true);
			$excel  = $read->load($tmp);

			$_sheet = $excel->setActiveSheetIndexByName('soal');

			$data = array();
			$result['pesan'] = "Format template tidak sesuai";
			for ($j = $idx_baris_mulai; $j <= $idx_baris_selesai; $j++) {
				$tanya = $_sheet->getCell("B".$j)->getCalculatedValue();
				$jawab_a = $_sheet->getCell("C".$j)->getCalculatedValue();
				$jawab_b = $_sheet->getCell("D".$j)->getCalculatedValue();
				$jawab_c = $_sheet->getCell("E".$j)->getCalculatedValue();
				$jawab_d = $_sheet->getCell("F".$j)->getCalculatedValue();
				$jawab_e = $_sheet->getCell("G".$j)->getCalculatedValue();
				$jawab = $_sheet->getCell("H".$j)->getCalculatedValue();

				if ( $tanya != "" ) {
					$item = array();

					$item['soal_jenis'] = $soal_jenis;
					$item['soal_untuk'] = $soal_untuk;
					$item['soal_pelajaran'] = $soal_pelajaran;
					$item['soal_guru'] = $soal_guru;

					$item['soal_kelas'] = $soal_kelas;
					$item['soal_jurusan'] = $soal_jurusan;
					$item['soal_jurusan_ke'] = $soal_jurusan_ke;

					$item['soal_text_judul'] = $tanya;
					$item['soal_text_opsi1'] = $jawab_a;
					$item['soal_text_opsi2'] = $jawab_b;
					$item['soal_text_opsi3'] = $jawab_c;
					$item['soal_text_opsi4'] = $jawab_d;
					$item['soal_text_opsi5'] = $jawab_e;
					$item['soal_text_jawab'] = $jawab;

					array_push($data,$item);
				}
			}

			if( sizeof($data) > 0 ){
				$this->db->insert_batch('soal',$data);
				$result['pesan'] = null;
			}

		} else {
			$result['pesan'] = "Bukan File Excel...";
		}



		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}

	function soalby_arsip(){



		$tanggal	= date('Y-m-d H:i:s');

		$soal_tahunajaran = $this->input->post('soal_tahunajaran_copy');
		$soal_tahunajaran2 = $this->session->userdata('tahunajaran');

		$soal_untuk = $this->input->post('soal_untuk_copy');
		$soal_untuk2 = $this->input->post('soal_untuk2_copy');

		$soal_kelas = $this->input->post('soal_kelas_copy');
		$soal_pelajaran = $this->input->post('soal_pelajaran_copy');
		$soal_pelajaran_untuk = $this->input->post('soal_pelajaran_copy_untuk');
		$soal_guru = $this->input->post('soal_guru_copy');

		$response = array();
		$response["response"] = array();
		$response["success"] = false;

		$soalarsip = $this->db->order_by("soal_id","asc")->get_where("soal",array(
			'soal_tahunajaran' => $soal_tahunajaran,
			'soal_kelas' => $soal_kelas,
			'soal_pelajaran' => $soal_pelajaran,
			'soal_guru' => $soal_guru,
			'soal_untuk' => $soal_untuk
		));


		foreach ($soalarsip->result() as $row){

			$this->db->query("			
			
			INSERT INTO cbt_soal (
				`soal_id`,
				`soal_jenis`,
				`soal_text`,
				`soal_text_deskripsi`,
				`soal_text_jawab`,
				`soal_date`,
				`soal_date_update`,
				`soal_pelajaran`,
				`soal_guru`,
				`soal_untuk`,
				`soal_kelas`,
				`soal_parent_id`,
				`soal_tahunajaran`
			) 
			SELECT 
				NULL, 		
				`soal_jenis`,
				`soal_text`,
				`soal_text_deskripsi`,
				`soal_text_jawab`,
				`soal_date`,
				`soal_date_update`,
				`soal_pelajaran`,
				`soal_guru`,
				`soal_untuk`,
				`soal_kelas`,
				`soal_parent_id`,
				`soal_tahunajaran`				
			 FROM cbt_soal WHERE soal_id='$row->soal_id'
			
			");

			$insert_id = $this->db->insert_id();


			$this->db->where('soal_id', $insert_id);
			$this->db->update('soal', array(
				'soal_untuk' => $soal_untuk2,
				'soal_pelajaran' => $soal_pelajaran_untuk,
				'soal_tahunajaran' => $soal_tahunajaran2,
				'soal_date' => $tanggal,
				'soal_date_update' => $tanggal
			));

		}

		//pembuat
		/**
		 * Jika pembuat soal tahunajaran pilih ada maka
		 * Jika pembuat soal tahunajaran sekarang tidak ada maka
		 * Insert
		 */

		$pembuat = $this->db->like('soal_pembuat_kelas',$soal_kelas)->get_where('soal_pembuat', array(
			'soal_pembuat_tahunajaran' => $soal_tahunajaran,
			'soal_pembuat_pelajaran' => $soal_pelajaran,
			'soal_pembuat_guru' => $soal_guru,
			'soal_pembuat_untuk' => $soal_untuk
		));

		$id = 0;
		foreach ($pembuat->result() as $p) {
			//jika ada cek data lain
			$pembuat_cek = $this->db->like('soal_pembuat_kelas',$soal_kelas)->get_where('soal_pembuat', array(
				'soal_pembuat_tahunajaran' => $soal_tahunajaran2,
				'soal_pembuat_untuk' => $soal_untuk2,

				'soal_pembuat_pelajaran' => $p->soal_pembuat_pelajaran,
				'soal_pembuat_guru' => $p->soal_pembuat_guru,
				'soal_pembuat_jurusan' => $p->soal_pembuat_jurusan
			));

			//jika tidak ada insert data lain
			if($pembuat_cek->num_rows() <= 0){

				$this->db->insert('soal_pembuat',array(
					'soal_pembuat_tahunajaran' => $soal_tahunajaran2,
					'soal_pembuat_untuk' => $soal_untuk2,

					'soal_pembuat_kelas' => $p->soal_pembuat_kelas,
					'soal_pembuat_pelajaran' => $p->soal_pembuat_pelajaran,
					'soal_pembuat_guru' => $p->soal_pembuat_guru,
					'soal_pembuat_jurusan' => $p->soal_pembuat_jurusan,

					'soal_pembuat_jumlah' => $p->soal_pembuat_jumlah,
					'soal_pembuat_tanggal' => $tanggal,
					'soal_pembuat_tanggal_dikumpulkan' => $tanggal
				));

				$id = $this->db->insert_id();
			}
		}


		$response["success"] = true;
		$response["id"] = $id;


		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response);




	}
}
?>
