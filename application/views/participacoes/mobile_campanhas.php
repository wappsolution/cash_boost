<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campanhas Disponíveis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .mobile-frame { 
            position: absolute; /* Alterado para absolute */
            top: 100px; /* Ajustado para ficar abaixo da navbar */
            left: 50%;
            transform: translateX(-50%); /* Apenas centralização horizontal */
            width: 375px; /* Largura de um iPhone X */
            height: 600px; /* Altura reduzida */
            border: 8px solid #333; 
            border-radius: 20px; 
            box-shadow: 0 0 15px rgba(0,0,0,0.2); 
            overflow: hidden; 
            background-color: white;
        }
        .mobile-header { background-color: #312e81; color: white; padding: 20px; text-align: center; font-size: 1.5rem; font-weight: bold; }
        .content-scroll { height: calc(100% - 60px); overflow-y: auto; } /* Altura do frame menos a altura do header */
        .campaign-card { border-bottom: 1px solid #e0e0e0; padding: 20px; margin-bottom: 15px; }
        .campaign-card:last-child { border-bottom: none; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="mobile-frame">
        <div class="mobile-header">Campanhas Disponíveis</div>
        <div class="p-5 content-scroll">
            <!-- Card Campeão de Resgates -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">🏆 Campeão de Resgates</h2>
                    <div class="text-yellow-500 text-2xl"><i class="fas fa-trophy"></i></div>
                </div>
                <p class="text-xl font-bold text-gray-900">Funcionário: <?php echo ($campeao_nome == $current_user_name) ? '<span class="text-blue-600">' . $campeao_nome . ' (Você!)</span>' : $campeao_nome; ?></p>
                <p class="text-xl font-bold text-gray-900 mb-2">Total Resgatado: R$ <?php echo number_format($campeao_resgatado, 2, ',', '.'); ?></p>
                <p class="text-sm text-gray-600">Parabéns, <?php echo $campeao_nome; ?>! Você é o destaque do mês!</p>
                <p class="text-sm text-gray-500">Continue participando das campanhas e você pode ser o próximo campeão!</p>
            </div>

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

            <?php if (empty($campanhas_disponiveis)): ?>
                <p class="text-gray-600 text-center text-base">Nenhuma campanha disponível no momento.</p>
            <?php else: ?>
                <?php foreach ($campanhas_disponiveis as $campanha): ?>
                    <div class="campaign-card bg-white rounded-lg shadow-md mb-6 p-6">
                        <h2 class="text-xl font-extrabold text-gray-900 mb-2">🏆 <?php echo $campanha->nome; ?></h2>
                        <p class="text-base text-gray-700 mb-3"><?php echo $campanha->descricao; ?></p>
                        <p class="text-sm text-gray-600">De: <?php echo date('d/m/Y', strtotime($campanha->data_inicio)); ?> até: <?php echo date('d/m/Y', strtotime($campanha->data_fim)); ?></p>
                        <p class="text-sm text-gray-600 mb-2">Recorrência: <?php echo ucfirst($campanha->recorrencia); ?></p>
                        <p class="text-lg font-bold text-green-600 mb-4">💰 Prêmio: R$ <?php echo number_format($campanha->premio, 2, ',', '.'); ?></p>
                        <a href="<?php echo site_url('participacoes/participar/' . $campanha->id); ?>" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-extrabold py-3 px-6 rounded-xl transition duration-200 text-lg">Quero Participar</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
