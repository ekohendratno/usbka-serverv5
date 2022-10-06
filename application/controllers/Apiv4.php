<?php
class Apiv4 extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('MyFungsi','m');
        $this->load->helpers('form');
        $this->load->helpers('url');

    }

    function index()
    {
        $data = array();
        $data['response'] = 'Parameter Failed!';
        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }



    function signin(){
        $username = $this->input->get('u');
        $password = $this->input->get('p');

        $response = array();
        if(empty($username) || empty($password)){
            $response["success"] = false;
            $response["response"] = "Username atau Password kosong!";
        }else{

            $peserta = $this->db->get_where('peserta',array('peserta_username'=>$username,'peserta_password'=>$password))->row_array();
            if ( !empty($peserta) ) {

                $userdata = array();
                $userdata['uid']        = $peserta['peserta_id'];
                $userdata['nama']       = $peserta['peserta_nama'];

                $userdata['foto'] = $this->config->item('base_url') . '/assets/img/avatar.png';
                if( !empty($peserta['peserta_foto']) && file_exists(FCPATH . 'uploads/peserta/' .$peserta['peserta_foto']) ) {
                    $userdata['foto'] = $this->config->item('base_url') . '/thumb.php?size=200x300&src=./uploads/peserta/' . $peserta['peserta_foto'];
                }

                $userdata['level']      = "peserta";
                $userdata['jk']         = $peserta['peserta_jk'];
                $userdata['nis']  		= $peserta['peserta_nis'];
                $userdata['agama']  	= ucfirst($peserta['peserta_agama']);
                $userdata['kelas']  	= $peserta['peserta_kelas'];
                $userdata['jurusan']  	= $peserta['peserta_jurusan'];
                $userdata['jurusan_ke'] = $peserta['peserta_jurusan_ke'];


                $response["success"] = true;
                $response["response"] = $userdata;

            }else{

                $users = $this->db->get_where('users',array('username'=>$username,'password'=>$password))->row_array();

                if ( !empty($users) && $users['level'] == 'pengawas' ) {

                    $userdata = array();
                    $userdata['uid']    = $users['user_id'];
                    $userdata['nama']       = $users['username'];
                    $userdata['foto']       = base_url('assets/images/avatar.png');
                    $userdata['level']      = "pengawas";

                    $response["success"] = true;
                    $response["response"] = $userdata;
                }else{
                    $response["success"] = false;
                    $response["response"] = "Username atau Password tidak sesuai!";

                }

            }




        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);

    }



    function dashboard(){

        $nis     = $this->input->get('nis');

        $response = array();
        $response["response"] = array();

        $peserta = $this->db->get_where('peserta',array("peserta_nis" => $nis));


        if($peserta->num_rows() > 0) {

            foreach ($peserta->result_array() as $r2) {

                $peserta_id = $r2['peserta_id'];
                $peserta_nis = $r2['peserta_nis'];
                $peserta_nama = $r2['peserta_nama'];
                $peserta_jk = $r2['peserta_jk'];
                $peserta_foto = $r2['peserta_foto'];
                $peserta_agama = $r2['peserta_agama'];
                $kelas_sekarang = $r2['peserta_kelas'];
                $jurusan_id = $r2['peserta_jurusan'];
                $ruang = $r2['peserta_jurusan_ke'];


                $item = array();

                $item["jumlah_dikerjakan"] = $this->_jumlah_dikerjakan($peserta_id);
                $item["jumlah_pelajaran"] = $this->_jumlah_pelajaran($kelas_sekarang,$jurusan_id,$ruang);
                $item["jumlah_peserta"] = $this->_jumlah_peserta();
                $item["jumlah_jurusan"] = $this->_jumlah_jurusan();
                $item["instansi"] = $this->m->getpengaturan("instansi");

                $response["response"] = $item;

            }

            $response["success"] = true;
        }else{
            $response["success"] = false;
            $response["response"] = "Tidak ditemukan data";
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
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

    function _jumlah_pelajaran($kelas_sekarang,$jurusan_id,$ruang){
        $ikut = $this->db->select('*')->from('soal_pembuat');
        //$ikut = $ikut->group_by('soal_pembuat_pelajaran');
        $ikut = $ikut->where('(soal_pembuat_kelas=\'\' OR soal_pembuat_kelas=\''.$kelas_sekarang.'\')');
        $ikut = $ikut->where('(soal_pembuat_jurusan=\'\' OR soal_pembuat_jurusan=\''.$jurusan_id.'\')');
        //$ikut = $ikut->where('(soal_pembuat_jurusan_ke=\'\' OR soal_pembuat_jurusan_ke=\''.$ruang.'\')');

        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

    function _jumlah_dikerjakan($id){
        $ikut = $this->db->select('*')->from('soal_jawab');
        $ikut = $ikut->where('soal_jawab_status','N');
        $ikut = $ikut->where("siswa_id = $id");
        $ikut = $ikut->get();

        return $ikut->num_rows();
    }

}