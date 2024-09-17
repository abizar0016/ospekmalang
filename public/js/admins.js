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

function previewImage() {
    const file = document.getElementById('image').files[0];
    const imgPreview = document.querySelector('.img-preview');

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imgPreview.src = e.target.result;
            imgPreview.style.display = 'block'; // Show the image preview
        }

        reader.readAsDataURL(file);
    } else {
        imgPreview.style.display = 'none'; // Hide the image preview if no file is selected
    }
}
