<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this->load->view('login_view');
    }

    public function authenticate() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($email === 'admin@cashboost.com' && $password === '123456') {
            $this->session->set_userdata('user_logged_in', TRUE);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Email ou senha inválidos.');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_logged_in');
        redirect('login');
    }
}
