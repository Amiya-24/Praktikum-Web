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


    // Fitur Modal Pop-up Resep
    const overlay = document.getElementById('recipe-modal-overlay');
    const modal = document.getElementById('recipe-modal');
    const closeBtn = document.querySelector('.close-btn');

    const modalImg = document.getElementById('modal-img');
    const modalTitle = document.getElementById('modal-title');
    const modalDesc = document.getElementById('modal-desc');

    const recipeCards = document.querySelectorAll('.recipe-card-clickable');

    // Fungsi untuk membuka modal
    function openModal(title, image, desc) {
        // Isi konten modal dengan data dari kartu yang diklik
        modalTitle.textContent = title;
        modalImg.src = image;
        modalImg.alt = title; // Tambahkan alt text untuk aksesibilitas
        modalDesc.textContent = desc;
        
        // Tampilkan modal
        overlay.style.display = 'flex';
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        overlay.style.display = 'none';
    }

    // Tambahkan event listener untuk setiap kartu resep
    recipeCards.forEach(card => {
        card.addEventListener('click', function() {
            // Ambil data dari atribut data-* kartu yang diklik
            const title = this.dataset.title;
            const image = this.dataset.image;
            const desc = this.dataset.desc;
            
            // Buka modal dengan data tersebut
            openModal(title, image, desc);
        });
    });

    // Event listener untuk tombol tutup (X)
    closeBtn.addEventListener('click', closeModal);

    // Event listener untuk menutup modal jika klik di luar area pop-up (di overlay)
    overlay.addEventListener('click', function(event) {
        if (event.target === overlay) {
            closeModal();
        }
    });
});