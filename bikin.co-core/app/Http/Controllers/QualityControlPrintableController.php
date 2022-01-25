<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Order;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class QualityControlPrintableController extends Controller
{
    private $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function shipmentReceipt(Request $request, $id)
    {
        $compact = $this->order->cetakResi($id)->toArray();

        switch ($request->action) {
            case 'view':
                return view('document-exports.so-shipment-receipt')->with($compact);
                break;
            case 'export':

                return PDF::loadView('document-exports.exports.so-shipment-receipt-export', $compact)->setPaper('a4')
                    ->download('Shipment-Receipt-BP-' . $id . '.pdf');

                break;
            case 'dump':
                return dd($compact);
                break;
            default :
                return abort(404);
                break;
        }

        return abort(404);
    }
}
