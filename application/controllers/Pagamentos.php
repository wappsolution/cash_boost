<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamentos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pagamento_model');
        $this->load->model('Usuarios_model'); // Para listar usuários no formulário
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    // AIDEV-GENERATED: Exibe a lista de pagamentos
    public function index() {
        $data['pagamentos'] = $this->Pagamento_model->getAll();
        $this->load->view('templates/header_view');
        $this->load->view('pagamentos/listar', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exibe o formulário para criar um novo pagamento
    public function criar() {
        $data['usuarios'] = $this->Usuarios_model->getAll();
        $this->load->view('templates/header_view');
        $this->load->view('pagamentos/criar', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Processa o envio do formulário de criação de pagamento
    public function store() {
        $this->form_validation->set_rules('usuario_id', 'Usuário', 'required|integer');
        $this->form_validation->set_rules('valor', 'Valor', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('data_pagamento', 'Data do Pagamento', 'required');
        $this->form_validation->set_rules('status_pagamento', 'Status do Pagamento', 'required');
        $this->form_validation->set_rules('metodo_pagamento', 'Método de Pagamento', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->criar();
        } else {
            $data = array(
                'usuario_id' => $this->input->post('usuario_id'),
                'valor' => $this->input->post('valor'),
                'data_pagamento' => $this->input->post('data_pagamento'),
                'status_pagamento' => $this->input->post('status_pagamento'),
                'metodo_pagamento' => $this->input->post('metodo_pagamento')
            );
            $this->Pagamento_model->create($data);
            redirect('pagamentos');
        }
    }

    // AIDEV-GENERATED: Exibe o formulário para editar um pagamento existente
    public function editar($id) {
        $data['pagamento'] = $this->Pagamento_model->getById($id);
        $data['usuarios'] = $this->Usuarios_model->getAll();

        if (empty($data['pagamento'])) {
            show_404();
        }

        $this->load->view('templates/header_view');
        $this->load->view('pagamentos/editar', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Processa o envio do formulário de edição de pagamento
    public function update($id) {
        $this->form_validation->set_rules('usuario_id', 'Usuário', 'required|integer');
        $this->form_validation->set_rules('valor', 'Valor', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('data_pagamento', 'Data do Pagamento', 'required');
        $this->form_validation->set_rules('status_pagamento', 'Status do Pagamento', 'required');
        $this->form_validation->set_rules('metodo_pagamento', 'Método de Pagamento', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->editar($id);
        } else {
            $data = array(
                'usuario_id' => $this->input->post('usuario_id'),
                'valor' => $this->input->post('valor'),
                'data_pagamento' => $this->input->post('data_pagamento'),
                'status_pagamento' => $this->input->post('status_pagamento'),
                'metodo_pagamento' => $this->input->post('metodo_pagamento')
            );
            $this->Pagamento_model->update($id, $data);
            redirect('pagamentos');
        }
    }

    // AIDEV-GENERATED: Deleta um pagamento
    public function delete($id) {
        $this->Pagamento_model->delete($id);
        redirect('pagamentos');
    }

    // AIDEV-GENERATED: Atualiza o status de um pagamento
    public function updateStatus($id, $status) {
        $this->Pagamento_model->updatePaymentStatus($id, $status);
        redirect('pagamentos');
    }

    // AIDEV-GENERATED: Exibe pagamentos pendentes
    public function pendentes() {
        $data['pagamentos'] = $this->Pagamento_model->getPendingPayments();
        $this->load->view('templates/header_view');
        $this->load->view('pagamentos/listar_pendentes', $data); // Nova view para pendentes
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exibe histórico de pagamentos de um usuário
    public function historico($usuario_id) {
        $data['pagamentos'] = $this->Pagamento_model->getPaymentHistoryByUser($usuario_id);
        $data['usuario'] = $this->Usuarios_model->getById($usuario_id);
        $this->load->view('templates/header_view');
        $this->load->view('pagamentos/historico', $data); // Nova view para histórico
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Simula o processo de pagamento
    public function simular_pagamento($id) {
        $this->output->set_content_type('application/json');

        // Simula o tempo de processamento no servidor
        sleep(3); // Simula um atraso total de 3 segundos para o processo

        // AIDEV-GENERATED: Simula uma chance de erro
        if (rand(1, 100) <= 20) { // 20% de chance de erro
            echo json_encode(['status' => 'erro', 'mensagem' => 'Falha na validação do pagamento. Tente novamente.']);
            return;
        }

        // Atualiza o status no banco de dados
        $success = $this->Pagamento_model->updatePaymentStatus($id, 'pago');

        if ($success) {
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Pagamento concluído com sucesso!']);
        } else {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao finalizar o pagamento no banco de dados.']);
        }
    }

    // AIDEV-GENERATED: Exporta dados de pagamentos para CSV
    public function export_csv() {
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $pagamentos = $this->Pagamento_model->getAll();

        if (empty($pagamentos)) {
            // Redireciona de volta com uma mensagem se não houver dados
            $this->session->set_flashdata('error', 'Nenhum pagamento para exportar.');
            redirect('pagamentos');
            return;
        }

        $csv_data = $this->dbutil->csv_from_result($this->Pagamento_model->getAllQueryObject());

        // Define o nome do arquivo
        $file_name = 'pagamentos_' . date('Ymd_His') . '.csv';

        // Força o download do arquivo
        force_download($file_name, $csv_data);
    }
}
