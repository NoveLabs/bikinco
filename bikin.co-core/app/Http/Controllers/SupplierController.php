<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\ProductMaterialStock;
use App\Http\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    private $modelSupplier;
    private $modelProductMaterialStock;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelSupplier = new Supplier();
        $this->modelProductMaterialStock = new ProductMaterialStock();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::whereNull('deleted_at');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->editcolumn('created_at', function ($row) {
                        return date('d/m/Y', strtotime($row->created_at));
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        return view('product-development.product-material.supplier-list');
    }

    public function show($id)
    {
        $data = $this->modelSupplier->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data suplier tidak ditemukan.'
            ], 406);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data suplier ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "pic_name" => "required",
                "pic_phone_number" => "required",
                "status" => "numeric|in:0,1",
                "company_name" => "required",
                "company_contact" => "required",
                "company_address" => "required|string",
            ]
        ); 

        $input = Arr::only($request->all(), [
            'pic_name',
            'pic_phone_number',
            'status',
            'company_name',
            'company_contact',
            'company_address',
        ]);

        $valid = [
            [
                'condition' => [
                    ['name' => 'pic_name', 'opr' => '=', 'value' => $input['pic_name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama PIC {$input['pic_name']} sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'pic_phone_number', 'opr' => '=', 'value' => $input['pic_phone_number'], 'opr_func' => 'where'],
                ],
                'message' => "Kontak PIC {$input['pic_phone_number']} sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'company_name', 'opr' => '=', 'value' => $input['company_name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama Perusahaan {$input['company_name']} sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'company_contact', 'opr' => '=', 'value' => $input['company_contact'], 'opr_func' => 'where'],
                ],
                'message' => "Kontak Perusahaan {$input['company_contact']} sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('suppliers', $valid);
        if (!$check['status']) {
            return $check;
        }

        $create = $this->modelSupplier->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data suplier'
            ], 200);
        }
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data suplier'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "pic_name" => "required",
                "pic_phone_number" => "required",
                "status" => "numeric|in:0,1",
                "company_name" => "required",
                "company_contact" => "required",
                "company_address" => "required|string",
            ]
        ); 

        $input = Arr::only($request->all(), [
            'pic_name',
            'pic_phone_number',
            'status',
            'company_name',
            'company_contact',
            'company_address',
        ]);
        
        $detail = $this->modelSupplier->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data suplier tidak ditemukan.'
            ], 406);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'pic_name', 'opr' => '=', 'value' => $input['pic_name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama PIC {$input['pic_name']} sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'pic_phone_number', 'opr' => '=', 'value' => $input['pic_phone_number'], 'opr_func' => 'where'],
                ],
                'message' => "Kontak PIC {$input['pic_phone_number']} sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'company_name', 'opr' => '=', 'value' => $input['company_name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama Perusahaan {$input['company_name']} sudah digunakan",
            ],
            [
                'condition' => [
                    ['name' => 'company_contact', 'opr' => '=', 'value' => $input['company_contact'], 'opr_func' => 'where'],
                ],
                'message' => "Kontak Perusahaan {$input['company_contact']} sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('suppliers', $valid, $detail->id);
        if (!$check['status']) {
            return $check;
        }

        $detail->update($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data suplier'
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

        $detail = $this->modelSupplier->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data suplier tidak ditemukan'
            ], 406);
        }

        $checkOnMaterialStock = $this->modelProductMaterialStock->getTotalDataBySupplier($input['id']);
        if ($checkOnMaterialStock > 0) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data suplier masih digunakan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data suplier'
        ], 200);
    }
}
