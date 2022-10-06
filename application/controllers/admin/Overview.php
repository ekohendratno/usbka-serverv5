<?php  
class Overview extends CI_Controller{


    function __construct(){
        parent::__construct();
        $this->load->model('Mymodel','m');

        if($this->session->userdata('level') != 'admin'){
            redirect('home');
        }


    }

    function index(){
		$data['title'] = 'Overview';

        $peserta = $this->db->select('*')->from('peserta');
        $peserta = $peserta->get();

        $data['jumlah_peserta'] = $peserta->num_rows();
        $data['jumlah_jurusan'] = 0;//$jurusan->num_rows();
        $data['jumlah_pelajaran'] = 0;//$this->pelajaran_jumlah();
        $data['jumlah_pengajar'] = 0;//$guru->num_rows();
        $this->template->load('template','admin/overview',$data);

    }


    function pelajaran_jumlah(){

        $pengajar = $this->db->get_where('pengajar',null)->result();

        $jumlah = 0;
        $pengajaran = array();
        foreach($pengajar as $b){
            $pelajaran = $this->db->get_where( 'pelajaran', array(
                'pelajaran_id'=> $b->pelajaran_id,
                'pelajaran_type'=> 'materi',
                'pengaturan_key'=>$this->pengaturan_key
            ) )->result();

            foreach($pelajaran as $c){
                $jumlah++;
            }
        }

        return $jumlah;
    }
}
?>