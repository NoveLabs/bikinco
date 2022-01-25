<?php

namespace App\Http\Controllers;

use App\Http\Models\ProductionStepMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class ProductionStepMasterController extends Controller
{
    private $modelStepMaster;

    public function __construct()
    {
        $this->middleware('auth');

        $this->modelStepMaster = new ProductionStepMaster();
    }

    public function show(Request $request, $id)
    {
        $dataStepMaster = $id;

        if ($request->ajax()) {
            $data = ProductionStepMaster::all()->where('category_id', $id)->whereNull('deleted_at');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }


        return view('production-step-master.index', compact('dataStepMaster'));
    }

    public function showSingle($id)
    {
        $data = $this->modelStepMaster->getSingleData($id);

        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Data Ditemukan'
        ], 200);

    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "step_title" => "required",
                "step_description" => "required",
            ]
        );
        
        $input = Arr::only($request->all(), [
            'step_title',
            'step_description', 
            'category_id'
        ]);

        $create = $this->modelStepMaster->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data step master'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data step master'
        ], 200);
    }

    public function edit(Request $request)
    {
         $this->validate($request, [
                "step_title" => "required",
                "step_description" => "required",
            ]
        );
        
        $input = [
        'step_title'  => $request->step_title,
        'step_description'  => $request->step_description,
        'category_id'  => $request->category_id,
        ];
        $detail = $this->modelStepMaster->getSingleData($request->id);
        $detail->update($input);
        if (!$detail) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal edit data step master'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil edit data step master'
        ], 200);
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        ); 

        $input = Arr::only($request->all(), [
            'id',
        ]);

        $detail = $this->modelStepMaster->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data stepmaster tidak ditemukan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data stepmaster'
        ], 200);
    }
}
