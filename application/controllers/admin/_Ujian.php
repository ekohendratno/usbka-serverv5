<?php
defined('BASEPATH') or exit();

class Ujian extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');


        if($this->session->userdata('level') != 'admin'){
            redirect('home');
        }


        $this->tahunajaran = $this->session->userdata('tahunajaran');
        $this->kegiatan = $this->session->userdata('kegiatan');
	}
	
	function index(){

        $data = array();
        $data['title'] = "Data Ujian";
        $data['ujian'] = 0;//$this->ujian();
        $data['ujianlist'] = 0;//$this->ujianlist(true);
        $data['kegiatan'] = $this->kegiatan;

        $data['pelajaran'] = $this->_pelajaran();
        $data['guru'] = $this->_guru();
        $data['untuk'] = $this->_untuk();
        $data['agama'] = $this->_agama();
        $data['kelas'] = $this->_kelas();
        $data['jurusan'] = $this->_jurusan();

        $data['untukByUjian'] = $this->_untukByUjian();

        $data['total_pelajaran'] = $this->_jumlah_pelajaran();
        $data['total_ujian'] = $this->_jumlah_ujian();
        $data['total_ujian_day'] = $this->_jumlah_ujian("today");
        $data['total_ujian_yesterday'] = $this->_jumlah_ujian("yesterday");
        $data['total_ujian_tomorrow'] = $this->_jumlah_ujian("tomorrow");

        $data['lock_ujian'] = $this->m->getpengaturan('lock_ujian');

        //$this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        //echo json_encode($data2);

        $this->template->load('template','admin/ujian',$data);
	}

	function ajaxPaginationData(){
		
        $this->perPage = 5;
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
        $untukBy = $this->input->post('untukBy');
	
		
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
        if(!empty($untukBy)){
            $conditions['search']['untukBy'] = $untukBy;
        }
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }
        
		
        //total rows count
        $totalRec = count($this->cobaQuery2($conditions));
        
        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'admin/ujian/ajaxPaginationData';
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

        $data = array();
        $ujian = $this->db->select('*')->from('ujian');

        $ujian = $ujian->where('ujian_tahunajaran',$this->tahunajaran);
        $ujian = $ujian->where('ujian_untuk',$this->kegiatan);

        if(!empty($params['search']['keywords'])){
            $ujian = $ujian->like('ujian_pelajaran',$params['search']['keywords'], 'both');
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $ujian = $ujian->order_by('ujian_tanggal',$params['search']['sortBy']);
        }else{
            $ujian = $ujian->order_by('ujian_tanggal','desc');
        }

        if(!empty($params['search']['kelasBy'])){
            $ujian = $ujian->where('ujian_kelas',$params['search']['kelasBy']);
        }

        if(!empty($params['search']['jurusanBy'])){
            $ujian = $ujian->where('ujian_jurusan',$params['search']['jurusanBy']);
        }

        if(!empty($params['search']['untukBy'])){
            $ujian = $ujian->where('ujian_untuk',$params['search']['untukBy']);
        }

        $ujian = $ujian->group_by('ujian_tanggal');


        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit']);
        }

        $ujian = $ujian->get();

        $hitung = 0;
        foreach ($ujian->result_array() as $row1){
            $data_ujian = array();
            $data_ujian['ujian_tanggal'] = $row1['ujian_tanggal'];
            $data_ujian['ujian_tanggal_indo'] = $this->m->tanggalhari2( $row1['ujian_tanggal'],true );
            $data_ujian['tanggal'] =  array();

            $ujian1 = $this->db->select('*')->from('ujian');

            $ujian1 = $ujian1->where('ujian_tahunajaran',$this->tahunajaran);
            $ujian1 = $ujian1->where('ujian_untuk',$this->kegiatan);

            if(!empty($params['search']['keywords'])){
                $ujian1 = $ujian1->like('ujian_pelajaran',$params['search']['keywords'], 'both');
            }

            //sort data by ascending or desceding order
            if(!empty($params['search']['sortBy'])){
                $ujian1 = $ujian1->order_by('ujian_mulai',$params['search']['sortBy']);
            }else{
                $ujian1 = $ujian1->order_by('ujian_mulai','desc');
            }

            if(!empty($params['search']['kelasBy'])){
                $ujian1 = $ujian1->where('ujian_kelas',$params['search']['kelasBy']);
            }

            if(!empty($params['search']['jurusanBy'])){
                $ujian1 = $ujian1->where('ujian_jurusan',$params['search']['jurusanBy']);
            }

            if(!empty($params['search']['untukBy'])){
                $ujian1 = $ujian1->where('ujian_untuk',$params['search']['untukBy']);
            }

            $ujian1 = $ujian1->where('ujian_tanggal',$row1['ujian_tanggal']);

            //$ujian1 = $ujian1->where('guru_id',$this->guru_id);

            $ujian1 = $ujian1->get();

            $hitung = 0;
            foreach ($ujian1->result_array() as $row2){
                $data_ujian1 = array();

                $data_ujian1[ 'ujian_id' ] = $row2['ujian_id'];
                $data_ujian1[ 'ujian_tanggal' ] = $row2['ujian_tanggal'];
                $data_ujian1[ 'ujian_mulai' ] = date("H:i:s", strtotime($row2['ujian_mulai']));
                $data_ujian1[ 'ujian_selesai' ] = date("H:i:s", strtotime('+'.$row2['ujian_waktu'].' minutes',strtotime($row2['ujian_mulai'])));
                $data_ujian1[ 'ujian_mulai_indo' ] = $this->m->tanggalhari2( $row2['ujian_tanggal'],true );
                $data_ujian1[ 'ujian_waktu' ] = $row2['ujian_waktu'];
                $data_ujian1[ 'ujian_jenis' ] = $row2['ujian_jenis'];
                $data_ujian1[ 'ujian_jumlah_soal' ] = $row2['ujian_jumlah_soal'];
                $data_ujian1[ 'ujian_agama' ] = $row2['ujian_agama'];
                $data_ujian1[ 'ujian_pelajaran' ] = $row2['ujian_pelajaran'];

                $data_ujian1[ 'ujian_kelas' ] = $row2['ujian_kelas'];
                $data_ujian1[ 'ujian_jurusan' ] = $row2['ujian_jurusan'];

                $data_ujian1[ 'ujian_guru' ] = $row2['ujian_guru'];
                $data_ujian1[ 'ujian_untuk' ] = $row2['ujian_untuk'];
                $data_ujian1[ 'ujian_tahunajaran' ] = $row2['ujian_tahunajaran'];


                array_push($data_ujian['tanggal'], $data_ujian1);
            }

            array_push($data, $data_ujian);
        }

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }




    function ajaxPaginationDataSekarang(){

        $this->perPage = 5;
        $conditions = array();

        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        //set conditions for search

        $untukBy = $this->input->post('untukBy');
        if(!empty($untukBy)){
            $conditions['search']['untukBy'] = $untukBy;
        }

        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQuery2Sekarang($conditions));

        //pagination configuration
        $config['target']      = '#postListSekarang tbody';
        $config['base_url']    = base_url().'admin/ujian/ajaxPaginationDataSekarang';
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
        $data['empData'] = $this->cobaQuery2Sekarang($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    function cobaQuery2Sekarang($params = array()){

        $data = array();
        $ujian = $this->db->select('*')->from('ujian');


        $ujian = $ujian->where('ujian_tahunajaran',$this->tahunajaran);
        $ujian = $ujian->where('ujian_untuk',$this->kegiatan);

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $ujian = $ujian->order_by('ujian_tanggal',$params['search']['sortBy']);
        }else{
            $ujian = $ujian->order_by('ujian_tanggal','desc');
        }

        if(!empty($params['search']['untukBy'])){
            $ujian = $ujian->where('ujian_untuk',$params['search']['untukBy']);
        }

        $ujian = $ujian->group_by('ujian_tanggal');

        $tgl = date('Y-m-d');
        $ujian = $ujian->where('ujian_tanggal' ,$tgl);

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit']);
        }

        $ujian = $ujian->get();

        $hitung = 0;
        foreach ($ujian->result_array() as $row1){
            $data_ujian = array();
            $data_ujian['ujian_tanggal'] = $row1['ujian_tanggal'];
            $data_ujian['ujian_tanggal_indo'] = $this->m->tanggalhari2( $row1['ujian_tanggal'],true );
            $data_ujian['tanggal'] =  array();

            $ujian1 = $this->db->select('*')->from('ujian');


            $ujian1 = $ujian1->where('ujian_tahunajaran',$this->tahunajaran);
            $ujian1 = $ujian1->where('ujian_untuk',$this->kegiatan);

            //sort data by ascending or desceding order
            if(!empty($params['search']['sortBy'])){
                $ujian1 = $ujian1->order_by('ujian_mulai',$params['search']['sortBy']);
            }else{
                $ujian1 = $ujian1->order_by('ujian_mulai','desc');
            }

            if(!empty($params['search']['kelasBy'])){
                $ujian1 = $ujian1->where('ujian_kelas',$params['search']['kelasBy']);
            }

            if(!empty($params['search']['jurusanBy'])){
                $ujian1 = $ujian1->where('ujian_jurusan',$params['search']['jurusanBy']);
            }

            $ujian1 = $ujian1->where('ujian_tanggal',$row1['ujian_tanggal']);

            //$ujian1 = $ujian1->where('guru_id',$this->guru_id);

            $ujian1 = $ujian1->get();

            $hitung = 0;
            foreach ($ujian1->result_array() as $row2){
                $data_ujian1 = array();

                $data_ujian1[ 'ujian_id' ] = $row2['ujian_id'];
                $data_ujian1[ 'ujian_tanggal' ] = $row2['ujian_tanggal'];
                $data_ujian1[ 'ujian_mulai' ] = date("H:i:s", strtotime($row2['ujian_mulai']));
                $data_ujian1[ 'ujian_selesai' ] = date("H:i:s", strtotime('+'.$row2['ujian_waktu'].' minutes',strtotime($row2['ujian_mulai'])));
                $data_ujian1[ 'ujian_mulai_indo' ] = $this->m->tanggalhari2( $row2['ujian_tanggal'],true );
                $data_ujian1[ 'ujian_waktu' ] = $row2['ujian_waktu'];
                $data_ujian1[ 'ujian_jenis' ] = $row2['ujian_jenis'];
                $data_ujian1[ 'ujian_jumlah_soal' ] = $row2['ujian_jumlah_soal'];
                $data_ujian1[ 'ujian_agama' ] = $row2['ujian_agama'];
                $data_ujian1[ 'ujian_pelajaran' ] = $row2['ujian_pelajaran'];

                $data_ujian1[ 'ujian_kelas' ] = $row2['ujian_kelas'];
                $data_ujian1[ 'ujian_jurusan' ] = $row2['ujian_jurusan'];

                $data_ujian1[ 'ujian_guru' ] = $row2['ujian_guru'];
                $data_ujian1[ 'ujian_untuk' ] = $row2['ujian_untuk'];
                $data_ujian1[ 'ujian_tahunajaran' ] = $row2['ujian_tahunajaran'];


                array_push($data_ujian['tanggal'], $data_ujian1);
            }

            array_push($data, $data_ujian);
        }

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }



    function ajaxPaginationDataBesok(){

        $this->perPage = 5;
        $conditions = array();

        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        //set conditions for search

        $untukBy = $this->input->post('untukBy');
        if(!empty($untukBy)){
            $conditions['search']['untukBy'] = $untukBy;
        }

        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQuery2Besok($conditions));

        //pagination configuration
        $config['target']      = '#postListBesok tbody';
        $config['base_url']    = base_url().'admin/ujian/ajaxPaginationDataBesok';
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
        $data['empData'] = $this->cobaQuery2Besok($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    function cobaQuery2Besok($params = array()){

        $data = array();
        $ujian = $this->db->select('*')->from('ujian');

        $ujian = $ujian->where('ujian_tahunajaran',$this->tahunajaran);
        $ujian = $ujian->where('ujian_untuk',$this->kegiatan);

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $ujian = $ujian->order_by('ujian_tanggal',$params['search']['sortBy']);
        }else{
            $ujian = $ujian->order_by('ujian_tanggal','desc');
        }

        if(!empty($params['search']['untukBy'])){
            $ujian = $ujian->where('ujian_untuk',$params['search']['untukBy']);
        }

        $ujian = $ujian->group_by('ujian_tanggal');

        $tgl = date('Y-m-d');
        $tanggal = date('Y-m-d', strtotime($tgl. ' + 1 days'));
        $ujian = $ujian->where('ujian_tanggal',$tanggal);

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit']);
        }

        $ujian = $ujian->get();

        $hitung = 0;
        foreach ($ujian->result_array() as $row1){
            $data_ujian = array();
            $data_ujian['ujian_tanggal'] = $row1['ujian_tanggal'];
            $data_ujian['ujian_tanggal_indo'] = $this->m->tanggalhari2( $row1['ujian_tanggal'],true );
            $data_ujian['tanggal'] =  array();

            $ujian1 = $this->db->select('*')->from('ujian');

            $ujian1 = $ujian1->where('ujian_tahunajaran',$this->tahunajaran);
            $ujian1 = $ujian1->where('ujian_untuk',$this->kegiatan);

            //sort data by ascending or desceding order
            if(!empty($params['search']['sortBy'])){
                $ujian1 = $ujian1->order_by('ujian_mulai',$params['search']['sortBy']);
            }else{
                $ujian1 = $ujian1->order_by('ujian_mulai','desc');
            }

            if(!empty($params['search']['kelasBy'])){
                $ujian1 = $ujian1->where('ujian_kelas',$params['search']['kelasBy']);
            }

            if(!empty($params['search']['jurusanBy'])){
                $ujian1 = $ujian1->where('ujian_jurusan',$params['search']['jurusanBy']);
            }

            $ujian1 = $ujian1->where('ujian_tanggal',$row1['ujian_tanggal']);

            //$ujian1 = $ujian1->where('guru_id',$this->guru_id);

            $ujian1 = $ujian1->get();

            $hitung = 0;
            foreach ($ujian1->result_array() as $row2){
                $data_ujian1 = array();

                $data_ujian1[ 'ujian_id' ] = $row2['ujian_id'];
                $data_ujian1[ 'ujian_tanggal' ] = $row2['ujian_tanggal'];
                $data_ujian1[ 'ujian_mulai' ] = date("H:i:s", strtotime($row2['ujian_mulai']));
                $data_ujian1[ 'ujian_selesai' ] = date("H:i:s", strtotime('+'.$row2['ujian_waktu'].' minutes',strtotime($row2['ujian_mulai'])));
                $data_ujian1[ 'ujian_mulai_indo' ] = $this->m->tanggalhari2( $row2['ujian_tanggal'],true );
                $data_ujian1[ 'ujian_waktu' ] = $row2['ujian_waktu'];
                $data_ujian1[ 'ujian_jenis' ] = $row2['ujian_jenis'];
                $data_ujian1[ 'ujian_jumlah_soal' ] = $row2['ujian_jumlah_soal'];
                $data_ujian1[ 'ujian_agama' ] = $row2['ujian_agama'];
                $data_ujian1[ 'ujian_pelajaran' ] = $row2['ujian_pelajaran'];

                $data_ujian1[ 'ujian_kelas' ] = $row2['ujian_kelas'];
                $data_ujian1[ 'ujian_jurusan' ] = $row2['ujian_jurusan'];

                $data_ujian1[ 'ujian_guru' ] = $row2['ujian_guru'];
                $data_ujian1[ 'ujian_untuk' ] = $row2['ujian_untuk'];
                $data_ujian1[ 'ujian_tahunajaran' ] = $row2['ujian_tahunajaran'];


                array_push($data_ujian['tanggal'], $data_ujian1);
            }

            array_push($data, $data_ujian);
        }

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }




    function ajaxPaginationDataHasil(){

        $this->perPage = 40;
        $conditions = array();

        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        //set conditions for search
        $keywords = $this->input->get('keywords');
        $sortBy = $this->input->get('sortBy');

        $limitBy = $this->input->get('limitBy');
        $kelasBy = $this->input->get('kelasBy');
        $jurusanBy = $this->input->get('jurusanBy');
        $id = $this->input->get('id');


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
        if(!empty($id)){
            $conditions['search']['id'] = $id;
        }
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQueryHasil($conditions));

        //pagination configuration
        $config['target']      = '#postListHasil tbody';
        $config['base_url']    = base_url().'admin/ujian/ajaxPaginationDataHasil';
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
        $data['empData'] = $this->cobaQueryHasil($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    function cobaQueryHasil($params = array()){

        $data = array();

        $soal_jawab = $this->db->select(
            'soal_jawab.soal_jawab_id,'.
            'soal_jawab.siswa_id,'.
            'soal_jawab.ujian_id,'.
            'soal_jawab.soal_jawab_pelajaran,'.
            'soal_jawab.soal_jawab_mulai,'.
            'soal_jawab.soal_jawab_selesai,'.
            'soal_jawab.soal_jawab_benar,'.
            'soal_jawab.soal_jawab_salah,'.
            'soal_jawab.soal_jawab_status,'.
            'soal_jawab.soal_jawab_kelas,'.
            'soal_jawab.soal_jawab_jurusan,'.
            'soal_jawab.soal_jawab_tahunajaran,'.
            'peserta.peserta_id,'.
            'peserta.peserta_nama,'.
            'peserta.peserta_jk,'.
            'peserta.peserta_kelas,'.
            'peserta.peserta_jurusan,'.
            'peserta.peserta_jurusan_ke'
        )
            ->from('soal_jawab')
            ->join('peserta', 'peserta.peserta_id = soal_jawab.siswa_id', 'LEFT');


        $soal_jawab = $soal_jawab->order_by('peserta.peserta_kelas','asc');
        $soal_jawab = $soal_jawab->order_by('peserta.peserta_jurusan','asc');
        $soal_jawab = $soal_jawab->order_by('peserta.peserta_jurusan_ke','asc');
        $soal_jawab = $soal_jawab->order_by('peserta.peserta_nama','asc');

        $soal_jawab = $soal_jawab->where('soal_jawab.soal_jawab_tahunajaran',$this->tahunajaran);

        $soal_jawab = $soal_jawab->where('soal_jawab.ujian_id',$params['search']['id']);

        if(!empty($params['search']['kelasBy'])){
            $soal_jawab = $soal_jawab->where('soal_jawab.soal_jawab_kelas',$params['search']['kelasBy']);
        }

        if(!empty($params['search']['jurusanBy'])){
            $soal_jawab = $soal_jawab->where('soal_jawab.soal_jawab_jurusan',$params['search']['jurusanBy']);
        }

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            //$this->db->like('peserta.peserta_nama',$params['search']['keywords']);
        }

        $soal_jawab = $soal_jawab->get();

        $hitung = 0;
        foreach ($soal_jawab->result_array() as $row1){


            array_push($data, $row1);
        }

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($hari);
    }


    function ambildatabyid(){
        $id = $this->input->get('id');
        $users = $this->db->get_where('ujian', array('ujian_id'=>$id));


        $data = array();
        foreach ($users->result_array() as $row){
            $data['ujian_kelas'] = $row['ujian_kelas'];
            $data['ujian_jurusan'] =  $row['ujian_jurusan'];
            $data['ujian_pelajaran'] =  $row['ujian_pelajaran'];
            $data['ujian_guru'] =  $row['ujian_guru'];
            $data['ujian_untuk'] =  $row['ujian_untuk'];
            $data['ujian_jenis'] =  $row['ujian_jenis'];
            $data['ujian_tanggal'] =  $row['ujian_tanggal'];
            $data['ujian_mulai'] =  $row['ujian_mulai'];
            $data['ujian_waktu'] =  $row['ujian_waktu'];
            $data['ujian_jumlah_soal'] =  $row['ujian_jumlah_soal'];
            $data['ujian_agama'] =  $row['ujian_agama'];
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    function simpan(){

        $id 	            = $this->input->post('id');
        $ujian_kelas		    = $this->input->post('ujian_kelas');
        $ujian_jurusan		    = $this->input->post('ujian_jurusan');
        $ujian_pelajaran		    = $this->input->post('ujian_pelajaran');
        $ujian_guru		    = $this->input->post('ujian_guru');
        $ujian_untuk		    = $this->input->post('ujian_untuk');
        $ujian_jenis		    = $this->input->post('ujian_jenis');
        $ujian_tanggal		    = $this->input->post('ujian_tanggal');
        $ujian_mulai		    = $this->input->post('ujian_mulai');
        $ujian_waktu		    = $this->input->post('ujian_waktu');
        $ujian_jumlah_soal		    = $this->input->post('ujian_jumlah_soal');
        $ujian_agama		    = $this->input->post('ujian_agama');

        $response = array();
        $response["response"] = array();
        $response["success"] = false;

        if(empty($ujian_kelas)) $this->query_error("Kelas kosong!");
        elseif(empty($ujian_pelajaran)) $this->query_error("Pelajaran kosong!");
        elseif(empty($ujian_guru)) $this->query_error("Guru kosong!");
        elseif(empty($ujian_untuk)) $this->query_error("Untuk kosong!");
        elseif(empty($ujian_jenis)) $this->query_error("Jenis kosong!");
        else {

            $data = array();
            $data['ujian_kelas'] = $ujian_kelas;
            $data['ujian_jurusan'] = $ujian_jurusan;
            $data['ujian_pelajaran'] = $ujian_pelajaran;
            $data['ujian_guru'] = $ujian_guru;
            $data['ujian_untuk'] = $ujian_untuk;
            $data['ujian_jenis'] = $ujian_jenis;
            $data['ujian_tanggal'] = $ujian_tanggal;
            $data['ujian_mulai'] = $ujian_mulai;
            $data['ujian_waktu'] = $ujian_waktu;
            $data['ujian_jumlah_soal'] = $ujian_jumlah_soal;
            $data['ujian_agama'] = $ujian_agama;

            if ($id > 0) {
                $this->db->where('ujian_id', $id);
                $master = $this->db->update('ujian', $data);
            } else {

                $data['ujian_tahunajaran'] = $this->tahunajaran;

                $master = $this->db->insert('ujian', $data);
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

    function simpan_duplikat(){
        $id 	            = $this->input->get('id');

        if($id > 0){
            $master = $this->db->query("INSERT INTO cbt_ujian (
            SELECT  NULL,            
            `ujian_tanggal`,
            `ujian_tanggal_update`, 
            `ujian_mulai`, 
            `ujian_waktu`, 
            `ujian_jenis`, 
            `ujian_jumlah_soal`, 
            `ujian_agama`, 
            `ujian_kelas`, 
            `ujian_jurusan`, 
            `ujian_pelajaran`, 
            `ujian_guru`, 
            `ujian_untuk`  , 
            `ujian_tahunajaran`          
            FROM cbt_ujian 
            WHERE ujian_id = $id)");
            $id = $this->db->insert_id();
        }


        if( $master ){
            $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
            echo json_encode(array('id' => $id,'status' => 1, 'pesan' => "<font color='green'><i class='fa fa-check'></i> Data berhasil disimpan !</font>"));
        }else{
            $this->query_error();
        }
        /**
        INSERT INTO cbt_soal (SELECT NULL,`soal_jenis`,`soal_text`,`soal_text_deskripsi`,`soal_text_jawab`,`soal_date`,`soal_date_update`,`soal_pelajaran`,`soal_guru`,`soal_untuk` FROM cbt_soal WHERE soal_id = 3)
         */
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
            $this->db->where('ujian_id',$id);
            $hapus = $this->db->delete('ujian');
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



    function simpanhasil(){
        $id = $this->input->get('id');

        $soal_jawab = $this->db->get_where('soal_jawab',array('soal_jawab_id'=> $id))->result();

        $dx = array();
        foreach ($soal_jawab as $x) {

            $dx = array(
                'soal_jawab_selesai' => date('Y-m-d H:i:s'),
                'soal_jawab_last_update' => date('Y-m-d H:i:s'),
                'soal_jawab_status' => 'N'
            );

            $this->db->where(array('soal_jawab_id' => $id));
            $this->db->update('soal_jawab', $dx);

            $data['status'] = 'ok';
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dx);
    }

    function simpanhasil_all(){
        $id = $this->input->get('id');

        $soal_jawab = $this->db->get_where('soal_jawab',array('ujian_id'=> $id,"soal_jawab_status"=>"Y"))->result();

        foreach ($soal_jawab as $x) {


            $dx = array(
                'soal_jawab_selesai' => date('Y-m-d H:i:s'),
                'soal_jawab_last_update' => date('Y-m-d H:i:s'),
                'soal_jawab_status' => 'N'
            );

            $this->db->where(array('ujian_id' => $id));
            $this->db->update('soal_jawab', $dx);

        }

        $data['status'] = 'ok';
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function hapushasilbyid(){

        $id = $this->input->post('id');

        $this->db->where( array(
            'soal_jawab_id'=>$id
        ));
        $this->db->delete('soal_jawab');
    }


    function getguru(){
        $pelajaran = $this->input->get("pelajaran");

        $this->db->select("*")->from("soal_pembuat");


        $this->db->where('soal_pembuat_tahunajaran',$this->tahunajaran);
        $this->db->where('soal_pembuat_untuk',$this->kegiatan);

        $this->db->where("soal_pembuat_pelajaran",$pelajaran);
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

    function getpreview_siswa(){
        $id = $this->input->get("id");

        $this->db->select("*")->from("soal_jawab");

        $this->db->where('soal_jawab_tahunajaran',$this->tahunajaran);

        $this->db->where("soal_jawab_id",$id);

        //get records
        $query = $this->db->get();

        $data = array();
        $data['soal'] = array();
        foreach($query->result() as $row){
            $list_opsi = json_decode($row->soal_jawab_list_opsi);

            foreach ($list_opsi as $val){
                $id_soal = $val[0];
                $jenis = $val[1];
                $ragu = $val[2];
                $jawaban = $val[3];



                if ($jenis == 'optional') {
                    $opsi2 = array("A","B","C","D","E");

                    $ambil_soal = $this->db->get_where('soal', array('soal_id' => $id_soal))->result_array();
                    foreach ($ambil_soal as $s) {

                        $jawaban_x = "-";
                        if($jawaban != "-") $jawaban_x = $opsi2[$jawaban];

                        $s["jawaban"] = $jawaban_x;



                        array_push($data['soal'],$s);
                    }
                }

            }

        }

        //$this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        //echo json_encode($data);

        //return $data;

        $this->load->view('admin/ujian_preview',$data);
    }

    function gethasil(){

        $data2['title'] = "Hasil Ujian";
        $data2['ujian_id'] = $this->input->get('id');

        $this->template->load('template','admin/ujian_hasil',$data2);
    }


    function getkelasjurusanhasil(){
	    $id = $this->input->get("id");

        $this->db->select("*")->from("soal_jawab");


        $this->db->where('soal_jawab_tahunajaran',$this->tahunajaran);

        $this->db->where('ujian_id',$id);
        $this->db->group_by("soal_jawab_kelas");
        $this->db->order_by("soal_jawab_kelas","asc");

        $items["kelas"] = array();
        foreach($this->db->get()->result() as $row){

            array_push($items["kelas"], $row->soal_jawab_kelas);

        }

        $this->db->select("*")->from("soal_jawab");


        $this->db->where('soal_jawab_tahunajaran',$this->tahunajaran);

        $this->db->where('ujian_id',$id);

        $this->db->group_by("soal_jawab_jurusan");
        $this->db->order_by("soal_jawab_jurusan","asc");

        $items["jurusan"] = array();
        foreach($this->db->get()->result() as $row){

            array_push($items["jurusan"], $row->soal_jawab_jurusan);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($items);
    }


    function _untukByUjian(){
        $this->db->select("*")->from("ujian");
        $this->db->where("ujian_tahunajaran", $this->tahunajaran);
        $this->db->where('ujian_untuk',$this->kegiatan);

        $this->db->group_by("ujian_untuk");
        $this->db->order_by("ujian_untuk","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->ujian_untuk;
            $data['label'] = $row->ujian_untuk;

            array_push($items, $data);

        }

        return $items;
    }

    function _pelajaran(){
        $this->db->select("*")->from("soal");

        $this->db->where('soal_tahunajaran',$this->tahunajaran);
        $this->db->where('soal_untuk',$this->kegiatan);

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

    function _guru(){
        $this->db->select("*")->from("soal");

        $this->db->where('soal_tahunajaran',$this->tahunajaran);
        $this->db->where('soal_untuk',$this->kegiatan);

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

    function _untuk(){
        $this->db->select("*")->from("soal");

        $this->db->where('soal_tahunajaran',$this->tahunajaran);
        $this->db->where('soal_untuk',$this->kegiatan);

        $this->db->group_by("soal_untuk");
        $this->db->order_by("soal_untuk","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->soal_untuk;
            $data['label'] = $row->soal_untuk;

            array_push($items, $data);

        }
        return $items;
    }

    function _agama1(){
        $this->db->select("*")->from("peserta");
        $this->db->group_by("peserta_agama");
        $this->db->order_by("peserta_agama","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['id'] = $row->peserta_agama;
            $data['label'] = $row->peserta_agama;

            array_push($items, $data);

        }
        return $items;
    }

    function _agama(){
        $this->db->select("*")->from("peserta");
        $this->db->group_by("peserta_agama");
        $this->db->order_by("peserta_agama","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            array_push($items,$row->peserta_agama);
        }
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        return json_encode($items);
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

    function _jumlah_ujian($by = ""){
        $this->db->select('*')->from('ujian');


        $this->db->where('ujian_tahunajaran',$this->tahunajaran);
        $this->db->where('ujian_untuk',$this->kegiatan);

        $tgl = date('Y-m-d');
        if($by == "yesterday"){
            $tgl = date('Y-m-d', strtotime($tgl. ' - 1 days'));
            $this->db->where('ujian_tanggal' ,$tgl);
        }elseif($by == "today"){
            $this->db->where('ujian_tanggal' ,$tgl);
        }elseif($by == "tomorrow"){
            $tgl = date('Y-m-d', strtotime($tgl. ' + 1 days'));
            $this->db->where('ujian_tanggal' ,$tgl);
        }

        $ikut = $this->db->get();

        return $ikut->num_rows();
    }

    function _jumlah_pelajaran(){
        $this->db->select('*')->from('ujian');

        $this->db->where('ujian_tahunajaran',$this->tahunajaran);
        $this->db->where('ujian_untuk',$this->kegiatan);

        $this->db->group_by('ujian_pelajaran');
        $ikut = $this->db->get();

        return $ikut->num_rows();
    }

    function query_error($text){
        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode(array('status' => 0, 'pesan' => "<font color='red'><i class='fas fa-exclamation-triangle'></i> ".$text."</font>"));
    }
}
?>