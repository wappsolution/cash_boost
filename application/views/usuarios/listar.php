<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-users mr-3"></i> Lista de Usuários</h1>
    <a href="<?php echo site_url('usuarios/criar'); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Criar Novo Usuário</a>

    <?php if (empty($usuarios)): ?>
        <p>Nenhum usuário encontrado.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nome</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Perfil</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?php echo $usuario->id; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $usuario->nome; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $usuario->email; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $usuario->perfil; ?></td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="<?php echo site_url('usuarios/editar/' . $usuario->id); ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-xs">Editar</a>
                                <a href="<?php echo site_url('usuarios/delete/' . $usuario->id); ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="return confirm('Tem certeza que deseja deletar este usuário?');">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
