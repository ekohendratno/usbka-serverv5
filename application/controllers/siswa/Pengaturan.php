<?php
defined('BASEPATH') or exit();

class Pengaturan extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');
		
		if($this->session->userdata('level') != 'siswa'){
			redirect('auth/profile');
		}
		
		
		$this->guru_id = $this->session->userdata('id');
		$this->user_id = $this->session->userdata('user_id');
	}
	
	function index(){
		$data['title'] = "Pangaturan";
		
        $this->template->load('template','siswa/pengaturan',$data);
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

}

?>