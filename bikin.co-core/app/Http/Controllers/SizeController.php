<?php

namespace App\Http\Controllers;

use App\Services\VendorService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Helpers\UploadFile;
use App\Http\Models\Sizepack as Size;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SizeController extends Controller
{
    // declare private variable
    private $sizeData;
    private $vendor;

    // Construct
    public function __construct()
    {
        // Middleware
        $this->middleware('auth');

        // Call Model
        $this->upload = new UploadFile();
        $this->sizeData = new Size;

        $this->vendor = new VendorService();
    }

    // index Function
    public function index(Request $request)
    {
        // Check if ajax request is available
        if($request->ajax()) {
            // Get Source Data
            $data = $this->sizeData->getLatestSizepacks();

            // Initialize Datatables Output, then send the results
            return DataTables::of($data)
                ->addIndexColumn()
                ->editcolumn('vendor_name', function ($row) {
                    return "<a href='javascript:getContentImage(".$row->id.")'>".$row->vendor_name."</a>";
                })
                ->editcolumn('status', function ($row) {
                    return $row->status === 1 ? "<span class='uk-label uk-label-success'>Aktif</span>" : "<span class='uk-label uk-label-danger'>Tidak Aktif</span>";
                })
                ->editcolumn('created_at', function ($row) {
                    return date('d/m/Y', strtotime($row->created_at));
                })
                ->addColumn('action', function($row) {
                    return "<a class='sc-button sc-button-success sc-js-button-wave-light' href='javascript:getContentData(".$row->id.");'> Edit</a>"."&nbsp;&nbsp;&nbsp;&nbsp;"."<a class='sc-button sc-button-primary sc-js-button-wave-light' href='javascript:getContentImage(".$row->id.")'> Lihat</a>";
                })
                ->rawColumns(['status', 'action', 'vendor_name'])
                ->make(true);
        }

        // Set compact data content
        $raw_data = [
            'sizepacks' => $this->sizeData->getAllSizepacks(), // Get All SizePacks
        ];

        //get Data vendor

        $dataVendor = $this->sizeData->getDataVendor();


        // Return view with $raw_data content
        return view('product-development.sizepack.sizepack', compact('dataVendor'))->with($raw_data);
    }

    // Add Function
    public function add(Request $request)
    {
        // Declare required parameter
        $required = [
            'vendor_name' => 'required',
            'size_code' => 'required',
            'status' => 'required|numeric|in:0,1',
            'file' => 'nullable',
        ];

        // Validation
        $validation = Validator::make($request->all(), $required);

        // Check if exist
        if ($validation->validated()) {
            // Check uploaded file
            

            $vendor = $this->vendor->filterVendorsWhere('id', $request->vendor_name);

            // Perform Database Insertion
            $raw_data = [
                'vendor_name' => $vendor[0]->vendor_name,
                'vendor_id' => $request->vendor_name,
                'size_code' => $request->size_code,
                'status' => $request->status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            $result = $this->sizeData->create($raw_data);

            if ($request->hasFile('file')) {
                if ($request->has('file')) {
                    // Get image file
                    $image = $request->file('file');

                }

            } else {

                $image = null;
            }

            $dataUpload =  $this->upload->uploadOneFile($image, 'awsfolderpengaturansizepack', [
                [
                    'height' => 320,
                    'prefix' => '',
                ],
                [
                    'height' => 160,
                    'prefix' => 'sm_',
                ],
                [
                    'height' => 80,
                    'prefix' => 'xs_',
                ],
            ]);
            //update photo

            $result->update([
                "file"           => $dataUpload['file_name'],
                "width"               => $dataUpload['width'],
                "height"              => $dataUpload['height'],
            ]);
            // Set response message
            $message = [
                'status' => true,
                'data' => [],
                'message' => 'Berhasil Menambahkan SizepackRepo item'
            ];

            // Send
            return response()->json($message, 200);
        }

        // Set response message
        $message = [
            'status' => true,
            'data' => [],
            'message' => 'Gagal Menambahkan SizepackRepo'
        ];

        // Send
        return response()->json($message, 200);

    }

    // Get Image Function
    public function getImage($id)
    {
        // Get SizepackRepo data from DB
        $source = $this->sizeData->getSpecifiedSizepacks($id)->first();

        // Check if exists
        if ($source->exists()) {
            // Set response message
            $message = [
                'status' => true,
                'data' => $source->pluck('file')[0],
                'message' => 'Data Ditemukan'
            ];

            // Send
            return response()->json($message, 200);
        }

        // Set response message
        $message = [
            'status' => true,
            'data' => [],
            'message' => 'Data Tidak Ditemukan'
        ];

        // Send
        return response()->json($message, 200);
    }

    // Function Get Variable Item
    public function getSizepackItem($id)
    {
        // Get Source Data
        $source = $this->sizeData->getSpecifiedSizepacks($id);

        // Check if exists
        if ($source->exists()) {
            // Set response message
            $message = [
                'status' => true,
                'data' => $source->get(),
                'filename' => basename($source->pluck('file')[0]),
                'message' => 'Data Ditemukan'
            ];

            // Send
            return response()->json($message, 200);
        }

        // Set response message
        $message = [
            'status' => true,
            'data' => [],
            'message' => 'Data Tidak Ditemukan'
        ];

        // Send
        return response()->json($message, 200);
    }

    // Function Update Data
    public function updateData(Request $request, $id)
    {
        // Declare required parameter
        $required = [
            'vendor_name' => 'required',
            'size_code' => 'required',
            'status' => 'required|numeric|in:0,1',
            'file' => 'nullable',
        ];

        // Validation
        $validation = Validator::make($request->all(), $required);

        // Check if exist
        if ($validation->validated()) {
            // Get SizepackRepo Data From DB
            $source = $this->sizeData->getSpecifiedSizepacks($id);
            $vendor = $this->vendor->filterVendorsWhere('id', $request->vendor_name);

            // Check if Exists
            if ($source->exists()) {
                // Check uploaded file
                if ($request->hasFile('file')) {
                    if ($request->has('file')) {
                        // Get image file
                        $file = $request->file('file');
                    }

                } else {

                    $file = $source->pluck('file')[0];
                }

                // Perform Database Insertion
                $raw_data = [
                    'vendor_name' => $vendor[0]->vendor_name,
                    'vendor_id' => $request->vendor_name,
                    'size_code' => $request->size_code,
                    'status' => $request->status,
                    'updated_at' => Carbon::now()
                ];

                $source->update($raw_data);

                $dataUpload =  $this->upload->uploadOneFile($file, 'awsfolderpengaturansizepack', [
                    [
                        'height' => 320,
                        'prefix' => '',
                    ],
                    [
                        'height' => 160,
                        'prefix' => 'sm_',
                    ],
                    [
                        'height' => 80,
                        'prefix' => 'xs_',
                    ],
                ]);
                //update photo

                $source->update([
                    "file"           => $dataUpload['file_name'],
                    "width"               => $dataUpload['width'],
                    "height"              => $dataUpload['height'],
                ]);

                // Set response message
                $message = [
                    'status' => true,
                    'data' => [],
                    'message' => 'Berhasil Mengubah SizepackRepo Data'
                ];

                // Send
                return response()->json($message, 200);
            }

            // Set response message
            $message = [
                'status' => true,
                'data' => [],
                'message' => 'Data SizepackRepo Tidak Ditemukan'
            ];

            // Send
            return response()->json($message, 200);

        }

        // Set response message
        $message = [
            'status' => true,
            'data' => [],
            'message' => 'Gagal Mengubah SizepackRepo'
        ];

        // Send
        return response()->json($message, 200);
    }

    // Function Delete
    public function deleteData($id)
    {
        // Check sizepack data from database
        $source = $this->sizeData->getSpecifiedSizepacks($id);

        // Check if exists
        if ($source->exists()) {
            // Perform Database Deletion
            $source->delete();

            // Set response message
            $message = [
                'status' => true,
                'data' => [],
                'message' => 'Berhasil Menghapus SizepackRepo Data'
            ];

            // Send
            return response()->json($message, 200);
        }

        // Set response message
        $message = [
            'status' => true,
            'data' => [],
            'message' => 'Gagal Menghapus SizepackRepo Data'
        ];

        // Send
        return response()->json($message, 200);
    }
}
