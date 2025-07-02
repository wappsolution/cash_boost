<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cash Boost</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased h-full">
    <div class="min-h-screen flex flex-col">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
            <div class="flex items-center">
                <button id="sidebarToggle" class="text-gray-600 focus:outline-none mr-4">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <a href="<?php echo site_url('dashboard'); ?>" class="text-xl font-semibold text-gray-800 hover:text-gray-600">Cash Boost Admin</a>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Bem-vindo, <?php echo $this->session->userdata('user_name'); ?>!</span>
                <a href="<?php echo base_url('login/logout'); ?>" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </header>

        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside id="sidebar" class="w-64 bg-gray-800 text-white p-6 space-y-6 transition-all duration-300 ease-in-out">
                <nav>
                    <a href="<?php echo site_url('dashboard'); ?>" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white flex items-center">
                        <i class="fas fa-tachometer-alt mr-3"></i> <span class="menu-text">Dashboard</span>
                    </a>
                    <a href="<?php echo site_url('campanhas'); ?>" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white flex items-center">
                        <i class="fas fa-bullhorn mr-3"></i> <span class="menu-text">Campanhas</span>
                    </a>
                    <a href="<?php echo site_url('usuarios'); ?>" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white flex items-center">
                        <i class="fas fa-users mr-3"></i> <span class="menu-text">Usuários</span>
                    </a>
                    <a href="<?php echo site_url('pagamentos'); ?>" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white flex items-center">
                        <i class="fas fa-dollar-sign mr-3"></i> <span class="menu-text">Pagamentos</span>
                    </a>
                    <div class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white flex items-center cursor-pointer">
                        <i class="fas fa-users-cog mr-3"></i> <span class="menu-text">Participações</span>
                    </div>
                    <a href="<?php echo site_url('participacoes/ativas'); ?>" class="block py-2.5 pl-10 pr-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white flex items-center text-sm">
                        <i class="fas fa-chart-pie mr-3"></i> <span class="menu-text">Ativas (Cards)</span>
                    </a>
                    <a href="<?php echo site_url('participacoes'); ?>" class="block py-2.5 pl-10 pr-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white flex items-center text-sm">
                        <i class="fas fa-mobile-alt mr-3"></i> <span class="menu-text">Mobile (Simulador)</span>
                    </a>
                    <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white flex items-center">
                        <i class="fas fa-chart-line mr-3"></i> <span class="menu-text">Relatórios</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Content Area -->
            <main id="mainContent" class="flex-1 p-6 h-full bg-white transition-all duration-300 ease-in-out">
