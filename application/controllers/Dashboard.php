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
        $this->load->model('Campanhas_model');
        $this->load->model('Participacao_model');
        $data['total_gasto'] = $this->Campanhas_model->getTotalGasto();
        $data['campanhas_ativas'] = $this->Campanhas_model->countActiveCampanhas();
        $data['novas_campanhas_semana'] = $this->Campanhas_model->countNewCampanhasThisWeek();
        $data['total_participacoes'] = $this->Participacao_model->countAllParticipations();

        // AIDEV-GENERATED: Dados para o Campeão de Resgates
        $nomes_funcionarios = ['João Silva', 'Maria Souza', 'Pedro Almeida', 'Ana Costa', 'Carlos Lima'];
        $data['campeao_nome'] = $nomes_funcionarios[array_rand($nomes_funcionarios)];
        $data['campeao_resgatado'] = rand(100, 500); // Valor aleatório entre 100 e 500

        $this->load->view('templates/header_view');
        $this->load->view('dashboard_view', $data);
        $this->load->view('templates/footer_view');
    }
}
