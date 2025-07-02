<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Campanha</h1>

    <?php echo validation_errors('<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">', '</div>'); ?>

    <?php echo form_open('campanhas/update/' . $campanha->id); ?>
        <div class="mb-4">
            <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome da Campanha:</label>
            <input type="text" name="nome" id="nome" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('nome', $campanha->nome); ?>">
        </div>

        <div class="mb-4">
            <label for="descricao" class="block text-gray-700 text-sm font-bold mb-2">Descrição:</label>
            <textarea name="descricao" id="descricao" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo set_value('descricao', $campanha->descricao); ?></textarea>
        </div>

        <div class="mb-4">
            <label for="data_inicio" class="block text-gray-700 text-sm font-bold mb-2">Data de Início:</label>
            <input type="date" name="data_inicio" id="data_inicio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('data_inicio', $campanha->data_inicio); ?>">
        </div>

        <div class="mb-4">
            <label for="data_fim" class="block text-gray-700 text-sm font-bold mb-2">Data de Fim:</label>
            <input type="date" name="data_fim" id="data_fim" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('data_fim', $campanha->data_fim); ?>">
        </div>

        <div class="mb-4">
            <label for="recorrencia" class="block text-gray-700 text-sm font-bold mb-2">Recorrência:</label>
            <select name="recorrencia" id="recorrencia" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="diaria" <?php echo set_select('recorrencia', 'diaria', ($campanha->recorrencia == 'diaria')); ?>>Diária</option>
                <option value="semanal" <?php echo set_select('recorrencia', 'semanal', ($campanha->recorrencia == 'semanal')); ?>>Semanal</option>
                <option value="mensal" <?php echo set_select('recorrencia', 'mensal', ($campanha->recorrencia == 'mensal')); ?>>Mensal</option>
                <option value="unica" <?php echo set_select('recorrencia', 'unica', ($campanha->recorrencia == 'unica')); ?>>Única</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="gasto" class="block text-gray-700 text-sm font-bold mb-2">Gasto:</label>
            <input type="number" step="0.01" name="gasto" id="gasto" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('gasto', $campanha->gasto); ?>">
        </div>

        <div class="mb-4">
            <label for="premio" class="block text-gray-700 text-sm font-bold mb-2">Prêmio:</label>
            <input type="number" step="0.01" name="premio" id="premio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('premio', $campanha->premio); ?>">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Atualizar Campanha
            </button>
            <a href="<?php echo site_url('campanhas'); ?>" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancelar
            </a>
        </div>
    <?php echo form_close(); ?>
</div>
