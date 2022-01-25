<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\MaterialSpecification;
use App\Http\Models\MaterialSpecificationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class MaterialSpecificationController extends Controller
{
    private $modelMaterialSpecification;
    private $modelMaterialSpecificationItem;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelMaterialSpecification = new MaterialSpecification();
        $this->modelMaterialSpecificationItem = new MaterialSpecificationItem();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MaterialSpecification::whereNull('deleted_at');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        return view('product-development.product-material.specification-list');
    }

    public function show($id)
    {
        $data = $this->modelMaterialSpecification->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi material tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data spesifikasi material ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
                "status" => "numeric|in:0,1",
            ]
        );
        
        $input = Arr::only($request->all(), [
            'name',
            'status'
        ]);

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama spesifikasi '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('material_specifications', $valid);
        if (!$check['status']) {
            return $check;
        }

        $create = $this->modelMaterialSpecification->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data spesifikasi material'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data spesifikasi material'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "name" => "required",
                "status" => "numeric|in:0,1",
            ]
        ); 
        
        $input = Arr::only($request->all(), [
            'name',
            'status'
        ]);
        
        $detail = $this->modelMaterialSpecification->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi material tidak ditemukan'
            ], 406);
        }
        
        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama spesifikasi '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('material_specifications', $valid, $detail->id);
        if (!$check['status']) {
            return $check;
        }

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data spesifikasi material'
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

        $detail = $this->modelMaterialSpecification->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi material tidak ditemukan'
            ], 406);
        }

        $checkOnItem = $this->modelMaterialSpecificationItem->getTotalDataBySpecificiation($input['id']);
        if ($checkOnItem > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data spesifikasi material masih digunakan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data spesifikasi material'
        ], 200);
    }
}
