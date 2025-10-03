// script.js
// Fitur: Pencarian resep, smooth scroll, modal pop-up

document.addEventListener('DOMContentLoaded', function() {
    // Pencarian Resep
    const searchForm = document.querySelector('.search-bar');
    const searchInput = document.querySelector('.search-input');
    const cards = document.querySelectorAll('.card-featured');

    // Cek jika elemen pencarian ada di halaman
    if (searchForm && searchInput && cards.length > 0) {
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
    }

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

    // Fitur Modal Pop-up Resep
    const overlay = document.getElementById('recipe-modal-overlay');
    const modal = document.getElementById('recipe-modal');
    
    // Cek jika elemen modal ada
    if (overlay && modal) {
        const closeBtn = document.querySelector('.close-btn');
        const modalImg = document.getElementById('modal-img');
        const modalTitle = document.getElementById('modal-title');
        const modalDesc = document.getElementById('modal-desc');
        const recipeCards = document.querySelectorAll('.recipe-card-clickable');

        // Fungsi untuk membuka modal
        function openModal(title, image, desc) {
            modalTitle.textContent = title;
            modalImg.src = image;
            modalImg.alt = title;
            modalDesc.textContent = desc;
            overlay.style.display = 'flex';
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            overlay.style.display = 'none';
        }

        // Tambahkan event listener untuk setiap kartu resep
        recipeCards.forEach(card => {
            card.addEventListener('click', function() {
                const title = this.dataset.title;
                const image = this.dataset.image;
                const desc = this.dataset.desc;
                openModal(title, image, desc);
            });
        });

        // Event listener untuk tombol tutup (X)
        if(closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        // Event listener untuk menutup modal jika klik di luar area pop-up
        overlay.addEventListener('click', function(event) {
            if (event.target === overlay) {
                closeModal();
            }
        });
    }
});