<?php
defined('BASEPATH') or exit();

class Jadwal extends CI_Controller{
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');

        if($this->session->userdata('level') != 'admin'){
            redirect('home');
        }
	}
	
	function index(){
		
		
		$data2['title'] = "Data Jadwal";
		
		$data2['kelas'] = $this->kelas();
		$data2['jurusan'] = $this->jurusan();
		$data2['ruang'] = $this->ruang();
		$data2['pelajaran'] = $this->pelajaran();
		$data2['hari'] = $this->hari();
		$data2['guru'] = $this->guru();
		
        $this->template->load('template','admin/jadwal',$data2);
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
		
		/*
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
		}*/
		$items = array();
		$jurusan = $this->db->select('*')->from('jurusan')->order_by('jurusan_id','asc')->get();
		foreach ($jurusan->result_array() as $row1){
			
			$data['id'] = $row1['jurusan_id'];
			$data['title'] = $row1['jurusan_title'];
				
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
	
	function pelajaran(){
		
		$this->db->select('pelajaran_id,pelajaran_title');
		$this->db->from('pelajaran');
		$this->db->order_by('pelajaran_title','asc');
		$this->db->where('pelajaran_type','materi');
		$pelajaran = $this->db->get();
		
		$items = array();
		foreach ($pelajaran->result_array() as $row1){
			$data['id'] = $row1['pelajaran_id'];
			$data['title'] = strtoupper( $row1['pelajaran_title'] );
				
			array_push($items, $data);
		}
		
		return $items;
		
	}
	
	function hari(){
		
		$this->db->select('hari_id,hari_title');
		$this->db->from('hari');
		$this->db->order_by('hari_id','asc');
		$hari = $this->db->get();
		
		$items = array();
		foreach ($hari->result_array() as $row1){
			$data['id'] = $row1['hari_id'];
			$data['title'] = strtoupper( $row1['hari_title'] );
				
			array_push($items, $data);
		}
		
		return $items;
		
	}
	
	function guru(){
		
		$this->db->select('guru_id,guru_nama');
		$this->db->from('guru');
		$this->db->order_by('guru_nama','asc');
		$guru = $this->db->get();
		
		$items = array();
		foreach ($guru->result_array() as $row1){
			$data['id'] = $row1['guru_id'];
			$data['title'] = strtoupper( $row1['guru_nama'] );
				
			array_push($items, $data);
		}
		
		return $items;
		
	}
	
	function daftarsiswa(){
		$jurusan_id = $this->input->post('jurusan_id');				
		$kelas_sekarang = $this->input->post('kelas_sekarang');		
		$ruang = $this->input->post('ruang');	
		
		$where = array(
			'jurusan_id' => $jurusan_id,
			'kelas_sekarang' => $kelas_sekarang,
			'ruang' => $ruang
		);
		$siswa = $this->db->select('*')->from('siswa')->where($where)->order_by('siswa_nama','asc');
		
		//return $siswa->get()->result();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode( $siswa->get()->result());
	}
	
	function ambiljadwalbyid(){
		$jadwal_id = $this->input->post('jadwal_id');	
		$jadwal = $this->db->select('*')->from('jadwal')->where(array(
			'jadwal_id' => $jadwal_id
		))->get()->result_array();
		
		
		$data_jam = array();
		$data_jam['jadwal_id'] = $jadwal[0]['jadwal_id'];
		$data_jam['ta'] = $jadwal[0]['ta'];
		$data_jam['kelas_sekarang'] = $jadwal[0]['kelas_sekarang'];
		$data_jam['jurusan_id'] = $jadwal[0]['jurusan_id'];
		$data_jam['ruang'] = $jadwal[0]['ruang'];
		$data_jam['pelajaran_id'] = $jadwal[0]['pelajaran_id'];
		$data_jam['jadwal_jam_start'] = $jadwal[0]['jadwal_jam_start'];
		$data_jam['jadwal_jam_end'] = $jadwal[0]['jadwal_jam_end'];
		$data_jam['hari_id'] = $jadwal[0]['hari_id'];
		$data_jam['guru_id'] = $jadwal[0]['guru_id'];
		
		//return $siswa->get()->result();
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode( $data_jam );
	}
	
	function getRowsUserDetail($params = array()){
        //$this->db->select('siswa.*,users.jadwal_id,users.display_name,users.picture,users.email,users.oauth_uid AS user_uid');
		//$this->db->join('users', 'siswa.jadwal_id = users.jadwal_id');
		$this->db->select('id,display_name,picture,email,jadwal_id');
        $this->db->from('users');
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }

        //search by terms
        if(!empty($params['searchTerm'])){
			$this->db->or_like(array('display_name' => $params['searchTerm'], 'email' => $params['searchTerm']));
            //$this->db->like('display_name', $params['searchTerm']);
        }
        
        $this->db->order_by('display_name', 'asc');
        
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        //return fetched data
        return $result;
    }

	
	function ajaxPaginationData(){
		
        $this->perPage = 5;
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
        $jurusanBy = $this->input->post('jurusanBy');
	
		
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($jurusanBy)){
            $conditions['search']['jurusanBy'] = $jurusanBy;
        }
        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }
        
		
        //total rows count
        $totalRec = count($this->cobaQuery($conditions));
        
        //pagination configuration
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'pejadwalan/ajaxPaginationData';
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
		$by_hari = $this->db->select('*')->from('jadwal')->group_by('hari_id');
		
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $by_hari = $by_hari->order_by('hari_id',$params['search']['sortBy']);
        }else{
           $by_hari = $by_hari->order_by('hari_id','asc');
        }
		
		if(!empty($params['search']['jurusanBy'])){
			$by_hari = $by_hari->where('jurusan_id',$params['search']['jurusanBy']);
		}
		
		//set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $by_hari = $by_hari->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $by_hari = $by_hari->limit($params['limit']);
        }
		
		$by_hari = $by_hari->get();
		
		$hitung = 0;
		foreach ($by_hari->result_array() as $row1){
			
			$kelas = array();
			$by_kelas = $this->db->select('*')->from('jadwal');		
			
			
			if(!empty($params['search']['jurusanBy'])){
				$where = array(
					'hari_id'=>$row1['hari_id'],
					'jurusan_id'=>$params['search']['jurusanBy']
				);
				$by_kelas = $by_kelas->where($where);
			}else{
				$by_kelas = $by_kelas->where('hari_id',$row1['hari_id']);					
			}

			
			//$by_kelas = $by_kelas->group_by(array('kelas_sekarang','jurusan_id','ruang','pelajaran_id'))->order_by('kelas_sekarang','desc');	
			$by_kelas = $by_kelas->order_by('kelas_sekarang','desc');			
			$by_kelas = $by_kelas->get();
			foreach ($by_kelas->result_array() as $row2){
				
				$jurusan = $this->db->get_where('jurusan',array('jurusan_kode'=>$row2['jurusan_id']))->result();
				$pelajaran = $this->db->get_where('pelajaran',array('pelajaran_id'=>$row2['pelajaran_id']))->result();
				$guru = $this->db->get_where('guru',array('guru_id'=>$row2['guru_id']))->result();
				
				$data_jam = array();
				$data_jam['jadwal_id'] = $row2['jadwal_id'];
				$data_jam['kelas_sekarang'] = $row2['kelas_sekarang'];
				$data_jam['jurusan_id'] = $jurusan[0]->jurusan_id;
				$data_jam['jurusan_title'] = $jurusan[0]->jurusan_title;
				$data_jam['ruang'] = $row2['ruang'];
				$data_jam['pelajaran_id'] = $row2['pelajaran_id'];
				$data_jam['jadwal_jam_start'] = $row2['jadwal_jam_start'];
				$data_jam['jadwal_jam_end'] = $row2['jadwal_jam_end'];
				$data_jam['pelajaran_title'] = $pelajaran[0]->pelajaran_title;
				$data_jam['guru_nama'] = $guru[0]->guru_nama;
				
				array_push($kelas, $data_jam);
			}
			
			$hari = $this->db->get_where('hari',array('hari_id'=>$row2['hari_id']))->result();
			//$data_hari = array();
			
			$data_hari[ 'hari' ] = $row1['hari_id'];
			$data_hari[ 'hari_title' ] = $hari[0]->hari_title;
			$data_hari[ 'hari_data' ] = $kelas;
			
			array_push($data, $data_hari);
			$hitung++;
		}
		
		return $data;
		//$this->output->set_header('Content-Type: application/json; charset=utf-8');
		//echo json_encode($hari);
	}
	
	
	function ambilkelasjurusanruang(){
		$jurusan = $this->db->select('kelas_sekarang,jurusan_id,ruang')->from('siswa')->group_by(array('kelas_sekarang','jurusan_id','ruang'))->order_by('kelas_sekarang','desc')->get();
		
		$data = array();
		foreach ($jurusan->result_array() as $row1){
			$data_item = array();
				
			$data_item['jurusan_id'] = $row1['jurusan_id'];
			$by_jurusan = $this->db->select('jurusan_id,jurusan_title')->from('jurusan')->where('jurusan_id',$row1['jurusan_id'])->limit(1)->get();
			foreach ($by_jurusan->result_array() as $row2){
				$data_item['jurusan_title'] = $row2['jurusan_title'];
			}
			
			$data_item['kelas_sekarang'] = $row1['kelas_sekarang'];
			$data_item['ruang'] = $row1['ruang'];
			array_push($data, $data_item);
		}
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
	}
	
	function ambildatabyid(){
		$id =  $this->input->post('id');
		$where = array(
			'jadwal_id'=>$id
		);
		
		$data_siswa = $this->m->ambilbyid($where,'siswa')->result();
		$data_user = $this->m->ambilbyid(array('jadwal_id'=>$id),'users');
		
		
		
		$data = array();
		$data['jadwal_id'] =  $data_siswa[0]->jadwal_id;
		$data['jadwal_nama'] =  $data_siswa[0]->jadwal_nama;
		$data['jadwal_jk'] =  $data_siswa[0]->jadwal_jk;
		$data['jadwal_nis'] =  $data_siswa[0]->jadwal_nis;
		
		$data['display_name'] =  '';
		$data['email'] =  '';
		$data['picture'] =  '';
		$data['jurusan_id'] =  '';
		$data['ruang'] =  '';
		$data['kelas_kode'] =  '';
		$data['kelas_sekarang'] =  '';
		if($data_user->num_rows() > 0){
			$user = $data_user->result_array();
			
			$data['user_id'] =  $user[0]['id'];
			$data['display_name'] =  $user[0]['display_name'];
			$data['email'] =  $user[0]['email'];
			$data['picture'] =  $user[0]['picture'];
			$data['jurusan_id'] =  $user[0]['jurusan_id'];
			$data['ruang'] =  $user[0]['ruang'];
			$data['kelas_kode'] =  $user[0]['kelas_kode'];
			$data['kelas_sekarang'] =  $user[0]['kelas_sekarang'];
		}
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
	}
	
	function tambahdata(){				
		
		$kelas_sekarang = $this->input->post('kelas_sekarang');
		$jurusan_id = $this->input->post('jurusan_id');
		$ruang = $this->input->post('ruang');
		
		$pelajaran_id = $this->input->post('pelajaran_id');
		$guru_id = $this->input->post('guru_id');
		
		$ta = $this->input->post('ta');
		$hari_id = $this->input->post('hari_id');
		$jam_start = $this->input->post('jam_start');
		$jam_end = $this->input->post('jam_end');
		
		$data = array(
			'kelas_sekarang'=>$kelas_sekarang,
			'jurusan_id'=>$jurusan_id,
			'ruang'=>$ruang,
			'pelajaran_id'=>$pelajaran_id,
			'guru_id'=>$guru_id,
			'ta'=>$ta,
			'hari_id'=>$hari_id,
			'jadwal_jam_start'=>$jam_start,
			'jadwal_jam_end'=>$jam_end
		);	
		
		if($kelas_sekarang == '') $result['pesan'] = "Kelas kosong!";	
		elseif($jurusan_id == '') $result['pesan'] = "Jurusan Id kosong!";
		elseif($ruang == '') $result['pesan'] = "Ruang kosong!";
		else{
			$result['pesan'] = "";	
			$this->db->insert('jadwal',$data);
		}
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}
	
	function simpandata(){			
		
		$jadwal_id = $this->input->post('jadwal_id');
		$kelas_sekarang = $this->input->post('kelas_sekarang');
		$jurusan_id = $this->input->post('jurusan_id');
		$ruang = $this->input->post('ruang');
		
		$pelajaran_id = $this->input->post('pelajaran_id');
		$guru_id = $this->input->post('guru_id');
		
		$ta = $this->input->post('ta');
		$hari_id = $this->input->post('hari_id');
		$jam_start = $this->input->post('jam_start');
		$jam_end = $this->input->post('jam_end');
		
		$data = array(
			'kelas_sekarang'=>$kelas_sekarang,
			'jurusan_id'=>$jurusan_id,
			'ruang'=>$ruang,
			'pelajaran_id'=>$pelajaran_id,
			'guru_id'=>$guru_id,
			'ta'=>$ta,
			'hari_id'=>$hari_id,
			'jadwal_jam_start'=>$jam_start,
			'jadwal_jam_end'=>$jam_end,
		);	
		
		if($kelas_sekarang == '') $result['pesan'] = "Kelas kosong!";	
		elseif($jurusan_id == '') $result['pesan'] = "Jurusan Id kosong!";
		elseif($ruang == '') $result['pesan'] = "Ruang kosong!";
		else{
			$result['pesan'] = "";	
			$this->db->where(array('jadwal_id'=>$jadwal_id));
			$this->db->update('jadwal',$data);	
		}	
				
	}
	
	
	
	function hapusdata(){			
		
		$jadwal_id = $this->input->post('jadwal_id');
		
		$this->db->where( array(
			'jadwal_id'=>$jadwal_id
		));
		$this->db->delete('jadwal');	
	}


    function resetdata(){
        /*$this->db->where( array(
            'pengaturan_key'=>$this->pengaturan_key
        ));
        $this->db->delete('soal');*/

        $this->db->truncate('jadwal');
    }
	
	
}
?>