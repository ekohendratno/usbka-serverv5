<?php  
class Pesan extends CI_Controller{
    
    
	function __construct(){
		parent::__construct();

        $this->load->model('Mymodel','m');

        if($this->session->userdata('level') != 'admin'){
            redirect('home');
        }

		
		$this->uid = $this->session->userdata('uid');
	}
	
    function index(){
		
		$data['title'] = 'Dashboard';
		$data['jumlah_siswa'] = 0;//$siswa->num_rows();
		$data['jumlah_guru'] = 0;//$guru->num_rows();
		$data['jumlah_jurusan'] = 0;//$jurusan->num_rows();
		$data['kelas'] = 0;//$this->kelas();
		$data['jurusan'] = 0;//$this->jurusan();
		$data['ruang'] = 0;//$this->ruang();
		
        $this->template->load('template','admin/pesan',$data);
    }

	
	function timeline(){
		
		$data = array();
		$pesan = $this->db->select('*')->from('pesan');	

		
		$pesan = $pesan->where("user_id",$this->uid);
		$pesan = $pesan->order_by('pesan_tanggal','desc');
		
		$pesan = $pesan->get();
		
		foreach ($pesan->result_array() as $row1){
			
			
			$item[ 'pesan_id' ] = $row1['pesan_id'];
			$item[ 'pesan_aksi' ] = $row1['pesan_aksi'];
			$item[ 'pesan_text' ] = $row1['pesan_text'];
            $item[ 'pesan_tanggal' ] = $this->m->tanggalhari( $row1['pesan_tanggal'],true );
			$item[ 'pesan_untuk' ] = $row1['pesan_untuk'];
			
			$item[ 'username' ] = '';
			$user = $this->db->get_where('users',array("user_id" => $this->uid))->result();
			$item['username'] =  $user[0]->username;
			
			array_push($data, $item);
		}
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);	
	}
	
	function tambahdata(){				
		
		$pesan_text = stripcslashes( trim($this->input->post('pesan_text', TRUE)) );
		
		$untuk = $this->input->post('untuk');

		
		$pesan_tanggal = date('Y-m-d H:i:s');
		
		//$ta = $this->input->post('ta');
		
		$data = array(
			'pesan_aksi'=>'pesan',
			'pesan_untuk'=>$untuk,
			'pesan_text'=>$pesan_text,
			'pesan_tanggal'=>$pesan_tanggal,
			'user_id'=>$this->uid
		);	
		
		if($pesan_text== '') $result['pesan'] = "Pesan kosong!";
		else{
            
			$result['pesan'] = "";	
			$this->db->insert('pesan',$data);
			$id = $this->db->insert_id();
			$result['id'] = $id;
			
			
			$this->sendPushNotification("appcbt","Informasi terbaru dari system CBT",$pesan_text,$id,"notif");
		}
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}
	
	function hapusdatabyid(){			
		
		$pesan_id = $this->input->post('id');
		
		$this->db->where( array(
			'pesan_id'=>$pesan_id,
			'user_id'=>$this->uid
		));
		$this->db->delete('pesan');	
	}


    function resetdata(){
        /*$this->db->where( array(
            'pengaturan_key'=>$this->pengaturan_key
        ));
        $this->db->delete('soal');*/

        $this->db->truncate('pesan');
    }

    function sendPushNotification($fcm_token, $title, $message, $id = null, $action = null){

        define('API_ACCESS_KEY', 'AAAAJxm6MGM:APA91bFd2G-75dfzfaqHA3rVxeUO5iR34VnvBDwve28xBy7xGBekxRxZOoHLzQ7Y-SsiMvr6KdsSZSdAf0QBKQyhfmtOhOSlmMMvBKhtcxhLE_3aE5Vr6NpQGsT5ARdEZltEs0-RJBac');
        $url = "https://fcm.googleapis.com/fcm/send";
        $header = [
            'authorization: key=' . API_ACCESS_KEY,
            'content-type: application/json'
        ];

        $notification = [
            'title' => $title,
            'body' => $message
        ];
        $extraNotificationData = ["message" => $notification, "id" => $id, 'action' => $action];

        $fcmNotification = [
            'to' => $fcm_token,
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
?>