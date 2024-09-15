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
    const image = document.querySelector('#image').files[0];
    const imgPreview = document.querySelector('.img-preview');

    if (image) {
        const reader = new FileReader();

        reader.onloadend = function () {
            imgPreview.src = reader.result; // Perbaiki nama variabel dari preview ke imgPreview
        };

        reader.readAsDataURL(image); // Perbaiki nama variabel dari file ke image
        imgPreview.style.display = 'block';
    } else {
        imgPreview.src = "{{ asset($user->image) }}"; // Kembalikan ke gambar lama jika tidak ada file
    }
}

