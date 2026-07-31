<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with([
            'items.product'
        ])
        ->latest()
        ->paginate(10);

        return view('sales.index', compact('sales'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name')->get();

        $last = Sale::latest()->first();

        $nextId = $last ? $last->id + 1 : 1;

        $saleNumber = 'SAL-' . now()->format('Ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('sales.create', compact(
            'products',
            'saleNumber'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_number' => 'required|string|max:50',
            'sale_date'   => 'required|date',
            'product_id'  => 'required|exists:products,id',
            'qty'         => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {

            $product = Product::findOrFail($request->product_id);

            if ($request->qty > $product->stock) {

                throw new \Exception(
                    "Stock {$product->name} tidak mencukupi."
                );

            }

            $subtotal = $product->price * $request->qty;

            $sale = Sale::create([

                'sale_number' => $request->sale_number,

                'sale_date' => $request->sale_date,

                'grand_total' => $subtotal,

            ]);

            SaleItem::create([

                'sale_id' => $sale->id,

                'product_id' => $product->id,

                'price' => $product->price,

                'qty' => $request->qty,

                'subtotal' => $subtotal,

            ]);

            $product->decrement('stock', $request->qty);

            DB::commit();

            return redirect()
                ->route('sales.index')
                ->with('success', 'Penjualan berhasil disimpan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);

        }
    }

    public function show(Sale $sale)
    {
        //
    }

    public function edit(Sale $sale)
    {
        //
    }

    public function update(Request $request, Sale $sale)
    {
        //
    }

    public function destroy(Sale $sale)
    {
        //
    }
}