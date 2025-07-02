<ul class="list-disc pl-5 mb-4">
    <?php foreach ($testes as $teste): ?>
        <li class="mb-2">
            <a href="<?php echo site_url('test/' . $teste['metodo']); ?>" class="text-blue-500 hover:underline">
                <?php echo $teste['label']; ?>
            </a>
            <p class="text-gray-600 text-sm"><?php echo $teste['descricao']; ?></p>
        </li>
    <?php endforeach; ?>
</ul>
