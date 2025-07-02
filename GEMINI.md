# Projeto de Campanhas - Setup e Diretrizes

## Configuração Inicial

1.  **Banco de Dados:** Configure as credenciais do banco de dados no arquivo `application/config/database.php`.
2.  **URL Base:** Configure a URL base do projeto no arquivo `application/config/config.php`.
3.  **Chave de Criptografia:** Defina uma chave de criptografia no arquivo `application/config/config.php`.

## Estrutura de Arquivos

*   `application/`: Contém a lógica da sua aplicação (controllers, models, views, etc.).
*   `system/`: Contém os arquivos do core do CodeIgniter. Não modifique os arquivos desta pasta.
*   `index.php`: É o front controller da aplicação.

## Tecnologias Utilizadas

- Framework PHP: CodeIgniter 3
- Estilo: TailwindCSS
- Banco de dados: MySQL
- JavaScript (apenas para controle de interface)
- HTML puro em views, com uso de Bootstrap opcional

## Estrutura Padrão do Projeto (MVC)

### Controllers
- Responsáveis por regras de negócio, controle de fluxo e chamadas ao Model.
- Toda requisição vinda da view deve passar por uma Controller.
- Nenhuma consulta SQL deve ser feita diretamente no Controller.
- Sempre validar dados antes de enviar ao Model.

### Models
- Responsáveis por interações com o banco de dados.
- Utilizar os métodos nativos do CodeIgniter (`$this->db->get_where()`, `insert()`, `update()`, etc.).
- Evitar SQL puro, exceto em casos de necessidade justificada.
- Toda função deve ter uma única responsabilidade (ex: `getCampanhasAtivas()`).

### Views
- HTML puro ou JavaScript simples, sem lógica de negócio.
- Recebe dados da Controller e exibe de forma limpa.
- Toda ação da view (botão, formulário) deve enviar dados via POST/GET para uma Controller.
- Após o envio, deve haver um `redirect()` da Controller para recarregar a view com os novos dados.
- Nunca fazer `if` ou `foreach` com dados não tratados diretamente no JavaScript.

## Fluxo Padrão para Criar ou Editar Funcionalidade

1. Analisar qual Controller será afetada.
2. Criar ou atualizar Model correspondente.
3. Criar ou atualizar View (se necessário).
4. Testar funcionalidade usando a Controller de teste.
5. Validar dados com `echo '<pre>'; print_r($variavel); exit;`

## Regras Gerais
- Antes de programar, planejar qual controller, model e view serão editados.
- Toda view deve se comunicar com controller.
- Toda controller deve validar dados e repassar ao model.
- Toda lógica de banco deve estar em model.
- Toda função deve ser testada primeiro via /Test.

## Testes
- Durante o desenvolvimento, todos os testes devem ser feitos via:
- Navegador: acessando localhost/projeto/index.php/test/nome_da_funcao
- Exibindo dados com echo '<pre>'; print_r($dados);echo '</pre>'; para validar vetores, objetos, arrays, resultados do banco, etc.

Observação
Manter o código limpo, com indentação consistente. Nunca misturar responsabilidades entre camadas (MVC). Todos os arquivos devem ser nomeados com clareza e função única.

## Documentação orientada pela AI

Durante o desenvolvimento com auxílio de IA, é necessário registrar decisões e sugestões feitas, especialmente em áreas críticas. Para isso, utilize comentários âncora no código, que permitem rastrear a origem e intenção de determinados blocos.

### Comentários âncora (Anchor Comments)

Use os seguintes marcadores no código-fonte:
```php
// AIDEV-NOTE: explicação adicional sobre decisão ou lógica incomum
// AIDEV-TODO: melhorias planejadas a serem feitas manualmente depois
// AIDEV-QUESTION: dúvida levantada durante geração com IA
// AIDEV-GENERATED: trecho gerado parcialmente ou totalmente por IA
```
## Controller de Teste

Criar a controller: `/application/controllers/Test.php`

Dentro dela, centralizar métodos de testes com nomes claros:

```php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index() {
        $testes_disponiveis = [
            ['label' => 'Conexão com Banco de Dados', 'metodo' => 'conexaoBanco', 'descricao' => 'Verifica se o model está conectando corretamente ao banco e retornando campanhas ativas.'],
            ['label' => 'Validação de Vetor Simples', 'metodo' => 'validaDados', 'descricao' => 'Testa estrutura de vetor com dados fixos.'],
            ['label' => 'Resposta Padrão Formatada', 'metodo' => 'estruturaResposta', 'descricao' => 'Exibe resposta de sucesso com status e mensagem.']
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
}
```

## ✅ To-do por Sprint (Linha de Desenvolvimento)

### 🟠 Sprint 1 – Base do Projeto
- [x] Configurar estrutura do CodeIgniter 3
- [x] Criar layout base com TailwindCSS (header, footer, container)
- [x] Implementar sistema de login com sessões
- [x] Criar middleware ou checagem de permissões (Admin, Supervisor, Financeiro)
- [x] Criar controller de testes (`Test.php`) com métodos básicos

### 🟡 Sprint 2 – Campanhas
- [x] Criar `Campanhas_model.php` com métodos: `create`, `update`, `getAll`, `getById`, `delete`
- [x] Criar `Campanhas.php` (controller) com as regras de negócio
- [x] Criar views: `listar`, `criar`, `editar` com validações
- [x] Permitir ativar/desativar campanha
- [x] Validar datas e recorrência

### 🟢 Sprint 3 – Participações e Validações
- [x] Criar `Participacao_model.php` e `Participacoes.php`
- [x] Criar botão "Quero Participar" com POST controlado
- [x] Criar `Validacao_model.php` e `Validacoes.php` para validação de metas
- [x] Implementar permissões específicas para supervisores
- [x] Registrar logs de validação (quem validou, quando, status)

### 🔵 Sprint 4 – Pagamentos
- [x] Criar `Pagamento_model.php` e `Pagamentos.php`
- [x] Listar participações validadas e pendentes de pagamento
- [x] Simular integração com APIs de pagamento (Pix, Cartão, Plataforma)
- [x] Atualizar status de pagamento manualmente
- [x] Criar histórico de pagamentos por usuário
- [x] Exportar pagamentos em CSV

### 🟣 Sprint 5 – Relatórios e Dashboard
- [x] Criar painel com KPIs (total gasto, participações, etc.)
- [x] Gerar gráficos com Chart.js ou similar
- [x] Ranking de resgates e participação
- [x] Criar filtros por período, campanha, status
- [x] Exportação de relatórios (CSV)

## Instrução para Assistentes de IA

Antes de atualizar qualquer item como concluído (marcar com `- [x]`), **pergunte explicitamente ao usuário se a tarefa realmente foi finalizada**.

### Exemplo:
Usuário: "Atualize o progresso"
IA: "Você confirma que deseja marcar como concluído o item: 'Criar controller de testes (`Test.php`) com métodos básicos'?"

Somente após a confirmação do usuário, a IA deve atualizar o `.md`.

Essa confirmação deve ser feita **para cada item individual** sugerido para marcação.

## Observação sobre Tailwind CSS

Devido a problemas persistentes na compilação do Tailwind CSS no ambiente atual, o projeto está utilizando temporariamente o CDN do Tailwind CSS para o desenvolvimento da interface. Para um ambiente de produção, é **altamente recomendado** configurar corretamente o ambiente Node.js/npm e compilar o Tailwind CSS localmente para otimização e desempenho. Verifique a documentação oficial do Tailwind CSS para as etapas de instalação e configuração em produção.
