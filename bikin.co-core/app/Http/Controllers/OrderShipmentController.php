<?php

namespace App\Http\Controllers;

use App\Http\Models\Order;
use App\Http\Models\OrderShipment;
use App\Http\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class OrderShipmentController extends Controller
{
    /**
     * [__construct description]
    */
    public function __construct()
    {
        $this->model = new OrderShipment();
        $this->modelOrder = new Order();
    }

    public function index()
    {
        $orders = $this->modelOrder->with(['customer','orderItems','OrderItems.hasProduct','orderShipments'])->where('orders.flow_step',6)->get();

        return view('sales-officer.shipment.shipment_ready', compact('orders'));
    }

    public function listQc()
    {
        $orders = $this->modelOrder->with(['customer','orderItems','OrderItems.hasProduct', 'orderShipments'])->where('orders.flow_step',6)->get();

        return view('quality-control.shipment.shipment_ready', compact('orders'));
    }

    public function show()
    {
        $data = $this->model->where('order_id',\Request::get('order_id'))->first();

        return $data;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'weight' => 'required',
            'expedition_name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            $message_errors = "";
                foreach ($validator->errors()->all() as $message) {
                    $message_errors .= $message;
                }
                toast($message,'error','success')->position('center')->timerProgressBar()->width('400px');

            return redirect()->back();
        }

        $myNumber = floatval(str_replace(',', '.', $request->weight));

        $cekText = preg_match("/^[a-z0-9.]+$/i", $myNumber);

        $input = [
            'weight' => (($cekText == 1) ? $myNumber : 0),
            'price' => $request->price,
            'expedition_name' => $request->expedition_name,
            'order_id' => $request->order_id,
        ];

        # Change Price String to number Only
        $data_price = explode(',', $request->price);
        $input['price'] = implode('', $data_price);

        $create = $this->model->create($input);

        return redirect()->back();

    }

    public function update(Request $request)
    {
        \DB::beginTransaction();

        $validator = Validator::make($request->all(),[
            'weight' => 'required',
        ]);

        $myNumber = floatval(str_replace(',', '.', $request->weight));

        $cekText = preg_match("/^[a-z0-9.]+$/i", $myNumber);

        $input = [
            'weight' => (($cekText == 1) ? $myNumber : 0),
            'order_id' => $request->order_id,
        ];


        $shipment = $this->model->create($input);

        \DB::commit();

        return redirect()->back();

    }

    public function updateSo(Request $request)
    {
        \DB::beginTransaction();

        $validator = Validator::make($request->all(),[
            'weight' => 'required',
            'expedition_name' => 'required',
            'price' => 'required',
        ]);

        $myNumber = floatval(str_replace(',', '.', $request->weight));

        $cekText = preg_match("/^[a-z0-9.]+$/i", $myNumber);

        $input = [
            'weight' => (($cekText == 1) ? $myNumber : 0),
            'order_id' => $request->order_id,
            'price' => $request->price,
            'expedition_name' => $request->expedition_name,
            'status' => 2
        ];

        # Change Price String to number Only
        $data_price = explode(',', $request->price);
        $input['price'] = implode('', $data_price);


        $shipment = $this->model->where('order_id', $request->order_id)->update($input);

        \DB::commit();

        return redirect()->back();

    }

    public function updateResi(Request $request)
    {
        \DB::beginTransaction();

        $validator = Validator::make($request->all(),[
            'weight' => 'required',
            'expedition_name' => 'required',
            'price' => 'required',
        ]);

        $myNumber = floatval(str_replace(',', '.', $request->weight));

        $cekText = preg_match("/^[a-z0-9.]+$/i", $myNumber);

        $input = [
            'weight' => (($cekText == 1) ? $myNumber : 0),
            'order_id' => $request->order_id,
            'price' => $request->price,
            'expedition_name' => $request->expedition_name,
            'status' => 3,
            'no_resi'   => $request->no_resi
        ];


        $shipment = $this->model->where('order_id', $request->order_id)->update($input);

        \DB::commit();


        return redirect()->back();

    }

    public function updateTransaksi(Request $request)
    {

        \DB::beginTransaction();

        $validator = Validator::make($request->all(),[
            'weight' => 'required',
            'expedition_name' => 'required',
            'price' => 'required',
            'no_resi'   => 'required'
        ]);

        $myNumber = floatval(str_replace(',', '.', $request->weight));

        $cekText = preg_match("/^[a-z0-9.]+$/i", $myNumber);
        $input = [
            'weight' => (($cekText == 1) ? $myNumber : 0),
            'order_id' => $request->order_id,
            'price' => $request->price,
            'expedition_name' => $request->expedition_name,
            'status' => 0,
            'no_resi'   => $request->no_resi
        ];


        $shipment = $this->model->where('order_id', $request->order_id)->update($input);

        $getDataByorderId = $this->modelOrder->where('id',$request->order_id)->first();

        $updateOrder = $this->modelOrder->where('id', $request->order_id)->update([
            'flow_step' => 7,
            'shipment_amount'   => $request->price,
            'total_price_rounding'  => ($getDataByorderId->total_amount - $getDataByorderId->part_paid_amount) + $request->price
        ]);

        \DB::commit();


        return redirect()->back();
    }

    public function cetakResi($id)
    {
        $data = $this->modelOrder->cetakResi($id);

        return view('order-selesai.cetak-resi', compact('data'));
    }

    public function getDataShipment()
    {
        $data = $this->modelOrder->with(['customer','orderItems','OrderItems.hasProduct','orderShipments'])->where('orders.flow_step',6)->get();

        $counted = count($data);

        return $counted;
    }

}
