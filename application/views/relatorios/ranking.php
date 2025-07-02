<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-trophy mr-3"></i> Ranking de Resgates e Participação</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <?php if (empty($ranking_data)): ?>
            <p>Nenhum dado de ranking disponível.</p>
        <?php else: ?>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Posição</th>
                        <th class="py-2 px-4 border-b">Funcionário</th>
                        <th class="py-2 px-4 border-b">Total Resgatado</th>
                        <th class="py-2 px-4 border-b">Participações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $posicao = 1; ?>
                    <?php foreach ($ranking_data as $item): ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?php echo $posicao++; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $item['nome']; ?></td>
                            <td class="py-2 px-4 border-b text-center">R$ <?php echo number_format($item['resgates'], 2, ',', '.'); ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $item['participacoes']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <a href="<?php echo site_url('relatorios'); ?>" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Voltar para Relatórios
    </a>
</div>
