<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class RegularReceipt extends Controller
{
    public static function print(Request $request) {
        $fpdf = new Fpdf('P', 'mm', 'A4'); 
        $fpdf->AddPage();

        $fpdf->SetFont('Arial', 'B', 19);
        $fpdf->Cell(0, 10, 'Tech Store', 0, 1, 'C');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, 10, 'Upper Naalad City of Naga Cebu', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'Technology Company', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'Mobile: 09505239454', 0, 1, 'C');
        $fpdf->Cell(0, 10, '', 0, 1); 

        $fpdf->Ln();

        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(100, 10, 'Item Description', 1);
        $fpdf->Cell(30, 10, 'Qty', 1);
        $fpdf->Cell(30, 10, 'Price', 1, 1);
        
        $items = [
            ['description' => 'MONITOR', 'qty' => 2, 'price' => 8.00],
            ['description' => 'KEYBOARD', 'qty' => 1, 'price' => 3.00],
            ['description' => 'LAPTOP', 'qty' => 1, 'price' => 3.00],
            ['description' => 'FULL SET COMPUTER', 'qty' => 1, 'price' => 10.00],
            ['description' => 'MOUSE PAD', 'qty' => 2, 'price' => 2.00],
            ['description' => 'MOUSE', 'qty' => 2, 'price' => 2.00],
            ['description' => 'USB', 'qty' => 2, 'price' => 6.00],
            ['description' => 'PRINTER', 'qty' => 2, 'price' => 10.00],
            ['description' => 'HEADSET', 'qty' => 2, 'price' => 4.00],
        ];
        

        foreach ($items as $item) {
            $fpdf->SetFont('Arial', '', 12);
            $fpdf->Cell(100, 10, $item['description'], 1);
            $fpdf->Cell(30, 10, $item['qty'], 1);
            $fpdf->Cell(30, 10, '$' . number_format($item['price'], 2), 1, 1);
        }
         
        $fpdf->Ln();


        $subtotal = array_sum(array_map(function ($item) {
            return $item['qty'] * $item['price'];
        }, $items));

        $tax = $subtotal * 0.05;
        $total = $subtotal + $tax;

 
        $fpdf->Cell(130, 10, 'Subtotal', 1);
        $fpdf->Cell(30, 10, '$' . number_format($subtotal, 2), 1, 1);
        $fpdf->Cell(130, 10, 'Tax (5%)', 1);
        $fpdf->Cell(30, 10, '$' . number_format($tax, 2), 1, 1);
        $fpdf->Cell(130, 10, 'Total', 1);
        $fpdf->Cell(30, 10, '$' . number_format($total, 2), 1, 1);

        $fpdf->Ln();
        $fpdf->Ln();

        $fpdf->Cell(0, 5, 'Thank you for your purchase! We appreciate your business and look forward to serving you again!!', 0, 0, 'C');


        $fpdf->SetFont('Courier', 'B', 18);
        $fpdf->Output();
        
       
        exit;
    }
}
      
     
 

 
     


