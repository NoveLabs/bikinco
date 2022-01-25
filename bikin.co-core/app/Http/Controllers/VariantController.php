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

class VariantController extends Controller
{
    // Declare Private Variable
    private $productData;
    private $variantData;
    
    // Declare Instance Constructor
    public function __construct()
    {
        // Initalize Auth Middleware
        $this->middleware('auth');
        
        // Initalize private variable to specified model
        $this->productData = new Product();
        $this->variantData = new Variant();
    }
    
    // Public Functions
    public function index(Request $request)
    {
        // Check if ajax request is available
        if($request->ajax()) {
            // Get Source Data
            $data = Variant::with('hasProduct')
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
                ->editcolumn('created_at', function ($row) {
                    return date('d/m/Y', strtotime($row->created_at));
                })
                ->addColumn('action', function($row) {
                    return "<a href='javascript:getContentData(".$row->id.");' class='sc-button sc-button-primary'><i class='mdi mdi-eye'></i> Edit</a>";
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        
        // Set compact data content
        $raw_data = [
            'variants' => $this->variantData->getAllVariants(), // Get All Variants
            'products' => $this->productData->getAllData(), // Get All Products
        ];
        
        // Return view with $raw_data content
        return view('product-development.variant.variant')->with($raw_data);
    }
    
    public function add(Request $request)
    {
        // Validate Data
        $required  = [
            'name'    => 'required',
            'product' => 'required|numeric',
            'status'  => 'numeric|in:0,1'
        ];
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
                    'message'   => "Data Variant {$request->name}, sudah digunakan sebelumnya.",
                ],
            ];
            
            $checking = FormValidation::uniqueColumnValidation('variants',
                $condition);
            if ( ! $checking['status']) {
                return response()->json($checking, 406);
            }
            
            // Check If product is 0
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
            
            // Perform database insertion
            $raw_data = [
                'name'       => $request->name,
                'product_id' => $request->product,
                'status'     => $request->status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ] ;
            
            // Insert to Database
            Variant::create($raw_data);
            
            // Set Response Output
            $message = [
                'status'  => true,
                'data'    => [],
                'message' => 'Berhasil Menambahkan Data Varian'
            ];
            
            // Send the response
            return response()->json($message, 200);
            
        }
        
        // Set Response Output
        $message = [
            'status'  => true,
            'data'    => [],
            'message' => 'Gagal Menambahkan Data Varian, Silakan Coba Lagi'
        ];
        
        // Send the response
        return response()->json($message, 500);
    }
    
    public function get_data($id)
    {
        // Get Specified Data By ID
        $data = $this->variantData->getSpecifiedVariant($id);
        
        // Check if it's empty
        if (empty($data)) {
            // Set Response Content
            $message = [
                'status'  => false,
                'data'    => [],
                'message' => 'Data Varian Tidak Ditemukan'
            ];
            
            // Send the response
            return response()->json($message, 404);
        }
        
        // Set Message Content
        $message = [
            'status'  => true,
            'data'    => $data->get(),
            'message' => 'Data Varian Ditemukan',
        ];
        
        // Send the response
        return response()->json($message, 200);
    }
    
    public function get_single_data($id){
        
        // Get All Variants
        $variants = $this->variantData->getAllVariants();
        
        // Get All Product Data
        $products = $this->productData->getAllData();
        
        // Set Response Content
        $message = [
            'status'  => true,
            'data'    => [
                'products' => $products,
                'variants' => $variants
            ],
            'message' => 'Data sub-kategori ditemukan',
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
            'status'     => 'numeric|in:0,1',
        ];
        
        // Validate the requests
        $validator = Validator::make($request->all(), $required);
        
        // Check if validated
        if ($validator->validated()) {
            // Get Variant Item By ID
            $variants = Variant::where('id', $request->id);
            
            // Check if $variants is available
            if ($variants->exists()) {
                
                // Perform Database Update
                $parameter = [
                    'name'       => $request->name,
                    'product_id' => $request->product_id,
                    'status'     => $request->status,
                    'updated_at' => Carbon::now(),
                ];
                
                // Update the database
                $variants->update($parameter);
                
                // Set Response Content
                $message = [
                    'status'  => true,
                    'data'    => [],
                    'message' => 'Data Varian Berhasil Diubah.',
                ];
                
                // Send the response
                return response()->json($message, 200);
                
            } else {
                // Variant Data Not Found
                
                // Send Error Message Content
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
        
        // Get Variants By ID
        $get_variants = Variant::with('hasProduct')
            ->where('id', $id);
        
        // If $get_variants is avalable, then do the Database Record Deletion
        if ($get_variants->exists()) {
            // Get Subvariants by Variants ID
            $subvariants = Subvariant::with('hasProduct')
                ->with('hasVariant')
                ->where('variant_id',
                    $get_variants->pluck('id')[0])
                ->whereNull('deleted_at');
            
            // Check If subvariant is exists
            if ($subvariants->exists()) {
                // Set response contents
                $message = [
                    'status'  => true,
                    'data'    => [],
                    'message' => 'Data masih digunakan',
                ];
                
                // Send the database
                return response()->json($message, 500);
            }
            
            
            // Perform database record deletion
            $get_variants->delete();
            
            // Set response contents
            $message = [
                'status'  => true,
                'data'    => [],
                'message' => 'Data Varian Berhasil Dihapus',
            ];
            
            // Send the database
            return response()->json($message, 200);
            
        } else {
            // if $get_variants is not available,
            
            // Send response contents
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
