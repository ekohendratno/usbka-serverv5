<?php
defined('BASEPATH') or exit();

class Pengaturan extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');

        if($this->session->userdata('level') != 'admin'){
            redirect('home');
        }

	}
	
	function index(){
		$data['title'] = "Pangaturan";
        $data['lock_ujian'] = $this->m->getpengaturan('lock_ujian');
        $data['lock_client'] = $this->m->getpengaturan('lock_client');
        $data['instansi'] = $this->m->getpengaturan('instansi');
        $data['waktuminimum'] = $this->m->getpengaturan('Waktu Minimal');
        $data['welcome_message'] = $this->m->getpengaturan('welcome_message');
        $data['waktutoken'] = $this->m->getpengaturan('pengaturanToken');
        $data["tahunajaran"] = $this->session->userdata('tahunajaran');
        $data["kegiatan"] = $this->session->userdata('kegiatan');
		
        $this->template->load('template','admin/pengaturan',$data);
	}



    function daftarjurusan(){
        $data_ = array();
        $x = json_decode($this->m->getpengaturan('Jurusan'));

        foreach ($x as $k){
            $data_[] = $k;
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $data_ );
    }


    function tambahdatajurusan(){
        $nama_jurusan = $this->input->post('nama_jurusan');

        $data_ = array();
        $x = json_decode($this->m->getpengaturan('Jurusan'));


        $a = 0;
        foreach ($x as $k){
            $data_[] = $k;
            if($k == $nama_jurusan){
                $a = 1;
            }
        }

        if( $a < 1){
            $data_[] = $nama_jurusan;
        }

        $data = array(
            'pengaturan_value'=>json_encode($data_),
        );


        $where = array(
            'pengaturan_name'=>'Jurusan',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);

    }

    function hapusdatajurusanbyid(){

        $id = $this->input->post('id');

        $data_ = array();
        $x = json_decode($this->m->getpengaturan('Jurusan'));


        foreach ($x as $k){
            if($k != $id) {
                $data_[] = $k;
            }
        }

        $data = array(
            'pengaturan_value'=>json_encode($data_ ),
        );


        $where = array(
            'pengaturan_name'=>'Jurusan',
        );


        $result['pesan'] = "";
        $this->db->where($where);
        $this->db->update('pengaturan',$data);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function simpantahunajaran(){
        $baris = array();
        $baris["tahunajaran"] = $this->input->post("tahunajaran");
        $baris["kegiatan"] = $this->input->post("kegiatan");

        $this->session->set_userdata($baris);

        $data['success'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    function simpandata_lockujian(){


        $result['pesan'] = "";
        $this->db->where(array(
            'pengaturan_name'=>'lock_ujian'
        ));
        $this->db->update('pengaturan',array(
            'pengaturan_value'=>$this->input->post('lock_ujian'),
        ));

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }


    function simpandata_lockclient(){


        $result['pesan'] = "";
        $this->db->where(array(
            'pengaturan_name'=>'lock_client'
        ));
        $this->db->update('pengaturan',array(
            'pengaturan_value'=>$this->input->post('lock_client'),
        ));

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }


    function simpandata_instansi(){


        $result['pesan'] = "";
        $this->db->where(array(
            'pengaturan_name'=>'instansi'
        ));
        $this->db->update('pengaturan',array(
            'pengaturan_value'=>$this->input->post('instansi'),
        ));

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }



    function simpandata_waktuminimum(){

        $result['pesan'] = "";
        $this->db->where(array(
            'pengaturan_name'=>'Waktu Minimal'
        ));
        $this->db->update('pengaturan',array(
            'pengaturan_value' => $this->input->post('waktuminimum'),
        ));

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }


    function simpandata_waktutoken(){

        $result['pesan'] = "";
        $this->db->where(array(
            'pengaturan_name'=>'pengaturanToken'
        ));
        $this->db->update('pengaturan',array(
            'pengaturan_value' => $this->input->post('waktutoken'),
        ));

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function simpandata_welcomepessage(){
        $result['pesan'] = "";
        $this->db->where(array(
            'pengaturan_name'=>'welcome_message'
        ));
        $this->db->update('pengaturan',array(
            'pengaturan_value'=> stripcslashes( trim($this->input->post('wm_text', TRUE)) ),
        ));

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }




    function autocorrect(){


        $this->db->select("*")->from("soal_jawab");

        $data = array();
        foreach($this->db->get()->result() as $row){
            //List jawaban peserta
            $soal_jawab_list_opsi = json_decode($row->soal_jawab_list_opsi);


            $jumlah_soal =  $row->soal_jawab_jumlah_soal;
            $jumlah_benar = 0;
            $jumlah_salah = 0;
            $jumlah_terjawab = 0;
            $jumlah_tidakterjawab = 0;
            $nilai = 0;

            foreach ($soal_jawab_list_opsi as $soal_jawab_list_opsi_item) {
                $id_soal = $soal_jawab_list_opsi_item[0];
                $jenis = $soal_jawab_list_opsi_item[1];
                $ragu = $soal_jawab_list_opsi_item[2];
                $jawaban    = $soal_jawab_list_opsi_item[3]; //0-4

                //jika jenis jawaban optional dan jawaban tidak kosong
                if ($jenis == 'optional') {

                    if( $jawaban != "-" ) {
                        $jawaban_data = array();
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array('soal_id' => $id_soal))->result();
                        foreach ($ambil_soal as $soal) {
                            $soal_text_jawab = json_decode($soal->soal_text_jawab);

                            //samakan jawaban peserta dengan jawaban soal
                            $nomor_jawaban = 0;
                            foreach ($soal_text_jawab as $soal_text_jawab_item) {

                                if ( $soal_text_jawab_item[0] == 1 && $jawaban == $nomor_jawaban) {
                                    $jumlah_benar++;
                                }

                                $nomor_jawaban++;
                            }

                        }

                        $jumlah_terjawab++;
                    }

                    //}elseif ($jenis == 'checkbox' && $jawaban != "" && $jawaban != "-") {
                    //}elseif ($jenis == 'essay' && $jawaban != "" && $jawaban != "-") {
                }else{
                    $jumlah_tidakterjawab++;
                }


            }

            $jumlah_salah = $jumlah_soal - $jumlah_benar;


            if ($jumlah_soal == 40) {
                $nilai = ($jumlah_benar * 25) / 10;
            } elseif ($jumlah_soal == 30) {
                $nilai = ($jumlah_benar / 3) * 10;
            } elseif ($jumlah_soal == 25) {
                $nilai = $jumlah_benar * 4;
            }


            $nilai = round($nilai, 2);
            $nilai_bulat = round($nilai);



            $data = array(
                'soal_jawab_benar' => $jumlah_benar,
                'soal_jawab_salah' => $jumlah_salah,
                'soal_jawab_nilai' => $nilai,
                'soal_jawab_ok' => $jumlah_soal,
                'soal_jawab_none' => $jumlah_tidakterjawab,
                'soal_jawab_selesai' => date('Y-m-d H:i:s'),
                'soal_jawab_last_update' => date('Y-m-d H:i:s'),
                'soal_jawab_status' => 'N'
            );


            $this->db->where(array("soal_jawab_id" => $row->soal_jawab_id));
            $this->db->update('soal_jawab',(array)$data);

            //sleep(1);
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode(array("success"=> true));
    }



    function arsipkansoalujian(){


	    /**
        foreach($this->db->get_where("soal",array())->result_array() as $row){
            $id = $row['soal_id'];

            $no = true;
            if($this->db->get_where("soal_arsip",array("soal_id"=>$id))->num_rows() > 0){
                $no = false;
            }


            if( $no ){
                $prefix1 = $this->db->dbprefix('soal_arsip');
                $prefix2 = $this->db->dbprefix('soal');

                $this->db->query("INSERT INTO $prefix1 (SELECT * FROM $prefix2 WHERE soal_id = $id)");
            }

        }*/

        $tahunajaran = $this->session->userdata('tahunajaran');


        $soal = $this->db->dbprefix('soal');
        $soal_pembuat = $this->db->dbprefix('soal_pembuat');
        $soal_parent = $this->db->dbprefix('soal_parent');
        $soal_jawab = $this->db->dbprefix('soal_jawab');
        $ujian = $this->db->dbprefix('ujian');

        $this->db->query("INSERT INTO ".$soal."_arsip (SELECT * FROM ".$soal." WHERE soal_tahunajaran='$tahunajaran')");
        $this->db->query("INSERT INTO ".$soal_pembuat."_arsip (SELECT * FROM ".$soal_pembuat." WHERE soal_pembuat_tahunajaran='$tahunajaran')");
        $this->db->query("INSERT INTO ".$soal_parent."_arsip (SELECT * FROM ".$soal_parent." WHERE soal_parent_tahunajaran='$tahunajaran')");
        $this->db->query("INSERT INTO ".$soal_jawab."_arsip (SELECT * FROM ".$soal_jawab." WHERE soal_jawab_tahunajaran='$tahunajaran')");
        $this->db->query("INSERT INTO ".$ujian."_arsip (SELECT * FROM ".$ujian." WHERE ujian_tahunajaran='$tahunajaran')");


        /**
        $this->db->where('soal_id != 0');
        $this->db->delete('soal');

        $this->db->where('soal_pembuat_id != 0');
        $this->db->truncate('soal_pembuat');

        $this->db->where('soal_parent_id != 0');
        $this->db->truncate('soal_parent');

        $this->db->where('soal_jawab_id != 0');
        $this->db->truncate('soal_jawab');

        $this->db->where('ujian_id != 0');
        $this->db->truncate('ujian');
         */


        /**
        $this->db->where('soal_arsip',0);
        $this->db->update('soal',array('soal_arsip' => 1));

        $this->db->where('soal_pembuat_arsip',0);
        $this->db->update('soal_pembuat',array('soal_pembuat_arsip' => 1));

        $this->db->where('soal_parent_arsip',0);
        $this->db->update('soal_parent',array('soal_parent_arsip' => 1));

        $this->db->where('soal_jawab_arsip',0);
        $this->db->update('soal_jawab',array('soal_jawab_arsip' => 1));

        $this->db->where('ujian_arsip',0);
        $this->db->update('ujian',array('ujian_arsip' => 1));
         */

        $this->db->truncate('soal');
        $this->db->truncate('soal_pembuat');
        $this->db->truncate('soal_parent');
        $this->db->truncate('soal_jawab');
        $this->db->truncate('ujian');


        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode(array("success"=> true));
    }



    function arsipkanpeserta(){

        foreach($this->db->get_where("peserta",array("peserta_kelas" => "12"))->result_array() as $row){
            $id = $row['peserta_id'];

            $no = true;
            if($this->db->get_where("peserta_arsip",array("peserta_id"=>$id))->num_rows() > 0){
                $no = false;
            }

            if( $no ){
                $prefix1 = $this->db->dbprefix('peserta_arsip');
                $prefix2 = $this->db->dbprefix('peserta');

                $this->db->query("INSERT INTO $prefix1 (SELECT * FROM $prefix2 WHERE peserta_id = $id)");

                $this->db->where(array("peserta_kelas" => "11"));
                $this->db->update("peserta",array("peserta_kelas" => "12"));

                $this->db->where(array("peserta_kelas" => "10"));
                $this->db->update("peserta",array("peserta_kelas" => "11"));

            }

        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode(array("success"=> true));
    }








    function resetwelcome(){

        $this->db->where( array(
            'pengaturan_name'=>'welcome'
        ));
        $this->db->delete('pengaturan');
    }
	
	function hapusdatabyid(){			
		
		$id = $this->input->post('id');
		
		$this->db->where( array(
			'ta_id'=>$id
		));
		$this->db->delete('ta');	
	}


    function resetdataall(){
        $this->db->truncate('jurusan');
        $this->db->truncate('pengajar');
        $this->db->truncate('pesan');
        $this->db->truncate('ujian');
        $this->db->truncate('soal');
        $this->db->truncate('pelajaran');
        $this->db->truncate('guru');
        $this->db->truncate('siswa');

        $this->db->truncate('pengaturan');
        $this->db->insert('pengaturan',array(
            'pengaturan_name'  => 'instansi',
            'pengaturan_value' => ''
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_name'  => 'lock_ujian',
            'pengaturan_value' => 'y'
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_name'  => 'welcome_message',
            'pengaturan_value' => ''
        ));



        $result['pesan'] = "";
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }





    function daftarta(){

        $users_pengaturan = $this->db->select('*')->from('ta')->order_by('ta_tahun','desc');

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $users_pengaturan->get()->result());
    }



    function kuncidataby_ta(){
        $id = $this->input->post('id');

        $this->m->simpanbyid(array('ta_lock'=>0),array(),'ta');
        $this->m->simpanbyid(array('ta_lock'=>1),array('ta_id'=>$id),'ta');

        $result['pesan'] = "";
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $result );
    }

    function arsipdataby_ta(){
        $id = $this->input->post('id');

        $pengaturan = $this->db->select('*')->from('ta')->where('ta_id',$id);
        foreach ($pengaturan->get()->result() as $tt){
            $ar = 0;
            if($tt->ta_arsip == 0){
                $ar = 1;
            }

            $this->m->simpanbyid(array('ta_arsip'=>$ar),array('ta_id'=>$id),'ta');
        }

        $result['pesan'] = "";
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $result );
    }


    function kuncidataby_ta_reset(){
        $this->m->simpanbyid(array('ta_lock'=>0),array(),'ta');

        $result['pesan'] = "";
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $result );
    }

    function republishby_ta(){
        $id = $this->input->post('id');
        $this->m->simpanbyid(array('ta_aktif'=>0),array(),'ta');
        $this->m->simpanbyid(array('ta_aktif'=>1),array('ta_id'=>$id),'ta');

        $result['pesan'] = "";
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $result );
    }

    function tambahdataby_ta(){
        $tahun = $this->input->post('tahun');
        $semester = $this->input->post('semester');

        $data = array(
            'ta_tahun'=>$tahun,
            'ta_semester'=>$semester
        );

        $ada = $this->db->select('*')->from('ta')->where($data)->get();

        if($ada->num_rows() > 0) $result['pesan'] = "Data sudah ada!";
        else{
            $result['pesan'] = "";
            $this->db->insert('ta',$data);
            $id = $this->db->insert_id();
            $result['id'] = $id;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $result );
    }


    function hapusdataby_ta(){

        $id = $this->input->post('id');

        $this->db->where('ta_id',$id);
        $this->db->delete('ta');
    }
}

?>