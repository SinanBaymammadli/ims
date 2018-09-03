<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        if (!auth()->user()->can('read-invoices')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $invoices = Invoice::with('client')->get();

        return view('invoice.index', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('create-invoices')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $clients = Client::all();
        $products = Product::all();

        return view("invoice.create", ['products' => $products, 'clients' => $clients]);
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

        if (!$user->can('create-invoices')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        // validate request
        $request->validate([
            //invoice
            'client_id' => ['required', 'integer'],
            'payment_method' => ['required', 'boolean'],
            'is_sale' => ['required', 'boolean'],
            'total' => ['required', 'integer', 'min:0'],

            // client if exist
            'name' => ['sometimes', 'required', 'string'],
            'about' => ['sometimes', 'required', 'string'],

            // orders
            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:products,id'],
            'amount' => ['required', 'array'],
            'amount.*' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'array'],
            'price.*' => ['required', 'integer', 'min:0'],
        ]);

        //dd($request->all());

        $invoice = new Invoice;
        $invoice->user_id = $user->id;
        $invoice->payment_method = $request->payment_method;
        $invoice->is_sale = $request->is_sale;
        $invoice->total = $request->total;

        if ($request->client_id == 0) {
            // create new client
            $client = new Client;
            $client->name = $request->name;
            $client->about = $request->about;
            $client->save();
            //dd($client->id);
            $invoice->client_id = $client->id;
        } else {
            $invoice->client_id = $request->client_id;
        }
        $invoice->save();

        for ($i = 0; $i < count($request->product_id); $i++) {
            // create new order
            $order = new Order;
            $order->product_id = $request->product_id[$i];
            $order->invoice_id = $invoice->id;
            $order->amount = $request->amount[$i];
            $order->price = $request->price[$i];

            // change product amount
            $product = Product::findOrFail($request->product_id[$i]);

            $product->amount = $request->is_sale
            ? $product->amount - $request->amount[$i]
            : $product->amount + $request->amount[$i];

            $product->save();
            $order->save();
        }

        return redirect()->route('invoice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::with('client')->with('orders.product')->findOrFail($id);

        //dd($invoice);

        return view('invoice.show', ['invoice' => $invoice]);
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