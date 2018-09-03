<?php

namespace App\Http\Controllers;

use App\Invoice;

class StatisticController extends Controller
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
        $startDate = "2018-09-02";
        $endDate = "2018-09-04";

        $salesInvoices = Invoice::with('client')
            ->with('orders.product')
            ->whereBetween("created_at", [$startDate, $endDate])
            ->where("is_sale", 1)
            ->get();

        dd($salesInvoices);

        return view('statistic.index');
    }
}
