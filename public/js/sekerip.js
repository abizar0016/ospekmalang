document.addEventListener('DOMContentLoaded', function() {
    const search_btn = document.querySelector(".icon-header-item");
    const search_inpt = document.querySelector(".search-input");

    search_btn.addEventListener('click', ()=>{
        search_inpt.classList.add("active");
    });
});

function toggleSearch() {
    const search_inpt = document.querySelector(".search-input");
    search_inpt.classList.toggle("active");
}


document.addEventListener('DOMContentLoaded', function() {
    const search_btn = document.querySelector(".icon-header-item");
    const search_inpt = document.querySelector(".search-input-mobile");

    search_btn.addEventListener('click', ()=>{
        search_inpt.classList.add("active");
    });
});


function getConnectionType() {
    if ('connection' in navigator) {
        const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
        return connection.effectiveType || 'unknown';
    }
    return 'unknown';
}

// Menampilkan loading screen sesuai dengan jenis koneksi
function handleLoadingScreen() {
    const connectionType = getConnectionType();
    const loadingScreen = document.getElementById('loading-screen');
    const body = document.body;

    // Tampilkan loading screen
    loadingScreen.style.display = 'flex';
    body.classList.add('no-scroll'); // Mencegah scrolling

    if (connectionType === 'slow-2g' || connectionType === '2g') {
        // Durasi loading yang lebih lama untuk koneksi yang lambat
        setTimeout(() => {
            loadingScreen.style.display = 'none';
            body.classList.remove('no-scroll'); // Mengizinkan scrolling setelah loading selesai
        }, 3000); // 3 detik delay untuk koneksi lambat
    } else {
        // Durasi loading yang lebih pendek untuk koneksi yang lebih cepat
        setTimeout(() => {
            loadingScreen.style.display = 'none';
            body.classList.remove('no-scroll'); // Mengizinkan scrolling setelah loading selesai
        }, 1000); // 1 detik delay untuk koneksi cepat
    }
}

// Menjalankan fungsi saat window dimuat
window.addEventListener('load', handleLoadingScreen);

const categoryButtons = document.querySelectorAll('.category-button');
const items = document.querySelectorAll('.item');

categoryButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Set active button
        categoryButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        // Get selected category
        const selectedCategory = button.getAttribute('data-category');

        // Show items of selected category
        items.forEach(item => {
            if (item.classList.contains(selectedCategory)) {
                item.classList.add('visible');
            } else {
                item.classList.remove('visible');
            }
        });
    });
});

