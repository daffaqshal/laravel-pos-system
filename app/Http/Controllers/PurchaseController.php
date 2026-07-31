<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function index(Request $request): View
    {
        $purchases = Purchase::with('supplier')
            ->latest()
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    public function create(): View
    {
        $suppliers = Supplier::orderBy('pic_name')->get();
        $products  = Product::orderBy('name')->get();

        $last = Purchase::latest()->first();

        $nextId = $last ? $last->id + 1 : 1;

        $purchaseNumber = 'PUR-' .
            now()->format('Ymd') .
            '-' .
            str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('purchases.create', compact(
            'suppliers',
            'products',
            'purchaseNumber'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'purchase_number' => 'required',
            'purchase_date'   => 'required|date',
            'supplier_id'     => 'required|exists:suppliers,id',

            'product_id'      => 'required|exists:products,id',
            'qty'             => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {

            $product = Product::findOrFail($request->product_id);

            $subtotal = $product->price * $request->qty;

            $purchase = Purchase::create([
                'purchase_number' => $request->purchase_number,
                'purchase_date'   => $request->purchase_date,
                'supplier_id'     => $request->supplier_id,
                'grand_total'     => $subtotal,
            ]);

            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id'  => $product->id,
                'price'       => $product->price,
                'qty'         => $request->qty,
                'subtotal'    => $subtotal,
            ]);

            $product->increment('stock', $request->qty);

            DB::commit();

            return redirect()
                ->route('purchases.index')
                ->with('success', 'Pembelian berhasil disimpan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors($e->getMessage());
        }
    }

    public function show(Purchase $purchase)
    {
        //
    }

    public function edit(Purchase $purchase)
    {
        //
    }

    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    public function destroy(Purchase $purchase)
    {
        //
    }
}