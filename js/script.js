document.addEventListener('DOMContentLoaded', function() {
    // Ambil elemen ikon
    const toggleButton = document.getElementById('icon');
    
    // Ambil body element
    const body = document.body;

    // Cek preferensi mode dari localStorage
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        body.classList.add(savedTheme);
        if (savedTheme === 'dark-mode') {
            toggleButton.classList.replace('fa-sun', 'fa-moon');
        }
    }

    function toggleMode() {
        // Toggle dark mode
        document.body.classList.toggle('dark-mode');
        
        // Ganti ikon
        const icon = document.getElementById('icon');
        if (document.body.classList.contains('dark-mode')) {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        } else {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }
    }
    

    // Event listener untuk ikon mode
    toggleButton.addEventListener('click', toggleMode);
});
