<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Registrar Novo Pagamento</h1>

    <?php echo validation_errors('<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">', '</div>'); ?>

    <?php echo form_open('pagamentos/store'); ?>
        <div class="mb-4">
            <label for="usuario_id" class="block text-gray-700 text-sm font-bold mb-2">Usuário:</label>
            <select name="usuario_id" id="usuario_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Selecione um usuário</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?php echo $usuario->id; ?>" <?php echo set_select('usuario_id', $usuario->id); ?>><?php echo $usuario->nome; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="valor" class="block text-gray-700 text-sm font-bold mb-2">Valor:</label>
            <input type="number" step="0.01" name="valor" id="valor" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('valor'); ?>">
        </div>

        <div class="mb-4">
            <label for="data_pagamento" class="block text-gray-700 text-sm font-bold mb-2">Data do Pagamento:</label>
            <input type="datetime-local" name="data_pagamento" id="data_pagamento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('data_pagamento'); ?>">
        </div>

        <div class="mb-4">
            <label for="status_pagamento" class="block text-gray-700 text-sm font-bold mb-2">Status do Pagamento:</label>
            <select name="status_pagamento" id="status_pagamento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="pendente" <?php echo set_select('status_pagamento', 'pendente'); ?>>Pendente</option>
                <option value="pago" <?php echo set_select('status_pagamento', 'pago'); ?>>Pago</option>
                <option value="cancelado" <?php echo set_select('status_pagamento', 'cancelado'); ?>>Cancelado</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="metodo_pagamento" class="block text-gray-700 text-sm font-bold mb-2">Método de Pagamento:</label>
            <select name="metodo_pagamento" id="metodo_pagamento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="pix" <?php echo set_select('metodo_pagamento', 'pix'); ?>>Pix</option>
                <option value="cartao" <?php echo set_select('metodo_pagamento', 'cartao'); ?>>Cartão</option>
                <option value="boleto" <?php echo set_select('metodo_pagamento', 'boleto'); ?>>Boleto</option>
                <option value="manual" <?php echo set_select('metodo_pagamento', 'manual'); ?>>Manual</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Salvar Pagamento
            </button>
            <a href="<?php echo site_url('pagamentos'); ?>" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancelar
            </a>
        </div>
    <?php echo form_close(); ?>
</div>
