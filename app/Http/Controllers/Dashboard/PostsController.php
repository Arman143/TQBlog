<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing view of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.dashboard.posts.index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPosts()
    {
        // Using Eloquent
        $rows = Post::select(['*']);

        return Datatables::of($rows)
            ->addColumn('action', function ($row) {
                $html = '
                    <a href="'.url('dashboard/posts/'.$row->id.'/edit').'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                    <a href="javascript:void(0);" data-id="'.$row->id.'" data-token="'.csrf_token().'" class="btn btn-xs btn-danger btnDelete"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                ';
                $html .= '
                    
                    <form class="hidden" action="'.action('Dashboard\PostsController@destroy', $row->id).'" method="POST">
                        <input name="_token" type="hidden" value="'.csrf_token().'">
                        '.method_field('DELETE').'
                        <input type="submit" value="Delete" class="btn btn-xs btn-danger">
                    </form>

                        ';
                return $html;
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.dashboard.posts.create');
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
            'description' => 'required'
        ]);
        
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('description');
        $post->save();
        
        return redirect(url('dashboard/posts'))->with('success', 'Record saved');
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
        $post = Post::find($id);
        return view('layouts.dashboard.posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('description');
        $post->save();
        
        return redirect(url('dashboard/posts'))->with('success', 'Record updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(isset($post) && $post->delete()){
            return 'success';
        } else{
            return 'error';
        }
    }
}
