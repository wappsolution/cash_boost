<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center"><i class="fas fa-dollar-sign mr-3"></i> Lista de Pagamentos</h1>
        <div class="flex space-x-2">
            <a href="<?php echo site_url('pagamentos/criar'); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">Registrar Novo Pagamento</a>
            <a href="<?php echo site_url('pagamentos/export_csv'); ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-download mr-2"></i> .csv
            </a>
        </div>
    </div>

    <?php if (empty($pagamentos)): ?>
        <p>Nenhum pagamento encontrado.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Usuário</th>
                        <th class="py-2 px-4 border-b">Valor</th>
                        <th class="py-2 px-4 border-b">Data Pagamento</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Método</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagamentos as $pagamento): ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?php echo $pagamento->id; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $pagamento->usuario_nome; ?></td>
                            <td class="py-2 px-4 border-b text-center">R$ <?php echo number_format($pagamento->valor, 2, ',', '.'); ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo date('d/m/Y H:i', strtotime($pagamento->data_pagamento)); ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo ucfirst($pagamento->status_pagamento); ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo ucfirst($pagamento->metodo_pagamento); ?></td>
                            <td class="py-2 px-4 border-b text-center" id="actions-<?php echo $pagamento->id; ?>">
                                <a href="<?php echo site_url('pagamentos/editar/' . $pagamento->id); ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-xs">Editar</a>
                                <a href="<?php echo site_url('pagamentos/delete/' . $pagamento->id); ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="return confirm('Tem certeza que deseja deletar este pagamento?');">Deletar</a>
                                <?php if ($pagamento->status_pagamento == 'pendente'): ?>
                                    <button type="button" class="simular-pagamento-btn bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs" data-id="<?php echo $pagamento->id; ?>">Simular Pagamento</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.simular-pagamento-btn').forEach(button => {
        button.addEventListener('click', function() {
            const pagamentoId = this.dataset.id;
            const originalButtonText = this.textContent;
            const statusCell = this.closest('tr').querySelector('td:nth-child(5)'); // Célula do status

            this.disabled = true;

            // Simulação visual no frontend
            this.textContent = 'Comunicando com plataforma...';
            setTimeout(() => {
                this.textContent = 'Validando pagamento...';
                setTimeout(() => {
                    this.textContent = 'Pagamento confirmado!';
                    // Após a simulação visual, faz a requisição real ao backend
                    fetch(`<?php echo site_url('pagamentos/simular_pagamento/'); ?>${pagamentoId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'sucesso') {
                                this.textContent = 'Pagamento Concluído!';
                                statusCell.innerHTML = '<span class="bg-green-200 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pago</span>';
                                this.remove(); // Remove o botão após o sucesso
                                alert(data.mensagem);
                            } else {
                                this.textContent = originalButtonText;
                                this.disabled = false;
                                alert('Erro na simulação: ' + data.mensagem);
                            }
                        })
                        .catch(error => {
                            console.error('Erro na requisição AJAX:', error);
                            this.textContent = originalButtonText;
                            this.disabled = false;
                            alert('Erro de comunicação com o servidor.');
                        });
                }, 1500); // Atraso para "Validando pagamento..."
            }, 1500); // Atraso para "Comunicando com plataforma..."
        });
    });
});
</script>
