<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participacoes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Participacao_model');
        $this->load->model('Campanhas_model');
        $this->load->model('Usuarios_model');
        $this->load->helper('url');
        $this->load->library('session');

        // AIDEV-NOTE: Redireciona para login se o usuário não estiver logado
        if (!$this->session->userdata('user_logged_in')) {
            redirect('login');
        }
    }

    // AIDEV-GENERATED: Exibe a lista de campanhas disponíveis para participação (simulando tela de celular)
    public function index() {
        $usuario_id = $this->session->userdata('user_id');
        $data['campanhas_disponiveis'] = $this->Participacao_model->getAvailableCampanhasForUser($usuario_id);

        // AIDEV-GENERATED: Dados para o Campeão de Resgates na tela de Participações
        $nomes_funcionarios = ['João Silva', 'Maria Souza', 'Pedro Almeida', 'Ana Costa', 'Carlos Lima'];
        $data['campeao_nome'] = $this->session->userdata('user_name');
        $data['campeao_resgatado'] = rand(100, 500); // Valor aleatório entre 100 e 500
        $data['current_user_name'] = $this->session->userdata('user_name');

        $this->load->view('templates/header_view'); // Pode ser um header mais simples para mobile
        $this->load->view('participacoes/mobile_campanhas', $data);
        $this->load->view('templates/footer_view'); // Pode ser um footer mais simples para mobile
    }

    // AIDEV-GENERATED: Processa a participação em uma campanha
    public function participar($campanha_id) {
        $usuario_id = $this->session->userdata('user_id');

        // Verifica se o usuário já participou desta campanha
        if ($this->Participacao_model->hasParticipated($campanha_id, $usuario_id)) {
            $this->session->set_flashdata('error', 'Você já está participando desta campanha.');
        } else {
            $data = array(
                'campanha_id' => $campanha_id,
                'usuario_id' => $usuario_id,
                'data_participacao' => date('Y-m-d H:i:s'),
                'status_participacao' => 'pendente' // Status inicial da participação
            );

            if ($this->Participacao_model->create($data)) {
                $this->session->set_flashdata('success', 'Sua participação foi registrada com sucesso!');
            } else {
                $this->session->set_flashdata('error', 'Erro ao registrar sua participação. Tente novamente.');
            }
        }
        redirect('participacoes'); // Redireciona de volta para a lista de campanhas
    }

    // AIDEV-GENERATED: Exibe a lista de todas as participações (para admin/supervisor)
    public function listar_todas() {
        // AIDEV-TODO: Implementar checagem de permissão para esta função
        $data['participacoes'] = $this->Participacao_model->getAll();
        $this->load->view('templates/header_view');
        $this->load->view('participacoes/listar_todas', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exibe campanhas ativas com detalhes de participação em formato de cards
    public function ativas() {
        $data['campanhas_ativas'] = $this->Participacao_model->getActiveCampaignsWithParticipationDetails();
        $this->load->view('templates/header_view');
        $this->load->view('participacoes/listar_ativas', $data);
        $this->load->view('templates/footer_view');
    }
}
