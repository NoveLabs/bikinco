<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Services\OrderService as OrderService;
use App\Http\Models\Order;
use App\Http\Models\OrderShipment;
use Yajra\DataTables\DataTables;

class OrderShipmentOnProgressController extends Controller
{
    # Private Variables
    private $order;
    private $orderService;
    private $shipment;
    private $customer;
    private $product;

    public function __construct()
    {
        $this->order = new Order();
        $this->orderService = new OrderService();
        $this->shipment = new OrderShipment();
        $this->customer = new CustomerService();
        $this->product = new ProductService();
    }

    public function index(Request $request)
    {
        # Yajra Datatables Area

        if ($request->ajax())
        {
            $dataset = $this->order->getDataOrderSelesai();
            return DataTables::of($dataset)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    return '<a id="sc-js-modal-confirm" class="sc-button sc-button-mini sc-button-success" href="javascript:getOrderShipmentInfo('.$row->id.')">Lihat Detail</a>';
                })
                ->addColumn('order_id', function ($row)
                {
                    return $row->id;
                })
                ->addColumn('customers', function ($row)
                {
                    return $row->fullname;
                })
                ->addColumn('product', function ($row)
                {
                    return $row->name;
                })
                ->addColumn('priority', function ($row)
                {
                    if($row->priority == 0) {

                        return "<span class='uk-label'>Tidak Prioritas</span>";

                    } else if ($row->priority == 1) {

                        return "<span class='uk-label uk-label-danger'>Prioritas</span>";

                    } else {

                        return "-";
                    }
                })
                ->addColumn('quantity', function ($row)
                {
                    return $row->total_item;
                })
                ->addColumn('order_date', function ($row)
                {
                    return $row->tgl_order;
                })
                ->rawColumns(['action', 'order_id', 'customers', 'product', 'priority', 'quantity', 'order_date'])
                ->make(true);
        }

        return view('quality-control.on-progress.index');
    }

    public function orderShipmentInfo($id)
    {
        # Get Order Detail
        $order_data = $this->orderService->filterOrdersWhere('id', $id);
        $order_list_data = $this->orderService->filterItemsWhere('order_id', $order_data[0]->id);
        $order_shipment_data = $this->shipment->where('order_id', $id)->get();
        $customer_data = $this->customer->filterCustomersWhere('id', $order_data[0]->customer_id);
        $product_data = $this->product->filterProductsWhere('id', $order_list_data[0]->product_id);

        $content = [
            'data' => [
                'orders' => $order_data,
                'shipment' => $order_shipment_data,
                'customer' => $customer_data,
                'product' => $product_data
            ]
        ];

        return response()->json($content);
    }
}
