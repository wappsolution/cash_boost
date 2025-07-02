<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validacoes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Validacao_model');
        $this->load->model('Participacao_model');
        $this->load->model('Pagamento_model');
        $this->load->model('Participacao_log_model'); // Carrega o modelo de logs
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');

        // AIDEV-TODO: Implementar checagem de permissão para supervisores
        if (!$this->session->userdata('user_logged_in')) {
            redirect('login');
        }
    }

    // AIDEV-GENERATED: Exibe a lista de participações para validação (pendentes e validadas)
    public function index() {
        $data['participacoes'] = $this->Validacao_model->getParticipacoesComStatusValidacao();
        $this->load->view('templates/header_view');
        $this->load->view('validacoes/index', $data); // Renomeado para index.php
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exibe o formulário para validar uma participação
    public function validar($participacao_id) {
        $participacao = $this->Participacao_model->getById($participacao_id);

        if (empty($participacao)) {
            show_404();
        }

        $data['participacao'] = $participacao;
        $this->load->view('templates/header_view');
        $this->load->view('validacoes/form_validacao', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Processa a validação da meta
    public function processar_validacao() {
        $this->form_validation->set_rules('participacao_id', 'ID da Participação', 'required|integer');
        $this->form_validation->set_rules('meta_atingida', 'Meta Atingida', 'required|integer|in_list[0,1]');
        $this->form_validation->set_rules('observacao', 'Observação', 'max_length[500]');

        if ($this->form_validation->run() === FALSE) {
            $this->validar($this->input->post('participacao_id'));
        } else {
            $participacao_id = $this->input->post('participacao_id');
            $meta_atingida = $this->input->post('meta_atingida');
            $observacao = $this->input->post('observacao');
            $supervisor_id = $this->session->userdata('user_id'); // ID do supervisor logado

            $data_validacao = array(
                'participacao_id' => $participacao_id,
                'supervisor_id' => $supervisor_id,
                'meta_atingida' => $meta_atingida,
                'observacao' => $observacao,
            );

            if ($this->Validacao_model->create($data_validacao)) {
                // Atualiza o status da participação
                $new_status_participacao = ($meta_atingida == 1) ? 'aprovada' : 'rejeitada';
                $this->Participacao_model->updateStatusParticipacao($participacao_id, $new_status_participacao);

                // AIDEV-GENERATED: Registra o log da validação
                $log_acao = ($meta_atingida == 1) ? 'meta_aprovada' : 'meta_rejeitada';
                $log_observacao = $observacao;
                $this->Participacao_log_model->create([
                    'participacao_id' => $participacao_id,
                    'usuario_id' => $supervisor_id,
                    'acao' => $log_acao,
                    'observacao' => $log_observacao
                ]);

                // Se a meta foi atingida, registra o pagamento
                if ($meta_atingida == 1) {
                    $participacao = $this->Participacao_model->getById($participacao_id);
                    if ($participacao && $participacao->premio > 0) {
                        $pagamento_data = array(
                            'participacao_id' => $participacao_id,
                            'usuario_id' => $participacao->usuario_id,
                            'valor' => $participacao->premio,
                            'data_pagamento' => date('Y-m-d H:i:s'),
                            'status_pagamento' => 'pendente', // Pode ser 'pendente' ou 'pago' dependendo da regra
                            'metodo_pagamento' => 'pix' // Padrão Pix
                        );
                        $this->Pagamento_model->create($pagamento_data);
                        $this->session->set_flashdata('success', 'Meta validada e pagamento registrado com sucesso!');
                    } else {
                        $this->session->set_flashdata('success', 'Meta validada com sucesso! Nenhum prêmio a ser pago.');
                    }
                } else {
                    $this->session->set_flashdata('success', 'Meta validada como não atingida.');
                }
            } else {
                $this->session->set_flashdata('error', 'Erro ao registrar a validação. Tente novamente.');
            }
            redirect('validacoes');
        }
    }

    // AIDEV-GENERATED: Exibe o histórico de logs de uma participação
    public function historico_log($participacao_id) {
        $data['logs'] = $this->Participacao_log_model->getLogsByParticipacaoId($participacao_id);
        $data['participacao_id'] = $participacao_id;
        $this->load->view('templates/header_view');
        $this->load->view('validacoes/historico_log', $data);
        $this->load->view('templates/footer_view');
    }
}
