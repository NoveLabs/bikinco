<?php

namespace App\Http\Controllers;

use App\Http\Models\AtworkPrintMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use App\Http\Helpers\FormValidation;


class AtworkPrintMethodController extends Controller
{


     /**
     * [__construct description]
    */
    public function __construct()
    {
        $this->model = new AtworkPrintMethod();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->model->all();
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
        return view('product-development.atwork.print_method');
    }

    public function show($id)
    {
        $data = $this->model->findOrfail($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data  tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data  ditemukan',
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
                'message' => "Nama  '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('artwork_print_methods', $valid);
        if (!$check['status']) {
            return $check;
        }

        $create = $this->model->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data '
            ], 406);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data '
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

        $detail = $this->model->findOrFail($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data  tidak ditemukan'
            ], 406);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama  '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('artwork_print_methods', $valid, $id);

        if (!$check['status']) {
            return $check;
        }

        $detail->update($input);

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data'
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

        $detail = $this->model->findOrFail($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data tidak ditemukan'
            ], 406);
        }


        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data '
        ], 200);
    }
}
