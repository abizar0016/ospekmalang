document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua checkbox item
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const totalPriceElement = document.getElementById('total-price');

    // Tambahkan event listener ke setiap checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            updateTotalPrice();  // Panggil fungsi setiap kali checkbox berubah
        });
    });

    function updateTotalPrice() {
        let totalPrice = 0;

        // Iterasi setiap checkbox yang dicentang
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.getAttribute('data-price'));
                const quantity = parseInt(checkbox.getAttribute('data-quantity'));

                // Debugging
                console.log('Price:', price, 'Quantity:', quantity);

                // Hitung total harga
                totalPrice += price * quantity;
            }
        });

        // Debugging hasil total price
        console.log('Total Price:', totalPrice);

        // Update total harga di DOM
        if (totalPriceElement) {
            totalPriceElement.textContent = totalPrice.toLocaleString('id-ID', {
                minimumFractionDigits: 0,  // Menghilangkan ,00
                maximumFractionDigits: 0
            });
        }
    }
});
