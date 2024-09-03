//hover
let list = document.querySelectorAll(".navigation li");

function activeLink() {
    list.forEach((item) => {
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

//toggle

let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};

document.getElementById("openModal").onclick = function () {
    document.getElementById("myModal").style.display = "block";
}

document.getElementsByClassName("close")[0].onclick = function () {
    document.getElementById("myModal").style.display = "none";
}

window.onclick = function (event) {
    if (event.target == document.getElementById("myModal")) {
        document.getElementById("myModal").style.display = "none";
    }
};

document.getElementById('productPrice').addEventListener('input', function (e) {
    let value = e.target.value.replace(/[^,\d]/g, ''); // Menghapus karakter selain angka
    if (value) {
        let formattedValue = formatRupiah(value, 'Rp. ');
        e.target.value = formattedValue;
    }
});

function formatRupiah(angka, prefix) {
    let numberString = angka.replace(/[^,\d]/g, '').toString(),
        split = numberString.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

// Fungsi untuk membuka modal balasan
function openReplyModal(parentId) {
    document.getElementById('replyParentId').value = parentId;
    document.getElementById('replyModal').style.display = 'block';
}

// Fungsi untuk membuka modal tambah pesan
function openAddMessageModal() {
    document.getElementById('addMessageModal').style.display = 'block';
}

// Fungsi untuk menutup modal balasan
function closeReplyModal() {
    document.getElementById('replyModal').style.display = 'none';
}

// Fungsi untuk menutup modal tambah pesan
function closeAddMessageModal() {
    document.getElementById('addMessageModal').style.display = 'none';
}

// Menutup modal jika klik di luar area modal
window.onclick = function (event) {
    if (event.target == document.getElementById('replyModal')) {
        closeReplyModal();
    }
    if (event.target == document.getElementById('addMessageModal')) {
        closeAddMessageModal();
    }
}


function openAddUserModal() {
    document.getElementById('addUserModal').style.display = 'block';
}

function closeAddUserModal() {
    document.getElementById('addUserModal').style.display = 'none';
}

function editUserModal() {
    document.getElementById('editUserModal').style.display = 'block';
}
function closeEditUserModal() {
    document.getElementById('editUserModal').style.display = 'none';
}

function viewUserModal() {
    document.getElementById('viewUserModal').style.display = 'block';
}

function closeViewUserModal() {
    document.getElementById('viewUserModal').style.display = 'none';
}



