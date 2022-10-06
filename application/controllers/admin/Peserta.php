<?php
defined('BASEPATH') or exit();

class Peserta extends CI_Controller{
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
        $data['title'] = "Data Peserta";
        $data['kelas'] = $this->_kelas();
        $data['jurusan'] = $this->_jurusan();
        $data['total_peserta'] = $this->_total_peserta();
        $data['total_peserta_laki2x'] = $this->_total_peserta_laki2x();
        $data['total_peserta_perempuan'] = $this->_total_peserta_perempuan();
        $data['total_jurusan'] = $this->_total_jurusan();

        $this->template->load('template','admin/peserta',$data);
	}

	function _total_peserta(){
        $ikut = $this->db->select('*')->from('peserta');
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function _total_peserta_laki2x(){
        $ikut = $this->db->select('*')->from('peserta');
        $ikut = $ikut->where('peserta_jk',"L");
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function _total_peserta_perempuan(){
        $ikut = $this->db->select('*')->from('peserta');
        $ikut = $ikut->where('peserta_jk',"P");
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function _total_jurusan(){
        $ikut = $this->db->select('*')->from('peserta');
        $ikut = $ikut->group_by('peserta_jurusan');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _kelas(){
        $this->db->select("*")->from("peserta");
        $this->db->group_by("peserta_kelas");
        $this->db->order_by("peserta_kelas","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->peserta_kelas;
            $data['label'] = $row->peserta_kelas;

            array_push($items, $data);

        }
        return $items;
    }

    function _jurusan1(){
        $this->db->select("*")->from("peserta");
        $this->db->group_by("peserta_jurusan");
        $this->db->order_by("peserta_jurusan","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->peserta_jurusan;
            $data['label'] = $row->peserta_jurusan;

            array_push($items, $data);

        }
        return $items;
    }


    function _jurusan(){
        $this->db->select("*")->from("peserta");
        $this->db->group_by("peserta_jurusan");
        $this->db->order_by("peserta_jurusan","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            array_push($items,$row->peserta_jurusan);
        }
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        return json_encode($items);
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
        $kelasBy = $this->input->post('kelasBy');
        $jurusanBy = $this->input->post('jurusanBy');
        $ruangBy = $this->input->post('ruangBy');
	
		
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
		
        if(!empty($kelasBy)){
            $conditions['search']['kelasBy'] = $kelasBy;
        }
        if(!empty($jurusanBy)){
            $conditions['search']['jurusanBy'] = $jurusanBy;
        }
        if(!empty($ruangBy)){
            $conditions['search']['ruangBy'] = $ruangBy;
        }
		
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }
        
		
        //total rows count
        $totalRec = count($this->cobaQuery($conditions));
        
        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'peserta/ajaxPaginationData';
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
		$this->db->from('peserta');

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('peserta_nama',$params['search']['keywords']);
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('peserta_id',$params['search']['sortBy']);
        }else{
            $this->db->order_by('peserta_id','desc');
        }
		
		$this->db->order_by('peserta_kelas','asc');
		$this->db->order_by('peserta_jurusan','asc');
		$this->db->order_by('peserta_jurusan_ke','asc');
		
		
		if(!empty($params['search']['kelasBy'])){
			$this->db->where('peserta_kelas',$params['search']['kelasBy']);
		}
		
		
		if(!empty($params['search']['jurusanBy'])){
			$this->db->where('peserta_jurusan',$params['search']['jurusanBy']);
		}
		
		
		if(!empty($params['search']['ruangBy'])){
			$this->db->where('peserta_jurusan_ke',$params['search']['ruangBy']);
		}

		
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
		$peserta = $this->db->get();
		
		foreach ($peserta->result_array() as $row){
			$baris['peserta_id'] = $row['peserta_id'];	
			$baris['peserta_nis'] = $row['peserta_nis'];	
			$baris['peserta_nama'] = $row['peserta_nama'];	
			$baris['peserta_jk'] = $row['peserta_jk'];
            $baris['peserta_agama']  	= ucfirst($row['peserta_agama']);

            $baris['peserta_foto'] = base_url('assets/images/avatar.png');
            if( !empty($row['peserta_foto']) ) {
                $baris['peserta_foto'] =  $this->config->item('serverapi1') . '/assets/profile/' . $row['peserta_foto'];
            }

			$baris['peserta_kelas'] = $row['peserta_kelas'];
			$baris['peserta_jurusan'] = $row['peserta_jurusan'];
			$baris['peserta_jurusan_ke'] = $row['peserta_jurusan_ke'];


            $baris['peserta_nomor'] =  $row['peserta_nomor'];
            $baris['peserta_ruangan'] =  $row['peserta_ruangan'];

            $baris['username'] = $row['peserta_username'];
            $baris['password'] = $row['peserta_password'];
			
			array_push($data, $baris);
		}
		
		return $data;
		//$this->output->set_header('Content-Type: application/json; charset=utf-8');
		//echo json_encode($data);
	}   
	
	function ambildatabyid(){
		$id =  $this->input->post('id');

        $peserta = $this->db->get_where('peserta',array(
            'peserta_id'=>$id
        ))->result();

		$data = array();
		$data['peserta_nama'] =  $peserta[0]->peserta_nama;
		$data['peserta_jk'] =  $peserta[0]->peserta_jk;
        $data['peserta_agama']  	= ucfirst($peserta[0]->peserta_agama);

		$data['peserta_nis'] =  $peserta[0]->peserta_nis;
		$data['peserta_kelas'] =  $peserta[0]->peserta_kelas;
		$data['peserta_jurusan'] =  $peserta[0]->peserta_jurusan;
		$data['peserta_jurusan_ke'] =  $peserta[0]->peserta_jurusan_ke;


        $data['peserta_nomor'] =  $peserta[0]->peserta_nomor;
        $data['peserta_ruangan'] =  $peserta[0]->peserta_ruangan;

        $data['peserta_username'] = $peserta[0]->peserta_username;
        $data['peserta_password'] = $peserta[0]->peserta_password;

        $data['peserta_foto'] =  $peserta[0]->peserta_foto;
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
	}
	

	function simpan(){
		$id = $this->input->post('id');
		$peserta_nama = $this->input->post('peserta_nama');
		$peserta_nis = $this->input->post('peserta_nis');
		$peserta_jk = $this->input->post('peserta_jk');
        $peserta_agama = $this->input->post('peserta_agama');
		$peserta_kelas = $this->input->post('peserta_kelas');
		$peserta_jurusan = $this->input->post('peserta_jurusan');
		$peserta_jurusan_ke = $this->input->post('peserta_jurusan_ke');
        $peserta_username = $this->input->post('peserta_username');
        $peserta_password = $this->input->post('peserta_password');

        $response = array();
        $response["response"] = array();
        $response["success"] = false;

        if(empty($peserta_nama)) $this->query_error("Nama kosong!");
        elseif(empty($peserta_nis)) $this->query_error("NIS kosong!");
        elseif(empty($peserta_jk)) $this->query_error("JK kosong!");
        elseif(empty($peserta_agama)) $this->query_error("Agama kosong!");
        elseif(empty($peserta_kelas)) $this->query_error("Kelas kosong!");
        elseif(empty($peserta_jurusan)) $this->query_error("Jurusan kosong!");
        else {

            $data =  array(
                'peserta_nama' => $peserta_nama,
                'peserta_nis' => $peserta_nis,
                'peserta_jk' => $peserta_jk,
                'peserta_agama' => $peserta_agama,
                'peserta_kelas' => $peserta_kelas,
                'peserta_jurusan' => $peserta_jurusan,
                'peserta_jurusan_ke' => $peserta_jurusan_ke,
                'peserta_username' => $peserta_username,
                'peserta_password' => $peserta_password
            );

            if ($id > 0) {
                $this->db->where('peserta_id', $id);
                $master = $this->db->update('peserta', $data);
            } else {
                $master = $this->db->insert('peserta', $data);
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
		$peserta_id = $this->input->post('id');
		
		$peserta = $this->db->where( array('peserta_id'=>$peserta_id) );
		$peserta->delete('peserta');

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

        if( !empty($lastname) ) $string3 = $string3.$lastname;

        $string4 = strtolower($string3);
        $nrRand = rand(1000, 9999);
        $nrRand2 = rand(100000, 999999);

        $data = array();
        $data['username'] = trim( $this->m->post_slug($string4) );//.trim($nrRand);
        $data['password'] = '*' . trim($nrRand);


        if( $continue ) return $data;
        //return $username;
        // Return results as json encoded array
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function generateuser_nomor($string1 = '', $continue = false) {

	    $tahun = date("Y");
        $bulan = date("m");

        $data = array();
        $data['nomor'] = $tahun.".".$bulan.".".$string1;//.trim($nrRand);


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

        $this->db->truncate('peserta');
    }

    function uploadfile($id){
        $imageFolder = "uploads/peserta/";

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
        $imageFolder = "uploads/peserta/";

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
        $imageFolder = "uploads/peserta";

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
        $baris['peserta_foto'] = $this->uploadfile2($id);

        $this->m->simpanbyid($baris,array(
            'peserta_id'=>$id
        ),'peserta');

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $data );
    }

    function akunpeserta(){
        $y = $this->input->post('y');


        $result = array();
        $result['success'] = false;

        if($y > 0){
            $peserta = $this->db->select('*')->from('peserta')->get();
            foreach($peserta->result_array() as $row){
                $generate = $this->generateuser( $row['peserta_nama'],true );
                $generate_nomor = $this->generateuser_nomor( $row['peserta_id'],true );

                $data = array();
                $data['peserta_username'] = $generate['username'];
                $data['peserta_password'] = $generate['password'];
                $data['peserta_nomor'] = $generate_nomor['nomor'];


                $this->db->where( array('peserta_id' => $row['peserta_id']) );
                $this->db->update('peserta',$data);
            }
            $result['success'] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }


    function akunpeserta_belum(){
        $y = $this->input->post('y');


        $result = array();
        $result['success'] = false;

        if($y > 0){
            $peserta = $this->db->select('*')->from('peserta')->where("peserta_username","")->get();
            foreach($peserta->result_array() as $row){
                $generate = $this->generateuser( $row['peserta_nama'],true );
                $generate_nomor = $this->generateuser_nomor( $row['peserta_id'],true );

                $data = array();
                $data['peserta_username'] = $generate['username'];
                $data['peserta_password'] = $generate['password'];
                $data['peserta_nomor'] = $generate_nomor['nomor'];


                $this->db->where( array('peserta_id' => $row['peserta_id']) );
                $this->db->update('peserta',$data);
            }
            $result['success'] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }


    function akunpeserta_belum_nomor(){
        $y = $this->input->post('y');


        $result = array();
        $result['success'] = false;

        if($y > 0){
            $peserta = $this->db->select('*')->from('peserta')->where("peserta_nomor","")->get();
            foreach($peserta->result_array() as $row){
                $generate_nomor = $this->generateuser_nomor( $row['peserta_id'],true );

                $data = array();
                $data['peserta_nomor'] = $generate_nomor['nomor'];


                $this->db->where( array('peserta_id' => $row['peserta_id']) );
                $this->db->update('peserta',$data);
            }
            $result['success'] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function akunpeserta_cetak_blank(){

        $untuk = $this->input->get('untuk');
        $kustom = $this->input->get('kustom');
        $kelas = $this->input->get('kelas');
        $jurusan = $this->input->get('jurusan');


        $data = array();
        $data['untuk'] = $untuk;
        $data['kustom'] = $kustom;
        $data['kelas'] = $kelas;
        $data['jurusan'] = $jurusan;
        $data['peserta'] = array();

        $peserta = $this->db->get_where('peserta',array(
            'peserta_kelas'=>$kelas,
            'peserta_jurusan'=>$jurusan
        ));

        $nomor_urut = 1;
        foreach ($peserta->result_array() as $row){
            $formatted_value = sprintf("%03d", $nomor_urut);

            $baris['urut'] = $formatted_value;
            $baris['peserta_id'] = $row['peserta_id'];
            $baris['peserta_nis'] = $row['peserta_nis'];
            $baris['peserta_nama'] = $row['peserta_nama'];
            $baris['peserta_jk'] = $row['peserta_jk'];
            $baris['peserta_foto'] = $row['peserta_foto'];

            $baris['peserta_nomor'] = $row['peserta_nomor'];
            $baris['peserta_ruangan'] = $row['peserta_ruangan'];


            $baris['peserta_foto'] = base_url('assets/admin/img/avatar.png');
            if( !empty($row['peserta_foto']) && file_exists(FCPATH . 'uploads/peserta/' .$row['peserta_foto']) ) {
                $baris['peserta_foto'] = base_url('thumb.php?size=200x300&src=./uploads/peserta/' . $row['peserta_foto']);
            }

            $baris['peserta_kelas'] = $row['peserta_kelas'];
            $baris['peserta_jurusan'] = $row['peserta_jurusan'];
            $baris['peserta_jurusan_ke'] = $row['peserta_jurusan_ke'];
            $baris['peserta_username'] = $row['peserta_username'];
            $baris['peserta_password'] = $row['peserta_password'];

            array_push($data['peserta'], $baris);
            $nomor_urut++;
        }

        if($untuk == 'ujian') {

            $this->load->view('admin/cetak_siswa_kartu_potrait_blank', $data);
        }else{
            $this->load->view('admin/cetak_siswa_kartu', $data);

        }
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }
    
    

    function akunpeserta_cetak_blank2(){

        $untuk = $this->input->get('untuk');
        $kustom = $this->input->get('kustom');
        $kelas = $this->input->get('kelas');
        $jurusan = $this->input->get('jurusan');


        $data = array();
        $data['untuk'] = $untuk;
        $data['kustom'] = $kustom;
        $data['kelas'] = $kelas;
        $data['jurusan'] = $jurusan;
        $data['peserta'] = array();

        $peserta = $this->db->get_where('peserta',array(
            'peserta_kelas'=>$kelas,
            'peserta_jurusan'=>$jurusan
        ));

        $nomor_urut = 1;
        foreach ($peserta->result_array() as $row){
            $formatted_value = sprintf("%03d", $nomor_urut);

            $baris['urut'] = $formatted_value;
            $baris['peserta_id'] = $row['peserta_id'];
            $baris['peserta_nis'] = $row['peserta_nis'];
            $baris['peserta_nama'] = $row['peserta_nama'];
            $baris['peserta_jk'] = $row['peserta_jk'];
            $baris['peserta_foto'] = $row['peserta_foto'];

            $baris['peserta_nomor'] = $row['peserta_nomor'];
            $baris['peserta_ruangan'] = $row['peserta_ruangan'];


            $baris['peserta_foto'] = base_url('assets/admin/img/avatar.png');
            if( !empty($row['peserta_foto']) && file_exists(FCPATH . 'uploads/peserta/' .$row['peserta_foto']) ) {
                $baris['peserta_foto'] = base_url('thumb.php?size=200x300&src=./uploads/peserta/' . $row['peserta_foto']);
            }

            $baris['peserta_kelas'] = $row['peserta_kelas'];
            $baris['peserta_jurusan'] = $row['peserta_jurusan'];
            $baris['peserta_jurusan_ke'] = $row['peserta_jurusan_ke'];
            $baris['peserta_username'] = $row['peserta_username'];
            $baris['peserta_password'] = $row['peserta_password'];

            array_push($data['peserta'], $baris);
            $nomor_urut++;
        }

        if($untuk == 'ujian') {

            $this->load->view('admin/cetak_siswa_kartu_potrait_blank2', $data);
        }else{
            $this->load->view('admin/cetak_siswa_kartu', $data);

        }
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }

    function akunpeserta_cetak(){

        $untuk = $this->input->get('untuk');
        $kustom = $this->input->get('kustom');
        $kelas = $this->input->get('kelas');
        $jurusan = $this->input->get('jurusan');


        $data = array();
        $data['untuk'] = $untuk;
        $data['kustom'] = $kustom;
        $data['kelas'] = $kelas;
        $data['jurusan'] = $jurusan;
        $data['peserta'] = array();

        $peserta = $this->db->get_where('peserta',array(
            'peserta_kelas'=>$kelas,
            'peserta_jurusan'=>$jurusan
        ));

        $nomor_urut = 1;
        foreach ($peserta->result_array() as $row){
            $formatted_value = sprintf("%03d", $nomor_urut);

            $baris['urut'] = $formatted_value;
            $baris['peserta_id'] = $row['peserta_id'];
            $baris['peserta_nis'] = $row['peserta_nis'];
            $baris['peserta_nama'] = $row['peserta_nama'];
            $baris['peserta_jk'] = $row['peserta_jk'];
            $baris['peserta_foto'] = $row['peserta_foto'];

            $baris['peserta_nomor'] = $row['peserta_nomor'];
            $baris['peserta_ruangan'] = $row['peserta_ruangan'];


            $baris['peserta_foto'] = base_url('assets/admin/img/avatar.png');
            if( !empty($row['peserta_foto']) && file_exists(FCPATH . 'uploads/peserta/' .$row['peserta_foto']) ) {
                $baris['peserta_foto'] = base_url('thumb.php?size=200x300&src=./uploads/peserta/' . $row['peserta_foto']);
            }

            $baris['peserta_kelas'] = $row['peserta_kelas'];
            $baris['peserta_jurusan'] = $row['peserta_jurusan'];
            $baris['peserta_jurusan_ke'] = $row['peserta_jurusan_ke'];
            $baris['peserta_username'] = $row['peserta_username'];
            $baris['peserta_password'] = $row['peserta_password'];

            array_push($data['peserta'], $baris);
            $nomor_urut++;
        }

        if($untuk == 'ujian') {

            $this->load->view('admin/cetak_siswa_kartu_potrait', $data);
        }else{
            $this->load->view('admin/cetak_siswa_kartu', $data);

        }
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }

    function akunpeserta_cetakdaftar(){

        $untuk = $this->input->get('untuk');
        $kustom = $this->input->get('kustom');
        $kelas = $this->input->get('kelas');
        $jurusan = $this->input->get('jurusan');
        $jurusan_ke = $this->input->get('jurusan_ke');


        $data = array();
        $data['untuk'] = $untuk;
        $data['kustom'] = $kustom;
        $data['kelas'] = $kelas;
        $data['jurusan'] = $jurusan;
        $data['jurusan_ke'] = $jurusan_ke;
        $data['peserta'] = array();


        $this->db->select("*")->from('peserta');
        $this->db->where('peserta_kelas',$kelas);
        $this->db->where('peserta_jurusan',$jurusan);

        if($jurusan_ke > 0){
            $this->db->where('peserta_jurusan_ke',$jurusan_ke);
        }

        $nomor_urut = 1;
        foreach ($this->db->get()->result_array() as $row){
            $formatted_value = sprintf("%03d", $nomor_urut);

            $baris['urut'] = $formatted_value;
            $baris['peserta_id'] = $row['peserta_id'];
            $baris['peserta_nis'] = $row['peserta_nis'];
            $baris['peserta_nama'] = $row['peserta_nama'];
            $baris['peserta_jk'] = $row['peserta_jk'];
            $baris['peserta_foto'] = $row['peserta_foto'];

            $baris['peserta_nomor'] = $row['peserta_nomor'];
            $baris['peserta_ruangan'] = $row['peserta_ruangan'];


            $baris['peserta_foto'] = base_url('assets/admin/img/avatar.png');
            if( !empty($row['peserta_foto']) && file_exists(FCPATH . 'uploads/peserta/' .$row['peserta_foto']) ) {
                $baris['peserta_foto'] = base_url('thumb.php?size=200x300&src=./uploads/peserta/' . $row['peserta_foto']);
            }

            $baris['peserta_kelas'] = $row['peserta_kelas'];
            $baris['peserta_jurusan'] = $row['peserta_jurusan'];
            $baris['peserta_jurusan_ke'] = $row['peserta_jurusan_ke'];
            $baris['peserta_username'] = $row['peserta_username'];
            $baris['peserta_password'] = $row['peserta_password'];

            array_push($data['peserta'], $baris);
            $nomor_urut++;
        }

        $this->load->view('admin/cetak_siswa_hadir', $data);
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }

    function query_error($text){
        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode(array('status' => 0, 'pesan' => "<font color='red'><i class='fas fa-exclamation-triangle'></i> ".$text."</font>"));
    }
}
?>