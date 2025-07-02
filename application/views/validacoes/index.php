<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-check-circle mr-3"></i> Validação de Metas</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="flex justify-end mb-4">
        <button id="toggleValidados" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Mostrar Validações Feitas
        </button>
    </div>

    <?php if (empty($participacoes)): ?>
        <p>Nenhuma participação encontrada.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200" id="tabelaValidacoes">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID Participação</th>
                        <th class="py-2 px-4 border-b">Campanha</th>
                        <th class="py-2 px-4 border-b">Usuário</th>
                        <th class="py-2 px-4 border-b">Data Participação</th>
                        <th class="py-2 px-4 border-b">Prêmio</th>
                        <th class="py-2 px-4 border-b">Status Validação</th>
                        <th class="py-2 px-4 border-b">Observação</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($participacoes as $participacao): ?>
                        <tr class="<?php echo ($participacao->status_participacao != 'pendente') ? 'validado-row hidden' : ''; ?>">
                            <td class="py-2 px-4 border-b text-center"><?php echo $participacao->participacao_id; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $participacao->campanha_nome; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $participacao->usuario_nome; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo date('d/m/Y H:i', strtotime($participacao->data_participacao)); ?></td>
                            <td class="py-2 px-4 border-b text-center">R$ <?php echo number_format($participacao->premio, 2, ',', '.'); ?></td>
                            <td class="py-2 px-4 border-b text-center">
                                <?php if ($participacao->status_participacao == 'pendente'): ?>
                                    <span class="bg-yellow-200 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pendente</span>
                                <?php elseif ($participacao->meta_atingida == 1): ?>
                                    <span class="bg-green-200 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Aprovada</span>
                                <?php else: ?>
                                    <span class="bg-red-200 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Rejeitada</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-2 px-4 border-b"><?php echo $participacao->observacao; ?></td>
                            <td class="py-2 px-4 border-b text-center">
                                <?php if ($participacao->status_participacao == 'pendente'): ?>
                                    <a href="<?php echo site_url('validacoes/validar/' . $participacao->participacao_id); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">Validar Meta</a>
                                <?php else: ?>
                                    <a href="<?php echo site_url('validacoes/validar/' . $participacao->participacao_id); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded text-xs">Ver Validação</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleValidados');
    const validadoRows = document.querySelectorAll('.validado-row');
    let showingValidados = false;

    toggleButton.addEventListener('click', function() {
        showingValidados = !showingValidados;
        validadoRows.forEach(row => {
            if (showingValidados) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        });
        this.textContent = showingValidados ? 'Esconder Validações Feitas' : 'Mostrar Validações Feitas';
    });
});
</script>
</div>
