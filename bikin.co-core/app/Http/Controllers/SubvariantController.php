<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormValidation;
use App\Http\Models\Models;
use App\Http\Models\Subvariant;
use App\Http\Models\Variant;
use App\Http\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubvariantController extends Controller
{
    // Declare Private Variable
    private $productData;
    private $variantData;
    private $subvariantData;
    
    // Declare Instance Constructor
    public function __construct()
    {
        // Initalize Auth Middleware
        $this->middleware('auth');
        
        // Initalize private variable to specified model
        $this->productData    = new Product();
        $this->variantData    = new Variant();
        $this->subvariantData = new Subvariant();
    }
    
    // Public Functions
    public function index(Request $request)
    {
        // Check if ajax request is available
        if($request->ajax()) {
            // Get Source Data
            $data = Subvariant::with('hasProduct')
                ->with('hasVariant')
                ->latest('created_at')
                ->whereNull('deleted_at');
            
            // Initialize Datatables Output, then send the results
            return DataTables::of($data)
                ->addIndexColumn()
                ->editcolumn('status', function ($row) {
                    return $row->status === 1 ? "<span class='uk-label uk-label-success'>Aktif</span>" : "<span class='uk-label uk-label-danger'>Tidak Aktif</span>";
                })
                ->editcolumn('product', function($row) {
                    return !empty($row->hasProduct->name) ? $row->hasProduct->name : "";
                })
                ->editcolumn('variant', function($row) {
                    return !empty($row->hasVariant->name) ? $row->hasVariant->name : "";
                })
                ->editcolumn('created_at', function ($row) {
                    return date('d/m/Y', strtotime($row->created_at));
                })
                ->addColumn('action', function($row) {
                    return "<a href='javascript:get_content_data(".$row->id.");' class='sc-button sc-button-primary'><i class='mdi mdi-eye'></i> Edit</a>";
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        
        // Set compact data content
        $raw_data = [
            'variants'    => $this->variantData->getAllVariants(), // Get All Variants
            'products'    => $this->productData->getAllData(), // Get All Products
            'subvariants' => $this->subvariantData->getAllSubvariants(), // Get All Subvariants
        ];
        
        // Return view with $raw_data content
        return view('product-development.subvariant.subvariant')->with($raw_data);
    }
    
    public function add(Request $request)
    {
        // Validate Data
        $required = [
            'name'    => 'required',
            'product' => 'required',
            'variant' => 'required',
            'status'  => 'numeric|in:0,1'
        ];
//
        // Perform Request Validation
        $validator = Validator::make($request->all(), $required);
        
        // Check if validated
        if ($validator->validated()) {
            
            $condition = [
                [
                    'condition' => [
                        [
                            'name'     => 'name',
                            'opr'      => '=',
                            'value'    => $request->name,
                            'opr_func' => 'where',
                        ],
                    ],
                    'message'   => "Data Subvariant {$request->name}, Telah digunakan sebelumnya",
                ],
            ];
            
            $checking = FormValidation::uniqueColumnValidation('subvariants',
                $condition);
            if ( ! $checking['status']) {
                return response()->json($checking, 406);
            }
            
            // Check if product is not 0
            if ($request->product == 0) {
                // Set Response Output
                $message = [
                    'status'  => true,
                    'data'    => [],
                    'message' => 'Harap Pilih Produk Terlebih Dahulu',
                ];
                
                // Send the response
                return response()->json($message, 500);
                
            }
            
            // If Variant Is O
            if ($request->variant == 0) {
                
                // Set Response Output
                $message = [
                    'status'  => true,
                    'data'    => [],
                    'message' => 'Harap Pilih Variant Terlebih Dahulu',
                ];
                
                // Send the response
                return response()->json($message, 500);
                
            }
            
            // Perform database insertion
            $raw_data = [
                'name'       => $request->name,
                'product_id' => $request->product,
                'variant_id' => $request->variant,
                'status'     => $request->status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ];
            
            // Insert to Database
            $this->subvariantData->insert($raw_data);
            
            // Set Response Content
            $message = [
                'status'  => true,
                'data'    => [],
                'message' => 'Berhasil Menambahkan Data Subvarian',
            ];
            
            // Send the response
            return response()->json($message, 200);
            
        }
        
        // Set response content
        $message = [
            'status'  => true,
            'data'    => [],
            'message' => 'Perintah Gagal, Silakan Coba Lagi.'
        ];
        
        // Send the response
        return response()->json($message, 500);
    }
    
    public function get_data($id)
    {
        // Get Specified Data By ID
        $data = $this->subvariantData->getSpecifiedSubvariant($id);
        
        // Check if $data is empty
        if (empty($data)) {
            // Set Response Content
            $message = [
                'status'  => false,
                'data'    => [],
                'message' => 'Data Subvarian Tidak Ditemukan'
            ];
            
            // Send the response
            return response()->json($message, 404);
        }
        
        // Set response content
        $message = [
            'status'  => true,
            'data'    => $data->get(),
            'message' => 'Data Subvarian Ditemukan',
        ];
        
        // Send the response
        return response()->json($message, 200);
    }
    
    public function get_variant_data($id)
    {
        // Get Specified Data By ID
        $data = Variant::with('hasProduct')
                       ->whereNull('deleted_at')
                       ->where('id', $id)
                       ->get();
        
        // Check if $data is empty
        if (empty($data)) {
            // Set response content
            $message = [
                'status'  => false,
                'data'    => [],
                'message' => 'Data produk tidak ditemukan'
            ];
            
            // Send the response
            return response()->json($message, 404);
        }
        
        // Set response content
        $message = [
            'status'  => true,
            'data'    => $data,
            'message' => 'Data produk ditemukan',
        ];
        
        // Send the response
        return response()->json($message, 200);
    }
    
    public function get_single_data($id)
    {
        // Set All Variants
        $variants = $this->variantData->getAllVariants();
        
        // Get All Product Data
        $products = $this->productData->getAllData();
        
        // Get All Subvariants
        $subvariants = $this->subvariantData->getAllSubvariants();
        
        // Set Response Content
        $message = [
            'status'  => true,
            'data'    => [
                'products'    => $products,
                'variants'    => $variants,
                'subvariants' => $subvariants
            ],
            'message' => 'Data ditemukan',
        ];
        
        // Send the response
        return response()->json($message, 200);
        
    }
    
    public function update_data(Request $request)
    {
        // Declare required request parameter
        $required = [
            'name'       => 'required',
            'product_id' => 'required|numeric',
            'variant_id' => 'required|numeric',
            'status'     => 'numeric|in:0,1',
        ];
        
        // Validate the request
        $validator = Validator::make($request->all(), $required);
        
        // Check is $required is validated
        if ($validator->validated()) {
            // Get Variants Data by ID
            $subvariants = Subvariant::where('id', $request->id);
            
            // Check if $variants is exists
            if ($subvariants->exists()) {
                
                // Perform Database Update
                $parameter = [
                    'name'       => $request->name,
                    'product_id' => $request->product_id,
                    'variant_id' => $request->variant_id,
                    'status'     => $request->status,
                    'updated_at' => Carbon::now(),
                ];
                
                // Update the Database
                $subvariants->update($parameter);
                
                // Set response content
                $message = [
                    'status'  => true,
                    'data'    => [],
                    'message' => 'Data Subvariant Berhasil Diubah.',
                ];
                
                // Send the response
                return response()->json($message, 200);
                
            } else {
                // $variant is not available
                
                // Set response content
                $message = [
                    'status'  => true,
                    'data'    => [],
                    'message' => 'Proses Gagal. Harap Coba Kembali',
                ];
                
                // Send the response
                return response()->json($message, 500);
                
            }
            
        }
    }
    
    public function delete($id)
    {
        // Get Subvariant Data
        $get_variants = Subvariant::with('hasProduct')
            ->with('hasVariant')
            ->where('id', $id);
        
        // Check if $get_variants is available
        if ($get_variants->exists()) {
            
            // check if Model has Available with certain variants
            $model = Models::with('hasProduct')
                ->with('hasVariant')
                ->with('hasSubvariant')
                ->where('subvariant_id',
                    $get_variants->pluck('id')[0])
                ->where('deleted_at', null);
            
            if ($model->exists()) {
                $message = [
                    'status'  => true,
                    'data'    => [],
                    'message' => 'Data Subvarian Sedang Digunakan',
                ];
                
                // Send the response
                return response()->json($message, 500);
            }
            
            // Perform database record deletion
            $get_variants->delete();
            
            // Send response content
            $message = [
                'status'  => true,
                'data'    => [],
                'message' => 'Data Subvariant Berhasil Dihapus',
            ];
            
            // Send the response
            return response()->json($message, 200);
            
        } else {
            // $get_variants is not available
            
            // Set response content
            $message = [
                'status'  => true,
                'data'    => [],
                'message' => 'Proses Gagal, Harap Coba Lagi.',
            ];
            
            // Send the response
            return response()->json($message, 500);
        }
    }
}
