<?php
defined('BASEPATH') or exit();

class Pengaturan extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');
		
		if($this->session->userdata('level') != 'guru'){
			redirect('home');
		}
		
		
		$this->guru_id = $this->session->userdata('id');
		$this->user_id = $this->session->userdata('user_id');
	}
	
	function index(){
		$data['title'] = "Pangaturan";
		
        $this->template->load('template','guru/pengaturan',$data);
	}




    function simpantahunajaran(){
        $baris = array();
        $baris["tahunajaran"] = $this->input->post("tahunajaran");
        $baris["semester"] = $this->input->post("semester");

        $this->session->set_userdata($baris);

        $data['success'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


	
	function daftarpengaturan(){
		
		$where = array(
			'user_id' => $this->user_id
		);
		$users_pengaturan = $this->db->select('*')->from('users_pengaturan')->where($where)->order_by('users_pengaturan_name','asc');
		
		//return $siswa->get()->result();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode( $users_pengaturan->get()->result());
	}
	
	function daftarta(){
		/*
		list ta
		jika ta,semester ada dalam pengaturan, ta_aktif = 1
		*/
		
		$data = array();
		$pengaturan = $this->db->select('*')->from('ta')->order_by('ta_tahun','desc')->get()->result();

		foreach($pengaturan as $row){
			$item = array();
			$item['id'] = $row->ta_id;
			$item['tahun'] = $row->ta_tahun;
			$item['semester'] = $row->ta_semester;
			//$item['aktif'] = (int) $row->ta_aktif;
			$item['selected'] = 0;
			

			$query_t = $this->db->get_where('pengaturan',array(
				'pengaturan_name'=>'tahun_ajaran',
				'user_id'=>$this->user_id
			));

			if( $query_t->num_rows() > 0 ){
                $query_t = $query_t->result();
                $pengaturan = json_decode( $query_t[0]->pengaturan_value );

                if( $row->ta_tahun == $pengaturan->tahun && $row->ta_semester == $pengaturan->semester ){
                    $item['selected'] = 1;
                }
			}else{
                $item['selected'] = (int) $row->ta_aktif;
            }
			
			array_push($data,$item);
			
		}
		
		//return $siswa->get()->result();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode( $data);
	}

	
	function resetdata(){
		$this->db->where(array('guru_id' => $this->guru_id));
        $this->db->delete('soal');
		
		
		$this->db->where(array('user_id' => $this->user_id));
		$this->db->delete('ujian');

        $this->db->where(array('user_id' => $this->user_id));
        $this->db->delete('pesan');
	}
	
	function republish(){
		$id = $this->input->post('id');
		
		/*
		ambil data (tahun,semester) table ta by id
		cek table pengaturan by user_id, pengaturan_key
		jika ada update
		jika tidak insert		
		*/
		
		$query_t = $this->db->get_where('pengaturan',array(
			'pengaturan_name'=>'tahun_ajaran',
			'user_id'=>$this->user_id
		));

        $query_list = $this->db->get_where('ta',array(
            'ta_id'=>$id
        ))->result();

        $value = json_encode( array(
            'tahun'=>$query_list[0]->ta_tahun,
            'semester'=>$query_list[0]->ta_semester
        ) , TRUE);

        if( $query_t->num_rows() > 0 ){

			$this->m->simpanbyid(array('pengaturan_value'=>$value),array(
				'pengaturan_name'=>'tahun_ajaran',
				'user_id'=>$this->user_id
			),'pengaturan');
			
		}else{
			
			$this->db->insert('pengaturan',array(
				'pengaturan_name'=>'tahun_ajaran',
				'pengaturan_value'=>$value,
				'user_id'=>$this->user_id
			));
		}


	}
}

?>