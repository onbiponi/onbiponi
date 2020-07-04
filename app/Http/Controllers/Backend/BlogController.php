<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource in frontend.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$blogs = Blog::orderBy('id', 'desc')->paginate(10);
		return view('frontend.blogs', compact('blogs'));
    }
	/**
     * Display a listing of the resource in dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageIndex()
    {
		$blogs = Blog::orderBy('id', 'desc')->get();
		return view('backend.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
		return view('backend.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$data = $request->except('_token', '_method');
		$data['user_id'] = Auth::user()->id;
		$blog = Blog::create($data);
		$file = $request->file('thumbnail');
		if($file) {
			$destination_path = 'assets/blogs';
			$new_name = $blog->id.'.'.$file->getClientOriginalExtension();
			$file->move($destination_path, $new_name);
			$data['thumbnail'] = $new_name;
			$blog->update($data);
		}
		
		return redirect(route('blogs.index'))->with('message', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
        $blog = Blog::find($id);
		return view('frontend.blog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		
        $blog = Blog::find($id);
		return view('backend.blogs.create', compact('blog'));
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
		$data = $request->except('_token', '_method');
		
		$blog = Blog::find($request->id);
		$file = $request->file('thumbnail');
		if($file) {
			$destination_path = 'assets/blogs';
			$new_name = $product->id.'.'.$file->getClientOriginalExtension();
			$file->move($destination_path, $new_name);
			$data['thumbnail'] = $new_name;
		}
		$blog->update($data);
		return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$blog = Blog::find($id);
		$blog->delete();
		return redirect()->back()->with('message', 'Blog has been deleted');
    }
}
