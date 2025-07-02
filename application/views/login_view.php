<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cash Boost</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Cash Boost</h2>
        <form action="<?php echo base_url('login/authenticate'); ?>" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="seu@email.com" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Senha</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="********" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Entrar
                </button>
            </div>
        </form>

        <div class="mt-8 border-t pt-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Dados de Teste</h3>
            <p class="text-sm text-gray-600">Email: <code class="bg-gray-200 p-1 rounded">admin@cashboost.com</code></p>
            <p class="text-sm text-gray-600">Senha: <code class="bg-gray-200 p-1 rounded">123456</code></p>
            <button onclick="fillTestData()" class="mt-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Preencher Dados
            </button>
        </div>
    </div>

    <script>
        function fillTestData() {
            document.getElementById('email').value = 'admin@cashboost.com';
            document.getElementById('password').value = '123456';
        }
    </script>
</body>
</html>
