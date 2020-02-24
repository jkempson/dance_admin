<?php

class Sessions extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', '', true);
        $this->load->library('session');
    }
    
    function login($username = NULL)
    {
        if ($this->session->userdata('loggedin')) {
            redirect("/");
        } else {
            $data['title']    = 'Forth Dance Login';
            $data['hidehome'] = 1;
            $data['username'] = "";
            
            if ($username != "") {
                $data['username'] = $username;
            } elseif ($this->session->userdata('username') != "") {
                $data['username'] = $this->session->userdata('username');
            }
            
            $this->load->view('templates/header', $data);
            $this->load->view('sessions/login', $data);
            $this->load->view('templates/footer');
        }
    }
    
    function authenticate()
    {
        sleep(2);
        $auth = 0;
        $user = $this->input->post('user');
        
        $this->session->set_userdata('username', $user['name']);
        if ($this->user_model->authenticate($user['name'], $user['password'])) {
            $this->session->set_userdata('loggedin', true);
            $auth = 1;
        }
        
        $this->user_model->recordlogin($user['name'], $auth);
        redirect("/");
    }
    
    function logout()
    {
        $this->session->unset_userdata('loggedin');
        redirect('/');
    }
}