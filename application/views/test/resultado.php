<div class="mt-4 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h2 class="text-xl font-semibold mb-2">Resultado do Teste: <?php echo $descricao; ?></h2>
    <pre class="bg-gray-200 p-3 rounded-md text-sm overflow-auto"><?php print_r($resultado); ?></pre>
    <a href="<?php echo site_url('test'); ?>" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Voltar para a lista de testes
    </a>
</div>
