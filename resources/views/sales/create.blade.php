<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Penjualan
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="mx-auto max-w-4xl px-4">

            <div class="mb-5">
                <a
                    href="{{ route('sales.index') }}"
                    class="rounded-md bg-gray-600 px-4 py-2 text-white hover:bg-gray-700"
                >
                    ← Kembali
                </a>
            </div>

            <form
                action="{{ route('sales.store') }}"
                method="POST"
            >

                @csrf

                <div class="rounded-lg bg-white shadow">

                    <div class="border-b p-6">
                        <h3 class="text-lg font-semibold">
                            Form Penjualan
                        </h3>
                    </div>

                    <div class="space-y-6 p-6">

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>

                                <label class="block text-sm font-medium text-gray-700">
                                    Nomor Penjualan
                                </label>

                                <input
                                    type="text"
                                    name="sale_number"
                                    readonly
                                    value="{{ $saleNumber }}"
                                    class="mt-1 w-full rounded-md border-gray-300 bg-gray-100"
                                >

                            </div>

                            <div>

                                <label class="block text-sm font-medium text-gray-700">
                                    Tanggal
                                </label>

                                <input
                                    type="date"
                                    name="sale_date"
                                    value="{{ date('Y-m-d') }}"
                                    class="mt-1 w-full rounded-md border-gray-300"
                                >

                            </div>

                        </div>

                        <hr>

                        <div>

                            <label class="block text-sm font-medium text-gray-700">
                                Barang
                            </label>

                            <select
                                name="product_id"
                                id="product"
                                class="mt-1 w-full rounded-md border-gray-300"
                                required
                            >

                                <option value="" selected disabled>
                                    Pilih Barang
                                </option>

                                @foreach($products as $product)

                                    <option
                                        value="{{ $product->id }}"
                                        data-stock="{{ $product->stock }}"
                                        data-price="{{ $product->price }}"
                                    >
                                        {{ $product->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                            <div>

                                <label class="block text-sm font-medium text-gray-700">
                                    Stock
                                </label>

                                <input
                                    type="text"
                                    id="stock"
                                    readonly
                                    value="-"
                                    class="mt-1 w-full rounded-md border-gray-300 bg-gray-100"
                                >

                            </div>

                            <div>

                                <label class="block text-sm font-medium text-gray-700">
                                    Harga
                                </label>

                                <input
                                    type="text"
                                    id="price"
                                    readonly
                                    value="Rp 0"
                                    class="mt-1 w-full rounded-md border-gray-300 bg-gray-100"
                                >

                            </div>

                            <div>

                                <label class="block text-sm font-medium text-gray-700">
                                    Qty
                                </label>

                                <input
                                    type="number"
                                    name="qty"
                                    id="qty"
                                    value="1"
                                    min="1"
                                    class="mt-1 w-full rounded-md border-gray-300"
                                >

                            </div>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700">
                                Subtotal
                            </label>

                            <input
                                type="text"
                                id="subtotal"
                                readonly
                                value="Rp 0"
                                class="mt-1 w-full rounded-md border-gray-300 bg-gray-100"
                            >

                        </div>

                    </div>

                    <div class="flex items-center justify-between border-t bg-gray-50 px-6 py-5">

                        <div>

                            <span class="text-lg font-semibold">
                                Grand Total :
                            </span>

                            <span
                                id="grandTotal"
                                class="ml-2 text-xl font-bold text-blue-600"
                            >
                                Rp 0
                            </span>

                        </div>

                        <input
                            type="hidden"
                            name="grand_total"
                            id="grandTotalInput"
                            value="0"
                        >

                        <button
                            type="submit"
                            class="rounded-md bg-blue-600 px-6 py-2 font-semibold text-white hover:bg-blue-700"
                        >
                            Simpan Penjualan
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>

<script>

document.addEventListener('DOMContentLoaded', () => {

    const product = document.getElementById('product');
    const qty = document.getElementById('qty');

    const stock = document.getElementById('stock');
    const price = document.getElementById('price');
    const subtotal = document.getElementById('subtotal');

    const grandTotal = document.getElementById('grandTotal');
    const grandTotalInput = document.getElementById('grandTotalInput');

    function rupiah(value){

        return 'Rp ' + Number(value).toLocaleString('id-ID');

    }

    function calculate(){

        if(product.selectedIndex <= 0){

            stock.value = '-';
            price.value = 'Rp 0';
            subtotal.value = 'Rp 0';

            grandTotal.innerText = 'Rp 0';
            grandTotalInput.value = 0;

            return;

        }

        const option = product.options[product.selectedIndex];

        const productStock = Number(option.dataset.stock);
        const productPrice = Number(option.dataset.price);

        let quantity = Number(qty.value);

        if(quantity < 1){

            quantity = 1;

            qty.value = 1;

        }

        if(quantity > productStock){

            alert('Stock barang tidak mencukupi.');

            quantity = productStock;

            qty.value = productStock;

        }

        const total = quantity * productPrice;

        stock.value = productStock;
        price.value = rupiah(productPrice);
        subtotal.value = rupiah(total);

        grandTotal.innerText = rupiah(total);
        grandTotalInput.value = total;

    }

    product.addEventListener('change', calculate);

    qty.addEventListener('input', calculate);

});

</script>