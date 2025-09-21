/**
 * JavaScript für die Blog-Archivseite.
 * Steuert den interaktiven Kategorie-Filter.
 */
document.addEventListener('DOMContentLoaded', function() {
    const blogWrapper = document.querySelector('.hu-blog-wrapper');
    if (!blogWrapper) {
        return;
    }

    const filterButtons = blogWrapper.querySelectorAll('.hu-filter-btn');
    const postCards = blogWrapper.querySelectorAll('.post-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Aktiven Status der Buttons verwalten
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;

            // Karten ein- oder ausblenden
            postCards.forEach(card => {
                if (filter === 'all') {
                    card.classList.remove('hide');
                    return;
                }
                const categories = JSON.parse(card.getAttribute('data-categories') || '[]');
                if (categories.includes(filter)) {
                    card.classList.remove('hide');
                } else {
                    card.classList.add('hide');
                }
            });
        });
    });
});