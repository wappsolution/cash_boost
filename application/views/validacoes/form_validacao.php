<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-clipboard-check mr-3"></i> Validar Meta</h1>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Detalhes da Participação</h2>
            <a href="<?php echo site_url('validacoes/historico_log/' . $participacao->id); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-1 px-2 rounded text-xs inline-flex items-center">
                <i class="fas fa-history mr-1"></i> Histórico
            </a>
        </div>
        <p><strong>Campanha:</strong> <?php echo $participacao->campanha_nome; ?></p>
        <p><strong>Usuário:</strong> <?php echo $participacao->usuario_nome; ?></p>
        <p><strong>Data da Participação:</strong> <?php echo date('d/m/Y H:i', strtotime($participacao->data_participacao)); ?></p>
        <p><strong>Prêmio da Campanha:</strong> R$ <?php echo number_format($participacao->premio, 2, ',', '.'); ?></p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Resultado da Validação</h2>
        <?php echo form_open('validacoes/processar_validacao'); ?>
            <input type="hidden" name="participacao_id" value="<?php echo $participacao->id; ?>">

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Meta Atingida?</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="meta_atingida" value="1" <?php echo set_radio('meta_atingida', '1'); ?>>
                        <span class="ml-2">Sim</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" class="form-radio" name="meta_atingida" value="0" <?php echo set_radio('meta_atingida', '0'); ?>>
                        <span class="ml-2">Não</span>
                    </label>
                </div>
                <?php echo form_error('meta_atingida', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
            </div>

            <div class="mb-4">
                <label for="observacao" class="block text-gray-700 text-sm font-bold mb-2">Observação (opcional, se não atingiu a meta):</label>
                <textarea name="observacao" id="observacao" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo set_value('observacao'); ?></textarea>
                <?php echo form_error('observacao', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Processar Validação
                </button>
                <a href="<?php echo site_url('validacoes'); ?>" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancelar
                </a>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
