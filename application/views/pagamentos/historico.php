<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-history mr-3"></i> Histórico de Pagamentos de <?php echo $usuario->nome; ?></h1>

    <?php if (empty($pagamentos)): ?>
        <p>Nenhum pagamento encontrado para este usuário.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Valor</th>
                        <th class="py-2 px-4 border-b">Data Pagamento</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Método</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagamentos as $pagamento): ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?php echo $pagamento->id; ?></td>
                            <td class="py-2 px-4 border-b text-center">R$ <?php echo number_format($pagamento->valor, 2, ',', '.'); ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo date('d/m/Y H:i', strtotime($pagamento->data_pagamento)); ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo ucfirst($pagamento->status_pagamento); ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo ucfirst($pagamento->metodo_pagamento); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <a href="<?php echo site_url('pagamentos'); ?>" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Voltar para a lista de pagamentos
    </a>
</div>
