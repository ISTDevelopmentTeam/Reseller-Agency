//sidebar script shrink
document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const wrapper = document.getElementById('wrapper');
    const toggleIcon = sidebarToggle.querySelector('i');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault();
            wrapper.classList.toggle('toggled');

            // Toggle icon based on sidebar state
            if (wrapper.classList.contains('toggled')) {
                toggleIcon.classList.remove('fa-bars');
                toggleIcon.classList.add('fa-arrow-right');
            } else {
                toggleIcon.classList.remove('fa-arrow-right');
                toggleIcon.classList.add('fa-bars');
            }
        });
    }

    // Handle resize events to reset sidebar for mobile
    function handleResize() {
        if (window.innerWidth <= 768) {
            wrapper.classList.remove('toggled');
            toggleIcon.classList.remove('fa-arrow-right');
            toggleIcon.classList.add('fa-bars');
        }
    }

    window.addEventListener('resize', handleResize);
    handleResize();
});


//modal for profile and settings

document.addEventListener('DOMContentLoaded', function () {
    // Update the Profile link
    const profileLink = document.querySelector('.dropdown-item:nth-child(1)');
    profileLink.setAttribute('data-bs-toggle', 'modal');
    profileLink.setAttribute('data-bs-target', '#profileModal');

    // Update the Settings link
    const settingsLink = document.querySelector('.dropdown-item:nth-child(2)');
    settingsLink.setAttribute('data-bs-toggle', 'modal');
    settingsLink.setAttribute('data-bs-target', '#settingsModal');
});