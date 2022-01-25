<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\UploadFile;
use App\Http\Models\CategoryBlog;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use App\Http\Helpers\FormValidation;

class CategoryBlogController extends Controller
{
    private $modelCategoryBlog;
    
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelCategoryBlog = new CategoryBlog();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelCategoryBlog->GetAllRecord()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>
                        ';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

    	return view('superadmin.category-blog.index');
    }

    public function getDataAll()
    {
        $data = $this->modelCategoryBlog->getAll()->get();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Category Blog tidak ditemukan.'
            ], 403);
        }
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Berhasil menemukan data Category Blog'
        ], 200);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
                "name" => "required",
            ]
        );

        $input = Arr::only($request->all(), [
            'name',
        ]);

        $result = $this->modelCategoryBlog->create($input);
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data Category Blog'
        ], 200);
    }

    public function update(Request $request, $id)
    {   
        $input = Arr::only($request->all(), [
            'name',

        ]);
        $detail = $this->modelCategoryBlog->getSingleData($id);
        
        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Category Blog tidak ditemukan.'
            ], 403);
        }

        $detail->update($input);

        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data Category Blog'
        ], 200);
    }

    public function show($id)
    {
        $data = $this->modelCategoryBlog->getSingleRecord($id)->first();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data CategoryBlog tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data CategoryBlog ditemukan',
        ], 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        ); 

        $input = $request->all();
        $detail = $this->modelCategoryBlog->getSingleData($request->id);
        $result = $detail->delete();

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data Category Blog'
        ], 200);
    }

}
