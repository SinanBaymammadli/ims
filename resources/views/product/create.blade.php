@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="m-0">Create new product</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('product.store') }}">
                    @csrf

                    <div id="product-create-form"></div>

                    {{-- <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus/>

                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-md-4 col-form-label text-md-right">Amount</label>

                        <div class="col-md-6">
                            <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" required/>

                            @if($errors->has('amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="min_required_amount" class="col-md-4 col-form-label text-md-right">Min required amount</label>

                        <div class="col-md-6">
                            <input id="min_required_amount" type="number" class="form-control{{ $errors->has('min_required_amount') ? ' is-invalid' : '' }}" name="min_required_amount" required/>

                            @if($errors->has('min_required_amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('min_required_amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="purchase_price" class="col-md-4 col-form-label text-md-right">Purchase price</label>

                        <div class="col-md-6">
                            <input id="purchase_price" type="number" class="form-control{{ $errors->has('purchase_price') ? ' is-invalid' : '' }}" name="purchase_price" required/>

                            @if($errors->has('purchase_price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('purchase_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order_price" class="col-md-4 col-form-label text-md-right">Order price</label>

                        <div class="col-md-6">
                            <input id="order_price" type="number" class="form-control{{ $errors->has('order_price') ? ' is-invalid' : '' }}" name="order_price" required/>

                            @if($errors->has('order_price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('order_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}

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
