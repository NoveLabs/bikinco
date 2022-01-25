<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\UploadFile;
use App\Http\Models\Blog;
use App\Http\Models\CategoryBlog;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\FormValidation;

class BlogController extends Controller
{
    private $modelBlog;
    private $modelCategoryBlog;
    
    public function __construct()
    {
        $this->middleware('auth');

        $this->modelBlog = new Blog();
        $this->modelCategoryBlog = new CategoryBlog();
        $this->upload = new UploadFile();

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->modelBlog->GetAllRecord()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('image', function($row){
                        return '<img src="'.$row->image.'" alt="gambar">'; 
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="javascript:showDetail(' . $row->id . ');" class="sc-button sc-button-success sc-js-button-wave-light" href="#" ><i class="mdi md-color-white mdi-eye-outline"></i> Edit</a>
                        ';
                    })
                    ->rawColumns(['action', 'image'])
                    ->make(true);
        }
        $cat_blog = $this->modelCategoryBlog->getAll()->get();

    	return view('superadmin.blog.index', compact('cat_blog'));
    }

    public function addBlog(Request $request)
    {
        $id =  Auth::user()->id;

        $this->validate($request, [
                "blog" => "image|mimes:jpeg,png,jpg",
            ]
        );

        $input = Arr::only($request->all(), [
            'title',
            'status',
            'content',
            'category_blog_id'
        ]);

        $remove = str_replace(' ', '', $request->title);
        $slug = strtolower($remove).mt_rand(1000,9999);

        $input['slug'] = $slug;
        $input['created_by'] = $id;
         #upload to s3
       $result = $this->modelBlog->create($input);

          //if with photo uploader
        if(!empty($request->blog)){
            $dataUpload =  $this->upload->uploadOneFile($request->blog, 'awsfolderblog', [
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
                "image"                 => $dataUpload['file_name'],
                "width_image"               => $dataUpload['width'],
                "height_image"              => $dataUpload['height'],
            ]);
        }
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil menambahkan data blog'
        ], 200);
    }

    public function updateBlog(Request $request, $id)
    {   
        $input = Arr::only($request->all(), [
            'title',
            'status',
            'content',
            'category_blog_id',
        ]);

        $id_admin =  Auth::user()->id;
        $input['created_by'] = $id_admin;
        $remove = str_replace(' ', '', $request->title);
        $slug = strtolower($remove).mt_rand(1000,9999);
        
        $input['slug'] = $slug;
        $detail = $this->modelBlog->getSingleData($id);


        if (empty($detail)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data blog tidak ditemukan.'
            ], 403);
        }

        $detail->update($input);


        if($request->blog != 'undefined') {
            $dataUpload =  $this->upload->uploadOneFile($request->blog, 'awsfolderblog', [
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
            $detail->update([
                "image"                 => $dataUpload['file_name'],
                "width_image"               => $dataUpload['width'],
                "height_image"              => $dataUpload['height'],
            ]);
        }
        
        return response()->json([
            'status' => true,
            'data' => [],
            'message' => 'Berhasil memperbaharui data blog'
        ], 200);
    }

    public function showBlog($id)
    {
        $data = $this->modelBlog->getSingleRecord($id)->first();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data Blog tidak ditemukan.'
            ], 403);
        }

        return response()->json([
            'status' => true, 
            'data' => $data,
            'messsage' => 'Data Blog ditemukan',
        ], 200);
    }

    public function deleteBlog(Request $request)
    {
        $this->validate($request, [
                "id" => "required|numeric",
            ]
        ); 

        $input = $request->all();
        $detail = $this->modelBlog->getSingleData($request->id);
        $result = $detail->delete();

        return response()->json([
            'status' => true,
            'data' => $result,
            'message' => 'Berhasil menghapus data blog'
        ], 200);
    }

}
