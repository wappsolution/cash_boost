<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-list-alt mr-3"></i> Campanhas Ativas</h1>

    <?php if (empty($campanhas_ativas)): ?>
        <p>Nenhuma campanha ativa encontrada.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($campanhas_ativas as $campanha): ?>
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">🏆 <?php echo $campanha->nome; ?></h2>
                    <p class="text-gray-600 mb-2"><?php echo $campanha->descricao; ?></p>
                    <p class="text-sm text-gray-500">Prêmio: R$ <?php echo number_format($campanha->premio, 2, ',', '.'); ?></p>
                    <p class="text-sm text-gray-500">Participantes: <?php echo $campanha->total_participantes; ?></p>
                    <p class="text-sm font-semibold <?php echo ($campanha->dias_restantes <= 7 && $campanha->dias_restantes >= 0) ? 'text-red-500' : 'text-gray-500'; ?>">
                        <?php 
                            if ($campanha->dias_restantes > 0) {
                                echo '⏳ Faltam ' . $campanha->dias_restantes . ' dias';
                            } elseif ($campanha->dias_restantes == 0) {
                                echo '⏰ Último dia!';
                            } else {
                                echo '✅ Encerrada';
                            }
                        ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
