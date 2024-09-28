// navbar section start

document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const navList = document.querySelector('.nav-list');
    
        menuToggle.addEventListener('click', function() {
            navList.classList.toggle('active');
        });
    
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = navList.contains(event.target) || menuToggle.contains(event.target);
            if (!isClickInside && navList.classList.contains('active')) {
                navList.classList.remove('active');
            }
        });
    });

// navbar section end