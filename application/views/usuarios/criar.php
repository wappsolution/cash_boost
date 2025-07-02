<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Criar Novo Usuário</h1>

    <?php echo validation_errors('<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">', '</div>'); ?>

    <?php echo form_open('usuarios/store'); ?>
        <div class="mb-4">
            <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
            <input type="text" name="nome" id="nome" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('nome'); ?>">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo set_value('email'); ?>">
        </div>

        <div class="mb-4">
            <label for="senha" class="block text-gray-700 text-sm font-bold mb-2">Senha:</label>
            <input type="password" name="senha" id="senha" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="perfil" class="block text-gray-700 text-sm font-bold mb-2">Perfil:</label>
            <select name="perfil" id="perfil" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="admin" <?php echo set_select('perfil', 'admin'); ?>>Admin</option>
                <option value="supervisor" <?php echo set_select('perfil', 'supervisor'); ?>>Supervisor</option>
                <option value="financeiro" <?php echo set_select('perfil', 'financeiro'); ?>>Financeiro</option>
                <option value="usuario" <?php echo set_select('perfil', 'usuario'); ?>>Usuário</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Salvar Usuário
            </button>
            <a href="<?php echo site_url('usuarios'); ?>" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancelar
            </a>
        </div>
    <?php echo form_close(); ?>
</div>
