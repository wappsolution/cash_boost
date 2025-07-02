<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-table mr-3"></i> Relatório de Dados Detalhados</h1>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Filtros</h2>
        <?php echo form_open('relatorios/dados_detalhados', ['method' => 'get', 'class' => 'flex flex-wrap items-end -mx-2']); ?>
            <div class="px-2 mb-4">
                <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Data Início:</label>
                <input type="date" name="start_date" id="start_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('start_date', $start_date); ?>">
            </div>
            <div class="px-2 mb-4">
                <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">Data Fim:</label>
                <input type="date" name="end_date" id="end_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('end_date', $end_date); ?>">
            </div>
            <div class="px-2 mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Aplicar Filtros
                </button>
            </div>
            <div class="px-2 mb-4">
                <a href="<?php echo site_url('relatorios/export_dados_detalhados_csv') . '?start_date=' . $start_date . '&end_date=' . $end_date; ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                    <i class="fas fa-download mr-2"></i> Exportar CSV
                </a>
            </div>
        <?php echo form_close(); ?>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Dados do Relatório</h2>
        <?php if (empty($report_data)): ?>
            <p>Nenhum dado encontrado para o período selecionado.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Data</th>
                            <th class="py-2 px-4 border-b">Item</th>
                            <th class="py-2 px-4 border-b">Valor</th>
                            <th class="py-2 px-4 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($report_data as $row): ?>
                            <tr>
                                <td class="py-2 px-4 border-b text-center"><?php echo $row['data']; ?></td>
                                <td class="py-2 px-4 border-b"><?php echo $row['item']; ?></td>
                                <td class="py-2 px-4 border-b text-center">R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?></td>
                                <td class="py-2 px-4 border-b text-center"><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <a href="<?php echo site_url('relatorios'); ?>" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Voltar para Relatórios
    </a>
</div>
