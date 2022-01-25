<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;

use App\Http\Models\Order;

use App\Http\Models\OrderLog;

use App\Http\Models\Customers;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use Illuminate\Support\Str;

use Carbon\Carbon;


class OrderCustomerConfirmationController extends Controller
{
    private $modelOrder;
    private $modelOrderLog;

    public function __construct()
    {
        $this->middleware('auth');

        $this->modelOrder = new Order();

        $this->modelOrderLog = new OrderLog();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Order::GetDataCustomerConfirmation()->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '
                        <a id="sc-js-modal-confirm" class="sc-button sc-button-mini sc-button-success" href="javascript:showKonfirmasi('.$row->id.')">Konfirmasi</a>
                        <a href="so-product-order-revisi.html" class="sc-button sc-button-mini sc-button-primary">Revisi</a>
                        ';
                    })
                    ->editcolumn('status', function ($row) {
                        $data = '<span class="uk-label uk-status-quality-control-production-pending">Order Dibuat</span>';

                        return $data;
                    })
                    ->editColumn('prioritas', function ($row) {
                        $dataPriority = $row->priority;

                        if ($dataPriority == 0)
                        {
                            $data = '<span class="uk-label">Tidak Prioritas</span>';
                        } else {
                            $data = '<span class="uk-label uk-label-danger">Prioritas</span>';
                        }

                        return $data;
                    })
                    ->addColumn('quotation', function ($row){
                        return "<a href='" . url('/') . "/sales-officer/printable/quotation/" . $row->id . "?action=export' target='blank' class='sc-button sc-button-mini'>Quotation</a>";
                    })

                    ->rawColumns(['status', 'action', 'prioritas', 'quotation'])
                    ->make(true);
        }

        return view('customer-confirmation.index');
    }

    public function create($id)
    {
        \DB::beginTransaction();

        $updateStatus = [
            'flow_step' => 1,
            'flow_step_date' => now()
        ];
        $detail = $this->modelOrder->getDataOrderById($id);

        $detail->update($updateStatus);

        $inputLogOrder = [
            'order_id' => $id,
            'flow_step' => 1,
            'flow_step_date' => now()
        ];

        $createLogOrder = $this->modelOrderLog->create($inputLogOrder);

        \DB::commit();

        return response()->json([
            'status' => true,
            'data' => $detail,
            'messsage' => 'Berhasil Memperbaharui Status',
        ], 200);

    }

    public function getDataWaitingCust()
    {
        $data = Order::GetDataCustomerConfirmation()->get();

        $counted = count($data);

        return $counted;
    }

}
