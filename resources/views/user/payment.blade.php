<h3>Rincian Pembayaran</h3>

@foreach ($products as $index => $product)
    <p>
        Produk: {{ $product }} <br>
        Jumlah: {{ $quantities[$index] }} <br>
        Harga Satuan: Rp. {{ number_format($prices[$index], 0, ',', '.') }} <br>
        Total Harga: Rp. {{ number_format($prices[$index] * $quantities[$index], 0, ',', '.') }} <br>
    </p>
@endforeach

<h3>Total Pembayaran: 
    Rp. 
    {{ number_format(array_sum(array_map(function ($p, $q) { return $p * $q; }, $prices, $quantities)), 0, ',', '.') }}
</h3>
