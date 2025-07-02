📄 PRD – Sistema de Campanhas de Engajamento para Funcionários
🧭 Visão Geral
O sistema visa promover campanhas de engajamento recorrentes entre funcionários, premiando os que cumprirem metas específicas (ex: pontualidade, tarefas preventivas, ações urgentes) com pagamentos imediatos via Pix, cartões presente ou plataforma de crédito.

A interface pública será acessada via WebView dentro de um app corporativo. A administração será feita via painel web restrito.

👥 Perfis de Usuário
Perfil	Permissões
Administrador	Criar, editar e finalizar campanhas; configurar sistema; ver tudo.
Financeiro	Gerenciar pagamentos, ver relatórios, exportar dados.
Supervisor	Criar campanhas, validar cumprimento de metas, aprovar/recusar resultados.

🎯 Funcionalidades – Área Pública (Funcionários)
Visualizar campanhas ativas

Participar das campanhas clicando em “Quero Participar”

Receber feedback visual imediato

Visualizar histórico de conquistas e resgates

Ver mensagens de alerta (missões vencidas, pendentes)

🛠 Funcionalidades – Painel Administrativo
1. Gestão de Campanhas
Criar campanhas de engajamento com:

Título

Meta descritiva

Valor da premiação

Tipo: pontualidade, preventiva, urgente

Recorrência (mensal, semanal)

Data início e fim

Status (ativa, agendada, encerrada)

Histórico de campanhas finalizadas

Notificações automáticas sobre encerramentos

2. Participações
Visualizar participantes por campanha

Aprovar ou recusar cumprimento da meta (manual ou integrado)

Log de interações por campanha

Histórico individual por funcionário

3. Pagamentos
Gatilho para “Pagar Agora” com três formas:

Pix (via chave ou API de integração)

Cartão presente (upload de comprovante ou código)

Plataforma de crédito (via API de terceiros)

Dashboard de valores pagos por campanha

Histórico de pagamento por funcionário

Integração com sistema financeiro externo

4. Relatórios e Dashboards
Exportação de CSV com:

Participantes

Resultados

Status de pagamento

Dashboards com:

Ranking de resgate

Total gasto por campanha

Desempenho por setor

Alertas de metas não cumpridas ou campanhas próximas do fim

🔒 Segurança e Acesso
Acesso ao painel via login e senha (admin, financeiro, supervisor)

Painel logado separado da área pública

Logs de atividade: quem criou, aprovou, pagou, finalizou

🔗 Integrações
Sistema de chamados internos (para validar execução das metas)

Base de funcionários importada automaticamente

API de pagamento (Pix instantâneo, ou integração com gateway)

Plataforma de crédito e cartões presente

Possível integração futura com sistema de RH

📱 Experiência Mobile (Funcionário)
WebView dentro de app corporativo

Layout responsivo (até 400px de largura)

Feedbacks visuais por campanha (ícones, cores, animações)

Notificações (via popup ou push no app)

Apenas leitura e participação — sem login na WebView

📌 Requisitos Técnicos
Front-end:
Painel admin: Codeigniter3 + Tailwind ou ShadCN

Público (WebView): HTML/JS simples ou versão reduzida do React

Back-end:
Codeigniter 3

Banco: mySQL

API RESTful com autenticação JWT

Integração com serviços de pagamento via Webhook

✅ Critérios de Aceitação
Funcionário pode participar de campanhas de forma simples via WebView

Admin pode criar e editar campanhas com recorrência

Supervisores podem validar metas cumpridas

Financeiro pode acionar pagamentos e exportar relatórios

Painel mostra dados de desempenho e histórico

Sistema é seguro, auditável e acessível por celular