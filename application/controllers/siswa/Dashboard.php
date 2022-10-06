<?php  
class Dashboard extends CI_Controller{
    
    
	function __construct(){
		parent::__construct();

        $this->load->model('Mymodel','m');
		if($this->session->userdata('level') != 'siswa'){
			redirect('auth/profile');
		}

		
		$this->user_id = $this->session->userdata('user_id');
		$this->siswa_id = $this->session->userdata('id');
		$this->kelas_sekarang = $this->session->userdata('kelas');
		$this->jurusan_id = $this->session->userdata('jurusan');
		$this->ruang = $this->session->userdata('jurusan_ke');

        $this->tahunajaran = $this->m->tahunajaran();

	}
	
    function index(){


		$data['title'] = 'Dashboard';
        $data['jumlahruangan'] = $this->m->getpengaturan('jumlahruangan');
        $data['welcome_message'] = $this->m->getpengaturan('welcome_message');
        $data['ruangan'] =  $this->session->userdata('ruangan');
        $data["tahunajaran"] = $this->tahunajaran;

        $data["jumlah_dikerjakan"] = $this->_jumlah_dikerjakan($this->siswa_id);
        $data["jumlah_pelajaran"] = $this->_jumlah_pelajaran();
        $data["jumlah_siswa"] = $this->_jumlah_siswa();
        $data["jumlah_jurusan"] = $this->_jumlah_jurusan();
		
        $this->template->load('template_siswa','siswa/dashboard',$data);
    }
	
	function timeline(){
		
		$data = array();
		$pesan = $this->db->select('*')->from('pesan');
        $pesan = $pesan->where("(pesan_untuk='siswa' OR pesan_untuk='semua')");
		$pesan = $pesan->order_by('pesan_tanggal','desc');
		$pesan = $pesan->get();
		
		foreach ($pesan->result_array() as $row1){
			
			
			$item[ 'pesan_id' ] = $row1['pesan_id'];
			$item[ 'pesan_aksi' ] = $row1['pesan_aksi'];
			$item[ 'pesan_text' ] = $row1['pesan_text'];
            $item[ 'pesan_tanggal' ] = $this->m->tanggalhari( $row1['pesan_tanggal'],true );
			$item[ 'pesan_untuk' ] = $row1['pesan_untuk'];
			
			$item[ 'username' ] = '';
			$user = $this->db->get_where('users',array(
				'user_id'=>$row1['user_id']
			))->result();
			$item['username'] =  $user[0]->username;
			
			array_push($data, $item);
		}
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);	
	}
	
	function getwelcome(){

		$welcome = $this->db->get_where('pengaturan',array(
            'user_id'=>$this->user_id,
            'pengaturan_name'=>'welcome'
        ))->result();

        $data['pengaturan_value'] = 0;
		foreach ($welcome as $item){
		    $data['pengaturan_value'] = $item['pengaturan_value'];
        }
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);	
	}
	
	function hapuswelcome(){
		$where = array(
			'user_id'=>$this->user_id,
			'pengaturan_name'=>'welcome'
		);
		$a = array(
			'pengaturan_value'=>1
		);		
			
		$is = $this->db->get_where('pengaturan',$where)->result();
			
		if( count($is) > 0){
			
			$this->db->where($where);
			$this->db->update('pengaturan',(array)$a);		
				
		}else{
			$x = array(
				'user_id'=>$this->user_id,
				'pengaturan_name'=>'welcome',
				'pengaturan_value'=>1
			);
			$this->db->insert('pengaturan',$x);
		}
	}

	function simpanruangan(){
        $ruangan = $this->input->post("ruangan");
        $baris = array();
        $baris["ruangan"] = $ruangan;

        $this->session->set_userdata($baris);

        $data['success'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }



    function _jumlah_siswa(){
        return 0;
    }

    function _jumlah_jurusan(){
        return 0;
    }

    function _jumlah_pelajaran(){
        return 0;
    }

    function _jumlah_dikerjakan($id){
        $this->db->select('*')->from('soal_jawab');
        $this->db->where('soal_jawab_tahunajaran',$this->tahunajaran);
        $this->db->where('soal_jawab_status','N');
        $this->db->where("siswa_id = $id");

        return $this->db->get()->num_rows();
    }
}
?>