<?php
defined('BASEPATH') or exit();

class Soalarsip extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');
		$this->load->helpers('text');


        if($this->session->userdata('level') != 'siswa'){
            redirect('home');
        }


        $this->user_id = $this->session->userdata('uid');
        $this->siswa_id = $this->session->userdata('uid');
        $this->siswa_agama = $this->session->userdata('agama');
        $this->kelas_sekarang = $this->session->userdata('kelas');
        $this->jurusan_id = $this->session->userdata('jurusan');
        $this->ruang = $this->session->userdata('jurusan_ke');
        $this->ruangan = $this->session->userdata('ruangan');

        $this->tahunajaran = $this->session->userdata('tahunajaran_arsip');

	}
	
	function index(){

        $data = array();
        $data['title'] = "Data Soal";
        $data['kumpul'] = array();

        $data["tahunajaran_arsip"] = $this->session->userdata('tahunajaran_arsip');

        $this->template->load('template_siswa','siswa/soal_arsip',$data);
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
        $config['base_url']    = base_url().'siswa/soalarsip/ajaxPaginationDataTerkumpul';
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

        $data = array();
        $ujian = $this->db->select('*')->from('ujian');
        $ujian = $ujian->where('(ujian_tahunajaran=\''.$this->tahunajaran.'\')');
        $ujian = $ujian->where('(ujian_kelas=\'\' OR ujian_kelas=\''.$this->kelas_sekarang.'\')');

        if(!empty($params['search']['sortBy'])){
            $ujian = $ujian->order_by('ujian_mulai',$params['search']['sortBy']);
        }else{
            $ujian = $ujian->order_by('ujian_mulai','asc');
        }

        if(!empty($params['search']['keywords'])){
            $ujian = $ujian->like('ujian_pelajaran',$params['search']['keywords']);
            $ujian = $ujian->or_like('ujian_guru',$params['search']['keywords']);
        }

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit']);
        }

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
                $data_ujian[ 'ujian_tanggal_indo' ] = $this->m->tanggalhari2( $row1['ujian_tanggal'],true );
                $data_ujian[ 'ujian_jumlah_soal' ] = $row1['ujian_jumlah_soal'];
                $data_ujian[ 'ujian_jenis' ] = $row1['ujian_jenis'];

                $data_ujian[ 'ujian_pelajaran' ] = $row1['ujian_pelajaran'];
                $data_ujian[ 'ujian_guru' ] = $row1['ujian_guru'];
                $data_ujian[ 'ujian_untuk' ] = $row1['ujian_untuk'];
                $data_ujian[ 'ujian_kelas' ] = $row1['ujian_kelas'];

                array_push($data, $data_ujian);
            }
        }

        return $data;

    }


    function simpantahunajaran_arsip(){
        $baris = array();
        $baris["tahunajaran_arsip"] = $this->input->post("tahunajaran");

        $this->session->set_userdata($baris);

        $data['success'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }



    function _jumlah_pelajaran(){
        $ikut = $this->db->select('*')->from('soal');

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