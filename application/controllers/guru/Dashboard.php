<?php  
class Dashboard extends CI_Controller{
    
    
	function __construct(){
		parent::__construct();
        $this->load->model('Mymodel','m');

        if($this->session->userdata('level') != 'guru'){
			redirect('home');
		}

        $this->uid = $this->session->userdata('uid');
        $this->username = $this->session->userdata('username');
        $this->guru = $this->session->userdata('nama');

        $this->tahunajaran = $this->session->userdata('tahunajaran');
		
	}
	
    function index(){
		
		$data['title'] = 'Dashboard Guru';

        $data['jumlah_peserta'] = $this->_jumlah_peserta();
        $data['jumlah_jurusan'] = $this->_jumlah_jurusan();
        $data['jumlah_pelajaran'] = $this->_jumlah_pelajaran();
        $data['jumlah_pengajar'] = $this->_jumlah_pengajar();
        $data['jumlah_soal'] = $this->_jumlah_soal();
        $data['jumlah_ujian'] = $this->_jumlah_ujian();

        $data['welcome_message'] = $this->m->getpengaturan('welcome_message');
        $data["tahunajaran"] = $this->session->userdata('tahunajaran');
        $data["notifikasi_pesan"] = $this->_jumlah_timeline();


		
        $this->template->load('template','guru/dashboard',$data);
    }



    function timeline(){
		
		$data = array();
		$pesan = $this->db->select('*')->from('pesan');	


        $pesan = $pesan->where("(pesan_untuk='guru' OR pesan_untuk='semua')");
		
		$pesan = $pesan->order_by('pesan_tanggal','desc');
		
		$pesan = $pesan->get();
		
		foreach ($pesan->result_array() as $row1){
			
			
			$item = array();
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
	
	function soal_jumlah(){
		$soal = $this->db->select('*')->from('soal');
		$soal = $soal->where('guru_id',$this->guru_id);		
		$soal = $soal->get()->num_rows();
		
		return $soal;
	}

    function _jumlah_timeline(){
        $pesan = $this->db->select('*')->from('pesan');
        $pesan = $pesan->where("(pesan_untuk='guru' OR pesan_untuk='semua')");

        return $pesan->get()->num_rows();
    }



    function getwelcome(){

        $where = array(
            'user_id'=>$this->user_id,
            'pengaturan_name'=>'welcome'
        );
        $data = $this->db->get_where('pengaturan',$where)->result();

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
        $ikut = $this->db->select('*')->from('soal');

        $this->db->where('soal_tahunajaran',$this->tahunajaran);

        $ikut = $ikut->group_by('soal_pelajaran');
        $ikut = $ikut->where('soal_guru',$this->guru);
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_pengajar(){
        $ikut = $this->db->select('*')->from('soal');
        $this->db->where('soal_tahunajaran',$this->tahunajaran);
        $ikut = $ikut->group_by('soal_guru');
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_soal(){
        $ikut = $this->db->select('*')->from('soal');
        $this->db->where('soal_tahunajaran',$this->tahunajaran);
        $ikut = $ikut->where('soal_guru',$this->guru);
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_ujian(){
        $ikut = $this->db->select('*')->from('ujian');
        $this->db->where('ujian_tahunajaran',$this->tahunajaran);
        $ikut = $ikut->where('ujian_guru',$this->guru);
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }
	
}
?>