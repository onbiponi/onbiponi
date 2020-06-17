<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::take(10)->orderBy('id', 'desc')->get();
        return view('frontend.index', compact('products'));
    }

	public function termAndCondition() {
		return view('frontend.term-and-condition');
	}
	public function privacyPolicy() {
		return view('frontend.privacy-policy');
	}
}
