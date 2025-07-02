<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campanhas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Campanhas_model');
        $this->load->helper('url'); // Para usar a função site_url()
        $this->load->library('form_validation'); // Para validação de formulários
    }

    // AIDEV-GENERATED: Exibe a lista de campanhas
    public function index() {
        $data['campanhas'] = $this->Campanhas_model->getAll();
        $this->load->view('templates/header_view');
        $this->load->view('campanhas/listar', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exibe o formulário para criar uma nova campanha
    public function criar() {
        $this->load->view('templates/header_view');
        $this->load->view('campanhas/criar');
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Processa o envio do formulário de criação de campanha
    public function store() {
        $this->form_validation->set_rules('nome', 'Nome da Campanha', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        $this->form_validation->set_rules('data_inicio', 'Data de Início', 'required|callback_validar_data');
        $this->form_validation->set_rules('data_fim', 'Data de Fim', 'required|callback_validar_data');
        $this->form_validation->set_rules('recorrencia', 'Recorrência', 'required');
        $this->form_validation->set_rules('gasto', 'Gasto', 'required|numeric|greater_than_equal_to[0]');

        // AIDEV-TODO: Implementar validação de datas e recorrência mais robusta

        if ($this->form_validation->run() === FALSE) {
            $this->criar(); // Recarrega o formulário com erros de validação
        } else {
            $data = array(
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao'),
                'data_inicio' => $this->input->post('data_inicio'),
                'data_fim' => $this->input->post('data_fim'),
                'recorrencia' => $this->input->post('recorrencia'),
                'gasto' => $this->input->post('gasto'),
                'status' => 1 // Ativa por padrão ao criar
            );

            $this->Campanhas_model->create($data);
            redirect('campanhas');
        }
    }

    // AIDEV-GENERATED: Exibe o formulário para editar uma campanha existente
    public function editar($id) {
        $data['campanha'] = $this->Campanhas_model->getById($id);

        if (empty($data['campanha'])) {
            show_404();
        }

        $this->load->view('templates/header_view');
        $this->load->view('campanhas/editar', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Processa o envio do formulário de edição de campanha
    public function update($id) {
        $this->form_validation->set_rules('nome', 'Nome da Campanha', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        $this->form_validation->set_rules('data_inicio', 'Data de Início', 'required|callback_validar_data');
        $this->form_validation->set_rules('data_fim', 'Data de Fim', 'required|callback_validar_data');
        $this->form_validation->set_rules('recorrencia', 'Recorrência', 'required');
        $this->form_validation->set_rules('gasto', 'Gasto', 'required|numeric|greater_than_equal_to[0]');

        // AIDEV-TODO: Implementar validação de datas e recorrência mais robusta

        if ($this->form_validation->run() === FALSE) {
            $this->editar($id); // Recarrega o formulário com erros de validação
        } else {
            $data = array(
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao'),
                'data_inicio' => $this->input->post('data_inicio'),
                'data_fim' => $this->input->post('data_fim'),
                'recorrencia' => $this->input->post('recorrencia'),
                'gasto' => $this->input->post('gasto')
            );

            $this->Campanhas_model->update($id, $data);
            redirect('campanhas');
        }
    }

    // AIDEV-GENERATED: Deleta uma campanha
    public function delete($id) {
        $this->Campanhas_model->delete($id);
        redirect('campanhas');
    }

    // AIDEV-GENERATED: Ativa/desativa uma campanha
    public function toggleStatus($id, $status) {
        $this->Campanhas_model->toggleStatus($id, $status);
        redirect('campanhas');
    }

    // AIDEV-GENERATED: Callback de validação de data (exemplo simples)
    public function validar_data($date) {
        if (empty($date)) {
            $this->form_validation->set_message('validar_data', 'O campo {field} é obrigatório.');
            return FALSE;
        }
        // AIDEV-TODO: Adicionar validação de formato de data e datas válidas
        return TRUE;
    }
}
