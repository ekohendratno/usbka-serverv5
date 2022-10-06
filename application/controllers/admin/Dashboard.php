<?php
class Dashboard extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('Mymodel','m');

        if($this->session->userdata('level') != 'admin'){
            redirect('home');
        }



        $this->tahunajaran = $this->session->userdata('tahunajaran');
        $this->kegiatan = $this->session->userdata('kegiatan');

    }

    function index(){
		$data['title'] = 'Dashboard Admin';


        $data['jumlah_peserta'] = $this->_jumlah_peserta();
        $data['jumlah_jurusan'] = $this->_jumlah_jurusan();
        $data['jumlah_pelajaran'] = $this->_jumlah_pelajaran();
        $data['jumlah_koordinator'] = $this->_jumlah_koordinator();
        $data['jumlah_pengajar'] = $this->_jumlah_pengajar();
        $data['jumlah_soal'] = $this->_jumlah_soal();
        $data['jumlah_ujian'] = $this->_jumlah_ujian();
        $data["tahunajaran"] = $this->tahunajaran;
        $data["kegiatan"] = $this->kegiatan;


        $data['lock_ujian'] = $this->m->getpengaturan('lock_ujian');
        $data['lock_client'] = $this->m->getpengaturan('lock_client');
        $data['instansi'] = $this->m->getpengaturan('instansi');
        $data['waktuminimum'] = $this->m->getpengaturan('Waktu Minimal');
        $data['welcome_message'] = $this->m->getpengaturan('welcome_message');
        $data['waktutoken'] = $this->m->getpengaturan('pengaturanToken');

        $this->template->load('template','admin/dashboard',$data);
		
		if($this->session->userdata('level') != 'admin'){
			redirect('auth/profile');
		}
    }



    function _jumlah_peserta(){
        $ikut = $this->db->select('*')->from('peserta');
        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function _jumlah_jurusan(){
        $ikut = $this->db->select('*')->from('peserta');
        $ikut = $ikut->group_by('peserta_jurusan');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_pelajaran(){
        $this->db->select('*')->from('soal');

        $this->db->where('soal_tahunajaran',$this->tahunajaran);

        if(!empty($this->kegiatan)){
            $this->db->where('soal_untuk',$this->kegiatan);
        }

        $this->db->group_by('soal_pelajaran');
        $this->db->group_by('soal_kelas');
        $this->db->group_by('soal_guru');
        $ikut = $this->db->get();

        return $ikut->num_rows();
    }

    function _jumlah_koordinator(){
        $this->db->select('*')->from('soal');

        $this->db->where('soal_tahunajaran',$this->tahunajaran);
        if(!empty($this->kegiatan)){
            $this->db->where('soal_untuk',$this->kegiatan);
        }

        $this->db->group_by('soal_guru');
        $ikut = $this->db->get();

        return $ikut->num_rows();
    }

    function _jumlah_pengajar(){
        $this->db->select('*')->from('guru');
        $ikut = $this->db->get();

        return $ikut->num_rows();
    }

    function _jumlah_soal(){
        $this->db->select('*')->from('soal');

        $this->db->where('soal_tahunajaran',$this->tahunajaran);
        if(!empty($this->kegiatan)){
            $this->db->where('soal_untuk',$this->kegiatan);
        }
        $ikut = $this->db->get();

        return $ikut->num_rows();
    }

    function _jumlah_ujian(){
        $this->db->select('*')->from('ujian');
        $this->db->where('ujian_tahunajaran',$this->tahunajaran);
        if(!empty($this->kegiatan)){
            $this->db->where('ujian_untuk',$this->kegiatan);
        }
        $ikut = $this->db->get();

        return $ikut->num_rows();
    }
}
?>