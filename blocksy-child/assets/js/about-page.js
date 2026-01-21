document.addEventListener('DOMContentLoaded', function () {
    var sections = document.querySelectorAll('.nexus-about section[id]');
    var navLinks = document.querySelectorAll('.nexus-about .smart-nav a');

    if (!sections.length || !navLinks.length) {
        return;
    }

    function setActiveLink() {
        var current = '';

        sections.forEach(function (section) {
            var sectionTop = section.offsetTop;
            if (window.scrollY >= sectionTop - 300) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(function (link) {
            link.classList.remove('active');
            if (current && link.getAttribute('href').indexOf('#' + current) !== -1) {
                link.classList.add('active');
            }
        });
    }

    setActiveLink();
    window.addEventListener('scroll', setActiveLink, { passive: true });
});
