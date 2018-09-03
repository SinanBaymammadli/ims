@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Statistics</h4>
            </div>
            <div class="card-body">
                <div id="sales"></div>
                {!! Lava::render('AreaChart', 'Sales', 'sales') !!}

                <div id="buy"></div>
                {!! Lava::render('AreaChart', 'Buy', 'buy') !!}
            </div>
        </div>
    </div>
@endsection
