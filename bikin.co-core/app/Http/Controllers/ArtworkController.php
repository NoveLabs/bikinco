<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;

use App\Http\Models\Artwork;

use App\Http\Models\ArtworkSize;

use Illuminate\Http\Request;

use Illuminate\Support\Arr;

use Yajra\DataTables\DataTables;

class ArtworkController extends Controller
{
    private $modelArtworkSize;
    private $modelArtwork;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->modelArtwork = new Artwork();
        $this->modelArtworkSize = new ArtworkSize();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelArtwork->whereNull('deleted_at');

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

        return view('sales-officer.etc.artwork-list');
    }

    public function show($id)
    {
        $data = $this->modelArtwork->getSingleData($id);
        
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data artwork tidak ditemukan.'
            ], 406);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data artwork ditemukan',
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
            'name','status'
        ]);

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama artwork '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('artworks', $valid);
        if (!$check['status']) {
            return $check;
        }

        $create = $this->modelArtwork->create($input);

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data artwork'
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
            'name','status'
        ]);

        $detail = $this->modelArtwork->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data artwork tidak ditemukan.'
            ], 403);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'name', 'opr' => '=', 'value' => $input['name'], 'opr_func' => 'where'],
                ],
                'message' => "Nama artwork '{$input['name']}' sudah digunakan",
            ]
        ];

        $check = FormValidation::uniqueColumnValidation('artworks', $valid, $detail->id);
        if (!$check['status']) {
            return $check;
        }

        $detail->update($input);

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data artwork'
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        );

        $input = $request->all();

        // $detail = $this->modelArtworkSize->getTotalDataByArtwork($input['id']);
        // if (empty($detail)) {
        //     return response()->json([
        //         'status' => false,
        //         'data' => [],
        //         'message' => 'Data artwork masih digunakan'
        //     ], 403);
        // }

        // $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data artwork'
        ], 200);
    }
}
