<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function index(Request $request): View
    {
        $suppliers = Supplier::latest()->paginate(10);

        $editSupplier = null;
        $viewSupplier = null;

        if ($request->filled('edit')) {
            $editSupplier = Supplier::findOrFail($request->edit);
        }

        if ($request->filled('view')) {
            $viewSupplier = Supplier::findOrFail($request->view);
        }

        $showModal = $request->filled('create')
            || $request->filled('edit')
            || $request->filled('view')
            || session()->has('errors');

        return view('suppliers.index', compact(
            'suppliers',
            'editSupplier',
            'viewSupplier',
            'showModal'
        ));
    }

    public function create(): View
    {
        return view('suppliers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_number' => ['required', 'string', 'max:50', 'unique:suppliers,supplier_number'],
            'pic_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
        ]);

        Supplier::create($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier): RedirectResponse
    {
        return redirect()->route('suppliers.index', ['edit' => $supplier->id]);
    }

    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_number' => ['required', 'string', 'max:50', 'unique:suppliers,supplier_number,' . $supplier->id],
            'pic_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
