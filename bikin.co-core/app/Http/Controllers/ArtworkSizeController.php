<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\Artwork;
use App\Http\Models\ArtworkSize;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class ArtworkSizeController extends Controller
{
    private $modelArtwork;
    private $modelArtworkSize;

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
            $data = $this->modelArtworkSize->whereNull('deleted_at');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editcolumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="uk-label uk-label-success">Aktif</span>' : '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                    })
                    ->addColumn('alias_artwork', function ($row) {
                        return !empty($row->hasArtwork->name) ? $row->hasArtwork->name : '' ;
                    })
                    ->addColumn('alias_size_type', function ($row) {
                        return empty($row->is_custom) ? 'Ukuran Tetap' : 'Kastem Dimensi';
                    })
                    ->addColumn('alias_size', function ($row) {
                        return empty($row->is_custom) ? strtoupper($row->size) : "{$row->width} x {$row->height}";
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        $artworks = $this->modelArtwork->getAllData();

        return view('sales-officer.etc.artwork-size-list', compact('artworks'));
    }

    public function show($id)
    {
        $data = $this->modelArtworkSize->getSingleData($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data artwork size tidak ditemukan'
            ], 406);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'messsage' => 'Data artwork size ditemukan',
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "is_custom" => "required|numeric|in:0,1",
                "size" => "required_if:is_custom,==,0",
                "width" => "required_if:is_custom,==,1",
                "height" => "required_if:is_custom,==,1",
                "status" => "numeric|in:0,1",
            ]
        );

        $input = Arr::only($request->all(), [
            'size',
            'is_custom',
            'width',
            'height',
            'status'
        ]);

        $valid = [
            [
                'condition' => [
                    ['name' => 'size', 'opr' => '=', 'value' => $input['size'], 'opr_func' => 'where'],
                ],
                'message' => "Nama ukuran artwork '{$input['size']}' sudah digunakan",
            ]
        ];

        if ($input['is_custom'] == 1) {
            $valid = [
                [
                    'condition' => [
                        ['name' => 'width', 'opr' => '=', 'value' => $input['width'], 'opr_func' => 'where'],
                        ['name' => 'height', 'opr' => '=', 'value' => $input['height'], 'opr_func' => 'where'],
                        ['name' => 'artwork_id', 'opr' => '=', 'value' => $input['artwork_id'], 'opr_func' => 'where'],
                    ],
                    'message' => "Nama ukuran artwork '{$input['width']} x {$input['height']}' sudah digunakan",
                ]
            ];
        }

        $check = FormValidation::uniqueColumnValidation('artwork_size', $valid);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        if (!empty($input['size'])) {
            $input['size'] = strtoupper($input['size']);
        }

        $create = $this->modelArtworkSize->create($input);
        if (!$create) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Gagal menambahkan data artwork size'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data artwork size'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                "is_custom" => "required|numeric|in:0,1",
                "size" => "required_if:is_custom,==,0",
                "width" => "required_if:is_custom,==,1",
                "height" => "required_if:is_custom,==,1",
                "status" => "numeric|in:0,1",
            ]
        );

        $input = Arr::only($request->all(), [
            'size',
            'is_custom',
            'width',
            'height',
            'status'
        ]);

        $detail = $this->modelArtworkSize->getSingleData($id);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data artwork size tidak ditemukan'
            ], 406);
        }

        $valid = [
            [
                'condition' => [
                    ['name' => 'size', 'opr' => '=', 'value' => $input['size'], 'opr_func' => 'where'],
                ],
                'message' => "Nama ukuran artwork '{$input['size']}' sudah digunakan",
            ]
        ];

        if ($input['is_custom'] == 1) {
            $valid = [
                [
                    'condition' => [
                        ['name' => 'width', 'opr' => '=', 'value' => $input['width'], 'opr_func' => 'where'],
                        ['name' => 'height', 'opr' => '=', 'value' => $input['height'], 'opr_func' => 'where'],
                        ['name' => 'artwork_id', 'opr' => '=', 'value' => $input['artwork_id'], 'opr_func' => 'where'],
                    ],
                    'message' => "Nama ukuran artwork '{$input['width']} x {$input['height']}' sudah digunakan",
                ]
            ];
        }

        $check = FormValidation::uniqueColumnValidation('artwork_size', $valid, $detail->id);
        if (!$check['status']) {
            return response()->json($check, 406);
        }

        if (!empty($input['size'])) {
            $input['size'] = strtoupper($input['size']);
        }

        $detail->update($input);

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data artwork size'
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

        $detail = $this->modelArtworkSize->getSingleData($input['id']);
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data artwork size tidak ditemukan'
            ], 406);
        }

        $result = $detail->delete($input['id']);

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data artwork size'
        ], 200);
    }
}
