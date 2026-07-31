<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::latest()->paginate(10);

        $editProduct = null;
        $viewProduct = null;

        if ($request->filled('edit')) {
            $editProduct = Product::findOrFail($request->edit);
        }

        if ($request->filled('view')) {
            $viewProduct = Product::findOrFail($request->view);
        }

        $showModal = $request->filled('create')
            || $request->filled('edit')
            || $request->filled('view')
            || session()->has('errors');

        $modalTitle = 'Tambah Barang';

        if ($viewProduct) {
            $modalTitle = 'Detail Barang';
        } elseif ($editProduct) {
            $modalTitle = 'Edit Barang';
        }

        $activeProduct = $editProduct ?? $viewProduct ?? new Product();

        $isViewMode = filled($viewProduct);

        return view('products.index', compact(
            'products',
            'showModal',
            'editProduct',
            'viewProduct',
            'activeProduct',
            'isViewMode',
            'modalTitle'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_code' => ['required','string','max:50','unique:products,product_code'],
            'name' => ['required','string','max:255'],
            'expired_date' => ['nullable','date'],
            'stock' => ['required','integer','min:0'],
            'price' => ['required','numeric','min:0'],
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success','Barang berhasil ditambahkan.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'product_code' => ['required','string','max:50','unique:products,product_code,' . $product->id],
            'name' => ['required','string','max:255'],
            'expired_date' => ['nullable','date'],
            'stock' => ['required','integer','min:0'],
            'price' => ['required','numeric','min:0'],
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success','Barang berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success','Barang berhasil dihapus.');
    }

    public function edit(Product $product): RedirectResponse
    {
        return redirect()->route('products.index', [
            'edit' => $product->id
        ]);
    }
}