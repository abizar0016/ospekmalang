// Hover
let list = document.querySelectorAll(".navigation li");

function activeLink() {
    list.forEach((item) => {
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

// Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};

function formatRupiah(angka, prefix) {
    let number_string = angka.replace(/[^,\d]/g, '').toString();
    let split = number_string.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix + rupiah;
}

function previewImageProfile() {
    const fileInput = document.getElementById('image');
    const file = fileInput.files[0];
    const imgPreview = document.querySelector('.img-preview');

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imgPreview.src = e.target.result;
            imgPreview.style.display = 'block'; // Pastikan gambar ditampilkan
        }

        reader.readAsDataURL(file);
    } else {
        imgPreview.src = "{{ url('images/default-profile.jpg') }}"; // Tampilkan gambar default jika tidak ada gambar
        imgPreview.style.display = 'block'; // Tetap tampilkan gambar
    }
}


function previewImage(imageNumber) {
    const input = document.getElementById('image' + imageNumber);
    const preview = document.getElementById('imgPreview' + imageNumber);

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result; // Set source untuk gambar preview
        preview.style.display = 'block'; // Pastikan gambar terlihat
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]); // Baca file sebagai Data URL
    } else {
        imgPreview.src = "{{ asset('images/' . ($product->{'image' + imageIndex} ?? '')) }}"; // menyesuaikan berdasarkan index

    }
}


// Fungsi untuk membuka modal
function openModal() {
    var modal = document.getElementById("categoryModal");
    modal.style.display = "block";
}

// Fungsi untuk menutup modal
function closeModal() {
    var modal = document.getElementById("categoryModal");
    modal.style.display = "none";
}

function openModal() {
    var modal = document.getElementById("modal-add");
    modal.style.display = "block";
}

// Fungsi untuk menutup modal
function closeModal() {
    var modal = document.getElementById("modal-add");
    modal.style.display = "none";
}

// Tutup modal saat pengguna klik di luar konten modal
window.onclick = function(event) {
    var modal = document.getElementById("categoryModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function openModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "block";
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    const content = modal.querySelector(".modal-content");
    
    // Tambahkan kelas animasi zoomOut
    content.style.animation = "zoomOut 0.5s ease-in-out";
    
    // Tunggu sampai animasi selesai sebelum menyembunyikan modal
    setTimeout(() => {
        modal.style.display = "none"; 
        content.style.animation = ""; 
    }, 500); 
}


window.onclick = function(event) {
    var modals = document.getElementsByClassName("modal");
    for (var i = 0; i < modals.length; i++) {
        if (event.target === modals[i]) {
            closeModal(modals[i].id);
        }
    }
}

function openTab(evt, tabName) {
    // Cari modal yang terkait dengan tombol yang diklik
    const modalContent = evt.target.closest('.modal-content');
    
    // Dapatkan semua elemen dengan kelas "tab-content" di dalam modal ini
    const tabcontent = modalContent.getElementsByClassName("tab-content");
    for (let i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active");
    }

    // Dapatkan semua tombol dengan kelas "tab-button" di dalam modal ini
    const tabbuttons = modalContent.getElementsByClassName("tab-button");
    for (let i = 0; i < tabbuttons.length; i++) {
        tabbuttons[i].classList.remove("active");
    }

    // Aktifkan tab yang dipilih dan tombolnya
    modalContent.querySelector(`#${tabName}`).classList.add("active");
    evt.currentTarget.classList.add("active");
}
    

function setMainImage(src) {
    document.getElementById("mainImage").src = src;
}
        
