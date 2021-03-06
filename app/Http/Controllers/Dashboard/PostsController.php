<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Storage;
use App\Post;
use App\Category;

class PostsController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing view of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = \Route::currentRouteName();
        $route = explode('.', $route);
        $controller = $route[0];
        return view('layouts.dashboard.posts.index')->with(array(
            'controller' => $controller
        ));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax()
    {
        // Using Eloquent
        $rows = Post::with('user', 'category')->select(['posts.*']);

        return Datatables::of($rows)
                ->addColumn('action', function ($row) {
                    $html = '
                        <a href="'.url('dashboard/posts/'.$row->id.'/edit').'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="javascript:void(0);" data-id="'.$row->id.'" data-token="'.csrf_token().'" class="btn btn-xs btn-default btnDelete"><i class="glyphicon glyphicon-trash"></i></a>
                    ';
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = \Route::currentRouteName();
        $route = explode('.', $route);
        $controller = $route[0];
        $categories = Category::all();
        
        return view('layouts.dashboard.posts.create')->with(array(
            'controller' => $controller,
            'categories' => $categories
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        
        $row = new Post;
        
        $status = empty($request->input('status')) ? 'Inactive' : 'Active';
        $filename = $request->input('filename');
        
        if(!empty($filename)){
            $exists = Storage::exists('uploads/temp/'.$filename);
            if($exists){
                $monthYear = date('m-Y');
                $postsImagesPath = 'posts/images/'.$monthYear;
                Storage::move('uploads/temp/'.$filename, 'uploads/'.$postsImagesPath.'/'.$filename);
                
                $row->uploads_dir = $postsImagesPath;
                $row->image = $filename;
            }
        }
        
        $row->user_id = auth()->user()->id;
        $row->category_id = $request->input('category_id');
        $row->title = $request->input('title');
        $row->body = $request->input('description');
        $row->status = $status;
        if($row->save()){
            echo 'success'; exit;
        } else{
            echo 'error'; exit;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = \Route::currentRouteName();
        $route = explode('.', $route);
        $controller = $route[0];
        
        $row = Post::find($id);
        $categories = Category::all();
        return view('layouts.dashboard.posts.edit')->with(array(
            'controller' => $controller,
            'row' => $row,
            'categories' => $categories
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        
        $row = Post::find($id);
        
        $status = empty($request->input('status')) ? 'Inactive' : 'Active';
        $filename = $request->input('filename');
        
        if(!empty($filename)){
            if($row->image !== $filename){
                $exists = Storage::exists('uploads/temp/'.$filename);
                if($exists){
                    Storage::delete('uploads/'.$row->uploads_dir.'/'.$row->image);
                    
                    $monthYear = date('m-Y');
                    $postsImagesPath = 'posts/images/'.$monthYear;
                    Storage::move('uploads/temp/'.$filename, 'uploads/'.$postsImagesPath.'/'.$filename);

                    $row->uploads_dir = $postsImagesPath;
                    $row->image = $filename;
                }
            }
        } else{
            $row->uploads_dir = NULL;
            $row->image = NULL;
        }
        
        $row->title = $request->input('title');
        $row->body = $request->input('description');
        $row->category_id = $request->input('category_id');
        $row->status = $status;
        if($row->save()){
            echo 'success'; exit;
        } else{
            echo 'error'; exit;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Post::find($id);
        
        if(!is_null($row->uploads_dir) && !is_null($row->image)){
            Storage::delete('uploads/'.$row->uploads_dir.'/'.$row->image);
        }
        
        if(isset($row) && $row->delete()){
            return 'success';
        } else{
            return 'error';
        }
    }
    
    /**
     * Upload Image Via Ajax Call
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxImageUpload(Request $request)
    {
        $this->validate($request, [
            'image' => 'image'
        ]);
        
        if($request->hasFile('image')){
            $fileNameWithExtension = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $fileName = str_replace(' ', '-', strtolower($fileName));
            $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExtension;
            
            $uploaded = $request->file('image')->storeAs('uploads/temp', $fileNameToStore);
            
            if($uploaded != FALSE){
                echo 'success|'.$fileNameToStore; exit;
            }
        }
    }
    
    /**
     * Remove Image Via Ajax Call
     *
     * @return \Illuminate\Http\Response
     */
//    public function ajaxImageRemove(Request $request)
//    {
//        $filename = $request->input('filename');
//        $type = $request->input('type');
//        if($type === 'post' && !empty($filename)){
//            $exists = Storage::disk('public')->exists('uploads/temp/'.$filename);
//            if($exists){
//                $deleted = Storage::delete('public/uploads/temp/'.$filename);
//                if($deleted){
//                    echo 'success';
//                }
//            }
//        }
//    }
}
