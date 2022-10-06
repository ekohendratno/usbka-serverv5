<?php
defined('BASEPATH') or exit();

class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Mymodel', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');

        if ($this->session->userdata('level') != 'pengawas') {
            redirect('auth/profile');
        }


        $this->user_id = $this->session->userdata('user_id');
    }

    function index(){

        $data['title'] = 'Dashboard Pengawas - Siswa';

        $this->template->load('template','pengawas/siswa',$data);
    }

    function timeline(){
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');

        $ikut = $this->db->select('*')->from('soal_jawab');
        $ikut = $ikut->where('soal_jawab_tanggal',date('Y-m-d'));
        $ikut = $ikut->where('siswa_id !=0');
        //$ikut = $ikut->group_by('siswa_id');
		$ikut = $ikut->order_by('soal_jawab_last_update','desc');
        $ikut = $ikut->get();


        $data = array();

        foreach ($ikut->result_array() as $row1){

            $item = array();
            $item[ 'soal_jawab_id' ] = $row1['soal_jawab_id'];
            $item[ 'user_id' ] = $row1['user_id'];
            $item[ 'status' ] = "offline";
            $users = $this->db->select('*')->from( 'users');
            $users = $users->where('user_id',$row1['user_id'] );
            $users = $users->where('DATE(last_active)',$curr_date);
            $users = $users->get()->result_array();

            foreach ($users as $us){

                if(strtotime($us['last_active']) > strtotime("-3 second")) { //jika waktu user lebih dari 1menit

                    $item['status'] = "online";
                }
            }


            $item[ 'siswa_id' ] = $row1['siswa_id'];
            $item[ 'siswa_nama' ] = "Unknown";
            $siswa = $this->db->get_where( 'siswa', array('siswa_id'=>$row1['siswa_id']) )->result_array();
            foreach ($siswa as $s){
                $item[ 'siswa_nama' ] = $s['siswa_nama'];
            }

            $item[ 'soal_jawab_status' ] = $row1['status'];


            $item[ 'soal_jawab_jam_mulai' ] = $row1['soal_jawab_jam_mulai'];
            $item[ 'soal_jawab_mulai' ] = $row1['soal_jawab_mulai'];
            $item[ 'soal_jawab_selesai' ] = $row1['soal_jawab_selesai'];


            $item[ 'ujian_id' ] = $row1['ujian_id'];
            $item[ 'soal_jawab_pelajaran' ] = $row1['soal_jawab_pelajaran'];
            $item[ 'soal_jawab_kelas' ] = $row1['soal_jawab_kelas'];
            $item[ 'soal_jawab_jurusan' ] = $row1['soal_jawab_jurusan'];
            $item[ 'soal_jawab_jurusan_ke' ] = $row1['soal_jawab_jurusan_ke'];

			
			$item[ 'soal_jawab_selesai' ] = $row1['soal_jawab_selesai'];
			$item[ 'selesai' ] = 0;
			if( $row1['status'] == "N" && $row1['soal_jawab_selesai'] != "0000-00-00 00:00:00" && strtotime($row1['soal_jawab_selesai']) < strtotime("-900 second")) {
				//jika lebih dari 600 detik atau 30 menit
				$item[ 'selesai' ] = 1;
			}
			$item[ 'last_update' ] = $row1['soal_jawab_last_update'];
            $item[ 'last_update_title' ] = $this->waktu_lalu( $row1['soal_jawab_last_update'] );

            array_push($data, $item);

        }
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function selesaisekarang(){

        $id = $this->input->post('id');

        $soal_jawab = $this->db->select('*')->from('soal_jawab')->where(array(
            'soal_jawab_id'=> $id
        ));

        $soal_jawab = $soal_jawab->get();
        $soal_jawab = $soal_jawab->result_array();
        //$pc_jawaban = explode(",", $soal_jawab[0]['soal_jawab_list_opsi']);
        $pc_jawaban = json_decode( $soal_jawab[0]['soal_jawab_list_opsi'] );

        $jumlah_benar 	= 0;
        $jumlah_salah 	= 0;
        $jumlah_ragu  	= 0;
        $nilai_bobot 	= 0;
        $total_bobot	= 0;
        //$jumlah_soal	= 0;
        $jumlah_soal = $soal_jawab[0]['ujian_jumlah_soal'];
        $total_soal = 0;
        $jumlah_none	= 0;

        foreach ($pc_jawaban as $val) {
            //$pc_ret_urn = explode(":", $value);

            $id_soal 	= $val[0];
            $jenis 		= $val[1];
            $ragu 		= $val[2];
            $jawaban 	= $val[3];

            if( $jenis == 'ganda' ){

                $ambil_soal = $this->db->get_where('soal',array('soal_id' => $id_soal))->result();
                if($ambil_soal[0]->soal_text_jawab == $jawaban ){
                    $jumlah_benar++;
                }else{
                    $jumlah_salah++;
                }
                //$jumlah_soal++;
                $total_soal++;

            }

        }


        $jumlah_nilai = ($jumlah_benar / $jumlah_soal)  * 100;

        $jumlah_none = $jumlah_soal-$total_soal;


        $this->db->where(array(
            'soal_jawab_id'=> $id
        ));
        $this->db->update('soal_jawab',array(
            'soal_jawab_benar' => $jumlah_benar,
            'soal_jawab_salah' => $jumlah_salah,
            'soal_jawab_nilai' => $jumlah_nilai,
            'soal_jawab_ok' => $total_soal,
            'soal_jawab_none' => $jumlah_none,
            //'jumlah_soal' => $jumlah_soal,
            'soal_jawab_selesai' => date('Y-m-d H:i:s'),
            'soal_jawab_last_update' => date('Y-m-d H:i:s'),
            'soal_jawab_status' => 'N'
        ));
    }

    /**
    function timeline(){

        $data = array();
        $q1= $this->db->select('*')->from('users');

        $q1 = $q1->where(array(
            'level' => 'siswa',
            'pengaturan_key'=>$this->pengaturan_key
        ));

        $q1 = $q1->where('DATE(last_active)',date('Y-m-d'));

        $q1 = $q1->order_by('last_active','desc');
        //$q1 = $q1->limit(20);
        $q1 = $q1->get();

        foreach ($q1->result_array() as $row1){

            $item = array();
            $item[ 'user_id' ] = $row1['user_id'];

            $status = "offline";
            if(strtotime($row1['last_active']) > strtotime("-3 second")) { //jika waktu user kurang dari 1menit
                $status = "online";
            }

            $item['status'] = $status;


            $item[ 'last_active' ] = $row1['last_active'];
            $item[ 'last_active_title' ] = $this->waktu_lalu( $row1['last_active'] );

            $siswa = $this->db->get_where( 'siswa', array('siswa_id'=>$row1['siswa_id']) )->result();
            foreach ($siswa as $a){
                $item['siswa_nama'] = $a->siswa_nama;

                $item['kelas_sekarang'] = $a->kelas_sekarang;
                $item['jurusan_kode'] = $a->jurusan_id;

                $jurusan = $this->db->get_where( 'jurusan', array('jurusan_kode'=>$a->jurusan_id) )->result();
                foreach ($jurusan as $b){
                    $item['jurusan_kode'] = $b->jurusan_kode;
                }

                $item['ruang'] = $a->ruang;
            }

            array_push($data, $item);
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }*/

    function waktu_lalu($timestamp){
        $selisih = time() - strtotime($timestamp) ;
        $detik = $selisih ;
        $menit = round($selisih / 60 );
        $jam = round($selisih / 3600 );
        $hari = round($selisih / 86400 );
        $minggu = round($selisih / 604800 );
        $bulan = round($selisih / 2419200 );
        $tahun = round($selisih / 29030400 );
        if ($detik <= 60) {
            $waktu = $detik.' detik yang lalu';
        } else if ($menit <= 60) {
            $waktu = $menit.' menit yang lalu';
        } else if ($jam <= 24) {
            $waktu = $jam.' jam yang lalu';
        } else if ($hari <= 7) {
            $waktu = $hari.' hari yang lalu';
        } else if ($minggu <= 4) {
            $waktu = $minggu.' minggu yang lalu';
        } else if ($bulan <= 12) {
            $waktu = $bulan.' bulan yang lalu';
        } else {
            $waktu = $tahun.' tahun yang lalu';
        }
        return $waktu;
    }

}

?>