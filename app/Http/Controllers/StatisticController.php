<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Support\Carbon;
use Lava;

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
        // sales

        $sale_invoices_by_month = Invoice::where('is_sale', 1)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->toDateString();
        });

        $sales = Lava::DataTable();

        $sales->addDateColumn('Date')
            ->addNumberColumn('Sales');

        foreach ($sale_invoices_by_month as $month => $invoices) {

            $total = $invoices->reduce(function ($carry, $invoice) {
                return $carry + $invoice['total'];
            }, 0);

            $sales->addRow([$month, $total]);
        }

        Lava::AreaChart('Sales', $sales, [
            'title' => 'Sales',
            'legend' => [
                'position' => 'in',
            ],
        ]);

        // buyings

        $buy_invoices_by_month = Invoice::where('is_sale', 0)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->toDateString();
        });

        $buys = Lava::DataTable();

        $buys->addDateColumn('Date')
            ->addNumberColumn('Sales');

        foreach ($buy_invoices_by_month as $month => $invoices) {

            $total = $invoices->reduce(function ($carry, $invoice) {
                return $carry + $invoice['total'];
            }, 0);

            $buys->addRow([$month, $total]);
        }

        Lava::AreaChart('Buy', $buys, [
            'title' => 'Buy',
            'legend' => [
                'position' => 'in',
            ],
        ]);

        return view('statistic.index');
    }
}
