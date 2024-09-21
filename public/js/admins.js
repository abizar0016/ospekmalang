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


// Format Rupiah untuk input harga
document.getElementById('productPrice').addEventListener('input', function (e) {
    let value = e.target.value.replace(/[^,\d]/g, ''); // Pastikan hanya angka yang diambil
    e.target.value = formatRupiah(value, 'Rp. '); // Format menjadi Rupiah
});

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
        preview.src = e.target.result;  // Set source untuk gambar preview
        preview.style.display = 'block'; // Pastikan gambar terlihat
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]); // Baca file sebagai Data URL
    } else {
        preview.src = "";  // Kosongkan preview jika tidak ada file yang dipilih
    }
}

