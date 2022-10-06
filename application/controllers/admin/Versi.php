<?php
defined('BASEPATH') or exit();

class Versi extends CI_Controller{
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
        $data = array();
        $data['title'] = "Data Versi";
        $data['total_version'] = $this->total_versi();
        $data['total_version_apk'] = $this->total_versi_apk();
        $data['total_version_exe'] = $this->total_versi_exe();

        $this->template->load('template','admin/versi',$data);
	}

	function total_versi(){
        $ikut = $this->db->select('*')->from('version');
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function total_versi_apk(){
        $ikut = $this->db->select('*')->from('version');
        $ikut = $ikut->where('version_jenis',"android");
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function total_versi_exe(){
        $ikut = $this->db->select('*')->from('version');
        $ikut = $ikut->where('version_jenis',"windows");
        $ikut = $ikut->get();
        return $ikut->num_rows();
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
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        $limitBy = $this->input->post('limitBy');
	
		
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
		
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }
        
		
        //total rows count
        $totalRec = count($this->cobaQuery($conditions));
        
        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'versi/ajaxPaginationData';
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
		$this->db->select('*');
		$this->db->from('version');

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('version_nama',$params['search']['keywords']);
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('version_nomor',$params['search']['sortBy']);
        }else{
            $this->db->order_by('version_nomor','desc');
        }

		
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
		$guru = $this->db->get();
		
		foreach ($guru->result_array() as $row){
			$baris['version_id'] = $row['version_id'];
            $baris['version_jenis'] = $row['version_jenis'];
			$baris['version_nama'] = $row['version_nama'];
            $baris['version_nomor']  	= $row['version_nomor'];
            $baris['version_nomor_minimal'] = $row['version_nomor_minimal'];
            $baris['version_text'] = $row['version_text'];
            $baris['version_ukuran'] = $row['version_ukuran'];
            $baris['version_wajib'] = $row['version_wajib'];
            $baris['version_tanggal'] = $row['version_tanggal'];
            $baris['version_hits'] = $row['version_hits'];
			
			array_push($data, $baris);
		}
		
		return $data;
		//$this->output->set_header('Content-Type: application/json; charset=utf-8');
		//echo json_encode($data);
	}   
	
	function ambildatabyid(){
		$id =  $this->input->post('id');
        $where = array(
            'version_id'=>$id
        );

        $guru = $this->m->ambilbyid($where,'version')->result();

		$data = array();
        $data['version_id'] = $guru[0]->version_id;
        $data['version_jenis'] = $guru[0]->version_jenis;
        $data['version_nama'] = $guru[0]->version_nama;
        $data['version_nomor']  	= $guru[0]->version_nomor;
        $data['version_nomor_minimal'] = $guru[0]->version_nomor_minimal;
        $data['version_text'] = $guru[0]->version_text;
        $data['version_ukuran'] = $guru[0]->version_ukuran;
        $data['version_wajib'] = $guru[0]->version_wajib;
        $data['version_tanggal'] = $guru[0]->version_tanggal;
        $data['version_hits'] = $guru[0]->version_hits;
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
	}
	

	function simpan(){
		$id = $this->input->post('id');
		$version_jenis = $this->input->post('version_jenis');
		$version_nama = $this->input->post('version_nama');
        $version_nomor = $this->input->post('version_nomor');
        $version_nomor_minimal = $this->input->post('version_nomor_minimal');
        $version_text = $this->input->post('version_text');
        $version_ukuran = $this->input->post('version_ukuran');
        $version_wajib = $this->input->post('version_wajib');

        $response = array();
        $response["response"] = array();
        $response["success"] = false;

        if(empty($version_jenis)) $this->query_error("Jenis kosong!");
        elseif(empty($version_nama)) $this->query_error("Nama kosong!");
        else {

            $tanggal	= date('Y-m-d H:i:s');

            $data =  array(
                'version_jenis' => $version_jenis,
                'version_nama' => $version_nama,
                'version_nomor' => $version_nomor,
                'version_nomor_minimal' => $version_nomor_minimal,
                'version_text' => $version_text,
                'version_ukuran' => $version_ukuran,
                'version_wajib' => $version_wajib
            );

            if ($id > 0) {

                $this->db->where('version_id', $id);
                $master = $this->db->update('version', $data);
            } else {
                array_push($data,array(
                    'version_tanggal' => $tanggal
                ));

                $master = $this->db->insert('version', $data);
                $id = $this->db->insert_id();
            }


            if ($master) {
                $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
                echo json_encode(array('id' => $id, 'status' => 1, 'pesan' => "<font color='green'><i class='fa fa-check'></i> Data berhasil disimpan !</font>"));
            } else {
                $this->query_error();
            }

		}
		

	}
	
	function hapus(){
		$version_id = $this->input->post('id');
		
		$guru = $this->db->where( array('version_id'=>$version_id) );
		$guru->delete('version');

        $result['success'] = true;

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
	}



    function simpan_duplikat(){
        $id = $this->input->get('id');

        if($id > 0){
            $master = $this->db->query("INSERT INTO cbt_version (
            SELECT  NULL,
            `version_jenis`,
            `version_nama`,
            `version_nomor`,
            `version_nomor_minimal`,
            `version_text`,
            `version_ukuran`,
            `version_wajib`,
            `version_tanggal`,
            `version_hits`
            FROM cbt_version 
            WHERE version_id = $id)");


            $id = $this->db->insert_id();


            $tanggal	= date('Y-m-d H:i:s');

            $this->db->where('version_id', $id);
            $master = $this->db->update('version', array(
                'version_tanggal' => $tanggal,
                'version_hits' => ""
            ));
        }


        if( $master ){
            $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
            echo json_encode(array('id' => (int) $id,'status' => 1, 'pesan' => "<font color='green'><i class='fa fa-check'></i> Data berhasil disimpan !</font>"));
        }else{
            $this->query_error();
        }

    }


    function uploadfile($id){
        $imageFolder = "uploads/versi/";

        $namafile = $id;

        //reset($_FILES);
        $temp = $_FILES['fileversi'];

        if(empty($temp['name'])) return '';
        elseif(is_uploaded_file($temp['tmp_name'])){

            $filetowrite = $imageFolder . '/' . $namafile .'.jpg';
            unlink($filetowrite);

            move_uploaded_file($temp['tmp_name'], $filetowrite);

            return $namafile .'.jpg';

        }
    }


    function query_error($text){
        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode(array('status' => 0, 'pesan' => "<font color='red'><i class='fas fa-exclamation-triangle'></i> ".$text."</font>"));
    }
}
?>