<div class="p-6 space-y-8">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Nomor Purchase
            </label>

            <input
                type="text"
                name="purchase_number"
                readonly
                value="{{ old('purchase_number', $purchaseNumber) }}"
                class="mt-1 w-full rounded-md border-gray-300 bg-gray-100"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Tanggal
            </label>

            <input
                type="date"
                name="purchase_date"
                value="{{ old('purchase_date', now()->format('Y-m-d')) }}"
                class="mt-1 w-full rounded-md border-gray-300"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Supplier
            </label>

            <select
                name="supplier_id"
                class="supplier mt-1 w-full rounded-md border-gray-300"
            >
                <option value="" selected disabled hidden>
                    Pilih Supplier
                </option>

                @foreach($suppliers as $supplier)

                    <option value="{{ $supplier->id }}">
                        {{ $supplier->pic_name }}
                    </option>

                @endforeach

            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Barang
            </label>

            <select
                name="product_id"
                id="product"
                class="mt-1 w-full rounded-md border-gray-300"
            >

                <option value="" selected disabled hidden>
                    Pilih Barang
                </option>

                @foreach($products as $product)

                    <option
                        value="{{ $product->id }}"
                        data-price="{{ $product->price }}"
                    >
                        {{ $product->name }}
                    </option>

                @endforeach

            </select>

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
                Quantity
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

    <div class="flex justify-end">

        <div class="w-80 rounded-lg bg-gray-100 p-5">

            <div class="flex justify-between text-lg font-semibold">

                <span>Grand Total</span>

                <span id="grandTotal">
                    Rp 0
                </span>

            </div>

            <input
                type="hidden"
                name="grand_total"
                id="grandTotalInput"
                value="0"
            >

            <div class="mt-5 flex justify-end gap-2">

                <button
                    type="submit"
                    class="rounded-md bg-blue-600 px-5 py-2 text-white hover:bg-blue-700"
                >
                    Simpan Pembelian
                </button>

            </div>

        </div>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', () => {

    const product = document.getElementById('product');
    const qty = document.getElementById('qty');

    const price = document.getElementById('price');
    const grandTotal = document.getElementById('grandTotal');
    const grandTotalInput = document.getElementById('grandTotalInput');

    function rupiah(number){
        return 'Rp ' + Number(number).toLocaleString('id-ID');
    }

    function calculate(){

        if(!product.value){

            price.value = 'Rp 0';
            grandTotal.innerText = 'Rp 0';
            grandTotalInput.value = 0;

            return;

        }

        const option = product.options[product.selectedIndex];

        const harga = Number(option.dataset.price);

        const jumlah = Number(qty.value);

        const total = harga * jumlah;

        price.value = rupiah(harga);

        grandTotal.innerText = rupiah(total);

        grandTotalInput.value = total;

    }

    product.addEventListener('change', calculate);

    qty.addEventListener('input', calculate);

});

</script>