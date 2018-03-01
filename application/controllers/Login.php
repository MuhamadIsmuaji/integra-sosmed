<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function auth()
    {
        $auth = $this->session->userdata('integra-sosmed');

        if ($auth) {
            $redirectTo = Lib::getRedirectTo($auth->role_id);

            redirect($redirectTo);
        }
    }
    
    public function index()
    {
        $this->auth();

        if (empty($_POST)) {
            $data['header'] = 'header';
            $data['content'] = 'login/index';
            $data['footer'] = 'footer';

            $this->load->view('template', $data);
        } else {
            $post = $this->input->post();
            $this->load->model(['M_users' => 'users']);
            $redirectTo = 'login';

            $auth = $this->users->findOne([
                'email' => $post['email'],
                'password' => md5($post['password']),
            ]);

            if ($auth) {
                $redirectTo = Lib::getRedirectTo($auth->role_id);
                $this->session->set_userdata('integra-sosmed', $auth);
            } else {
                $this->session->set_flashdata('feedback_danger', '<strong>Maaf,</strong> kombinasi email dan password yang Anda masukkan salah.');
            }

            redirect($redirectTo);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('integra-sosmed');
        redirect('home');
    }
}