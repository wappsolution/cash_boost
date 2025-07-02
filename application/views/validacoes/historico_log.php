<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-history mr-3"></i> Histórico de Validações da Participação #<?php echo $participacao_id; ?></h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <?php if (empty($logs)): ?>
            <p>Nenhum log encontrado para esta participação.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">ID Log</th>
                            <th class="py-2 px-4 border-b">Ação</th>
                            <th class="py-2 px-4 border-b">Supervisor</th>
                            <th class="py-2 px-4 border-b">Observação</th>
                            <th class="py-2 px-4 border-b">Data/Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td class="py-2 px-4 border-b text-center"><?php echo $log->id; ?></td>
                                <td class="py-2 px-4 border-b"><?php echo ucfirst(str_replace('_', ' ', $log->acao)); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo $log->usuario_nome; ?></td>
                                <td class="py-2 px-4 border-b"><?php echo $log->observacao; ?></td>
                                <td class="py-2 px-4 border-b text-center"><?php echo date('d/m/Y H:i', strtotime($log->created_at)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <a href="<?php echo site_url('validacoes/validar/' . $participacao_id); ?>" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Voltar para Validação
    </a>
</div>
