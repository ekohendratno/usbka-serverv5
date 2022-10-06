<?php
defined('BASEPATH') or exit();

class Ujian extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');
		
		
		if($this->session->userdata('level') != 'guru'){
			redirect('home');
			
		}


        $this->guru = $this->session->userdata('nama');

        $this->tahunajaran = $this->session->userdata('tahunajaran');

	}
	
	function index(){


        $data['title'] = "Data Ujian";
        $data['total_pelajaran'] = $this->_jumlah_pelajaran();
        $data['total_ujian'] = $this->_jumlah_ujian();
        $data['total_ujian_day'] = $this->_jumlah_ujian("today");
        $data['total_ujian_yesterday'] = $this->_jumlah_ujian("yesterday");
        $data['total_ujian_tomorrow'] = $this->_jumlah_ujian("tomorrow");
		
        $this->template->load('template','guru/ujian',$data);
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
        $totalRec = count($this->cobaQuery2($conditions));

        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'guru/ujian/ajaxPaginationData';
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

        $ujian = $ujian->group_by('ujian_tanggal');


        $ujian = $ujian->where('ujian_guru',$this->guru);

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


            $ujian1 = $ujian1->where('ujian_guru',$this->guru);

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


        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQuery2Sekarang($conditions));

        //pagination configuration
        $config['target']      = '#postListSekarang tbody';
        $config['base_url']    = base_url().'guru/ujian/ajaxPaginationDataSekarang';
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

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $ujian = $ujian->order_by('ujian_tanggal',$params['search']['sortBy']);
        }else{
            $ujian = $ujian->order_by('ujian_tanggal','desc');
        }

        $ujian = $ujian->group_by('ujian_tanggal');

        $tgl = date('Y-m-d');
        $ujian = $ujian->where('ujian_tanggal' ,$tgl);

        $ujian = $ujian->where('ujian_guru',$this->guru);

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


        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQuery2Besok($conditions));

        //pagination configuration
        $config['target']      = '#postListBesok tbody';
        $config['base_url']    = base_url().'guru/ujian/ajaxPaginationDataBesok';
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

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $ujian = $ujian->order_by('ujian_tanggal',$params['search']['sortBy']);
        }else{
            $ujian = $ujian->order_by('ujian_tanggal','desc');
        }

        $ujian = $ujian->group_by('ujian_tanggal');

        $tgl = date('Y-m-d');
        $tanggal = date('Y-m-d', strtotime($tgl. ' + 1 days'));
        $ujian = $ujian->where('ujian_tanggal',$tanggal);

        $ujian = $ujian->where('ujian_guru',$this->guru);

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
        $config['base_url']    = base_url().'guru/ujian/ajaxPaginationDataHasil';
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






    function getkelasjurusanhasil(){
        $id = $this->input->get("id");

        $this->db->select("*")->from("soal_jawab")->where("ujian_id",$id);
        $this->db->group_by("soal_jawab_kelas");
        $this->db->order_by("soal_jawab_kelas","asc");

        $items["kelas"] = array();
        foreach($this->db->get()->result() as $row){

            array_push($items["kelas"], $row->soal_jawab_kelas);

        }

        $this->db->select("*")->from("soal_jawab")->where("ujian_id",$id);
        $this->db->group_by("soal_jawab_jurusan");
        $this->db->order_by("soal_jawab_jurusan","asc");

        $items["jurusan"] = array();
        foreach($this->db->get()->result() as $row){

            array_push($items["jurusan"], $row->soal_jawab_jurusan);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($items);
    }



    function _jumlah_ujian($by = ""){
        $ikut = $this->db->select('*')->from('ujian');

        $tgl = date('Y-m-d');
        if($by == "yesterday"){
            $tgl = date('Y-m-d', strtotime($tgl. ' - 1 days'));
            $ikut = $ikut->where('ujian_tanggal' ,$tgl);
        }elseif($by == "today"){
            $ikut = $ikut->where('ujian_tanggal' ,$tgl);
        }elseif($by == "tomorrow"){
            $tgl = date('Y-m-d', strtotime($tgl. ' + 1 days'));
            $ikut = $ikut->where('ujian_tanggal' ,$tgl);
        }

        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_pelajaran(){
        $ikut = $this->db->select('*')->from('ujian');
        $ikut = $ikut->group_by('ujian_pelajaran');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }
}
?>