<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index() {
        $testes_disponiveis = [
            ['label' => 'Conexão com Banco de Dados', 'metodo' => 'conexaoBanco', 'descricao' => 'Verifica se o model está conectando corretamente ao banco e retornando campanhas ativas.'],
            ['label' => 'Validação de Vetor Simples', 'metodo' => 'validaDados', 'descricao' => 'Testa estrutura de vetor com dados fixos.'],
            ['label' => 'Resposta Padrão Formatada', 'metodo' => 'estruturaResposta', 'descricao' => 'Exibe resposta de sucesso com status e mensagem.'],
            ['label' => 'Executar Migrações do Banco de Dados', 'metodo' => 'migrate_db', 'descricao' => 'Aplica as migrações pendentes no banco de dados.']
        ];

        $this->load->view('test/header');
        $this->load->view('test/menu', ['testes' => $testes_disponiveis]);
        $this->load->view('test/footer');
    }

    public function conexaoBanco() {
        $this->load->model('Campanha_model');
        $dados = $this->Campanha_model->getCampanhasAtivas();

        $resposta = [
            'descricao' => 'Este é o teste de conexão com o banco de dados usando o Campanha_model.',
            'resultado' => $dados
        ];

        $this->load->view('test/header');
        $this->load->view('test/resultado', $resposta);
        $this->load->view('test/footer');
    }

    public function validaDados() {
        $vetor = ['nome' => 'Exemplo', 'valor' => 100];

        $resposta = [
            'descricao' => 'Este é o teste de validação de vetor com dados simulados.',
            'resultado' => $vetor
        ];

        $this->load->view('test/header');
        $this->load->view('test/resultado', $resposta);
        $this->load->view('test/footer');
    }

    public function estruturaResposta() {
        $respostaPadrao = ['status' => true, 'mensagem' => 'Teste de resposta'];

        $resposta = [
            'descricao' => 'Este é o teste de estrutura de resposta com status e mensagem.',
            'resultado' => $respostaPadrao
        ];

        $this->load->view('test/header');
        $this->load->view('test/resultado', $resposta);
        $this->load->view('test/footer');
    }

    // AIDEV-GENERATED: Método para executar as migrações do banco de dados
    public function migrate_db() {
        $this->load->library('migration');

        if ($this->migration->latest() === FALSE) {
            $resposta = [
                'descricao' => 'Erro ao executar migrações do banco de dados.',
                'resultado' => $this->migration->error_string()
            ];
        } else {
            $resposta = [
                'descricao' => 'Migrações do banco de dados executadas com sucesso.',
                'resultado' => 'Banco de dados atualizado para a versão mais recente.'
            ];
        }

        $this->load->view('test/header');
        $this->load->view('test/resultado', $resposta);
        $this->load->view('test/footer');
    }
}