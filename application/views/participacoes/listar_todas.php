<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-users-cog mr-3"></i> Todas as Participações</h1>

    <?php if (empty($participacoes)): ?>
        <p>Nenhuma participação encontrada.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Campanha</th>
                        <th class="py-2 px-4 border-b">Usuário</th>
                        <th class="py-2 px-4 border-b">Data Participação</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($participacoes as $participacao): ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?php echo $participacao->id; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $participacao->campanha_nome; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $participacao->usuario_nome; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo date('d/m/Y H:i', strtotime($participacao->data_participacao)); ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo ucfirst($participacao->status_participacao); ?></td>
                            <td class="py-2 px-4 border-b text-center">
                                <!-- AIDEV-TODO: Adicionar ações como editar status da participação, etc. -->
                                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">Detalhes</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
