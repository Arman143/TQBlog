<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Category;

class CategoriesController extends Controller
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
        return view('layouts.dashboard.categories.index')->with(array(
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
        $rows = Category::with('user')->select(['categories.*']);

        return Datatables::of($rows)
                ->addColumn('action', function ($row) {
                    $html = '
                        <a href="'.url('dashboard/categories/'.$row->id.'/edit').'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i></a>
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
        return view('layouts.dashboard.categories.create')->with(array(
            'controller' => $controller
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
            'name' => 'required',
            'title' => 'required',
            'status' => 'required'
        ]);
        
        $row = new Category;
        $row->user_id = auth()->user()->id;
        $row->name = $request->input('name');
        $row->title = $request->input('title');
        $row->status = $request->input('status');
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
        
        $row = Category::find($id);
        return view('layouts.dashboard.categories.edit')->with(array(
            'controller' => $controller,
            'row' => $row
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
            'name' => 'required',
            'title' => 'required',
            'status' => 'required'
        ]);
        
        $row = Category::find($id);
        $row->user_id = auth()->user()->id;
        $row->name = $request->input('name');
        $row->title = $request->input('title');
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
        $row = Category::find($id);
        if(isset($row) && $row->delete()){
            return 'success'; exit;
        } else{
            return 'error'; exit;
        }
    }
}
