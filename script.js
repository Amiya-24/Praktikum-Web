// script.js
// Fitur: Pencarian resep, smooth scroll, highlight menu aktif

document.addEventListener('DOMContentLoaded', function() {
    // Pencarian Resep
    const searchForm = document.querySelector('.search-bar');
    const searchInput = document.querySelector('.search-input');
    const cards = document.querySelectorAll('.card-featured');


    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const query = searchInput.value.toLowerCase();
        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const desc = card.querySelector('.card-desc').textContent.toLowerCase();
            if (title.includes(query) || desc.includes(query)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Smooth Scroll Navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href').slice(1);
            const target = document.getElementById(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Highlight Menu Aktif Saat Scroll
    const navLinks = document.querySelectorAll('.nav a');
    const sections = ['home', 'about', 'footer'].map(id => document.getElementById(id));
    window.addEventListener('scroll', function() {
        let current = '';
        sections.forEach(section => {
            if (section && window.scrollY >= section.offsetTop - 80) {
                current = section.id;
            }
        });
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });
});
