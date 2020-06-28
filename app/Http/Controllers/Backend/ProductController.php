<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use App\Product;
use App\Category;
use App\Color;
use App\Size;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource for frontend.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::with('category');
        if($request->category)
            $products->whereHas('category', function(Builder $q) use($request) {
                $q->where('name', 'like', '%'.$request->category.'%'); 
            });
		$products = $products->orderBy('id', 'desc')->paginate(12);
		return view('frontend.products', compact('products', 'categories'));
    }
    
    /**
     * Display a listing of the resource for admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageIndex()
    {
		$products = Product::with('category')->orderBy('id', 'desc')->get();
		return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$dropdowns['colors'] = Color::all();
		$dropdowns['sizes'] = Size::all();
		$dropdowns['categories'] = Category::all();
		
		return view('backend.products.create', $dropdowns);
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
// 		$data = $this->handleImage($request, $data);
		$category = Category::find($request->category_id);
		$product = Product::create($data);
		$file = $request->file('picture');
		if($file) {
			$destination_path = 'assets/products';
			$new_name = $product->id.'.'.$file->getClientOriginalExtension();
			$file->move($destination_path, $new_name);
			$data['picture'] = $new_name;
			$product->update($data);
		}
		for($i = 1; $i<=4; $i++) {
		    $file = $request->file('image'.$i);
    		if($file) {
    			$destination_path = 'assets/products';
    			$new_name = $product->id.$i.'.'.$file->getClientOriginalExtension();
    			$file->move($destination_path, $new_name);
    			$data['image'.$i] = $new_name;
    			$product->update($data);
    		}
		}
		return redirect(route('manage-products.index'))->with('message', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
		return view('frontend.product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$dropdowns['categories'] = Category::all();
        
		$dropdowns['colors'] = Color::all();
		$dropdowns['sizes'] = Size::all();
		
		$product = Product::where('id', $id)->first();
        $dropdowns['product'] = $product;
		
		return view('backend.products.create', $dropdowns);
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
// 		$data = $this->handleImage($request, $data);
		
		$product = Product::find($request->id);
		$file = $request->file('picture');
		if($file) {
			$destination_path = 'assets/products';
			$new_name = $product->id.'.'.$file->getClientOriginalExtension();
			$file->move($destination_path, $new_name);
			$data['picture'] = $new_name;
		}
		for($i = 1; $i<=4; $i++) {
		    $file = $request->file('image'.$i);
    		if($file) {
    			$destination_path = 'assets/products';
    			$new_name = $product->id.$i.'.'.$file->getClientOriginalExtension();
    			$file->move($destination_path, $new_name);
    			$data['image'.$i] = $new_name;
    		}
		}
		$product->update($data);
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
		$product = Product::find($id);
		$request->delete();
		return redirect()->back()->with('message', 'Product has been deleted');
    }
	public function handleImage($request, $data) {
		//Upload new image to server
        $serial = explode(',', $request->image_serial);
		$image_names = [];
		$max_products = 3;
		for($i = 0; $i<$max_products; $i++) {
			if(isset($request->images[$i])) {
				$image = $request->file('images.'.$i);
				$main_img = uniqid() . time().'.'. $image->getClientOriginalExtension();
				$image->move(public_path('images/360-view'), $main_img);
				$image_names[] = $main_img;
			}
		}
		//if images deleted
		$exist = 0;
		for($i = 0; $i<$max_products; $i++) {
			$j=$i+1;
			$name = 'image'.$j;
			if(isset($request->img[$i])) {
				$array = explode('/', $request->img[$i]);
				$data[$name] = end($array);
				
			} else {
				@unlink(public_path('images/360-view/') . $request->$name);
				$data[$name] = null;
				if(!$exist)
					$exist = $i;
			}
		}
		//Save image name to database
        for($i = 0; $i<count($image_names); $i++) {
			$j=$i+$exist+1;
			$name = 'image'.$j;
			$data[$name] = $image_names[$i];
        }
		return $data;
	}
}
