<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_logged_in')) {
            redirect('login');
        }
    }

    public function index() {
        $this->load->view('templates/header_view');
        $this->load->view('dashboard_view');
        $this->load->view('templates/footer_view');
    }
}
