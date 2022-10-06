<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends CI_Controller {

	public function index()
	{
        $data = array();
        $data['title'] = 'Arsip';

        $this->template->load('template_home','home/arsip',$data);
	}


}
