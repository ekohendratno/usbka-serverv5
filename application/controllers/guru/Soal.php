<?php
defined('BASEPATH') or exit();

class Soal extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model('Mymodel','m');
        $this->load->helpers('form');
        $this->load->helpers('url');
        $this->load->helpers('text');


        if($this->session->userdata('level') != 'guru'){
            redirect('home');
        }

        $this->uid = $this->session->userdata('uid');
        $this->username = $this->session->userdata('username');
        $this->guru = $this->session->userdata('nama');


        $this->tahunajaran = $this->session->userdata('tahunajaran');

    }

    function index(){


        $data2['title'] = "Data Soal";

        $this->template->load('template','guru/soal',$data2);
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

        $idBy = $this->input->post('idBy');


        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($idBy)){
            $conditions['search']['idBy'] = $idBy;
        }
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQuery($conditions));

        //pagination configuration
        $config['target']      = '#postList0 tbody';
        $config['base_url']    = base_url().'guru/soal/ajaxPaginationData';
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

        $soal = $this->db->select('*')->from('soal');

        $soal = $soal->where('soal_tahunajaran',$this->tahunajaran);

        $soal = $soal->where('soal_guru',$this->guru);

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $soal = $soal->order_by('soal_date',$params['search']['sortBy']);
        }else{
            $soal = $soal->order_by('soal_date','desc');
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

            $baris['editable']     = false;
            $this->db->select('*')->from('soal_pembuat');

            $this->db->where('soal_pembuat_tahunajaran',$this->tahunajaran);

            $this->db->where('soal_pembuat_untuk',$row['soal_untuk']);
            $this->db->where('soal_pembuat_guru',$row['soal_guru']);
            $this->db->where('soal_pembuat_pelajaran',$row['soal_pelajaran']);
            //$this->db->where('soal_pembuat_kelas',$row['soal_kelas']);

            $this->db->where('(soal_pembuat_kelas=\'\' OR soal_pembuat_kelas=\''.$row['soal_kelas'].'\')');


            foreach ($this->db->get()->result_array() as $row2){

                $tanggal_sekarang = date('Y-m-d');
                $tanggal_max = date("Y-m-d", strtotime($row2["soal_pembuat_tanggal_dikumpulkan"]) );

                if($tanggal_sekarang < $tanggal_max ){
                    $baris['editable']     = true;
                }
            }


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
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQueryTerkumpul($conditions));

        //pagination configuration
        $config['target']      = '#postListTerkumpul tbody';
        $config['base_url']    = base_url().'guru/soal/ajaxPaginationDataTerkumpul';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilterTerkumpul';


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

        $this->db->select('*')->from('soal_pembuat');

        $this->db->where('soal_pembuat_tahunajaran',$this->tahunajaran);

        $this->db->where('soal_pembuat_guru',$this->guru);

        $nomor = 0;
        $data = array();
        foreach ($this->db->get()->result_array() as $row){
            $baris = array();

            $nomor++;

            $soal_pelajaran     = $row['soal_pembuat_pelajaran'];
            $soal_guru     = $row['soal_pembuat_guru'];
            $soal_untuk     = $row['soal_pembuat_untuk'];
            $soal_kelas     = $row['soal_pembuat_kelas'];
            $soal_jurusan     = $row['soal_pembuat_jurusan'];
            $soal_tanggal     = $row['soal_pembuat_tanggal'];
            $soal_tanggal_dikumpulkan     = $row['soal_pembuat_tanggal_dikumpulkan'];
            $soal_pembuat_jumlah     = $row['soal_pembuat_jumlah'];


            $baris['soal_pembuat_kelas']     = array();
            $baris['soal_pembuat_jurusan']     = $soal_jurusan;

            $baris['soal_pembuat_pelajaran']     = $soal_pelajaran;
            $baris['soal_pembuat_untuk']     = $soal_untuk;
            $baris['soal_pembuat_guru']     = $soal_guru;
            $baris['soal_pembuat_tanggal']     = $soal_tanggal;
            $baris['soal_pembuat_tanggal_dikumpulkan']     = $soal_tanggal_dikumpulkan;
            $baris['soal_pembuat_jumlah_terkumpul']     = array();
            $baris['soal_pembuat_jumlah']     = $soal_pembuat_jumlah;


            $baris['sub'] = false;
            $soal_kelas_sub = explode(",",$soal_kelas);

            foreach ($soal_kelas_sub as $kelas){
                array_push($baris['soal_pembuat_kelas'],$kelas);

                $this->db->select('*')->from('soal');

                $this->db->where('soal_tahunajaran',$this->tahunajaran);

                $this->db->where('soal_pelajaran',$soal_pelajaran);
                $this->db->where('soal_guru',$soal_guru);
                $this->db->where('soal_untuk',$soal_untuk);
                $this->db->where('soal_kelas',$kelas);

                array_push($baris['soal_pembuat_jumlah_terkumpul'],$this->db->get()->num_rows());
            }

            if(sizeof($baris['soal_pembuat_kelas']) > 1){
                $baris['sub'] = true;
            }





            $baris['editable']     = false;
            $tanggal_sekarang = date('Y-m-d');
            $tanggal_max = date("Y-m-d", strtotime( $soal_tanggal_dikumpulkan ) );



            if($tanggal_sekarang < $tanggal_max ){
                $baris['editable']     = true;
            }

            $tanggal_max = new DateTime($tanggal_max);
            $tanggal_sekarang = new DateTime($tanggal_sekarang);
            $perbedaan = $tanggal_max->diff($tanggal_sekarang);


            if($tanggal_max > $tanggal_sekarang  ) $baris['perbedaan'] = "Tersisa ".$perbedaan->d . " hari";
            elseif($tanggal_max == $tanggal_sekarang  ) $baris['perbedaan'] = "Tersisa hari ini";
            elseif( $perbedaan->d >= 7 ) $baris['perbedaan'] = $perbedaan->d . " hari yang lalu";
            else $baris['perbedaan']     = "Lewat ".$perbedaan->d . " hari";



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
        //get posts data
        $data['empData'] = $this->cobaQueryBySoal($conditions);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function cobaQueryBySoal($params = array()){

        $soal = $this->db->select('*')->from('soal');

        $soal = $soal->where('soal_tahunajaran',$this->tahunajaran);

        $soal = $soal->where('soal_guru',$this->guru);


        if(!empty($params['search']['kelasBy'])){
            $soal = $soal->where('soal_kelas',$params['search']['kelasBy']);
        }

        if(!empty($params['search']['pelajaranBy'])){
            $soal = $soal->where('soal_pelajaran',$params['search']['pelajaranBy']);
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






    function ajaxPaginationDataParent(){

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
        $totalRec = count($this->cobaQueryParent($conditions));

        //pagination configuration
        $config['target']      = '#postListParent tbody';
        $config['base_url']    = base_url().'guru/soal/ajaxPaginationDataParent';
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
        $data['empData'] = $this->cobaQueryParent($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function cobaQueryParent($params = array()){

        $soal = $this->db->select('*')->from('soal_parent');

        $soal = $soal->where('soal_parent_tahunajaran',$this->tahunajaran);

        $soal = $soal->where('soal_parent_guru',$this->guru);

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






    function ambildatabyid(){
        $id = $this->input->get('id');
        $users = $this->db->get_where('soal', array('soal_id'=>$id));


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

    function ambildatabyid_pembuat(){
        $id = $this->input->get('id');
        $users = $this->db->get_where('soal_pembuat', array('soal_pembuat_id'=>$id));


        $baris = array();
        foreach ($users->result_array() as $row){

            $baris['soal_pembuat_kelas'] = $row['soal_pembuat_kelas'];
            $baris['soal_pembuat_jurusan'] = $row['soal_pembuat_jurusan'];
            $baris['soal_pembuat_pelajaran'] = $row['soal_pembuat_pelajaran'];
            $baris['soal_pembuat_guru'] = $row['soal_pembuat_guru'];
            $baris['soal_pembuat_untuk'] = $row['soal_pembuat_untuk'];
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }



    function ambildatabyid_parent(){
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



    function simpan(){

        $id 	            = $this->input->post('id');
        $soal_jenis		    = $this->input->post('jenis');
        $soal_parent		= $this->input->post('parent');
        $soal_text		    = $this->input->post('soal_text');

        $soal_text_jawab = "";


        if($soal_jenis == "optional"){
            $soal_text_jawab_optional	= $this->input->post('soal_text_jawab_optional');
            $jawab_optional = array();
            for ($y = 0; $y <= 4; ++$y) {

                $check = 0;
                foreach ($soal_text_jawab_optional as $hobys=>$value) {
                    if($y == $value-1){
                        $check = 1;
                    }
                }

                $jawab_optional[]	= array($check, $this->input->post('soal_text_jawab_optional'.$y));
            }

            $soal_text_jawab = json_encode($jawab_optional);
        }elseif($soal_jenis == "checked"){
            $soal_text_jawab_checked	= $this->input->post('soal_text_jawab_checked');
            $jawab_checked = array();
            for ($x = 0; $x <= 4; ++$x) {

                $check = 0;
                foreach ($soal_text_jawab_checked as $hobys=>$value) {
                    if($x == $value-1){
                        $check = 1;
                    }
                }

                $jawab_checked[] = array($check, $this->input->post('soal_text_jawab_checked' . $x));
            }

            $soal_text_jawab = json_encode($jawab_checked);
        }elseif($soal_jenis == "essay"){
            $soal_text_jawab	= $this->input->post('soal_text_jawab_essay0');
        }


        $tanggal	= date('Y-m-d H:i:s');

        if(empty($soal_text))
        {
            $this->query_error("Pertanyaan Soal Kosong");
        }
        else
        {

            $data = array();
            $data['soal_text'] = $soal_text;
            $data['soal_jenis'] = $soal_jenis;
            $data['soal_parent_id'] = $soal_parent;
            $data['soal_text_jawab'] = $soal_text_jawab;

            /**
            $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
            echo json_encode($data);*/

            if($id > 0){
                $this->db->where('soal_id', $id);
                $master = $this->db->update('soal', $data);
            }else{

                $data['soal_kelas'] = $this->input->post('soal_kelas');
                $data['soal_pelajaran'] = $this->input->post('soal_pelajaran');
                $data['soal_guru'] = $this->guru;
                $data['soal_untuk'] = $this->input->post('soal_untuk');
                $data['soal_date'] = $tanggal;

                $data['soal_tahunajaran'] = $this->tahunajaran;

                $master = $this->db->insert('soal', $data);
                $id = $this->db->insert_id();
            }


            if( $master ){
                $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
                echo json_encode(array('id' => (int) $id,'status' => 1, 'pesan' => "<font color='green'><i class='fa fa-check'></i> Data berhasil disimpan !</font>"));
            }else{
                $this->query_error();
            }
        }

    }

    function simpanparent(){

        $id 	            = $this->input->post('parent_id');
        $parent_kelas       = $this->input->post('parent_kelas');
        $parent_pelajaran   = $this->input->post('parent_pelajaran');
        $soal_parent_text   = $this->input->post('soal_parent_text');


        $tanggal	= date('Y-m-d H:i:s');

        if(empty($parent_pelajaran))
        {
            $this->query_error("Pelajaran Kosong");
        }
        elseif(empty($soal_parent_text))
        {
            $this->query_error("Text Kosong");
        }
        else
        {

            $data = array();
            $data['soal_parent_text'] = $soal_parent_text;

            if($id > 0){
                $this->db->where('soal_parent_id', $id);
                $master = $this->db->update('soal_parent', $data);
            }else{

                $data['soal_parent_pelajaran'] = $parent_pelajaran;
                $data['soal_parent_kelas'] = $parent_kelas;
                $data['soal_parent_guru'] = $this->guru;
                $data['soal_parent_date'] = $tanggal;

                $data['soal_parent_tahunajaran'] = $this->tahunajaran;

                $master = $this->db->insert('soal_parent', $data);
                $id = $this->db->insert_id();
            }


            if( $master ){
                $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
                echo json_encode(array('id' => (int) $id,'status' => 1, 'pesan' => "<font color='green'><i class='fa fa-check'></i> Data berhasil disimpan !</font>"));
            }else{
                $this->query_error();
            }
        }

    }

    function simpan_duplikat(){
        $id 	            = $this->input->get('id');

        if($id > 0){
            $master = $this->db->query("INSERT INTO cbt_soal (
            SELECT  NULL,
            `soal_jenis`,
            `soal_text`,
            `soal_text_deskripsi`,
            `soal_text_jawab`,
            `soal_date`,
            `soal_date_update`,
            `soal_pelajaran`,
            `soal_guru`,
            `soal_untuk`,
            `soal_kelas`,
            `soal_parent_id`,
            `soal_tahunajaran`
            FROM cbt_soal 
            WHERE soal_id = $id )");
            $id = $this->db->insert_id();
        }


        if( $master ){
            $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
            echo json_encode(array('id' => (int) $id,'status' => 1, 'pesan' => "<font color='green'><i class='fa fa-check'></i> Data berhasil disimpan !</font>"));
        }else{
            $this->query_error();
        }

    }

    function simpan_duplikatparent(){
        $id 	            = $this->input->get('id');

        if($id > 0){
            $master = $this->db->query("INSERT INTO cbt_soal_parent (
            SELECT  NULL,
            `soal_parent_text`,
            `soal_parent_pelajaran`,
            `soal_parent_guru`,
            `soal_parent_date`,
            `soal_parent_tahunajaran`
            FROM cbt_soal_parent 
            WHERE soal_parent_id = $id)");
            $id = $this->db->insert_id();
        }


        if( $master ){
            $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
            echo json_encode(array('id' => (int) $id,'status' => 1, 'pesan' => "<font color='green'><i class='fa fa-check'></i> Data berhasil disimpan !</font>"));
        }else{
            $this->query_error();
        }

    }


    function hapus()
    {
        $level = $this->session->userdata('level');
        if($level !== 'guru')
        {
            exit();
        }
        else
        {
            $id = $this->input->get('id');
            $this->db->where(array('soal_id'=>$id, 'soal_guru' => $this->guru));
            $hapus = $this->db->delete('soal');
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


}
?>