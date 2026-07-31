<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Exports\SalesExport;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index()
    {
        $sales = Sale::selectRaw('sale_date, SUM(grand_total) as total')
            ->groupBy('sale_date')
            ->orderBy('sale_date')
            ->get();

        $labels = $sales->pluck('sale_date')
            ->map(fn ($date) => date('d M', strtotime($date)));

        $totals = $sales->pluck('total');

        return view('dashboard', [
            'labels' => $labels,
            'totals' => $totals,
        ]);
    }

    public function exportExcel()
    {
        return (new SalesExport())->download();
    }
}