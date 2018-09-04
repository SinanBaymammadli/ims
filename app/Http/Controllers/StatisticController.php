<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
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

        $totalSale = $salesInvoices->reduce(function ($carry, $item) {
            return $carry + $item->total;
        }, 0);

        //dd($totalSale);

        return view('statistic.index');
    }

    public function getStatistics(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $salesInvoices = Invoice::with('client')
            ->with('orders.product')
            ->whereBetween("created_at", [$startDate, $endDate])
            ->where("is_sale", 1)
            ->get();

        $totalSale = $salesInvoices->reduce(function ($carry, $item) {
            return $carry + $item->total;
        }, 0);

        return response()->json([
            "total" => $totalSale,
        ]);
    }
}
