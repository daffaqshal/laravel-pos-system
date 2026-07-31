<?php

namespace App\Exports;

use App\Models\Sale;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SalesExport
{
    public function download()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Laporan Penjualan');

        // Judul
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN PENJUALAN');

        // Header
        $sheet->fromArray([
            [
                'No',
                'No Penjualan',
                'Tanggal',
                'Barang',
                'Qty',
                'Harga',
                'Subtotal'
            ]
        ], null, 'A3');

        $row = 4;
        $no = 1;

        $sales = Sale::with('items.product')->get();

        foreach ($sales as $sale) {

            foreach ($sale->items as $item) {

                $sheet->setCellValue("A{$row}", $no++);
                $sheet->setCellValue("B{$row}", $sale->sale_number);
                $sheet->setCellValue("C{$row}", $sale->sale_date);
                $sheet->setCellValue("D{$row}", $item->product->name);
                $sheet->setCellValue("E{$row}", $item->qty);
                $sheet->setCellValue("F{$row}", $item->price);
                $sheet->setCellValue("G{$row}", $item->subtotal);

                $row++;
            }

        }

        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Header Bold
        $sheet->getStyle('A3:G3')->getFont()->setBold(true);

        // Border
        $sheet->getStyle("A3:G" . ($row - 1))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );

        $writer = new Xlsx($spreadsheet);

        $filename = 'Laporan_Penjualan.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}