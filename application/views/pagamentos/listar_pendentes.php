<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-exclamation-triangle mr-3"></i> Pagamentos Pendentes</h1>

    <?php if (empty($pagamentos)): ?>
        <p>Nenhum pagamento pendente encontrado.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Usuário</th>
                        <th class="py-2 px-4 border-b">Valor</th>
                        <th class="py-2 px-4 border-b">Data Pagamento</th>
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
                            <td class="py-2 px-4 border-b text-center"><?php echo ucfirst($pagamento->metodo_pagamento); ?></td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="<?php echo site_url('pagamentos/updateStatus/' . $pagamento->id . '/pago'); ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs">Marcar como Pago</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
