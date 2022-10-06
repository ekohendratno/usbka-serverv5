<?php
defined('BASEPATH') or exit();

class SoalArsip extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');
		$this->load->helpers('text');


        if($this->session->userdata('level') != 'guru'){
            redirect('home');
        }



        $this->guru = $this->session->userdata('nama');

        $this->tahunajaran = $this->session->userdata('tahunajaran_arsip');


	}
	
	function index(){

        $data = array();
        $data['title'] = "Data Soal";
        $data['kumpul'] = array();

        $data['pelajaran'] = $this->_pelajaran();
        $data['guru'] = $this->_guru();
        $data['jurusan'] = $this->_jurusan();
        $data['kelas'] = $this->_kelas();

        $data['pelajaranBySoal'] = $this->_pelajaranBySoal();
        $data['guruBySoal'] = $this->_guruBySoal();
        $data['kelasBySoal'] = $this->_kelasBySoal();

        $data['total_soal'] = $this->_jumlah_soal();
        $data['total_pelajaran'] = $this->_jumlah_pelajaran();
        $data['total_guru'] = $this->_jumlah_guru();


        $data["tahunajaran_arsip"] = $this->session->userdata('tahunajaran_arsip');
		
        $this->template->load('template','guru/soal_arsip',$data);
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
        $pelajaranBy = $this->input->post('pelajaranBy');
        $guruBy = $this->input->post('guruBy');
	
		
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($kelasBy)){
            $conditions['search']['kelasBy'] = $kelasBy;
        }
        if(!empty($pelajaranBy)){
            $conditions['search']['pelajaranBy'] = $pelajaranBy;
        }
        if(!empty($guruBy)){
            $conditions['search']['guruBy'] = $guruBy;
        }
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }
        
		
        //total rows count
        $totalRec = count($this->cobaQuery($conditions));
        
        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'guru/soalarsip/ajaxPaginationData';
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

		$soal = $this->db->select('*')->from('soal_arsip');

        $soal = $soal->where('soal_guru',$this->guru);

        $soal = $soal->where('soal_tahunajaran',$this->tahunajaran);

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
           $soal = $soal->order_by('soal_date',$params['search']['sortBy']);
        }else{
           $soal = $soal->order_by('soal_date','desc');
        }


        if(!empty($params['search']['kelasBy'])){
            $soal = $soal->where('soal_kelas',$params['search']['kelasBy']);
        }

		if(!empty($params['search']['pelajaranBy'])){
			$soal = $soal->where('soal_pelajaran',$params['search']['pelajaranBy']);
		}

        if(!empty($params['search']['guruBy'])){
            $soal = $soal->where('soal_guru',$params['search']['guruBy']);
        }


        if(!empty($params['search']['keywords'])){
            $soal = $soal->like('soal_text',$params['search']['keywords'], 'both');
        }

		//set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $soal = $soal->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $soal = $soal->limit($params['limit']);
        }
		
		$soal = $soal->get();

        $nomor = 0;
        $data = array();
		foreach ($soal->result_array() as $row){
            $nomor++;
            $baris = array();

            $baris['nomor']     = $nomor;
            $baris['soal_id'] = $row['soal_id'];
            $baris['soal_jenis'] = $row['soal_jenis'];
            $baris['soal_text'] = word_limiter( strip_tags($row['soal_text']),30);
            $baris['soal_text_deskripsi'] = $row['soal_text_deskripsi'];
            $baris['soal_date']     = $row['soal_date'];
            $baris['soal_kelas']     = $row['soal_kelas'];
            $baris['soal_pelajaran']     = $row['soal_pelajaran'];
            $baris['soal_date']     = $row['soal_date'];
            $baris['soal_guru']     = $row['soal_guru'];
            $baris['soal_untuk']     = $row['soal_untuk'];


			
			array_push($data, $baris);
		}
		
		return $data;

    }



    function ajaxPaginationDataBySoal(){

        $conditions = array();

        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');

        $kelasBy = $this->input->post('kelasBy');
        $pelajaranBy = $this->input->post('pelajaranBy');
        $guruBy = $this->input->post('guruBy');


        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($kelasBy)){
            $conditions['search']['kelasBy'] = $kelasBy;
        }
        if(!empty($pelajaranBy)){
            $conditions['search']['pelajaranBy'] = $pelajaranBy;
        }
        if(!empty($guruBy)){
            $conditions['search']['guruBy'] = $guruBy;
        }
        //get posts data
        $data['empData'] = $this->cobaQueryBySoal($conditions);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function cobaQueryBySoal($params = array()){

        $soal = $this->db->select('*')->from('soal_arsip');

        $soal = $soal->where('soal_guru',$this->guru);

        $soal = $soal->where('soal_tahunajaran',$this->tahunajaran);

        if(!empty($params['search']['kelasBy'])){
            $soal = $soal->where('soal_kelas',$params['search']['kelasBy']);
        }

        if(!empty($params['search']['pelajaranBy'])){
            $soal = $soal->where('soal_pelajaran',$params['search']['pelajaranBy']);
        }

        if(!empty($params['search']['guruBy'])){
            $soal = $soal->where('soal_guru',$params['search']['guruBy']);
        }

        if(!empty($params['search']['keywords'])){
            $soal = $soal->like('soal_text',$params['search']['keywords'], 'both');
        }

        $soal = $soal->order_by('soal_date','desc');

        $soal = $soal->get();

        $nomor = $soal->num_rows()+1;
        $data = array();
        foreach ($soal->result_array() as $row){
            $nomor--;
            $baris = array();

            $baris['nomor']     = $nomor;
            $baris['soal_id'] = $row['soal_id'];
            $baris['soal_jenis'] = $row['soal_jenis'];
            $baris['soal_text'] = word_limiter( strip_tags($row['soal_text']),30);
            $baris['soal_text_deskripsi'] = $row['soal_text_deskripsi'];
            $baris['soal_date']     = $row['soal_date'];
            $baris['soal_kelas']     = $row['soal_kelas'];
            $baris['soal_pelajaran']     = $row['soal_pelajaran'];
            $baris['soal_date']     = $row['soal_date'];
            $baris['soal_guru']     = $row['soal_guru'];
            $baris['soal_untuk']     = $row['soal_untuk'];



            array_push($data, $baris);
        }

        return $data;

    }


    function ajaxPaginationData2(){

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
        $kelasBy = $this->input->get('kelasBy');
        $pelajaranBy = $this->input->get('pelajaranBy');
        $guruBy = $this->input->get('guruBy');
        $idBy = $this->input->get('idBy');
        $keywords = $this->input->get('keywords');


        if(!empty($pelajaranBy)){
            $conditions['search']['pelajaranBy'] = $pelajaranBy;
        }
        if(!empty($pelajaranBy)){
            $conditions['search']['pelajaranBy'] = $pelajaranBy;
        }
        if(!empty($guruBy)){
            $conditions['search']['guruBy'] = $guruBy;
        }
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($idBy)){
            $conditions['search']['idBy'] = $idBy;
        }

        //total rows count
        $totalRec = count($this->cobaQuery2($conditions));

        //pagination configuration
        $config['target']      = '#postListParent tbody';
        $config['base_url']    = base_url().'guru/soalarsip/ajaxPaginationData2';
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
        $data['empData'] = $this->cobaQuery2($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function cobaQuery2($params = array()){

        $soal = $this->db->select('*')->from('soal_parent');

        $soal = $soal->where('soal_parent_guru',$this->guru);
        $soal = $soal->where('soal_parent_tahunajaran',$this->tahunajaran);

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $soal = $soal->order_by('soal_parent_date',$params['search']['sortBy']);
        }else{
            $soal = $soal->order_by('soal_parent_date','desc');
        }

        if(!empty( $params['search']['pelajaranBy'] ) && !empty( $params['search']['guruBy'])) {
            $soal = $soal->where('soal_parent_pelajaran', $params['search']['pelajaranBy']);
            $soal = $soal->where('soal_parent_guru', $params['search']['guruBy']);
        }

        if(!empty($params['search']['idBy'])){
            //$soal = $soal->where('soal_parent_id',$params['search']['idBy']);
        }


        if(!empty($params['search']['keywords'])){
            $soal = $soal->like('soal_parent_text',$params['search']['keywords'], 'both');
        }

        $soal = $soal->get();

        $data = array();
        foreach ($soal->result_array() as $row){
            $baris = array();
            $baris['soal_parent_id'] = $row['soal_parent_id'];
            $baris['soal_parent_text'] = word_limiter( strip_tags($row['soal_parent_text']),30);
            $baris['soal_parent_date']     = $row['soal_parent_date'];
            $baris['soal_parent_pelajaran']     = $row['soal_parent_pelajaran'];
            $baris['soal_parent_guru']     = $row['soal_parent_guru'];

            array_push($data, $baris);
        }

        return $data;

    }




    function ajaxPaginationDataTerkumpul(){

        $this->perPage = 50;
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
        $pelajaranBy = $this->input->post('pelajaranBy');
        $guruBy = $this->input->post('guruBy');


        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($kelasBy)){
            $conditions['search']['kelasBy'] = $kelasBy;
        }
        if(!empty($pelajaranBy)){
            $conditions['search']['pelajaranBy'] = $pelajaranBy;
        }
        if(!empty($guruBy)){
            $conditions['search']['guruBy'] = $guruBy;
        }
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQueryTerkumpul($conditions));

        //pagination configuration
        $config['target']      = '#postListTerkumpul tbody';
        $config['base_url']    = base_url().'guru/soalarsip/ajaxPaginationDataTerkumpul';
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
        $data['empData'] = $this->cobaQueryTerkumpul($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function cobaQueryTerkumpul($params = array()){

        $soal = $this->db->select('*')->from('soal_arsip');

        $soal = $soal->where('soal_guru',$this->guru);
        $soal = $soal->where('soal_tahunajaran',$this->tahunajaran);

        $soal = $soal->group_by('soal_pelajaran');
        $soal = $soal->group_by('soal_kelas');
        $soal = $soal->group_by('soal_guru');


        if(!empty($params['search']['kelasBy'])){
            $soal = $soal->where('soal_kelas',$params['search']['kelasBy']);
        }

        if(!empty($params['search']['pelajaranBy'])){
            $soal = $soal->where('soal_pelajaran',$params['search']['pelajaranBy']);
        }

        if(!empty($params['search']['guruBy'])){
            $soal = $soal->where('soal_guru',$params['search']['guruBy']);
        }


        $soal = $soal->get();

        $nomor = 0;
        $data = array();
        foreach ($soal->result_array() as $row){
            $baris = array();

            $nomor++;

            $soal_pelajaran     = $row['soal_pelajaran'];
            $soal_guru     = $row['soal_guru'];
            $soal_untuk     = $row['soal_untuk'];
            $soal_kelas     = $row['soal_kelas'];

            $baris['soal_kelas']     = $soal_kelas;
            $baris['soal_pelajaran']     = $soal_pelajaran;
            $baris['soal_guru']     = $soal_guru;
            $baris['soal_untuk']     = $soal_untuk;

            $w1 = array(
                'soal_tahunajaran' => $this->tahunajaran,

                'soal_pelajaran' => $soal_pelajaran,
                'soal_guru' => $soal_guru,
                'soal_untuk' => $soal_untuk
            );

            if(!empty($soal_kelas)){
                $w1 = array(
                    'soal_tahunajaran' => $this->tahunajaran,

                    'soal_pelajaran' => $soal_pelajaran,
                    'soal_guru' => $soal_guru,
                    'soal_kelas' => $soal_kelas,
                    'soal_untuk' => $soal_untuk
                );
            }

            $data_soal = $this->db->get_where("soal",$w1);

            $baris['soal_jumlah_terkumpul']     = $data_soal->num_rows();
            $baris['soal_jumlah_terkumpul_total']     = 0;


            array_push($data, $baris);
        }

        return $data;

    }



    function ambildatabyid(){
        $id = $this->input->get('id');
        $users = $this->db->get_where('soal_arsip', array('soal_id'=>$id));


        $baris = array();
        foreach ($users->result_array() as $row){

            $soal_text_jawab = json_decode($row['soal_text_jawab']);

            $baris['soal_jenis'] = $row['soal_jenis'];
            $baris['soal_text'] = $row['soal_text'];
            $baris['soal_text_deskripsi'] = $row['soal_text_deskripsi'];
            $baris['soal_text_jawab']     = ($row['soal_jenis'] != 'essay') ? $soal_text_jawab : $row['soal_text_jawab'];
            $baris['soal_date']     = $row['soal_date'];
            $baris['soal_kelas']     = $row['soal_kelas'];
            $baris['soal_pelajaran']     = $row['soal_pelajaran'];
            $baris['soal_date']     = $row['soal_date'];
            $baris['soal_guru']     = $row['soal_guru'];
            $baris['soal_untuk']     = $row['soal_untuk'];
            $baris['soal_parent_id']     = $row['soal_parent_id'];
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }

    function hapus()
    {
        $level = $this->session->userdata('level');
        if($level !== 'admin')
        {
            exit();
        }
        else
        {
            $id = $this->input->get('id');
            $this->db->where('soal_id',$id);
            $hapus = $this->db->delete('soal_arsip');
            if($hapus)
            {
                echo json_encode(array(
                    "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>
					"));
            }
            else
            {
                echo json_encode(array(
                    "pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
            }
        }
    }

    function uploadfile(){
        $tahun = date("Y");
        $bulan = date("m");
        //$user = mysqli_fetch_object(mysqli_query($db,"SELECT * FROM `users` WHERE oauth_uid='$oauth_uid'"));

        // Images upload path
        $imageFolder = "uploads/soal";

        $namafile = date("YdmHis");

        reset($_FILES);
        $temp = current($_FILES);
        if(is_uploaded_file($temp['tmp_name'])){
            if(isset($_SERVER['HTTP_ORIGIN'])){
                header('Access-Control-Allow-Origin: *');
            }

            // Sanitize input
            if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if(!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))){
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            if(!file_exists($imageFolder . '/' . $tahun)){
                mkdir($imageFolder . '/' . $tahun);

                if(!file_exists($imageFolder . '/' . $tahun  . '/' . $bulan)){
                    mkdir($imageFolder . '/' . $tahun  . '/' . $bulan);
                }
            }else{
                if(!file_exists($imageFolder . '/' . $tahun  . '/' . $bulan)){
                    mkdir($imageFolder . '/' . $tahun  . '/' . $bulan);
                }
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . '/' . $tahun  . '/' . $bulan . '/' . $namafile.$temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            // Respond to the successful upload with JSON.
            echo json_encode(array('location' => base_url( $filetowrite) ));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
    }



    function ambildatabyid2(){
        $id = $this->input->get('id');
        $users = $this->db->get_where('soal_pembuat', array('soal_pembuat_id'=>$id));


        $baris = array();
        foreach ($users->result_array() as $row){

            $baris['soal_pembuat_kelas'] = $row['soal_pembuat_kelas'];
            $baris['soal_pembuat_jurusan'] = $row['soal_pembuat_jurusan'];
            $baris['soal_pembuat_pelajaran'] = $row['soal_pembuat_pelajaran'];
            $baris['soal_pembuat_guru'] = $row['soal_pembuat_guru'];
            $baris['soal_pembuat_untuk'] = $row['soal_pembuat_untuk'];
            $baris['soal_pembuat_jumlah'] = $row['soal_pembuat_jumlah'];
            $baris['soal_pembuat_tanggal'] = $row['soal_pembuat_tanggal'];
            $baris['soal_pembuat_tanggal_dikumpulkan'] = $row['soal_pembuat_tanggal_dikumpulkan'];
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }


    function hapus2()
    {
        $level = $this->session->userdata('level');
        if($level !== 'admin')
        {
            exit();
        }
        else
        {
            $id = $this->input->get('id');
            $this->db->where('soal_pembuat_id',$id);
            $hapus = $this->db->delete('soal_pembuat');
            if($hapus)
            {
                echo json_encode(array(
                    "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>
					"));
            }
            else
            {
                echo json_encode(array(
                    "pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
            }
        }
    }

    function hapus_parent()
    {
        $level = $this->session->userdata('level');
        if($level !== 'admin')
        {
            exit();
        }
        else
        {
            $id = $this->input->get('id');
            $this->db->where('soal_parent_id',$id);
            $hapus = $this->db->delete('soal_parent');
            if($hapus)
            {
                echo json_encode(array(
                    "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>
					"));
            }
            else
            {
                echo json_encode(array(
                    "pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
            }
        }
    }



    function ambildatabyid3(){
        $id = $this->input->get('id');
        $users = $this->db->get_where('soal_parent', array('soal_parent_id'=>$id));


        $baris = array();
        foreach ($users->result_array() as $row){

            $baris['soal_parent_text'] = $row['soal_parent_text'];
            $baris['soal_parent_date']     = $row['soal_parent_date'];
            $baris['soal_parent_pelajaran']     = $row['soal_parent_pelajaran'];
            $baris['soal_parent_guru']     = $row['soal_parent_guru'];
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }



    function hapus3()
    {
        $pelajaran = $this->input->get('pelajaran');
        $guru = $this->input->get('guru');
        $kelas = $this->input->get('kelas');
        $untuk = $this->input->get('untuk');

        $level = $this->session->userdata('level');
        if($level !== 'admin')
        {
            exit();
        }
        else
        {
            $id = $this->input->get('id');
            $this->db->where(array(
                'soal_pelajaran' => $pelajaran,
                'soal_guru' => $guru,
                'soal_kelas' => $kelas,
                'soal_untuk' => $untuk,
            ));
            $hapus = $this->db->delete('soal_arsip');
            if($hapus)
            {
                echo json_encode(array(
                    "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>
					"));
            }
            else
            {
                echo json_encode(array(
                    "pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
            }
        }
    }





    function getguru(){
        $pelajaran = $this->input->get("pelajaran");

        $this->db->select("*")->from("soal_pembuat");
        $this->db->where("soal_pembuat_pelajaran",$pelajaran);


        $this->db->where("soal_pembuat_tahunajaran",$this->tahunajaran);

        $this->db->group_by("soal_pembuat_guru");
        $this->db->order_by("soal_pembuat_guru","asc");
        $this->db->limit(1);

        //get records
        $query = $this->db->get();

        $data = array();
        foreach($query->result() as $row){
            $data['id'] = $row->soal_pembuat_guru;
            $data['label'] = $row->soal_pembuat_guru;
            $data['label2'] = $row->soal_pembuat_untuk;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($data);

        //return $data;
    }





    function simpantahunajaran_arsip(){
        $baris = array();
        $baris["tahunajaran_arsip"] = $this->input->post("tahunajaran");

        $this->session->set_userdata($baris);

        $data['success'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
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

    function _jurusan(){
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

    function _jurusan_array(){
	    //$data2['jurusan_array'] = "['".implode("','",$this->_jurusan_array())."']";

        $this->db->select("*")->from("peserta");

        $this->db->group_by("peserta_jurusan");
        $this->db->order_by("peserta_jurusan","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            array_push($items, $row->peserta_jurusan);

        }
        return $items;
    }

    function _pelajaran(){
        $this->db->select("*")->from("soal_pembuat");
        $this->db->where("soal_pembuat_tahunajaran", $this->tahunajaran);

        $this->db->group_by("soal_pembuat_pelajaran");
        $this->db->order_by("soal_pembuat_pelajaran","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->soal_pembuat_pelajaran;
            $data['label'] = $row->soal_pembuat_pelajaran;

            array_push($items, $data);

        }
        return $items;
    }

    function _guru(){
        $this->db->select("*")->from("soal_pembuat");
        $this->db->where("soal_pembuat_tahunajaran", $this->tahunajaran);

        $this->db->group_by("soal_pembuat_guru");
        $this->db->order_by("soal_pembuat_guru","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->soal_pembuat_guru;
            $data['label'] = $row->soal_pembuat_guru;

            array_push($items, $data);

        }

        return $items;
    }



    function _kelasBySoal(){
        $this->db->select("*")->from("soal");
        $this->db->where("soal_tahunajaran", $this->tahunajaran);

        $this->db->group_by("soal_kelas");
        $this->db->order_by("soal_kelas","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->soal_kelas;
            $data['label'] = $row->soal_kelas;

            array_push($items, $data);

        }
        return $items;
    }

    function _pelajaranBySoal(){
        $this->db->select("*")->from("soal");

        $this->db->where("soal_tahunajaran", $this->tahunajaran);

        $this->db->group_by("soal_pelajaran");
        $this->db->order_by("soal_pelajaran","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->soal_pelajaran;
            $data['label'] = $row->soal_pelajaran;

            array_push($items, $data);

        }
        return $items;
    }

    function _guruBySoal(){
        $this->db->select("*")->from("soal");
        $this->db->where("soal_tahunajaran", $this->tahunajaran);

        $this->db->group_by("soal_guru");
        $this->db->order_by("soal_guru","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->soal_guru;
            $data['label'] = $row->soal_guru;

            array_push($items, $data);

        }

        return $items;
    }



    function _jumlah_pelajaran(){
        $ikut = $this->db->select('*')->from('soal_arsip');

        $this->db->where("soal_tahunajaran", $this->tahunajaran);

        $ikut = $ikut->group_by('soal_pelajaran');
        $ikut = $ikut->group_by('soal_kelas');
        $ikut = $ikut->group_by('soal_guru');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_guru(){
        $ikut = $this->db->select('*')->from('soal_arsip');

        $this->db->where("soal_tahunajaran", $this->tahunajaran);

        $ikut = $ikut->group_by('soal_guru');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_soal(){
        $this->db->select('*')->from('soal_arsip');

        $this->db->where("soal_tahunajaran", $this->tahunajaran);

        $ikut = $this->db->get();

        return $ikut->num_rows();
    }

    function query_error($text){
        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode(array('status' => 0, 'pesan' => "<font color='red'><i class='fas fa-exclamation-triangle'></i> ".$text."</font>"));
    }
}
?>