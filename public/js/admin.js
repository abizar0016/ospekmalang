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

// Fungsi untuk modal produk
function openAddProduct() {
    document.getElementById('addProductModal').style.display = 'block';
}

function closeAddProduct() {
    document.getElementById('addProductModal').style.display = 'none';
}

function openViewProduct() {
    document.getElementById('productViewModal').style.display = 'block';
}

function closeViewProduct() {
    document.getElementById('productViewModal').style.display = 'none';
}

function openEditProduct() {
    document.getElementById('editProductModal').style.display = 'block';
}

function closeEditProduct() {
    document.getElementById('editProductModal').style.display = 'none';
}

// Fungsi untuk modal message
function openReplyModal(parentId) {
    document.getElementById('replyParentId').value = parentId;
    document.getElementById('replyModal').style.display = 'block';
}

function closeReplyModal() {
    document.getElementById('replyModal').style.display = 'none';
}

function openAddMessageModal() {
    document.getElementById('addMessageModal').style.display = 'block';
}

function closeAddMessageModal() {
    document.getElementById('addMessageModal').style.display = 'none';
}

// Fungsi untuk modal user
function openAddUserModal() {
    document.getElementById('addUserModal').style.display = 'block';
}

function closeAddUserModal() {
    document.getElementById('addUserModal').style.display = 'none';
}

function openEditUserModal() {
    document.getElementById('editUserModal').style.display = 'block';
}

function closeEditUserModal() {
    document.getElementById('editUserModal').style.display = 'none';
}

function openViewUserModal() {
    document.getElementById('viewUserModal').style.display = 'block';
}

function closeViewUserModal() {
    document.getElementById('viewUserModal').style.display = 'none';
}

// Menutup modal jika klik di luar area modal
window.onclick = function (event) {
    if (event.target === document.getElementById('addProductModal')) {
        closeAddProduct();
    }
    if (event.target === document.getElementById('productViewModal')) {
        closeViewProduct();
    }
    if (event.target === document.getElementById('editProductModal')) {
        closeEditProduct();
    }
    if (event.target === document.getElementById('replyModal')) {
        closeReplyModal();
    }
    if (event.target === document.getElementById('addMessageModal')) {
        closeAddMessageModal();
    }
    if (event.target === document.getElementById('addUserModal')) {
        closeAddUserModal();
    }
    if (event.target === document.getElementById('editUserModal')) {
        closeEditUserModal();
    }
    if (event.target === document.getElementById('viewUserModal')) {
        closeViewUserModal();
    }
}

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
