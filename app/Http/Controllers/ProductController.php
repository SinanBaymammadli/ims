<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('read-products')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $products = Product::all();

        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('create-products')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        return view("product.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user->can('create-products')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        //dd($request->all());

        // validate request
        $request->validate([
            'name' => ['required', 'array', Rule::unique('products')],
            'name.*' => ['required', 'string', 'max:255', 'distinct'],
            'amount' => ['required', 'array'],
            'amount.*' => ['required', 'integer', 'min:0'],
            'min_required_amount' => ['required', 'array'],
            'min_required_amount.*' => ['required', 'integer', 'min:0'],
            'purchase_price' => ['required', 'array'],
            'purchase_price.*' => ['required', 'integer', 'min:0'],
            'order_price' => ['required', 'array'],
            'order_price.*' => ['required', 'integer', 'min:0'],
        ]);

        for ($i = 0; $i < count($request->name); $i++) {
            $product = new Product;

            $product->user_id = $user->id;
            $product->name = $request->name[$i];
            $product->amount = $request->amount[$i];
            $product->min_required_amount = $request->min_required_amount[$i];
            $product->purchase_price = $request->purchase_price[$i];
            $product->order_price = $request->order_price[$i];

            $product->save();
        }

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('read-products')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $product = Product::findOrFail($id);

        return view("product.show", ["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
