<?php  
class Dashboard extends CI_Controller{
    
    
	function __construct(){
		parent::__construct();
        $this->load->model('Mymodel','m');

        if($this->session->userdata('level') != 'pengawas'){
			redirect('auth/profile');
		}


        $this->user_id = $this->session->userdata('user_id');
		
	}
	
    function index(){
		
		$data['title'] = 'Dashboard Pengawas';
		
        $this->template->load('template','pengawas/dashboard',$data);
    }


    function timeline(){

        $data = array();
        $pesan = $this->db->select('*')->from('pesan');

        $pesan = $pesan->where("pesan_untuk","pengawas");
        $pesan = $pesan->or_where("pesan_untuk","semua");

        $pesan = $pesan->order_by('pesan_tanggal','desc');

        $pesan = $pesan->get();

        foreach ($pesan->result_array() as $row1){


            $item = array();
            $item[ 'pesan_id' ] = $row1['pesan_id'];
            $item[ 'pesan_aksi' ] = $row1['pesan_aksi'];
            $item[ 'pesan_text' ] = $row1['pesan_text'];
            $item[ 'pesan_tanggal' ] = $row1['pesan_tanggal'];
            $item[ 'pesan_untuk' ] = $row1['pesan_untuk'];

            $item[ 'username' ] = '';
            $user = $this->db->get_where('users',array(
                'user_id'=>$row1['user_id']
            ))->result();
            $item['username'] =  $user[0]->username;

            array_push($data, $item);
        }

        $item = array();
        $item[ 'pesan_id' ] = 0;
        $item[ 'pesan_aksi' ] = 'pesan';
        $item[ 'pesan_untuk' ] = 'semua';
        $item[ 'pesan_text' ] = '<p>Selamat Datang di USBKA - Aplikasi Ujian Berbasis Komputer Android</p>';
        $item[ 'pesan_tanggal' ] = '';
        $item[ 'username' ] = 'system';

        array_push($data, $item);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

	
}
?>