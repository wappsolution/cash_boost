<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-chart-line mr-3"></i> Relatórios Disponíveis</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (empty($relatorios)): ?>
            <p>Nenhum relatório disponível.</p>
        <?php else: ?>
            <?php foreach ($relatorios as $relatorio): ?>
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                            <i class="<?php echo $relatorio['icone']; ?> mr-3 text-blue-600"></i> <?php echo $relatorio['titulo']; ?>
                        </h2>
                        <p class="text-gray-600 mb-4"><?php echo $relatorio['descricao']; ?></p>
                    </div>
                    <a href="<?php echo $relatorio['url']; ?>" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center inline-block">
                        Ver Relatório
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
