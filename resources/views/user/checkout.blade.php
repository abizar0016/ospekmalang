    <x-head></x-head>

    <body>
        @include('components.userheader')

        <!-- Alamat Pengiriman -->
        <div class="checkout-section">
            <div class="container checkout-container" style="margin-top:120px;">
                <h1>Pilih Barang untuk Checkout</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Keranjang Belanja -->
                <table class="table mt-5" style="border-spacing: 0 10px; border-color: transparent;">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga Barang</th>
                            <th>Aksi</th>
                            <th style="display: flex; justify-content:space-around">
                                Pilih Semua
                                <input type="checkbox" id="select-all" onchange="toggleSelectAll()">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Items as $cart)
                            <tr>
                                <td style="text-align: center;">
                                    <img src="{{ asset('images/' . $cart->product->image1) }}" alt="Product Image"
                                        style="width: 100px; height: 100px; object-fit: contain;">
                                </td>
                                <td>{{ $cart->product->name }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>Rp. {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</td>
                                <td>
                                    <form id="delete-cart-{{ $cart->id }}"
                                        action="{{ route('user.checkout.delete', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn delete-cart-button" type="button"
                                            data-form-id="delete-cart-{{ $cart->id }}">Hapus
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <input type="checkbox" class="cart-checkbox" data-id="{{ $cart->product->id }}"
                                        data-price="{{ $cart->product->price }}" data-quantity="{{ $cart->quantity }}"
                                        onchange="updateTotal()">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td style="text-align: center" colspan="7">Keranjang belanja kosong.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="checkout-total-bar">
                <button type="button" class="btn" id="pay-button">Lanjutkan Pembayaran</button>
                <h3 class="ml-4">Total Harga: Rp. <span id="total-price">0</span></h3>
            </div>
        </div>

        <form id="recipientForm" action="{{ route('user.checkout.proses') }}" method="POST">
            @csrf
            <input type="hidden" id="selected_products" name="selected_products">
        </form>
        <form id="handleback" action="{{ route('user.checkout.handleback') }}" method="POST">
            @csrf
            <input type="hidden" id="json_callback" name="json">
        </form>
        


        <x-script></x-script>

        <script>
            let selectedProducts = []; // Deklarasikan variabel secara global

            function toggleSelectAll() {
                const selectAll = document.getElementById("select-all");
                const checkboxes = document.querySelectorAll(".cart-checkbox");
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = selectAll.checked;
                });
                updateTotal();
            }

            function updateTotal() {
                const checkboxes = document.querySelectorAll(".cart-checkbox:checked");
                let totalPrice = 0;
                selectedProducts = []; // Reset daftar produk yang dipilih

                checkboxes.forEach((checkbox) => {
                    const productId = checkbox.getAttribute("data-id");
                    const price = parseFloat(checkbox.getAttribute("data-price"));
                    const quantity = parseInt(checkbox.getAttribute("data-quantity"));
                    totalPrice += price * quantity;

                    selectedProducts.push({
                        product_id: productId,
                        quantity: quantity,
                        price: price
                    });
                });

                document.getElementById("total-price").innerText = totalPrice.toLocaleString("id-ID");
                document.getElementById("selected_products").value = JSON.stringify(selectedProducts);
            }

            document.getElementById('pay-button').addEventListener('click', function() {
                if (selectedProducts.length === 0) {
                    alert('Pilih minimal satu barang untuk melanjutkan.');
                    return;
                }
                document.getElementById('recipientForm').submit();
            });


            @if (isset($snapToken))
                window.snap.pay(@json($snapToken), {
                    onSuccess: function(result) {
                        document.getElementById('json_callback').value = JSON.stringify(result);
                        document.getElementById('handleback').submit();
                    },

                    onPending: function(result) {
                        alert('Menunggu pembayaran...');
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal!');
                    },
                    onClose: function() {
                        alert('Anda menutup pembayaran.');
                    }
                });
            @endif
        </script>
    </body>
