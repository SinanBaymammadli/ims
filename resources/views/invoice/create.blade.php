@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors)
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="m-0">Create new Invoice</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('invoice.store') }}">
                    @csrf

                    <div id="invoice-create-form" data-products="{{ $products }}" data-clients="{{ $clients }}"></div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
