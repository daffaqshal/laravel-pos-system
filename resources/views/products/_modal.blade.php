@if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
            <div class="w-full max-w-2xl rounded-lg bg-white shadow-xl">
                <div class="flex items-center justify-between border-b px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $modalTitle }}
                    </h3>

                    <a href="{{ route('products.index') }}" class="text-2xl leading-none text-gray-500 hover:text-gray-700">
                        &times;
                    </a>
                </div>

                <form
                    action="{{ $editProduct ? route('products.update', $editProduct) : route('products.store') }}"
                    method="POST"
                    class="p-6"
                >
                    @csrf

                    @if ($editProduct)
                        @method('PUT')
                    @endif

                    @include('products._form')

                </form>
            </div>
        </div>
    @endif