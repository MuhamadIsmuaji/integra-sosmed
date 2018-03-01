<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library(['form_validation']);
        $this->load->model(['M_statuses' => 'statuses']);
        $this->auth();   
    }

    public function auth()
    {
        $auth = $this->session->userdata('integra-sosmed');

        if (!$auth || $auth->role_id == 1) {
            redirect('home');
        }
    }

    public function index()
    {
        $data['header'] = 'header';
        $data['content'] = 'posts/index';
        $data['footer'] = 'footer';
        
        $this->load->view('template', $data);        
    }

    public function create() {
        $data['header'] = 'header';
        $data['content'] = 'posts/form';
        $data['form_title'] = 'Tambah Status';
        $data['form_action'] = 'posts/create';        
        $data['is_edit'] = false;        
        $data['footer'] = 'footer';

        if (empty($_POST)) {
            $this->load->view('template', $data);
        } else {
            $post = $this->input->post();
            $type = 'feedback_danger';
            $message = '';
            $redirectTo = 'posts/create';
            $errorFlag = 0;
            $uploadFlag = 0;

            if (!empty($_FILES['attachment']['name'])) {
                $uploadFlag = 1;

                $config['upload_path']          = './assets/attachment/';
                $config['allowed_types']        = 'docx|pdf|xlsx|pptx|jpg|jpeg|png|mp4';
                $config['file_name']            = 'Lampiran Status ' . $_FILES['attachment']['name'];
                $config['max_size']             = 50000; //50 MB
                $config['file_ext_tolower']		= FALSE;
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('attachment')) {
                    $errorFlag = 1;
                    $message = '<strong>Maaf,</strong> terjadi kesalahan saat mengunggah lampiran silahkan ulangi lagi.';
                }
            }

//          insert process
            if ($errorFlag == 0) {

                $auth = $this->session->userdata('integra-sosmed');
                
                $data = [
                    'user_id' => $auth->id,
                    'content' => $post['content'],
                    'attachment' => $uploadFlag == 0 ? NULL : $this->upload->data('file_name'),
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $type = 'feedback_danger';
                $message = '<strong>Maaf,</strong> terjadi kesalahan silahkan ulangi lagi.';
                
                if ($this->statuses->insert($data)) {
                    $redirectTo = 'posts';
                    $type = 'feedback_success';
                    $message = '<strong>Berhasil,</strong> status telah ditambahkan.';
                }              
            }

            $this->session->set_flashdata($type, $message);                            
            redirect($redirectTo); 
        }
    }

    public function update($id) {
        $auth = $this->session->userdata('integra-sosmed');        
        $status = $this->statuses->findOne(['id' => $id, 'user_id' => $auth->id]);

        if (!$status ) {
            redirect('posts');
        } else {
            $data['header'] = 'header';
            $data['content'] = 'posts/form';
            $data['form_title'] = 'Ubah Status';
            $data['form_action'] = 'posts/update/' . $status->id;
            $data['is_edit'] = true;
            $data['status'] = $status;                            
            $data['footer'] = 'footer';

            if (empty($_POST)) {
                $this->load->view('template', $data);                
            } else {
                $post = $this->input->post();
                $type = 'feedback_danger';
                $message = '';
                $redirectTo = $data['form_action'];
                $errorFlag = 0;
                $uploadFlag = 0;   

                if (!empty($_FILES['attachment']['name'])) {
                    $uploadFlag = 1;

                    $config['upload_path']          = './assets/attachment/';
                    $config['file_name']            = 'Lampiran Status ' . $_FILES['attachment']['name'];                        
                    $config['allowed_types']        = 'docx|pdf|xlsx|pptx|jpg|jpeg|png|mp4';
                    $config['max_size']             = 50000; //50 MB
                    $config['file_ext_tolower']		= FALSE;
                    $this->load->library('upload', $config);
                    
                    if (!$this->upload->do_upload('attachment')) {
                        $errorFlag = 1;
                        $message = '<strong>Maaf,</strong> terjadi kesalahan saat mengunggah lampiran silahkan ulangi lagi.';
                    }
                }

//              update process
                if ($errorFlag == 0) {
                            
                    $data = [
                        'content' => $post['content'],
                        'attachment' => $uploadFlag == 0 ? $status->attachment : $this->upload->data('file_name'),
                    ];

                    $type = 'feedback_danger';
                    $message = '<strong>Maaf,</strong> terjadi kesalahan silahkan ulangi lagi.';
                    
                    if ($this->statuses->update($data, ['id' => $status->id])) {
//                      delete old files
                        if ($uploadFlag == 1) {
                            unlink('./assets/attachment/' . $status->attachment);
                        }

                        $redirectTo = 'posts';
                        $type = 'feedback_success';
                        $message = '<strong>Berhasil,</strong> status telah diubah.';
                    }              
                }

                $this->session->set_flashdata($type, $message);                            
                redirect($redirectTo);
            }
        }
    }
}