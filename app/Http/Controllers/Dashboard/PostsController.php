<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Storage;
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
        
        $status = empty($request->input('status')) ? 'Inactive' : 'Active';
        
        $filename = $request->input('filename');
        echo public_path().'storage/uploads/temp/'.$filename;

        //if(!empty($filename)){
            if(file_exists(asset('storage/uploads/temp/'.$filename))){
                echo 'ok';exit;
            } else{
                echo 'no';exit;
            }
        //}
        exit;
        
        $row = new Post;
        $row->user_id = auth()->user()->id;
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
            'category_id' => 'required',
            'status' => 'required'
        ]);
        
        $row = Post::find($id);
        $row->title = $request->input('title');
        $row->body = $request->input('description');
        $row->category_id = $request->input('category_id');
        $row->status = $request->input('status');
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
        if(isset($row) && $row->delete()){
            return 'success'; exit;
        } else{
            return 'error'; exit;
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
            //$monthYear = date('m-Y');
            //$postsImagesPath = 'posts/images/'.$monthYear;
            $uploaded = $request->file('image')->storeAs('public/uploads/temp', $fileNameToStore);
            
            if($uploaded != FALSE){
                echo 'success|'.$fileNameToStore; exit;
            }
            
//            $row = Post::find($request->input('id'));
//            if($row){
//                $row->uploads_dir = $postsImagesPath;
//                $row->image = $fileNameToStore;
//                if($row->save()){
//                    echo 'success'; exit;
//                } else{
//                    echo 'error'; exit;
//                }
//            } else{
//                echo 'error'; exit;
//            }
        }
    }
}
