<?php

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
		
		$this->load->model('Mymodel','m');		
		$this->load->library('upload');
        $this->load->library('user_agent');

        $this->level = $this->session->userdata('level');
		
    }

    function index(){


        //if ($this->agent->is_mobile()){
            //redirect('auth/mobile');
        //}

		if ( $this->level == 'superadmin' ) redirect('superadmin/dashboard');
		elseif ( $this->level == 'admin' ) redirect('admin/dashboard');
        elseif( $this->level == 'siswa' ) redirect('siswa/dashboard');
		else $this->load->view('auth/login');
		
    }

    function client(){
        if (!$this->agent->is_mobile('android')){
            //redirect();
        }

        $lock_client = $this->m->getpengaturan("lock_client");
        if($lock_client == "y"){
            redirect('home');
        }


        if( $this->level == 'admin' ) redirect('admin/dashboard');
        elseif( $this->level == 'pengawas' ) redirect('pengawas/dashboard');
        elseif( $this->level == 'siswa' ) redirect('siswa/dashboard');
        else $this->load->view('auth/login_client');

    }
	
	function profile(){		
		
		if(!$this->session->userdata('level')){
			redirect('auth');
		}
		
		$users_data = $this->session->userdata();
		
		$this->load->view('auth/profile',$users_data);
	}
	
	function sandi(){		
		
		if(!$this->session->userdata('level')){
			redirect('auth');
		}

		
		$users_data = $this->session->userdata();
		$users_data = $this->_getUsersDetail($users_data);
		
		$this->load->view('auth/sandi',$users_data);
	}


    function signin_auto(){
        $level = $this->input->get('level');
        $key = $this->input->get('key'); //md5
    }

	function signin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
			
		$data = array();
		if(empty($username) || empty($password)){
			$data['pesan'] = '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Username dan Password kosong!</div>';
			$data['redirect'] = null;
		}else{

            $users = $this->db->get_where('users',array('username'=>$username,'password'=>$password))->row_array();

            if ( !empty($users) && $users['level'] == 'admin' ) {

                $userdata = array();
                $userdata['uid']    = $users['user_id'];
                $userdata['username']   = $users['username'];
                $userdata['password']   = $users['password'];
                $userdata['nama']       = $users['username'];
                $userdata['foto']       = base_url('assets/images/avatar.png');
                $userdata['level']      = "admin";

                $this->session->set_userdata($userdata);


                $data['pesan'] = '';
                $data['redirect'] = 'admin/dashboard';
            }else{
                $guru = $this->db->get_where('guru',array('guru_username'=>$username,'guru_password'=>$password))->row_array();
                if ( !empty($guru) ) {

                    $userdata = array();
                    $userdata['uid']        = $guru['guru_id'];
                    $userdata['username']   = $guru['guru_username'];
                    $userdata['password']   = $guru['guru_password'];
                    $userdata['nama']       = $guru['guru_nama'];
                    $userdata['foto']       = base_url('assets/images/avatar.png');
                    $userdata['level']      = "guru";

                    $this->session->set_userdata($userdata);


                    $data['pesan'] = '';
                    $data['redirect'] = 'guru/dashboard';

                }else{
                    $data['pesan'] = '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Username dan Password tidak sesuai!</div>';
                    //$data['redirect'] = 'auth';
                }
            }



		}

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
		echo json_encode($data);
		
	}

    function signinclient(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = array();
        if(empty($username) || empty($password)){
            $data['pesan'] = '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Username dan Password kosong!</div>';
            $data['redirect'] = null;
        }else{

            $query = $this->db->get_where("peserta",array('peserta_username' => $username,'peserta_password' => $password));
            $users_data = $this->_getUsersDetail($query->row_array());


            //update time
            $now = date('Y-m-d H:i:s');

            $this->db->where('peserta_id',$users_data['uid']);
            $this->db->update('peserta',array('peserta_last_active' => $now));
            //$this->m->simpanbyid($data,$where,'users');


            if ( $users_data['uid'] ) {
                $this->session->set_userdata($users_data);
                $data['pesan'] = '';
                $data['redirect'] = 'siswa/dashboard';
            }else{
                $data['pesan'] = '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Username dan Password tidak sesuai!</div>';
                $data['redirect'] = 'auth/client';
            }

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);

    }

    function logout() {
        $is = $this->session->userdata('level');
        if( $is == 'siswa' or $is == 'pengawas' ){
            $this->session->sess_destroy();
            redirect('auth/client');
        }else{
            $this->session->sess_destroy();
            redirect('');
        }
    }

	function _getUsersDetail($users){
		$baris = array();
		$baris['uid'] = $users['peserta_id'];
		$baris['username'] = $users['peserta_username'];
		$baris['password'] = $users['peserta_password'];
		$baris['level'] = "siswa";
		$baris['last_active'] = $users['peserta_last_active'];
        $baris['lock_ujian'] = $this->m->getpengaturan('lock_ujian');
        $baris['foto'] = base_url('assets/images/avatar.png');
        $baris['nomorinduk'] = $users['peserta_nis'];
        $baris['nama'] = $users['peserta_nama'];
        $baris['jk'] = $users['peserta_jk'];
        $baris['agama'] = $users['peserta_agama'];
        $baris['kelas'] = $users['peserta_kelas'];
        $baris['jurusan'] = $users['peserta_jurusan'];
        $baris['jurusan_ke'] = $users['peserta_jurusan_ke'];
			
		
		return $baris;
	}
	
	function do_upload(){
        $config['upload_path'] = './uploads/users/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

		$config['file_name'] = $this->session->userdata('user_id');
		$config['overwrite'] = true;
		$config['max_size'] = 1024; // 1MB
 
		$hasil['pesan'] = 'Tidak dapat diupload , ukuran file lebih dari 1MB atau tipe file bukan jpg atau png';
        $this->upload->initialize($config);
        if(!empty($_FILES['file']['name'])){
 
            if ($this->upload->do_upload('file')){




                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./uploads/users/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '90%';
                $config['width']= 400;
                $config['height']= 400;
                $config['new_image']= './uploads/users/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->crop();



                $this->simpan_upload( $gbr['file_name'] );

                $fileimage = base_url('thumb.php?size=70x70&src=./assets/img/avatar.png');

                if( !empty($gbr['file_name']) ){
                    $fileimage = base_url('thumb.php?size=70x70&src=./uploads/users/' . $gbr['file_name']);
                }


                $this->session->set_userdata(array('foto' => $fileimage));

                $hasil['pesan'] = "Image berhasil diupload";
                $hasil['ok'] = 1;
            }
                      
        }else{
            $hasil['pesan'] = "Image yang diupload kosong";
			$hasil['ok'] = 0;
        }
 
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($hasil);	
     }
	
	function simpan_upload($image){
        $level = $this->session->userdata('level');

        if( $level == 'siswa' ){


            $siswa_id = $this->session->userdata('siswa_id');

            $where = array( 'siswa_id' => $siswa_id );
            $data = array( 'siswa_foto' => $image );

            $this->db->where($where);
            $this->db->update('siswa',$data);

        }

    }
}