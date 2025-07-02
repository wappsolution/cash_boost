<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        // AIDEV-NOTE: Redireciona para login se o usuário não estiver logado
        if (!$this->session->userdata('user_logged_in')) {
            redirect('login');
        }
    }

    public function index() {
        $data['relatorios'] = [
            [
                'titulo' => 'Relatório de Gastos por Campanha',
                'descricao' => 'Visualiza os gastos totais de cada campanha.',
                'icone' => 'fas fa-chart-bar',
                'url' => site_url('relatorios/detalhe/gastos_campanha')
            ],
            [
                'titulo' => 'Relatório de Participações por Usuário',
                'descricao' => 'Exibe o número de participações de cada usuário em campanhas.',
                'icone' => 'fas fa-users',
                'url' => site_url('relatorios/detalhe/participacoes_usuario')
            ],
            [
                'titulo' => 'Relatório de Pagamentos Realizados',
                'descricao' => 'Lista todos os pagamentos efetuados, com detalhes de valor e método.',
                'icone' => 'fas fa-money-bill-wave',
                'url' => site_url('relatorios/detalhe/pagamentos_realizados')
            ],
            [
                'titulo' => 'Relatório de Campanhas por Status',
                'descricao' => 'Mostra a quantidade de campanhas ativas, inativas e concluídas.',
                'icone' => 'fas fa-info-circle',
                'url' => site_url('relatorios/detalhe/campanhas_status')
            ],
            [
                'titulo' => 'Relatório de Desempenho Mensal',
                'descricao' => 'Exibe o desempenho de campanhas ao longo dos meses com um gráfico.',
                'icone' => 'fas fa-chart-area',
                'url' => site_url('relatorios/grafico_mock')
            ],
            [
                'titulo' => 'Ranking de Resgates e Participação',
                'descricao' => 'Classificação dos usuários por total de resgates e participações.',
                'icone' => 'fas fa-trophy',
                'url' => site_url('relatorios/ranking')
            ],
            [
                'titulo' => 'Relatório de Dados Detalhados',
                'descricao' => 'Visualize dados detalhados com filtros de período e exporte para CSV.',
                'icone' => 'fas fa-table',
                'url' => site_url('relatorios/dados_detalhados')
            ],
        ];

        $this->load->view('templates/header_view');
        $this->load->view('relatorios/index', $data);
        $this->load->view('templates/footer_view');
    }

    public function detalhe($tipo_relatorio) {
        // AIDEV-TODO: Implementar a lógica para exibir o relatório detalhado com base no $tipo_relatorio
        $data['tipo_relatorio'] = $tipo_relatorio;
        $this->load->view('templates/header_view');
        $this->load->view('relatorios/detalhe', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exibe um relatório com gráfico mockado
    public function grafico_mock() {
        $data['chart_labels'] = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'];
        $data['chart_data'] = [65, 59, 80, 81, 56, 55];

        $this->load->view('templates/header_view');
        $this->load->view('relatorios/grafico_mock', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exibe um relatório de ranking de resgates e participação mockado
    public function ranking() {
        $data['ranking_data'] = [
            ['nome' => 'João Silva', 'resgates' => 295, 'participacoes' => 12],
            ['nome' => 'Maria Souza', 'resgates' => 250, 'participacoes' => 10],
            ['nome' => 'Pedro Almeida', 'resgates' => 180, 'participacoes' => 8],
            ['nome' => 'Ana Costa', 'resgates' => 150, 'participacoes' => 7],
            ['nome' => 'Carlos Lima', 'resgates' => 120, 'participacoes' => 5],
        ];

        $this->load->view('templates/header_view');
        $this->load->view('relatorios/ranking', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exibe um relatório de dados detalhados com filtros e opção de exportação CSV
    public function dados_detalhados() {
        $this->load->helper('form');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        // Dados mockados
        $all_data = [
            ['data' => '2025-01-10', 'item' => 'Venda A', 'valor' => 100.50, 'status' => 'Concluído'],
            ['data' => '2025-01-15', 'item' => 'Serviço B', 'valor' => 250.00, 'status' => 'Pendente'],
            ['data' => '2025-02-01', 'item' => 'Venda C', 'valor' => 75.20, 'status' => 'Concluído'],
            ['data' => '2025-02-20', 'item' => 'Produto D', 'valor' => 300.00, 'status' => 'Concluído'],
            ['data' => '2025-03-05', 'item' => 'Serviço E', 'valor' => 120.00, 'status' => 'Cancelado'],
            ['data' => '2025-03-10', 'item' => 'Venda F', 'valor' => 400.00, 'status' => 'Concluído'],
            ['data' => '2025-04-01', 'item' => 'Produto G', 'valor' => 50.00, 'status' => 'Pendente'],
            ['data' => '2025-04-15', 'item' => 'Serviço H', 'valor' => 180.00, 'status' => 'Concluído'],
        ];

        $filtered_data = [];
        foreach ($all_data as $row) {
            $row_date = strtotime($row['data']);
            $include_row = true;

            if ($start_date && $row_date < strtotime($start_date)) {
                $include_row = false;
            }
            if ($end_date && $row_date > strtotime($end_date)) {
                $include_row = false;
            }

            if ($include_row) {
                $filtered_data[] = $row;
            }
        }

        $data['report_data'] = $filtered_data;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $this->load->view('templates/header_view');
        $this->load->view('relatorios/dados_detalhados', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exporta dados detalhados para CSV
    public function export_dados_detalhados_csv() {
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        // Dados mockados (devem ser os mesmos da função dados_detalhados)
        $all_data = [
            ['data' => '2025-01-10', 'item' => 'Venda A', 'valor' => 100.50, 'status' => 'Concluído'],
            ['data' => '2025-01-15', 'item' => 'Serviço B', 'valor' => 250.00, 'status' => 'Pendente'],
            ['data' => '2025-02-01', 'item' => 'Venda C', 'valor' => 75.20, 'status' => 'Concluído'],
            ['data' => '2025-02-20', 'item' => 'Produto D', 'valor' => 300.00, 'status' => 'Concluído'],
            ['data' => '2025-03-05', 'item' => 'Serviço E', 'valor' => 120.00, 'status' => 'Cancelado'],
            ['data' => '2025-03-10', 'item' => 'Venda F', 'valor' => 400.00, 'status' => 'Concluído'],
            ['data' => '2025-04-01', 'item' => 'Produto G', 'valor' => 50.00, 'status' => 'Pendente'],
            ['data' => '2025-04-15', 'item' => 'Serviço H', 'valor' => 180.00, 'status' => 'Concluído'],
        ];

        $filtered_data = [];
        foreach ($all_data as $row) {
            $row_date = strtotime($row['data']);
            $include_row = true;

            if ($start_date && $row_date < strtotime($start_date)) {
                $include_row = false;
            }
            if ($end_date && $row_date > strtotime($end_date)) {
                $include_row = false;
            }

            if ($include_row) {
                $filtered_data[] = $row;
            }
        }

        if (empty($filtered_data)) {
            $this->session->set_flashdata('error', 'Nenhum dado para exportar com os filtros selecionados.');
            redirect('relatorios/dados_detalhados');
            return;
        }

        // Converte o array de dados para um formato que csv_from_result possa usar
        // Cria um objeto CI_DB_result mockado
        $csv_output = fopen('php://temp', 'r+');

        // Adiciona o cabeçalho
        fputcsv($csv_output, array_keys(reset($filtered_data)));

        // Adiciona os dados
        foreach ($filtered_data as $row) {
            fputcsv($csv_output, $row);
        }

        rewind($csv_output);
        $csv_data = stream_get_contents($csv_output);
        fclose($csv_output);

        $file_name = 'relatorio_detalhado_' . date('Ymd_His') . '.csv';
        force_download($file_name, $csv_data);
    }
}
