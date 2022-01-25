<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\Customer;
use App\Http\Models\CustomerWork;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class CustomerWorkController extends Controller
{
    private $modelCustomer;
    private $modelCustomerWork;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelCustomer = new Customer();
        $this->modelCustomerWork = new CustomerWork();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CustomerWork::with('hasCustomer')->whereNull('deleted_at');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('sales-officer.customer.customer-work-list');
    }

    public function show($id)
    {
        $data = $this->modelCustomerWork->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data klaster konsumen tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data klaster konsumen ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
            ]
        );
        
        $input = Arr::only($request->all(), [
            'name',
        ]);
        
        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama klaster '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('customer_works', $valid);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        $create = $this->modelCustomerWork->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data klaster konsumen'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data klaster konsumen'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required",
            ]
        ); 
        
        $input = Arr::only($request->all(), [
            'name',
        ]);
        
        $detail = $this->modelCustomerWork->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data klaster konsumen tidak ditemukan'
            ], 406);
        }
        
        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama klaster '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('customer_works', $valid, $detail->id);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data klaster konsumen'
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        ); 

        $input = Arr::only($request->all(), [
            'id',
        ]);

        $detail = $this->modelCustomerWork->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data klaster konsumen tidak ditemukan'
            ], 406);
        }

        $checkOnCustomer = $this->modelCustomer->getTotalDataByWork($input['id']);
        if ($checkOnCustomer > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data klaster konsumen masih digunakan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data klaster konsumen'
        ], 200);
    }
}
