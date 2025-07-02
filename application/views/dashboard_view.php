<h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-tachometer-alt mr-3"></i> Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <!-- Card Campeão de Resgates -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">🏆 Campeão de Resgates</h2>
            <div class="text-yellow-500 text-2xl"><i class="fas fa-trophy"></i></div>
        </div>
        <p class="text-xl font-bold text-gray-900">Funcionário: <?php echo $campeao_nome; ?></p>
        <p class="text-xl font-bold text-gray-900 mb-2">Total Resgatado: R$ <?php echo number_format($campeao_resgatado, 2, ',', '.'); ?></p>
        <p class="text-sm text-gray-600">Parabéns, <?php echo $campeao_nome; ?>! Você é o destaque do mês!</p>
        <p class="text-sm text-gray-500">Continue participando das campanhas e você pode ser o próximo campeão!</p>
    </div>

    <!-- Card 1 -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Total Gasto</h2>
            <div class="text-green-500 text-2xl"><i class="fas fa-dollar-sign"></i></div>
        </div>
        <p class="text-3xl font-bold text-gray-900">R$ <?php echo number_format($total_gasto, 2, ',', '.'); ?></p>
        <p class="text-sm text-gray-500">+5% desde o mês passado</p>
    </div>

    <!-- Card 2 -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Campanhas Ativas</h2>
            <div class="text-blue-500 text-2xl"><i class="fas fa-bullhorn"></i></div>
        </div>
        <p class="text-3xl font-bold text-gray-900"><?php echo $campanhas_ativas; ?></p>
                <p class="text-sm text-gray-500"><?php echo $novas_campanhas_semana; ?> novas campanhas esta semana</p>
    </div>

    <!-- Card 3 -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Participações</h2>
            <div class="text-purple-500 text-2xl"><i class="fas fa-users"></i></div>
        </div>
        <p class="text-3xl font-bold text-gray-900"><?php echo $total_participacoes; ?></p>
        <p class="text-sm text-gray-500">+12% em relação ao ano passado</p>
    </div>
</div>

<!-- Recent Activity Section -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Atividade Recente</h2>
    <ul class="divide-y divide-gray-200">
        <li class="py-3 flex justify-between items-center">
            <span class="text-gray-700">Nova campanha "Verão Premiado" criada.</span>
            <span class="text-gray-500 text-sm">Há 2 horas</span>
        </li>
        <li class="py-3 flex justify-between items-center">
            <span class="text-gray-700">Pagamento de R$ 50,00 para João Silva.</span>
            <span class="text-gray-500 text-sm">Há 1 dia</span>
        </li>
        <li class="py-3 flex justify-between items-center">
            <span class="text-gray-700">Meta da campanha "Pontualidade" validada para Maria Souza.</span>
            <span class="text-gray-500 text-sm">Há 3 dias</span>
        </li>
    </ul>
</div>