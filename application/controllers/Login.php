<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('login_view');
    }

    public function authenticate() {
        $email = $this->input->post('email');
        $senha = $this->input->post('password');

        $user = $this->Usuarios_model->verify_login($email, $senha);

        if ($user) {
            $user_data = array(
                'user_id' => $user->id,
                'user_name' => $user->nome,
                'user_email' => $user->email,
                'user_profile' => $user->perfil,
                'user_logged_in' => TRUE
            );
            $this->session->set_userdata($user_data);
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
