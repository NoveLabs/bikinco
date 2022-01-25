<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\Cities;
use App\Http\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class ProvinceController extends Controller
{
    private $modelCities;
    private $modelProvince;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelCities = new Cities();
        $this->modelProvince = new Province();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Province::with('hasCities')->whereNull('deleted_at');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('sales-officer.customer.province-list');
    }

    public function show($id)
    {
        $data = $this->modelProvince->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data provinsi tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data provinsi ditemukan',
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
                'message' => "Nama provinsi '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('provinces', $valid);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        $create = $this->modelProvince->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data provinsi'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data provinsi'
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
        
        $detail = $this->modelProvince->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data provinsi tidak ditemukan'
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

        $check = FormValidation::uniqueColumnValidation('provinces', $valid, $detail->id);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data provinsi'
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

        $detail = $this->modelProvince->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data provinsi tidak ditemukan'
            ], 406);
        }

        $checkOnCities = $this->modelCities->getTotalDataByProvince($input['id']);
        if ($checkOnCities > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data provinsi masih digunakan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data provinsi'
        ], 200);
    }
}
