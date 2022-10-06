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
            redirect('auth');
        }

        $this->uid = $this->session->userdata('uid');
        $this->username = $this->session->userdata('username');
        $this->password = $this->session->userdata('password');
        $this->guru = $this->session->userdata('nama');

    }

    function index(){


        $data2['title'] = "Data Soal";
        $data2['kumpul'] = $this->jumlahJurusanMengumpulSoal();
        $data2['pelajaran'] = $this->_pelajaran();
        $data2['jurusan'] = $this->_jurusan();
        $data2['kelas'] = $this->_kelas();

        $this->template->load('template','guru/soal',$data2);
    }

    function jumlahJurusanMengumpulSoal(){
        $this->db->select("*")->from("soal");
        $this->db->where("soal_guru",$this->guru);
        $this->db->group_by(array("soal_pelajaran"));


        $data = array();
        $data["pelajaranx"] = array();
        $pelajaran_jumlah = 0;
        foreach ( $this->db->get()->result() as $row1){
            $soal = $this->db->get_where("soal",array("soal_guru"=>$this->guru,"soal_pelajaran" => $row1->soal_pelajaran));

            $item = array();
            $item["pelajaran"] = $row1->soal_pelajaran;
            $item["kelas"] = "";

            $jumlah = 0;
            foreach ( $soal->result() as $row2){
                $jumlah++;
            }
            $item["jumlah_kumpul"] = $jumlah;

            array_push($data["pelajaranx"],$item);

            $pelajaran_jumlah++;
        }

        $data["jumlah_pelajaran"] = $pelajaran_jumlah;







        $soal_jumlah = 0;
        foreach ( $this->db->select("*")->from("soal")->where("soal_guru",$this->guru)->get()->result() as $row3){
            $soal_jumlah++;
        }
        $data["soal_jumlah"] = $soal_jumlah;




        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');

        $soal_jumlah_today = 0;

        foreach ( $this->db->select("*")->from("soal")->where("soal_guru",$this->guru)->where('DATE(soal_date)',$curr_date)->get()->result() as $row3){

            $soal_jumlah_today++;
        }
        $data["soal_jumlah_today"] = $soal_jumlah_today;

        $date->modify('-1 day');
        $curr_date = $date->format('Y-m-d');

        $soal_jumlah_tomorrow = 0;
        foreach ( $this->db->select("*")->from("soal")->where("soal_guru",$this->guru)->where('DATE(soal_date)',$curr_date)->get()->result() as $row3){

            $soal_jumlah_tomorrow++;
        }
        $data["soal_jumlah_tomorrow"] = $soal_jumlah_tomorrow;

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }


    function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
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

        $pelajaranBy = $this->input->post('pelajaranBy');
        $keteranganBy = $this->input->post('keteranganBy');


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
        if(!empty($pelajaranBy)){
            $conditions['search']['pelajaranBy'] = $pelajaranBy;
        }
        if(!empty($keteranganBy)){
            $conditions['search']['keteranganBy'] = $keteranganBy;
        }
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQuery($conditions));

        //pagination configuration
        $config['target']      = '#postList tbody';
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

        $data = array();
        $soal = $this->db->select('*')->from('soal_pembuat');
        $soal = $soal->where('soal_pembuat_guru',$this->guru);

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $soal = $soal->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $soal = $soal->limit($params['limit']);
        }

        $soal = $soal->get();

        foreach ($soal->result_array() as $row){

            $baris = array();

            $soal_pembuat_id     = $row['soal_pembuat_id'];
            $soal_pembuat_pelajaran     = $row['soal_pembuat_pelajaran'];
            $soal_pembuat_guru     = $row['soal_pembuat_guru'];
            $soal_pembuat_untuk     = $row['soal_pembuat_untuk'];
            $soal_pembuat_kelas     = $row['soal_pembuat_kelas'];
            $soal_pembuat_jurusan     = $row['soal_pembuat_jurusan'];
            $soal_pembuat_jumlah     = $row['soal_pembuat_jumlah'];
            $soal_pembuat_tanggal     = $row['soal_pembuat_tanggal'];
            $soal_pembuat_tanggal_dikumpulkan     = $row['soal_pembuat_tanggal_dikumpulkan'];

            $baris['soal_pembuat_id']     = $soal_pembuat_id;
            $baris['soal_pembuat_kelas']     = $soal_pembuat_kelas;
            $baris['soal_pembuat_jurusan']     = $soal_pembuat_jurusan;
            $baris['soal_pembuat_pelajaran']     = $soal_pembuat_pelajaran;
            $baris['soal_pembuat_guru']     = $soal_pembuat_guru;
            $baris['soal_pembuat_untuk']     = $soal_pembuat_untuk;
            $baris['soal_pembuat_tanggal']     = $soal_pembuat_tanggal;
            $baris['soal_pembuat_tanggal_dikumpulkan']     = 0;

            $data_soal = $this->db->get_where("soal",array(
                'soal_pelajaran' => $soal_pembuat_pelajaran,
                'soal_guru' => $soal_pembuat_guru,
                'soal_untuk' => $soal_pembuat_untuk
            ));

            $baris['soal_jumlah_terkumpul']     = $data_soal->num_rows();
            $baris['soal_jumlah_terkumpul_total']     = $soal_pembuat_jumlah;


            array_push($data, $baris);
        }

        return $data;
    }




    function ajaxPaginationData1(){

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
        $keywords = $this->input->get('keywords');
        $sortBy = $this->input->get('sortBy');
        $limitBy = $this->input->get('limitBy');

        $idBy = $this->input->get('idBy');


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
        $totalRec = count($this->cobaQuery1($conditions));

        //pagination configuration
        $config['target']      = '#postList1 tbody';
        $config['base_url']    = base_url().'guru/soal/ajaxPaginationData1';
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
        $data['empData'] = $this->cobaQuery1($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function cobaQuery1($params = array()){

        $pelajaran = "";
        if(!empty($params['search']['idBy']) ){
            $soal_pembuat = $this->db->get_where('soal_pembuat', array('soal_pembuat_id'=>$params['search']['idBy']));
            foreach ($soal_pembuat->result_array() as $pembuat){
                $pelajaran = $pembuat['soal_pembuat_pelajaran'];

            }
        }

        $soal = $this->db->select('*')->from('soal');
        $soal = $soal->where('soal_guru',$this->guru);

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $soal = $soal->order_by('soal_date',$params['search']['sortBy']);
        }else{
            $soal = $soal->order_by('soal_date','desc');
        }


        if(!empty($pelajaran)){
            $soal = $soal->where('soal_pelajaran',$pelajaran);
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

        $data = array();
        foreach ($soal->result_array() as $row){
            $baris = array();
            $baris['soal_id'] = $row['soal_id'];
            $baris['soal_jenis'] = $row['soal_jenis'];
            $baris['soal_text'] = word_limiter( strip_tags($row['soal_text']),30);
            $baris['soal_text_deskripsi'] = $row['soal_text_deskripsi'];
            $baris['soal_date']     = $row['soal_date'];
            $baris['soal_pelajaran']     = $row['soal_pelajaran'];
            $baris['soal_date']     = $row['soal_date'];
            $baris['soal_guru']     = $row['soal_guru'];
            $baris['soal_untuk']     = $row['soal_untuk'];
            $baris['soal_parent_id']     = $row['soal_parent_id'];



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
        $keywords = $this->input->post('keywords');

        $idBy = $this->input->post('idBy');


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
        $config['base_url']    = base_url().'guru/soal/ajaxPaginationData2';
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

        $pelajaran = "";
        if(!empty($params['search']['idBy']) ){
            $soal_pembuat = $this->db->get_where('soal_pembuat', array('soal_pembuat_id'=>$params['search']['idBy']));
            foreach ($soal_pembuat->result_array() as $pembuat){
                $pelajaran = $pembuat['soal_pembuat_pelajaran'];

            }
        }

        $soal = $this->db->select('*')->from('soal_parent');
        $soal = $soal->where('soal_parent_guru',$this->guru);

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $soal = $soal->order_by('soal_parent_date',$params['search']['sortBy']);
        }else{
            $soal = $soal->order_by('soal_parent_date','desc');
        }


        if(!empty($pelajaran)){
            $soal = $soal->where('soal_parent_pelajaran',$pelajaran);
        }


        if(!empty($params['search']['keywords'])){
            $soal = $soal->like('soal_parent_text',$params['search']['keywords'], 'both');
        }

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $soal = $soal->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $soal = $soal->limit($params['limit']);
        }

        $soal = $soal->get();

        $data = array();
        foreach ($soal->result_array() as $row){
            //if(!empty($params['search']['idBy']) ) {
                $baris = array();
                $baris['soal_parent_id'] = $row['soal_parent_id'];
                $baris['soal_parent_text'] = word_limiter(strip_tags($row['soal_parent_text']), 30);
                $baris['soal_parent_date'] = $row['soal_parent_date'];
                $baris['soal_parent_pelajaran'] = $row['soal_parent_pelajaran'];
                $baris['soal_parent_guru'] = $row['soal_parent_guru'];


                array_push($data, $baris);
            //}
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
            $baris['soal_pelajaran']     = $row['soal_pelajaran'];
            $baris['soal_date']     = $row['soal_date'];
            $baris['soal_guru']     = $row['soal_guru'];
            $baris['soal_untuk']     = $row['soal_untuk'];
            $baris['soal_parent_id']     = $row['soal_parent_id'];
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }

    function ambildatabyid2(){
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

                $data['soal_pelajaran'] = $this->input->post('soal_pelajaran');
                $data['soal_guru'] = $this->guru;
                $data['soal_untuk'] = $this->input->post('soal_untuk');
                $data['soal_date'] = $tanggal;
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
                $data['soal_parent_guru'] = $this->guru;
                $data['soal_parent_date'] = $tanggal;
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
            `soal_parent_id` 
            FROM cbt_soal 
            WHERE soal_id = $id)");
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
            `soal_parent_date`
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
            $this->db->where('soal_id',$id);
            $this->db->where('soal_guru',$this->guru);
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

    function hapusduplikat()
    {
        $level = $this->session->userdata('level');
        if($level !== 'guru')
        {
            exit();
        }
        else
        {
            $id = $this->input->get('id');
            $this->db->where('soal_parent_id',$id);
            $this->db->where('soal_parent_guru',$this->guru);
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


    function ajaxPaginationDataTugas(){

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


        //total rows count
        $totalRec = sizeof($this->cobaQueryTugas($conditions));

        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'siswa/ujian/ajaxPaginationData';
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
        $data['empData'] = $this->cobaQueryTugas($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    function cobaQueryTugas($params = array()){

        $data = array();
        $ujian = $this->db->select('*')->from('soal_pembuat');
        $ujian = $ujian->where('soal_pembuat_guru',$this->guru);

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $ujian = $ujian->limit($params['limit']);
        }

        $ujian = $ujian->get();

        $hitung = 0;
        foreach ($ujian->result_array() as $row1){


            $data_ujian[ 'soal_pembuat_id' ] = $row1['soal_pembuat_id'];
            $data_ujian[ 'soal_pembuat_pelajaran' ] = $row1['soal_pembuat_pelajaran'];
            $data_ujian[ 'soal_pembuat_guru' ] = $row1['soal_pembuat_guru'];

            $data_ujian[ 'soal_pembuat_kelas' ] = $row1['soal_pembuat_kelas'];
            $data_ujian[ 'soal_pembuat_jurusan' ] = $row1['soal_pembuat_jurusan'];
            $data_ujian[ 'soal_pembuat_jurusan_ke' ] = $row1['soal_pembuat_jurusan_ke'];

            $data_ujian[ 'soal_pembuat_untuk' ] = $row1['soal_pembuat_untuk'];
            $data_ujian[ 'soal_pembuat_jenis' ] = $row1['soal_pembuat_jenis'];

            $jumlah = 0;
            foreach ( $this->db->get_where("soal",array(
                "soal_guru" =>$this->guru,
                "soal_pelajaran" =>$row1['soal_pembuat_pelajaran'],
                "soal_kelas" =>$row1['soal_pembuat_kelas'],
                "soal_jurusan" =>$row1['soal_pembuat_jurusan'],
                "soal_jurusan_ke" =>$row1['soal_pembuat_jurusan_ke'],

                "soal_untuk" =>$row1['soal_pembuat_untuk'],
                "soal_jenis" =>$row1['soal_pembuat_jenis'],
            ))->result() as $soal_item){
                $jumlah++;
            }


            $data_ujian[ 'soal_pembuat_butir' ] = $jumlah;
            $data_ujian[ 'soal_pembuat_jumlah' ] = $row1['soal_pembuat_jumlah'];



            array_push($data, $data_ujian);
        }

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
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

    function _pelajaran(){
        $this->db->select("*")->from("soal_pembuat");
        $this->db->where("soal_pembuat_guru",$this->guru);
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
}
?>