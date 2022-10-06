<?php
class Sugest extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Mymodel', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');
        $this->load->helpers('text');


        if ($this->session->userdata('level') != 'admin') {
            redirect('auth/profile');
        }


    }

    function index()
    {

    }

    function kelas(){
        $q = $this->input->get('term');

        $this->db->select("*")->from("siswa");
        $this->db->group_by("siswa_kelas");


        if(!empty($q)){
            $this->db->like('siswa_kelas',$q);
        }
        $this->db->order_by("siswa_kelas","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['label'] = $row->siswa_kelas;

            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function jurusan(){
        $q = $this->input->get('term');

        $this->db->select("*")->from("siswa");
        $this->db->group_by("siswa_jurusan");


        if(!empty($q)){
            $this->db->like('siswa_jurusan',$q);
        }
        $this->db->order_by("siswa_jurusan","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['label'] = $row->siswa_jurusan;

            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function pelajaran(){
        $q = $this->input->get('term');

        $this->db->select("*")->from("soal_pembuat");
        $this->db->group_by("soal_pembuat_pelajaran");


        if(!empty($q)){
            $this->db->like('soal_pembuat_pelajaran',$q);
        }
        $this->db->order_by("soal_pembuat_pelajaran","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['label'] = $row->soal_pembuat_pelajaran;

            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function guru(){
        $q = $this->input->get('term');

        $this->db->select("*")->from("guru");


        if(!empty($q)){
            $this->db->like('guru_nama',$q);
        }
        $this->db->order_by("guru_nama","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['label'] = $row->guru_nama;

            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function untuk(){
        $q = $this->input->get('term');

        $this->db->select("*")->from("soal");
        $this->db->group_by("soal_untuk");


        if(!empty($q)){
            $this->db->like('soal_untuk',$q);
        }
        $this->db->order_by("soal_untuk","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['label'] = $row->soal_untuk;

            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function agama(){
        $q = $this->input->get('term');

        $this->db->select("*")->from("siswa");
        $this->db->group_by("siswa_agama");


        if(!empty($q)){
            $this->db->like('siswa_agama',$q);
        }
        $this->db->order_by("siswa_agama","asc");

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();
            $data['label'] = $row->siswa_agama;

            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }


}
?>