<?php
defined('BASEPATH') or exit();

class Guru extends CI_Controller{
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
        $data['title'] = "Data Guru";
        $data['total_guru'] = $this->_total_guru();
        $data['total_guru_laki2x'] = $this->_total_guru_laki2x();
        $data['total_guru_perempuan'] = $this->_total_guru_perempuan();

        $this->template->load('template','admin/guru',$data);
	}

	function _total_guru(){
        $ikut = $this->db->select('*')->from('guru');
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function _total_guru_laki2x(){
        $ikut = $this->db->select('*')->from('guru');
        $ikut = $ikut->where('guru_jk',"L");
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function _total_guru_perempuan(){
        $ikut = $this->db->select('*')->from('guru');
        $ikut = $ikut->where('guru_jk',"P");
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
        $config['base_url']    = base_url().'guru/ajaxPaginationData';
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
		$this->db->from('guru');

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('guru_nama',$params['search']['keywords']);
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('guru_nama',$params['search']['sortBy']);
        }else{
            $this->db->order_by('guru_nama','asc');
        }

		
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
		$guru = $this->db->get();
		
		foreach ($guru->result_array() as $row){
			$baris['guru_id'] = $row['guru_id'];
			$baris['guru_nama'] = $row['guru_nama'];	
			$baris['guru_jk'] = $row['guru_jk'];
            $baris['guru_agama']  	= ucfirst($row['guru_agama']);
            $baris['guru_jabatan'] = $row['guru_jabatan'];
            $baris['guru_jabatan_tambahan'] = $row['guru_jabatan_tambahan'];

            $baris['guru_foto'] = base_url('assets/images/avatar.png');
            if( !empty($row['guru_foto']) ) {
                $baris['guru_foto'] =  $this->config->item('serverapi1') . '/assets/profile/' . $row['guru_foto'];
            }

            $baris['username'] = $row['guru_username'];
            $baris['password'] = $row['guru_password'];
			
			array_push($data, $baris);
		}
		
		return $data;
		//$this->output->set_header('Content-Type: application/json; charset=utf-8');
		//echo json_encode($data);
	}   
	
	function ambildatabyid(){
		$id =  $this->input->post('id');
        $where = array(
            'guru_id'=>$id
        );

        $guru = $this->m->ambilbyid($where,'guru')->result();

		$data = array();
		$data['guru_nama'] =  $guru[0]->guru_nama;
		$data['guru_jk'] =  $guru[0]->guru_jk;
        $data['guru_agama']  	= ucfirst($guru[0]->guru_agama);
        $data['guru_jabatan']  	= $guru[0]->guru_jabatan;
        $data['guru_jabatan_tambahan']  	= $guru[0]->guru_jabatan_tambahan;

        $data['guru_username'] = $guru[0]->guru_username;
        $data['guru_password'] = $guru[0]->guru_password;

        $data['guru_foto'] =  $guru[0]->guru_foto;
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
	}
	

	function simpan(){
		$id = $this->input->post('id');
		$guru_nama = $this->input->post('guru_nama');
		$guru_jk = $this->input->post('guru_jk');
        $guru_agama = $this->input->post('guru_agama');
        $guru_jabatan = $this->input->post('guru_jabatan');
        $guru_jabatan_tambahan = $this->input->post('guru_jabatan_tambahan');
        $guru_username = $this->input->post('guru_username');
        $guru_password = $this->input->post('guru_password');

        $response = array();
        $response["response"] = array();
        $response["success"] = false;

        if(empty($guru_nama)) $this->query_error("Nama kosong!");
        elseif(empty($guru_jk)) $this->query_error("JK kosong!");
        elseif(empty($guru_agama)) $this->query_error("Agama kosong!");
        else {

            $data =  array(
                'guru_nama' => $guru_nama,
                'guru_jk' => $guru_jk,
                'guru_agama' => $guru_agama,
                'guru_jabatan' => $guru_jabatan,
                'guru_jabatan_tambahan' => $guru_jabatan_tambahan,
                'guru_username' => $guru_username,
                'guru_password' => $guru_password
            );

            if ($id > 0) {
                $this->db->where('guru_id', $id);
                $master = $this->db->update('guru', $data);
            } else {
                $master = $this->db->insert('guru', $data);
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
		$guru_id = $this->input->post('id');
		
		$guru = $this->db->where( array('guru_id'=>$guru_id) );
		$guru->delete('guru');

        $result['success'] = true;

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
	}

    function generateuser($string1 = '', $continue = false) {

	    if( empty($string1) )
            $string1 = $this->input->post('string');

        $string2 = $this->m->splitName($string1);

        $string3 = $string2['firstname'];

        $lastname = $string2['lastname'];
        if(!empty($string2['middlename']) ){
            $lastname = $string2['middlename'];
        }

        if( $lastname != null ) $string3 = $string3.$lastname;

        $string4 = strtolower($string3);
        $nrRand = rand(1000, 9999);
        $nrRand2 = rand(100000, 999999);

        $data = array();
        $data['username'] = trim( $this->m->post_slug($string4) );//.trim($nrRand);
        $data['password'] = '*' . trim($nrRand2);


        if( $continue ) return $data;
        //return $username;
        // Return results as json encoded array
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function resetdata(){
        /*$this->db->where( array(
            'pengaturan_key'=>$this->pengaturan_key
        ));
        $this->db->delete('soal');*/

        $this->db->truncate('guru');
    }

    function uploadfile($id){
        $imageFolder = "uploads/guru/";

        $namafile = $id;

        //reset($_FILES);
        $temp = $_FILES['filefoto'];

        if(empty($temp['name'])) return '';
        elseif(is_uploaded_file($temp['tmp_name'])){

            $filetowrite = $imageFolder . '/' . $namafile .'.jpg';
            unlink($filetowrite);

            move_uploaded_file($temp['tmp_name'], $filetowrite);

            return $namafile .'.jpg';

        }
    }

    function uploadfile2($id){
        $imageFolder = "uploads/guru/";

        $namafile = $id;

        //reset($_FILES);
        $temp = $_FILES['filefoto'];

        if(empty($temp['name'])) return '';
        elseif(is_uploaded_file($temp['tmp_name'])){

            $filetowrite = $imageFolder . '/' . $namafile .'.jpg';
            move_uploaded_file($temp['tmp_name'], $filetowrite);


            list($width, $height) = getimagesize($filetowrite) ;
            $modwidth = 500;

            $diff = $width / $modwidth;

            $modheight = $height / $diff;
            $tn = imagecreatetruecolor($modwidth, $modheight) ;
            $image = imagecreatefromjpeg($filetowrite) ;
            imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;

            imagejpeg($tn, $filetowrite, 100) ;

            return $namafile .'.jpg';

        }
    }

    function uploadfilefoto($id){
        $imageFolder = "uploads/guru";

        $imagename = $_FILES['filefoto']['name'];
        $source = $_FILES['filefoto']['tmp_name'];
        $target = $imageFolder.$imagename;
        move_uploaded_file($source, $target);

        $imagepath = $imagename;
        $save = $imageFolder . $id . ".jpg"; //This is the new file you saving
        $file = $imageFolder . $imagepath; //This is the original file

        list($width, $height) = getimagesize($file) ;

        $modwidth = 300;

        $diff = $width / $modwidth;

        $modheight = $height / $diff;
        $tn = imagecreatetruecolor($modwidth, $modheight) ;
        $image = imagecreatefromjpeg($file) ;
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;

        imagejpeg($tn, $save, 100) ;

        return $id . ".jpg";
    }

    function simpanfoto($id){
        $data = array();
        $data['pesan'] = "";

        $baris = array();
        $baris['guru_foto'] = $this->uploadfile2($id);

        $this->m->simpanbyid($baris,array(
            'guru_id'=>$id
        ),'guru');

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $data );
    }

    function akunguru(){
        $y = $this->input->post('y');


        $result = array();
        $result['success'] = false;

        if($y > 0){
            $guru = $this->db->select('*')->from('guru')->get();
            foreach($guru->result_array() as $row){
                $generate = $this->generateuser( $row['guru_nama'],true );

                $data = array();
                $data['guru_username'] = $generate['username'];
                $data['guru_password'] = $generate['password'];


                $this->db->where( array('guru_id' => $row['guru_id']) );
                $this->db->update('guru',$data);
            }
            $result['success'] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }


    function akunguru_belum(){
        $y = $this->input->post('y');


        $result = array();
        $result['success'] = false;

        if($y > 0){
            $guru = $this->db->select('*')->from('guru')->where("guru_username","")->get();
            foreach($guru->result_array() as $row){
                $generate = $this->generateuser( $row['guru_nama'],true );

                $data = array();
                $data['guru_username'] = $generate['username'];
                $data['guru_password'] = $generate['password'];


                $this->db->where( array('guru_id' => $row['guru_id']) );
                $this->db->update('guru',$data);
            }
            $result['success'] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function akunguru_cetak(){

        $untuk = $this->input->get('untuk');
        $kustom = $this->input->get('kustom');


        $data = array();
        $data['untuk'] = $untuk;
        $data['kustom'] = $kustom;
        $data['guru'] = array();

        $guru = $this->db->get_where('guru',array());

        $nomor_urut = 1;
        foreach ($guru->result_array() as $row){
            $formatted_value = sprintf("%03d", $nomor_urut);

            $baris['urut'] = $formatted_value;
            $baris['guru_id'] = $row['guru_id'];
            $baris['guru_nama'] = $row['guru_nama'];
            $baris['guru_jk'] = $row['guru_jk'];
            $baris['guru_foto'] = $row['guru_foto'];

            $baris['guru_foto'] = base_url('assets/admin/img/avatar.png');
            if( !empty($row['guru_foto']) && file_exists(FCPATH . 'uploads/guru/' .$row['guru_foto']) ) {
                $baris['guru_foto'] = base_url('thumb.php?size=200x300&src=./uploads/guru/' . $row['guru_foto']);
            }

            $baris['guru_username'] = $row['guru_username'];
            $baris['guru_password'] = $row['guru_password'];

            array_push($data['guru'], $baris);
            $nomor_urut++;
        }

        $this->load->view('admin/cetak_guru_kartu', $data);
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }

    function akunguru_cetakdaftar(){

        $untuk = $this->input->get('untuk');
        $kustom = $this->input->get('kustom');


        $data = array();
        $data['untuk'] = $untuk;
        $data['kustom'] = $kustom;
        $data['guru'] = array();

        $guru = $this->db->get_where('guru',array());

        $nomor_urut = 1;
        foreach ($guru->result_array() as $row){
            $formatted_value = sprintf("%03d", $nomor_urut);

            $baris['urut'] = $formatted_value;
            $baris['guru_id'] = $row['guru_id'];
            $baris['guru_nama'] = $row['guru_nama'];
            $baris['guru_jk'] = $row['guru_jk'];
            $baris['guru_foto'] = $row['guru_foto'];

            $baris['guru_foto'] = base_url('assets/admin/img/avatar.png');
            if( !empty($row['guru_foto']) && file_exists(FCPATH . 'uploads/guru/' .$row['guru_foto']) ) {
                $baris['guru_foto'] = base_url('thumb.php?size=200x300&src=./uploads/guru/' . $row['guru_foto']);
            }

            $baris['guru_username'] = $row['guru_username'];
            $baris['guru_password'] = $row['guru_password'];

            array_push($data['guru'], $baris);
            $nomor_urut++;
        }

        $this->load->view('admin/cetak_guru_hadir', $data);
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }

    function query_error($text){
        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode(array('status' => 0, 'pesan' => "<font color='red'><i class='fas fa-exclamation-triangle'></i> ".$text."</font>"));
    }
}
?>