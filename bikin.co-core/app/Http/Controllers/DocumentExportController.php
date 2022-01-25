<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Repositories\Order\Order;
use Illuminate\Support\Facades\Session;

class DocumentExportController extends Controller
{
    private $order;
    private $sessions;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->sessions = new Session();
    }

    public function SalesOfficerPrintable(Request $request)
    {
        $request_param = [
            'action' => 'required|in:view,export',
            'order_id' => 'required|numeric',
        ];

        $request->validate($request_param);

        // Get Array from request
        $array_param = ['action', 'order_id'];
        $data = Arr::only($request->all(), $array_param);

        if ($data['action'] == 'view') {
            $compact = [
                'orders' => $this->order->getOrderDetail($data['order_id']),
            ];

            return view('documents.quotation.index')->with($compact);
        }

        $response = [
            'status' => true,
            'code' => 200,
            'data' => [],
            'message' => 'OK',
        ];
        return response()->json($response);
    }
}
