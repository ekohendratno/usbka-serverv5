<?php

class Ta extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Mymodel','m');

        $this->user_id = $this->session->userdata('user_id');
        $this->pengaturan_key = $this->session->userdata('pengaturan_key');
    }

    function index()
    {

        /*
        list ta
        jika ta,semester ada dalam pengaturan, ta_aktif = 1
        */

        $data = array();
        $pengaturan = $this->db->select('*')->from('ta')->where(array(
            'pengaturan_key' => $this->pengaturan_key
        ))->order_by('ta_tahun', 'desc')->get()->result();

        foreach ($pengaturan as $row) {
            $item = array();
            $item['id'] = $row->ta_id;
            $item['tahun'] = $row->ta_tahun;
            $item['semester'] = $row->ta_semester;
            $item['aktif'] = $row->ta_aktif;
            $item['selected'] = 0;


            $query_t = $this->db->get_where('pengaturan', array(
                'pengaturan_name' => 'tahun_ajaran',
                'pengaturan_key' => $this->pengaturan_key,
                'user_id' => $this->user_id
            ));

            if ($query_t->num_rows() > 0) {
                $query_t = $query_t->result();
                $pengaturan = json_decode($query_t[0]->pengaturan_value);

                if ($row->ta_tahun == $pengaturan->tahun && $row->ta_semester == $pengaturan->semester) {
                    $item['selected'] = 1;
                }
            }

            array_push($data, $item);

        }

        //return $siswa->get()->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function edit(){
        $id = $this->input->post('id');

        /*
        ambil data (tahun,semester) table ta by id
        cek table pengaturan by user_id, pengaturan_key
        jika ada update
        jika tidak insert
        */

        $query_t = $this->db->get_where('pengaturan', array(
            'pengaturan_name' => 'tahun_ajaran',
            'pengaturan_key' => $this->pengaturan_key,
            'user_id' => $this->user_id
        ));

        $query_list = $this->db->get_where('ta', array(
            'ta_id' => $id,
            'pengaturan_key' => $this->pengaturan_key
        ))->result();

        $value = json_encode(array(
            'tahun' => $query_list[0]->ta_tahun,
            'semester' => $query_list[0]->ta_semester
        ), TRUE);

        if ($query_t->num_rows() > 0) {

            $this->m->simpanbyid(array('pengaturan_value' => $value), array(
                'pengaturan_name' => 'tahun_ajaran',
                'pengaturan_key' => $this->pengaturan_key,
                'user_id' => $this->user_id
            ), 'pengaturan');

        } else {

            $this->db->insert('pengaturan', array(
                'pengaturan_name' => 'tahun_ajaran',
                'pengaturan_value' => $value,
                'pengaturan_key' => $this->pengaturan_key,
                'user_id' => $this->user_id
            ));
        }


        $users_data = array();
        $users_data['pengaturan_ta'] = $query_list[0]->ta_tahun;
        $users_data['pengaturan_semester'] = $query_list[0]->ta_semester;

        $this->session->set_userdata($users_data);

        //$this->session->set_userdata('pengaturan_ta', $query_list[0]->ta_tahun);
        //$this->session->set_userdata('pengaturan_semester', $query_list[0]->ta_semester);


        $result['pesan'] = "";
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $result );

    }
}
?>