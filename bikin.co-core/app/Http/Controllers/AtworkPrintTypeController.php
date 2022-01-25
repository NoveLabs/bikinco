<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\AtworkPrintType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;


class AtworkPrintTypeController extends Controller
{

    public function __construct()
    {
        $this->model = new AtworkPrintType();
    }

    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = $this->model->latest('created_at')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editcolumn('status', function ($row) {
                    return $row->status === 1 ? "<span class='uk-label uk-label-success'>Aktif</span>" : "<span class='uk-label uk-label-danger'>Tidak Aktif</span>";
                })
                ->addColumn('action', function($row) {
                    return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('product-development.atwork.material_cetak');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
                "price" => "required",
                "status" => "numeric|in:0,1",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
            'status',
            'price',
            'description'
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


    // public function get_data($id)
    // {
    //     $data = $this->variantData->getSpecifiedVariant($id);

    //     if (empty($data)) {
    //         $message = [
    //             'status'  => false,
    //             'data'    => [],
    //             'message' => 'Data Varian Tidak Ditemukan'
    //         ];

    //         return response()->json($message, 404);
    //     }

    //     $message = [
    //         'status'  => true,
    //         'data'    => $data->get(),
    //         'message' => 'Data Varian Ditemukan',
    //     ];

    //     return response()->json($message, 200);
    // }

    // public function get_single_data($id){

    //     $variants = $this->variantData->getAllVariants();

    //     $products = $this->productData->getAllData();

    //     $message = [
    //         'status'  => true,
    //         'data'    => [
    //             'products' => $products,
    //             'variants' => $variants
    //         ],
    //         'message' => 'Data sub-kategori ditemukan',
    //     ];

    //     // Send the response
    //     return response()->json($message, 200);

    // }



    // public function delete($id)
    // {

    //     // Get Variants By ID
    //     $get_variants = Variant::with('hasProduct')
    //         ->where('id', $id);

    //     // If $get_variants is avalable, then do the Database Record Deletion
    //     if ($get_variants->exists()) {
    //         // Get Subvariants by Variants ID
    //         $subvariants = Subvariant::with('hasProduct')
    //             ->with('hasVariant')
    //             ->where('variant_id',
    //                 $get_variants->pluck('id')[0])
    //             ->whereNull('deleted_at');

    //         if ($subvariants->exists()) {
    //             $message = [
    //                 'status'  => true,
    //                 'data'    => [],
    //                 'message' => 'Data masih digunakan',
    //             ];

    //             return response()->json($message, 500);
    //         }

    //         $get_variants->delete();

    //         $message = [
    //             'status'  => true,
    //             'data'    => [],
    //             'message' => 'Data Varian Berhasil Dihapus',
    //         ];

    //         return response()->json($message, 200);

    //     } else {

    //         $message = [
    //             'status'  => true,
    //             'data'    => [],
    //             'message' => 'Proses Gagal, Harap Coba Lagi.',
    //         ];

    //         return response()->json($message, 500);
    //     }

    // }


}
