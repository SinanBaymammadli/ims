<?php

namespace App\Http\Controllers;

use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $alerts = [];

        foreach ($products as $product) {
            if ($product->amount < $product->min_required_amount) {
                $alerts[] = $product;
            }
        }

        return view('home', ['alerts' => $alerts]);
    }
}
