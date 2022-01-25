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
use mysql_xdevapi\Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class ModelsController extends Controller
{
    // Declare Private Variable
    private $productData;
    private $variantData;
    private $subvariantData;
    private $modelData;
    
    // Declare Instance Constructor
    public function __construct()
    {
        // Initalize Auth Middleware
        $this->middleware('auth');
        
        // Initalize private variable to specified model
        $this->productData    = new Product();
        $this->variantData    = new Variant();
        $this->subvariantData = new Subvariant();
        $this->modelData      = new Models();
        
    }
    
    // Public Functions
    public function index(Request $request)
    {
        // Check if ajax request is available
        if($request->ajax()) {
            // Get Source Data
            $data = Models::with('hasProduct')
                ->with('hasVariant')
                ->with('hasSubvariant')
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
                ->editcolumn('variant_subvariant', function($row) {
                    return !empty($row->hasVariant->name && $row->hasSubvariant->name) ? $row->hasVariant->name.' - '.$row->hasSubvariant->name  : "";
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
        return view('product-development.models.product_model')->with($raw_data);
    }
    
    public function add(Request $request)
    {
        // Validate Data
        $required = [
            'name'       => 'required',
            'price'      => 'required',
            'product'    => 'required|numeric',
            'variant'    => 'required|numeric',
            'file'       => 'nullable',
            'subvariant' => 'required|numeric',
            'status'     => 'numeric|in:0,1'
        ];
        
        // Perform Request Validation for $required
        $this->validate($request, $required);
        
        $variant = $this->variantData->getSpecifiedVariant($request->variant);
        if ( ! $variant->exists()) {
            // Set response content
            $message = [
                'status'  => true,
                'data'    => [],
                'message' => 'Silakan Pilih Subvariant Terlebih Dahulu',
            ];
            
            // Send the response
            return response()->json($message, 200);
        }
        
        $subvariant
            = $this->subvariantData->getSpecifiedSubvariant($request->subvariant);
        if ( ! $subvariant->exists()) {
            // Set response content
            $message = [
                'status'  => true,
                'data'    => [],
                'message' => 'Silakan Pilih Subvariant Terlebih Dahulu',
            ];
            
            // Send the response
            return response()->json($message, 200);
        }
        
        // Validation Unique Name
        $validation = [
            [
                'condition' => [
                    [
                        'name'     => 'name',
                        'opr'      => '=',
                        'value'    => $request->name,
                        'opr_func' => 'where',
                    ],
                ],
                'message'   => "Nama Model '{$request->name}' sudah digunakan sebelumnya.",
            ],
        ];
        
        // Perform FormValidation -> Unique Column Validation Checker
        $checking = FormValidation::uniqueColumnValidation('models',
            $validation);
        if ( ! $checking['status']) {
            return response()->json($checking, 406);
        }
        
        // Perform Upload File
        if ($request->hasFile('file')) {
            $imageData = [
                'inputname' => 'file',
                'folder'    => 'upload_image/models',
            ];
            
            $image     = FormValidation::uploadOne($request,
                $imageData['inputname'], $imageData['folder']);
            $imageData = $image;
            
        } else {
            
            $imageData = null;
            
        }
        
        // Perform database insertion
        $raw_data = [
            'name'          => $request->name,
            'price'         => $request->price,
            'product_id'    => $request->product,
            'variant_id'    => $request->variant,
            'subvariant_id' => $request->subvariant,
            'status'        => $request->status,
            'file'          => $imageData,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
            'deleted_at'    => null,
        ];
        
        // Insert to Database
        $this->modelData->insert($raw_data);
        
        // Set response content
        $message = [
            'status'   => true,
            'data'     => [],
            'filename' => $imageData,
            'message'  => 'Berhasil menambahkan Model',
        ];
        
        // Send the response
        return response()->json($message, 200);
        
    }
    
    public function get_data($id)
    {
        // Get Model Data By ID
        $data = $this->modelData->getSpecifiedModel($id);
        
        // Check if $data is empty
        if (empty($data)) {
            // Set response content
            $message = [
                'status'  => false,
                'data'    => [],
                'message' => 'Data Model Tidak Ditemukan'
            ];
            
            // Send the response
            return response()->json($message, 404);
        }
        
        // Set Response content
        $message = [
            'status'   => true,
            'data'     => $data,
            'filename' => basename($data->pluck('file')[0]),
            'message'  => 'Data Model Ditemukan',
        ];
        
        // Send the response
        return response()->json($message, 200);
    }
    
    public function get_variant_data($id)
    {
        // Get Specified Data By ID
        $data = Variant::with('hasProduct')
            ->whereNull('deleted_at')
            ->get();
        
        // Check if $data is empty
        if (empty($data)) {
            // Set response content
            $message = [
                'status'  => false,
                'data'    => [],
                'message' => 'Data Model Tidak Ditemukan'
            ];
            
            // Send the response
            return response()->json($message, 404);
        }
        
        // Set response content
        $message = [
            'status'  => true,
            'data'    => $data,
            'message' => 'Data Model ditemukan',
        ];
        
        // Send the response
        return response()->json($message, 200);
    }
    
    public function get_subvariant_data($id)
    {
        // Get Subvariant Data by ID
        $data = Subvariant::with('hasVariant')
            ->with('hasProduct')
            ->where('variant_id', $id)
            ->whereNull('deleted_at')
            ->get();
        
        // Check if $data is empty
        if (empty($data)) {
            // Set response message
            $message = [
                'status'  => false,
                'data'    => [],
                'message' => 'Data Model Tidak Ditemukan'
            ];
            
            // Send the response
            return response()->json($message, 404);
        }
        
        // Set response message
        $message = [
            'status'  => true,
            'data'    => $data,
            'message' => 'Data Model ditemukan',
        ];
        
        // Send the response
        return response()->json($message, 200);
    }
    
    public function get_single_data($id)
    {
        // Get All Variants
        $variants = $this->variantData->getAllVariants();
        
        // Get All Products
        $products = $this->productData->getAllData();
        
        // Get All Subvariants
        $subvariants = $this->subvariantData->getAllSubvariants();
        
        // Get All Models
        $models = $this->modelData->getAllModels();
        
        // Set response content
        $message = [
            'status'  => true,
            'data'    => [
                'products'    => $products,
                'variants'    => $variants,
                'subvariants' => $subvariants,
                'models'      => $models
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
            'name'          => 'required',
            'price'         => 'required',
            'subvariant_id' => 'required',
            'product_id'    => 'required',
            'variant_id'    => 'required',
            'new_file'      => 'nullable',
            'status'        => 'numeric|in:0,1',
        ];
        
        // Perform Request Validation
        $validator = Validator::make($request->all(), $required);
        
        // Check if request is validated
        if ($validator->validated()) {
            // Get Variants Data By ID
            $models = Models::where('id', $request->id);
            
            // Check if $variant is Available
            if ($models->exists()) {
                
                // Check if Files are Available
                if ($request->hasFile('new_file')) {
                    // Get All Files
                    $file = $request->file('new_file');
                    
                    // Get File Extension / File Format
                    $extension = $file->getClientOriginalName();
                    
                    
                    $filename = "models-image" . uniqid() . "." . $extension;
                    
                    // Save to directory
                    $file->move("upload_image/models/", $filename);
                    
                    // Get the file path
                    $files = "upload_image/models/" . $filename;
                    
                } else {
                    $files = $models->pluck('file')[0];
                }
                
                // Perform Database Update
                $parameter = [
                    'name'          => $request->name,
                    'price'         => $request->price,
                    'subvariant_id' => $request->subvariant_id,
                    'product_id'    => $request->product_id,
                    'variant_id'    => $request->variant_id,
                    'status'        => $request->status,
                    'file'          => $files,
                    'updated_at'    => Carbon::now(),
                ];
                
                // Update the Database
                $models->update($parameter);
                
                // Set response content
                $message = [
                    'status'  => true,
                    'data'    => [],
                    'message' => 'Data Subvariant Berhasil Diubah.',
                ];
                
                // Send the response
                return response()->json($message, 200);
                
            }
        }
    }
    
    // Delete Model Item
    public function delete($id)
    {
        // Get Models Data by ID
        $get_models = Models::with('hasProduct')
            ->with('hasVariant')
            ->with('hasSubvariant')
            ->where('id', $id);
        
        // Check if $get_models is available
        if ($get_models->exists()) {
            // Perform record deletion
            $get_models->delete();
            
            // Set response message
            $message = [
                'status'  => true,
                'data'    => [],
                'message' => 'Data Subvariant Berhasil Dihapus',
            ];
            
            // Send the response
            return response()->json($message, 200);
            
        } else {
            // $get_models is not available
            
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
