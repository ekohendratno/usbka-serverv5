<?php  
class Pesan extends CI_Controller{
    
    
	function __construct(){
		parent::__construct();

        $this->load->model('Mymodel','m');

		if($this->session->userdata('level') != 'guru'){
			redirect('auth/profile');
		}
		
		$this->user_id = $this->session->userdata('user_id');
	}
	
    function index(){
		
		$siswa = $this->db->select('*')->from('siswa')->get();
		$guru = $this->db->select('*')->from('guru')->get();
		$jurusan = $this->db->select('*')->from('jurusan')->get();
		
		$data['title'] = 'Dashboard';
		$data['jumlah_siswa'] = $siswa->num_rows();
		$data['jumlah_guru'] = $guru->num_rows();
		$data['jumlah_jurusan'] = $jurusan->num_rows();
		$data['kelas'] = $this->kelas();
		$data['jurusan'] = $this->jurusan();
		$data['ruang'] = $this->ruang();
		
        $this->template->load('template','guru/pesan',$data);
    }
	
	
	function kelas(){
		
		$this->db->select('kelas_sekarang');
		$this->db->from('siswa');
		$this->db->group_by('kelas_sekarang');
		$this->db->order_by('kelas_sekarang','asc');
		$siswa = $this->db->get();
		
		$items = array();
				
		foreach ($siswa->result_array() as $row1){
			$data['id'] = $row1['kelas_sekarang'];
			$data['title'] = strtoupper( $row1['kelas_sekarang'] );
				
			array_push($items, $data);
		}
		
		return $items;
	}
	
	function jurusan(){
		
		$this->db->select('jurusan_id');
		$this->db->from('siswa');
		$this->db->group_by('jurusan_id');
		$this->db->order_by('jurusan_id','asc');
		$siswa = $this->db->get();
		
		$items = array();
		foreach ($siswa->result_array() as $row1){
			$jurusan = $this->db->get_where('jurusan',array('jurusan_kode'=>$row1['jurusan_id']))->result();
			
			$data['id'] = $row1['jurusan_id'];
			$data['title'] = $jurusan[0]->jurusan_title;
				
			array_push($items, $data);
		}
		
		return $items;
		
	}
	
	function ruang(){
		
		$this->db->select('ruang');
		$this->db->from('siswa');
		$this->db->group_by('ruang');
		$this->db->order_by('ruang','asc');
		$siswa = $this->db->get();
		
		$items = array();
		foreach ($siswa->result_array() as $row1){
			$data['id'] = $row1['ruang'];
			$data['title'] = strtoupper( $row1['ruang'] );
				
			array_push($items, $data);
		}
		
		return $items;
		
	}
	
	function timeline(){
		
		$data = array();
		$pesan = $this->db->select('*')->from('pesan');	

		//$pesan = $pesan->where("user_id pesan_untuk='siswa' or pesan_untuk='semua'");

		$pesan = $pesan->where("user_id",$this->user_id);
		$pesan = $pesan->order_by('pesan_tanggal','desc');
		
		$pesan = $pesan->get();
		
		foreach ($pesan->result_array() as $row1){
			
			
			$item[ 'pesan_id' ] = $row1['pesan_id'];
			$item[ 'pesan_aksi' ] = $row1['pesan_aksi'];
			$item[ 'pesan_text' ] = $row1['pesan_text'];
			$item[ 'pesan_tanggal' ] = $row1['pesan_tanggal'];
			
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
	
	function tambahdata(){				
		
		$pesan_text = stripcslashes( trim($this->input->post('pesan_text', TRUE)) );
		
		$kelas_sekarang = $this->input->post('kelas_sekarang');
		$jurusan_id = $this->input->post('jurusan_id');
		$ruang = $this->input->post('ruang');
		
		$pesan_tanggal = date('Y-m-d H:i:s');
		
		//$ta = $this->input->post('ta');
		
		$data = array(
			'pesan_aksi'=>'pesan',
			'pesan_untuk'=>'siswa',
			'pesan_text'=>$pesan_text,
			'pesan_tanggal'=>$pesan_tanggal,
			'user_id'=>$this->user_id,
			'kelas_sekarang'=>$kelas_sekarang,
			'jurusan_id'=>$jurusan_id,
			'ruang'=>$ruang
		);	
		
		if($pesan_text== '') $result['pesan'] = "Pesan kosong!";
		else{
			$result['pesan'] = "";	
			$this->db->insert('pesan',$data);
			$id = $this->db->insert_id();
			$result['id'] = $id;
		}
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}
	
	function hapusdatabyid(){			
		
		$pesan_id = $this->input->post('id');
		
		$this->db->where( array(
			'pesan_id'=>$pesan_id,
			'user_id'=>$this->user_id
		));
		$this->db->delete('pesan');	
	}
}
?>