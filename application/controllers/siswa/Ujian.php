<?php
defined('BASEPATH') or exit();

class Ujian extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');
		
		
		if($this->session->userdata('level') != 'siswa'){
			redirect('auth/client');
		}
		
		$this->user_id = $this->session->userdata('uid');
        $this->siswa_id = $this->session->userdata('uid');
        $this->siswa_agama = $this->session->userdata('agama');
        $this->kelas_sekarang = $this->session->userdata('kelas');
        $this->jurusan_id = $this->session->userdata('jurusan');
        $this->ruang = $this->session->userdata('jurusan_ke');
        $this->ruangan = $this->session->userdata('ruangan');


        $this->tahunajaran = $this->m->tahunajaran();

	}
	
	function index(){
		
		$data2['title'] = "Ujian";
		$data2['kelas'] = 0;
		$data2['jurusan'] = 0;
		$data2['ruang'] = 0;
		
        $this->template->load('template_siswa','siswa/ujian',$data2);
	}
	
	
	function simpan_akhir(){
        $id = $this->input->get('id');

        $soal_jawab = $this->db->get_where('soal_jawab',array(
            'soal_jawab_id'=> $id,
            'soal_jawab_tahunajaran'=>$this->tahunajaran
        ))->result();

        $dx = array();
        foreach ($soal_jawab as $x) {

            $pc_jawaban = json_decode($x->soal_jawab_list_opsi);

            $jumlah_soal = $x->soal_jawab_jumlah_soal;
            $jumlah_benar = 0;
            $jumlah_salah = 0;
            $jumlah_terjawab = 0;
            $jumlah_tidakterjawab = 0;
            $nilai = 0;

            foreach ($pc_jawaban as $val) {
                //$pc_ret_urn = explode(":", $value);

                $id_soal = $val[0];
                $jenis = $val[1];
                $ragu = $val[2];
                $jawaban = $val[3];

                if ($jenis == 'optional') {

                    if( $jawaban != "-" ) {
                        $jawaban_data = array();
                        //cari jawaban pada soal dengan $id_soal
                        $ambil_soal = $this->db->get_where('soal', array(
                            'soal_id' => $id_soal,
                            'soal_tahunajaran'=>$this->tahunajaran
                        ))->result();
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


            $dx = array(
                'soal_jawab_benar' => $jumlah_benar,
                'soal_jawab_salah' => $jumlah_salah,
                'soal_jawab_nilai' => $nilai,
                'soal_jawab_ok' => $jumlah_terjawab,
                'soal_jawab_none' => $jumlah_tidakterjawab,
                'soal_jawab_selesai' => date('Y-m-d H:i:s'),
                'soal_jawab_last_update' => date('Y-m-d H:i:s'),
                'soal_jawab_status' => 'N'
            );

            $this->db->where(array(
                'soal_jawab_id' => $id,
                'soal_jawab_tahunajaran'=>$this->tahunajaran
            ));
            $this->db->update('soal_jawab', $dx);

            $data['status'] = 'ok';
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dx);
	}
	
	function simpan_satu(){
		$id = $this->input->get('id');
		$p = json_decode( file_get_contents('php://input') );
		

		$update_ = array();
		
		for ($i = 1; $i < $p->jml_soal; $i++) {
			$_tidsoal 	= "id_soal_".$i;
			$_tjenis 	= "jenis_".$i;
			$_ragu 		= "rg_".$i;
			
			$jawaban_ = '';
			if( $p->$_tjenis == 'optional' ){
                $_tjawab 	= "opsi_".$i;

                $jawaban_ = empty($p->$_tjawab) ? "-" : $p->$_tjawab;
                //$update_ .= "".$p->$_tidsoal.":".$p->$_tjenis.":".$p->$_ragu.":".$jawaban_.",";
                //0,1,2,3
				
			}else{
                $_tessay 	= "essay_".$i;

                $jawaban_ = empty($p->$_tessay) ? "" : $p->$_tessay;

                //$update_ .= "".$p->$_tidsoal.":".$p->$_tjenis.":".$p->$_ragu.":".$jawaban_.",";
			}

			//untuk memfilter karakter jawaban yang tidak terformat
			$jawaban_ = stripcslashes( trim($jawaban_) );
			
			array_push($update_,array($p->$_tidsoal,$p->$_tjenis,$p->$_ragu,$jawaban_));
		}
		
		//$update_ = substr($update_, 0, -1);

        $jumlah_soal = $p->jml_soal;
        $jumlah_benar = 0;
        $jumlah_salah = 0;
        $jumlah_terjawab = 0;
        $jumlah_tidakterjawab = 0;
        $nilai = 0;

        foreach ($update_ as $val) {
            //$pc_ret_urn = explode(":", $value);

            $id_soal = $val[0];
            $jenis = $val[1];
            $ragu = $val[2];
            $jawaban = $val[3];

            //jika jenis jawaban optional dan jawaban tidak kosong
            if ($jenis == 'optional') {

                if( $jawaban != "-" ) {
                    $jawaban_data = array();
                    //cari jawaban pada soal dengan $id_soal
                    $ambil_soal = $this->db->get_where('soal', array(
                        'soal_id' => $id_soal,
                        'soal_tahunajaran'=>$this->tahunajaran
                    ))->result();
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




        $update_ = json_encode( $update_ );

		
		$where = array(
			'soal_jawab_id'=>$id,
			'siswa_id'=>$this->siswa_id,
            'soal_jawab_tahunajaran'=>$this->tahunajaran
		);
		
		$this->db->where($where);
		$this->db->update('soal_jawab',array(

            'soal_jawab_benar' => $jumlah_benar,
            'soal_jawab_salah' => $jumlah_salah,
            'soal_jawab_nilai' => $nilai,
            'soal_jawab_ok' => $jumlah_terjawab,
            'soal_jawab_none' => $jumlah_tidakterjawab,

			'soal_jawab_last_update' => date('Y-m-d H:i:s'),
			'soal_jawab_list_opsi' => $update_
		) );
		
		//$this->db->update("UPDATE tr_ikut_ujian SET list_jawaban = '".$update_."' WHERE id_tes = '$uri4' AND id_user = '".$a['sess_konid']."'");
		
		
		$soal_jawab = $this->db->select('*')->from('soal_jawab')->where(array(
			'soal_jawab_id'=> $id,
			'siswa_id'=>$this->siswa_id,
            'soal_jawab_tahunajaran'=>$this->tahunajaran
		));
		
		$soal_jawab = $soal_jawab->get();
		$soal_jawab = $soal_jawab->result_array();
		//$ret_urn = explode(",", $soal_jawab[0]['soal_jawab_list_opsi']);
		$ret_urn = json_decode( $soal_jawab[0]['soal_jawab_list_opsi'] );
		
		$hasil 		= array();
		foreach ($ret_urn as $val) {
			//$pc_ret_urn = explode(":", $value);
			$idx 		= $val[0];
			$val 		= array($val[0],$val[1],$val[2],$val[3]);
			$hasil[]	= $val;
		}
		
		$d['data'] = $hasil;
		$d['status'] = "ok";
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode( $d );
	}
	
	function selesai(){
		
		$data2['title'] = "Selesai Mengerjakan Soal";
			
		$id = $this->input->get('id');
		
		$ujian = $this->db->get_where('ujian',array(
			'ujian_id'=>$id,
            'ujian_tahunajaran'=>$this->tahunajaran
		));
		
		if($ujian->num_rows() > 0){
			$ujian = $ujian->result();
			if($ujian[0]->ujian_tampil == 'y'){
		
				$soal_jawab = $this->db->get_where('soal_jawab',array(
					'soal_jawab_id'=> $id,
					'siswa_id'=>$this->siswa_id,
                    'soal_jawab_tahunajaran'=>$this->tahunajaran
				));

				$soal_jawab = $soal_jawab->result_array();

				$data2['soal_jawab'] = $soal_jawab;
				$this->template->load('template','siswa/ujian_selesai',$data2);
				
			}
			
		}
		
	}
	
	function ikuti(){
		
		$data2 = array();
		$id = $this->input->get('id');

        $ujian1 = $this->db->get_where('ujian',array(
			'ujian_id'=>$id,
			'ujian_tahunajaran'=>$this->tahunajaran
		));

        foreach ($ujian1->result_array() as $row2){


            $ujian_tanggal = $row2["ujian_tanggal"];
            $tanggal_sekarang = date('Y-m-d H:i:s');
            $ujian_mulai = date("Y-m-d H:i:s", strtotime($ujian_tanggal." ".$row2["ujian_mulai"]) );
            $ujian_terlambat = date("Y-m-d H:i:s", strtotime('+' . $row2["ujian_waktu"] . ' minutes', strtotime($ujian_tanggal." ".$row2["ujian_mulai"])));

            $row2["ujian_tanggal_mulai"] = $ujian_terlambat;
            $row2["ujian_tanggal_terlambat"] = $ujian_terlambat;

            $status = 2;
            if($tanggal_sekarang < $ujian_mulai ){
                $status = 0;
            }elseif($tanggal_sekarang >= $ujian_mulai and $tanggal_sekarang <= $ujian_terlambat){
                $status = 1;
            }

            $data2['title'] = "Soal Ujian";

            $data2['ujians'] = $row2;
            $data2['status'] = $status;

            $this->template->load('template_siswa','siswa/ujian_ikuti',$data2);
        }
	}
	
	function token(){

        $_id = 0;
        $data = array();
        $data['response'] = array();
		$id = $this->input->post('id');
		
		$q1 = $this->db->get_where('ujian',array(
		    'ujian_id'=>$id,
            'ujian_tahunajaran'=>$this->tahunajaran
        ));

		if($q1->num_rows() > 0){
			$ujian = $q1->result();

            //$data['response_uji'] = $ujian;

			$this->session->set_userdata(array(
				'ujian_id'=>$id,
				'ujian_tampil'=>"",//$ujian[0]->ujian_tampil,
			));
			
			//cek soal_jawab jika ada get jika tidak insert
			
			$ujian_ikut = $this->db->select('*')->from('soal_jawab');
			$ujian_ikut = $ujian_ikut->where(array(
				'ujian_id'=>$id,
				'siswa_id'=>$this->siswa_id,
				'soal_jawab_pelajaran' => $ujian[0]->ujian_pelajaran,
                'soal_jawab_tahunajaran'=>$this->tahunajaran
			));


            //$ujian_ikut = $ujian_ikut->where('(kelas_sekarang=\'\' OR kelas_sekarang=\''.$this->kelas_sekarang.'\')');
            //$ujian_ikut = $ujian_ikut->where('(jurusan_id=\'\' OR jurusan_id=\''.$this->jurusan_id.'\')');
            //$ujian_ikut = $ujian_ikut->where('(ruang=0 OR ruang='.$this->ruang.')');
            //$ujian_ikut = $ujian_ikut->where('(ujian_agama=\'\' OR ujian_agama=\''.$this->siswa_agama.'\')');


            $ujian_ikut = $ujian_ikut->limit(1);
			$ujian_ikut = $ujian_ikut->get();


            //$data['response_ada'] = $ujian_ikut->result();

			//cek ujian jika tidak ada insert
			if($ujian_ikut->num_rows() < 1){

				$soal = $this->db->select('*')->from('soal')->where(array(
                    'soal_kelas' => $ujian[0]->ujian_kelas,
					'soal_guru' => $ujian[0]->ujian_guru,
					'soal_pelajaran' => $ujian[0]->ujian_pelajaran,
                    'soal_tahunajaran'=>$this->tahunajaran
				));



                //$soal = $soal->where('(kelas_sekarang=\'\' OR kelas_sekarang=\''.$this->kelas_sekarang.'\')');
                //$soal = $soal->where('(jurusan_id=\'\' OR jurusan_id=\''.$this->jurusan_id.'\')');
                //$soal = $soal->where('(ruang=0 OR ruang='.$this->ruang.')');

				if( $ujian[0]->ujian_jenis == "acak" ){
					$soal = $soal->order_by('soal_id','RANDOM');
				} 
				
				if(  $ujian[0]->ujian_jumlah_soal > 0 ){
					$soal = $soal->limit($ujian[0]->ujian_jumlah_soal);					
				}
				
				$soal = $soal->get();




                //$data['response_soal'] = $soal->result();
				
				$list_soal = '';
				$list_opsi = '';
				
				
				$list_soal_array = array();
				$list_opsi_array = array();
				
				foreach($soal->result_array() as $item){
					$list_soal .= $item['soal_id'].",";
					$list_opsi .= $item['soal_id'].":".$item['soal_jenis'].":N:,";
					
					
					array_push( $list_soal_array, $item['soal_id'] );
					array_push( $list_opsi_array, array($item['soal_id'],$item['soal_jenis'],'N','-') );
					
				}

				$list_soal = substr($list_soal, 0, -1);
				$list_opsi = substr($list_opsi, 0, -1);

				//$lama_min = $ujian[0]->ujian_minimal;
                //$lama_max = $ujian[0]->ujian_waktu;


                $d = array(
                    'soal_jawab_list' => json_encode($list_soal_array),
                    'soal_jawab_list_opsi' => json_encode($list_opsi_array),

                    'ujian_id'  => $id,
                    'siswa_id'  => $this->siswa_id,
                    'soal_jawab_pelajaran' => $ujian[0]->ujian_pelajaran,
                    'soal_jawab_ruangan'  => $this->ruangan,

                    'soal_jawab_tanggal' => date('Y-m-d'),
                    'soal_jawab_mulai' => date('Y-m-d H:i:s'),
                    'soal_jawab_waktu' => $ujian[0]->ujian_waktu,
                    //'soal_jawab_waktu_minimal' => $ujian[0]->ujian_minimal,

                    'soal_jawab_jumlah_soal ' => $ujian[0]->ujian_jumlah_soal,
                    'soal_jawab_tampil ' => "",//$ujian[0]->ujian_tampil,

                    'soal_jawab_kelas'=>$this->kelas_sekarang,
                    'soal_jawab_jurusan'=>$this->jurusan_id,
                    'soal_jawab_jurusan_ke'=>$this->ruang,
                    'soal_jawab_status' => 'Y',
                    'soal_jawab_tahunajaran'=>$this->tahunajaran
                );

				$data['response_soal_insert'] = $d;



				$this->db->insert('soal_jawab',$d);

                $_id = $this->db->insert_id();
			    //jika ada tampil

                /**
                $this->session->set_userdata(array(
                    'soal_jawab_id'=>$_id,
                    'ujian_id'=>$id,
                    'ujian_tampil'=>"",//$ujian[0]->ujian_tampil,
                ));*/
			}else{

			    foreach ($ujian_ikut->result() as $sj){
                    $_id = $sj->soal_jawab_id;
                }
            }

            $data['_id'] = $_id;

            $this->session->set_userdata(array(
                'soal_jawab_id'=>$_id
            ));
		}

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $data );
	}

    function mulai(){

        $data2['title'] = "Mulai Ujian";

        $soal_jawab_id = $this->session->userdata('soal_jawab_id');
        $ujian_id = $this->session->userdata('ujian_id');
        $ujian_tampil = $this->session->userdata('ujian_tampil');

        $data2['soal_jawab_id'] = $soal_jawab_id;
        $data2['ujian_id'] = $ujian_id;
        $data2['tampil'] = $ujian_tampil;


        $data_ujian = $this->m->ambilbyid(array(
            'ujian_id'=>$ujian_id,
            'ujian_tahunajaran'=>$this->tahunajaran
        ),'ujian')->result();


        $soal_jawab = $this->db->select('*')->from('soal_jawab')->where(array(
            'ujian_id'=> $data_ujian[0]->ujian_id,
            'siswa_id' => $this->siswa_id,
            'soal_jawab_pelajaran'=> $data_ujian[0]->ujian_pelajaran,
            'soal_jawab_tahunajaran'=>$this->tahunajaran
        ));




        $soal_jawab = $soal_jawab->where('(soal_jawab_kelas=\'\' OR soal_jawab_kelas=\''.$data_ujian[0]->ujian_kelas.'\')');

        /**
        if($data_ujian[0]->ujian_jurusan != ""){
            $soal_jawab = $soal_jawab->where('soal_jawab_jurusan', $data_ujian[0]->ujian_jurusan);
        }

        if($data_ujian[0]->ujian_jurusan_ke != ""){
            $soal_jawab = $soal_jawab->where('soal_jawab_jurusan_ke', $data_ujian[0]->ujian_jurusan_ke);
        }*/

        $soal_jawab = $soal_jawab->get();
        $soal_jawab = $soal_jawab->result_array();



        //$urut_soal = explode(",", $soal_jawab[0]['soal_jawab_list_opsi']);
        $urut_soal = json_decode( $soal_jawab[0]['soal_jawab_list_opsi'] );

        $data2['soal']	= array();

        foreach($urut_soal as $item){
            $pc_urut_soal1 = json_encode( empty($item[3]) ? "" : $item[3] );
            $ambil_soal = $this->db->select("*, $pc_urut_soal1 AS jawaban")->from('soal')->where(array(
                'soal_id'=>$item[0],
                'soal_tahunajaran'=>$this->tahunajaran
            ))->get()->result_array();

            array_push($data2['soal'],$ambil_soal[0]);
        }


        $ujian_tanggal = $data_ujian[0]->ujian_tanggal;
        $tanggal_sekarang = date('Y-m-d H:i:s');
        $ujian_mulai = date("Y-m-d H:i:s", strtotime($ujian_tanggal." ".$data_ujian[0]->ujian_mulai) );
        $ujian_terlambat = date("Y-m-d H:i:s", strtotime('+' . $data_ujian[0]->ujian_waktu . ' minutes', strtotime($ujian_tanggal." ".$data_ujian[0]->ujian_mulai)));

        $data2["ujian_tanggal_mulai"] = $ujian_terlambat;
        $data2["ujian_tanggal_terlambat"] = $ujian_terlambat;

        $status = 2;
        if($tanggal_sekarang < $ujian_mulai ){
            $status = 0;
        }elseif($tanggal_sekarang >= $ujian_mulai and $tanggal_sekarang <= $ujian_terlambat){
            $status = 1;
        }

        $data2['ujian'] = $data_ujian[0];
        $data2['status'] = $status;
        $data2['list_jawaban'] = $urut_soal;


        $waktu_maksimal = $data_ujian[0]->ujian_waktu;
        $waktu_minimal  = $this->m->getpengaturan("Waktu Minimal");

        $data2['waktu_minimal'] = date('Y-m-d H:i:s',strtotime("+$waktu_minimal minutes",strtotime(date($ujian_mulai))));
        $data2['waktu_maksimal'] = date('Y-m-d H:i:s',strtotime("+$waktu_maksimal minutes",strtotime(date($ujian_terlambat))));



        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data2);
        $this->template->load('template_siswa','siswa/ujian_mulai',$data2);
    }



	
	function ajaxPaginationData(){

        $this->perPage = 10;
        $conditions = array();

        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        //set conditions for search
        $todayBy = $this->input->post('todayBy');


        if(!empty($todayBy)){
            $conditions['search']['todayBy'] = $todayBy;
        }


        //total rows count
        $totalRec = sizeof($this->cobaQuery($conditions));

        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'siswa/ujian/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';


		// integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        //get posts data
        $data['empData'] = $this->cobaQuery($conditions);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['pagination'] = $this->ajax_pagination->create_links();
        
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);	
    }
	
	function cobaQuery($params = array()){
		
		$data = array();
		$ujian = $this->db->select('*')->from('ujian');
        $ujian = $ujian->where('ujian_tahunajaran',$this->tahunajaran);

		$tgl = date('Y-m-d');

        if(!empty($params['search']['todayBy']) && $params['search']['todayBy'] == 1){
            //$ujian = $ujian->where('date_format(ujian_tanggal,"%Y-%m-%d")', 'CURDATE()', FALSE);
            //$ujian = $ujian->where('ujian_tanggal',"CURDATE() + INTERVAL 1 DAY");
            //$ujian = $ujian->where('date_format(ujian_tanggal,"%Y-%m-%d") = CURDATE() + INTERVAL 1 DAY');
            $tgl = date('Y-m-d', strtotime($tgl. ' + 1 days'));
            $ujian = $ujian->where('ujian_tanggal' ,$tgl);
        }else{
            //$ujian = $ujian->where('date_format(ujian_tanggal,"%Y-%m-%d") = CURDATE()' );

            $ujian = $ujian->where('ujian_tanggal' ,$tgl);
        }


        $ujian = $ujian->where('(ujian_kelas=\'\' OR ujian_kelas=\''.$this->kelas_sekarang.'\')');
        //$ujian = $ujian->where('(ujian_jurusan=\'\' OR ujian_jurusan=\''.$this->jurusan_id.'\')');
        //$ujian = $ujian->where('(ujian_jurusan_ke=\'\' OR ujian_jurusan_ke=\''.$this->ruang.'\')');
        //$ujian = $ujian->where('(ujian_agama=\'\' OR ujian_agama=\''.$this->siswa_agama.'\')');

        $ujian = $ujian->order_by('ujian_mulai','asc');
		$ujian = $ujian->get();
		
		$hitung = 0;
		foreach ($ujian->result_array() as $row1){
            $ujian_jurusan = explode(",",$row1['ujian_jurusan']);
            $ujian_agama = explode(",",$row1['ujian_agama']);

            $a = 0;
            $b = 0;
            if( empty($row1['ujian_jurusan']) || (count($ujian_jurusan) > 0 && in_array($this->jurusan_id,$ujian_jurusan) ) ) {
                $a++;
            }

            if( empty($row1['ujian_agama']) || (count($ujian_agama) > 0 && in_array($this->siswa_agama,$ujian_agama) ) ) {
                $b++;
            }

            if( $a == 1 && $b == 1 ) {
                $data_ujian = array();
                $data_ujian[ 'ujian_id' ] = $row1['ujian_id'];
                $data_ujian[ 'ujian_tanggal' ] = $row1['ujian_tanggal'];
                $data_ujian[ 'ujian_tanggal_indo' ] = $this->m->tanggalhari2( $row1['ujian_tanggal'],true );

                $data_ujian[ 'ujian_mulai' ] = date("H:i:s", strtotime($row1['ujian_mulai']));
                $data_ujian[ 'ujian_selesai' ] = date("H:i:s", strtotime('+'.$row1['ujian_waktu'].' minutes',strtotime($row1['ujian_mulai'])));


                $data_ujian[ 'ujian_tanggal_mulai' ] = date("Y-m-d H:i:s", strtotime($row1['ujian_tanggal']." ".$row1['ujian_mulai']));
                $data_ujian[ 'ujian_tanggal_selesai' ] = date("Y-m-d H:i:s", strtotime('+'.$row1['ujian_waktu'].' minutes',strtotime($row1['ujian_tanggal']." ".$row1['ujian_mulai'])));


                //$data_ujian[ 'ujian_mulai' ] = $row1['ujian_mulai'];
                //$data_ujian[ 'ujian_terlambat' ] = 0;//$row1['ujian_terlambat'];
                $data_ujian[ 'ujian_waktu' ] = $row1['ujian_waktu'];

                $data_ujian[ 'ujian_tampil' ] = "";//$row1['ujian_tampil'];
                $data_ujian[ 'ujian_jumlah_soal' ] = $row1['ujian_jumlah_soal'];
                $data_ujian[ 'ujian_jenis' ] = $row1['ujian_jenis'];

                $data_ujian[ 'ujian_pelajaran' ] = $row1['ujian_pelajaran'];
                $data_ujian[ 'ujian_guru' ] = $row1['ujian_guru'];



                $soal_jawab = $this->db->get_where('soal_jawab',array(
                    'ujian_id'=>$row1['ujian_id'],
                    'siswa_id'=>$this->siswa_id
                ))->result();

                $data_ujian['soal_jawab_status'] = empty($soal_jawab[0]->soal_jawab_status) ? null : $soal_jawab[0]->soal_jawab_status;

                array_push($data, $data_ujian);
            }
		}
		
		return $data;
		//$this->output->set_header('Content-Type: application/json; charset=utf-8');
		//echo json_encode($data);
	}



    function ajaxPaginationDataHistory(){

        $this->perPage = 10;
        $conditions = array();

        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        //set conditions for search


        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = sizeof($this->cobaQueryHistory($conditions));

        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'siswa/ujian/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilterHistory';


        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        //get posts data
        $data['empData'] = $this->cobaQueryHistory($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function cobaQueryHistory($params = array()){

        $data = array();
        $ujian = $this->db->select('*')->from('soal_jawab');
        $ujian = $ujian->where('siswa_id',$this->user_id );
        $ujian = $ujian->where('soal_jawab_tahunajaran',$this->tahunajaran );

        $ujian = $ujian->order_by('soal_jawab_tanggal','desc');
        $ujian = $ujian->order_by('soal_jawab_selesai','desc');

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit']);
        }

        $ujian = $ujian->get();

        $hitung = 0;
        foreach ($ujian->result_array() as $row1){


            $data_ujian[ 'soal_jawab_id' ] = $row1['soal_jawab_id'];
            $data_ujian[ 'soal_jawab_tanggal' ] = $row1['soal_jawab_tanggal'];
            $data_ujian[ 'soal_jawab_tanggal_indo' ] = $this->m->tanggalhari2( $row1['soal_jawab_tanggal'],true );
            $data_ujian[ 'soal_jawab_mulai' ] = $row1['soal_jawab_mulai'];
            $data_ujian[ 'soal_jawab_selesai' ] = $row1['soal_jawab_selesai'];
            $data_ujian[ 'soal_jawab_waktu' ] = $row1['soal_jawab_waktu'];

            $data_ujian[ 'soal_jawab_jumlah_soal' ] = $row1['soal_jawab_jumlah_soal'];
            $data_ujian[ 'soal_jawab_tampil' ] = $row1['soal_jawab_tampil'];
            $data_ujian[ 'soal_jawab_guru' ] = "";
            $ujian = $this->db->get_where("ujian",array(
                "ujian_id" => $row1['ujian_id'],
                "ujian_tahunajaran" => $this->tahunajaran
            ));
            foreach ($ujian->result_array() as $u){
                $data_ujian[ 'soal_jawab_guru' ] = $u["ujian_guru"];
            }

            $data_ujian[ 'soal_jawab_pelajaran' ] = $row1['soal_jawab_pelajaran'];
            $data_ujian[ 'soal_jawab_status' ] = $row1['soal_jawab_status'];

            array_push($data, $data_ujian);
        }

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($hari);
    }
	
	
}
?>