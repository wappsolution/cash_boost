            </main>
        </div>
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const menuTexts = document.querySelectorAll('.menu-text');

            sidebar.classList.toggle('w-64');
            sidebar.classList.toggle('w-20'); // Largura para menu recolhido
            sidebar.classList.toggle('p-6');
            sidebar.classList.toggle('p-2'); // Padding para menu recolhido

            menuTexts.forEach(text => {
                text.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>
