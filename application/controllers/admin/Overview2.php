<?php  
class Overview2 extends CI_Controller{


    function __construct(){
        parent::__construct();
        $this->load->model('Mymodel','m');

        if($this->session->userdata('level') != 'admin'){
            redirect('home');
        }


    }

    function index(){
		$data['title'] = 'Overview';

        $this->template->load('template','admin/overview2',$data);

    }

}
?>