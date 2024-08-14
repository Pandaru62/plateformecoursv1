document.addEventListener('DOMContentLoaded', function() {
    const toggles = document.querySelectorAll('main .dropdown-toggle');
    
    toggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent the click from closing the dropdown immediately
            const menu = toggle.nextElementSibling;
            menu.classList.toggle('show');
        });
    });

    // Close dropdowns if clicking outside of them
    document.addEventListener('click', function(e) {
        toggles.forEach(function(toggle) {
            const menu = toggle.nextElementSibling;
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('show');
            }
        });
    });
});
