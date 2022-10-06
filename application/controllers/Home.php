<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
	    $data = array();
        $data['title'] = 'Welcome';

        $this->template->load('template_home','home/welcome',$data);
	}

}
