<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();        
    }

    public function index()
    {
        $data['header'] = 'header';
        $data['content'] = 'home/index';
        $data['footer'] = 'footer';

        $this->load->view('template', $data);
    }

}
