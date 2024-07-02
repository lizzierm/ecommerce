<?php

namespace App\Observers;

use App\Models\Orde;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    // public function creared(Orde $order){

    //     $pdf = Pdf::loadView('orders.ticket', compact('order'))->setPaper([0, 0, 450, 500], 'landscape');
    
    //     $pdf->save(storage_path('app/public/tickets/ticket-' . $order->id . '.pdf'));

    //     $order->pdf_path = 'tickets/ticket-' . $order->id . 'pdf';

    //     $order->save();
    //  }

     public function created(Orde $order)
     {
         try {
             $pdf = Pdf::loadView('orders.ticket', compact('order'))->setPaper([0, 0, 450, 500], 'landscape');
             $filePath = storage_path('app/public/tickets/ticket-' . $order->id . '.pdf');
             
             $pdf->save($filePath);
 
             if (file_exists($filePath)) {
                 $order->pdf_path = 'tickets/ticket-' . $order->id . '.pdf';
                 $order->save();
             } else {
                 Log::error("PDF file was not created: " . $filePath);
             }
         } catch (\Exception $e) {
             Log::error("Error creating PDF for order {$order->id}: " . $e->getMessage());
         }
     }
}
          

