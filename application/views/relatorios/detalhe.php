<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-chart-line mr-3"></i> Detalhes do Relatório: <?php echo ucfirst(str_replace('_', ' ', $tipo_relatorio)); ?></h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-gray-700">Esta é a tela de detalhes para o relatório de <strong><?php echo ucfirst(str_replace('_', ' ', $tipo_relatorio)); ?></strong>.</p>
        <p class="text-gray-700 mt-2">Aqui você poderá implementar a lógica específica para exibir os dados e gráficos deste relatório.</p>
        
        <!-- AIDEV-TODO: Adicionar filtros e conteúdo real do relatório aqui -->

        <a href="<?php echo site_url('relatorios'); ?>" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Voltar para Relatórios
        </a>
    </div>
</div>
