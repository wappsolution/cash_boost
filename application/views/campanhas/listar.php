<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-bullhorn mr-3"></i> Lista de Campanhas</h1>
    <a href="<?php echo site_url('campanhas/criar'); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Criar Nova Campanha</a>

    <?php if (empty($campanhas)): ?>
        <p>Nenhuma campanha encontrada.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nome</th>
                        <th class="py-2 px-4 border-b">Descrição</th>
                        <th class="py-2 px-4 border-b">Data Início</th>
                        <th class="py-2 px-4 border-b">Data Fim</th>
                        <th class="py-2 px-4 border-b">Recorrência</th>
                        <th class="py-2 px-4 border-b">Gasto</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($campanhas as $campanha): ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?php echo $campanha->id; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $campanha->nome; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $campanha->descricao; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $campanha->data_inicio; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $campanha->data_fim; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $campanha->recorrencia; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo number_format($campanha->gasto, 2, ',', '.'); ?></td>
                            <td class="py-2 px-4 border-b text-center">
                                <?php if ($campanha->status == 1): ?>
                                    <span class="bg-green-200 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Ativa</span>
                                <?php else: ?>
                                    <span class="bg-red-200 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inativa</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="<?php echo site_url('campanhas/editar/' . $campanha->id); ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-xs">Editar</a>
                                <a href="<?php echo site_url('campanhas/delete/' . $campanha->id); ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="return confirm('Tem certeza que deseja deletar esta campanha?');">Deletar</a>
                                <?php if ($campanha->status == 1): ?>
                                    <a href="<?php echo site_url('campanhas/toggleStatus/' . $campanha->id . '/0'); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded text-xs">Desativar</a>
                                <?php else: ?>
                                    <a href="<?php echo site_url('campanhas/toggleStatus/' . $campanha->id . '/1'); ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs">Ativar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
