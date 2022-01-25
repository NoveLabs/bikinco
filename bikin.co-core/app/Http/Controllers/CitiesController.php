<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\Cities;
use App\Http\Models\Customer;
use App\Http\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class CitiesController extends Controller
{
    private $modelCustomer;
    private $modelProvince;
    private $modelCities;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelCustomer = new Customer();
        $this->modelProvince = new Province();
        $this->modelCities = new Cities();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Cities::with('hasProvince')->whereNull('deleted_at');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('alias_province', function ($row) {
                        return !empty($row->hasProvince->name) ? $row->hasProvince->name : '' ;
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        $provinces = $this->modelProvince->getAllData();

        return view('sales-officer.customer.cities-list', compact('provinces'));
    }

    public function indexByProvince($id)
    {
        $data = $this->modelCities->getAllDataByProvince($id);
        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data kota atau kabupaten ditemukan',
        ], 200);
    }

    public function show($id)
    {
        $data = $this->modelCities->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data kota / kabupaten tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data kota / kabupaten ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
                "province_id" => "required|numeric",
                "status" => "numeric|in:0,1",
            ]
        );
        
        $input = Arr::only($request->all(), [
            'name',
            'province_id',
            'status'
        ]);
        
        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'province_id', 'opr' => '=', 'value' => $input['province_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama kota atau kabupaten '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('cities', $valid);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        $create = $this->modelCities->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data kota / kabupaten'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data kota / kabupaten'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required",
                "province_id" => "required|numeric",
                "status" => "numeric|in:0,1",
            ]
        ); 
        
        $input = Arr::only($request->all(), [
            'name',
            'province_id',
            'status'
        ]);
        
        $detail = $this->modelCities->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data kota / kabupaten tidak ditemukan'
            ], 406);
        }
        
        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                    ['name' => 'province_id', 'opr' => '=', 'value' => $input['province_id'], 'opr_func' => 'where'],
                ],
                'message' => "Nama kota atau kabupaten '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('cities', $valid, $detail->id);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data kota / kabupaten'
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

        $detail = $this->modelCities->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data kota / kabupaten tidak ditemukan'
            ], 406);
        }

        $checkOnCustomer = $this->modelCustomer->getTotalDataByCities($input['id']);
        if ($checkOnCustomer > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data kota / kabupaten masih digunakan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data kota / kabupaten'
        ], 200);
    }
}
